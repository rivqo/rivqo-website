<?php
namespace MascotCoreElementor\Widgets\InfoBox\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREPIXAA\Lib;
use MASCOTCOREPIXAA\CPT\Testimonials\CPT_Testimonials;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_style7 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-info-box/general/after_section_end', [ $this, 'register_layout_controls1' ] );
	}

	public function get_id() {
		return 'skin-style7';
	}


	public function get_title() {
		return __( 'Skin - Style 7', 'mascot-core' );
	}


	public function register_layout_controls1( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$html = '';
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-info-box-style7', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/info-box/info-box-skin7' . $direction_suffix . '.css' );

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );


		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'info-box', $settings['_skin'], 'info-box/tpl', $settings, true );

		echo $html;

	}
}
