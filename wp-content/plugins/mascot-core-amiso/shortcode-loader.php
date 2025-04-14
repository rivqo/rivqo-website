<?php
namespace MascotCoreAmiso;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
	public $widgets = array();
	public $widgets_shop = array();
	public $woocommerce_status = false;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'mascot-core-hellojs', plugins_url( '/assets/js/elementor-mascot.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	public function widget_styles() {
		wp_enqueue_style( 'mascot-core-elementor-css', plugins_url( '/assets/css/elementor-mascot.css', __FILE__ ) );
	}

	public function widget_styles_frontend() {
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-header-search', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/header-search' . $direction_suffix . '.css' );
	}


	public function wpcf_status() {

		if ( class_exists( 'WPCF\Crowdfunding' ) ) {
			$this->wpcf_status = true;
		}

		return $this->wpcf_status;
	}

	public function woocommerce_status() {

		if ( class_exists( 'WooCommerce' ) ) {
			$this->woocommerce_status = true;
		}

		return $this->woocommerce_status;
	}

	public function widgets_list() {
		$this->widgets = array(
			'blog-list',
			'block-features',
			'award-block',
			'counter',
			'countdown-timer',
			'header-primary-nav',
			'header-nav-side-icons',
			'page-title',
			'pricing-plan',
			'pricing-plan-switcher',
			'site-logo',
			'app-button',
			'spin-text-around-logo',
			'moving-text',
			'interactive-list',
			'interactive-tabs-title',
			'interactive-tabs-content'
		);
		return $this->widgets;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		foreach( $this->widgets_list() as $widget ) {
			require_once( __DIR__ . '/widgets/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}
	private function include_widgets_files_cpt() {
		//cpt
		require_once( __DIR__ . '/cpt/projects/loader.php' );
		require_once( __DIR__ . '/cpt/services/widget.php' );
		require_once( __DIR__ . '/cpt/staff/widget.php' );
		require_once( __DIR__ . '/cpt/testimonials/widget.php' );
		require_once( __DIR__ . '/cpt/blog/widget.php' );

		$cpt_list = array(
			'projects',
			'services',
			'staff',
			'testimonials',
			'blog',
		);

		foreach( $cpt_list as $cpt ) {
			foreach( glob( __DIR__ . '/cpt/'. $cpt .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}
	private function include_widgets_files_current_theme() {
	}


	//shop
	public function widgets_list_shop() {
		if ( $this->woocommerce_status() ) {
			$this->widgets_shop = array_merge(
				$this->widgets_shop, array(
					'header-cart',
					'header-search',
					'info-banner',
					'wc-products',
					'product-category',
					'product-list',
					'vertical-menu',
					'wishlist',
					'product-tabs'
				)
			);
		}
		return $this->widgets_shop;
	}
	private function include_widgets_files_shop() {
		foreach( $this->widgets_list_shop() as $widget ) {
			require_once( __DIR__ . '/widgets-shop/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets-shop/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();
		$this->include_widgets_files_cpt();
		$this->include_widgets_files_current_theme();

		// WooCommerce.
		$this->include_widgets_files_shop();

		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Blog_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\FeatureBlock\TM_Elementor_BlockFeatures() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\AwardBlock\TM_Elementor_AwardBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Counter\TM_Elementor_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Countdown_Timer() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Page_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Site_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Top_Primary_Nav() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Nav_Side_Icons() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_App_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Spin_Text_Around_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\MovingText\TM_Elementor_MovingText() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Spin_Text_Around_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\InteractiveTabs\TM_Elementor_InteractiveTabsTitle() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\InteractiveTabs\TM_Elementor_InteractiveTabsContent() );

		//cpt
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Projects\TM_Elementor_Projects() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Services\TM_Elementor_Services() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Staff\TM_Elementor_Staff() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonials\TM_Elementor_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Blog\TM_Elementor_Blog() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\PricingPlan\TM_Elementor_Pricing_Plan() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\PricingPlanSwitcher\TM_Elementor_Pricing_Plan_Switcher() );


		//Shop Widgets
		if ( $this->woocommerce_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Cart() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Search() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Products\TM_Elementor_WC_Products() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_InfoBanner() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Products_Category\TM_Elementor_Products_Category() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Product_List\TM_Elementor_Product_List() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Product_Tabs() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Vertical_Menu() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Wishlist() );
		}

	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles' ] );

		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_styles_frontend' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles_frontend' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();

//elementor elements
require_once( __DIR__ . '/elementor-widgets-modify.php' );