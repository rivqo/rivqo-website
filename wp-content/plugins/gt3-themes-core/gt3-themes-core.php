<?php
/*
	Plugin Name: GT3 Themes Core
	Plugin URI: https://gt3themes.com/
	Description: GT3 Themes Core
	Version: 2.2.7
	Author: GT3 Themes
	Author URI: https://gt3themes.com/
	Text Domain:  gt3_themes_core
	Domain Path:  /languages
*/

use Elementor\Core\Settings\Manager as SettingsManager;
use Elementor\Plugin;
use GT3\ThemesCore\DashBoard;
use GT3\ThemesCore\Import;

if(!defined('ABSPATH')) {
	exit;
}

if(!defined('GT3_THEMES_CORE_PLUGIN_FILE')) {
	define('GT3_THEMES_CORE_PLUGIN_FILE', __FILE__);
}

require_once __DIR__.'/core/autoload.php';

require_once ABSPATH.'wp-admin/includes/import.php';

if(!class_exists('WP_Importer')) {
	$class_wp_importer = ABSPATH.'wp-admin/includes/class-wp-importer.php';

	if(file_exists($class_wp_importer)) {
		require_once $class_wp_importer;
	}
}

Import::instance();

$gt3_theme_check = wp_get_theme();
$gt3_is_child    = $gt3_theme_check->get('Template');
if(!empty($gt3_is_child)) {
	$gt3_theme_check = wp_get_theme($gt3_is_child);
}
if(strtolower($gt3_theme_check->get('Author')) !== strtolower('GT3themes')) {
	return;
}


class GT3_Core_Elementor {
	const NAME     = 'GT3 Themes Core';
	const _require = 'elementor/elementor.php';
	private static $instance = null;

	public static function instance(){
		if(!self::$instance instanceof self) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct(){
		add_action('plugins_loaded', array( $this, 'plugins_loaded' ));
	}

	function _is_elementor_installed(){
		$installed_plugins = get_plugins();

		return isset($installed_plugins[self::_require]);
	}

	function fail_php_version(){
		$message      = sprintf(esc_html__('%s requires PHP version %s+, plugin is currently NOT ACTIVE.', 'gt3_themes_core'), self::NAME, '7.4');
		$html_message = sprintf('<div class="error">%s</div>', wpautop($message));
		echo wp_kses_post($html_message);
	}

	function fail_load(){
		$screen = get_current_screen();
		if(apply_filters('gt3/core/elementor/disable_notice', false) || (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id)) {
			return;
		}

		if($this->_is_elementor_installed()) {
			if(!current_user_can('activate_plugins')) {
				return;
			}

			$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin='.self::_require.'&amp;plugin_status=all&amp;paged=1&amp;', 'activate-plugin_'.self::_require);

			$message = '<p>'.sprintf(esc_html__('%s is not working because you need to activate the Elementor plugin.', 'gt3_themes_core'), self::NAME).'</p>';
			$message .= sprintf('<p><a href="%s" class="button-primary">%s</a></p>', $activation_url, esc_html__('Activate Elementor Now', 'gt3_themes_core'));
		} else {
			if(!current_user_can('install_plugins')) {
				return;
			}

			$install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

			/* translators: 1: Plugin name. */
			$message = '<p>'.sprintf(esc_html__('%1$s is not working because you need to install the Elementor plugin', 'gt3_themes_core'), self::NAME).'</p>';
			$message .= '<p>'.sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'gt3_themes_core')).'</p>';
		}

		echo '<div class="error"><p>'.$message.'</p></div>';
	}

	public function plugins_loaded(){

		if(!version_compare(PHP_VERSION, '7.4', '>=')) {
			add_action('admin_notices', array( $this, 'fail_php_version' ));
		} else {
			if(!function_exists('get_plugin_data')) {
				require_once(ABSPATH.'wp-admin/includes/plugin.php');
			}
			$plugin_info = get_plugin_data(__FILE__, false, false);
			define('GT3_CORE_ELEMENTOR_VERSION', $plugin_info['Version']);

			add_action('after_setup_theme', array( $this, 'after_setup_theme' ));
			add_action('wp', array( $this, 'wp_load' ), 0);
			load_plugin_textdomain('gt3_themes_core', false, __DIR__.'/languages/');

			require_once __DIR__.'/init.php';

			require_once __DIR__.'/core/framework/class.redux-plugin.php';
			require_once __DIR__.'/core/framework/init.php';
			require_once __DIR__.'/core/redux-extension-loader.php';
			require_once __DIR__.'/core/redux-importer-config.php';

			add_filter('get_the_terms', function($terms, $post_ID, $taxonomy){
				if(!(is_array($terms) && count($terms))) {
					return $terms;
				}

				$return = array();
				$keys   = array();

				foreach($terms as $item) {
					if(!($item instanceof \WP_Term)) {
						continue;
					}

					if(!in_array($item->term_id, $keys)) {
						$keys[]   = $item->term_id;
						$return[] = $item;
					}
				}

				return $return;
			}, 10, 3);
		}
	}

	/**
	 * @param WP $_wp
	 */
	public function wp_load($_wp){
		global $wp_query, $post;
		static $is_called = false;
		if($is_called) {
			return;
		}
		$is_called = true;


		if($wp_query->is_main_query() && $wp_query->is_404() && function_exists('gt3_option') && !is_admin()) {
			$post_404_page_id = intval(gt3_option('404_page_id'));
			$_post            = is_numeric($post_404_page_id) && $post_404_page_id > 0 ? get_post($post_404_page_id) : null;

			if(!is_null($_post) && 'publish' === $_post->post_status) {
				$post            = $_post;
				$wp_query->post  = $_post;
				$wp_query->posts = [ $_post ];
//								$wp_query->query(array( 'p' => $_post->ID, 'post_type' => 'page', 'pagename' => '' ));
				add_filter('404_template_hierarchy', function($template){
					array_splice($template, 0, 0, array( 'page.php' ));

					return $template;
				});

				add_filter('single_template_hierarchy', function($template){
					array_splice($template, 0, 0, array( 'page.php' ));

					return $template;
				}, 0);

				add_filter( 'body_class', function ( $classes = [] ) {
					$id = get_the_ID();

					$document = Plugin::$instance->documents->get( $id );

					if ( $document && $document->is_built_with_elementor() ) {
						$classes[] = 'elementor-page elementor-page-' . $id;
					}

					return $classes;
				} );


			}
		}
	}

	public function after_setup_theme(){
		$builders = apply_filters('gt3/core/builder_support', array());
		if(!is_array($builders)) {
			$builders = array( $builders );
		}
		foreach($builders as $builder) {
			if($builder == 'elementor') {
				if(!did_action('elementor/loaded')) {
					add_action('admin_notices', array( $this, 'fail_load' ));
				} else {
					require_once __DIR__.'/core/elementor/init.php';
				}
			}
		}

		if(apply_filters('gt3/core/dashboard', false)) {
			DashBoard::instance();
		}

		\GT3\ThemesCore\Webp_Converter::instance();

		if(apply_filters('gt3/core/mega-menu-enable', false)) {
			require_once __DIR__.'/core/gt3_mega_menu/class-gt3_mega_menu.php';
		}
	}
}


if(!function_exists('gt3_themes_core_version')) {
	function gt3_themes_core_version(){
		static $plugin_version = null;
		if(null === $plugin_version) {
			$plugin_data    = get_plugin_data(__FILE__, false, false);
			$plugin_version = $plugin_data['Version'];
		}

		return $plugin_version;
	}
}

GT3_Core_Elementor::instance();

function webpConvert2($file, $compression_quality = 80){
	return \GT3\ThemesCore\Webp_Converter::convert($file, $compression_quality);
}
