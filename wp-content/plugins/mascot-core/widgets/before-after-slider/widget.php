<?php
namespace MascotCoreElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Before_After_Slider extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'twentytwenty', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/twentytwenty/twentytwenty.css' );
		wp_register_script( 'jquery-event-move', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/twentytwenty/jquery.event.move.js', array('jquery'), false, true );
		wp_register_script( 'jquery-twentytwenty', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/twentytwenty/jquery.twentytwenty.js', array('jquery'), false, true );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tm-ele-before-after-slider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Before After Slider', 'mascot-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tm-elementor-widget-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tm' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'mascot-core-hellojs', 'jquery-event-move', 'jquery-twentytwenty' ];
	}

	public function get_style_depends() {
		return [ 'twentytwenty' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'before_image',
			[
				'label' => esc_html__( "Before Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload the before image", 'mascot-core' ),
			]
		);
		$this->add_control(
			'after_image',
			[
				'label' => esc_html__( "After Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload the after image. Before and After image should have same dimension", 'mascot-core' ),
			]
		);
		$this->add_control(
			'orientation',
			[
				'label' => esc_html__( "Orientation", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				"description" => esc_html__( "Orientation of the before and after images ('horizontal' or 'vertical')", 'mascot-core' ),
				'options' => [
					'horizontal'  => esc_html__( 'Horizontal', 'mascot-core' ),
					'vertical'  => esc_html__( 'Vertical', 'mascot-core' ),
				],
				'default' => 'horizontal',
			]
		);
		$this->add_control(
			'before_label',
			[
				'label' => esc_html__( "Custom Before Label", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Default custom before label: 'Before'", 'mascot-core' ),
			]
		);
		$this->add_control(
			'after_label',
			[
				'label' => esc_html__( "Custom After Label", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Default custom after label: 'After'", 'mascot-core' ),
			]
		);
		$this->add_control(
			'default_offset_pct',
			[
				'label' => esc_html__( "Offset Percentage", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "How much of the before image is visible when the page loads(value must be between 0 to 1)", 'mascot-core' ),
				'default' => '0.5',
			]
		);
		$this->add_control(
			'no_overlay',
			[
				'label' => esc_html__( "No Overlay", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'ON', 'mascot-core' ),
				'label_off' => esc_html__( 'OFF', 'mascot-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__( "Do not show the overlay with before and after", 'mascot-core' ),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();



		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'before-after-slider', null, 'before-after-slider/tpl', $settings, true );

		echo $html;
	}
}
