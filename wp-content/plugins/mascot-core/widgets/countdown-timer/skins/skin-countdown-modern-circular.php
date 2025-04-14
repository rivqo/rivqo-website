<?php
namespace MascotCoreElementor\Widgets\CountdownTimer\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Countdown_Modern_circular extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-countdown-timer/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-countdown-modern-circular';
	}


	public function get_title() {
		return __( 'Final Countdown - Modern Circular', 'mascot-core' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'countdown_counter_styling',
			[
				'label' => esc_html__( 'Modern Circular Styling', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'timezone',
			[
				'label' => esc_html__( "Timezone", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => sprintf( esc_html__( 'Example: Europe/Zurich. Get your own timezone from %1$shere%2$s.', 'mascot-core' ), '<a target="_blank" href="' . esc_url( 'http://php.net/manual/en/timezones.php' ) . '">', '</a>' ),
			]
		);
		$this->add_control(
			'borderwidth',
			[
				'label' => esc_html__( "Circle Border Width", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '3',
			]
		);
		$this->add_control(
			'bordercolor_second',
			[
				'label' => esc_html__( "Second Border Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#7995D5',
			]
		);
		$this->add_control(
			'bordercolor_minutes',
			[
				'label' => esc_html__( "Minutes Border Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ACC742',
			]
		);
		$this->add_control(
			'bordercolor_hours',
			[
				'label' => esc_html__( "Hours Border Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ECEFCB',
			]
		);
		$this->add_control(
			'bordercolor_days',
			[
				'label' => esc_html__( "Days Border Color", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FF9900',
			]
		);
		$this->end_controls_section();
	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$settings['thisparent'] = $this->parent;

		$this->parent->script_output();
		wp_enqueue_script( 'kinetic' );

		//classes
		$classes = array();
		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'tpl-modern-circular' . null, null, 'countdown-timer/tpl', $settings, true );

		echo $html;
	}
}
