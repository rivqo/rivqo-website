<?php
namespace MascotCoreAmiso\Widgets\Staff\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREAMISO\Lib;
use MASCOTCOREAMISO\CPT\Staff\CPT_Staff;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style4 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-cpt-staff/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style4';
	}


	public function get_title() {
		return __( 'Skin - Style4', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		//Content Options
		$this->start_controls_section(
			'skin_4_styling', [
				'label' => esc_html__( 'Skin 4 Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'triangle_border_width',
			[
				'label' => esc_html__( "Border Width", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-thumb:after' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'triangle_bg_custom_bg_color',
			[
				'label' => esc_html__( "Triangle Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-thumb:after' => 'border-color: transparent transparent {{VALUE}} transparent;'
				]
			]
		);
		$this->add_responsive_control(
			'triangle_bg_custom_bg_color_hover',
			[
				'label' => esc_html__( "Triangle Custom Background Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-thumb:after' => 'border-color: transparent transparent {{VALUE}} transparent;'
				]
			]
		);
		$this->add_responsive_control(
			'triangle_bg_theme_colored',
			[
				'label' => esc_html__( "Triangle Background Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-thumb:after' => 'border-color: transparent transparent var(--theme-color{{VALUE}}) transparent;'
				],
			]
		);
		$this->add_responsive_control(
			'triangle_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Triangle Background Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-thumb:after' => 'border-color: transparent transparent var(--theme-color{{VALUE}}) transparent;'
				],
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$new_cpt_class = CPT_Staff::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = amiso_get_isotope_holder_ID('staff');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		$settings['social_list_array'] = $new_cpt_class['social_list'];

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-staff-skin-style4', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/staff/staff-skin-style4' . $direction_suffix . '.css' );


		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_amiso_get_cpt_shortcode_template_part( 'staff', $settings['display_type'], 'staff/tpl', $settings, true );

		echo $html;
	}
}
