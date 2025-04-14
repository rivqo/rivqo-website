<?php
namespace MascotCoreAmiso\Widgets\Services\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREAMISO\Lib;
use MASCOTCOREAMISO\CPT\Services\CPT_Services;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme3 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-cpt-services/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme3';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme3', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'content_image_position_styling',
			[
				'label' => esc_html__( 'Image Position Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_position', [
				'label' => esc_html__( "Image Position", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'  =>  esc_html__( 'Default', 'mascot-core-amiso' ),
					'bottom-left'  =>  esc_html__( 'Bottom Left', 'mascot-core-amiso' ),
					'top-right'  =>  esc_html__( 'Top Right', 'mascot-core-amiso' ),
					'top-left'  =>  esc_html__( 'Top Left', 'mascot-core-amiso' ),
				],
				'prefix_class' => 'image-position-',
				'default' => 'default'
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style3 .inner-box' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .service-item-current-style3 .inner-box:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style3 .inner-box:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .service-item-current-style3 .inner-box:hover:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style3 .inner-box' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .service-item-current-style3 .inner-box:hover:before' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style3 .inner-box:hover' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .service-item-current-style3 .inner-box:hover:before' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$new_cpt_class = CPT_Services::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = amiso_get_isotope_holder_ID('services');

		$settings = $this->parent->sercice_custom_icon_img( $settings );
		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-service-skin-current-theme3', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/services/service-skin-current-theme3' . $direction_suffix . '.css' );

		//classes
		$classes = array();
		if( $settings['add_border_radius'] ) {
			$classes[] = 'border-radius-around-box';
		}
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		$html = mascot_core_amiso_get_cpt_shortcode_template_part( 'services', $settings['display_type'], 'services/tpl', $settings, true );

		echo $html;
	}
}
