<?php
/**
 * ThemeMascot functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 */

global $amiso_theme_info;
$amiso_theme_info = wp_get_theme();

if (!function_exists('mascot_core_amiso_plugin_installed')) {
	/**
	 * Core Plugin installed?*/
	function mascot_core_amiso_plugin_installed() {
		return defined( 'MASCOT_CORE_AMISO_VERSION' );
	}
}

if (!function_exists('mascot_core_plugin_installed')) {
	/**
	 * Core Plugin installed?
	 */
	function mascot_core_plugin_installed() {
		return defined( 'MASCOT_CORE_ELEMENTOR_VERSION' );
	}
}

/* VARIABLE DEFINITIONS
================================================== */
define( 'MASCOT_THEME_ACTIVE', 'TRUE' );
define( 'AMISO_AUTHOR', 'ThemeMascot' );
define( 'AMISO_FRAMEWORK_VERSION', '1.0' );
define( 'AMISO_TEMPLATE_URI', get_template_directory_uri() );
define( 'AMISO_TEMPLATE_DIR', get_template_directory() );

define( 'AMISO_ASSETS_URI', AMISO_TEMPLATE_URI . '/assets' );
define( 'AMISO_ASSETS_DIR', AMISO_TEMPLATE_DIR . '/assets' );

define( 'AMISO_ADMIN_ASSETS_URI', AMISO_TEMPLATE_URI . '/admin/assets' );
define( 'AMISO_ADMIN_ASSETS_DIR', AMISO_TEMPLATE_DIR . '/admin/assets' );

define( 'AMISO_FRAMEWORK_FOLDER', 'mascot-framework' );
define( 'AMISO_FRAMEWORK_DIR', AMISO_TEMPLATE_DIR . '/'. AMISO_FRAMEWORK_FOLDER );

define( 'AMISO_THEME_VERSION', $amiso_theme_info->get( 'Version' ) );
define( 'AMISO_POST_EXCERPT_LENGTH', 25 );
define( 'AMISO_MENUZORD_MEGAMENU_BREAKPOINT_BW', '1024px' );
define( 'AMISO_MENUZORD_MEGAMENU_BREAKPOINT_FW', '1025px' );


/* Initial Actions
================================================== */
add_action( 'after_setup_theme', 		'amiso_action_after_setup_theme' );
add_action( 'wp_enqueue_scripts', 		'amiso_action_wp_enqueue_scripts',12 );
add_action( 'widgets_init', 			'amiso_action_widgets_init' );
add_action( 'wp_head', 					'amiso_action_wp_head',1 );
add_action( 'wp_head', 					'amiso_action_wp_head_at_the_end', 100 );

//admin actions
add_action( 'admin_enqueue_scripts',	'amiso_action_theme_admin_enqueue_scripts' );

add_action( 'wp_footer', 				'amiso_action_wp_footer' );


/* MASCOT FRAMEWORK
================================================== */
require_once( AMISO_FRAMEWORK_DIR . '/mascot-framework.php' );



if(!function_exists('amiso_action_after_setup_theme')) {
	/**
	 * After Setup Theme
	 */
	function amiso_action_after_setup_theme() {
		//Theme Support
		global $supported_post_formats;
		$supported_post_formats = array( 'gallery', 'link', 'quote', 'audio', 'video' );

		//This feature enables Post Formats support for this theme
		add_theme_support( 'post-formats', $supported_post_formats );

		//This feature enables Automatic Feed Links for post and comment in the head
		add_theme_support( 'automatic-feed-links' );

		//This feature enables Post Thumbnails support for this theme
		add_theme_support( 'post-thumbnails' );

		//Woocommerce theme suport
		add_theme_support( 'woocommerce' );

		// Custom Backgrounds
		add_theme_support( 'custom-background', array(
			'default-color' => 'fff',
		) );

		//This feature enables plugins and themes to manage the document title tag. This should be used in place of wp_title() function
		add_theme_support( 'title-tag' );

		//This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );


		// add excerpt support for pages
		add_post_type_support( 'page', 'excerpt' );

		//Thumbnail Sizes
		set_post_thumbnail_size( 672, 448, true );
		add_image_size( 'amiso_thumbnail_height', 600, 800, true );
		add_image_size( 'amiso_thumbnail_height_400', 400, 532, true );

		add_image_size( 'amiso_square', 550, 550, true );
		add_image_size( 'amiso_landscape', 1100, 550, true );
		add_image_size( 'amiso_portrait', 550, 1100, true );
		add_image_size( 'amiso_huge_square', 1100, 1100, true );
		add_image_size( 'amiso_square_150', 150, 150, true );

		add_image_size( 'amiso_small_height', 150, 180, true );

		//Content Width
		if ( ! isset( $content_width ) ) $content_width = 1170;

		//Theme Textdomain
		load_theme_textdomain( 'amiso', get_template_directory() . '/languages' );

		//Register Nav Menus
		$register_nav_menus_array = array(
			'primary' 					=> esc_html__( 'Primary Navigation Menu', 'amiso' ),
			'page-404-helpful-links' 	=> esc_html__( 'Page 404 Helpful Links', 'amiso' )
		);

		register_nav_menus( $register_nav_menus_array );
	}
}


if(!function_exists('amiso_action_wp_enqueue_scripts')) {
	/**
	 * Enqueue Script/Style
	 */
	function amiso_action_wp_enqueue_scripts() {
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-tabs');
		wp_enqueue_script( 'jquery-ui-accordion');

		if( !is_admin() ){

			/**
			 * Enqueue Style
			 */

			if( is_rtl() ) {
				wp_enqueue_style( 'bootstrap-rtl', AMISO_TEMPLATE_URI . '/assets/css/bootstrap-rtl.min.css' );
			} else {
				wp_enqueue_style( 'bootstrap', AMISO_TEMPLATE_URI . '/assets/css/bootstrap.min.css' );
			}
			wp_enqueue_style( 'animate', AMISO_TEMPLATE_URI . '/assets/css/animate.min.css' );

			//enable preloader
			wp_register_style( 'amiso-preloader', AMISO_TEMPLATE_URI . '/assets/css/preloader.css' );
			$page_preloader = amiso_get_redux_option( 'general-settings-enable-page-preloader' );
			if( $page_preloader ) {
				wp_enqueue_style( 'amiso-preloader' );
			}

			/**
			 * Enqueue Fonts
			 */
			//font-awesome icons
			wp_deregister_style( 'font-awesome' );
			wp_deregister_style( 'font-awesome-v4-shims' );
			wp_enqueue_style( 'font-awesome-5-all', AMISO_TEMPLATE_URI . '/assets/css/font-awesome5.min.css' );
			wp_enqueue_style( 'font-awesome-4-shim', AMISO_TEMPLATE_URI . '/assets/css/font-awesome-v4-shims.css' );
			//linear icons
			wp_enqueue_style( 'font-linear-icons', AMISO_TEMPLATE_URI . '/assets/fonts/linear-icons/style.css' );



			//google fonts
			wp_enqueue_style( 'amiso-google-fonts', amiso_google_fonts_url(), [], null );

			/**
			 * Enqueue Script
			 */
			wp_enqueue_script( 'html5shiv', AMISO_TEMPLATE_URI . '/assets/js/html5shiv.min.js', array(''), '3.7.3' );
			wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
			wp_enqueue_script( 'respond', AMISO_TEMPLATE_URI . '/assets/js/respond.min.js', array(''), '1.4.2' );
			wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

			wp_enqueue_script( 'bootstrap', AMISO_TEMPLATE_URI . '/assets/js/plugins/bootstrap.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'menuzord', AMISO_TEMPLATE_URI . '/assets/js/plugins/menuzord/js/menuzord.js', array('jquery'), false, true );

			//external plugins single file:
			wp_enqueue_script( 'jquery-appear', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery.appear.js', array('jquery'), false, true );
			wp_enqueue_script( 'isotope', AMISO_TEMPLATE_URI . '/assets/js/plugins/isotope.pkgd.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'jquery-scrolltofixed', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery-scrolltofixed-min.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-easing', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery.easing.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-fitvids', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery.fitvids.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-lettering', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery.lettering.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-textillate', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery.textillate.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-nice-select', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery-nice-select/jquery.nice-select.min.js', array('jquery'), false, true );
			wp_enqueue_style( 'nice-select', AMISO_TEMPLATE_URI . '/assets/js/plugins/jquery-nice-select/nice-select.css' );
			wp_enqueue_script( 'wow', AMISO_TEMPLATE_URI . '/assets/js/plugins/wow.min.js', null, false, true );

			//Theme Custom JS
			wp_enqueue_script( 'mascot-custom', AMISO_TEMPLATE_URI . '/assets/js/custom.js', array('jquery'), false, true );

			//Enqueue comment-reply.js
			if ( is_singular() && comments_open() && get_option('thread_comments') ) {
				wp_enqueue_script( 'comment-reply' );
			}

			if(defined('ELEMENTOR_VERSION')) {
				//enqued elementor frontend in all pages due to FOUC
				wp_enqueue_style( 'elementor-frontend' );
			}

			//style main for this theme
			$direction_suffix = is_rtl() ? '-rtl' : '';
			wp_enqueue_style( 'amiso-style-main', AMISO_TEMPLATE_URI . '/assets/css/style-main' . $direction_suffix . '.css', array(), AMISO_THEME_VERSION );

			//woo
			if ( amiso_is_woocommerce_page() ) {
				wp_enqueue_style( 'amiso-woo-shop', AMISO_TEMPLATE_URI . '/assets/css/shop/woo-shop' . $direction_suffix . '.css', array('amiso-style-main') );
				wp_enqueue_style( 'amiso-woo-shop-single', AMISO_TEMPLATE_URI . '/assets/css/shop/shop-single' . $direction_suffix . '.css', array('amiso-style-main') );
			}
			if ( amiso_exists_woocommerce() ) {
				wp_register_style( 'amiso-woo-shop-mini-cart', AMISO_TEMPLATE_URI . '/assets/css/shop/shop-mini-cart' . $direction_suffix . '.css', array('amiso-style-main') );
			}


			//Typography Set from metabox
			$mascot_primary_typography_set = '';
			$page_metabox_change_typography = amiso_get_rwmb_group( 'amiso_' . "page_mb_typography_settings", 'change_typography', amiso_get_page_id() );
			if( $page_metabox_change_typography ) {
				//Theme Color from page meta box
				$mascot_primary_typography_set = amiso_get_rwmb_group( 'amiso_' . "page_mb_typography_settings", 'primary_typography_set', amiso_get_page_id() );
			}
			if( !empty($mascot_primary_typography_set) ) {
				wp_enqueue_style( 'amiso-primary-typography-set', AMISO_TEMPLATE_URI . '/assets/css/typography/' . $mascot_primary_typography_set );
			}








			//Theme Color
			$mascot_primary_theme_color = '';
			$page_metabox_change_primary_theme_color = amiso_get_rwmb_group( 'amiso_' . "page_mb_theme_color_settings", 'change_primary_theme_color', amiso_get_page_id() );

			if( $page_metabox_change_primary_theme_color ) {
				//Theme Color from page meta box
				$mascot_primary_theme_color = amiso_get_rwmb_group( 'amiso_' . "page_mb_theme_color_settings", 'primary_theme_color', amiso_get_page_id() );

			} else if ( !_empty( amiso_get_redux_option( 'theme-color-settings-theme-color-type' ) ) ) {
				//Theme Color from Theme Options
				if( amiso_get_redux_option( 'theme-color-settings-theme-color-type' ) == 'predefined' ) {
					//Primary Theme Color
					$mascot_primary_theme_color = !_empty( amiso_get_redux_option( 'theme-color-settings-primary-theme-color' ) ) ? amiso_get_redux_option( 'theme-color-settings-primary-theme-color' ) : '';
				} else if ( amiso_get_redux_option( 'theme-color-settings-theme-color-type' ) == 'custom' ) {
					//Custom Theme Color
					$redux_css_file_name = amiso_get_redux_option( 'theme-color-settings-custom-theme-color-filename' );
					if( !empty( $redux_css_file_name ) ) {
						$mascot_primary_theme_color = $redux_css_file_name . '.css';
					} else if ( !is_multisite() ) {
						if ( file_exists( AMISO_ASSETS_DIR . '/css/colors/custom-theme-color.css' ) ) {
							$mascot_primary_theme_color = 'custom-theme-color.css';
						}
					} else {
						if ( file_exists( AMISO_ASSETS_DIR . '/css/colors/custom-theme-color-msid-' . amiso_get_multisite_blog_id() . '.css' ) ) {
							$mascot_primary_theme_color = 'custom-theme-color-msid-' . amiso_get_multisite_blog_id() . '.css';
						}
					}
				}
			} else {
				$mascot_primary_theme_color = 'theme-skin-color-set1.css';
			}

			wp_enqueue_style( 'amiso-primary-theme-color', AMISO_TEMPLATE_URI . '/assets/css/colors/' . $mascot_primary_theme_color );


			//Attach Premade CSS File into the header
			$mascot_premade_sitewise_css_file = amiso_get_redux_option( 'theme-color-settings-premade-sitewise-css-file' );
			if( !empty($mascot_premade_sitewise_css_file) ) {
				wp_enqueue_style( 'amiso-premade-sitewise-css-file', AMISO_TEMPLATE_URI . '/assets/css/sites/' . $mascot_premade_sitewise_css_file );
			}


			if( is_rtl() ) {
				wp_enqueue_style( 'amiso-style-main-rtl-extra', AMISO_TEMPLATE_URI . '/assets/css/style-main-rtl-extra.css' );
			}

			//Dynamic Style
			if ( !is_multisite() ) {
				if ( mascot_core_amiso_plugin_installed() && file_exists( AMISO_ASSETS_DIR . '/css/dynamic-style.css' ) ) {
					wp_enqueue_style( 'amiso-dynamic-style', AMISO_TEMPLATE_URI . '/assets/css/dynamic-style.css' );
				}
			} else {
				if ( mascot_core_amiso_plugin_installed() && file_exists( AMISO_ASSETS_DIR . '/css/dynamic-style-msid-' . amiso_get_multisite_blog_id() . '.css' ) ) {
					wp_enqueue_style( 'amiso-dynamic-style', AMISO_TEMPLATE_URI . '/assets/css/dynamic-style-msid-' . amiso_get_multisite_blog_id() . '.css' );
				}
			}

		}
	}
}



if(!function_exists('amiso_action_theme_admin_enqueue_scripts')) {
	/**
	 * Add Admin Scripts
	 */
	function amiso_action_theme_admin_enqueue_scripts() {
		wp_enqueue_style( 'font-awesome', AMISO_TEMPLATE_URI . '/assets/css/font-awesome5.min.css' );
		wp_enqueue_style( 'amiso-custom-admin', AMISO_TEMPLATE_URI . '/admin/assets/css/custom-admin.css' );
		wp_enqueue_script( 'amiso-admin', AMISO_TEMPLATE_URI . '/admin/assets/js/admin.js', array('jquery'), null, true );
	}
}



if(!function_exists('amiso_detect_elementor_and_add_class')) {
	/**
	 * Detect Elementor Enabled in Page Content and then add class to body
	 */
	function amiso_detect_elementor_and_add_class( $classes ) {
		$elementor_enabled = false;
		if ( did_action( 'elementor/loaded' ) ) {
			$elementor_enabled = true;
		}
		if (  is_archive() ) {
			$classes[] = 'tm_elementor_page_status_false';
		} else if (  is_search() ) {
			$classes[] = 'tm_elementor_page_status_false';
		} else if ( is_singular( 'portfolio-items' ) ) {
			$classes[] = 'tm_elementor_page_status_false';
		} else if ( $elementor_enabled != 'false' && $elementor_enabled == true ) {
			$classes[] = 'tm_elementor_page_status_true';
		} else {
			$classes[] = 'tm_elementor_page_status_false';
		}
		return $classes;
	}
	add_filter( 'body_class','amiso_detect_elementor_and_add_class' );
}



if(!function_exists('amiso_google_fonts_url')) {
	/**
	 * @return string Google fonts URL
	 */
	function amiso_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		//fonts
		$fonts = apply_filters( 'amiso_google_web_fonts', $fonts );

		//font subsets
		$subsets = apply_filters('amiso_google_font_subset', 'latin,latin-ext');

		if ( !empty( $fonts ) ) {
			foreach ($fonts as $key => $value) {
				$fonts[$key] = "family=" . $value;
			}
		}
		$fonts_url = implode( '&', $fonts );
		$fonts_url = '//fonts.googleapis.com/css2?' . $fonts_url. '&display=swap';

		return $fonts_url;
	}
}


if(!function_exists('amiso_primary_google_fonts')) {
	/**
	 * @return primary google fonts used in this theme
	 */
	function amiso_primary_google_fonts( $fonts ) {

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'amiso' ) ) {
			$fonts[] = 'Manrope:wght@400;500;600;700;800';
			$fonts[] = 'DM+Sans:wght@400;500;700';
		}

		return $fonts;
	}
	add_filter( 'amiso_google_web_fonts', 'amiso_primary_google_fonts' );
}

if(!function_exists('amiso_wrap_embed_with_div')) {
	function amiso_wrap_embed_with_div( $cache, $url, $attr, $post_ID ) {
		$classes = array();

		// Add these classes to all embeds.
		$classes_all = array(
			'tm-responsive-video-wrapper',
		);

		// Check for different providers and add appropriate classes.

		if ( false !== strpos( $url, 'vimeo.com' ) ) {
			$classes[] = 'tm-responsive-video';
			$classes[] = 'video-vimeo';
		}

		if ( false !== strpos( $url, 'youtube.com' ) ) {
			$classes[] = 'tm-responsive-video';
			$classes[] = 'video-youtube';
		}

		if ( false !== strpos( $url, 'wordpress.tv' ) ) {
			$classes[] = 'tm-responsive-video';
			$classes[] = 'video-videopress';
		}

		$classes = array_merge( $classes, $classes_all );

		return '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . $cache . '</div>';
	}
	add_filter( 'embed_oembed_html', 'amiso_wrap_embed_with_div', 99, 4 );
}

if(!function_exists('amiso_override_mce_options')) {
	function amiso_override_mce_options($initArray) {
		$opts = '*[*]';
		$initArray['valid_elements'] = $opts;
		$initArray['extended_valid_elements'] = $opts;
		return $initArray;
	}
	add_filter('tiny_mce_before_init', 'amiso_override_mce_options');
}
