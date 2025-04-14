<?php

/*
 * Adds Mascot_Core_Amiso_Widget_ContactInfo widget.
 */
if( !class_exists( 'Mascot_Core_Amiso_Widget_ContactInfo' ) ) {
class Mascot_Core_Amiso_Widget_ContactInfo extends Mascot_Core_Amiso_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-contact-info clearfix',
			'description'	=> esc_html__( 'A widget that displays contact info in different styles.', 'mascot-core-amiso' ),
		);
		parent::__construct( 'tm_widget_contact_info', esc_html__( '(TM) Contact Info', 'mascot-core-amiso' ), $this->widgetOptions );
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
				'default'	=> esc_html__( 'Contact Info', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'logo',
				'type'		=> 'media_upload',
				'title'		=> esc_html__( 'Logo:', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'logo_width',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Logo Width:', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'logo_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Logo CSS Class:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'To style logo element', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'description',
				'type'		=> 'textarea',
				'title'		=> esc_html__( 'Description', 'mascot-core-amiso' ),
				'desc'		=> '',
			),

			array(
				'id'		=> 'name',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Name', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'name_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-037-address',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'name_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Name', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'company',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Company Name', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'company_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icons: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-040-profile',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'company_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Company Name', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'phone',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Phone', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'phone_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-042-phone-1',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'phone_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Phone', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'fax',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Fax', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'fax_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-033-telephone-book',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'fax_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Fax', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'email',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Email', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'email_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-043-email-1',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'email_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Email', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'website',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Website', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'website_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-035-website',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'website_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Website', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'skype',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Skype', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'skype_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-049-chat',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'skype_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Skype', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'address',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Address', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'address_fonticon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'And it\'s Font Icon: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> 'flaticon-contact-047-location',
				'width'		=> 'auto',
			),
			array(
				'id'		=> 'address_label',
				'type'		=> 'text',
				'title'		=> esc_html__( '& Label: ', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Address', 'mascot-core-amiso' ),
				'width'		=> 'auto',
			),

			array(
				'id'		=> 'contact_info_style',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Contact Info Style', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'style1' => esc_html__( 'Style 1 - Icon + Text', 'mascot-core-amiso' ),
					'style2' => esc_html__( 'Style 2 - Only Text', 'mascot-core-amiso' ),
					'style3' => esc_html__( 'Style 3 - Label + Text', 'mascot-core-amiso' ),
					'style4' => esc_html__( 'Style 4 - Label + Text(in New Line)', 'mascot-core-amiso' ),
					'style5' => esc_html__( 'Style 5 - Icon + Label + Text(in New Line)', 'mascot-core-amiso' ),
				)
			),
			array(
				'id'		=> 'icon_theme_colored',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Make Icon Theme Colored?', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> mascot_core_amiso_theme_color_list()
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
		$html = mascot_core_amiso_get_widget_template_part( 'contact-info-' . $instance['contact_info_style'], null, 'contact-info/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}