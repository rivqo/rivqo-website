<?php
/**
 *
Plugin Name: Mascot Core - Amiso
Plugin URI:  https://themeforest.net/user/thememascot/portfolio
Description: Mascot Core Plugin for Elementor. It includes all the required Shortcodes needed by Elementor.
Version:     3.0
Author:      ThemeMascot
Author URI:  https://themeforest.net/user/thememascot/portfolio
Text Domain: mascot-core-amiso
Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Mascot Core - Amiso Elementor Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.0.0
 */
final class Mascot_Core_Amiso_Elementor {

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
		define( 'MASCOT_CORE_AMISO_VERSION', '1' );
		define( 'MASCOT_CORE_AMISO_ABS_PATH', plugin_dir_path( __FILE__ ) );
		define( 'MASCOT_CORE_AMISO_URL_PATH', plugin_dir_url( __FILE__ ) );
		define( 'MASCOT_CORE_AMISO_ASSETS_URI', MASCOT_CORE_AMISO_URL_PATH. 'assets' );

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enque_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enque_scripts' ) );
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
		load_plugin_textdomain( 'mascot-core-amiso' );
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
		//update elementor default value
		if(empty(get_option('elementor_allow_svg', ''))) update_option( 'elementor_allow_svg', 1 );
		if(empty(get_option('elementor_load_fa4_shim', ''))) update_option( 'elementor_load_fa4_shim', 'yes' );
		if(empty(get_option('elementor_disable_color_schemes', ''))) update_option( 'elementor_disable_color_schemes', 'yes' );
		if(empty(get_option('elementor_disable_typography_schemes', ''))) update_option( 'elementor_disable_typography_schemes', 'yes' );

		// Check if Elementor installed and activated
		if ( ! class_exists( 'Mascot_Core' ) ) {
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


		/* Custom Nav Walker menu icon
		================================================== */
		require_once( 'assets/flaticon-set-agency/menu-icon.php' );


		require_once( 'functions.php' );
		require_once( 'functions-woo.php' );
		require_once( 'load-lib-ext-plugins.php' );
		require_once( 'load-cpt-sc.php' );
		require_once( 'load-other.php' );
		require_once( 'shortcode-loader.php' );

	}

	/**
	 * enque style
	 */
	public function admin_enque_scripts() {
		wp_enqueue_style( 'mascot-core-custom-admin', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/custom-admin.css' );
	}

	public function enque_scripts() {
		if (function_exists('woosw_init')) {
			//wp_enqueue_script('mascot-core-wishlist', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/woo/wishlist.js', array('jquery'), MASCOT_CORE_AMISO_VERSION, true);
		}
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
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mascot-core-amiso' ),
			'<strong>' . esc_html__( 'Mascot Core - Amiso', 'mascot-core-amiso' ) . '</strong>',
			'<strong>' . esc_html__( 'Mascot Core', 'mascot-core-amiso' ) . '</strong>'
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mascot-core-amiso' ),
			'<strong>' . esc_html__( 'Mascot Core - Amiso Elementor', 'mascot-core-amiso' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mascot-core-amiso' ) . '</strong>',
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
    public function add_elementor_custom_icons($settings)
    {
        $settings['flaticon-set-business'] = [
            'name'          => 'flaticon-set-business',
            'label'         => 'Amiso Business Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_AMISO_URL_PATH . 'assets/flaticon-set-business/style.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'flaticon-business-002-graph',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_AMISO_URL_PATH . 'assets/flaticon-set-business/icon-list.js',
            'native'        => 1,
        ];
        $settings['flaticon-set-agency'] = [
            'name'          => 'flaticon-set-agency',
            'label'         => 'Amiso Agency Icons',
            'url'           => '',
            'enqueue'       => array(
                MASCOT_CORE_AMISO_URL_PATH . 'assets/flaticon-set-agency/style.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'flaticon-agency-discuss',
            'ver'           => '1.0',
            'fetchJson'     => MASCOT_CORE_AMISO_URL_PATH . 'assets/flaticon-set-agency/icon-list.js',
            'native'        => 1,
        ];
        return $settings;
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mascot-core-amiso' ),
			'<strong>' . esc_html__( 'Mascot Core - Amiso Elementor', 'mascot-core-amiso' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mascot-core-amiso' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Mascot_Core_Amiso_Elementor.
new Mascot_Core_Amiso_Elementor();


/* Aqua Resizer
================================================== */
if (!function_exists('mascot_core_amiso_matthewruddy_image_resize')) {
	require_once( plugin_dir_path( __FILE__ ) . 'external-plugins/lib/matthewruddy-image-resizer.php' );
}


if( !function_exists('mascot_core_amiso_theme_installed') ) {
	/**
	* Checks whether theme is installed or not
	* @return bool
	*/
	function mascot_core_amiso_theme_installed() {
		return defined('AMISO_FRAMEWORK_VERSION');
	}
}


/**
 * making array of custom icon classes
 * which is saved in transient
 * @return array
 */
if (!function_exists('mascot_core_amiso_get_flat_icons')) :

    function mascot_core_amiso_get_flat_icons()
    {
        $data = get_transient('mascot_core_flat_icons');

        if (empty($data)) {
            global $wp_filesystem;
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();

            //this font is used in service cpt and you must enque this css file in elementor widget at get_style_depends()
            //otherwise this font will not be visible.
            $template_icon_file = MASCOT_CORE_AMISO_ABS_PATH . 'assets/flaticon-set-agri/style.css';
            $content = '';

            if ($wp_filesystem->exists($template_icon_file)) {
                $content .= $wp_filesystem->get_contents($template_icon_file);
            } // End If Statement

            $pattern_two = '/\.(flaticon-(?:\w+(?:-)?)+):before\s*{\s*content/';

            $subject = $content;

            preg_match_all($pattern_two, $subject, $matches_two, PREG_SET_ORDER);

            $all_matches = $matches_two;

            $icons = array();


            foreach ($all_matches as $match) {
                // $icons[] = array('value' => $match[1], 'label' => $match[1]);
                $icons[] = $match[1];
            }


            $data = $icons;
            set_transient('mascot_core_flat_icons', $data, 10); // saved for one week
        }
        return array_combine($data, $data); // combined for key = value
    }
endif;