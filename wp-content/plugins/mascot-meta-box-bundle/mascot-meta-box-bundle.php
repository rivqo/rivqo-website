<?php
/*
Plugin Name: Meta Box Bundle (Mascot)
Plugin URI:  https://themeforest.net/user/thememascot/portfolio
Description: Everything you need for custom fields.
Version:     2.0
Author:      ThemeMascot
Author URI:  https://themeforest.net/user/thememascot/portfolio
Text Domain: mascot-meta-box-bundle
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $mascot_core_metabox_bundle_plugin_dir_path;
$mascot_core_metabox_bundle_plugin_dir_path = plugin_dir_path( __FILE__ );


require_once $mascot_core_metabox_bundle_plugin_dir_path . 'load-lib-ext-plugins.php';