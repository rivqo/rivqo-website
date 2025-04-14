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
class TM_Elementor_Button extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
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
		return 'tm-ele-button';
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
		return esc_html__( 'Button', 'mascot-core' );
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
			'button_text',
			[
				'label' => esc_html__( "Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Read More", 'mascot-core' ),
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
			]
		);
		$this->end_controls_section();



		//add button controns
		mascot_core_get_button_control($this);



		$this->start_controls_section(
			'icon_options', [
				'label' => esc_html__( 'Icon Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'add_icon',
			[
				'label' => esc_html__( "Show/Hide Icon?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'button_icon_left',
			[
				'label' => esc_html__( 'Icon Left', 'mascot-core' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'caret-square-right',
					],
					'fa-regular' => [
						'caret-square-right',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_control(
			'button_icon_right',
			[
				'label' => esc_html__( 'Icon Right', 'mascot-core' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'caret-square-right',
					],
					'fa-regular' => [
						'caret-square-right',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_icon_color',
			[
				'label' => esc_html__( "Icon Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn .btn-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:hover .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn:hover .btn-icon svg' => 'fill: {{VALUE}};',
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

		//link url
		$settings['button']['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['button']['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';


		//classes
		$classes = array();

		//css animation
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'button', null, 'button/tpl', $settings, true );

		echo $html;
	}
}