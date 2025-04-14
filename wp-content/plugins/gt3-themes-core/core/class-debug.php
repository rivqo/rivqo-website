<?php

namespace GT3\ThemesCore;

use GT3\ThemesCore\Assets\Script;
use GT3\ThemesCore\Assets\Style;

final class Debug {
	private $data = array();

	private static $instance = null;

	/** @return \GT3\ThemesCore\Assets */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}


	private function __construct(){
		if (!key_exists('gt3-debug', $_GET) || !isset($_GET['gt3-debug']) || !current_user_can('manage_options')) {
			return;
		}
		add_filter('template_include', array( $this, 'filter_template_include' ), 999);
		add_action('template_redirect', array( $this, 'action_template_redirect' ));
		add_action('wp_footer', array( $this, 'footer' ));
	}

	public function footer(){
		global $wp_scripts, $wp_styles;
		if(function_exists('is_woocommerce_activated')) {
			$this->data['is_woocommerce_activated'] = is_woocommerce_activated();
		}

		$this->get_data();
		$this->get_if();

		foreach($wp_scripts->queue as $k => $v) {
			if(isset($wp_scripts->registered[$v]->src)) {
				$this->data['scripts'][$v] = str_replace($wp_scripts->base_url, '', $wp_scripts->registered[$v]->src);
			}
		}
		foreach($wp_styles->done as $k => $v) {
			$this->data['styles'][$v] = str_replace($wp_scripts->base_url, '', $wp_styles->registered[$v]->src);
		}

		echo '<div id="gt3-debug-wrapper"></div>';
		Style::enqueue_core_asset('debug');

		wp_enqueue_script('gt3-core/debug', Script::get_base_url().'debug.js', array('react','react-dom'), GT3_CORE_ELEMENTOR_VERSION);
		wp_add_inline_script('gt3-core/debug', ';window.gt3_debug_data='.json_encode($this->data).';', 'before');
	}

	private function get_if(){
		$conds = array(
			'is_404',
			'is_admin',
			'is_archive',
			'is_attachment',
			'is_author',
			'is_blog_admin',
			'is_category',
			'is_comment_feed',
			'is_customize_preview',
			'is_date',
			'is_day',
			'is_embed',
			'is_feed',
			'is_front_page',
			'is_home',
			'is_main_network',
			'is_main_site',
			'is_month',
			'is_network_admin',
			'is_page',
			'is_page_template',
			'is_paged',
			'is_post_type_archive',
			'is_preview',
			'is_robots',
			'is_rtl',
			'is_search',
			'is_single',
			'is_singular',
			'is_ssl',
			'is_sticky',
			'is_tag',
			'is_tax',
			'is_time',
			'is_trackback',
			'is_user_admin',
			'is_year',
			'is_woocommerce',
			'is_shop',
			'is_product_taxonomy',
			'is_product_category',
			'is_product_tag',
			'is_product',
			'is_cart',
			'is_checkout',
			'is_checkout_pay_page',
			'is_wc_endpoint_url',
			'is_account_page',
			'is_view_order_page',
			'is_edit_account_page',
			'is_order_received_page',
			'is_lost_password_page',
			'is_ajax',
			'is_store_notice_showing',
			'is_filtered',
			'wc_tax_enabled',
			'wc_shipping_enabled',
			'wc_prices_include_tax',
			'wc_site_is_https',
			'wc_checkout_is_https',
			'is_add_payment_method_page',
		);

		$true = $false = $na = array();

		foreach($conds as $cond) {
			if(function_exists($cond)) {
				if(('is_sticky' === $cond) and !get_post($id = null)) {
					$false[] = $cond;
				} else if(!is_multisite() and in_array($cond, array( 'is_main_network', 'is_main_site' ))) {
					$na[] = $cond;
				} else {
					if(call_user_func($cond)) {
						$true[] = $cond;
					} else {
						$false[] = $cond;
					}
				}
			} else {
				$na[] = $cond;
			}
		}
		$this->data['conds'] = compact('true', 'false', 'na');
	}


	private function get_data(){
		if(!empty($this->data['template_path'])) {
			$template_path                     = $this->standard_dir(self::normalize_path($this->data['template_path']));
			$stylesheet_directory              = $this->standard_dir(get_stylesheet_directory());
			$template_directory                = $this->standard_dir(get_template_directory());
			$theme_directory                   = $this->standard_dir(get_theme_root());
			$template_file                     = str_replace(array( $stylesheet_directory, $template_directory, ABSPATH ), '', $template_path);
			$template_file                     = ltrim($template_file, '/');
			$theme_template_file               = str_replace(array( $theme_directory, ABSPATH ), '', $template_path);
			$theme_template_file               = ltrim($theme_template_file, '/');
			$this->data['template_path']       = str_replace(self::normalize_path(WP_CONTENT_DIR), '', $template_path);
			$this->data['template_file']       = $template_file;
			$this->data['theme_template_file'] = $theme_template_file;
			foreach(get_included_files() as $file) {
				$filename = str_replace(
					array(
						$stylesheet_directory,
						$template_directory,
					), '', $file
				);
				if($filename !== $file) {
					$slug          = trim(str_replace('.php', '', $filename), '/');
					$display       = trim($filename, '/');
					$theme_display = trim(str_replace($theme_directory, '', $file), '/');
					if(did_action("get_template_part_{$slug}")) {
						$this->data['template_parts'][$file]       = $display;
						$this->data['theme_template_parts'][$file] = $theme_display;
					} else {
						$slug = trim(preg_replace('|\-[^\-]+$|', '', $slug), '/');
						if(did_action("get_template_part_{$slug}")) {
							$this->data['template_parts'][$file]       = $display;
							$this->data['theme_template_parts'][$file] = $theme_display;
						}
					}
				}
			}
		}

		$stylesheet = get_stylesheet();
		$template   = get_template();

		$child = wp_get_theme($stylesheet);

		$theme               = wp_get_theme($template);
		$this->data['theme'] = array(
			'name'           => $theme->get('Name'),
			'version'        => $theme->get('Version'),
			'stylesheet'     => $stylesheet,
			'template'       => $template,
			'is_child_theme' => ($stylesheet !== $template) ? true : false
		);

		$this->data['child'] = array(
			'name'    => $child->get('Name'),
			'version' => $child->get('Version'),
		);

		$isPost = false;
		$isTax  = false;

		$queried_object = array(
			'type' => null,
		);

		if(is_front_page() && is_home()) {
			$queried_object['type'] = 'default_homepage'; // Default homepage

		} else if(is_front_page()) {
			$queried_object['type'] = 'static_homepage'; // Static homepage

			$_qo = get_queried_object();
			if($_qo instanceof \WP_Post) {
				$queried_object = array(
					'type'      => 'static_homepage',
					'sh_type'   => $_qo->post_type,
					'sh_id'     => $_qo->ID,
					'sh_status' => $_qo->post_status
				);

			}
		} else if(is_home()) {
			$queried_object['type'] = 'blog_page'; // Blog page
		} else {
			$_qo = get_queried_object();
			if($_qo instanceof \WP_Post) {
				$queried_object = array(
					'type'        => 'post',
					'post_type'   => $_qo->post_type,
					'post_id'     => $_qo->ID,
					'post_status' => $_qo->post_status
				);
			} else if($_qo instanceof \WP_Term) {
				$queried_object = array(
					'type'              => 'taxonomy',
					'taxonomy_taxonomy' => $_qo->taxonomy,
					'taxonomy_id'       => $_qo->term_id,
				);
			} else {
				$queried_object['type'] = 'error';
			}
		}

		$this->data['queried_object'] = $queried_object;

		if(isset($this->data['body_class'])) {
			asort($this->data['body_class']);
		}
	}

	public function action_template_redirect(){
		foreach($this->get_query_template_names() as $template => $conditional) {
			if(function_exists($conditional) && call_user_func($conditional)) {
				$filter = str_replace('_', '', $template);
				add_filter("{$filter}_template_hierarchy", array( $this, 'filter_template_hierarchy' ), 999);
				call_user_func("get_{$template}_template");
				remove_filter("{$filter}_template_hierarchy", array( $this, 'filter_template_hierarchy' ), 999);
			}
		}
	}

	public function filter_template_include($template_path){
		$this->data['template_path'] = $template_path;

		return $template_path;
	}

	private function get_query_template_names(){
		return array(
			'embed'             => 'is_embed',
			'404'               => 'is_404',
			'search'            => 'is_search',
			'front_page'        => 'is_front_page',
			'home'              => 'is_home',
			'post_type_archive' => 'is_post_type_archive',
			'taxonomy'          => 'is_tax',
			'attachment'        => 'is_attachment',
			'single'            => 'is_single',
			'page'              => 'is_page',
			'singular'          => 'is_singular',
			'category'          => 'is_category',
			'tag'               => 'is_tag',
			'author'            => 'is_author',
			'date'              => 'is_date',
			'archive'           => 'is_archive',
			'index'             => '__return_true'
		);
	}

	public static function normalize_path($path){
		if(function_exists('wp_normalize_path')) {
			$path = wp_normalize_path($path);
		} else {
			$path = str_replace('\\', '/', $path);
			$path = str_replace('//', '/', $path);
		}

		return $path;
	}

	public static function standard_dir($dir, $path_replace = null){
		$dir = self::normalize_path($dir);
		if(is_string($path_replace)) {
			if(!self::$abspath) {
				self::$abspath     = self::normalize_path(ABSPATH);
				self::$contentpath = self::normalize_path(dirname(WP_CONTENT_DIR).'/');
			}
			$dir = str_replace(
				array(
					self::$abspath,
					self::$contentpath,
				), $path_replace, $dir
			);
		}

		return $dir;

	}

	public function filter_template_hierarchy(array $templates){
		if(!isset($this->data['template_hierarchy'])) {
			$this->data['template_hierarchy'] = array();
		}
		$this->data['template_hierarchy'] = array_merge($this->data['template_hierarchy'], $templates);

		return $templates;
	}
}
