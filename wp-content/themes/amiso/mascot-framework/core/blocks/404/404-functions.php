<?php


if(!function_exists('amiso_get_404_parts')) {
	/**
	 * Function that Renders Coming Soon Page HTML Codes
	 * @return HTML
	 */
	function amiso_get_404_parts() {
		$params = array();
		$section_classes_array = array();
		$params['section_classes'] = '';
		$layout = amiso_get_redux_option( '404-page-settings-layout', 'simple' );
		$section_classes_array[] = 'page-404-layout-' . $layout;

		//Text Alignment
		$params['text_align'] = amiso_get_redux_option( '404-page-settings-text-align', 'text-center' );

		//Add Background Overlay
		if( amiso_get_redux_option( '404-page-settings-bg-layer-overlay-status' ) ) {
			$section_classes_array[] = 'layer-overlay overlay-'.amiso_get_redux_option( '404-page-settings-bg-layer-overlay-color' ) .'-'.amiso_get_redux_option( '404-page-settings-bg-layer-overlay' );
		}

		//make array into string
		if( is_array( $section_classes_array ) && count( $section_classes_array ) ) {
			$params['section_classes'] = esc_attr(implode(' ', $section_classes_array));
		}

		$params['page_title'] = amiso_get_redux_option( '404-page-settings-title', amiso_redux_fallback_text_collection('404') );
		$params['page_subtitle'] = amiso_get_redux_option( '404-page-settings-subtitle', amiso_redux_fallback_text_collection('404_oops') );
		$params['page_content'] = amiso_get_redux_option( '404-page-settings-content', amiso_redux_fallback_text_collection('404_notexist') );


		//fullscreen if not show header footer
		if( amiso_get_redux_option( '404-page-settings-show-header', true ) == true || amiso_get_redux_option( '404-page-settings-show-footer', true ) == true ) {
			$params['fullscreen'] = 'page-404-wrapper-padding';
		} else {
			$params['fullscreen'] = 'section-fullscreen';
		}

		//Search Box
		$params['show_search_box'] = amiso_get_redux_option( '404-page-settings-show-search-box', false );
		$params['search_box_heading'] = amiso_get_redux_option( '404-page-settings-search-box-heading' );
		$params['search_box_paragraph'] = amiso_get_redux_option( '404-page-settings-search-box-paragraph' );

		//Helpful Links
		$params['show_helpful_links'] = amiso_get_redux_option( '404-page-settings-show-helpful-links', 0 );
		$params['helpful_links_heading'] = amiso_get_redux_option( '404-page-settings-helpful-links-heading' );
		$params['helpful_links_nav'] = 'page-404-helpful-links';

		//Show Social Links
		$params['show_social_links'] = amiso_get_redux_option( '404-page-settings-show-social-links', false );

		//Back Button Label
		$params['show_back_to_home_button'] = amiso_get_redux_option( '404-page-settings-show-back-to-home-button', true );
		$params['back_to_home_button_label'] = amiso_get_redux_option( '404-page-settings-back-to-home-button-label', amiso_redux_fallback_text_collection('404_btn') );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'template', amiso_get_redux_option( '404-page-settings-layout', 'simple' ), '404/tpl', $params );

		return $html;
	}
}