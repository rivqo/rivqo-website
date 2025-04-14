<?php

/*
 * Adds Mascot_Core_Amiso_Widget_EmptySpace widget.
 */
if( !class_exists( 'Mascot_Core_Amiso_Widget_EmptySpace' ) ) {
class Mascot_Core_Amiso_Widget_EmptySpace extends Mascot_Core_Amiso_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-empty-space clearfix',
			'description'	=> esc_html__( 'The Widget lets you easily add Empty Space on your site.', 'mascot-core-amiso' ),
		);
		parent::__construct( 'tm_widget_empty_space', esc_html__( '(TM) Empty Space', 'mascot-core-amiso' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {
		$this->formFields = array(
			array(
				'id'		=> 'desc',
				'type'		=> 'description',
				'title'		=> $this->widgetOptions['description'],
			),
			array(
				'id'		=> 'empty_space_height',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Height:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'Enter empty space height (Note: CSS measurement units allowed).', 'mascot-core-amiso' ),
				'default'	=> esc_html__( '32px', 'mascot-core-amiso' ),
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
		$html = mascot_core_amiso_get_widget_template_part( 'empty-space', null, 'empty-space/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}