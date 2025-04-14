<?php

namespace GT3\ThemesCore\Elementor;

use GT3\ThemesCore\Assets\Script;
use GT3\ThemesCore\Assets\Style;
use GT3\ThemesCore\Registration;
use WP_REST_Request;
use WP_REST_Server;

class Kits {

	private static $instance = null;

	private $kit_file = '';

	/** @return \GT3\ThemesCore\Elementor\Kits */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private $errors = array();


	private function __construct(){
		$this->kit_file = get_template_directory().'/elementor/kit.json';

		if(!file_exists($this->kit_file)) {
			return;
		}

		$this->errors = array(
			'file_not_found' => __('File not found', 'gt3_themes_core'),
			'code_not_found' => __('Purchase code error', 'gt3_themes_core'),
			'support_expired' => __('Support expired', 'gt3_themes_core'),
			'undefined'      => __('Something went wrong', 'gt3_themes_core'),
		);

		$time     = filemtime($this->kit_file);
		$datetime = new \DateTime('now', wp_timezone());

		if($time+WEEK_IN_SECONDS < $datetime->getTimestamp()) {
			$kits = Registration::instance()->get_kits_update();
			if(!is_wp_error($kits)) {
				$this->save($kits);
			}
		}

		add_action(
			'elementor/editor/before_enqueue_scripts', function(){
			wp_enqueue_script('react');
			wp_enqueue_script('react-dom');
			wp_enqueue_script('block-library');
			wp_enqueue_script('editor');
			wp_enqueue_script('wp-editor');
			wp_enqueue_script('wp-components');
			Script::enqueue_core_asset('elementor/kits');
			Style::enqueue_core_asset('elementor/kits');
		}
		);

		add_action(
			'elementor/preview/init', function(){
			Style::enqueue_core_asset('elementor/kits');
		}
		);

		add_action(
			'rest_api_init', function(){
			$namespace = 'gt3_core/v1/elementor/kits';

			register_rest_route(
				$namespace,
				'get',
				array(
					array(
						'methods'             => WP_REST_Server::ALLMETHODS,
						'permission_callback' => function(WP_REST_Request $request){
							return current_user_can('administrator');
						},
						'callback'            => array( $this, 'rest_get_kits' ),
					)
				)
			);

			register_rest_route(
				$namespace,
				'import',
				array(
					array(
						'methods'             => WP_REST_Server::ALLMETHODS,
						'permission_callback' => function(WP_REST_Request $request){
							return current_user_can('administrator');
						},
						'callback'            => array( $this, 'rest_import' ),
					)
				)
			);
		}
		);
	}

	function rest_get_kits(){
		$file      = file_get_contents($this->kit_file);
		$file_data = json_decode($file, true);

		return rest_ensure_response(
			array(
				'kits'      => $file_data,
				'activeTab' => $file_data['selected']
			)
		);
	}

	function rest_import(\WP_REST_Request $request){
		$id = $request->get_param('id');

		$kit = Registration::instance()->get_kit($id);

		if(!is_wp_error($kit)) {
			if(is_string($kit)) {
				$kit = json_decode($kit, true);
			}
			if(!is_array($kit)) {
				$kit = array(
					'error' => true,
					'msg'   => 'file_not_found'
				);
			}
			if(key_exists('error', $kit)) {
				return rest_ensure_response(
					array(
						'error'    => true,
						'code'     => $kit['msg'],
						'msg'      => array_key_exists($kit['msg'], $this->errors) ? $this->errors[$kit['msg']] : $this->errors['undefined'],
						'response' => $kit,
					)
				);
			}

			return rest_ensure_response(
				array(
					'content' => $kit,
				)
			);
		}

		return rest_ensure_response(
			array(
				'error' => true,
				'msg'   => $this->errors['undefined'],
				'code'  => 'undefined',
			)
		);
	}

	function save($data){
		if(is_array($data)) {
			$data = json_encode($data);
		}

		$fp = fopen($this->kit_file, 'w+');
		if ($fp) {
			fwrite($fp, $data);
			fflush($fp);
			fclose($fp);
		}
	}
}
