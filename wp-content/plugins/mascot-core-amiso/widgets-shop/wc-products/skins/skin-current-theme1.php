<?php
namespace MascotCoreAmiso\Widgets\Products\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREPIXAA\Lib;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Current_Theme1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-wc-products/tm_general/after_section_end', [ $this, 'register_layout_controls1' ] );
	}

	public function get_id() {
		return 'skin-current-theme1';
	}


	public function get_title() {
		return __( 'Skin - Current Theme1', 'mascot-core-amiso' );
	}



	public function register_layout_controls1( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->start_controls_section(
			'paragraph_opt',
			[
				'label' => esc_html__( 'Content - Paragraph', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'excerpt_length', [
				'label' => esc_html__( "Excerpt Length", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				"description" => esc_html__( "Number of words to display. Example: 25. Default all", 'mascot-core-amiso' ),
				'default' => 12,
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$class_instance =  '';

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('wc-product');
		return $this->parent->wc_render_output( $class_instance, $settings );
	}
}
