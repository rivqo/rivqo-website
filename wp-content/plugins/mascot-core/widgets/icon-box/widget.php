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
class TM_Elementor_Iconbox extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_script( 'vivus', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/vivus.min.js', null, false, true );
		wp_enqueue_script( 'vivus' );

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-ele-iconbox-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/icon-box' . $direction_suffix . '.css' );
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
		return 'tm-ele-iconbox';
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
		return esc_html__( 'Icon Box', 'mascot-core' );
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
		return [ 'tm-ele-iconbox-style' ];
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
			'title_section',
			[
				'label' => esc_html__( 'Title', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "This is a section title", 'mascot-core' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_options',
			[
				'label' => esc_html__( 'Paragraph', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_paragraph', [
				'label' => esc_html__( "Show Paragraph", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'mascot-core' ),
				"description" => esc_html__( "It will be displayed above/under title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description, that will describe something useful.", 'mascot-core' ),
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'icon_position',
			[
				'label' => esc_html__( "Icon Position", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-top' => esc_html__( 'Top', 'mascot-core' ),
					'icon-left'  => esc_html__( 'Left', 'mascot-core' ),
					'icon-left-style2'  => esc_html__( 'Left Style2', 'mascot-core' ),
					'icon-right'  => esc_html__( 'Right', 'mascot-core' ),
					'icon-right-style2'  => esc_html__( 'Right Style2', 'mascot-core' ),
				],
				'default' => 'icon-top',
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icon Type", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no-icon' => esc_html__( 'No Icon', 'mascot-core' ),
					'font-icon' => esc_html__( 'Font Icon', 'mascot-core' ),
					'icon-text' => esc_html__( 'Text', 'mascot-core' ),
					'image' => esc_html__( 'JPG/PNG Image', 'mascot-core' ),
					'svg-image' => esc_html__( 'SVG Image', 'mascot-core' ),
				],
				'default' => 'font-icon'
			]
		);

		//icon type text
		$this->add_control(
			'text_icon_text',
			[
				'label' => esc_html__( "Icon Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "01", 'mascot-core' ),
				'condition' => [
					'icon_type' => array('icon-text')
				]
			]
		);
		$this->add_control(
			'text_icon_tag',
			[
				'label' => esc_html__( "Text Tag", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h6',
				'condition' => [
					'icon_type' => array('icon-text')
				]
			]
		);


		//image
		$this->add_control(
			'image_icon',
			[
				'label' => esc_html__( "Upload Image Icon", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'image_icon_predefined_image_size',
			[
				'label' => esc_html__( "Choose Predefined Image Size", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'full',
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'image_icon_custom_size',
			[
				'label' => esc_html__( "Image Custom Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				"description" => esc_html__( "Put custom width of the uploaded image in positive value. Example: 120px", 'mascot-core' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-type-image img' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_responsive_control(
			'image_icon_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-type-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);

		//svg image
		$this->add_control(
			'svg_source_code',
			[
				'label' => esc_html__( "SVG Image Source Code (without parent svg tag)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				"description" => esc_html__( "Put SVG image code here", 'mascot-core' ),
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_animation_type',
			[
				'label' => esc_html__( "SVG Animation type", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'delayed' => esc_html__( 'Delayed start', 'mascot-core' ),
					'sync'  => esc_html__( 'Syncronous', 'mascot-core' ),
					'oneByOne'  => esc_html__( 'One By One', 'mascot-core' ),
				],
				'default' => 'delayed',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_animation_delay',
			[
				'label' => esc_html__( "SVG Animation Delay in ms", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Time between the drawing of first and last path, in frames (only for delayed animations)", 'mascot-core' ),
				'default' => '30',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_animation_duration',
			[
				'label' => esc_html__( "SVG Animation Duration", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Time between the drawing of first and last path, in frames (only for delayed animations)", 'mascot-core' ),
				'default' => '100',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_height',
			[
				'label' => esc_html__( "SVG Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '64',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_width',
			[
				'label' => esc_html__( "SVG Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '64',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_container_width',
			[
				'label' => esc_html__( "SVG Image Container Width(in px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '64px',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_stroke_color',
			[
				'label' => esc_html__( "SVG Stroke Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#aaa',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);
		$this->add_control(
			'svg_stroke_width',
			[
				'label' => esc_html__( "SVG Stroke Width (px)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '1px',
				'condition' => [
					'icon_type' => array('svg-image')
				]
			]
		);



		//font icon
		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'mascot-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-chart-bar',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('font-icon')
				]
			]
		);
		$this->end_controls_section();













		$this->start_controls_section(
			'link_options',
			[
				'label' => esc_html__( 'Link URL', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'link_icon_title',
			[
				'label' => esc_html__( "Add Link?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'link_icon_title' => array('yes')
				]
			]
		);
		$this->add_control(
			'link_title',
			[
				'label' => esc_html__( "Also Link to Title?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'link_icon_title' => array('yes')
				]
			]
		);
		$this->end_controls_section();















		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General Settings', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'text-align: {{VALUE}};'
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'iconbox_style',
			[
				'label' => esc_html__( "Icon Box Style", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-default'  =>  esc_html__( 'Default', 'mascot-core' ),
					'iconbox-current-theme-style1'  =>  esc_html__( 'Current Theme Style 1', 'mascot-core' ),
				],
			]
		);
		$this->add_control(
			'box_animation',
			[
				'label' => esc_html__( "Box Animation Style", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  =>  esc_html__( 'No Animation', 'mascot-core' ),
					'iconbox-style1-current-theme-animation'  =>  esc_html__( 'Style 1 - Current Theme Animation', 'mascot-core' ),
					'iconbox-style2-border-bottom'  =>  esc_html__( 'Style 2 - Border Bottom', 'mascot-core' ),
					'iconbox-style3-moving-border-bottom' =>  esc_html__( 'Style 3 - Moving Border Bottom', 'mascot-core' ),
					'iconbox-style4-bgcolor'  =>  esc_html__( 'Style 4 - Hover BG Color', 'mascot-core' ),
					'iconbox-style5-moving-bgcolor' =>  esc_html__( 'Style 5 - Hover Moving BG Color', 'mascot-core' ),
					'iconbox-style6-moving-double-bgcolor'  =>  esc_html__( 'Style 6 - Hover Moving Double BG Color', 'mascot-core' ),
					'iconbox-style7-hover-moving-border'  =>  esc_html__( 'Style 7 - Hover Moving Border Around Box', 'mascot-core' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'iconbox_wrapper_box_default_padding_options',
			[
				'label' => esc_html__( 'Default Padding Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'box_default_padding',
			[
				'label' => esc_html__( "Add Default Padding Around the Box?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'iconbox_wrapper_responsive_options',
			[
				'label' => esc_html__( 'Responsive Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'everything_centered_in_responsive_tablet',
			[
				'label' => esc_html__( "Make everything centered in Tablet?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'everything_centered_in_responsive_mobile',
			[
				'label' => esc_html__( "Make everything centered in Mobile?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);





		$this->add_control(
			'iconbox_wrapper_other_options',
			[
				'label' => esc_html__( 'Other Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'iconbox_wrapper_overflow_hidden',
			[
				'label' => esc_html__( "Wrapper Overflow Hidden", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'overflow: hidden;'
				]
			]
		);
		$this->add_control(
			'switch_title_content_pos',
			[
				'label' => esc_html__( "Switch Title & Content Position", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'title_mt_0_in_desktop',
			[
				'label' => esc_html__( "Make title margin top = 0 in desktop mode?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'iconbox_hover_move_up_animation',
			[
				'label' => esc_html__( "Animate Move Up on Hover?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();




		//text Icon
		$this->start_controls_section(
			'text_icon_options',
			[
				'label' => esc_html__( 'Text Icon Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => array('icon-text')
				]
			]
		);
		$this->add_control(
			'text_icon_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon .icon-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_icon_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon .icon-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_icon_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon .icon-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'text_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon .icon-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_icon_typography',
				'label' => esc_html__( 'Text Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon .icon-text',
			]
		);
		$this->add_responsive_control(
			'text_icon_margin',
			[
				'label' => esc_html__( 'Text Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon .icon-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





















		$this->start_controls_section(
			'icon_basic_styling',
			[
				'label' => esc_html__( 'Icon Basic Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_style_options',
			[
				'label' => esc_html__( 'Icon/Image Style', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => esc_html__( "Icon/Image Area Style", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-default'  =>  esc_html__( 'Default', 'mascot-core' ),
					'icon-rounded'  =>  esc_html__( 'Rounded', 'mascot-core' ),
					'icon-circled'  =>  esc_html__( 'Circled', 'mascot-core' ),
				],
				'default' => 'icon-circled',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( "Icon/Image Area Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-default-bg'  =>  esc_html__( 'Default', 'mascot-core' ),
					'icon-white'  =>  esc_html__( 'White Background', 'mascot-core' ),
					'icon-gray' =>  esc_html__( 'Gray Background', 'mascot-core' ),
					'icon-dark' =>  esc_html__( 'Dark Background', 'mascot-core' )
				],
				'default' => 'icon-gray',
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( "Predefined Icon/Image Size", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-size-default' => esc_html__( 'Default', 'mascot-core' ),
					'icon-xs' => esc_html__( 'Extra Small', 'mascot-core' ),
					'icon-sm' => esc_html__( 'Small', 'mascot-core' ),
					'icon-md' => esc_html__( 'Medium', 'mascot-core' ),
					'icon-lg' => esc_html__( 'Large', 'mascot-core' ),
					'icon-xl' => esc_html__( 'Extra Large', 'mascot-core' )
				],
				'default' => 'icon-md',
			]
		);
		$this->add_control(
			'icon_border_style',
			[
				'label' => esc_html__( "Make Icon/Image Area Bordered?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'icon_vertical_flex_options',
			[
				'label' => esc_html__( 'Vertical/Horizontal Placement (Flex) Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'icon_position' => array('icon-left', 'icon-right')
				]
			]
		);
		$this->add_responsive_control(
			'icon_wrapper_flex_alignment',
			[
				'label' => esc_html__( "Icon Wrapper Horizontal Alignment(Flex)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_horizontal_alignment',
			[
				'label' => esc_html__( "Icon Inner Horizontal Alignment(Flex)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_vertical_alignment',
			[
				'label' => esc_html__( "Icon Inner Vertical Alignment(Flex)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'display:flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .icon i' => 'line-height: 1;',
					'{{WRAPPER}} .icon svg' => 'line-height: 1;',
				],
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
					'translate'  => esc_html__( 'Translate', 'mascot-core' ),
					'translate-x'  => esc_html__( 'Translate X', 'mascot-core' ),
					'translate-y'  => esc_html__( 'Translate Y', 'mascot-core' ),
					'scale'  => esc_html__( 'Scale', 'mascot-core' ),
				],
				'default' => 'rotate-y',
			]
		);
		$this->add_control(
			'animate_icon_infinity',
			[
				'label' => esc_html__( "Animate Infinity", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_animation_type(),
			]
		);
		$this->add_control(
			'icon_hanging_on_top',
			[
				'label' => esc_html__( "Icon Hanging On Top?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'icon_position' => array('icon-top')
				]
			]
		);
		$this->add_control(
			'icon_hanging_custom_margin_top',
			[
				'label' => esc_html__( "Custom Margin Top", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Custom Margin Top to Position Hanging Icon Accurately", 'mascot-core' ),
				'condition' => [
					'icon_hanging_on_top' => array('yes')
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'icon_custom_styling',
			[
				'label' => esc_html__( 'Icon Custom Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon i, {{WRAPPER}} .icon svg',
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hr1-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_area_color_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('font-icon')
				],
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_custom_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('font-icon')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_area_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon BG Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color',
			[
				'label' => esc_html__( "Icon BG Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color_hover',
			[
				'label' => esc_html__( "Icon BG Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_area_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'width: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'icon_area_height',
			[
				'label' => esc_html__( "Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'height: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'icon-line-height',
			[
				'label' => esc_html__( "Icon Line Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon svg' => 'line-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_area_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon',
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'icon_bg_img_styling',
			[
				'label' => esc_html__( 'Icon BG Image Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_icon_bg_img', [
				'label' => esc_html__( "Show Icon BG Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'icon_bg_img_bg_img_dimension_options',
			[
				'label' => esc_html__( 'Dimension', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_width',
			[
				'label' => esc_html__( "Image Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_height',
			[
				'label' => esc_html__( "Image Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_custom_bg_color',
			[
				'label' => esc_html__( "Wrapper Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_custom_bg_color_hover',
			[
				'label' => esc_html__( "Wrapper Custom Background Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_img_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_img_bg_img_options',
			[
				'label' => esc_html__( 'Image Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img',
			[
				'label' => esc_html__( "Icon BG Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'icon_bg_img_opacity_options',
			[
				'label' => esc_html__( 'Opacity Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_opacity',
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
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_opacity_hover',
			[
				'label' => esc_html__( 'Opacity (Hover)', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_bg_img_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon-wrapper .icon-bg-img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_bg_img_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon-wrapper .icon-bg-img',
			]
		);
		$this->add_control(
			'icon_bg_img_z_index',
			[
				'label' => esc_html__( "Z Index", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'z-index: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_pos_options',
			[
				'label' => esc_html__( 'Position Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_orientation_horizontal',
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
			'icon_bg_img_orientation_offset_x',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_horizontal.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_orientation_vertical',
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
			'icon_bg_img_orientation_offset_y',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_vertical.VALUE}}: {{SIZE}}%;',
				],
			]
		);



		$this->add_control(
			'icon_bg_img_pos_hover_options',
			[
				'label' => esc_html__( 'Position(Hover) Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_orientation_horizontal_hover',
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
			'icon_bg_img_orientation_offset_x_hover',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_horizontal_hover.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_orientation_vertical_hover',
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
			'icon_bg_img_orientation_offset_y_hover',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_vertical_hover.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'title_section_styling',
			[
				'label' => esc_html__( 'Title Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .icon-box-title, {{WRAPPER}} .icon-box-title a',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin-top: {{VALUE}};',
					'{{WRAPPER}} .icon-box-title a' => 'margin-top: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin-bottom: {{VALUE}};',
					'{{WRAPPER}} .icon-box-title a' => 'margin-bottom: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .icon-box-title a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .icon-box-title a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-box-title a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box-title' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .icon-box-title a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'content_styling',
			[
				'label' => esc_html__( 'Paragraph Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Paragraph Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .content *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Paragraph Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .content' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .content *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .content, {{WRAPPER}} .content *',
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Paragraph Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();











		$this->start_controls_section(
			'box_styling',
			[
				'label' => esc_html__( 'Icon Box Wrapper Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->start_controls_tabs('tabs_iconbox_wrapper_style');
		$this->start_controls_tab(
			'iconbox_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core'),
			]
		);

		$this->add_responsive_control(
			'iconbox_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'iconbox_wrapper_vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'display: flex; align-items: center;',
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'iconbox_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'iconbox_wrapper_background',
				'label' => esc_html__( 'Background', 'mascot-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-icon-box',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-icon-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-icon-box',
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'iconbox_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core'),
			]
		);
		$this->add_control(
			'iconbox_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'iconbox_wrapper_bg_color_hover',
				'label' => esc_html__( 'Background', 'mascot-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-icon-box',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_options_hover',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-icon-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'iconbox_wrapper_border_hover',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-icon-box',
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_theme_colored_hover',
			[
				'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();








		$this->start_controls_section(
			'bg_shadow_icon_options',
			[
				'label' => esc_html__( 'Background Shadow Icon Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_bg_shadow_icon',
			[
				'label' => esc_html__( "Show Background Shadow Icon?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'bg_shadow_icon_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_shadow_icon_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'bg_shadow_icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .bg-shadow-icon',
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_control(
			'bg_shadow_icon_rotate',
			[
				'label' => esc_html__( 'Rotate Icon', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} .bg-shadow-icon' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} .bg-shadow-icon' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_control(
			'bg_shadow_icon_rotate_hover',
			[
				'label' => esc_html__( 'Rotate Icon (Hover)', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}}:hover .bg-shadow-icon' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}}:hover .bg-shadow-icon' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_control(
			'hr01-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);



		$this->add_control(
			'bg_shadow_icon_orientation_options',
			[
				'label' => esc_html__( 'Position Orientation', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs('bg_shadow_icon_orientation_tabs');
		$this->start_controls_tab(
			'bg_shadow_icon_orientation_tab_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core'),
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_horizontal',
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
			'bg_shadow_icon_orientation_offset_x',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_vertical',
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
			'bg_shadow_icon_orientation_offset_y',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'bg_shadow_icon_orientation_tab_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core'),
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_horizontal_hover',
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
			'bg_shadow_icon_orientation_offset_x_hover',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_horizontal_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_vertical_hover',
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
			'bg_shadow_icon_orientation_offset_y_hover',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_vertical_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'bg_shadow_icon_orientation_tab_oldformat',
			[
				'label' => esc_html__('Old Format', 'mascot-core'),
			]
		);
		$this->add_control(
			'bg_shadow_icon_pos_options',
			[
				'label' => esc_html__( 'Position Options (Old Format)', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_top',
			[
				'label' => esc_html__( "Top", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_right',
			[
				'label' => esc_html__( "Right", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_bottom',
			[
				'label' => esc_html__( "Bottom", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_left',
			[
				'label' => esc_html__( "Left", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'left: {{VALUE}};right:auto;'
				]
			]
		);


		$this->add_control(
			'hr1-pos-hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_control(
			'bg_shadow_icon_pos_hover_options',
			[
				'label' => esc_html__( 'Position(Hover) Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_top_hover',
			[
				'label' => esc_html__( "Top (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_right_hover',
			[
				'label' => esc_html__( "Right (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_bottom_hover',
			[
				'label' => esc_html__( "Bottom (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_left_hover',
			[
				'label' => esc_html__( "Left (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();







		$this->start_controls_section(
			'bg_img_options',
			[
				'label' => esc_html__( 'Background Image Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'add_bg_img_on_hover',
			[
				'label' => esc_html__( "Add BG Image on Hover?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'make_bg_img_always_visible',
			[
				'label' => esc_html__( "Make BG Image Always Visible?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_on_hover',
			[
				'label' => esc_html__( "Background Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_color',
			[
				'label' => esc_html__( "BG Image Overlay Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_color_hover',
			[
				'label' => esc_html__( "BG Image Overlay Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color',
			[
				'label' => esc_html__( "BG Image Overlay Theme Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color_hover',
			[
				'label' => esc_html__( "BG Image Overlay Theme Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color_opacity',
			[
				'label' => esc_html__( 'BG Image Overlay Opacity', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color_opacity_hover',
			[
				'label' => esc_html__( 'BG Image Overlay Opacity (Hover)', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_viewdetails_button_arraylist($this, 1);
		mascot_core_get_viewdetails_button_arraylist($this, 2);
		mascot_core_get_button_arraylist($this, 1);
		mascot_core_get_button_arraylist($this, 2);
		mascot_core_get_button_arraylist($this, 3);
		mascot_core_get_button_arraylist($this, 4);
		mascot_core_get_button_arraylist($this, 5);
		mascot_core_get_button_arraylist($this, 6);
		mascot_core_get_button_arraylist($this, 7);
		mascot_core_get_button_arraylist($this, 8);
		mascot_core_get_button_arraylist($this, 9);
		mascot_core_get_button_arraylist($this, 10);
		mascot_core_get_button_arraylist($this, 11);
		mascot_core_get_button_arraylist($this, 12);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_button_text_color_typo_arraylist($this, 1);
		mascot_core_get_button_text_color_typo_arraylist($this, 2);
		mascot_core_get_button_text_color_typo_arraylist($this, 3);
		mascot_core_get_button_text_color_typo_arraylist($this, 4);
		mascot_core_get_button_text_color_typo_arraylist($this, 5);
		mascot_core_get_button_text_color_typo_arraylist($this, 6);
		mascot_core_get_button_text_color_typo_arraylist($this, 7);
		mascot_core_get_button_text_color_typo_arraylist($this, 8);
		mascot_core_get_button_text_color_typo_arraylist($this, 9);
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


		//link url
		$settings['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';



		//classes
		$classes = array();

		if( $settings['icon_type'] ) {
			$classes[] = 'tm-iconbox-icontype-' . $settings['icon_type'];
		}
		if( $settings['iconbox_style'] ) {
			$classes[] = $settings['iconbox_style'];
		}
		if( $settings['box_animation'] ) {
			$classes[] = $settings['box_animation'];
		}
		if( $settings['add_bg_img_on_hover'] === 'yes' ) {
			$classes[] = 'iconbox-bg-img-on-hover' ;

			if( $settings['make_bg_img_always_visible'] === 'yes' ) {
			$classes[] = 'iconbox-bg-img-on-hover-always-visible' ;
			}
		}
		if( $settings['box_default_padding'] === 'yes' ) {
			$classes[] = 'iconbox-default-padding';
		}
		if( $settings['everything_centered_in_responsive_tablet'] === 'yes' ) {
			$classes[] = 'iconbox-centered-in-responsive-tablet';
		}
		if( $settings['everything_centered_in_responsive_mobile'] === 'yes' ) {
			$classes[] = 'iconbox-centered-in-responsive-mobile';
		}
		if( $settings['title_mt_0_in_desktop'] === 'yes' ) {
			$classes[] = 'iconbox-title-mt-0-desktop';
		}
		if( $settings['iconbox_hover_move_up_animation'] === 'yes' ) {
			$classes[] = 'iconbox-hover-move-up-animation';
		}
		if( $settings['icon_position'] ) {
			$classes[] = 'icon-position-' . $settings['icon_position'];
		}
		if( $settings['icon_position'] == 'icon-top' && $settings['icon_hanging_on_top'] === 'yes' ) {
			$classes[] = 'hanging-icon-top';
		}
		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-icon-on-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}
		if( $settings['custom_css_class'] ) {
			$classes[] = $settings['custom_css_class'];
		}
		$settings['classes'] = $classes;


		//icon classes
		$icon_classes = array();
		if( $settings['icon_type'] ) {
			$icon_classes[] = 'icon-type-'.$settings['icon_type'];
		}
		if( $settings['icon_size'] ) {
			$icon_classes[] = $settings['icon_size'];
		}
		if( $settings['icon_color'] ) {
			$icon_classes[] = $settings['icon_color'];
		}
		if( $settings['icon_style'] ) {
			$icon_classes[] = $settings['icon_style'];
		}
		if( $settings['icon_border_style'] === 'yes' ) {
			$icon_classes[] = 'icon-bordered';
		}
		if( $settings['animate_icon_infinity'] ) {
			$icon_classes[] = $settings['animate_icon_infinity'];
		}

		//icon classes

		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$settings['title_classes'] = $title_classes;


		$settings['icon_parent_inline_css'] = mascot_core_get_inline_css( mascot_core_icon_box_icon_parent_css( $settings ) );

		$settings['svg_animation_data'] = '';
		if (!empty($settings['svg_source_code'])) {
				$settings['svg_animation_data'] = mascot_core_icon_svg_animation_data($settings);
		}
		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'icon-box-' . $settings['icon_position'], null, 'icon-box/tpl', $settings, true );

		echo $html;
	}
}


if(!function_exists('mascot_core_icon_svg_animation_data')) {
	/**
	 * Get SVG Animation Data
	 */
	function mascot_core_icon_svg_animation_data( $params ) {
		$svg_animation_array = array();
		if (!empty($params['svg_source_code'])) {
			//$svg_animation_array['svg_source'] = $params['svg_source_code'];
		}

		if (!empty($params['svg_animation_type'])) {
			$svg_animation_array['data-svg-animation-type'] = $params['svg_animation_type'];
		}
		if (!empty($params['svg_animation_delay'])) {
			// animation delay must be shorter than animation duration
			if ($params['svg_animation_delay'] >= $params['svg_animation_duration']) {
			$svg_animation_array['data-svg-animation-duration-delay'] = $params['svg_animation_duration'] - 1;
			} else {
			$svg_animation_array['data-svg-animation-duration-delay'] = $params['svg_animation_delay'];
			}
		}
		if (!empty($params['svg_animation_duration'])) {
			$svg_animation_array['data-svg-animation-duration'] = $params['svg_animation_duration'];
		}
		if (!empty($params['svg_stroke_color'])) {
			$svg_animation_array['data-svg-stroke-color'] = $params['svg_stroke_color'];
		}
		if (!empty($params['svg_stroke_width'])) {
			$svg_animation_array['data-svg-stroke-width'] = $params['svg_stroke_width'];
		}
		return $svg_animation_array;
	}
}

if(!function_exists('mascot_core_icon_box_icon_parent_css')) {
	/**
	 * Get Icon Parent Styles
	 */
	function mascot_core_icon_box_icon_parent_css( $params ) {
		$css_array = array();
		if( isset($params['icon_position']) && $params['icon_position'] == 'icon-top' && $params['icon_hanging_on_top'] && $params['icon_hanging_custom_margin_top'] != '') {
			$css_array[] = 'margin-top: '.$params['icon_hanging_custom_margin_top'];
		}

		return implode( '; ', $css_array );
	}
}