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
class TM_Elementor_List extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-list-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/list' . $direction_suffix . '.css' );
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
		return 'tm-ele-list';
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
		return esc_html__( 'TM List', 'mascot-core' );
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
		return [ 'tm-list-style' ];
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
		//Features
		$this->start_controls_section(
			'list_repeater',
			[
				'label' => esc_html__( 'Features List', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'disable_feature', [
				'label' => esc_html__( "Disable This Feature?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'line_through', [
				'label' => esc_html__( "Add Line Through Text?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Single Line Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => ''
			]
		);
		$repeater->add_control(
			'list_icon_individual',
			[
				'label' => esc_html__( 'Individual Icon', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__( "Features Items", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();





		//Features
		$this->start_controls_section(
			'list_icon_options',
			[
				'label' => esc_html__( 'Features List Icons Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'iconbox_wrapper_overflow_hidden',
			[
				'label' => esc_html__( "Hide Icon", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list i' => 'display: none;'
				]
			]
		);
		$this->add_control(
			'list_icon',
			[
				'label' => esc_html__( 'Common Icon for All', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-check-circle',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'list_icon_color',
			[
				'label' => esc_html__( "Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-list svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-list li:hover svg' => 'fill: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-list li svg' => 'fill: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li:hover i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-list li:hover svg' => 'fill: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-list i',
			]
		);
		$this->add_responsive_control(
			'list_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		//Features
		$this->start_controls_section(
			'list_styling',
			[
				'label' => esc_html__( 'Features List Styling', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'mascot-core' ),
					'rotate' => esc_html__( 'Rotate', 'mascot-core' ),
					'rotate-x' => esc_html__( 'Rotate X', 'mascot-core' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'mascot-core' ),
					'scale'  => esc_html__( 'Scale', 'mascot-core' ),
					'translate'  => esc_html__( 'Translate', 'mascot-core' ),
					'translate-x'  => esc_html__( 'Translate X', 'mascot-core' ),
					'translate-y'  => esc_html__( 'Translate Y', 'mascot-core' ),
				],
			]
		);
		$this->add_control(
			'list_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_text_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list__typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-list li',
			]
		);
		$this->add_control(
			'list_bordered',
			[
				'label' => esc_html__( "Make List(ul, li) Border Bottom?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'label' => esc_html__( 'List Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-list li',
			]
		);
		$this->add_control(
			'list_border_color_default',
			[
				'label' => esc_html__( "Border Bottom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'list_bordered' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_border_color_hover',
			[
				'label' => esc_html__( "Border Bottom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-list li' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'list_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		$classes[] = 'tm-sc-list';
		$classes[] = $settings['custom_css_class'];

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'tm-animate-icon-on-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'list', null, 'list/tpl', $settings, true );

		echo $html;
	}
}