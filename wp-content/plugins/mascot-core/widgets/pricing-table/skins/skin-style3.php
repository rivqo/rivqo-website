<?php
namespace MascotCoreElementor\Widgets\PricingTable\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Pricing_Style3 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-pricing-table/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style3';
	}


	public function get_title() {
		return __( 'Skin Pricing Style3', 'mascot-core' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();
		
		//link url
		$settings['button']['target'] = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$settings['button']['url'] = $settings['link']['url'];

		//classes
		$classes = array();
		$classes[] = (!empty($settings['label_text']) ) ? 'has-label' : '';

		if( $settings['list_bordered'] == 'yes' ) {
			$classes[] = 'pricing-list-bordered';
		}
		if( $settings['make_this_table_featured'] == 'yes' ) {
			$classes[] = 'pricing-table-featured';
		}
		if( $settings['make_hover_effect'] == 'yes' ) {
			$classes[] = 'pricing-table-hover-effect';
		}
		if( $settings['add_box_shadow_around_table'] == 'yes' ) {
			$classes[] = 'pricing-table-box-shadow';
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
		$html = mascot_core_get_shortcode_template_part( 'pricing-table', $settings['_skin'], 'pricing-table/tpl', $settings, true );

		echo $html;
	}
}
