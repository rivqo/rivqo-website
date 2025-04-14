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
class TM_Elementor_Rotated_Text extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-rotated-text-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/rotated-text' . $direction_suffix . '.css' );
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
		return 'tm-ele-rotated-text';
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
		return esc_html__( 'Rotated Text', 'mascot-core' );
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
		return [ 'tm-rotated-text-style' ];
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
			'image_rotate_text',
			[
				'label' => esc_html__( "Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$this->add_control(
			'enable_vertical_writing_mode',
			[
				'label' => esc_html__( "Vertical Writing Mode", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'visible_mobile',
			[
				'label' => esc_html__( "Visible on Mobile Devices?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_textillate_animation',
			[
				'label' => esc_html__( "Textillate Animation on Text?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'rotate_text',
			[
				'label' => esc_html__( 'Rotate', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'deg' => [
						'min' => -90,
						'max' => 90,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => -90,
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'placement',
			[
				'label' => esc_html__( 'Placement', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'pos_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'pos_orientation_vertical',
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
			'pos_orientation_offset_y',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -700,
						'max' => 700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'position: relative;',
					'{{WRAPPER}} .text-holder' =>
							'{{pos_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pos_orientation_horizontal',
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
			'pos_orientation_offset_x',
			[
				'label' => __( 'Offset', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -700,
						'max' => 700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'position: relative;',
					'{{WRAPPER}} .text-holder' =>
							'{{pos_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( "Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .text-holder' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'z_index',
			[
				'label' => esc_html__( "Z Index", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'opacity',
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
					'{{WRAPPER}} .text' => 'opacity: {{SIZE}};'
				],
			]
		);
		$this->end_controls_section();





















		$this->start_controls_section(
			'color_typo',
			[
				'label' => esc_html__( 'Color/Typography', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .text',
			]
		);
		$this->add_control(
			'show_stroke_text',
			[
				'label' => esc_html__( "Show Stroke in Text?", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'text_stroke_size',
			[
				'label' => esc_html__( 'Text Stroke Size', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'condition' => [
					'show_stroke_text' => array('yes'),
				]
			]
		);
		$this->add_control(
			'title_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .text' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);










		$this->add_control(
			'title_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_bg_color_hover',
			[
				'label' => esc_html__( "Background Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .text' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .text' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .text' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_responsive_control(
			'icon_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .text-holder' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];
		if ( $settings['visible_mobile'] != 'yes' ) {
			$classes[] = 'd-none d-lg-block';
		}
		if ( $settings['enable_vertical_writing_mode'] == 'yes' ) {
			$classes[] = 'writing-mode-vertical';
		}
		$settings['classes'] = $classes;
		$settings['text_inline_css'] = $this->inline_css( $settings );

		$settings['text_class'] = '';
		if ( $settings['enable_textillate_animation'] == 'yes' ) {
			wp_enqueue_script( 'jquery-lettering' );
			wp_enqueue_script( 'jquery-textillate' );
			$settings['text_class'] = 'tm-textillate-animation';
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'rotated-text', null, 'rotated-text/tpl', $settings, true );

		echo $html;
	}


	/**
	 * Get Wrapper Styles
	 */
	protected function inline_css( $params ) {
		$css_array = array();

		if( isset($params['rotate_text']['size']) ) {
			$css_array[] = '-webkit-transform: rotate('.$params['rotate_text']['size'].'deg)';
			$css_array[] = '-ms-transform: rotate('.$params['rotate_text']['size'].'deg)';
			$css_array[] = 'transform: rotate('.$params['rotate_text']['size'].'deg)';
		}


		if( $params['z_index'] != '' ) {
			$css_array[] = 'z-index: '.$params['z_index'];
		}
		if ( $params['show_stroke_text'] != 'yes' ) {
			$css_array[] = '-webkit-text-stroke: unset';
		}
		if( $params['show_stroke_text'] == 'yes' && $params['title_text_color'] != '' ) {
			$css_array[] = '-webkit-text-stroke: '.$params['text_stroke_size']['size'].'px '.$params['title_text_color'];
		}

		$css_array = implode( '; ', $css_array ).';';

		return $css_array;
	}
}
