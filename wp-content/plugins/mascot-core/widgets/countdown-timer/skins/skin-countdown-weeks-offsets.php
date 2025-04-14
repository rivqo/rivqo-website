<?php
namespace MascotCoreElementor\Widgets\CountdownTimer\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Countdown_Weeks_Offsets extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-countdown-timer/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-countdown-weeks-offsets';
	}


	public function get_title() {
		return __( 'Final Countdown - Weeks + Days', 'mascot-core' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$settings['thisparent'] = $this->parent;

		$this->parent->script_output();

		//classes
		$classes = array();
		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'tpl-weeks-offsets' . null, null, 'countdown-timer/tpl', $settings, true );

		echo $html;
	}
}
