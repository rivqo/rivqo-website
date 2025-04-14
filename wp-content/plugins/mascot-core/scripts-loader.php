<?php

if ( ! class_exists( 'MascotCoreElementorScriptsHandler' ) ) {
	/**
	 * Main theme class with configuration
	 */
	class MascotCoreElementorScriptsHandler {
		private static $instance;
		
		public function __construct() {
			
			// Include required files
			require_once( 'constants.php' );
			
			
			// Include theme's script and localize theme's main js script
			add_action( 'wp_enqueue_scripts', array( $this, 'include_js_scripts' ) );
			
			// Include theme's 3rd party plugins styles
			add_action( 'mascot_core_action_before_main_css', array( $this, 'include_plugins_styles' ) );

			// Include theme's 3rd party plugins scripts
			add_action( 'mascot_core_action_before_main_js', array( $this, 'include_plugins_scripts' ) );
			
		}
		
		public static function get_instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		function include_js_scripts() {
			// JS dependency variable
			$main_js_dependency  = apply_filters( 'mascot_core_filter_main_js_dependency', array( 'jquery' ) );
			
			// Hook to include additional scripts before theme's main script
			do_action( 'mascot_core_action_before_main_js', $main_js_dependency );
			
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				// Enqueue theme's main script
				wp_enqueue_script( ' mascot-core-custom-elementor', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/custom-elementor.js', $main_js_dependency, false, true );
			}
			
			// Hook to include additional scripts after theme's main script
			do_action( 'mascot_core_action_after_main_js' );
		}
		
		function include_plugins_styles() {
		}
		
		function include_plugins_scripts() {
			
			// JS dependency variables
			$js_3rd_party_dependency = apply_filters( 'mascot_core_filter_js_3rd_party_dependency', 'jquery' );




			$direction_suffix = is_rtl() ? '.rtl' : '';
			
			// Enqueue 3rd party plugins script
			wp_register_script( 'owl-carousel', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/owl-carousel/owl.carousel.min.js', $js_3rd_party_dependency, false, true );
			wp_register_script( 'jquery-owl-filter', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/owl-carousel/jquery.owl-filter.js', $js_3rd_party_dependency, false, true );
			wp_register_script( 'owl-carousel2-thumbs', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/owl.carousel2.thumbs.min.js', $js_3rd_party_dependency, false, true );
			wp_enqueue_style( 'owl-carousel', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/owl-carousel/assets/owl.carousel.min.css' );
			wp_enqueue_script( 'owl-carousel' );
			wp_enqueue_script( 'jquery-owl-filter' );
			wp_enqueue_script( 'owl-carousel2-thumbs' );

			
			wp_register_script( 'jquery-animatenumbers', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.animatenumbers.min.js', $js_3rd_party_dependency, false, true );
			wp_enqueue_script( 'jquery-animatenumbers' );
			wp_register_script( 'jquery-easypiechart', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.easypiechart.min.js', $js_3rd_party_dependency, false, true );
			wp_enqueue_script( 'jquery-easypiechart' );


			//bxslider
			wp_register_script( 'jquery-bxslider', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/bxslider/jquery.bxslider.min.js', array('jquery'), false, true );
			wp_register_style( 'bxslider', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/bxslider/jquery.bxslider.min.css' );

			//slick
			wp_register_script( 'slick', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/slick/slick.js', array('jquery'), false, true );
			wp_register_style( 'slick', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/slick/slick.css' );
			wp_register_style( 'slick-theme', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/slick/slick-theme.css' );




			//external plugins js & css:
			//used when needed:

			wp_register_script( 'lightgallery', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/lightgallery/js/lightgallery.min.js', array('jquery'), false, true );
			wp_register_style( 'lightgallery', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/lightgallery/css/lightgallery.min.css' );
			wp_register_script( 'jquery-mousewheel', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.mousewheel.min.js', array('jquery'), false, true );
			wp_register_script( 'mediko-custom-lightgallery', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/custom-lightgallery.js', array('jquery'), false, true );


			


			wp_register_script( 'jquery-parallax-scroll', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.parallax-scroll.js', array('jquery'), false, true );


			wp_register_script( 'sticky-sidebar', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/sticky-sidebar.min.js', null, false, true );
			wp_register_script( 'sticky-kit', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/sticky-kit.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-tilt', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.tilt.min.js', array('jquery'), false, true );



			wp_register_script( 'menufullpage', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/menufullpage/menufullpage.min.js', array('jquery'), false, true );
			wp_register_script( 'matchHeight', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.matchHeight-min.js', array('jquery'), false, true );

		}
	}
	
	MascotCoreElementorScriptsHandler::get_instance();
}