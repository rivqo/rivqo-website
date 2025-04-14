<?php
namespace GT3\ThemesCore\Import;

use WP_Error;
use WP_REST_Request;
use WP_HTTP_Response;
use WP_REST_Response;

use WP_Filesystem_Direct;


trait Server_Side_Events_Trait {
	protected      $is_streaming      = false;
	protected $buffer_overflow = 20*1024;
	
	protected function start_streaming(){
		if($this->is_streaming || !$this->get_param('streaming')) {
			return;
		}
		$this->is_streaming = true;
		
		// Turn off PHP output compression
		ini_set('output_buffering', 0);
		ini_set('zlib.output_compression', 0);
//		ini_set('output_buffering', 'off');
//		ini_set('zlib.output_compression', false);
		set_time_limit(0);
		
		if(key_exists('is_nginx', $GLOBALS) && $GLOBALS['is_nginx']) {
			// Setting this header instructs Nginx to disable fastcgi_buffering
			// and disable gzip for this request.
			header('X-Accel-Buffering: no');
			header('Content-Encoding: none');
		}
		
		// Start the event stream.
		header('Content-Type: text/event-stream');
		
		flush();
		
		// 2KB padding for IE
		echo ':'.str_repeat(' ', $this->buffer_overflow)."\n\n";
		// Time to run the import!
		
		remove_action('shutdown', 'wp_ob_end_flush_all', 1);
		
		add_action('shutdown', function(){
			while(@ob_end_flush()) {
				;
			}
		});
	}
	
	protected function emit_sse_message($data, $event = 'message'){
		if(!$this->is_streaming) {
			return;
		}
		
		echo "event: ".$event."\n";
		echo 'data: '.wp_json_encode($data)."\n"."\n";
		echo ':'.str_repeat(' ', $this->buffer_overflow)."\n"."\n";
		while(@ob_end_flush()) {
			;
		}
		flush();
	}
	
	protected function stop_streaming($data = false,$event = 'finish'){
		if (!$this->is_streaming) return;
		
		if($data && is_array($data)) {
			$this->emit_sse_message(array_merge(
				array(
					'stopped' => true
				), $data
			), $event);
		}
		
		sleep(1);
		die;
	}
	
	protected function next_step( $send_status = true) {
		$this->save_states($send_status);
		$this->stop_streaming(array(
			'error' => false,
			'next_step' => true
		));
	}
	
}