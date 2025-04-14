<?php


if(!function_exists('mascot_core_amiso_get_maintenance_mode_parts')) {
	/**
	 * Function that Renders Coming Soon Page HTML Codes
	 * @return HTML
	 */
	function mascot_core_amiso_get_maintenance_mode_parts() {
		$params = array();
		$section_classes_array = array();
		$params['section_classes'] = '';

		//Text Alignment
		if( mascot_core_amiso_get_redux_option( 'maintenance-mode-text-align' ) ) {
			$section_classes_array[] = mascot_core_amiso_get_redux_option( 'maintenance-mode-text-align' );
		}

		//Add Background Overlay
		if( mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-bg-layer-overlay-status' ) ) {
			$section_classes_array[] = 'layer-overlay overlay-'.mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-bg-layer-overlay-color' ) .'-'.mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-bg-layer-overlay' );
		}

		//make array into string
		if( is_array( $section_classes_array ) && count( $section_classes_array ) ) {
			$params['section_classes'] = esc_attr(implode(' ', $section_classes_array));
		}

		if( mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-logo-status' ) ) {
			$params['page_logo'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-logo', false, 'url' );
		}
		$params['page_title'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-title' );
		$params['page_content'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-content' );


		$params['countdown_timer_status'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-countdown-timer-status' );
		$params['enable_social_links'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-enable-social-links' );

		//ordering
		$params['layout_ordering'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-layout-ordering', false, 'ordering' );


		wp_register_script( 'flipclock', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/assets/js/plugins/flipclock/flipclock.min.js', array('jquery'), false, true );
		wp_register_style( 'flipclock', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/assets/js/plugins/flipclock/flipclock.css' );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = mascot_core_amiso_get_inc_folder_template_part( 'template' , null, 'maintenance-mode/tpl', $params );

		return $html;
	}
}

if (!function_exists('mascot_core_amiso_get_countdown_timer_layout')) {
	/**
	 * Return Countdown Timer Layout HTML
	 */
	function mascot_core_amiso_get_countdown_timer_layout() {
		$params = array();

		$params['launch_date'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-countdown-timer-day' );
		$params['launch_hour'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-countdown-timer-hour' );
		$params['launch_minute'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-countdown-timer-minute' );

		$params['style1_format'] = mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-countdown-timer-style1-format' );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = mascot_core_amiso_get_inc_folder_template_part( 'timer', mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-countdown-timer-style' ), 'maintenance-mode/tpl/timer', $params );

		return $html;
	}
}

if (!function_exists('mascot_core_amiso_get_social_links_layout')) {
	/**
	 * Return Social Links HTML
	 */
	function mascot_core_amiso_get_social_links_layout() {
		$params = array();

		//Enabled social links
		$params['social_links'] = mascot_core_amiso_get_redux_option( 'social-links-ordering', false, 'Enabled' );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = mascot_core_amiso_get_inc_folder_template_part( 'social-icons', null, 'maintenance-mode/tpl/social', $params );

		return $html;
	}
}



//Maintenance mode template. This filter hook is executed immediately before WordPress includes the predetermined template file..
add_filter( 'template_include', 'mascot_core_amiso_maintenance_mode_template', 99 );
function mascot_core_amiso_maintenance_mode_template( $template ) {
	//for maintenance mode
	if( ( ( !current_user_can('edit_themes') || !is_user_logged_in() ) && mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-status' ) ) || mascot_core_amiso_get_url_params( 'view-maintenance-mode' ) ) {
		if( mascot_core_amiso_theme_installed() ) {
			$new_template = MASCOT_CORE_AMISO_ABS_PATH . 'inc/maintenance-mode/tpl/page-maintenance-mode-if-theme-installed.php';
		} else {
			$new_template = MASCOT_CORE_AMISO_ABS_PATH . 'inc/maintenance-mode/tpl/page-maintenance-mode.php';
		}

		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}