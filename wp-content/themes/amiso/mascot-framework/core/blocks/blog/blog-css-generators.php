<?php

if (!function_exists('amiso_sidebar_widget_title_line_bottom_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Custom Line Bottom Color
	 */
	function amiso_sidebar_widget_title_line_bottom_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-line-bottom-custom-color';
		//If Make Line Bottom Theme Colored?
		if( $amiso_redux_theme_opt['sidebar-settings-sidebar-title-line-bottom-theme-colored'] != '' ) {
			return;
		}

		$declaration = array();
		$selector = array(
			'.widget .widget-title.widget-title-line-bottom:after'
		);

		$declaration['background-color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_widget_title_line_bottom_color');
}