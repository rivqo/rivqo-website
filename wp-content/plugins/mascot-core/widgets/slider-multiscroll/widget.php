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
class TM_Elementor_MultiScroll extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_script( 'jquery-multiscroll-extensions', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/slider-multiscroll/jquery.multiscroll.extensions.min.js', array('jquery'), false, true );
		wp_register_script( 'multiscroll-responsiveexpand', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/slider-multiscroll/multiscroll.responsiveexpand.min.js', array('jquery'), false, true );

		wp_register_style( 'jquery-multiscroll', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/js/plugins/slider-multiscroll/jquery.multiscroll' . $direction_suffix . '.css' );
		wp_register_style( 'tm-multi-scroll-slider-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/extend-plugins/multi-scroll-slider/multi-scroll-slider' . $direction_suffix . '.css' );
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
		return 'tm-ele-slider-multiscroll';
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
		return esc_html__( 'Slider - Multi Scroll', 'mascot-core' );
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
		return [ 'mascot-core-hellojs', 'jquery-multiscroll-extensions', 'multiscroll-responsiveexpand' ];
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
		return [ 'jquery-multiscroll', 'tm-multi-scroll-slider-style' ];
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
		//Content Options
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'Content', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'slide_layout',
			[
				'label' => esc_html__( "Slide Layout", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Block Left', 'mascot-core' ),
					'right' => esc_html__( 'Block Right', 'mascot-core' )
				],
				'default' => 'left'
			]
		);
		$repeater->add_control(
			'hide_this_section_in_responsive',
			[
				'label' => esc_html__( 'Hide this Item in Responsive', 'mascot-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core' ),
				'label_off' => __( 'Show', 'mascot-core' ),
			]
		);
		$repeater->add_control(
			'tabs_content_type',
			[
				'label' => esc_html__('Content Type', 'mascot-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'template' => esc_html__('Elementor Templates', 'mascot-core'),
					'bg-img' => esc_html__('No Content', 'mascot-core'),
				],
				'default' => 'template',
			]
		);
		$repeater->add_control(
			'slide_content_templates',
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
			'hr1-bg',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'mascot-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => [
					'tabs_content_type' => 'bg-img',
				],
			]
		);



		$repeater->add_control(
			'hr2-wrapper',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Wrapper Text Alignment", 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .section-wrapper' => 'text-align: {{VALUE}};'
				],
			]
		);
		$repeater->add_responsive_control(
			'wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .section-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .section-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'multiscroll_items',
			[
				'label' => esc_html__( "Fields", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();













		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'Slider Settings', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_anchor_menu', [
				'label' => esc_html__( "Show Anchor Menu", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'anchor_menu', [
				'label' => esc_html__( "Anchor Menu Items", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Put menu items seperated by comma. As for example: Home, Services, Contact", 'mascot-core' ),
				'default' => esc_html__( "Home, Services, Contact", 'mascot-core' ),
				'condition' => [
					'show_anchor_menu' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_navigation_bullet_menu', [
				'label' => esc_html__( "Show Navigation Bullet Menu", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'navigation_position',
			[
				'label' => esc_html__( "Navigation Position", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'right' => esc_html__( 'Right', 'mascot-core' ),
					'left' => esc_html__( 'Left', 'mascot-core' )
				],
				'default' => 'right',
				'condition' => [
					'show_navigation_bullet_menu' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_tooltips_on_navigation_bullet_menu', [
				'label' => esc_html__( "Show Tooltips on Navigation Bullet Menu", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'tooltips_on_navigation', [
				'label' => esc_html__( "Tooltips on Navigation Bullets", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Put Tooltips seperated by comma. As for example: Home, Services, Contact", 'mascot-core' ),
				'default' => esc_html__( "Home, Services, Contact", 'mascot-core' ),
				'condition' => [
					'show_tooltips_on_navigation_bullet_menu' => array('yes')
				]
			]
		);
		$this->add_control(
			'scrolling_speed', [
				'label' => esc_html__( "Scrolling Speed", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Defines the scrolling speed in milliseconds. Default: 700", 'mascot-core' ),
				'default' => '700'
			]
		);
		$this->add_control(
			'responsive_width', [
				'label' => esc_html__( "Responsive Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Normal scroll will be used under the defined width in pixels. Default: 1200", 'mascot-core' ),
				'default' => '1200',
			]
		);
		$this->add_control(
			'easing',
			[
				'label' => esc_html__( "Easing", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_jquery_easings_list(),
				'default' => 'easeInQuart',
				"description" => esc_html__( "Defines the transition effect to use for the vertical and horizontal scrolling. Default: easeInQuart", 'mascot-core' ),
			]
		);
		$this->add_control(
			'looptop', [
				'label' => esc_html__( "Loop Top", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'loopbottom', [
				'label' => esc_html__( "Loop Bottom", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
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
		extract($settings);

		//classes
		if( $show_anchor_menu == 'yes' ) {
			$show_anchor_menu = 'true';
		}
		if( $show_navigation_bullet_menu == 'yes' ) {
			$show_navigation_bullet_menu = 'true';
		}
		if( $show_tooltips_on_navigation_bullet_menu == 'yes' ) {
			$show_tooltips_on_navigation_bullet_menu = 'true';
		}
		if( $looptop == 'yes' ) {
			$looptop = 'true';
		}
		if( $loopbottom == 'yes' ) {
			$loopbottom = 'true';
		}
		$settings['settings'] = $settings;

		$html = "";
		$html .= '<div class="tm-divided-multi-scrolling-slider" data-anchor="'.esc_attr( $show_anchor_menu ).'" data-anchor-menu="'.esc_attr( $anchor_menu ).'" data-navigation="'.esc_attr( $show_navigation_bullet_menu ).'" data-navigation-position="'.esc_attr( $navigation_position ).'" data-navigation-tooltip="'.esc_attr( $show_tooltips_on_navigation_bullet_menu ).'" data-navigation-tooltips="'.esc_attr( $tooltips_on_navigation ).'" data-scrolling-speed="'.esc_attr( $scrolling_speed ).'" data-responsive-width="'.esc_attr( $responsive_width ).'" data-easing="'.esc_attr( $easing ).'" data-looptop="'.esc_attr( $looptop ).'" data-loopbottom="'.esc_attr( $loopbottom ).'">';
		$i = 0;

		$menu_list = explode(',', $anchor_menu);
		if( $show_anchor_menu && !empty($menu_list) ) {
			$html .= '<ul id="multi-scrolling-menu">';
			foreach( $menu_list as $item ) {
				$item = trim( $item );
				$active = '';
				if($i==0) {
					$active = 'class="active"';
				}
				$html .= '<li data-menuanchor="'. esc_attr( $item ).'" '.esc_attr( $active ).'><a href="#'. esc_attr( $item ) .'">'. esc_html( $item ) .'</a></li>';
				$i++;
			}
			$html .= '</ul>';
		}

		//ms-left
		$html .= '<div class="ms-left">';
		if ( $settings['multiscroll_items'] ) { 
			$settings['iter'] = 1;
			foreach (  $settings['multiscroll_items'] as $item ) {
				$iter = $settings['iter']++;

				//classes
				$item['item'] = $item;


				if( $item['slide_layout'] == 'left' ) {
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= mascot_core_get_shortcode_template_part( 'slider-content-item', null, 'slider-multiscroll/tpl', $item, true );
				}
			}
		} 
		$html .= '</div>';

		//ms-right
		$html .= '<div class="ms-right">';
		if ( $settings['multiscroll_items'] ) { 
			$settings['iter'] = 1;
			foreach (  $settings['multiscroll_items'] as $item ) {
				$iter = $settings['iter']++;

				//classes
				$item['item'] = $item;


				if( $item['slide_layout'] == 'right' ) {
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= mascot_core_get_shortcode_template_part( 'slider-content-item', null, 'slider-multiscroll/tpl', $item, true );
				}
			}
		} 
		$html .= '</div>';

		echo $html .= '</div>';
	}
}