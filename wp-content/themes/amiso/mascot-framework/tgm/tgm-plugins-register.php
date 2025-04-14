<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme SampleTGM for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once AMISO_FRAMEWORK_DIR . '/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'amiso_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function amiso_register_required_plugins() {
	$plugins_path = AMISO_FRAMEWORK_DIR . '/tgm/plugins';
	$server_path = 'https://kodesolution.live/plugins/';
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'         	=> 'Mascot Core',
			'slug'         	=> 'mascot-core',
			'source'       	=> $server_path . 'mascot-core-elementor/mascot-core.zip',
			'required'     	=> true,
			'version'      	=> '1.0'
		),
		array(
			'name'         	=> 'Mascot Core - Amiso',
			'slug'         	=> 'mascot-core-amiso',
			'source'       	=> $server_path . 'mascot-core-elementor/mascot-core-amiso.zip',
			'required'     	=> true,
			'version'      	=> '1.0'
		),
		array(
			'name'			=> 'Elementor',
			'slug'			=> 'elementor',
			'required'		=> true
		),
		array(
			'name'         	=> 'One Click Demo Import',
			'slug'         	=> 'one-click-demo-import',
			'required'     	=> true,
		),
		array(
			'name'			=> 'Contact Form 7',
			'slug'			=> 'contact-form-7',
			'required'		=> true
		),
		array(
			'name'         	=> 'Revolution Slider',
			'slug'         	=> 'revslider',
			'source'       	=> $server_path . 'revslider.zip',
			'required'     	=> true,
			'external_url' 	=> 'https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380/?ref=thememascot',
		),

		array(
			'name'               => 'Redux Framework', // The plugin name.
			'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		array(
			'name' 				=> 'Meta Box',
			'slug' 				=> 'meta-box',
			'required' 			=> true,
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		array(
			'name'         	=> 'Meta Box Bundle (Mascot)',
			'slug'         	=> 'mascot-meta-box-bundle',
			'source'       	=> $server_path . 'mascot-meta-box-bundle.zip',
			'required'     	=> true,
		),
		array(
			'name'         	=> 'Qi Addons For Elementor',
			'slug'         	=> 'qi-addons-for-elementor',
			'required'     	=> true,
		),
		array(
			'name'      	=> 'WooCommerce',
			'slug'      	=> 'woocommerce',
			'required'  	=> true
		),
		array(
			'name'			=> 'MailChimp for WordPress Lite',
			'slug'			=> 'mailchimp-for-wp',
			'required'		=> false
		),


	);

	$theme_obj     = wp_get_theme();
	$theme_name    = $theme_obj->get( 'Name' );
	$theme_version = $theme_obj->get( 'Version' );

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'amiso',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '<div class="notice notice-info is-dismissible mt-20">
			<p><strong>Theme Name: </strong>' . $theme_name . '</p>
			<p><strong>Current Version: </strong>' . $theme_version . '</p>
			<p><strong>Note from Author ' . AMISO_AUTHOR . ':</strong> To ensure the latest version of <em>theme required</em> plugins, you must have the latest version of <strong>' . $theme_name . '</strong></p>
			<p>If any of theme required plugins has released new update after the date that we released ' . "{$theme_name} {$theme_version}" . ', we will include the latest version of that plugin in the next update.</p>
		</div>',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
