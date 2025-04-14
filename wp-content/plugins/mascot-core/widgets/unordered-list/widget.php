<?php
namespace MascotCoreElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Unordered_List extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-unordered-list-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/unordered-list' . $direction_suffix . '.css' );
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
		return 'tm-ele-unordered-list';
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
		return esc_html__( 'Unordered List', 'mascot-core' );
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
		return [ 'tm-unordered-list-style' ];
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
			'unordered_list_style',
			[
				'label' => esc_html__( "Design Style", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => '',
				'options' => [
					'list-default'  =>  esc_html__( 'Default', 'mascot-core' ),
					'list-style1' =>  esc_html__( 'Style 1', 'mascot-core' ),
					'list-style2' =>  esc_html__( 'Style 2', 'mascot-core' ),
					'list-style3' =>  esc_html__( 'Style 3', 'mascot-core' ),
					'list-style4' =>  esc_html__( 'Style 4', 'mascot-core' ),
					'list-style5' =>  esc_html__( 'Style 5', 'mascot-core' ),
					'list-style6' =>  esc_html__( 'Style 6', 'mascot-core' ),
					'list-style7' =>  esc_html__( 'Style 7', 'mascot-core' ),
					'list-style8' =>  esc_html__( 'Style 8', 'mascot-core' ),
					'list-style9' =>  esc_html__( 'Style 9', 'mascot-core' ),
					'list-style10'  =>  esc_html__( 'Style 10', 'mascot-core' ),
					'list-style11'  =>  esc_html__( 'Style 11', 'mascot-core' ),
					'list-style12'  =>  esc_html__( 'Style 12', 'mascot-core' ),
					'list-style13'  =>  esc_html__( 'Style 13', 'mascot-core' ),
					'list-style14'  =>  esc_html__( 'Style 14', 'mascot-core' ),
					'list-style15'  =>  esc_html__( 'Style 15', 'mascot-core' ),
					'list-style16'  =>  esc_html__( 'Style 16', 'mascot-core' ),
				],
				'default' => 'list-style1',
			]
		);
		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Content", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => "<ul><li>List item one</li><li>List item two</li><li>List item three</li><li>List item four</li></ul>",
			]
		);
		$this->add_control(
			'text_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-unordered-list' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-unordered-list ul li ' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-unordered-list ul li',
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Background Theme Colored?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-unordered-list ul li:before' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_text_color',
			[
				'label' => esc_html__( "Icon Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-unordered-list ul li:before ' => 'color: {{VALUE}};'
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

	//classes
	$classes = array();
	$classes[] = 'tm-sc-unordered-list';
	$classes[] = $settings['custom_css_class'];
	$classes[] = $settings['unordered_list_style'];

	$settings['classes'] = $classes;

	//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
	$html = mascot_core_get_shortcode_template_part( 'unordered-list', null, 'unordered-list/tpl', $settings, true );

	echo $html;
	}
}