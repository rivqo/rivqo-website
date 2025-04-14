<?php

define( 'MASCOT_CORE_ELEMENTOR_VERSION', '1' );
define( 'MASCOT_CORE_ELEMENTOR_ABS_PATH', plugin_dir_path( __FILE__ ) );
define( 'MASCOT_CORE_ELEMENTOR_URL_PATH', plugin_dir_url( __FILE__ ) );


define( 'MASCOT_CORE_ELEMENTOR_ASSETS_URI', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets' );
define( 'MASCOT_CORE_ELEMENTOR_ASSETS_DIR', MASCOT_CORE_ELEMENTOR_ABS_PATH . 'assets' );


if ( ! defined( 'TM_ELEMENTOR_WIDGET_BADGE' ) ) {
	define( 'TM_ELEMENTOR_WIDGET_BADGE', '<span class="tm-elementor-widget-badge"></span>' );
}//Add prefix for all widgets 