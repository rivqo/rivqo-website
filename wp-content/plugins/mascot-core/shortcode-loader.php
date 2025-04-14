<?php
namespace MascotCoreElementor;

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
		wp_register_script( 'mascot-core-hellojs', plugins_url( '/admin/js/elementor-mascot.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	public function widget_styles() {
		wp_enqueue_style( 'mascot-core-css', plugins_url( '/admin/css/elementor-mascot.css', __FILE__ ) );
	}

	public function widget_styles_frontend() {
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'mascot-core-style', plugins_url( '/assets/css/shortcodes/mascot-core-style' . $direction_suffix . '.css', __FILE__ ) );
	}

	public function widgets_list() {
		$this->widgets = array(
			'header-top-info',
			'accordion',
			'animated-layers',
			'blank-box',
			'bg-angle-left-right',
			'button',
			'before-after-slider',
			'blockquote',
			'clients-logo',
			'contact-form-7',
			'contact-list',
			'countdown-timer',
			'dropcaps',
			'features-box',
			'floating-objects',
			'funfact-counter',
			'icon-box',
			'info-box',
			'image-background-text-effect',
			'image-gallery',
			'image-with-rotated-text',
			'language-switcher',
			'list',
			'navigation-menu',
			'newsletter',
			'opening-hours-compressed',
			'paroller-animation',
			'pie-chart',
			'pricing-table',
			'pricing-switcher',
			'progress-bar',
			'project-info',
			'rotated-text',
			'section-title',
			'social-links',
			'tabs',
			'text-editor',
			'text-editor-advanced',
			'timeline',
			'timeline-horizontal',
			'unordered-list',
			'vertical-bg-img-list',
			'video-popup',
			'working-steps',
			'slider-fullpage',
			'slider-multiscroll',
			'slider-pagepiling',
			'testimonial-block'
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

		//header shortcodes
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Top_Info() );
		
		//shortcodes
		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Accordion\TM_Elementor_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Animated_Layers() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Blank_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Before_After_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_BG_Aangle_Left_Right() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\BM_Elementor_blockquote() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Clients_logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Contact_Form_7() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Contact_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\CountdownTimer\TM_Elementor_Countdown_Timer() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Dropcaps() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Features_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Floating_Objects() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Funfact_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Iconbox() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\InfoBox\TM_Elementor_InfoBox() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Image_Background_Text_Effect() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\ImageGallery\TM_Elementor_Image_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Image_With_Rotated_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Language_Switcher() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Navigation_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Newsletter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Opening_Hours_Compressed() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Paroller_Animation() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Pie_Chart() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\PricingTable\TM_Elementor_Pricing_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\PricingSwitcher\TM_Elementor_Pricing_Switcher() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Progress_Bar() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_ProjectInfo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Rotated_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Section_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Social_Links() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Tabs\TM_Elementor_Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_TextEditor() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_TextEditorAdvanced() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Timeline_Horizontal() );

		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Unordered_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\VerticalBgImgList\TM_Elementor_Vertical_Bg_Img_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\VideoPopup\TM_Elementor_Video_Popup() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Working_Steps() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_BlockTestimonial() );
		
		//slider widgets
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_FullPage() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_MultiScroll() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_PagePiling() );


		
		//current theme widgets
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

		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles_frontend' ] );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_styles_frontend' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();

//elementor elements
require_once( __DIR__ . '/elementor-elements/loader.php' );