<?php

class Mascot_Core_Amiso_Modify_Widgets {
	private static $instance;
	public $sections = array();

	public function __construct() {
		//add_action( 'elementor/element/tm-ele-section-title/subtitle_options_styling/after_section_end', array( $this, 'tm_elementor_column_options' ), 10, 2 );
	}

	public static function get_instance() {
		if ( self::$instance === null ) {
			return new self();
		}

		return self::$instance;
	}

	public function tm_elementor_column_options( $element ){


		$element->start_controls_section(
			'subtitle_extra_options_styling',
			[
				'label' => esc_html__( 'Sub Title BG Gradient Color', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_control(
			'subtitle_wrapper_after_background',
			[
				'label' => esc_html__( "Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle:after' => 'background: {{VALUE}};'
				]
			]
		);
		$element->end_controls_section();
	}
}

if ( ! function_exists( 'mascot_core_amiso_init_modify_widgets_handler' ) ) {
	function mascot_core_amiso_init_modify_widgets_handler() {
		Mascot_Core_Amiso_Modify_Widgets::get_instance();
	}

	add_action( 'init', 'mascot_core_amiso_init_modify_widgets_handler', 1 );
}