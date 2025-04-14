<?php

/*
 * Adds Mascot_Core_Amiso_Widget_StickInParent widget.
 */
if( !class_exists( 'Mascot_Core_Amiso_Widget_StickInParent' ) ) {
class Mascot_Core_Amiso_Widget_StickInParent extends Mascot_Core_Amiso_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'tm-widget-sticky-sidebar-in-parent mb-0',
			'description'	=> esc_html__( 'Stick Sidebar In Parent provides an easy way to attach elements to the page when the user scrolls such that the element is always visible.', 'mascot-core-amiso' ),
		);
		parent::__construct( 'tm_widget_stick_in_parent', esc_html__( '(TM) Stick Sidebar In Parent', 'mascot-core-amiso' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {
		$this->formFields = array(
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-amiso' ),
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

		wp_enqueue_script( 'sticky-kit' );
		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = mascot_core_amiso_get_widget_template_part( 'stick-in-parent', null, 'stick-in-parent/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}