<?php
namespace MascotCoreAmiso\Widgets\PricingPlan;

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
class TM_Elementor_Pricing_Plan extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-pricing-plan-loader', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/pricing-plan/pricing-plan-loader' . $direction_suffix . '.css' );
		}
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
		return 'tm-ele-pricing-plan';
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
		return esc_html__( 'Pricing Plan - Amiso', 'mascot-core-amiso' );
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
		return [ 'tm-pricing-plan-style' ];
	}

	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Pricing_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Pricing_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Pricing_Style3( $this ) );
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
				'label' => esc_html__( 'General', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'default' => ''
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Sample Title", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->add_control(
			'sub_title',
			[
				'label' => esc_html__( "Sub Title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Starts at $14. Includes 2 users", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'p'
			]
		);
		$this->add_control(
			'label_text',
			[
				'label' => esc_html__( "Label/Offer/Tag Text", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Most Popular", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'footer_hint_text',
			[
				'label' => esc_html__( "Footer Hint Text", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "* No credit card required", 'mascot-core-amiso' )
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core-amiso' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();



		//Plan Default
		$this->start_controls_section(
			'price_plan_default',
			[
				'label' => esc_html__( 'Price Plan - Default', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'price',
			[
				'label' => esc_html__( "Price", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "199", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'on_sale', [
				'label' => esc_html__( "On sale?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'price_sale',
			[
				'label' => esc_html__( "Sale Price", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "149", 'mascot-core-amiso' ),
				'condition' => [
					'on_sale' => array('yes')
				],
			]
		);
		$this->add_control(
			'price_prefix',
			[
				'label' => esc_html__( "Prefix (Currency)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "$", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'price_separator',
			[
				'label' => esc_html__( "Separator", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "/", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'price_postfix',
			[
				'label' => esc_html__( "Postfix (Period)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Monthly", 'mascot-core-amiso' )
			]
		);
		$this->end_controls_section();



		//Plan Secondary
		$this->start_controls_section(
			'price_plan_secondary',
			[
				'label' => esc_html__( 'Price Plan - Secondary', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'price_secondary',
			[
				'label' => esc_html__( "Price", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'on_sale_secondary', [
				'label' => esc_html__( "On sale?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'price_sale_secondary',
			[
				'label' => esc_html__( "Sale Price", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "349", 'mascot-core-amiso' ),
				'condition' => [
					'on_sale_secondary' => array('yes')
				],
			]
		);
		$this->add_control(
			'price_prefix_secondary',
			[
				'label' => esc_html__( "Prefix (Currency)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "$", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'price_separator_secondary',
			[
				'label' => esc_html__( "Separator", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "/", 'mascot-core-amiso' )
			]
		);
		$this->add_control(
			'price_postfix_secondary',
			[
				'label' => esc_html__( "Postfix (Period)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Yearly", 'mascot-core-amiso' )
			]
		);
		$this->end_controls_section();







		//Features
		$this->start_controls_section(
			'features_list_repeater',
			[
				'label' => esc_html__( 'Features/Options List', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'features_list_title',
			[
				'label' => esc_html__( "Features Title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "All basic services include:", 'mascot-core-amiso' )
			]
		);
		$this->add_responsive_control(
			'hide_features_list_tooltip',
			[
				'label' => esc_html__( 'Show/Hide Features Tooltip', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-amiso' ),
				'label_off' => __( 'Show', 'mascot-core-amiso' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip' => 'display: {{VALUE}}',
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'disable_item', [
				'label' => esc_html__( "Disable This Item (Blur)?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'line_through', [
				'label' => esc_html__( "Add Line Through Text?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'tooltip_text',
			[
				'label' => esc_html__( "Tooltip Text", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Start your free trial", 'mascot-core-amiso' )
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Text", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => ''
			]
		);
		$this->add_control(
			'features_list',
			[
				'label' => esc_html__( "Features Items", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'content' => esc_html__( "Full Access to the Library", 'mascot-core-amiso' ),
					],
					[
						'content' => esc_html__( "Complete Documentation", 'mascot-core-amiso' ),
					],
					[
						'disable_item' => 'yes',
						'content' => esc_html__( "24/7 Free Support", 'mascot-core-amiso' ),
					],
					[
						'line_through' => 'yes',
						'content' => esc_html__( "Cloud Storage Backup", 'mascot-core-amiso' ),
					],
				],
			]
		);
		$this->end_controls_section();




		//Thumb
		$this->start_controls_section(
			'thumb_options',
			[
				'label' => esc_html__( 'Thumb Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pricing_image',
			[
				'label' => esc_html__( "Pricing Thumbnail Image", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'pricing_image_hover',
			[
				'label' => esc_html__( "Thumbnail Image (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'pricing_predefined_image_size',
			[
				'label' => esc_html__( "Choose Predefined Image Size", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'full',
			]
		);
		$this->add_responsive_control(
			'pricing_image_width',
			[
				'label' => esc_html__( "Image Custom Width", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-thumb img' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'pricing_image_margin',
			[
				'label' => esc_html__( 'Image Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pricing_image_padding',
			[
				'label' => esc_html__( 'Image Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();












		//Features
		$this->start_controls_section(
			'features_list_icon_options',
			[
				'label' => esc_html__( 'List Icons Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_icon',
			[
				'label' => esc_html__( 'Show/Hide Features Icon', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-amiso' ),
				'label_off' => __( 'Show', 'mascot-core-amiso' ),
				'return_value'	=> 'none',
				'default'	=> 'inline-block',
				'selectors' => [
					'{{WRAPPER}} .features-list .icon' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'features_list_icon',
			[
				'label' => esc_html__( 'Icon', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'features_list_icon_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li:hover .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-list li i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'features_list_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-list li:hover .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list .icon',
			]
		);
		$this->add_responsive_control(
			'features_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .features-list .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();














		//Features
		$this->start_controls_section(
			'features_list_styling',
			[
				'label' => esc_html__( 'List Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .features-list li strong' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'features_list_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .features-list li strong' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list li',
			]
		);
		$this->add_control(
			'list_bordered',
			[
				'label' => esc_html__( "Make List(ul, li) Border Bottom?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'features_list_custom_border',
				'label' => esc_html__( 'Custom Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list li',
			]
		);
		$this->add_control(
			'features_list_border_color',
			[
				'label' => esc_html__( "Border Bottom Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'list_bordered' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_border_color_hover',
			[
				'label' => esc_html__( "Border Bottom Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'features_list_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'features_list_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();













		//Features
		$this->start_controls_section(
			'features_list_noaction_icon_options',
			[
				'label' => esc_html__( 'List Disabled Icons Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_noaction_icon',
			[
				'label' => esc_html__( 'Icon', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-circle',
					'library' => 'regular',
				],
			]
		);
		$this->add_control(
			'features_list_noaction_icon_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .no-action i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_noaction_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .no-action:hover i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_noaction_icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list .no-action i',
			]
		);
		$this->end_controls_section();


		//Features
		$this->start_controls_section(
			'features_list_noaction_styling',
			[
				'label' => esc_html__( 'List Disabled Text Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_noaction_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li.no-action' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_noaction_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li.no-action' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_noaction_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list li.no-action',
			]
		);
		$this->end_controls_section();












		//Features
		$this->start_controls_section(
			'features_list_line_through_icon_options',
			[
				'label' => esc_html__( 'List Line Through Icons Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_line_through_icon',
			[
				'label' => esc_html__( 'Icon', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-circle',
					'library' => 'regular',
				],
			]
		);
		$this->add_control(
			'features_list_line_through_icon_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .line-through i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_line_through_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .line-through:hover i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_line_through_icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list .line-through i',
			]
		);
		$this->end_controls_section();


		//Features
		$this->start_controls_section(
			'features_list_line_through_styling',
			[
				'label' => esc_html__( 'List Line Through Text Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_line_through_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li.line-through' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_line_through_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li.line-through' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_line_through_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list li.line-through',
			]
		);
		$this->end_controls_section();






		//Footer Hint Text
		$this->start_controls_section(
			'list_tooltip_options',
			[
				'label' => esc_html__( 'List Tooltip Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'list_tooltip_icon_color',
			[
				'label' => esc_html__( "Tooltip Icon Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_tooltip_icon_typography',
				'label' => esc_html__( 'Tooltip Icon Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list .has-tooltip i',
			]
		);

		$this->add_control(
			'list_tooltip_text_color',
			[
				'label' => esc_html__( "Tooltip Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip:before' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_tooltip_text_typography',
				'label' => esc_html__( 'Tooltip Text Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .features-list .has-tooltip:before',
			]
		);

		$this->add_control(
			'list_tooltip_custom_bg_color',
			[
				'label' => esc_html__( "Tooltip Text Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_tooltip_bg_theme_colored',
			[
				'label' => esc_html__( "Tooltip Text BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();







		//Title
		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_custom_css_class',
			[
				'label' => esc_html__( "Title Custom CSS Class", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-title-area .pricing-plan-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__( 'Title Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();








		//Sub Title
		$this->start_controls_section(
			'sub_title_options',
			[
				'label' => esc_html__( 'Sub Title Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_custom_css_class',
			[
				'label' => esc_html__( "Sub Title Custom CSS Class", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		//Content
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-title-area .pricing-plan-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-title-area .pricing-plan-subtitle',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'subtitle_border',
				'label' => esc_html__( 'Sub Title Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-title-area .pricing-plan-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		//Price
		$this->start_controls_section(
			'price_options',
			[
				'label' => esc_html__( 'Price Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('price_info_style');
		$this->start_controls_tab(
			'price_value_style',
			[
				'label' => esc_html__('Price Value', 'mascot-core-amiso'),
			]
		);
		$this->add_control(
			'price_text_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-price' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-price' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pricing_border',
				'label' => esc_html__( 'Price Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing',
			]
		);
		$this->add_responsive_control(
			'price_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'price_prefix_style',
			[
				'label' => esc_html__('Prefix', 'mascot-core-amiso'),
			]
		);
		$this->add_control(
			'price_prefix_options',
			[
				'label' => esc_html__( 'Price Prefix Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_prefix_text_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_prefix_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-prefix, {{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-prefix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_prefix_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix *',
			]
		);
		$this->add_responsive_control(
			'price_prefix_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_prefix_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'price_separator_style',
			[
				'label' => esc_html__('Separator', 'mascot-core-amiso'),
			]
		);
		$this->add_control(
			'price_separator_options',
			[
				'label' => esc_html__( 'Price Separator Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_separator_text_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_separator_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-separator, {{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-separator *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_separator_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator *',
			]
		);
		$this->add_responsive_control(
			'price_separator_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_separator_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'price_postfix_style',
			[
				'label' => esc_html__('Postfix', 'mascot-core-amiso'),
			]
		);
		$this->add_control(
			'price_postfix_options',
			[
				'label' => esc_html__( 'Price Postfix Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_postfix_text_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_postfix_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-postfix, {{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-postfix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_postfix_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix *',
			]
		);
		$this->add_responsive_control(
			'price_postfix_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_postfix_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();





























		//Title
		$this->start_controls_section(
			'label_offer_options',
			[
				'label' => esc_html__( 'Label/Offer/Tag Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_offer_text_color',
			[
				'label' => esc_html__( "Label Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'label_offer_text_color_hover',
			[
				'label' => esc_html__( "Label Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_offer_typography',
				'label' => esc_html__( 'Label Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .pricing-plan-label',
			]
		);
		$this->add_control(
			'label_offer_custom_bg_color',
			[
				'label' => esc_html__( "Label Custom Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-label' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'label_offer_custom_bg_color_hover',
			[
				'label' => esc_html__( "Label Custom Background Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-label' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'label_offer_theme_colored',
			[
				'label' => esc_html__( "Label Background Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-label' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'label_offer_theme_colored_hover',
			[
				'label' => esc_html__( "Label Background Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-label' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();









		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
				'url' => '',
				'is_external' => true,
				'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'link_secondary',
			[
				'label' => esc_html__( "Link URL - Secondary", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
				'url' => '',
				'is_external' => true,
				'nofollow' => true,
				],
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
				'label' => esc_html__( 'Button Color/Typography', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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










		//Footer Hint Text
		$this->start_controls_section(
			'footer_hint_text_options',
			[
				'label' => esc_html__( 'Footer Hint Text Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		//Content
		$this->add_control(
			'footer_hint_text_color',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-hint-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'footer_hint_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .footer-hint-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'footer_hint_text_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .footer-hint-text',
			]
		);
		$this->add_responsive_control(
			'footer_hint_text_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .footer-hint-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'bg_wrapper_options',
			[
				'label' => esc_html__( 'Wrapper Background Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs('bg_wrapper_option_tabs');
		$this->start_controls_tab(
			'bg_wrapper_option_tab_default',
			[
				'label' => esc_html__('Default', 'mascot-core-amiso'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_wrapper_background',
				'label' => esc_html__( 'Background', 'mascot-core-amiso' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_control(
			'parent_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Wrapper BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'parent_wrapper_border',
				'label' => esc_html__( 'Wrapper Border', 'mascot-core-amiso' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'parent_wrapper_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-amiso' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'bg_wrapper_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-amiso'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_wrapper_background_hover',
				'label' => esc_html__( 'Background', 'mascot-core-amiso' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_control(
			'parent_wrapper_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Wrapper BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'parent_wrapper_border_hover',
				'label' => esc_html__( 'Wrapper Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'parent_wrapper_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-amiso' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'wrapper_margin',
			[
				'label' => esc_html__( 'Parent Wrapper Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label' => esc_html__( 'Parent Wrapper Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Inner Content Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper .pricing-plan-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'parent_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'add_box_shadow_around_table',
			[
				'label' => esc_html__( "Add Default Box Shadow Around Plan?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'make_this_table_featured',
			[
				'label' => esc_html__( "Make This Plan Featured?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => esc_html__( "Featured Pricing Plan has some different looks to highlight it", 'mascot-core-amiso' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'make_hover_effect',
			[
				'label' => esc_html__( "Make Hover Effect on This Plan?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => esc_html__( "There will be a transition when hovering on this table", 'mascot-core-amiso' ),
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'wrapper_bg_before_options',
			[
				'label' => esc_html__( 'Wrapper Background - Before', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('wrapper_bg_before_option_tabs');
		$this->start_controls_tab(
			'wrapper_bg_before_option_tab_default',
			[
				'label' => esc_html__('Default', 'mascot-core-amiso'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_before_background',
				'label' => esc_html__( 'Background', 'mascot-core-amiso' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before',
			]
		);
		$this->add_control(
			'wrapper_bg_before_background_opacity',
			[
				'label' => esc_html__( 'Opacity', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'wrapper_bg_before_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-amiso'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_before_background_hover',
				'label' => esc_html__( 'Background', 'mascot-core-amiso' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before',
			]
		);
		$this->add_control(
			'wrapper_bg_before_background_hover_opacity',
			[
				'label' => esc_html__( 'Opacity', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		$this->start_controls_section(
			'wrapper_bg_after_options',
			[
				'label' => esc_html__( 'Wrapper Background - After', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('wrapper_bg_after_option_tabs');
		$this->start_controls_tab(
			'wrapper_bg_after_option_tab_default',
			[
				'label' => esc_html__('Default', 'mascot-core-amiso'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_after_background',
				'label' => esc_html__( 'Background', 'mascot-core-amiso' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after',
			]
		);
		$this->add_control(
			'wrapper_bg_after_background_opacity',
			[
				'label' => esc_html__( 'Opacity', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'wrapper_bg_after_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-amiso'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_after_background_hover',
				'label' => esc_html__( 'Background', 'mascot-core-amiso' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after',
			]
		);
		$this->add_control(
			'wrapper_bg_after_background_hover_opacity',
			[
				'label' => esc_html__( 'Opacity', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after' => 'opacity: {{SIZE}};',
				],
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
		$settings = $this->get_settings_for_display();

		//link url
		$settings['button']['target'] = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$settings['button']['url'] = $settings['link']['url'];

		//link url - secondary
		$settings['button_secondary_url'] = '';
		if(!empty($settings['link_secondary']['url'])) {
			$settings['button_secondary_url'] = $settings['link_secondary']['url'];
		}

		//classes
		$classes = array();
		$classes[] = (!empty($settings['label_text']) ) ? 'has-label' : '';

		if( $settings['list_bordered'] == 'yes' ) {
			$classes[] = 'pricing-list-bordered';
		}
		if( $settings['make_this_table_featured'] == 'yes' ) {
			$classes[] = 'pricing-plan-featured';
		}
		if( $settings['make_hover_effect'] == 'yes' ) {
			$classes[] = 'pricing-plan-hover-effect';
		}
		if( $settings['add_box_shadow_around_table'] == 'yes' ) {
			$classes[] = 'pricing-plan-box-shadow';
		}

		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$title_classes[] = $settings['title_custom_css_class'];
		$settings['title_classes'] = $title_classes;

		//sub title classes
		$sub_title_classes = array();
		$sub_title_classes[] = $settings['subtitle_custom_css_class'];
		$settings['sub_title_classes'] = $sub_title_classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_amiso_get_shortcode_template_part( 'pricing-plan-skin-default', null, 'pricing-plan/tpl', $settings, true );

		echo $html;
	}
}