<?php

namespace GT3\ThemesCore\Import;

use GT3\ThemesCore\DashBoard;
use WP_Error;
use WP_REST_Request;
use WP_HTTP_Response;
use WP_REST_Response;

use WP_Ajax_Upgrader_Skin;
use Theme_Upgrader;

use WP_Filesystem_Direct;

/*
* request theme zip
* install plugins
*   - plugin 1
*   - plugin 2
*   - plugin 3
* import terms
* import media
* import posts
* import menus
* replace ids and clean
* */

trait Actions_Trait {
	
	protected function action_download_theme() : void{
		require_once ABSPATH.'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH.'wp-admin/includes/class-wp-filesystem-direct.php';
		
		$installChild = $this->get_param('installChild');
		
		$this->emit_sse_message(array(
			//'message' => __('Start downloading import'),
			'index' => 1,
			'max'   => $installChild ? 8 : 3,
		));
		
		$this->remove_import_folder();
		
		sleep(1);
		
		$url = self::$demo_url.'?'.base64_encode(json_encode(array(
				'a' => 'download_import',
				's' => $this->theme
			)));
		
		$file = $this->fetch_file($url);
		
		$this->emit_sse_message(array(
			//'message' => __('Request complete')
			'index' => 2,
		));
		
		if(is_wp_error($file)) {
			$this->stop_streaming(array(
				"error"   => $file,
				'message' => __('Error downloading file.')
			));
		}
		
		try {
			$this->path   = stream_resolve_include_path($this->path);
			$unzip_status = unzip_file($file, $this->path);
			if(is_wp_error($unzip_status)) {
				$this->stop_streaming(array(
					"error"   => $unzip_status,
					'message' => __('Unzip error.'),
					'path'    => $this->path,
					'file'    => $file
				));
			}
			$this->emit_sse_message(array(
				//'message' => __('Unzip complete'),
				'index' => 3,
			));
			sleep(1);
		} finally {
			@unlink($file);
		}
		
		if($installChild) {
			
			$slug = $this->theme.'-child';
			
			$theme = wp_get_theme($slug);
			
			$this->emit_sse_message(array(
				//'message' => __('Start downloading child theme'),
				//'theme'   => $theme,
				'index' => 4,
			));
			if(!$theme->exists()) {
				$url = self::$demo_url.'?'.base64_encode(json_encode(array(
						'a' => 'download_child',
						's' => $this->theme
					)));
				
				$this->emit_sse_message(array(
					//'message' => __('Start downloading child theme'),
					'index' => 5,
				));
				
				$file = $this->fetch_file($url);
				
				$this->emit_sse_message(array(
					//'message' => __('Request child theme complete'),
					'index' => 6,
				));
				
				if(is_wp_error($file)) {
					$this->stop_streaming(array(
						"error"   => $file,
						'message' => __('Error downloading child theme file.')
					));
				}
				try {
					require_once ABSPATH.'wp-admin/includes/file.php';
					require_once ABSPATH.'wp-admin/includes/theme.php';
					require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
					require_once ABSPATH.'wp-admin/includes/theme-install.php';
					
					$skin     = new WP_Ajax_Upgrader_Skin();
					$upgrader = new Theme_Upgrader($skin);
					$result   = $upgrader->install($file);
					$status   = array(
						'index' => 7,
					);
					
					if(is_wp_error($result)) {
						$status['errorCode']    = $result->get_error_code();
						$status['errorMessage'] = $result->get_error_message();
						$this->emit_sse_message($status);
					} else if(is_wp_error($skin->result)) {
						$status['errorCode']    = $skin->result->get_error_code();
						$status['errorMessage'] = $skin->result->get_error_message();
						$this->emit_sse_message($status);
					} else if($skin->get_errors()->has_errors()) {
						$status['errorMessage'] = $skin->get_error_messages();
						$this->emit_sse_message($status);
					} else if(is_null($result)) {
						global $wp_filesystem;
						
						$status['errorCode']    = 'unable_to_connect_to_filesystem';
						$status['errorMessage'] = __('Unable to connect to the filesystem. Please confirm your credentials.');
						
						// Pass through the error from WP_Filesystem if one was raised.
						if($wp_filesystem instanceof \WP_Filesystem_Base && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->has_errors()) {
							$status['errorMessage'] = esc_html($wp_filesystem->errors->get_error_message());
						}
						
						$this->emit_sse_message($status);
					}
					
					switch_theme($this->theme.'-child');
					
					sleep(1);
				} finally {
					@unlink($file);
				}
			}
			
			$this->emit_sse_message(array(
				'index' => 8,
			));
		}
	}
	
	protected function action_install_plugin($slug = false, $send_status = null){
		$all_plugins = apply_filters('gt3/tgmpa_plugins', []);
		$indexes     = array_column($all_plugins, 'slug');
		
		if (false === $slug) {
			$slug = $this->get_param('plugin');
			$send_status = true;
		}
		
		$array_map = array_flip($indexes);
		
		$installed_plugins = get_plugins();
		
		$installed_plugins = array_column(array_map(function($key, $v){
			$v['path'] = WP_PLUGIN_DIR.'/'.$key;
			$key       = explode('/', $key);
			$key       = $key[0];
			
			return [ $key, $v ];
		}, array_keys($installed_plugins), $installed_plugins), 1, 0);
		
		$active_plugins = array_map(function($key){
			$key = explode('/', $key);
			
			return $key[0];
		}, get_option('active_plugins'));
		
		if($slug === 'gt3-themes-core') {
			return;
		}
		$plugin = $all_plugins[$array_map[$slug] ?? null] ?? false;
		if(!$plugin) {
			$this->stop_streaming(array(
				'message' => 'Plugin '.$slug.' not found'
			));
		}
		
		
		$plugin = array_merge(array(
			'slug'   => false,
			'source' => false,
			'status' => 'active'
		), $plugin);
		
		if(array_key_exists($slug, $installed_plugins)) {
			// Plugin installed.
			
			if(!in_array($slug, $active_plugins)) {
				// Activate
				$this->handle_plugin_status($installed_plugins[$slug]['path'], 'active', 'inactive');
			}
			
		} else {
			$result = $this->install_plugin(array(
				'slug'   => $plugin['slug'],
				'source' => $plugin['source'],
			));
			if(is_wp_error($result) && $send_status) {
				wp_die(wp_json_encode($result));
			}
		}
		
		if ($send_status) {
			wp_die(wp_json_encode(array(
				'finish'    => true,
				'next_step' => true,
			)));
		}
	}
	
	
	public function action_start_import(){
		$filter = $this->get_param('filter');
		
		if($this->active) {
			$this->stop_streaming($this->get_current_status());
		}
		$this->load_import_file();
		
		$this->clear_log();
		$this->save_scheduled($filter);
		
		$this->processed_authors     = array();
		$this->author_mapping        = array();
		$this->processed_terms       = array();
		$this->processed_posts       = array();
		$this->post_orphans          = array();
		$this->processed_menu_items  = array();
		$this->menu_item_orphans     = array();
		$this->missing_menu_items    = array();
		$this->url_remap             = array();
		$this->featured_images       = array();
		$this->current_step          = self::STEP_TERMS;
		$this->current_index         = 0;
		$this->global_index          = 0;
		$this->processed_attachments = array();
		$this->active                = true;
		$this->log                   = array();
		
		$this->save_states(false);
	}
	
	public function action_stop_import(){
		$this->active = false;
		$this->save_states(false);
		
		$this->stop_streaming(array(
			"error"   => true,
			'message' => __('Stopped.')
		));
	}
	
	
	public function rest_tick(){
		$this->load_import_file();
		$this->load_scheduled_file();
		$this->load_states();
		
		$this->emit_sse_message($this->get_current_status());
		
		if(is_wp_error($this->scheduled)) {
			$this->log('missing import data');
			
			$this->stop_streaming(array(
				array(
					'error'   => true,
					'respond' => 'missing import data',
				)
			));
		}
		
		if(!$this->active) {
			$this->log('process stopped');
			
			$this->stop_streaming(array(
				array(
					'error'   => true,
					'respond' => 'process stopped',
				)
			));
		}
		
		//		$this->emit_sse_message(array(
		//			'message' => 'Importing'
		//		));
		
		require_once ABSPATH.'wp-admin/includes/post.php';
		require_once ABSPATH.'wp-admin/includes/comment.php';
		require_once ABSPATH.'wp-admin/includes/taxonomy.php';
		require_once ABSPATH.'wp-admin/includes/image.php';
		require_once ABSPATH.'wp-admin/includes/media.php';
		
		wp_suspend_cache_invalidation(true);
		
		$this->_tick_import();
		
		wp_suspend_cache_invalidation(false);
	}
	
	protected function action_rest_tick(){
		$this->rest_tick();
	}
}