<?php
namespace MascotCoreElementor\Widgets\VideoPopup\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Button_Over_Image2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-video-popup/general/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/tm-ele-video-popup/general/after_section_end', [ $this, 'register_layout_controls_wrapper' ] );
		add_action( 'elementor/element/tm-ele-video-popup/general/after_section_end', [ $this, 'register_layout_controls_play_btn' ] );
	}

	public function get_id() {
		return 'button-over-image2';
	}


	public function get_title() {
		return __( 'Skin - Moveable Play Button Over Image', 'mascot-core' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->add_control(
			'featured_image',
			[
				'label' => esc_html__( "Choose Featured Image", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "You can upload & select background featured image", 'mascot-core' ),
			]
		);
		$this->add_control(
			'featured_image_size',
			[
				'label' => esc_html__( "Featured Image Size", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'large',
			]
		);
		$this->add_control(
			'play_btn',
			[
				'label' => esc_html__( "Choose Play Button From Media", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "You can upload and choose play button from media", 'mascot-core' ),
			]
		);
		$this->add_control(
			'pre_packaged_play_btn',
			[
				'label' => esc_html__( "Or Choose Play Button From Here", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => '',
				'options' => [
					'' => esc_html__( 'Default Animated Button', 'mascot-core' ),
					's1.png' => esc_html__( 'Play Button 1', 'mascot-core' ),
					's1.png' => esc_html__( 'Play Button 1', 'mascot-core' ),
					's2.png' => esc_html__( 'Play Button 2', 'mascot-core' ),
					's3.png' => esc_html__( 'Play Button 3', 'mascot-core' ),
					's4.png' => esc_html__( 'Play Button 4', 'mascot-core' ),
					's5.png' => esc_html__( 'Play Button 5', 'mascot-core' ),
					's6.png' => esc_html__( 'Play Button 6', 'mascot-core' ),
					's7.png' => esc_html__( 'Play Button 7', 'mascot-core' ),
					's8.png' => esc_html__( 'Play Button 8', 'mascot-core' ),
					's9.png' => esc_html__( 'Play Button 9', 'mascot-core' ),
					's10.png' => esc_html__( 'Play Button 10', 'mascot-core' ),
					's11.png' => esc_html__( 'Play Button 11', 'mascot-core' ),
					's12.png' => esc_html__( 'Play Button 12', 'mascot-core' ),
					's13.png' => esc_html__( 'Play Button 13', 'mascot-core' ),
					's14.png' => esc_html__( 'Play Button 14', 'mascot-core' ),
					's15.png' => esc_html__( 'Play Button 15', 'mascot-core' ),
					's16.png' => esc_html__( 'Play Button 16', 'mascot-core' ),
					's17.png' => esc_html__( 'Play Button 17', 'mascot-core' )
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title Text", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
	}









	public function register_layout_controls_wrapper( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'wrapper_styling',
			[
				'label' => esc_html__( 'Wrapper Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'button_over_image_window_height',
			[
				'label' => esc_html__( "Window Height", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup .effect-wrapper' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'featured_image_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
	}









	public function register_layout_controls_play_btn( Widget_Base $widget ) {
		$this->parent = $widget;


		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Play Button Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_orientation_options',
			[
				'label' => esc_html__( 'Icon Position', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_orientation_vertical',
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
			'icon_orientation_offset_y',
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
					'{{WRAPPER}} .video-play-button' =>
							'{{button_over_image2_icon_orientation_vertical.VALUE}}: {{SIZE}}%; transform:translate(0%, 0%)',
				],
			]
		);
		$this->add_responsive_control(
			'icon_orientation_horizontal',
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
			'icon_orientation_offset_x',
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
					'{{WRAPPER}} .video-play-button' =>
							'{{button_over_image2_icon_orientation_horizontal.VALUE}}: {{SIZE}}%; transform:translate(0%, 0%)',
				],
			]
		);




		$this->start_controls_tabs('tabs_icon_style');
		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core'),
			]
		);
		$this->add_control(
			'icon_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( "Icon Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .video-play-button',
			]
		);
		$this->add_control(
			'icon_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'iconb_bg_color',
			[
				'label' => esc_html__( "Icon Custom Background Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-play-button .bg-block' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon Background Theme Colored", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-play-button .bg-block' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_color_opacity',
			[
				'label' => esc_html__( 'BG Colored Opacity', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-play-button .bg-block' => 'opacity: {{SIZE}};',
				]
			]
		);
		$this->add_control(
			'icon_size_options',
			[
				'label' => esc_html__( 'Size Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Dimension (Width and Height)", 'mascot-core' ),
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
					'{{WRAPPER}} .video-play-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .video-play-button',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
				'selector' => '{{WRAPPER}} .video-play-button',
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core'),
			]
		);
		$this->add_control(
			'icon_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_options_hover',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( "Icon Custom Background Color (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button .bg-block' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Background Theme Colored (Hover)", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button .bg-block' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_color_opacity_hover',
			[
				'label' => esc_html__( 'BG Colored Opacity', 'mascot-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button .bg-block' => 'opacity: {{SIZE}};',
				]
			]
		);
		$this->add_control(
			'icon_size_options_hover',
			[
				'label' => esc_html__( 'Size Options', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width_hover',
			[
				'label' => esc_html__( "Dimension (Width and Height)", 'mascot-core' ),
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
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-sc-video-popup';

		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'video-popup', $settings['_skin'], 'video-popup/tpl', $settings, true );

		echo $html;
	}
}