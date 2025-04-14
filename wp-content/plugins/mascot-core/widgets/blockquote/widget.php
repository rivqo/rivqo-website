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
class BM_Elementor_blockquote extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
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
		return 'tm-ele-blockquote';
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
		return esc_html__( 'Blockquote', 'mascot-core' );
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
			'blockquote_style',
			[
				'label' => esc_html__( "Blockquote Style", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( "Choose grid size", 'mascot-core' ),
				'options' => [
					'blockquote-style1' => esc_html__( 'Style1', 'mascot-core' ),
				],
				'default' => 'blockquote-style1',
			]
		);
		$this->add_responsive_control(
			'blockquote_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'quote_text',
			[
				'label' => esc_html__( 'Quote Text', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'text',
			[
				'label' => esc_html__( "Quote", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Diam luctus nostra dapibus varius et semper semper rutrum ad risus felis eros.", 'mascot-core' ),
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'text_typo',
			[
				'label' => esc_html__( 'Text Typography', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( "Text Color(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover blockquote' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover blockquote' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Text Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} blockquote',
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'cite_text',
			[
				'label' => esc_html__( 'Cite Text', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'cite',
			[
				'label' => esc_html__( "Cite Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$this->add_responsive_control(
			'cite_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} blockquote cite' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'cite_typo',
			[
				'label' => esc_html__( 'Cite Typography', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'cite_color',
			[
				'label' => esc_html__( "Cite Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} cite' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'cite_color_hover',
			[
				'label' => esc_html__( "Cite Color(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover cite' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'cite_theme_colored',
			[
				'label' => esc_html__( "Cite Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} cite' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'cite_theme_colored_hover',
			[
				'label' => esc_html__( "Cite Theme Colored(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover cite' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cite_typography',
				'label' => esc_html__( 'Cite Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} cite',
			]
		);
		$this->add_responsive_control(
			'cite_margin',
			[
				'label' => esc_html__( 'Cite Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} cite' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'box_styling',
			[
				'label' => esc_html__( 'Blockquote Wrapper Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'blockquote_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} blockquote',
			]
		);
		$this->add_responsive_control(
			'blockquote_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'border-radius: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'blockquote_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} blockquote',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'blockquote_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core' ),
				'selector' => '{{WRAPPER}}:hover blockquote',
			]
		);
		$this->add_control(
			'blockquote_wrapper_theme_colored',
			[
				'label' => esc_html__( "Make Wrapper Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'blockquote_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make Wrapper Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover blockquote' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'blockquote_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Wrapper Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'blockquote_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Wrapper Custom Background Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover blockquote' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'quote_icon',
			[
				'label' => esc_html__( 'Quote Icon', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_icon_letter',
			[
				'label' => esc_html__( "Custom Quote Icon (English Letter)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '“',
				'description' => esc_html__( "Example: “", 'mascot-core' ),
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'content: "\{{VALUE}}";'
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'quote_icon_typo',
			[
				'label' => esc_html__( 'Quote Icon Typography', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'quote_icon_typography',
				'label' => esc_html__( 'Quote Icon Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} blockquote:before',
			]
		);
		$this->add_control(
			'quote_icon_color_options',
			[
				'label' => esc_html__( 'Icon Color', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'quote_icon_color',
			[
				'label' => esc_html__( "Quote Icon Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'quote_icon_color_hover',
			[
				'label' => esc_html__( "Quote Icon Color(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover blockquote:before' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'quote_icon_theme_colored',
			[
				'label' => esc_html__( "Quote Icon Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'quote_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Quote Icon Theme Colored(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover blockquote:before' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'quote_icon_pos_options',
			[
				'label' => esc_html__( 'Icon Position', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'quote_icon_pos_top',
			[
				'label' => esc_html__( "Top (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'quote_icon_pos_right',
			[
				'label' => esc_html__( "Right (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'quote_icon_pos_bottom',
			[
				'label' => esc_html__( "Bottom (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'quote_icon_pos_left',
			[
				'label' => esc_html__( "Left (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->add_control(
			'quote_icon_other_options',
			[
				'label' => esc_html__( 'Other Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'quote_icon_z_index',
			[
				'label' => esc_html__( "Z Index", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'z-index: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'quote_icon_opacity',
			[
				'label' => esc_html__( 'Opacity', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} blockquote:before' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'quote_icon_bg_typo',
			[
				'label' => esc_html__( 'Quote Icon Background', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'quote_icon_bg_dim_options',
			[
				'label' => esc_html__( 'BG Dimension', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'quote_icon_bg_widthheight',
			[
				'label' => esc_html__( "Width and Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'width: {{VALUE}}; height: {{VALUE}};',
				]
			]
		);


		$this->add_control(
			'quote_icon_bg_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'quote_icon_bg_color',
			[
				'label' => esc_html__( "Quote BG Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'quote_icon_bg_color_hover',
			[
				'label' => esc_html__( "Quote BG Color(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover blockquote:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'quote_icon_bg_theme_colored',
			[
				'label' => esc_html__( "Quote BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'quote_icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Quote BG Theme Colored(Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover blockquote:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'quote_icon_bg_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'quote_icon_bg_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} blockquote:after',
			]
		);
		$this->add_responsive_control(
			'quote_icon_bg_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'border-radius: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'quote_icon_bg_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} blockquote:after',
			]
		);
		$this->add_control(
			'quote_icon_bg_pos_options',
			[
				'label' => esc_html__( 'BG Position', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'quote_icon_bg_pos_top',
			[
				'label' => esc_html__( "Top (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'quote_icon_bg_pos_right',
			[
				'label' => esc_html__( "Right (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'quote_icon_bg_pos_bottom',
			[
				'label' => esc_html__( "Bottom (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'quote_icon_bg_pos_left',
			[
				'label' => esc_html__( "Left (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->add_control(
			'quote_icon_bg_other_options',
			[
				'label' => esc_html__( 'Other Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'quote_icon_bg_opacity',
			[
				'label' => esc_html__( 'BG Opacity', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'opacity: {{VALUE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'quote_icon_bg_z_index',
			[
				'label' => esc_html__( "Z Index", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} blockquote:after' => 'z-index: {{VALUE}};'
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
		$classes[] = 'tm-sc-blockquote';
		$classes[] = $settings['custom_css_class'];
		$classes[] = $settings['blockquote_style'];


		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'blockquote', null, 'blockquote/tpl', $settings, true );

		echo $html;
	}
}