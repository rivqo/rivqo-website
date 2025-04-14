<?php
namespace MascotCoreElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Working_Steps extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-working-steps-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/working-steps' . $direction_suffix . '.css' );
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
		return 'tm-ele-working-steps';
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
		return esc_html__( 'Working Steps', 'mascot-core' );
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
		return [ 'tm-working-steps-style' ];
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


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'highlighted',
			[
				'label' => esc_html__( "Highlight Item?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icon Type", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'image' => esc_html__( 'Image', 'mascot-core' ),
					'text' => esc_html__( 'Text', 'mascot-core' ),
					'flaticon' => esc_html__( 'Flat Icon', 'mascot-core' ),
				],
				'default' => 'image'
			]
		);

		//font icon
		$repeater->add_control(
			'icon',
			[
				'label' => __('Icon', 'mascot-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-chart-bar',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('flaticon')
				]
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( "Featured Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload featured image", 'mascot-core' ),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$repeater->add_responsive_control(
			'this_img_width',
			[
				'label' => esc_html__( "Image Holder Dimension (Width and Height)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 400,
						'step' => 1,
					],
				],
				'condition' => [
					'icon_type' => array('image')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .image-holder-wrapper .image-holder' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_responsive_control(
			'this_img_width_img',
			[
				'label' => esc_html__( "Image Dimension (Width and Height)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'icon_type' => array('image')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .image-holder-wrapper .image-holder img' => 'width: {{SIZE}}%;'
				]
			]
		);
		$repeater->add_control(
			'text_img',
			[
				'label' => esc_html__( "Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "01", 'mascot-core' ),
				'condition' => [
					'icon_type' => array('text')
				],
			]
		);
		$repeater->add_responsive_control(
			'this_img_move_top',
			[
				'label' => esc_html__( "Move Top", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .image-holder-wrapper .image-holder' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a title", 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h4'
			]
		);




		$repeater->add_control(
			'tag_options',
			[
				'label' => esc_html__( 'Tag Options', 'mascot-core' ),
				'type'   => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'tag',
			[
				'label' => esc_html__( "Tag On Each Block", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'tag_pos_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'tag_orientation_vertical',
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
		$repeater->add_responsive_control(
			'tag_orientation_offset_y',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .image-holder-wrapper .image-holder .tag' =>
							'{{tag_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'tag_orientation_horizontal',
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
		$repeater->add_responsive_control(
			'tag_orientation_offset_x',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .image-holder-wrapper .image-holder .tag' =>
							'{{tag_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$repeater->add_control(
			'arrow_symbol_img_options',
			[
				'label' => esc_html__( 'Arrow Symbol Image Options', 'mascot-core' ),
				'type'   => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'arrow_symbol_img',
			[
				'label' => esc_html__( "Arrow Symbol Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload Arrow Symbol Image", 'mascot-core' ),
			]
		);
		$repeater->add_responsive_control(
			'arrow_symbol_img_visibility',
			[
				'label' => esc_html__( "Visibility (Show/Hide)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'block' =>  esc_html__( 'Show', 'mascot-core' ),
					'none'  =>  esc_html__( 'Hide', 'mascot-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .arrow-symbol-img' => 'display: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'arrow_symbol_img_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'arrow_symbol_img_orientation_vertical',
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
		$repeater->add_responsive_control(
			'arrow_symbol_img_orientation_offset_y',
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .arrow-symbol-img' =>
							'{{arrow_symbol_img_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'arrow_symbol_img_orientation_horizontal',
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
		$repeater->add_responsive_control(
			'arrow_symbol_img_orientation_offset_x',
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .arrow-symbol-img' =>
							'{{arrow_symbol_img_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'arrow_symbol_img_width',
			[
				'label' => esc_html__( 'Width', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .arrow-symbol-img img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);






		$repeater->add_control(
			'animation_effect', [
				'label' => esc_html__( "On Appeared Animation Effect", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => mascot_core_custom_animation_class_list(),
			]
		);


		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( "Paragraph", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum is simply free text', 'mascot-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'working_steps_item_array',
			[
				'label' => esc_html__( "Working Steps - Item", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( "This is a title 1", 'mascot-core' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( "This is a title 2", 'mascot-core' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( "This is a title 3", 'mascot-core' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( "This is a title 4", 'mascot-core' ),
					],
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'image_options_styling',
			[
				'label' => esc_html__( 'Image Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'image_size',
			[
				'label' => esc_html__( "Choose Featured Image Size", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'thumbnail',
			]
		);
		$this->add_responsive_control(
			'img_width_img',
			[
				'label' => esc_html__( "Image Dimension (Width and Height)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder img' => 'width: {{SIZE}}%;'
				]
			]
		);
		$this->add_responsive_control(
			'img_border_radius',
			[
				'label' => esc_html__( "Image Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .image-holder-inner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'text_img_styling',
			[
				'label' => esc_html__( 'Common - Text Style (Inside Circle Holder)', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_img_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .image-holder .text-img',
			]
		);
		$this->add_control(
			'text_img_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .image-holder .text-img' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'text_img_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder .text-img' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'text_img_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .image-holder .text-img' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_img_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder .text-img' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'text_img_margin',
			[
				'label' => esc_html__( 'Text Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .image-holder .text-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'text_flaticon_styling',
			[
				'label' => esc_html__( 'Common - Flaticon Style (Inside Circle Holder)', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_flaticon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon, {{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon svg',
			]
		);
		$this->add_control(
			'text_flaticon_theme_colored',
			[
				'label' => esc_html__( "Make Flaticon Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_flaticon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Flaticon Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .text-flaticon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .text-flaticon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_flaticon_text_color',
			[
				'label' => esc_html__( "Flaticon Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_flaticon_text_color_hover',
			[
				'label' => esc_html__( "Flaticon Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .text-flaticon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .text-flaticon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'text_flaticon_margin',
			[
				'label' => esc_html__( 'Flaticon Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .text-flaticon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'image_holder_options_styling',
			[
				'label' => esc_html__( 'Circle Image Holder Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'image_placement',
			[
				'label' => esc_html__( "Image Placement", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'image-in-center'	=>	esc_html__( "In center of Circle", 'mascot-core' ),
					'image-full-bg'	=>	esc_html__( "Full Background Image", 'mascot-core' )
				],
				'default' => 'image-in-center',
			]
		);
		$this->add_responsive_control(
			'img_wrapper_width',
			[
				'label' => esc_html__( "Image Holder Dimension (Width and Height)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 400,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'img_holder_border_radius',
			[
				'label' => esc_html__( "Image Holder Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder',
			]
		);
		$this->add_control(
			'img_border_custom_color',
			[
				'label' => esc_html__( "Border Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_border_custom_color_hover',
			[
				'label' => esc_html__( "Border Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_border_theme_colored',
			[
				'label' => esc_html__( "Make Border Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'img_border_theme_colored_hover',
			[
				'label' => esc_html__( "Make Border Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'img_bgcolor_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'img_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Image Wrapper BG Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Image Wrapper BG Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_bg_theme_colored',
			[
				'label' => esc_html__( "Image Wrapper BG Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'img_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Image Wrapper BG Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'img_padding',
			[
				'label' => esc_html__( 'Image Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'img_opacity_options',
			[
				'label' => esc_html__( 'Opacity Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'img_opacity',
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
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'img_opacity_hover',
			[
				'label' => esc_html__( 'Opacity Hover', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_section();









		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Title Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .title',
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
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
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
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();















		$this->start_controls_section(
			'tag_options_styling',
			[
				'label' => esc_html__( 'Small Tag Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tag_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag',
			]
		);
		$this->add_control(
			'tag_text_color',
			[
				'label' => esc_html__( "Text Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'tag_text_color_hover',
			[
				'label' => esc_html__( "Text Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .tag' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'tag_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tag_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .tag' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_control(
			'tag_bg_color',
			[
				'label' => esc_html__( "Background Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'tag_bg_color_hover',
			[
				'label' => esc_html__( "Background Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .tag' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'tag_bg_theme_colored',
			[
				'label' => esc_html__( "Make Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tag_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Make Background Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .tag' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_responsive_control(
			'tag_width',
			[
				'label' => esc_html__( "Dimension (Width and Height)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'tag_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tag_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tag_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag',
			]
		);
		$this->add_control(
			'tag_border_theme_colored',
			[
				'label' => esc_html__( "Make Border Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .image-holder-wrapper .image-holder .tag' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tag_border_theme_colored_hover',
			[
				'label' => esc_html__( "Make Border Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .image-holder-wrapper .image-holder .tag' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();






















		$this->start_controls_section(
			'item_wrapper_styling',
			[
				'label' => esc_html__( 'Item Wrapper Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'item_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover',
			]
		);

		$this->add_control(
			'iconbox_wrapper_bg_color',
			[
				'label' => esc_html__( "Background Custom Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'iconbox_wrapper_bg_color_hover',
			[
				'label' => esc_html__( "Background Custom Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'iconbox_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Make Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'iconbox_wrapper_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Make Background Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'paragraph_options_styling',
			[
				'label' => esc_html__( 'Paragraph Style', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .text-holder, {{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .text-holder *',
			]
		);
		$this->add_control(
			'show_paragraph',
			[
				'label' => __( 'Show Paragraph', 'mascot-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mascot-core' ),
				'label_off' => __( 'Hide', 'mascot-core' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Paragraph Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .text-holder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item .text-holder *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Paragraph Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .text-holder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-working-steps .tm-sc-working-steps-item:hover .text-holder *' => 'color: {{VALUE}};'
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
		$html = '';
		//classes
		$classes = array();
		$classes[] = 'tm-sc-working-steps working-steps-horizontal working-steps-items-' . count($settings['working_steps_item_array']);
		$classes[] = $settings['custom_css_class'];
		$params['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
			<div class="working-steps-bg-holder" ></div>
			<div class="working-steps-inner clearfix">
	<?php
		if ( $settings['working_steps_item_array'] ) {
			$settings['iter'] = 1;
			foreach (  $settings['working_steps_item_array'] as $item ) {
				$iter = $settings['iter']++;


				//classes
				$classes = array();
				$classes[] = 'tm-sc-working-steps-item';
				if( !empty($item['animation_effect']) ) {
					$classes[] = 'tm-animation '.$item['animation_effect'];
				}
				if( $settings['image_placement'] ) {
					$classes[] = $settings['image_placement'];
				}
				if($item['highlighted'] === 'yes') {
					$classes[] = 'working-steps-item-highlighted';
				}
				$classes[] = 'elementor-repeater-item-' . $item['_id'];

				$item['classes'] = $classes;
				$item['image_size'] = $settings['image_size'];
				$item['show_paragraph'] = $settings['show_paragraph'];
				$item['item'] = $item;

				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= mascot_core_get_shortcode_template_part( 'working-steps', null, 'working-steps/tpl', $item, true );
			}
		}
		echo $html;
	?>
			</div>
		</div>
	<?php
	}
}
