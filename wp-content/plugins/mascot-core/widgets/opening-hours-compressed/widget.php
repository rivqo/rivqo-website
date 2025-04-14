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
class TM_Elementor_Opening_Hours_Compressed extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-opening-hours-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/opening-hours' . $direction_suffix . '.css' );
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
		return 'tm-ele-opening-hours-compressed';
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
		return esc_html__( 'Opening Hours', 'mascot-core' );
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
		return [ 'tm-opening-hours-style' ];
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
				"description" => esc_html__( 'To style particular content element.', 'mascot-core' ),
			]
		);
		$this->add_control(
			'hide_wpcf7_spinner',
			[
				'label' => esc_html__( 'Place Day & Time Horizontally', 'mascot-core' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li' => 'display: flex; justify-content:space-between;',
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'day_hours_text',
			[
				'label' => esc_html__( 'Day & Time', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//day1
		$this->add_control(
			'day_1',
			[
				'label' => esc_html__( "Day 1:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Monday - Friday'
			]
		);
		$this->add_control(
			'day_1_time',
			[
				'label' => esc_html__( "Time for Day 1:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '9:00 - 17:00'
			]
		);

		//day2
		$this->add_control(
			'day_2',
			[
				'label' => esc_html__( "Day 2:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Saturday'
			]
		);
		$this->add_control(
			'day_2_time',
			[
				'label' => esc_html__( "Time for Day 2:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '9.00 - 16.00'
			]
		);

		//day3
		$this->add_control(
			'day_3',
			[
				'label' => esc_html__( "Day 3:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Sunday'
			]
		);
		$this->add_control(
			'day_3_time',
			[
				'label' => esc_html__( "Time for Day 3:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Closed'
			]
		);

		//day4
		$this->add_control(
			'day_4',
			[
				'label' => esc_html__( "Day 4:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);
		$this->add_control(
			'day_4_time',
			[
				'label' => esc_html__( "Time for Day 4:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);

		//day5
		$this->add_control(
			'day_5',
			[
				'label' => esc_html__( "Day 5:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);
		$this->add_control(
			'day_5_time',
			[
				'label' => esc_html__( "Time for Day 5:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);

		//day6
		$this->add_control(
			'day_6',
			[
				'label' => esc_html__( "Day 6:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);
		$this->add_control(
			'day_6_time',
			[
				'label' => esc_html__( "Time for Day 6:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);

		//day7
		$this->add_control(
			'day_7',
			[
				'label' => esc_html__( "Day 7:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);
		$this->add_control(
			'day_7_time',
			[
				'label' => esc_html__( "Time for Day 7:", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'day_options',
			[
				'label' => esc_html__( 'Day Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'day_typography',
				'label' => esc_html__( 'Day Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-opening-hours li .day',
			]
		);
		$this->add_control(
			'day_text_color',
			[
				'label' => esc_html__( "Day Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li .day' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'day_text_color_hover',
			[
				'label' => esc_html__( "Day Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li:hover .day' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'day_theme_colored',
			[
				'label' => esc_html__( "Day Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li .day' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'day_theme_colored_hover',
			[
				'label' => esc_html__( "Day Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li:hover .day' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'time_options',
			[
				'label' => esc_html__( 'Time Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'time_typography',
				'label' => esc_html__( 'Time Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-opening-hours li .time',
			]
		);
		$this->add_control(
			'time_text_color',
			[
				'label' => esc_html__( "Time Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li .time' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'time_text_color_hover',
			[
				'label' => esc_html__( "Time Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li:hover .time' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'time_theme_colored',
			[
				'label' => esc_html__( "Time Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li .time' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'time_theme_colored_hover',
			[
				'label' => esc_html__( "Time Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li:hover .time' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'list_item_options',
			[
				'label' => esc_html__( 'Item Styling Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'list_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_item_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-opening-hours li',
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'last_item_options',
			[
				'label' => esc_html__( 'Last Child Styling', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'last_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'last_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-opening-hours li:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'last_item_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-opening-hours li:last-child',
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
	$html = mascot_core_get_shortcode_template_part( 'opening-hours-compressed', null, 'opening-hours-compressed/tpl', $settings, true );

	echo $html;
	}
}
