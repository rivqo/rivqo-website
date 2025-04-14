<?php
/**
 *
Plugin Name: Mascot Core
Plugin URI:  https://themeforest.net/user/thememascot/portfolio
Description: Mascot Core Plugin for Elementor. It includes all the required Shortcodes needed by Elementor.
Version:     4.0
Author:      ThemeMascot
Author URI:  https://themeforest.net/user/thememascot/portfolio
Text Domain: mascot-core
Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Mascot Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.0.0
 */
final class Mascot_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		if ( !defined('ELEMENTOR_VERSION') ) {
			return; // Exit if accessed directly.
		}

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'mascot-core' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( defined('ELEMENTOR_VERSION') && ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

        // load icons
        add_filter('elementor/icons_manager/additional_tabs', array($this, 'add_elementor_custom_icons'));

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'constants.php' );
		require_once( 'functions.php' );
		require_once( 'functions2.php' );

		if ( class_exists( 'Give' ) ) {
			require_once( 'give-functions.php' );
		}

		require_once( 'scripts-loader.php' );
		require_once( 'shortcode-loader.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mascot-core' ),
			'<strong>' . esc_html__( 'Mascot Core', 'mascot-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mascot-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mascot-core' ),
			'<strong>' . esc_html__( 'Mascot Core', 'mascot-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mascot-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}


	/**
	 * Add Custom Icon
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function add_elementor_custom_icons($array)
    {
        $array['mascot-linear-icons'] = [
            'name'          => 'mascot-linear-icons',
            'label'         => 'Linear Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/linear-icons/style.css',
            ),
            'prefix'        => 'lnr-',
            'displayPrefix' => 'lnr',
            'labelIcon'     => 'lnr lnr-icon-home',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/linear-icons/icon-list.js',
            'native'        => 1,
        ];
        $array['mascot-icon-business'] = [
            'name'          => 'mascot-icon-business',
            'label'         => 'Business Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-set-business/style.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'flaticon-business-002-graph',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-set-business/icon-list.js',
            'native'        => 1,
        ];
        $array['mascot-icon-common'] = [
            'name'          => 'mascot-icon-common',
            'label'         => 'Common Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-set-common/style.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'flaticon-common-research',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-set-common/icon-list.js',
            'native'        => 1,
        ];
        $array['mascot-contact-icon'] = [
            'name'          => 'mascot-contact-icon',
            'label'         => 'Contact Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-set-contact/style.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'flaticon-contact-001-send-mail',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-set-contact/icon-list.js',
            'native'        => 1,
        ];
        $array['mascot-shop-icon'] = [
            'name'          => 'mascot-shop-icon',
            'label'         => 'Shop Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-shop/style.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'flaticon-shop-002-armchair',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/flaticon-shop/icon-list.js',
            'native'        => 1,
        ];
        return $array;
    }

    /**
     * register fallback theme functions
     *
     * @return void
     */
    public function theme_fallback()
    {

        // custom kses allowed html
        if (!function_exists('mascot_core_kses_allowed_html')) :
            function mascot_core_kses_allowed_html($tags, $context)
            {
                switch ($context) {
                    case 'mascot_core_allowed_tags':
                        $tags = array(
                            'a' => array('href' => array(), 'class' => array()),
                            'b' => array(),
                            'br' => array(),
                            'span' => array('class' => array()),
                            'img' => array('class' => array()),
                            'i' => array('class' => array()),
                            'p' => array('class' => array()),
                            'ul' => array('class' => array()),
                            'li' => array('class' => array()),
                            'div' => array('class' => array()),
                            'strong' => array()
                        );
                        return $tags;
                    default:
                        return $tags;
                }
            }

            add_filter('wp_kses_allowed_html', 'mascot_core_kses_allowed_html', 10, 2);

        endif;
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mascot-core' ),
			'<strong>' . esc_html__( 'Mascot Core', 'mascot-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mascot-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}


if( !function_exists('mascot_core_theme_active') ) {
	/**
	* Checks whether theme is installed or not
	* @return bool
	*/
	function mascot_core_theme_active() {
		return defined('MASCOT_THEME_ACTIVE');
	}
}



if (!function_exists('mascot_core_get_fa_icons')) :

    function mascot_core_get_fa_icons()
    {
        $data = get_transient('mascot_core_fa_icons');

        if (empty($data)) {
            global $wp_filesystem;
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();

            $fontAwesome_file =   MASCOT_CORE_ELEMENTOR_ABS_PATH . 'assets/fontawesome/css/all.min.css';

            $content = '';

            if ($wp_filesystem->exists($fontAwesome_file)) {
                $content = $wp_filesystem->get_contents($fontAwesome_file);
            } // End If Statement


            $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s*{\s*content/';

            $subject = $content;

            preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

            $all_matches = $matches;

            $icons = array();


            foreach ($all_matches as $match) {
                // $icons[] = array('value' => $match[1], 'label' => $match[1]);
                $icons[] = $match[1];
            }


            $data = $icons;
            set_transient('mascot_core_fa_icons', $data, 10); // saved for one week
        }
        return array_combine($data, $data); // combined for key = value
    }


endif;
// Instantiate Mascot_Core.
new Mascot_Core();


if( !function_exists('mascot_core_theme_active') ) {
	/**
	* Checks whether theme is installed or not
	* @return bool
	*/
	function mascot_core_theme_active() {
		return defined('MASCOT_THEME_ACTIVE');
	}
}