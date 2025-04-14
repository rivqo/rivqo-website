<?php

/*
 * Adds Mascot_Core_Amiso_Widget_SocialList widget.
 */
if( !class_exists( 'Mascot_Core_Amiso_Widget_SocialList' ) ) {
class Mascot_Core_Amiso_Widget_SocialList extends Mascot_Core_Amiso_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-social-icons clearfix',
			'description'	=> esc_html__( 'The widget lets you easily display social icons which are configured at Theme Options > Social Links.', 'mascot-core-amiso' ),
		);
		parent::__construct( 'tm_widget_social_list', esc_html__( '(TM) Social List', 'mascot-core-amiso' ), $this->widgetOptions );
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
				'id'		=> 'title',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Widget Title:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Social List', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-amiso' ),
			),

			array(
				'id'		=> 'icon_size',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Icon Size:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					''  	  => esc_html__( 'Default', 'mascot-core-amiso' ),
					'icon-xs' => esc_html__( 'Extra Small', 'mascot-core-amiso' ),
					'icon-sm' => esc_html__( 'Small', 'mascot-core-amiso' ),
					'icon-md' => esc_html__( 'Medium', 'mascot-core-amiso' ),
					'icon-lg' => esc_html__( 'Large', 'mascot-core-amiso' ),
					'icon-xl' => esc_html__( 'Extra Large', 'mascot-core-amiso' ),
				)
			),
			array(
				'id'		=> 'icon_color',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Icon Color:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'icon-dark' => esc_html__( 'Dark', 'mascot-core-amiso' ),
					''			=> esc_html__( 'Default', 'mascot-core-amiso' ),
					'icon-gray' => esc_html__( 'Gray', 'mascot-core-amiso' ),
				)
			),

			array(
				'id'		=> 'icon_style',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Icon Style:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'icon-rounded'	=> esc_html__( 'Rounded', 'mascot-core-amiso' ),
					'icon-circled'	=> esc_html__( 'Circled', 'mascot-core-amiso' ),
					'icon-default'	=> esc_html__( 'Default', 'mascot-core-amiso' ),
				)
			),


			array(
				'id'		=> 'icon_border_style',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Make Icon Area Bordered?', 'mascot-core-amiso' ),
				'desc'		=> '',
				'value'		=> 'on',
			),
			array(
				'id'		=> 'icon_theme_colored',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Make Icon Theme Colored?', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> mascot_core_amiso_theme_color_list()
			),
			array(
				'id'		=> 'icon_brand_colored',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Make Icon to It\'s Own Brand color', 'mascot-core-amiso' ),
				'desc'		=> '',
				'value'		=> 'brand',
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

		//Enabled social links
		$instance['social_links'] = amiso_get_redux_option( 'social-links-ordering', false, 'Enabled' );

		$icon_brand_colored = isset($instance['icon_brand_colored']) ? $instance['icon_brand_colored'] : null;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = mascot_core_amiso_get_widget_template_part( 'social-list', $icon_brand_colored, 'social-list/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);

	}
}
}