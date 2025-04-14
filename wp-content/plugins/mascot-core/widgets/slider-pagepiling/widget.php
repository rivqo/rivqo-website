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
class TM_Elementor_PagePiling extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_script( 'jquery-pagepiling', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/slider-pagepiling/jquery.pagepiling.min.js', array('jquery'), false, true );

		wp_register_style( 'jquery-pagepiling', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/js/plugins/slider-pagepiling/jquery.pagepiling' . $direction_suffix . '.css' );
		wp_register_style( 'tm-page-piling-slider-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/extend-plugins/page-piling-slider/page-piling-slider' . $direction_suffix . '.css' );
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
		return 'tm-ele-slider-pagepiling';
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
		return esc_html__( 'Slider - PagePiling', 'mascot-core' );
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
		return [ 'mascot-core-hellojs', 'jquery-pagepiling' ];
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
		return [ 'jquery-pagepiling', 'tm-page-piling-slider-style' ];
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
			'pp_auto_height', [
				'label' => esc_html__( "Make Scrollable Section", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);




		
		$repeater->add_control(
			'hr4-content',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'slide_content_templates',
			[
				'label' => esc_html__('Choose Elementor Template', 'mascot-core'),
				'type' => Controls_Manager::SELECT,
				'options' => mascot_core_get_elementor_templates(),
			]
        );

		$this->add_control(
			'multiscroll_items',
			[
				'label' => esc_html__( "Slides", 'mascot-core' ),
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
			'scrolling_direction',
			[
				'label' => esc_html__( "Scrolling Direction", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'vertical' => esc_html__( 'Vertical', 'mascot-core' ),
					'horizontal' => esc_html__( 'Horizontal', 'mascot-core' )
				],
				'default' => 'vertical',
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
		$html .= '<div id="pagepiling-container" class="tm-page-piling-slider" data-anchor="'.esc_attr( $show_anchor_menu ).'" data-anchor-menu="'.esc_attr( $anchor_menu ).'" data-navigation="'.esc_attr( $show_navigation_bullet_menu ).'" data-navigation-position="'.esc_attr( $navigation_position ).'" data-navigation-tooltip="'.esc_attr( $show_tooltips_on_navigation_bullet_menu ).'" data-navigation-tooltips="'.esc_attr( $tooltips_on_navigation ).'" data-scrolling-speed="'.esc_attr( $scrolling_speed ).'" data-scrolling-direction="'.esc_attr( $scrolling_direction ).'" data-easing="'.esc_attr( $easing ).'" data-looptop="'.esc_attr( $looptop ).'" data-loopbottom="'.esc_attr( $loopbottom ).'">';


		$i = 0;

		$menu_list = explode(',', $anchor_menu);
		if( $show_anchor_menu && !empty($menu_list) ) {
			$html .= '<ul id="tm-page-piling-menu">';
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

		//repeater
		if ( $settings['multiscroll_items'] ) { 
			$settings['iter'] = 1;
			foreach (  $settings['multiscroll_items'] as $item ) {
				$iter = $settings['iter']++;

				//classes
				$item['item'] = $item;

				//classes
				$section_classes = array();
				if ( $item['pp_auto_height'] == 'yes' ) {
					$section_classes[] = 'pp-scrollable';
				}

				$settings['slide_content_templates'] = $item['slide_content_templates'];

				$html .= '<div class="section each-item elementor-repeater-item-' . $item['_id'] . ' '.esc_attr(implode(' ', $section_classes)).'">';
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= mascot_core_get_shortcode_template_part( 'slider-content-item', null, 'slider-pagepiling/tpl', $item, true );
				$html .= '</div>';
			}
		}

		echo $html .= '</div>';
	}
}