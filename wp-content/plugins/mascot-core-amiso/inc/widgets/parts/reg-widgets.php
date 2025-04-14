<?php
// Block direct requests
if ( !defined('ABSPATH') ) die('-1');


if(!function_exists('mascot_core_amiso_register_widgets')) {
	/**
	 * Register all widgets
	 */
	function mascot_core_amiso_register_widgets() {
		$widget_list = array(
			'Mascot_Core_Amiso_Widget_BlogList',
			'Mascot_Core_Amiso_Widget_BrochureBox',
			'Mascot_Core_Amiso_Widget_ContactInfo',
			'Mascot_Core_Amiso_Widget_EmptySpace',
			'Mascot_Core_Amiso_Widget_HorizontalRow',
			'Mascot_Core_Amiso_Widget_OpeningHours',
			'Mascot_Core_Amiso_Widget_OpeningHoursCompressed',
			'Mascot_Core_Amiso_Widget_SocialList',
			'Mascot_Core_Amiso_Widget_SocialListCustom',
			'Mascot_Core_Amiso_Widget_StickInParent',
		);

		//apply filter
		if( has_filter('mascot_core_amiso_register_widgets_add_widgets') ) {
			$widget_list = apply_filters('mascot_core_amiso_register_widgets_add_widgets', $widget_list);
		}

		foreach( $widget_list as $each_widget ) {
			register_widget( $each_widget );
		}

	}
	/* Register the widget */
	mascot_core_amiso_register_widgets();
}
