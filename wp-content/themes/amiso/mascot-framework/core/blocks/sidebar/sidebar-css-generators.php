<?php

if (!function_exists('amiso_sidebar_padding')) {
	/**
	 * Generate CSS codes for Sidebar Padding
	 */
	function amiso_sidebar_padding() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-padding';
		$declaration = array();
		$selector = array(
			'.sidebar-area'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		//added padding into the container.
		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name]['padding-top'] != "" ) {
			$declaration['padding-top'] = $amiso_redux_theme_opt[$var_name]['padding-top'];
		}
		if( $amiso_redux_theme_opt[$var_name]['padding-right'] != "" ) {
			$declaration['padding-right'] = $amiso_redux_theme_opt[$var_name]['padding-right'];
		}
		if( $amiso_redux_theme_opt[$var_name]['padding-bottom'] != "" ) {
			$declaration['padding-bottom'] = $amiso_redux_theme_opt[$var_name]['padding-bottom'];
		}
		if( $amiso_redux_theme_opt[$var_name]['padding-left'] != "" ) {
			$declaration['padding-left'] = $amiso_redux_theme_opt[$var_name]['padding-left'];
		}
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_padding');
}


if (!function_exists('amiso_sidebar_bg_color')) {
	/**
	 * Generate CSS codes for Sidebar Background Color
	 */
	function amiso_sidebar_bg_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-bg-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_bg_color');
}


if (!function_exists('amiso_sidebar_text_align')) {
	/**
	 * Generate CSS codes for Sidebar Text Alignment
	 */
	function amiso_sidebar_text_align() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-text-align';
		$declaration = array();
		$selector = array(
			'.sidebar-area'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['text-align'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_text_align');
}





if (!function_exists('amiso_sidebar_title_padding')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Padding
	 */
	function amiso_sidebar_title_padding() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-padding';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		//added padding into the container.
		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name]['padding-top'] != "" ) {
			$declaration['padding-top'] = $amiso_redux_theme_opt[$var_name]['padding-top'];
		}
		if( $amiso_redux_theme_opt[$var_name]['padding-right'] != "" ) {
			$declaration['padding-right'] = $amiso_redux_theme_opt[$var_name]['padding-right'];
		}
		if( $amiso_redux_theme_opt[$var_name]['padding-bottom'] != "" ) {
			$declaration['padding-bottom'] = $amiso_redux_theme_opt[$var_name]['padding-bottom'];
		}
		if( $amiso_redux_theme_opt[$var_name]['padding-left'] != "" ) {
			$declaration['padding-left'] = $amiso_redux_theme_opt[$var_name]['padding-left'];
		}
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_title_padding');
}


if (!function_exists('amiso_sidebar_title_bg_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Background Color
	 */
	function amiso_sidebar_title_bg_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-bg-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_title_bg_color');
}


if (!function_exists('amiso_sidebar_title_text_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Text Color
	 */
	function amiso_sidebar_title_text_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-text-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_title_text_color');
}


if (!function_exists('amiso_sidebar_title_font_size')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Font Size
	 */
	function amiso_sidebar_title_font_size() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-font-size';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['font-size'] = $amiso_redux_theme_opt[$var_name] . 'px';
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_title_font_size');
}


if (!function_exists('amiso_sidebar_title_line_bottom_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Line Bottom Color
	 */
	function amiso_sidebar_title_line_bottom_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-line-bottom-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title.widget-title-line-bottom:after'
		);

		if( !amiso_get_redux_option( 'sidebar-settings-sidebar-title-show-line-bottom' ) ) {
			return;
		}

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_sidebar_title_line_bottom_color');
}