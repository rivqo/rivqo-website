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
class TM_Elementor_Dropcaps extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-dropcaps-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/dropcaps' . $direction_suffix . '.css' );
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
		return 'tm-ele-dropcaps';
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
		return esc_html__( 'Dropcaps', 'mascot-core' );
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
		return [ 'mascot-core-hellojs' ];
	}

	public function get_style_depends() {
		return [ 'tm-dropcaps-style' ];
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
		'dropcaps_style',
		[
			'label' => esc_html__( "Dropcaps Style", 'mascot-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'description' => esc_html__( "Choose grid size", 'mascot-core' ),
			'options' => [
				'dropcaps-empty' => esc_html__( 'Empty', 'mascot-core' ),
				'dropcaps-fill' => esc_html__( 'Fill', 'mascot-core' ),
			],
			'default' => 'dropcaps-empty',
		]
	);
	$this->add_control(
		'text',
		[
			'label' => esc_html__( "Text", 'mascot-core' ),
			'type' => \Elementor\Controls_Manager::WYSIWYG,
			'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'mascot-core' ),
		]
	);
	$this->add_control(
		'text_text_color',
		[
			'label' => esc_html__( "Text Color", 'mascot-core' ),
			'type' => \Elementor\Controls_Manager::COLOR,
		]
	);
	$this->add_control(
		'bg_color',
		[
			'label' => esc_html__( "Background Color", 'mascot-core' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'condition' => [
				'dropcaps_style' => array('dropcaps-fill')
			]
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

	$settings['text_inline_css'] = mascot_core_get_inline_css( mascot_core_sc_dropcaps_text_css( $settings ) );

	//classes
	$classes = array();
	$classes[] = 'tm-sc-dropcaps';
	$classes[] = $settings['custom_css_class'];
	$classes[] = $settings['dropcaps_style'];


	$settings['classes'] = $classes;

	//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
	$html = mascot_core_get_shortcode_template_part( 'dropcaps', null, 'dropcaps/tpl', $settings, true );

	echo $html;
	}
}



if(!function_exists('mascot_core_sc_dropcaps_text_css')) {
	/**
	 * Get Text Styles
	 */
	function mascot_core_sc_dropcaps_text_css( $settings ) {
	$css_array = array();

	if( $settings['text_text_color'] != '' ) {
		$css_array[] = 'color: '.$settings['text_text_color'];
	}

	if( $settings['bg_color'] != '' ) {
		$css_array[] = 'background-color: '.$settings['bg_color'];
	}

	return implode( '; ', $css_array );
	}
}