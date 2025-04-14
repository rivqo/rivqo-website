<?php
namespace GT3\ThemesCore\Import;

use WP_Error;
use WP_REST_Request;
use WP_HTTP_Response;
use WP_REST_Response;

use WP_Filesystem_Direct;


trait Process_Status_Trait {
	
	public function get_current_status(){
		$status = array(
			'index'  => $this->current_index,
			'max'    => $this->get_max_index(),
			'active' => $this->active
		);
		
		if (defined('REST_REQUEST') && REST_REQUEST) {
			$status['step'] = $this->current_step;
		}
			
		return $status;
	}
	
	protected function get_max_index($step = null){
		if(is_null($step)) {
			$step = $this->current_step;
		}
		
		switch($step) {
			case self::STEP_INSTALL_PLUGINS:
				$all_plugins = apply_filters('gt3/tgmpa_plugins', []);
				$all_plugins = array_filter($all_plugins, function($plugin) {
					$plugin = array_merge(array(
						'required' => false
					), $plugin);
					
					return $plugin['required'];
				});
				
				return count($all_plugins) + 1;
			case self::STEP_TERMS:
				return count($this->terms);
			case self::STEP_ATTACHMENTS:
				return count($this->attachments);
			case self::STEP_POSTS:
				return count($this->posts);
			case self::STEP_MENUS:
				return count($this->menu_items);
		}
		
		return 0;
		
		return (key_exists($step, $this->max_items) && $this->max_items[$step] > -1) ? $this->max_items[$step] : 0;
	}
	
	protected function load_states(){
		$file = $this->get_state_file();
		if(!file_exists($file)) {
			return;
		}
		
		$fp = fopen($file, 'r');
		if($fp) {
			$state = '';
			while(!feof($fp)) {
				$state .= fread($fp, 1024);
			}
			fclose($fp);
			$state = json_decode($state, true);
			if(json_last_error()) {
				$state = array();
			}
		}
		if(!is_array($state)) {
			$state = array();
		}
		
		$this->processed_authors     = $this->get_state('processed_authors', $state);
		$this->author_mapping        = $this->get_state('author_mapping', $state);
		$this->processed_terms       = $this->get_state('processed_terms', $state);
		$this->processed_posts       = $this->get_state('processed_posts', $state);
		$this->post_orphans          = $this->get_state('post_orphans', $state);
		$this->processed_menu_items  = $this->get_state('processed_menu_items', $state);
		$this->menu_item_orphans     = $this->get_state('menu_item_orphans', $state);
		$this->missing_menu_items    = $this->get_state('missing_menu_items', $state);
		$this->url_remap             = $this->get_state('url_remap', $state);
		$this->featured_images       = $this->get_state('featured_images', $state);
		$this->current_step          = $this->get_state('current_step', $state, self::STEP_IDLE);
		$this->current_index         = $this->get_state('current_index', $state, 0);
		$this->processed_attachments = $this->get_state('processed_attachments', $state);
		$this->active                = $this->get_state('active', $state, false);
		$this->log                   = $this->get_state('log', $state);
	}
	
	protected function get_state_file(){
		return trailingslashit($this->folder).'import-'.$this->theme.'-state.json';
	}
	
	protected function save_states($send_response = true){
		$state = array(
			'current_step'          => $this->current_step,
			'current_index'         => $this->current_index,
			'processed_attachments' => $this->processed_attachments,
			'active'                => $this->active,
			
			'processed_authors'    => $this->processed_authors,
			'author_mapping'       => $this->author_mapping,
			'processed_terms'      => $this->processed_terms,
			'processed_posts'      => $this->processed_posts,
			'post_orphans'         => $this->post_orphans,
			'processed_menu_items' => $this->processed_menu_items,
			'menu_item_orphans'    => $this->menu_item_orphans,
			'missing_menu_items'   => $this->missing_menu_items,
			'url_remap'            => $this->url_remap,
			'featured_images'      => $this->featured_images,
			'log'                  => $this->log,
		);
		if(!$this->save_log) {
			unset($state['log']);
		}
		
		$file = $this->get_state_file();
		$fp   = fopen($file, 'w+');
		if($fp) {
			$state   = json_encode($state);
			$len     = strlen($state);
			$written = $fwrite = 0;
			
			if($len > 0) {
				while($len > $written && $fwrite !== false) {
					$line   = substr($state, $written, 256);
					$fwrite = fwrite($fp, $line);
					fflush($fp);
					if(false !== $fwrite) {
						$written += $fwrite;
					}
				}
			}
			
			fflush($fp);
			fclose($fp);
		}
		if($send_response) {
			$this->emit_sse_message($this->get_current_status());
		}
	}
	
	protected function get_state($state_name, $state, $default = array()){
		$val = $default;
		if(key_exists($state_name, $state)) {
			$val = $state[$state_name];
		} else if(property_exists($this, $state_name)) {
			$val = $this->{$state_name};
		}
		
		return $val;
	}
	
	protected function clear_log(){
		if($this->save_log_external) {
			$file = $this->folder.'log.txt';
			
			if(file_exists($file)) {
				@unlink($file);
			}
		}
	}
	
	protected function log($msg){
		if($this->save_log_external) {
			$file = $this->folder.'log.txt';
			$fp   = fopen($file, 'a+');
			if($fp) {
				fwrite($fp, json_encode($msg).PHP_EOL);
				fflush($fp);
				fclose($fp);
			}
		}
		
		$this->log[] = json_encode($msg);
	}
	
}