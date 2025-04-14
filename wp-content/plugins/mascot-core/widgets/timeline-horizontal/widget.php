<?php
namespace MascotCoreElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Timeline_Horizontal extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		//CD timeline horizontal
		wp_register_script( 'timeline-cd-horizontal', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/timeline-cd-horizontal/js/timeline-cd-horizontal.js', array('jquery'), false, true );
		wp_register_style( 'timeline-cd-horizontal', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/timeline-cd-horizontal/css/timeline-cd-horizontal.css' );
		wp_register_style( 'timeline-cd-horizontal-rtl', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/timeline-cd-horizontal/css/timeline-cd-horizontal-rtl.css' );
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
		return 'tm-ele-timeline-horizontal';
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
		return esc_html__( 'TM Timeline Horizontal', 'mascot-core' );
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
		return [ 'mascot-core-hellojs', 'timeline-cd-horizontal' ];
	}


	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 *
	 * @since 1.9.0
	 * @access public
	 *
	 * @return array Element styles dependencies.
	 */
	public function get_style_depends() {
		if( is_rtl() ) {
			return [ 'timeline-cd-horizontal-rtl' ];
		} else {
			return [ 'timeline-cd-horizontal' ];
		}
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



		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'date',
			[
				'label' => esc_html__( "Date (DD/MM/YYYY)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'd/m/Y',
				],
				'default' => date('d/m/Y', strtotime("+6 months", current_time('timestamp', 0))),
			]
		);
		$repeater->add_control(
			'selected',
			[
				'label' => esc_html__( "Make It Selected?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_control(
			'tabs_content_type',
			[
				'label' => esc_html__('Content Type', 'mascot-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'content' => esc_html__('Content', 'mascot-core'),
					'template' => esc_html__('Elementor Templates', 'mascot-core'),
				],
				'default' => 'content',
			]
		);
		$repeater->add_control(
			'tabs_content_templates',
			[
				'label' => esc_html__('Choose Elementor Template', 'mascot-core'),
				'type' => Controls_Manager::SELECT,
				'options' => mascot_core_get_elementor_templates(),
				'condition' => [
					'tabs_content_type' => 'template',
				],
			]
		);
		$repeater->add_control(
			'tabs_content',
			[
				'label' => esc_html__('Tab Content', 'mascot-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.", 'mascot-core' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [
					'tabs_content_type' => 'content',
				],
			]
		);
		$this->add_control(
			'tabs_items',
			[
				'label' => esc_html__( "Item", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => date('Y', strtotime("-78 months", current_time('timestamp', 0))),
						'date' => date('d/m/Y', strtotime("-78 months", current_time('timestamp', 0))),
						'selected' => 'yes',
					],
					[
						'title' => date('Y', strtotime("-64 months", current_time('timestamp', 0))),
						'date' => date('d/m/Y', strtotime("-64 months", current_time('timestamp', 0))),
					],
					[
						'title' => date('Y', strtotime("-53 months", current_time('timestamp', 0))),
						'date' => date('d/m/Y', strtotime("-53 months", current_time('timestamp', 0))),
					],
					[
						'title' => date('Y', strtotime("-42 months", current_time('timestamp', 0))),
						'date' => date('d/m/Y', strtotime("-42 months", current_time('timestamp', 0))),
					],
					[
						'title' => date('Y', strtotime("-24 months", current_time('timestamp', 0))),
						'date' => date('d/m/Y', strtotime("-24 months", current_time('timestamp', 0))),
					],
					[
						'title' => date('Y', strtotime("-11 months", current_time('timestamp', 0))),
						'date' => date('d/m/Y', strtotime("-11 months", current_time('timestamp', 0))),
					],
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'title_content_placement_styling',
			[
				'label' => esc_html__( 'Title Content Placement', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'goal_raised_flex_direction',
			[
				'label' => esc_html__( "Title & Content Ordering", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'mascot-core' ),
					'column' => esc_html__( 'Title + Content', 'mascot-core' ),
					'column-reverse' => esc_html__( 'Content + Title, in reverse order', 'mascot-core' ),
				),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cd-horizontal-timeline' => 'display:flex; flex-direction: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'title_styling',
			[
				'label' => esc_html__( 'Tab Title Text Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_title_style');
		$this->start_controls_tab(
			'title_style_normal',
			[
				'label' => esc_html__('Idle', 'mascot-core'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .events a',
			]
		);
		$this->add_control(
			'title_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_title_margin',
			[
				'label' => esc_html__('Margin', 'mascot-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_style_active',
			[
				'label' => esc_html__('Active', 'mascot-core'),
			]
		);
		$this->add_control(
			'title_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a.selected' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_active',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a.selected' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();




		$this->start_controls_tab(
			'title_style_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core'),
			]
		);
		$this->add_control(
			'title_text_color_options_hover',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
























		/**
		 * STYLE -> Bullet Circle
		 */

		$this->start_controls_section(
			'section_style_bullet_icon',
			[
				'label' => esc_html__('Bullet/Circle', 'mascot-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'bullet_icon_image_width',
			[
				'label' => esc_html__('Bullet Width', 'mascot-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a::after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_icon_image_vertical_pos',
			[
				'label' => esc_html__('Vertical Position', 'mascot-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -30,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a::after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_progress_goal_block_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_progress_goal_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .events a::after',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_progress_goal_block_border',
				'label' => esc_html__( 'Border', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .events a::after',
			]
		);

		$this->start_controls_tabs( 'bullet_icon_tabs' );
		$this->start_controls_tab(
			'bullet_icon_idle',
			[ 'label' => esc_html__('Idle', 'mascot-core') ]
		);
		$this->add_control(
			'bullet_icon_color',
			[
				'label' => esc_html__('Bullet Color', 'mascot-core'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a::after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bullet_icon_theme_colored',
			[
				'label' => esc_html__( "Bullet Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a::after' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'bullet_icon_active',
			[ 'label' => esc_html__('Active', 'mascot-core') ]
		);
		$this->add_control(
			'bullet_icon_color_active',
			[
				'label' => esc_html__('Bullet Color', 'mascot-core'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a.selected::after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bullet_icon_theme_colored_active',
			[
				'label' => esc_html__( "Bullet Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a.selected::after' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'bullet_icon_older',
			[ 'label' => esc_html__('Older', 'mascot-core') ]
		);
		$this->add_control(
			'bullet_icon_color_older',
			[
				'label' => esc_html__('Bullet Color', 'mascot-core'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a.older-event::after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bullet_icon_theme_colored_older',
			[
				'label' => esc_html__( "Bullet Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events a.older-event::after' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();





		/**
		 * STYLE -> Horizontal Filling Line
		 */

		$this->start_controls_section(
			'section_style_horizontal_filling_line',
			[
				'label' => esc_html__('Horizontal Filling Line', 'mascot-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'horizontal_filling_line_height',
			[
				'label' => esc_html__('Bullet Width', 'mascot-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'horizontal_filling_line_tabs' );
		$this->start_controls_tab(
			'horizontal_filling_line_idle',
			[ 'label' => esc_html__('Idle', 'mascot-core') ]
		);
		$this->add_control(
			'horizontal_filling_line_color',
			[
				'label' => esc_html__('Filling Line Color', 'mascot-core'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'horizontal_filling_line_theme_colored',
			[
				'label' => esc_html__( "Filling Line Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'horizontal_filling_line_active',
			[ 'label' => esc_html__('Active', 'mascot-core') ]
		);
		$this->add_control(
			'horizontal_filling_line_color_active',
			[
				'label' => esc_html__('Filling Line Color', 'mascot-core'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events .filling-line' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'horizontal_filling_line_theme_colored_active',
			[
				'label' => esc_html__( "Filling Line Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events .filling-line' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		/**
		 * STYLE -> CONTENT
		 */

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'mascot-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_content_typo',
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .events-content',
			]
		);
		$this->add_responsive_control(
			'tabs_content_padding',
			[
				'label' => esc_html__('Padding', 'mascot-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_content_margin',
			[
				'label' => esc_html__('Margin', 'mascot-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tabs_content_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'tabs_content_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'tabs_content_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'tabs_content_bgcolor_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'tabs_content_bg_color',
			[
				'label' => esc_html__('Content Background Color', 'mascot-core'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => [ 'active' => true ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_content_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tabs_content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mascot-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tabs_content_border',
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .events-content',
			]
		);
		$this->add_responsive_control(
			'tabs_content_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .events-content' => 'border-color: var(--theme-color{{VALUE}}) !important;'
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
		$html = '';
		$settings = $this->get_settings_for_display();


		//classes
		$classes = array();
		$classes[] = 'tm-sc-horizontal-timeline';

		$settings['classes'] = $classes;

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('tabs');
		$settings['rand'] = rand(10,100);
	?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<div class="cd-horizontal-timeline">
		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list = array();
				$i=1;
		?>
			<div class="timeline">
				<div class="events-wrapper">
					<div class="events">
			<ol>
			<?php
				foreach (  $settings['tabs_items'] as $item ) {
					$tab_id_list[$i] = 'tab-'.$settings['holder_id'].'-'.$i;
					$settings['title'] = $item['title'];
					$settings['date'] = $item['date'];
					$settings['selected'] = $item['selected'];
					$settings['i'] = $i;
					$settings['tab_id_list'] = $tab_id_list;


					//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
					$html .= mascot_core_get_shortcode_template_part( 'timeline-title', null, 'timeline-horizontal/tpl', $settings, false );
					$i++;
				}
			?>
			</ol>

						<span class="filling-line" aria-hidden="true"></span>
					</div>
				</div>

				<ul class="cd-timeline-navigation">
					<li><a href="#0" class="prev inactive"><?php echo esc_html__( 'Previous', 'mascot-core' ); ?></a></li>
					<li><a href="#0" class="next"><?php echo esc_html__( 'Next', 'mascot-core' ); ?></a></li>
				</ul>
			</div>
		<?php
			}
		?>


		<?php
			if ( $settings['tabs_items'] ) {
				$i=1;
		?>
			<div class="events-content"><ol>
			<?php
				foreach (  $settings['tabs_items'] as $item ) {
					$tab_id_list2[$i] = 'tab-'.$settings['holder_id'].'-'.$i;
					$settings['selected'] = $item['selected'];
					$settings['i'] = $i;
					$settings['tabs_content_type'] = $item['tabs_content_type'];
					$settings['tabs_content_templates'] = $item['tabs_content_templates'];
					$settings['tabs_content'] = $item['tabs_content'];
					$settings['title'] = $item['title'];
					$settings['date'] = $item['date'];


					//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
					$html .= mascot_core_get_shortcode_template_part( 'timeline-content', null, 'timeline-horizontal/tpl', $settings, false );
					$i++;
				}
			?>
			</ol></div>
		<?php
			}
		?>
		</div>
		</div>
	<?php
	}
}