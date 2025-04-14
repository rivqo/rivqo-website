<?php

/*
 * Adds Mascot_Core_Amiso_Widget_OpeningHoursCompressed widget.
 */
if( !class_exists( 'Mascot_Core_Amiso_Widget_OpeningHoursCompressed' ) ) {
class Mascot_Core_Amiso_Widget_OpeningHoursCompressed extends Mascot_Core_Amiso_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-opening-hours-compressed clearfix',
			'description'	=> esc_html__( 'The widget lets you easily display Opening Hours in compressed mode.', 'mascot-core-amiso' ),
		);
		parent::__construct( 'tm_widget_opening_hours_compressed', esc_html__( '(TM) Opening Hours - Compressed', 'mascot-core-amiso' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {

		$this->formFields = array(
			array(
				'id'		=> 'title',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Widget Title:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Opening Hours', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'border_color',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Border Color:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'border-light'  => 'Border Light',
					'border-dark'   => 'Border Dark',
				)
			),


			//Day 1
			array(
				'id'		=> 'day_1',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 1:', 'mascot-core-amiso' ),
				'default'	=> esc_html__( 'Monday - Tuesday', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'day_1_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 1:', 'mascot-core-amiso' ),
				'default'	=> esc_html__( '9.00 - 17.00', 'mascot-core-amiso' ),
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_1_line',
				'type'		=> 'line',
			),


			//Day 2
			array(
				'id'		=> 'day_2',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 2:', 'mascot-core-amiso' ),
				'default'	=> esc_html__( 'Saturday', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'day_2_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 2:', 'mascot-core-amiso' ),
				'default'	=> esc_html__( '9.00 - 16.00', 'mascot-core-amiso' ),
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_2_line',
				'type'		=> 'line',
			),


			//Day 3
			array(
				'id'		=> 'day_3',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 3:', 'mascot-core-amiso' ),
				'default'	=> esc_html__( 'Sunday', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'day_3_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 3:', 'mascot-core-amiso' ),
				'default'	=> esc_html__( 'Closed', 'mascot-core-amiso' ),
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_3_line',
				'type'		=> 'line',
			),


			//Day 4
			array(
				'id'		=> 'day_4',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 4:', 'mascot-core-amiso' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'day_4_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 4:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_4_line',
				'type'		=> 'line',
			),


			//Day 5
			array(
				'id'		=> 'day_5',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 5:', 'mascot-core-amiso' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'day_5_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 5:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_5_line',
				'type'		=> 'line',
			),


			//Day 6
			array(
				'id'		=> 'day_6',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 6:', 'mascot-core-amiso' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'day_6_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 6:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_6_line',
				'type'		=> 'line',
			),


			//Day 7
			array(
				'id'		=> 'day_7',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Day 7:', 'mascot-core-amiso' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'day_7_time',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Time for Day 7:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'width'	=> 'auto',
			),
			array(
				'id'		=> 'day_7_line',
				'type'		=> 'line',
			),
		);
	}



	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args	 Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] );
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = mascot_core_amiso_get_widget_template_part( 'opening-hours-compressed', null, 'opening-hours-compressed/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}