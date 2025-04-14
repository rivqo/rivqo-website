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
class TM_Elementor_Timeline extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-timeline-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/timeline' . $direction_suffix . '.css' );
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
		return 'tm-ele-timeline';
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
		return esc_html__( 'Timeline', 'mascot-core' );
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
		return [ 'tm-timeline-style' ];
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
				'label' => esc_html__( 'Items', 'mascot-core' ),
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
			'display_type', [
				'label' => esc_html__( "Design", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'timeline-basic' =>  esc_html__( 'Basic', 'mascot-core' ),
					'timeline-boxed' =>  esc_html__( 'Boxed', 'mascot-core' ),
				],
				'default' => 'timeline-basic'
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Sample Title", 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h5',
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Subtitle", 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'date_range',
			[
				'label' => esc_html__( "Date Range", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "2012 - 2014", 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'date_year',
			[
				'label' => esc_html__( "Year", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "2013", 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'date_month',
			[
				'label' => esc_html__( "Month", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Feb", 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Description", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.", 'mascot-core' ),
			]
		);
		$this->add_control(
			'timeline_items',
			[
				'label' => esc_html__( "Item", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'styling_options',
			[
				'label' => esc_html__( 'Items Typography/Styling Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_fields_style');
		$this->start_controls_tab(
			'tab_fields_title',
			[
				'label' => esc_html__('Title', 'mascot-core'),
			]
		);
		$this->add_control(
			'title_color_options',
			[
				'label' => esc_html__( 'Title Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'show_title', [
				'label' => esc_html__( "Show Title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .title',
			]
		);
		$this->add_control(
			'title_custom_color',
			[
				'label' => esc_html__( "Title Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_custom_color_hover',
			[
				'label' => esc_html__( "Title Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'tab_fields_subtitle',
			[
				'label' => esc_html__('SubTitle', 'mascot-core'),
			]
		);
		$this->add_control(
			'subtitle_placement', [
				'label' => esc_html__( "Subtitle Placement", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Over Title', 'mascot-core' ),
					'center' => esc_html__( 'Under Title', 'mascot-core' ),
					'bottom' => esc_html__( 'Under Excerpt', 'mascot-core' ),
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'subtitle_color_options',
			[
				'label' => esc_html__( 'Sub Title Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'show_subtitle', [
				'label' => esc_html__( "Show Sub Title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Sub Title Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .subtitle',
			]
		);
		$this->add_control(
			'subtitle_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'subtitle_custom_color',
			[
				'label' => esc_html__( "Sub Title Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_custom_color_hover',
			[
				'label' => esc_html__( "Sub Title Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Sub Title Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Sub Title Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'subtitle_bg_custom_bg_color',
			[
				'label' => esc_html__( "SubTitle Custom BG Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_bg_custom_bg_color_hover',
			[
				'label' => esc_html__( "SubTitle Custom BG Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .subtitle' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_bg_theme_colored',
			[
				'label' => esc_html__( "SubTitle BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_bg_theme_colored_hover',
			[
				'label' => esc_html__( "SubTitle BG Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .subtitle' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_margin_options',
			[
				'label' => esc_html__( 'Margin/Padding Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Sub Title Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Sub Title Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_border_radius',
			[
				'label' => esc_html__( "Sub Title Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .subtitle' => 'border-radius: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'tab_fields_date',
			[
				'label' => esc_html__('Date', 'mascot-core'),
				'condition' => [
					'display_type' => array('timeline-basic')
				]
			]
		);
		$this->add_control(
			'date_color_options',
			[
				'label' => esc_html__( 'Date Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'show_date', [
				'label' => esc_html__( "Show Date", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => esc_html__( 'Date Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .date',
			]
		);
		$this->add_control(
			'date_custom_color',
			[
				'label' => esc_html__( "Date Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .date' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'date_custom_color_hover',
			[
				'label' => esc_html__( "Date Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .date' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'date_theme_colored',
			[
				'label' => esc_html__( "Date Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .date' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'date_theme_colored_hover',
			[
				'label' => esc_html__( "Date Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .date' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'date_margin',
			[
				'label' => esc_html__( 'Date Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'tab_fields_excerpt',
			[
				'label' => esc_html__('Excerpt', 'mascot-core'),
			]
		);
		$this->add_control(
			'excerpt_color_options',
			[
				'label' => esc_html__( 'Excerpt Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'show_excerpt', [
				'label' => esc_html__( "Show Excerpt", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Excerpt Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .content, {{WRAPPER}} .tm-timeline .info-box .content *',
			]
		);
		$this->add_control(
			'excerpt_custom_color',
			[
				'label' => esc_html__( "Excerpt Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-timeline .info-box .content *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_custom_color_hover',
			[
				'label' => esc_html__( "Excerpt Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-timeline .info-box:hover .content *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_theme_colored',
			[
				'label' => esc_html__( "Excerpt Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .content' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-timeline .info-box .content *' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'excerpt_theme_colored_hover',
			[
				'label' => esc_html__( "Excerpt Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .content' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-timeline .info-box:hover .content *' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Excerpt Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();





		$this->start_controls_section(
			'bullet_pos_options',
			[
				'label' => esc_html__( 'Bullet Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('timeline-basic')
				]
			]
		);
		$this->add_responsive_control(
			'bullet_pos_top',
			[
				'label' => esc_html__( "Bullet Top", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bullet_pos_right',
			[
				'label' => esc_html__( "Bullet Right", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bullet_pos_bottom',
			[
				'label' => esc_html__( "Bullet Bottom", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bullet_pos_left',
			[
				'label' => esc_html__( "Bullet Left", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->add_control(
			'bullet_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'bullet_width',
			[
				'label' => esc_html__( "Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'bullet_height',
			[
				'label' => esc_html__( "Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'bullet_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bullet_custom_bg_color',
			[
				'label' => esc_html__( "Bullet Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bullet_custom_bg_color_hover',
			[
				'label' => esc_html__( "Bullet Custom Background Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bullet_theme_colored',
			[
				'label' => esc_html__( "Bullet Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bullet_theme_colored_hover',
			[
				'label' => esc_html__( "Bullet Background Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bullet_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'bullet_border',
				'label' => esc_html__( 'Bullet Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box:before',
			]
		);
		$this->add_responsive_control(
			'bullet_border_radius',
			[
				'label' => esc_html__( "Bullet Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:before' => 'border-radius: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bullet_box_shadow',
				'label' => esc_html__( 'Bullet Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box:before',
			]
		);
		$this->end_controls_section();














		$this->start_controls_section(
			'vertical_line_pos_options',
			[
				'label' => esc_html__( 'Vertical Line Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_icon',
			[
				'label' => esc_html__( 'Hide Line', 'mascot-core' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' => 'display: none',
				],
			]
		);


		$this->add_control(
			'vertical_line_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'vertical_line_orientation_vertical',
			[
				'label' => __( 'Vertical Orientation', 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'mascot-core' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'mascot-core' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'vertical_line_orientation_offset_y',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' =>
							'{{vertical_line_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'vertical_line_orientation_horizontal',
			[
				'label' => __( 'Horizontal Orientation', 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mascot-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'mascot-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'vertical_line_orientation_offset_x',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' =>
							'{{vertical_line_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->add_control(
			'vertical_line_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'vertical_line_width',
			[
				'label' => esc_html__( "Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'vertical_line_height',
			[
				'label' => esc_html__( "Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '110',
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'vertical_line_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'vertical_line_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'vertical_line_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'vertical_line_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'vertical_line_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'vertical_line_last_item_color_options',
			[
				'label' => esc_html__( 'Last Item Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'vertical_line_last_item_custom_bg_color',
			[
				'label' => esc_html__( "Vertical Line Last Item BG Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:last-child:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('timeline-basic')
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_last_item_wrapper_padding',
			[
				'label' => esc_html__( 'Last Item Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();






		//List - Vertical Options
		$this->start_controls_section(
			'timeline_boxed_left_date_options', [
				'label' => esc_html__( 'Left Date Block Options', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('timeline-boxed')
				]
			]
		);
		$this->add_control(
			'timeline_boxed_left_date_placement', [
				'label' => esc_html__( "Date Block Placement", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'row' => esc_html__( 'Left', 'mascot-core' ),
					'row-reverse' => esc_html__( 'Right', 'mascot-core' ),
				],
				'default' => 'row',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'flex-direction: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_left_date_custom_width',
			[
				'label' => esc_html__( "Custom Date Block Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 250,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_left_date_custom_height',
			[
				'label' => esc_html__( "Custom Date Block Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 250,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);


		$this->start_controls_tabs('timeline_boxed_left_date_typo_tabs');
		$this->start_controls_tab(
			'timeline_boxed_left_date_year_typo_tab',
			[
				'label' => esc_html__('Year Typography', 'mascot-core'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'left_date_year_typography',
				'label' => esc_html__( 'Year Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .info-left .date .year',
			]
		);
		$this->add_control(
			'date_year_placement', [
				'label' => esc_html__( "Year Placement", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Over Month', 'mascot-core' ),
					'bottom' => esc_html__( 'Under Month', 'mascot-core' ),
				],
				'default' => 'top',
			]
		);
		$this->add_control(
			'left_date_year_text_color',
			[
				'label' => esc_html__( "Year Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date .year' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_year_text_color_hover',
			[
				'label' => esc_html__( "Year Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .info-left .date .year' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_year_theme_colored',
			[
				'label' => esc_html__( "Year Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date .year' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'left_date_year_theme_colored_hover',
			[
				'label' => esc_html__( "Year Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .info-left .date .year' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'left_date_year_margin',
			[
				'label' => esc_html__( 'Year Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'timeline_boxed_left_date_month_typo_tab',
			[
				'label' => esc_html__('Month Typography', 'mascot-core'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'left_date_month_typography',
				'label' => esc_html__( 'Month Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .info-left .date .month',
			]
		);
		$this->add_control(
			'left_date_month_text_color',
			[
				'label' => esc_html__( "Month Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date .month' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_month_text_color_hover',
			[
				'label' => esc_html__( "Month Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .info-left .date .month' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_month_theme_colored',
			[
				'label' => esc_html__( "Month Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date .month' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'left_date_month_theme_colored_hover',
			[
				'label' => esc_html__( "Month Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .info-left .date .month' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'left_date_month_margin',
			[
				'label' => esc_html__( 'Month Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date .month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->start_controls_tabs('timeline_boxed_left_date_bg_tabs');
		$this->start_controls_tab(
			'timeline_boxed_left_date_bg_tab',
			[
				'label' => esc_html__('Background Options', 'mascot-core'),
			]
		);
		$this->add_control(
			'timeline_boxed_left_date_theme_colored',
			[
				'label' => esc_html__( "Date Block BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'timeline_boxed_left_date_theme_colored_hover',
			[
				'label' => esc_html__( "Date Block BG Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .info-left .date' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'timeline_boxed_left_date_custom_bg_color',
			[
				'label' => esc_html__( "Date Block BG Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'timeline_boxed_left_date_custom_bg_color_hover',
			[
				'label' => esc_html__( "Date Block BG Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover .info-left .date' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
			'timeline_boxed_left_date_margin_padding_options',
			[
				'label' => esc_html__( 'Margin/Padding Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_left_date_padding',
			[
				'label' => esc_html__( 'Date Block Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_left_date_margin',
			[
				'label' => esc_html__( 'Date Block Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'timeline_boxed_left_date_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_left_date_border_radius',
			[
				'label' => esc_html__( 'Date Block Border Radius', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box .info-left .date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_boxed_left_date_boxshadow',
				'label' => esc_html__( 'Date Block Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .info-left .date',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_boxed_left_date_border',
				'label' => esc_html__( 'Date Block Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box .info-left .date',
			]
		);
		$this->end_controls_section();





		//List - Vertical Options
		$this->start_controls_section(
			'timeline_boxed_wrapper_options', [
				'label' => esc_html__( 'Item Wrapper Options (For Boxed Layout)', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('timeline-boxed')
				]
			]
		);
		$this->start_controls_tabs('tabs_timeline_boxed_wrapper_styles');
		$this->start_controls_tab(
			'timeline_boxed_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core'),
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_vertical_flex_options',
			[
				'label' => esc_html__( 'Vertical Placement Option', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_flex_vertical',
			[
				'label' => esc_html__( "Vertical Alignment", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'align-items: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_margin_options',
			[
				'label' => esc_html__( 'Padding/Margin Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_wrapper_padding',
			[
				'label' => esc_html__( 'List Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_wrapper_margin',
			[
				'label' => esc_html__( 'List Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_boxed_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_boxed_wrapper_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box',
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'timeline_boxed_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core'),
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_hover_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_hover_bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'timeline_boxed_wrapper_hover_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_boxed_wrapper_hover_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_boxed_wrapper_hover_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box:hover',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'timeline_boxed_wrapper_last_item',
			[
				'label' => esc_html__('Last Item', 'mascot-core'),
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_wrapper_last_item_padding',
			[
				'label' => esc_html__( 'Last Item Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'timeline_boxed_wrapper_last_item_margin',
			[
				'label' => esc_html__( 'Last Item Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-timeline .info-box:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_boxed_wrapper_last_item_border',
				'label' => esc_html__( 'Last Item Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-timeline .info-box:last-child',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		$html = '';
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-timeline';
		$classes[] = $settings['custom_css_class'];
		$classes[] = $settings['display_type'];

		$settings['classes'] = $classes;

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('timeline');
		?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php
		if ( $settings['timeline_items'] ) {
			$rand = rand(10,100);
			$i=1;
			foreach (  $settings['timeline_items'] as $item ) {
			$item['rand'] = $rand.''.$i;
			$item['holder_id'] = $settings['holder_id'];
			$settings['item'] = $item;

			//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
			$html .= mascot_core_get_shortcode_template_part( $settings['display_type'], null, 'timeline/tpl', $settings, true );
			$i++;
			}
		}
		echo $html;
		?>
		</div>
		<?php
	}
}