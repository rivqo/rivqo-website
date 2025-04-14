<?php
namespace MascotCoreElementor\Widgets\CountdownTimer;

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
class TM_Elementor_Countdown_Timer extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script( 'jquery-countdown', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.countdown.min.js', array('jquery'), false, true );
		wp_register_script( 'jquery-final-countdown', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.final-countdown.min.js', array('jquery'), false, true );
		wp_register_script( 'kinetic', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/kinetic.js', array('jquery'), false, true );

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-final-countdown-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/final-countdown' . $direction_suffix . '.css' );
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
		return 'tm-ele-countdown-timer';
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
		return esc_html__( 'Countdown Timer', 'mascot-core' );
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
		return [ 'mascot-core-hellojs', 'jquery-countdown', 'jquery-final-countdown', 'kinetic' ];
	}

	public function get_style_depends() {
		return [ 'tm-final-countdown-style' ];
	}

	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Countdown_Smart_Style( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Modern_circular( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Advanced_Coupon( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Basic_Coupon( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Days_Offsets( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Hours( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Legacy_Style( $this ) );
		$this->add_skin( new Skins\Skin_Countdown_Weeks_Offsets( $this ) );
	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
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
			'countdown_future_date_time',
			[
				'label' => esc_html__( "Future Ending Date & Time (Format Y/m/d H:i:s)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'Y/m/d H:i:s',
				],
				'default' => date('Y/m/d H:i:s', strtotime("+15 week", current_time('timestamp', 0))),
			]
		);
		$this->add_control(
			'show_time',
			[
				'label' => esc_html__( "Show Time?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'mascot-core' ),
				'label_off' => esc_html__( 'No', 'mascot-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__( "Show or Hide Time of the date", 'mascot-core' ),
			]
		);
		$this->add_responsive_control(
			'block_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-countdown-timer' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_horizontal_alignment',
			[
				'label' => esc_html__( "Block Horizontal Alignment(Flex)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_horizontal_align_elementor(),
				'label_block' => true,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-countdown-timer > div' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'Word_options',
			[
				'label' => esc_html__( 'Word Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'word_month',
			[
				'label' => esc_html__( "Word - Month", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'months'
			]
		);
		$this->add_control(
			'word_week',
			[
				'label' => esc_html__( "Word - Week", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'weeks'
			]
		);
		$this->add_control(
			'word_day',
			[
				'label' => esc_html__( "Word - Day", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'days'
			]
		);
		$this->add_control(
			'word_hr',
			[
				'label' => esc_html__( "Word - Hour", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'hr'
			]
		);
		$this->add_control(
			'word_min',
			[
				'label' => esc_html__( "Word - Minute", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'min'
			]
		);
		$this->add_control(
			'word_sec',
			[
				'label' => esc_html__( "Word - Second", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'sec'
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'counter_value_styling',
			[
				'label' => esc_html__( 'Counter Value Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin!' => array('skin-countdown-modern-circular', 'skin-countdown-smart-style'),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_value_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .countdown-container span',
			]
		);
		$this->add_control(
			'counter_value_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-container span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_value_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-container:hover span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_value_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .countdown-container span' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'counter_value_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .countdown-container:hover span' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'counter_value_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .countdown-container span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'counter_label_styling',
			[
				'label' => esc_html__( 'Counter Label Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin!' => array('skin-countdown-modern-circular', 'skin-countdown-smart-style'),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_label_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .counter .label',
			]
		);
		$this->add_control(
			'counter_label_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'counter_label_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_label_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter:hover .label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_label_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter .label' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'counter_label_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter:hover .label' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'counter_label_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter .label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	public function script_output() {
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
		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'tpl-months-offsets', null, 'countdown-timer/tpl', $settings, true );

		echo $html;
	}
}
