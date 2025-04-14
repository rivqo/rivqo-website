<?php

namespace GT3\ThemesCore;

use Elementor\Plugin;
use GT3\ThemesCore\Assets\Script;
use GT3\ThemesCore\Assets\Style;
use GT3\ThemesCore\Customizer\Elementor;
//use GT3\ThemesCore\Dashboard\Import;
use WP_REST_Server;

use \GT3\ThemesCore\DashBoard\Font_Meta;

class DashBoard {
	private static $instance = null;

	private $theme = null;

	private $requirments = array(
		'php_version'            => '7.4',
		//'max_input_vars'         => 3000,
		'memory_limit'           => 256*1024*1024, // 256M
		//'php_post_max_size'      => 50*1024*1024, // 50M
		'php_max_execution_time' => 600, // 10min
		'php_max_input_vars'     => 3000,
		'max_upload_size'        => 32*1024*1024, // 32M
	);

	/** @return self */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
		add_action('admin_menu', array( $this, 'admin_menu' ), 9);
		add_action('rest_api_init', array( $this, 'rest_init' ));

		Registration::instance();
		Http_Logs::instance();

		add_action('admin_print_scripts-toplevel_page_gt3_dashboard', array( $this, 'remove_admin_notices' ));

		$theme = wp_get_theme()->get_template();
		add_action("admin_print_scripts-{$theme}-theme_page_gt3-demo-import", array( $this, 'remove_admin_notices' ));

		add_filter('tgmpa_load', '__return_true');
	}

	public function remove_admin_notices(){
		remove_all_actions('admin_notices');
	}

	public function rest_init(){
		register_rest_route('gt3_core/v1/dashboard', 'get_settings', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'permission_callback' => function(){
					return current_user_can('administrator');
				},
				'callback'            => array( $this, 'rest_get_settings' ),
			)
		));

		register_rest_route('gt3_core/v1/ticket', 'create', array(
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'permission_callback' => function(){
					return current_user_can('administrator');
				},
				'callback'            => array( $this, 'rest_create_ticket' ),
			)
		));

		register_rest_route('gt3_core/v1/dashboard', 'get_export_settings', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'permission_callback' => function(){
					return current_user_can('administrator');
				},
				'callback'            => array( $this, 'rest_get_export' ),
			)
		));

		register_rest_route('gt3_core/v1/dashboard', 'save_import_settings', array(
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'permission_callback' => function(){
					return current_user_can('administrator');
				},
				'callback'            => array( $this, 'rest_save_import_settings' ),
			)
		));
	}

	function rest_get_export(\WP_REST_Request $request){

		return rest_ensure_response(
			array(
				'customizer' => Customizer::instance()->get_options_to_export(),
				'elementor'  => Elementor::instance()->get_settings(),
			)
		);
	}

	function rest_save_import_settings(\WP_REST_Request $request){
		$customizer = $request->get_param('customizer');
		$elementor  = $request->get_param('elementor');

		$status_customizer = Customizer::instance()->set_options($customizer);
		Elementor::instance()->set_setting($elementor);
		$status_elementor = Elementor::instance()->save_settings();
		$status = $status_customizer && $status_elementor;

		return rest_ensure_response(array(
			'result'  => true,
			'result_elementor'  => $status_elementor,
			'result_customizer'  => $status_customizer,
			'message' => __('Options saved.'),
		));
	}

	public function get_plugins_data(){
		$installed = array();

		$need = apply_filters('gt3/core/dashboard/tgm/plugins', array());

		$required = array_map(function($item){
			$item = array_merge(array(
				'name'     => '',
				'slug'     => '',
				'required' => false,
				'version'  => false,
				'source'   => false,
			), $item);

			return array(
				'source'      => false !== $item['source'] ? 'local' : 'remote',
				'name'        => $item['name'],
				'slug'        => $item['slug'],
				'required'    => $item['required'],
				'new_version' => $item['version'],
				'installed'   => false,
			);

		}, apply_filters('gt3/tgmpa_plugins', array()));
		$required = array_filter($required, function($_plugin) use ($need){
			return in_array($_plugin['slug'], $need);
		});

		$all_plugins = get_plugins();

		$activated_plugins = get_option('active_plugins');

		$transient_update_plugins = get_site_transient('update_plugins');
		if(!is_object($transient_update_plugins) || !property_exists($transient_update_plugins, 'response')) {
			return array_merge($installed);
		}
		$transient_update_plugins = $transient_update_plugins->response;
		if(!is_array($transient_update_plugins)) {
			$transient_update_plugins = array();
		}

		foreach($all_plugins as $file_slug => $plugin_update_info) {
			list ($slug) = explode('/', $file_slug);
			$plugin_info = get_plugin_data(WP_PLUGIN_DIR.'/'.$file_slug, false, false);

			$_plugins_keys = wp_list_pluck($required, 'slug');
			$local_index   = array_search($slug, wp_list_pluck($required, 'slug'));
			$global_index  = array_key_exists($file_slug, $transient_update_plugins);

			if(false === $local_index) {
				continue;
			}

			$global_version    = '';
			$local_version     = '';
			$local_plugin_data = array();

			$local_plugin_data = $required[$local_index];

			$global_version  = array_key_exists($file_slug, $transient_update_plugins) ? $transient_update_plugins[$file_slug]->new_version : '0.0.0';
			$local_version   = $local_plugin_data['new_version'];
			$current_version = $plugin_info['Version'];

			$has_update = false;

			if(version_compare($global_version, $local_version, '>')) {
				if(version_compare($global_version, $current_version, '>')) {
					$has_update = 'remote';
				}
			} else {
				if(version_compare($local_version, $current_version, '>')) {
					$has_update = 'local';
				}
			}

			if(!$has_update) {
				continue;
			}

			$local_plugin_data = array_merge($local_plugin_data, array(
				'version'   => $plugin_info['Version'],
				'active'    => in_array($file_slug, $activated_plugins),
				'installed' => true,
			));

			switch($has_update) {
				case 'remote':
					$local_plugin_data = array_merge($local_plugin_data, array(
						'source'      => 'global',
						'new_version' => $global_version,
						'has_update'  => version_compare($global_version, $plugin_info['Version'], '>'),
						'update_link' => array(
							'plugin'      => $file_slug,
							'slug'        => $slug,
							'action'      => 'update-plugin',
							'_ajax_nonce' => wp_create_nonce('updates'),
						),
					));

					break;
				case 'local':
					$local_plugin_data = array_merge($local_plugin_data, array(
						'source'      => 'local',
						'has_update'  => version_compare($local_version, $plugin_info['Version'], '>'),
						'update_link' => array(
							'plugin'       => $slug,
							'tgmpa-update' => 'update-plugin',
							'action'       => 'tgmpa_action',
							'tgmpa-nonce'  => wp_create_nonce('tgmpa-update'),
						),
					));

					break;
			}

			$installed[] = $local_plugin_data;

			array_splice($required, $local_index, 1);
		}

		/*	if (count($required)) {
				foreach($required as $local_plugin_data) {
					$local_plugin_data = array_merge($local_plugin_data, array(
						'has_update'  => 'false',
						'update_link' => array(
							'plugin'       => $local_plugin_data['slug'],
							'tgmpa-install' => 'install-plugin',
							'action'       => 'tgmpa_action',
							'tgmpa-nonce'  => wp_create_nonce('tgmpa-install'),
						),
					));
					$installed[] = $local_plugin_data;
				}
			}
			*/

		return array_merge($installed);
	}

	public function rest_get_settings(){

		return rest_ensure_response(array_merge(array(
			'system'         => $this->get_system_info(),
			'headerLogo'     => apply_filters('gt3/logo/options/dashboard', get_template_directory_uri().'/core/admin/img/logo_options.png'),
			'importLogo'     => get_template_directory_uri().'/core/demo-data/import/preview-import.jpg',
			'httpLogStatus'  => Http_Logs::get_status(),
			'debugLogStatus' => Logs::get_status(),
			'plugins'        => $this->get_plugins_data(),

		), Registration::instance()->rest_get_settings()));
	}

	public function rest_create_ticket(\WP_REST_Request $request){
		global $wp_version;

		$form = $request->get_param('form');

		if(!is_array($form)) {
			$form = array();
		}

		$form = array_merge(array(
			'name'          => '',
			'email'         => '',
			'subject'       => '',
			'message'       => '',
			'purchase_code' => '',
		), $form);

		$error = false;
		$msg   = '';

		if(empty($form['name'])) {
			$error = true;
			$msg   = esc_html__('Name field is empty', 'gt3_themes_core');
		} else if(empty($form['email']) || !is_email($form['email'])) {
			$error = true;
			$msg   = esc_html__('Invalid email', 'gt3_themes_core');
		} else if(empty($form['subject'])) {
			$error = true;
			$msg   = esc_html__('Subject field is empty', 'gt3_themes_core');
		} else if(empty($form['message'])) {
			$error = true;
			$msg   = esc_html__('Message field is empty', 'gt3_themes_core');
		} else if(empty($form['purchase_code']) || !$this->is_valid_key($form['purchase_code'])) {
			$error = true;
			$msg   = esc_html__('Invalid purchase code', 'gt3_themes_core');
		}

		if($error) {
			return rest_ensure_response(array(
				'error' => true,
				'msg'   => $msg
			));
		}

		$response = wp_remote_post('https://livewp.site/zendesk/', array(
			'user-agent'  => 'WordPress/'.$wp_version.'; '.esc_url(home_url()),
			'method'      => 'POST',
			'sslverify'   => false,
			'redirection' => 5,
			'body'        => $form
		));
		$code     = wp_remote_retrieve_response_code($response);
		$data     = wp_remote_retrieve_body($response);

		if($code === 200) {
			$data = json_decode($data, true);
		} else {
			$data = array(
				'error' => true,
				'msg'   => 'Something went wrong, please try again later',
				//'data'   => $data,
				//'code'   => $code
			);
		}

		return rest_ensure_response($data);
	}

	private function is_valid_key($code){
		$code       = trim($code, " \t\n\r\0\x0B/");
		$matches    = array();
		$is_matches = preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code, $matches);

		return !!$is_matches;
	}


	public function formatBytes($bytes, $precision = 2){
		$base     = log($bytes, 1024);
		$suffixes = array( '', 'K', 'M', 'G', 'T' );

		return round(pow(1024, $base-floor($base)), $precision).' '.$suffixes[floor($base)];
	}

	public function get_system_info(){

		$wp_memory_limit = wp_convert_hr_to_bytes(WP_MEMORY_LIMIT);
		if(function_exists('memory_get_usage')) {
			$wp_memory_limit = max($wp_memory_limit, wp_convert_hr_to_bytes(@ini_get('memory_limit'))); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		}

		$system = array(
			'php_version'            => phpversion(),
			//'max_input_vars'         => ini_get('max_input_vars'),
			'memory_limit'           => $wp_memory_limit,
			//'php_post_max_size'      => wp_convert_hr_to_bytes(ini_get('post_max_size')),
			'php_max_execution_time' => ini_get('max_execution_time'),
			'php_max_input_vars'     => ini_get('max_input_vars'),
			'max_upload_size'        => wp_convert_hr_to_bytes(ini_get('upload_max_filesize')),
		);

		$requirments = array(
			'php_version'            => array(
				'label'    => 'PHP Version:',
				'required' => $this->requirments['php_version'].'+',
				'value'    => $system['php_version'],
				'status'   => version_compare($this->requirments['php_version'], $system['php_version'], '<='),
			),
			'php_max_execution_time' => array(
				'label'    => 'PHP time limit (max_execution_time):',
				'required' => $this->requirments['php_max_execution_time'],
				'value'    => $system['php_max_execution_time'],
				'status'   => (int) $system['php_max_execution_time'] >= (int) $this->requirments['php_max_execution_time'],
			),
			'memory_limit'           => array(
				'label'    => 'PHP memory limit (memory_limit):',
				'required' => $this->formatBytes($this->requirments['memory_limit']),
				'value'    => $this->formatBytes($system['memory_limit']),
				'status'   => (int) $system['memory_limit'] >= (int) $this->requirments['memory_limit'],
			),
			/*'max_input_vars'         => array(
				'label'    => 'max_input_vars',
				'required' => $this->requirments['max_input_vars'],
				'value'    => $system['max_input_vars'],
				'status'   => $system['max_input_vars'] >= $this->requirments['max_input_vars'],
			),*/
			'max_upload_size'        => array(
				'label'    => 'Max upload size (upload_max_filesize):',
				'required' => $this->formatBytes($this->requirments['max_upload_size']),
				'value'    => $this->formatBytes($system['max_upload_size']),
				'status'   => (int) $system['max_upload_size'] >= (int) $this->requirments['max_upload_size'],
			),
			/*'php_post_max_size'      => array(
				'label'    => 'php_post_max_size',
				'required' => $this->requirments['php_post_max_size'],
				'value'    => $system['php_post_max_size'],
				'status'   => $system['php_post_max_size'] >= $this->requirments['php_post_max_size'],
			),*/
			'php_max_input_vars'     => array(
				'label'    => 'PHP Max Input Vars (max_input_vars):',
				'required' => $this->requirments['php_max_input_vars'],
				'value'    => $system['php_max_input_vars'],
				'status'   => (int) $system['php_max_input_vars'] >= (int) $this->requirments['php_max_input_vars'],
			),
		);

		return $requirments;
	}

	public function get_theme(){
		if(!empty($this->theme)) {
			return $this->theme;
		}

		$theme    = wp_get_theme();
		$template = $theme->get_template();
		if($template) {
			$theme = wp_get_theme($template);
		}

		$this->theme = $theme->get_stylesheet();

		return $this->theme;
	}

	public function admin_menu(){
		$theme    = wp_get_theme();
		$template = $theme->get_template();
		if($template) {
			$theme = wp_get_theme($template);
		}
		$name = $theme->get('Name');

		$this->theme = $theme->get_stylesheet();

		$plugins_update = $this->get_plugins_data();

		$count = count($plugins_update) ? ' <span class="update-plugins count-6"><span class="plugin-count">'.count($plugins_update).'</span></span>' : '';

		add_menu_page(
			sprintf(__('%s Theme'), $name),
			sprintf(__('%s'), $name).$count,
			'administrator', 'gt3_dashboard', false, apply_filters('gt3/logo/options/admin', get_template_directory_uri().'/core/admin/img/logo_options.png'), // icon
			2 // order
		);

		add_submenu_page('gt3_dashboard', __('Dashboard'), __('Dashboard'), 'administrator', 'gt3_dashboard', array( $this, 'view_dashboard' ));
	}

	public function view_dashboard(){
		wp_enqueue_script('block-library');
		wp_enqueue_script('editor');
		wp_enqueue_script('wp-editor');
		wp_enqueue_script('wp-components');

		wp_enqueue_style('wp-components');
		wp_enqueue_style('wp-element');
		wp_enqueue_style('wp-blocks-library');
		wp_enqueue_style('wp-api-fetch');

		Script::enqueue_core_asset('admin/dashboard');
		Style::enqueue_core_asset('admin/dashboard');

		$locale  = $this->get_jed_locale_data('gt3_theme_core');
		$content = ';document.addEventListener("DOMContentLoaded", function(){window.wp && wp.i18n && wp.i18n.setLocaleData('.json_encode($locale).', "gt3_themes_core" );});';

		wp_script_add_data('gt3-core/admin/dashboard', 'data', $content);

		$translation_array = array(
			'themeVersion'  => Registration::instance()->get_theme_version(),
			'customizerUrl' => wp_customize_url(),
			'kitUrl'        => class_exists('\Elementor\Plugin') ? \Elementor\Plugin::instance()->kits_manager->get_active_kit()->get_edit_url() : '#',
			'themeDocsUrl'  => apply_filters('gt3/core/docs/url', 'https://livewp.site/docs/'),
			'rest_api' => get_rest_url(0,'gt3_core/v1/test/get_settings')
		);
		wp_localize_script('gt3-core/admin/dashboard', 'gt3_dashboard_data', $translation_array);
		?>
			<script>window.rest_url = "<?php echo get_rest_url(null, 'gt3_core/v1/new_import') ?>";</script>

		<div id="dashboard-wrapper"></div>
		<?php
	}

	function get_jed_locale_data($domain){
		$translations = get_translations_for_domain($domain);

		$locale = array(
			'' => array(
				'domain' => $domain,
				'lang'   => is_admin() ? get_user_locale() : get_locale(),
			),
		);

		if(!empty($translations->headers['Plural-Forms'])) {
			$locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
		}

		foreach($translations->entries as $msgid => $entry) {
			$locale[$msgid] = $entry->translations;
		}

		return $locale;
	}

}
