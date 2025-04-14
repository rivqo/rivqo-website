<?php


if(!function_exists('amiso_get_header_parts')) {
	/**
	 * Function that Renders Header HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_parts() {
		$current_page_id = amiso_get_page_id();
		$params = array();


		//Header Visibility
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_visibility', $current_page_id );

		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['header_visibility'] = $temp_meta_value;
		} else {
			$params['header_visibility'] = amiso_get_redux_option( 'header-settings-choose-header-visibility', true );
		}

		//Header Layout Type
		$params['header_layout_type'] = amiso_return_header_layout_type();

		$params['header_slider_type'] = amiso_get_rwmb_group( 'amiso_' . "page_mb_slider_settings", 'slider_type', $current_page_id );
		$params['header_slider_position'] = amiso_get_rwmb_group( 'amiso_' . "page_mb_slider_settings", 'slider_position', $current_page_id );


		$header_classes = array();
		$header_classes[] = 'header-layout-type-' . $params['header_layout_type'];

		//Main Nav Items Text Color
		$main_nav_items_text_color = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'main_nav_items_text_color', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $main_nav_items_text_color ) && $main_nav_items_text_color != "inherit" ) {
			$header_classes[] = 'main-nav-items-textcolor-' . $main_nav_items_text_color;
		}

		//Header Vertical Nav Classes
		if( $params['header_layout_type'] == 'header-vertical-nav' ) {

			//Add Background Overlay
			if( amiso_get_redux_option( 'header-settings-navigation-vertical-nav-layer-overlay-status' ) ) {
				$header_classes[] = 'layer-overlay overlay-'.amiso_get_redux_option( 'header-settings-navigation-vertical-nav-layer-overlay-color' ) .'-'.amiso_get_redux_option( 'header-settings-navigation-vertical-nav-layer-overlay' );
			}



			//Vertical Nav BG Color
			$params['vertical_nav_bgcolor'] = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'vertical_nav_bgcolor', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $params['vertical_nav_bgcolor'] ) ) {
				$params['vertical_nav_bgcolor'] = 'color: ' . $params['vertical_nav_bgcolor'] . '; ';
			}

			//Vertical Nav BG Img
			$params['vertical_nav_bgimg'] = amiso_get_rwmb_group_advanced( 'amiso_' . 'page_mb_header_settings', 'vertical_nav_bgimg', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $params['vertical_nav_bgimg'] ) ) {
				$params['vertical_nav_bgimg'] = 'background-image: url(' . $params['vertical_nav_bgimg'] . '); ';
			}


			//shadow
			if( amiso_get_redux_option( 'header-settings-navigation-vertical-nav-shadow', false ) == true ) {
				$header_classes[] = 'vertical-nav-shadow';
			}
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'vertical_nav_shadow', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != false && $temp_meta_value != "inherit" ) {
				$header_classes[] = 'vertical-nav-shadow';
			}



			//border
			if( amiso_get_redux_option( 'header-settings-navigation-vertical-nav-border', false ) == true ) {
				$header_classes[] = 'vertical-nav-border';
			}
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'vertical_nav_border', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != false && $temp_meta_value != "inherit" ) {
				$header_classes[] = 'vertical-nav-border';
			}



			//center content
			if( amiso_get_redux_option( 'header-settings-navigation-vertical-nav-center-content', false ) == true ) {
				$header_classes[] = 'vertical-nav-center-content';
			}
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'vertical_nav_content', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != false && $temp_meta_value != "inherit" ) {
				$header_classes[] = 'vertical-nav-center-content';
			}
		}

		$params['header_classes'] = apply_filters( 'amiso_header_classes', $header_classes );

		$params['params'] = $params;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'header-parts', null, 'header/tpl', $params );

		return $html;
	}
}

if(!function_exists('amiso_header_classes_add_additional_class')) {
	/**
	 * Function that Adds Additional Classes to header class
	 * @return HTML
	 */
	function amiso_header_classes_add_additional_class( $header_classes ) {
		$current_page_id = amiso_get_page_id();
		$header_layout_type = amiso_return_header_layout_type();

		if( $header_layout_type == 'header-floating-no-logo' || $header_layout_type == 'header-floating-left-logo' || $header_layout_type == 'header-floating-left-logo-left-nav' ) {



			//Header Background Shadow (Header Floating)
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_floating_bg_shadow', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$header_classes[] = $temp_meta_value;
			} else {
				$header_classes[] = amiso_get_redux_option( 'header-settings-header-layout-floating-bg-shadow', 'header-bg-dark-shadow' );
			}


			//Header Background Shadow (Header Floating)
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_floating_text_color', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$header_classes[] = $temp_meta_value;
			} else {
				$header_classes[] = amiso_get_redux_option( 'header-settings-header-layout-floating-text-color', 'header-floating-bg-dark-text-white' );
			}


			//Header Background Shadow (Header Floating)
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_floating_bg_color_sticky', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$header_classes[] = $temp_meta_value;
			} else {
				$header_classes[] = amiso_get_redux_option( 'header-settings-header-layout-floating-bg-color-sticky', 'header-floating-sticky-bg-dark' );
			}
		}
		return $header_classes;
	}
	add_filter( 'amiso_header_classes', 'amiso_header_classes_add_additional_class' );
}


if(!function_exists('amiso_get_header_layout_type')) {
	/**
	 * Function that Renders Header Layout Type HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_layout_type() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		//Default Header Nav Visibility
		//Show Header Navigation Row
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_nav_row_visibility', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['show_header_nav_row'] = $temp_meta_value;
		} else {
			$params['show_header_nav_row'] = amiso_get_redux_option( 'header-settings-navigation-show-header-nav-row', true);
		}




		//Header Layout Type
		$params['header_layout_type'] = amiso_return_header_layout_type();


		//Header Container
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_container', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['header_layout_container_class'] = $temp_meta_value;
		} else {
			$params['header_layout_container_class'] = amiso_get_redux_option( 'header-settings-header-layout-type-container', 'container' );
		}



		//Header Behaviour
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_behaviour', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['header_layout_behaviour'] = $temp_meta_value;
		} else {
			$params['header_layout_behaviour'] = amiso_get_redux_option( 'header-settings-header-layout-type-behaviour');
		}



		/*
		* Header Navigation Row
		*/
		//if Use Theme Color in Background enabled
		$params['header_nav_row_bg_theme_colored'] = '';
		if( !_empty( amiso_get_redux_option( 'header-settings-navigation-bgcolor-use-themecolor' )) ) {
			$params['header_nav_row_bg_theme_colored'] = 'bg-theme-colored' . amiso_get_redux_option( 'header-settings-navigation-bgcolor-use-themecolor' );
		}


		//Navigation Skin
		$params['navigation_skin'] = esc_attr( amiso_get_redux_option( 'header-settings-navigation-skin' ) );

		//if layout type vertical nav then nav skin is set to default:
		if( $params['header_layout_type'] == 'header-vertical-nav' ) {
			$params['navigation_skin'] = 'default';
		}

		//Header Navigation Color Scheme
		$menuzord_color = esc_attr( amiso_get_redux_option( 'header-settings-navigation-color-scheme' ) );
		$params['navigation_color_scheme'] = $menuzord_color . ' menuzord-color-' . $menuzord_color . ' menuzord-' . $params['navigation_skin'] ;


		//Header Navigation Primary Effect
		$params['navigation_primary_effect'] = esc_attr( amiso_get_redux_option( 'header-settings-navigation-primary-effect' ) );

		//Header Navigation CSS3 Animation
		$params['navigation_css3_animation'] = esc_attr( amiso_get_redux_option( 'header-settings-navigation-css3-animation' ) );




		if( $params['header_layout_type'] == 'header-mobile-nav' || $params['header_layout_type'] == 'header-mobile-nav-floating' ) {
			wp_enqueue_script( 'menufullpage' );
		}



		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( $params['header_layout_type'], null, 'header/tpl/header-type', $params );

		return $html;
	}
}


if(!function_exists('amiso_header_sticky_enable_add_class_to_body')) {
	/**
	 * Function that adds class to body
	 */
	function amiso_header_sticky_enable_add_class_to_body ( $classes ) {
		$current_page_id = amiso_get_page_id();
		//sticky header
		$header_sticky_enable = amiso_get_redux_option( 'header-sticky-enable-on-scroll', true );
		if ( $header_sticky_enable ) {
			$classes[] = 'tm-header-sticky';

			$header_sticky_enable_always_visible = amiso_get_redux_option( 'header-sticky-always-visible-on-scroll', true );
			if ( $header_sticky_enable_always_visible ) {
				$classes[] = 'tm-header-sticky-always';
			} else {
				$classes[] = 'tm-header-sticky';
			}
		}


		//sticky header mobile
		$header_sticky_enable_mobile = amiso_get_redux_option( 'header-sticky-mobile-enable-on-scroll', true );
		if ( $header_sticky_enable_mobile ) {
			$classes[] = 'tm-header-sticky-mobile';

			$header_sticky_enable_always_visible_mobile = amiso_get_redux_option( 'header-sticky-mobile-always-visible-on-scroll-mobile', true );
			if ( $header_sticky_enable_always_visible_mobile ) {
				$classes[] = 'tm-header-sticky-mobile-always';
			} else {
				$classes[] = 'tm-header-sticky-mobile';
			}
		}

		return $classes;
	}
	add_filter( 'body_class', 'amiso_header_sticky_enable_add_class_to_body' );
}


if(!function_exists('amiso_header_mobile_vertical_nav_add_class_to_body')) {
	/**
	 * Function that adds class to body
	 */
	function amiso_header_mobile_vertical_nav_add_class_to_body ( $classes ) {
		$current_page_id = amiso_get_page_id();
		//Header Layout Type
		$header_layout_type = amiso_return_header_layout_type();

		if( $header_layout_type == 'header-mobile-nav' || $header_layout_type == 'header-mobile-nav-floating' ) {
			$classes[] = 'menu-full-page';
		} else if ( $header_layout_type == 'header-vertical-nav' ) {
			$classes[] = 'tm-vertical-nav';
		}

		return $classes;
	}
	add_filter( 'body_class', 'amiso_header_mobile_vertical_nav_add_class_to_body' );
}


if(!function_exists('amiso_return_header_layout_type')) {
	/**
	 * Function that Returns Header Layout Type Class
	 */
	function amiso_return_header_layout_type() {
		$current_page_id = amiso_get_page_id();
		$header_layout_type = '';
		//Header Layout Type
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_layout_type', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$header_layout_type = $temp_meta_value;
		} else {
			$header_layout_type = amiso_get_redux_option( 'header-settings-choose-header-layout-type', 'header-default' );
		}

		return $header_layout_type;
	}
}


if(!function_exists('amiso_get_header_top_cpt_elementor')) {
	/**
	 * Function that Renders Header Top CPT Post HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_top_cpt_elementor() {
		$current_page_id = amiso_get_page_id();
		$params = array();
		$html = '';

		if ( mascot_core_amiso_plugin_installed() ) {
			//check if transpaent header selected then default header will not work
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'headertop_cpt_elementor_transparent', $current_page_id );
			$temp_meta_value_normal = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'headertop_cpt_elementor', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$params['header_top_transparent_cpt_post'] = $temp_meta_value;
			} else {
				//check if default header metabox selected then show it
				if ( ! amiso_metabox_opt_val_is_empty( $temp_meta_value_normal ) && $temp_meta_value_normal != "inherit" ) {
					$params['header_top_transparent_cpt_post'] = "";
				} else {
					$params['header_top_transparent_cpt_post'] = amiso_get_redux_option( 'header-settings-choose-header-top-cpt-elementor-transparent' );
				}
			}
			//transparent
			if( $params['header_top_transparent_cpt_post'] ) {

				//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
				$html = amiso_get_blocks_template_part( 'header-top-transparent-cpt-elementor', null, 'header/tpl/parts', $params );

			} else {
				//not transparent
				$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'headertop_cpt_elementor', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
					$params['header_top_cpt_post'] = $temp_meta_value;
				} else {
					$params['header_top_cpt_post'] = amiso_get_redux_option( 'header-settings-choose-header-top-cpt-elementor' );
				}

				if( !$params['header_top_cpt_post'] ) {
					return;
				}

				//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
				$html = amiso_get_blocks_template_part( 'header-top-cpt-elementor', null, 'header/tpl/parts', $params );
			}
		}
	}
	add_action( 'amiso_header_top_area', 'amiso_get_header_top_cpt_elementor' );
}


if(!function_exists('amiso_get_header_top_sticky_cpt_elementor')) {
	/**
	 * Function that Renders Header Top CPT Post HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_top_sticky_cpt_elementor() {
		$current_page_id = amiso_get_page_id();
		$params = array();
		$html = '';

		if ( mascot_core_amiso_plugin_installed() ) {
			//Footer Widget Area
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'headertop_cpt_elementor_sticky', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$params['header_top_sticky_cpt_post'] = $temp_meta_value;
			} else {
				$params['header_top_sticky_cpt_post'] = amiso_get_redux_option( 'header-settings-choose-header-top-cpt-elementor-sticky' );
			}

			if( !$params['header_top_sticky_cpt_post'] ) {
				return;
			}

			//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
			$html = amiso_get_blocks_template_part( 'header-top-sticky-cpt-elementor', null, 'header/tpl/parts', $params );
		}
	}
	add_action( 'amiso_header_top_area', 'amiso_get_header_top_sticky_cpt_elementor' );
}


if(!function_exists('amiso_get_header_top_mobile_cpt_elementor')) {
	/**
	 * Function that Renders Header Top CPT Post HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_top_mobile_cpt_elementor() {
		$current_page_id = amiso_get_page_id();
		$params = array();
		$html = '';

		if ( mascot_core_amiso_plugin_installed() ) {
			//Footer Widget Area
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'headertop_cpt_elementor_mobile', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$params['header_top_mobile_cpt_post'] = $temp_meta_value;
			} else {
				$params['header_top_mobile_cpt_post'] = amiso_get_redux_option( 'header-settings-choose-header-top-cpt-elementor-mobile' );
			}

			if( !$params['header_top_mobile_cpt_post'] ) {
				return;
			}

			//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
			$html = amiso_get_blocks_template_part( 'header-top-mobile-cpt-elementor', null, 'header/tpl/parts', $params );
		}
	}
	add_action( 'amiso_header_top_area', 'amiso_get_header_top_mobile_cpt_elementor' );
}




if(!function_exists('amiso_get_header_logo')) {
	/**
	 * Function that Renders Header Logo HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_logo() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_logo_settings", 'logo_site_brand', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "" ) {
			$params['site_brand'] = trim($temp_meta_value);
		} else {
			$params['site_brand'] = esc_html( amiso_get_redux_option( 'logo-settings-site-brand', get_bloginfo( 'name' ) ) );
		}


		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_logo_settings", 'use_logo', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['use_logo'] = $temp_meta_value;
		} else {
			$params['use_logo'] = amiso_get_redux_option( 'logo-settings-want-to-use-logo', false );
		}


		if( $params['use_logo'] ) {
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group_advanced( 'amiso_' . 'page_mb_logo_settings', 'logo_default', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) ) {
				$params['logo_default'] = $temp_meta_value;
			} else {
				$params['logo_default'] = esc_url( amiso_get_redux_option( 'logo-settings-logo-default', false, 'url' ) );
			}


			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_logo_settings", 'use_switchable_logo', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$params['use_switchable_logo'] = $temp_meta_value;
			} else {
				$params['use_switchable_logo'] = amiso_get_redux_option( 'logo-settings-switchable-logo' );
			}



			if( $params['use_switchable_logo'] ) {
				//logo light
				//check if meta value is provided for this page or then get it from theme options
				$temp_meta_value = amiso_get_rwmb_group_advanced( 'amiso_' . 'page_mb_logo_settings', 'logo_light', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) ) {
					$params['logo_light'] = $temp_meta_value;
				} else {
					$params['logo_light'] = esc_url( amiso_get_redux_option( 'logo-settings-logo-primary', false, 'url' ) );
				}




				//logo dark
				//check if meta value is provided for this page or then get it from theme options
				$temp_meta_value = amiso_get_rwmb_group_advanced( 'amiso_' . 'page_mb_logo_settings', 'logo_dark', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) ) {
					$params['logo_dark'] = $temp_meta_value;
				} else {
					$params['logo_dark'] = esc_url( amiso_get_redux_option( 'logo-settings-logo-on-sticky', false, 'url' ) );
				}

			}

			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_logo_settings", 'logo_maximum_width', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "" ) {
				$params['logo_maximum_width'] = $temp_meta_value;
			} else {
				$params['logo_maximum_width'] = amiso_get_redux_option( 'logo-settings-maximum-logo-width' );
			}

			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_logo_settings", 'logo_maximum_height', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "" ) {
				$params['maximum_logo_height'] = $temp_meta_value;
			} else {
				$params['maximum_logo_height'] = amiso_get_redux_option( 'logo-settings-maximum-logo-height' );
			}
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'header-logo', null, 'header/tpl/parts', $params );

		return $html;
	}
	add_action( 'amiso_header_logo', 'amiso_get_header_logo' );
}


if(!function_exists('amiso_get_header_primary_nav')) {
	/**
	 * Function that Renders Header Primary Nav HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_primary_nav( $main_nav_id = 'main-nav' ) {
		$current_page_id = amiso_get_page_id();
		$params = array();


		//Header Layout Type
		$params['header_layout_type'] = amiso_return_header_layout_type();
		$params['main_nav_id'] = $main_nav_id;


		//Primary Navigation Menu Only For This Page
		$params['custom_primary_nav_menu'] = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'custom_primary_nav_menu', $current_page_id );
		$params['enable_one_page_nav_scrolling_effect'] = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'enable_one_page_nav_scrolling_effect', $current_page_id );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'header-primary-nav', null, 'header/tpl/parts', $params );

		return $html;
	}
	add_action( 'amiso_header_primary_nav', 'amiso_get_header_primary_nav', 10, 1 );
}


if (!function_exists('amiso_switchable_logo_add_class_to_body')) {
	/**
	 * Add classes to body
	 */
	function amiso_switchable_logo_add_class_to_body ( $classes ) {
		$current_page_id = amiso_get_page_id();
		$params = array();

		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_logo_settings", 'use_switchable_logo', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['use_switchable_logo'] = $temp_meta_value;
		} else {
			$params['use_switchable_logo'] = amiso_get_redux_option( 'logo-settings-switchable-logo' );
		}

		if( $params['use_switchable_logo'] ) {
			$classes[] = 'switchable-logo';
		}

		return $classes;
	}

	add_filter( 'body_class', 'amiso_switchable_logo_add_class_to_body' );
}


if(!function_exists('amiso_get_header_menu')) {
	/**
	 * Function that Renders Header Menu HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_menu() {
		$params = array();

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'header-'.amiso_get_redux_option( 'header-settings-choose-header-navigation-type' ), null, 'header/tpl/header-type', $params );

		return $html;
	}
}


if (!function_exists('amiso_get_top_main_slider')) {
	/**
	 * Return Top Main Slider do_shortcode
	 */
	function amiso_get_top_main_slider() {
		$current_page_id = amiso_get_page_id();
		$html = '';

		$slider_type = amiso_get_rwmb_group( 'amiso_' . "page_mb_slider_settings", 'slider_type', $current_page_id );

		switch ( $slider_type ) {
			case 'rev-slider':
				# code...
				if ( class_exists( 'RevSlider' ) ) {
					$rev_slider_alias = amiso_get_rwmb_group( 'amiso_' . "page_mb_slider_settings", 'select_rev_slider', $current_page_id );
					if( ! amiso_metabox_opt_val_is_empty( $rev_slider_alias ) && $rev_slider_alias != '0' ) {
						$html = do_shortcode( '[rev_slider alias="'.$rev_slider_alias.'"]' );
					}
					break;
				}

			case 'layer-slider':
				# code...
				if ( class_exists( 'LS_Sliders' ) ) {
					$layer_slider_alias = amiso_get_rwmb_group( 'amiso_' . "page_mb_slider_settings", 'select_layer_slider', $current_page_id );
					if( ! amiso_metabox_opt_val_is_empty( $layer_slider_alias ) && $layer_slider_alias != '0' ) {
						$html = do_shortcode( '[layerslider id="'.$layer_slider_alias.'"]' );
					}
					break;
				}

			default:
				# code...
				break;
		}

		return $html;
	}
}





if (!function_exists('amiso_register_header_navigation_menufullpage_nav_sidebar')) {
	/**
	 * Register MenuFullPage Nav Sidebar
	 */
	function amiso_register_header_navigation_menufullpage_nav_sidebar() {
		// MenuFullPage Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Menu Full Page Nav Sidebar', 'amiso' ),
			'id' => 'header-menufullpage-nav-sidebar',
			'description'	=> esc_html__( 'Widgets in this area will be shown on MenuFullPage Nav section. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget widget-vertical-nav %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
	add_action( 'widgets_init', 'amiso_register_header_navigation_menufullpage_nav_sidebar', 1000 );
}


if(!function_exists('amiso_get_header_menufullpage_sidebar')) {
	/**
	 * Function that Renders Side Push Panel Sidebar HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_menufullpage_sidebar() {
		$current_page_id = amiso_get_page_id();
		$params = array();


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'menu-full-page-sidebar', null, 'header/tpl/content', $params );
		return $html;
	}
}





if (!function_exists('amiso_register_header_navigation_side_push_panel_sidebar')) {
	/**
	 * Register Side Push Panel Sidebar
	 */
	function amiso_register_header_navigation_side_push_panel_sidebar() {

		$title_line_bottom_class = '';

		if( amiso_get_redux_option( 'header-settings-navigation-side-push-panel-widget-title-show-line-bottom' ) ) {
			$title_line_bottom_class = 'widget-title-line-bottom';
			$line_bottom_theme_colored = amiso_get_redux_option( 'header-settings-navigation-side-push-panel-widget-title-line-bottom-theme-colored' );
			if( $line_bottom_theme_colored != '' ) {
				$title_line_bottom_class .= ' line-bottom-theme-colored' . $line_bottom_theme_colored;
			}
		}


		// Side Push Panel Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Side Push Panel Sidebar', 'amiso' ),
			'id' => 'header-side-push-panel-sidebar',
			'description'	=> esc_html__( 'Widgets in this area will be shown on Side Push Panel section. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget widget-side-push-panel %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h5>',
		) );
	}
	add_action( 'widgets_init', 'amiso_register_header_navigation_side_push_panel_sidebar', 1000 );
}


if(!function_exists('amiso_get_header_side_push_panel_sidebar')) {
	/**
	 * Function that Renders Side Push Panel Sidebar HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_side_push_panel_sidebar() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		$params['holder_id'] = amiso_get_isotope_holder_ID('side-push-panel');

		//Show Side Push Panel
		$params['show_side_push_panel'] = amiso_get_redux_option( 'header-settings-navigation-show-side-push-panel', false );

		if( !$params['show_side_push_panel'] ) {
			return;
		}


		//hide icon in mobile device
		$params['show_side_push_panel_icon_in_mobile_device'] = amiso_get_redux_option( 'header-settings-navigation-show-side-push-panel-in-mobile-device' );
		$params['hidden_class'] = '';
		if( !$params['show_side_push_panel_icon_in_mobile_device'] ) {
			$params['hidden_class'] = 'hidden-mobile-mode';
		}


		add_action( 'wp_footer', 'amiso_get_header_side_push_panel_sidebar_html_code' );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'side-push-panel', null, 'header/tpl/content', $params );
		return $html;
	}
	add_action( 'amiso_header_nav_side_icons', 'amiso_get_header_side_push_panel_sidebar', 20 );
}


if(!function_exists('amiso_get_header_side_push_panel_sidebar_html_code')) {
	/**
	 * Function that Renders Side Push Panel Sidebar HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_side_push_panel_sidebar_html_code() {
		$params = array();

		$params['holder_id'] = amiso_get_isotope_holder_ID('side-push-panel');

		//content center
		$classes = array();
		$params['content_center'] = amiso_get_redux_option( 'header-settings-navigation-side-push-panel-center-content', false );
		if( $params['content_center'] == true ) {
			$classes[] = 'text-center';
		}
		$params['classes'] = $classes;


		$html = amiso_get_blocks_template_part( 'side-push-panel-sidebar-html-code', null, 'header/tpl/content', $params );
		return $html;
	}
}


if (!function_exists('amiso_header_side_push_panel_sidebar_add_class_to_body')) {
	/**
	 * Add classes to body for Side Push Panel Sidebar
	 */
	function amiso_header_side_push_panel_sidebar_add_class_to_body( $classes ) {
		$current_page_id = amiso_get_page_id();
		$params = array();


		//Show Side Push Panel
		$params['show_side_push_panel'] = amiso_get_redux_option( 'header-settings-navigation-show-side-push-panel', false );


		if( $params['show_side_push_panel'] ) {
			$classes[] = 'has-side-panel side-panel-right';
		}

		return $classes;
	}
	add_filter( 'body_class', 'amiso_header_side_push_panel_sidebar_add_class_to_body' );
}





if (!function_exists('amiso_register_header_navigation_vertical_nav_sidebar')) {
	/**
	 * Register Vertical Nav Sidebar
	 */
	function amiso_register_header_navigation_vertical_nav_sidebar() {
		// Side Push Panel Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Vertical Nav Sidebar', 'amiso' ),
			'id' => 'header-vertical-nav-sidebar',
			'description'	=> esc_html__( 'Widgets in this area will be shown on Vertical Nav section. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget widget-vertical-nav %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
	add_action( 'widgets_init', 'amiso_register_header_navigation_vertical_nav_sidebar', 1000 );
}



if(!function_exists('amiso_get_header_search_icon')) {
	/**
	 * Function that Renders Header Search Icon HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_search_icon() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		$params['holder_id'] = amiso_get_isotope_holder_ID('search-icon');

		//Show Search Icon
		$params['show_menu_search_icon'] = amiso_get_redux_option( 'header-settings-navigation-show-menu-search-icon' );

		if( !$params['show_menu_search_icon'] ) {
			return;
		}

		//hide icon in mobile device
		$params['show_menu_search_icon_in_mobile_device'] = amiso_get_redux_option( 'header-settings-navigation-show-menu-search-icon-in-mobile-device' );
		$params['hidden_class'] = '';
		if( !$params['show_menu_search_icon_in_mobile_device'] ) {
			$params['hidden_class'] = 'hidden-mobile-mode';
		}


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'nav-search-icon', null, 'header/tpl/content', $params );
	}
	add_action( 'amiso_header_nav_side_icons', 'amiso_get_header_search_icon', 10 );
}



if(!function_exists('amiso_get_header_nav_custom_button')) {
	/**
	 * Function that Renders Header Nav Custom Button HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_nav_custom_button() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		//check if not reflect other pages and layout choosed from page settings then disable button
		$params['custom_button_reflect_other_pages'] = amiso_get_redux_option( 'header-settings-navigation-show-custom-button-reflect-other-pages', 0 );
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'header_layout_type', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			if( !$params['custom_button_reflect_other_pages'] ) {
				return;
			}
		}

		//Show Custom Button
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'show_custom_button', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['show_custom_button'] = $temp_meta_value;
			$params['custom_button'][ 'title' ] = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'custom_button_title', $current_page_id );
			$params['custom_button'][ 'link' ] = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'custom_button_link', $current_page_id );
		} else {
			$params['show_custom_button'] = amiso_get_redux_option( 'header-settings-navigation-show-custom-button' );
			$params['custom_button'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-info' );
		}
		if( !$params['show_custom_button'] ) {
			return;
		}


		//Custom Button Info
		$params['custom_button_design_style'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-design-style' );
		$params['custom_button_size'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-size' );
		$params['custom_button_flat'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-flat' );
		$params['custom_button_outlined'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-outlined' );
		$params['custom_button_round'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-round' );
		$params['custom_button_link_open_in'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-link-open-in-window' );
		$params['show_custom_button_in_mobile_device'] = amiso_get_redux_option( 'header-settings-navigation-custom-button-show-in-mobile-device' );
		//button classes
		$params['btn_classes'] = amiso_prepare_header_button_classes_from_params( $params );
		$params['hidden_class'] = '';
		if( !$params['show_custom_button_in_mobile_device'] ) {
			$params['hidden_class'] = 'hidden-mobile-mode';
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'nav-custom-button', null, 'header/tpl/content', $params );
		return $html;
	}
	add_action( 'amiso_header_nav_side_icons', 'amiso_get_header_nav_custom_button', 25 );
}








if(!function_exists('amiso_get_header_mini_cart_icon')) {
	/**
	 * Function that Renders Header Mini Cart Icon HTML Codes
	 * @return HTML
	 */
	function amiso_get_header_mini_cart_icon() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		if ( !class_exists( 'WooCommerce' ) ) {
			return;
		}

		//Show Cart Icon
		$params['show_menu_cart_icon'] = amiso_get_redux_option( 'header-settings-navigation-show-menu-cart-icon' );

		if( !$params['show_menu_cart_icon'] ) {
			return;
		}


		//hide icon in mobile device
		$params['show_menu_cart_icon_in_mobile_device'] = amiso_get_redux_option( 'header-settings-navigation-show-menu-cart-icon-in-mobile-device' );
		$params['hidden_class'] = '';
		if( !$params['show_menu_cart_icon_in_mobile_device'] ) {
			$params['hidden_class'] = 'hidden-mobile-mode';
		}


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'nav-mini-cart-icon', null, 'header/tpl/content', $params );
		return $html;
	}
	add_action( 'amiso_header_nav_side_icons', 'amiso_get_header_mini_cart_icon', 15 );
}


if(!function_exists('woocommerce_header_add_to_cart_fragment')) {
	/**
	 * Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	 * @return HTML
	 */
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<div class="top-nav-mini-cart-icon-contents">
			<a class="mini-cart-icon" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'amiso' ); ?>"><i class="<?php echo amiso_get_redux_option( 'header-settings-navigation-menu-cart-icon-code', 'lnr lnr-icon-cart1' ); ?>"></i><span class="items-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'amiso' ), WC()->cart->get_cart_contents_count() ); ?></span> <span class="cart-quick-info"><span class="count"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'amiso' ), WC()->cart->get_cart_contents_count() ); ?> -</span> <?php echo WC()->cart->get_cart_total(); ?></span></a>

			<div class="dropdown-content">
				<div class="widget_shopping_cart">
					<div class="widget_shopping_cart_content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		$fragments['div.top-nav-mini-cart-icon-contents'] = ob_get_clean();
		return $fragments;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
}
