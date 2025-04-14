<?php


if (!function_exists('amiso_layout_settings_add_class_to_body')) {
	/**
	 * Add classes to body
	 */
	function amiso_layout_settings_add_class_to_body( $classes ) {
		$current_page_id = amiso_get_page_id();



		//if Page Layout boxed
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'page_layout', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			if( $temp_meta_value == 'boxed' ) {
				$classes[] = 'tm-boxed-layout';
			} else if( $temp_meta_value == 'stretched' ) {
				$classes[] = 'tm-stretched-layout';
			}
		} else {
			if( amiso_get_redux_option( 'layout-settings-page-layout' ) == 'boxed' ) {
				$classes[] = 'tm-boxed-layout';
			} else {
				$classes[] = 'tm-stretched-layout';
			}
		}

		//if Container Shadow
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'boxed_layout_container_shadow', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			if( $temp_meta_value ) {
				$classes[] = 'container-shadow';
			}
		} else if( amiso_get_redux_option( 'layout-settings-boxed-layout-container-shadow' ) ) {
			$classes[] = 'container-shadow';
		}


		//Content Width
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'content_width', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			if( $temp_meta_value != 'container-default' ) {
				$classes[] = $temp_meta_value;
			}
		} else if( amiso_get_redux_option( 'layout-settings-content-width' ) != 'container-default' ) {
			$classes[] = amiso_get_redux_option( 'layout-settings-content-width', 'container-1340px' );
		}




		//Dark Layout
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'enable_dark_layout_mode', $current_page_id );
		if( $temp_meta_value ) {
			$classes[] = 'tm-dark-layout';
		}



		//Enable Animation Effect on Different Elements
		if( amiso_get_redux_option( 'general-settings-enable-element-animation-effect' ) ) {
			$classes[] = 'tm-enable-element-animation-effect';
		}


		return $classes;
	}
	add_filter( 'body_class', 'amiso_layout_settings_add_class_to_body' );
}



if (!function_exists('amiso_layout_settings_add_inline_css_to_body')) {
	/**
	 * Add inline css to body
	 */
	function amiso_layout_settings_add_inline_css_to_body() {
		$current_page_id = amiso_get_page_id();

		//Padding Top
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'boxed_layout_padding_top', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) ) {
			$padding_top = amiso_remove_suffix( $temp_meta_value, 'px');
			if( $padding_top >= 0 ) {
				$custom_css = "
					body.tm-boxed-layout {
						padding-top: {$padding_top}px;
					}";
				wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
			}
		}

		//Padding Bottom
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'boxed_layout_padding_bottom', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) ) {
			$padding_bottom = amiso_remove_suffix( $temp_meta_value, 'px');
			if( $padding_bottom >= 0 ) {
				$custom_css = "
					body.tm-boxed-layout {
						padding-bottom: {$padding_bottom}px;
					}";
				wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
			}
		}


		//Boxed Layout Background Type
		$params['title_area_bgcolor'] = '';
		$params['title_area_bgimg'] = '';
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'boxed_layout_bg_type', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['boxed_layout_bg_type'] = $temp_meta_value;

			if( $params['boxed_layout_bg_type'] == 'bg-color' ) {

				//Background Color
				$boxed_layout_bg_color = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'boxed_layout_bg_type_color', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $boxed_layout_bg_color ) ) {
					$custom_css = "
							body.tm-boxed-layout {
									background: {$boxed_layout_bg_color};
							}";
					wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
				}

			} else if ( $params['boxed_layout_bg_type'] == 'bg-pattern' ) {

				//Background Pattern
				$boxed_layout_bg_pattern = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'boxed_layout_bg_type_pattern', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $boxed_layout_bg_pattern ) ) {
					$custom_css = "
							body.tm-boxed-layout {
									background-color: unset;
									background-image: url($boxed_layout_bg_pattern);
							}";
					wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
				}

			} else if ( $params['boxed_layout_bg_type'] == 'bg-image' ) {

				//Background Image
				$boxed_layout_bg_image = amiso_get_rwmb_group_advanced( 'amiso_' . 'page_mb_layout_settings', 'boxed_layout_bg_type_img', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $boxed_layout_bg_image ) ) {
					$custom_css = "
							body.tm-boxed-layout {
									background-color: unset;
									background-image: url($boxed_layout_bg_image);
							}";
					wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
				}

			}
		}


		//stretched mode bg color
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'page_layout', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "boxed" ) {
			//Background Color
			$stretched_layout_bg_color = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'stretched_layout_bg_color', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $stretched_layout_bg_color ) ) {
				$custom_css = "
						body.tm-stretched-layout {
								background: {$stretched_layout_bg_color};
						}";
				wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
			}
		}



		//Dark Layout Background Color
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'enable_dark_layout_mode', $current_page_id );
		if( $temp_meta_value ) {
			$dark_layout_mode_bg_color = amiso_get_rwmb_group( 'amiso_' . "page_mb_layout_settings", 'dark_layout_mode_bg_color', $current_page_id );
			if( !empty( $dark_layout_mode_bg_color ) ) {
				$custom_css = "
					body.tm-dark-layout {
						background-color: {$dark_layout_mode_bg_color};
					}";
				wp_add_inline_style( 'amiso-dynamic-style', $custom_css );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'amiso_layout_settings_add_inline_css_to_body', 99 );
}