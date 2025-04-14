<?php

namespace GT3\ThemesCore\Import;

use Elementor\Plugin as Elementor_Plugin;
use GT3\ThemesCore\DashBoard;
use GT3\ThemesCore\Registration;
use WP_REST_Request;
use WP_REST_Server;

trait Rest_Actions_Trait {

	public function rest_init(){
		register_rest_route(
			'gt3_core/v1/new_import',
			'get_settings',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'permission_callback' => function(WP_REST_Request $request){
						return current_user_can('administrator');
					},
					'callback'            => array( $this, 'rest_get_settings' ),
				)
			)
		);

		register_rest_route(
			'gt3_core/v1/new_import',
			'get_nonce',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'permission_callback' => function(WP_REST_Request $request){
						return current_user_can('administrator');
					},
					'callback'            => function(){
						return rest_ensure_response(array(
							'_ajax_nonce' => wp_create_nonce(self::$nonce_key)
						));
					},
				)
			)
		);

		/////////////////////////////////////////////////////////

		register_rest_route(
			'gt3_core/v1/import',
			'commands',
			array(
				array(
					'methods'             => WP_REST_Server::ALLMETHODS,
					'permission_callback' => function(WP_REST_Request $request){
						return current_user_can('administrator');
					},
					'callback'            => array( $this, 'rest_import_commands' ),
				)
			)
		);

		register_rest_route(
			'gt3_core/v1/import',
			'tick',
			array(
				array(
					'methods'             => WP_REST_Server::ALLMETHODS,
					'permission_callback' => function(WP_REST_Request $request){
						return current_user_can('administrator');
					},
					'callback'            => array( $this, 'rest_import_tick' ),
				)
			)
		);

		register_rest_route(
			'gt3_core/v1/import',
			'get_settings',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'permission_callback' => function(){
						return current_user_can('administrator');
					},
					'callback'            => array( $this, 'rest_import_get_settings' ),
				)
			)
		);

		register_rest_route(
			'gt3_core/v1/import',
			'import_homepage',
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'permission_callback' => function(){
						return current_user_can('administrator');
					},
					'callback'            => array( $this, 'rest_import_homepage' ),
				)
			)
		);

		register_rest_route(
			'gt3_core/v1/import',
			'logs',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'permission_callback' => function(){
						return current_user_can('administrator');
					},
					'callback'            => array( $this, 'rest_logs' ),
				)
			)
		);
	}

	public function rest_import_get_settings(){
		$import_data = $this->load_old_import_file();

		$woo_import_url = '';
		if(class_exists('WooCommerce')) {
			$woo_import_url = wp_normalize_path(stream_resolve_include_path($this->path.'gt3-wc-products.csv'));
			if($woo_import_url) {
				$params         = array(
					'post_type'       => 'product',
					'page'            => 'product_importer',
					'step'            => 'mapping',
					'file'            => $woo_import_url,
					'delimiter'       => ',',
					'update_existing' => 0,
					'_wpnonce'        => wp_create_nonce('woocommerce-csv-importer'), // wp_nonce_url() escapes & to &amp; breaking redirects.
				);
				$woo_import_url = add_query_arg($params, admin_url('edit.php'));
			}
		}

		return rest_ensure_response(
			array_merge(
				array(
					'headerLogo'     => apply_filters('gt3/logo/options/dashboard', get_template_directory_uri().'/core/admin/img/logo_options.png'),
					'import_data'    => $import_data,
					'importUrl'      => $this->theme_import_url,
					'system'         => DashBoard::instance()->get_system_info(),
					'themeVersion'   => Registration::instance()->get_theme_version(),
					'_import_nonce'  => wp_create_nonce(self::$nonce_key),
					'woo_import_url' => $woo_import_url,
				)
			)
		);
	}

	public function rest_logs(){
		$file = $this->folder.'log.txt';
		$file = realpath($file);

		$log = 'File not exist';

		if($file && file_exists($file)) {
			$log = file_get_contents($file);

			if(empty($log)) {
				$log = 'Log empty';
			}
		}

		return rest_ensure_response(
			array(
				'log' => $log,
			)
		);
	}

	public function rest_import_tick(){
		ignore_user_abort(true);
		set_time_limit(0);

		ob_start();

		$this->load_import_file();
		$this->load_scheduled_file();
		$this->load_states();

		if(is_wp_error($this->scheduled)) {
			$this->log('missing import data');

			return rest_ensure_response(
				array(
					'error'   => true,
					'respond' => 'missing import data',
				)
			);
		}

		if(!$this->active) {
			$this->log('process stopped');

			return rest_ensure_response(
				array(
					'error'   => true,
					'respond' => 'process stopped',
				)
			);
		}

		require_once ABSPATH.'wp-admin/includes/post.php';
		require_once ABSPATH.'wp-admin/includes/comment.php';
		require_once ABSPATH.'wp-admin/includes/taxonomy.php';
		require_once ABSPATH.'wp-admin/includes/image.php';
		require_once ABSPATH.'wp-admin/includes/media.php';

		wp_suspend_cache_invalidation(true);

		switch($this->current_step) {
			case self::STEP_INSTALL_PLUGINS:
				$all_plugins = apply_filters('gt3/tgmpa_plugins', []);
				$all_plugins = array_filter($all_plugins, function($plugin){
					$plugin = array_merge(array(
						'required' => false
					), $plugin);

					return $plugin['required'];
				});

				$plugins = array_slice($all_plugins, $this->current_index-1, 1);
				$slug    = $plugins[0]['slug'];

				$this->action_install_plugin($slug);
				$this->current_index++;

				if($this->current_index-1 >= count($all_plugins)) {
					$this->current_step  = self::STEP_TERMS;
					$this->current_index = 0;
				}

				break;

			case self::STEP_TERMS:
				$this->import_theme_options();
				$this->process_terms();

				$this->current_step  = self::STEP_ATTACHMENTS;
				$this->current_index = 0;
				break;

			case self::STEP_ATTACHMENTS:
				$this->process_attachments();

				if($this->current_index >= count($this->attachments)) {
					$this->current_step  = self::STEP_POSTS;
					$this->current_index = 0;
				}
				break;

			case self::STEP_POSTS:

				$this->process_posts();

				if($this->current_index >= count($this->posts)) {
					$this->current_step  = self::STEP_FINISH;
					$this->current_index = $this->get_max_index(self::STEP_FINISH);
				}
				break;

			case self::STEP_FINISH:
				$this->process_menus();

				$this->backfill_parents();
				$this->backfill_attachment_urls();
				$this->remap_featured_images();

				$this->import_widgets();
				$this->import_settings();
				$this->process_rev_sliders();

				wp_cache_flush();
				foreach(get_taxonomies() as $tax) {
					delete_option("{$tax}_children");
					_get_term_hierarchy($tax);
				}

				wp_defer_term_counting(false);
				wp_defer_comment_counting(false);

				do_action('gt3/core/import/finish');

				$this->remove_import_folder();

				$this->active = false;
				break;
		}
		wp_suspend_cache_invalidation(false);

		$this->save_states();

		return rest_ensure_response(
			array(
				'error' => false,
				'state' => $this->get_current_status(),
			)
		);
	}

	public function rest_import_commands(\WP_REST_Request $request){


		$command     = $request->get_param('command');
		$filter      = $request->get_param('filter');
		$withPlugins = $request->get_param('withPlugins');

		switch($command) {
			case 'start':
				$this->download_import();

				$this->load_import_file();
				$this->load_states();

				if(is_wp_error($this->import_data)) {
					return rest_ensure_response(
						array(
							'error' => true,
						)
					);
				}

				if($this->active) {
					return rest_ensure_response($this->get_current_status());
				}

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
				$this->current_step          = $withPlugins ? self::STEP_INSTALL_PLUGINS : self::STEP_TERMS;
				$this->current_index         = $withPlugins ? 1 : 0;
				$this->global_index          = 0;
				$this->processed_attachments = array();
				$this->active                = true;
				$this->log                   = array();

				$this->save_states();

				return rest_ensure_response(
					array_merge(
						array(
							'error' => false,
						),
						$this->get_current_status()
					)
				);

			case 'stop':
				$this->active = false;
				$this->save_states();

				return rest_ensure_response(
					array(
						'error' => false,
					)
				);
		}

		$type = $request->get_param('type');
		if(is_null($type)) {
			$type = 'json';
		}

		if($type == 'text') {
			echo 'Step: '.$this->current_step.PHP_EOL.
			     'Index: '.$this->current_index.' of '.$this->get_max_index().PHP_EOL.
			     'Logs:'.PHP_EOL.PHP_EOL.
			     implode(PHP_EOL, array_reverse($this->log));
			die;
		}

		return rest_ensure_response($this->get_current_status());
	}

	public function rest_import_homepage(\WP_REST_Request $request){
		$this->download_import();
		$this->load_import_file();

		require_once(ABSPATH.'wp-admin/includes/post.php');
		require_once(ABSPATH.'wp-admin/includes/comment.php');
		require_once ABSPATH.'wp-admin/includes/taxonomy.php';
		require_once ABSPATH.'wp-admin/includes/image.php';
		$post = $request->get_param('post');
		$post = $this->load_file('posts', $post);
		if(is_wp_error($post)) {
			return rest_ensure_response(
				array(
					'error'   => true,
					'respond' => $post->get_error_message(),
				)
			);
		}

		$media = key_exists('media', $post) && is_array($post['media']) ? $post['media'] : array();

		$_header = $this->get_meta_key('_wpda-builder-header', $post);
		$_footer = $this->get_meta_key('_wpda-builder-footer', $post);

		if($_header) {
			$_header = $this->load_file('posts', $_header);
			if(!is_wp_error($_header)) {
				$media = key_exists('media', $_header) && is_array($_header['media']) ? array_merge($media, $_header['media']) : $media;
			} else {
				$_header = null;
			}
		}

		if($_footer) {
			$_footer = $this->load_file('posts', $_footer);
			if(!is_wp_error($_footer)) {
				$media = key_exists('media', $_footer) && is_array($_footer['media']) ? array_merge($media, $_footer['media']) : $media;
			} else {
				$_footer = null;
			}
		}

		$media = array_unique($media);

		foreach($media as $post_id) {
			$_media = $this->load_file('posts', $post_id);
			if(is_wp_error($_media)) {
				continue;
			}

			$this->process_post($_media);
		}

		if($_footer) {
			$this->process_post($_footer);
		}
		if($_header) {
			$this->process_post($_header);
		}

		$this->process_post($post);

		$this->backfill_parents();
		$this->backfill_attachment_urls();
		$this->remap_featured_images();

		$this->remove_import_folder();

		return die(wp_json_encode(
			array(
				'error'   => false,
				'respond' => 'Imported',
			)
		));
	}

}
