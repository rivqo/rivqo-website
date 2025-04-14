<?php

/* Loads all Custom Post Types located in post-types folder
================================================== */
require_once MASCOT_CORE_AMISO_ABS_PATH . 'lib/interface-post-type.php';

foreach( glob( MASCOT_CORE_AMISO_ABS_PATH . 'inc/post-types/*/loader.php' ) as $each_cpt_loader ) {
	require_once $each_cpt_loader;
}

//load shortcodes for custom-post-types
require_once MASCOT_CORE_AMISO_ABS_PATH . 'inc/post-types/reg-post-type.php';

use MASCOTCOREAMISO\CPT;
use MASCOTCOREAMISO\Lib;

// activate custom post types
function mascot_core_amiso_reg_custom_post_types() {
    CPT\Reg_Post_Type::get_instance()->register();
}

// flush_rewrite_rules after activating cpt
if ( ! function_exists( 'mascot_core_amiso_myplugin_flush_rewrites' ) ) {
	function mascot_core_amiso_myplugin_flush_rewrites() {
		// call your CPT registration function here (it should also be hooked into 'init')
		mascot_core_amiso_reg_custom_post_types();
		//and flush the rules.
		flush_rewrite_rules();
	}
	register_activation_hook( __FILE__, 'mascot_core_amiso_myplugin_flush_rewrites' );
}

//init cpt
add_action('init', 'mascot_core_amiso_reg_custom_post_types', 4);

//widgets loader
require_once MASCOT_CORE_AMISO_ABS_PATH . 'inc/widgets/widgets-loader.php';
