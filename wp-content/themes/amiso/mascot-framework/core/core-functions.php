<?php
use MASCOTCOREAMISO\CPT\Portfolio\CPT_Portfolio;
use MASCOTCOREAMISO\CPT\Staff\CPT_Staff;
/*
*
*	Core Functions
*	---------------------------------------
*	Mascot Framework v1.0
* 	Copyright ThemeMascot 2017 - http://www.thememascot.com
*
*/

// Null Funcion
function amiso_null_function() {}

if(!function_exists('rwmb_meta')) {
	/**
	 * For fallback when metabox is not defined
	 */
	function rwmb_meta() {
		return false;
	}
}

if(!function_exists('amiso_get_blocks_template_part')) {
	/**
	 * Load a blocks template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 */
	function amiso_get_blocks_template_part( $slug, $name = null, $folder = '', $params = array() ) {

		$template_path = AMISO_FRAMEWORK_FOLDER . '/core/blocks/' . $folder . '/' . $slug;

		return amiso_get_template_part( $template_path, $name, $params );

	}
}

if(!function_exists('amiso_get_shortcode_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function amiso_get_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = AMISO_FRAMEWORK_FOLDER . '/core/shortcodes/parts/' . $folder . '/' . $slug;

		return amiso_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('amiso_get_cpt_template_part')) {
	/**
	 * Load a cpt template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function amiso_get_cpt_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = AMISO_FRAMEWORK_FOLDER . '/core/custom-post-types/' . $folder . '/' . $slug;

		return amiso_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('amiso_get_widget_template_part')) {
	/**
	 * Load a widget template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $widget_ob_start only for widget to get HTML string.
	 */
	function amiso_get_widget_template_part( $slug, $name = null, $folder = '', $params = array(), $widget_ob_start = false ) {

		$template_path = AMISO_FRAMEWORK_FOLDER . '/core/widgets/parts/' . $folder . '/' . $slug;

		return amiso_get_template_part( $template_path, $name, $params, $widget_ob_start );

	}
}


if(!function_exists('amiso_get_woocommerce_template_part')) {
	/**
	 * Load a woocommerce template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 */
	function amiso_get_woocommerce_template_part( $slug, $name = null, $folder = '', $params = array() ) {

		$template_path = AMISO_FRAMEWORK_FOLDER . '/core/woocommerce/' . $folder . '/' . $slug;

		return amiso_get_template_part( $template_path, $name, $params );

	}
}



if(!function_exists('amiso_get_template_part')) {
	/**
	 * Load a template part into a template
	 *
	 * @param string $template_path path of the specialised template.
	 * @param string $name The name of the specialised template.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function amiso_get_template_part( $template_path, $name = null, $params = array(), $shortcode_ob_start = false ) {

		$output_html = '';

		if( is_array($params) && count($params) ) {
			extract($params);
		}

		$name = (string) $name;

		if ( '' !== $name ) {
			$located = get_theme_file_path( "{$template_path}-{$name}.php" );
		} else {
			$located = get_theme_file_path( "{$template_path}.php" );
		}

		if($located) {
			if( $shortcode_ob_start ) {
				ob_start();
				include($located);
				$output_html = ob_get_clean();
			} else {
				include($located);
			}
		}

		return $output_html;
	}
}


if(!function_exists('amiso_dynamic_css_generator')) {
	/**
	 * Dynamic CSS generator based on selectors & declarations
	 *
	 * @param array,string $selector The selector points to the HTML element you want to style
	 * @param array $declaration The declaration block contains one or more declarations separated by semicolons.
	 *
	 * @return string
	 */
	function amiso_dynamic_css_generator($selector, $declaration, $echo = true ) {

		$generated_css = '';

		if( !empty( $selector ) && ( is_array( $declaration ) && count( $declaration ) ) ) {

			if( is_array( $selector ) && count( $selector ) ) {
				$generated_css .= implode(', ', $selector);
			} else {
				$generated_css .= $selector;
			}

			$generated_css .= ' {';
			foreach( $declaration as $property => $value ) {
				if( $property !== '' ) {
					$generated_css .= $property.': '.esc_attr($value).';';
				}
			}

			$generated_css .= '}';
		}

		if( $echo ) {
			echo html_entity_decode( esc_attr( $generated_css ) );
		} else {
			return $generated_css;
		}
	}
}

if(!function_exists('amiso_redux_option_field_typography')) {
	/**
	 * Redux Option Field Typography
	 * @return bool
	 */
	function amiso_redux_option_field_typography( $var_name = '' ) {
		global $amiso_redux_theme_opt;
		$declaration = array();

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		$redux_opt = $amiso_redux_theme_opt[$var_name];

		if( $var_name != '' && $redux_opt !== '' ) {
			if( isset( $redux_opt['font-family'] ) && $redux_opt['font-family'] != "" ) {
				$declaration['font-family'] = $redux_opt['font-family'];
			}
			if( isset( $redux_opt['font-weight'] ) && $redux_opt['font-weight'] != "" ) {
				$declaration['font-weight'] = $redux_opt['font-weight'];
			}
			if( isset( $redux_opt['font-style'] ) && $redux_opt['font-style'] != "" ) {
				$declaration['font-style'] = $redux_opt['font-style'];
			}

			if( isset( $redux_opt['text-align'] ) && $redux_opt['text-align'] != "" ) {
				$declaration['text-align'] = $redux_opt['text-align'];
			}
			if( isset( $redux_opt['text-transform'] ) && $redux_opt['text-transform'] != "" ) {
				$declaration['text-transform'] = $redux_opt['text-transform'];
			}
			if( isset( $redux_opt['font-size'] ) && $redux_opt['font-size'] != "" ) {
				$declaration['font-size'] = $redux_opt['font-size'];
			}

			if( isset( $redux_opt['line-height'] ) && $redux_opt['line-height'] != "" ) {
				$declaration['line-height'] = $redux_opt['line-height'];
			}
			if( isset( $redux_opt['word-spacing'] ) && $redux_opt['word-spacing'] != "" ) {
				$declaration['word-spacing'] = $redux_opt['word-spacing'];
			}
			if( isset( $redux_opt['letter-spacing'] ) && $redux_opt['letter-spacing'] != "" ) {
				$declaration['letter-spacing'] = $redux_opt['letter-spacing'];
			}

			if( isset( $redux_opt['color'] ) && $redux_opt['color'] != "" ) {
				$declaration['color'] = $redux_opt['color'];
			}
		}

		return $declaration;
	}
}

if(!function_exists('amiso_redux_option_field_background')) {
	/**
	 * Redux Option Field Background
	 * @return bool
	 */
	function amiso_redux_option_field_background( $var_name = '' ) {
		global $amiso_redux_theme_opt;
		$declaration = array();

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		$redux_opt = $amiso_redux_theme_opt[$var_name];

		if( $var_name != '' && $redux_opt !== '' ) {
			// Background color
			if( isset( $redux_opt['background-color'] ) && $redux_opt['background-color'] != "" ) {
				$declaration['background-color'] = $redux_opt['background-color'];
			}

			// Background image options
			if( isset( $redux_opt['background-repeat'] ) &&  $redux_opt['background-repeat'] != "" ) {
				$declaration['background-repeat'] = $redux_opt['background-repeat'];
			}
			if( isset( $redux_opt['background-size'] ) &&  $redux_opt['background-size'] != "" ) {
				$declaration['background-size'] = $redux_opt['background-size'];
			}
			if( isset( $redux_opt['background-attachment'] ) &&  $redux_opt['background-attachment'] != "" ) {
				$declaration['background-attachment'] = $redux_opt['background-attachment'];
			}
			if( isset( $redux_opt['background-position'] ) &&  $redux_opt['background-position'] != "" ) {
				$declaration['background-position'] = $redux_opt['background-position'];
			}

			// Background image
			if( isset( $redux_opt['background-image'] ) &&  $redux_opt['background-image'] != "" ) {
				$declaration['background-image'] = 'url('.$redux_opt['background-image'].')';
			}
		}

		return $declaration;
	}
}

if(!function_exists('amiso_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function amiso_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('amiso_visual_composer_installed')) {
	/**
	 * Function that checks if visual composer installed
	 * @return bool
	 */
	function amiso_visual_composer_installed() {
		//is Visual Composer installed?
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('amiso_seo_plugin_installed')) {
	/**
	 * Function that checks if popular seo plugins are installed
	 * @return bool
	 */
	function amiso_seo_plugin_installed() {
		//is 'YOAST' or 'All in One SEO' installed?
		if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('amiso_contact_form_7_installed')) {
	/**
	 * Function that checks if contact form 7 installed
	 * @return bool
	 */
	function amiso_contact_form_7_installed() {
		//is Contact Form 7 installed?
		if(defined('WPCF7_VERSION')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('amiso_is_wpml_installed')) {
	/**
	 * Function that checks if WPML plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function amiso_is_wpml_installed() {
		return defined('ICL_SITEPRESS_VERSION');
	}
}


if(!function_exists('amiso_return_false')) {
	/**
	 * return true false by add_filter and apply_filters
	 */
	function amiso_return_false( ) {
		return false;
	}

}

if(!function_exists('amiso_return_true')) {
	/**
	 * return true
	 */
	function amiso_return_true( ) {
		return true;
	}
}

if(!function_exists('_empty')) {
	/**
	 * return true
	 */
	function _empty( $val ) {
		return empty($val);
	}
}

if(!function_exists('amiso_get_url_params')) {
	/**
	 * retrieve values of parameters passing through the URL
	 */
	function amiso_get_url_params( $param ) {
		return isset( $_GET[ $param ] ) ? $_GET[ $param ] : ( isset( $_REQUEST[ $param ] ) ? $_REQUEST[ $param ] : '' );
	}
}


if(!function_exists('amiso_get_url_params')) {
	/**
	 * retrieve POST data
	 */
	function amiso_get_post_params( $param ) {
		return isset( $_POST[ $param ] ) ? $_POST[ $param ] : ( isset( $_REQUEST[ $param ] ) ? $_REQUEST[ $param ] : '' );
	}
}

if(!function_exists('amiso_get_page_id')) {
	/**
	 * retrieve page ID
	 */
	function amiso_get_page_id() {
		if( class_exists( 'WooCommerce' ) && (is_shop() || is_product()) ) {
			return get_option( 'woocommerce_shop_page_id' );
		}

		if( (is_home() && is_front_page()) || is_archive() || is_search() || is_404() ) {
			return -1;
		}

		return get_queried_object_id();
	}
}

if(!function_exists('amiso_show_comments')) {
	/**
	 * Return Comments HTML
	 *
	 */
	function amiso_show_comments() {
		if (! is_attachment() ) {
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		}
	}
}

if(!function_exists('amiso_category_list_array_for_vc')) {
	/**
	 * Return category list array for VC
	 */
	function amiso_category_list_array_for_vc( $taxonomy ) {
		$list_categories = array(
			esc_html__( 'All', 'amiso' ) => ''
		);
		$terms = get_terms( $taxonomy );

		if ( $terms && !is_wp_error( $terms ) ) :
			foreach ( $terms as $term ) {
				$list_categories[ $term->name ] = $term->slug;
			}
		endif;

		return $list_categories;
	}
}

if(!function_exists('amiso_category_list_array')) {
	/**
	 * Return category list array
	 */
	function amiso_category_list_array( $taxonomy ) {
		$list_categories = array(
			'' => esc_html__( 'All', 'amiso' )
		);
		$terms = get_terms( $taxonomy );

		if ( $terms && !is_wp_error( $terms ) ) :
			foreach ( $terms as $term ) {
				$list_categories[ $term->slug ] = $term->name;
			}
		endif;

		return $list_categories;
	}
}


if(!function_exists('amiso_output_array_list')) {
	/**
	 * Output list array
	 */
	function amiso_output_array_list( $list_array ) {
		//Outputs $args to make it easy
		foreach ( $list_array as $eachparam ) {
			echo "'".$eachparam['param_name']."' => '', <br>";
		}

	}
}



if(!function_exists('amiso_get_image_dimensions')) {
	/**
	 * Output Image Dimensions
	 */
	function amiso_get_image_dimensions( $orientation = "landscape", $ratio = "16:9", $width = 450, $height = 0 ) {
		switch ( $ratio ) {
			case "16:9":
				if ( $orientation == "landscape" )
				$height = (int) (( $width / 16 ) * 9);
				else
				$height = (int) (( $width / 9 ) * 16);
			break;

			case "4:3":
				if ( $orientation == "landscape" )
				$height = (int) (( $width / 4 ) * 3);
				else
				$height = (int) (( $width / 3 ) * 4);
			break;

			case "3:2":
				if ( $orientation == "landscape" )
				$height = (int) (( $width / 3 ) * 2);
				else
				$height = (int) (( $width / 2 ) * 3);
			break;

			case "1:1";
				$height = (int) ( $width );
			break;
		}

		return array ( 'width' => $width, 'height' => $height );
	}
}

if(!function_exists('amiso_starts_with')) {
	/**
	 * Functions that would take a string and return true if it starts with the specified character/string
	 */
	function amiso_starts_with($haystack, $needle)
	{
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}
}

if(!function_exists('amiso_ends_with')) {
	/**
	 * Functions that would take a string and return true if it ends with the specified character/string
	 */
	function amiso_ends_with($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}
}

if(!function_exists('amiso_remove_suffix')) {
	/**
	 * Remove Suffix from String
	 */
	function amiso_remove_suffix( $string, $suffix )
	{
		if( $string != '' && amiso_ends_with($string, $suffix) ) {
			$string = substr($string, 0 , (strpos($string, $suffix)));
		}
		return $string;
	}
}


if(!function_exists('amiso_get_sidebar')) {
	/**
	 * Get Sidebar
	 */
	function amiso_get_sidebar( $sidebar_position ) {
		$sidebar_id = 'default-sidebar';

		//Choose Sidebar for different page type
		if ( is_front_page() && is_home() ) {
			// Default homepage
			$sidebar_id = amiso_blog_archive_get_sidebar( $sidebar_position );
		} elseif ( is_front_page() ) {
			// static homepage
			$sidebar_id = amiso_page_get_sidebar( $sidebar_position );
		} elseif ( is_home() ) {
			// blog page
			$sidebar_id = amiso_blog_archive_get_sidebar( $sidebar_position );

		} else if ( is_single() ) {
			// single page
			if ( is_singular( 'post' ) ) {
				$sidebar_id = amiso_blog_single_get_sidebar( $sidebar_position );
			} else if ( is_singular( 'portfolio-items' ) ) {
				$sidebar_id = amiso_portfolio_single_get_sidebar( $sidebar_position );
			} else if ( is_give_form() ) {
				$sidebar_id = 'give-forms-sidebar';
			}

		} else if ( is_search() || is_archive() ) {
			//if custom post type archive
			if ( is_post_type_archive( 'portfolio-items' ) ) {
				$sidebar_id = amiso_portfolio_get_sidebar( $sidebar_position );
			} else {
				// search or archive page
				$sidebar_id = amiso_blog_archive_get_sidebar( $sidebar_position );
			}

		} else if ( amiso_is_woocommerce_installed() && is_woocommerce() ) {
			//woocommerce page
		} else {
			//everyting else
			$sidebar_id = amiso_page_get_sidebar( $sidebar_position );
		}

		return $sidebar_id;
	}
}


if(!function_exists('amiso_page_get_sidebar')) {
	/**
	 * Get Sidebar for page
	 */
	function amiso_page_get_sidebar( $sidebar_position ) {
		$current_page_id = amiso_get_page_id();
		$sidebar_id = 'default-sidebar';


		//Page Sidebar Layout
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_layout', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$page_layout = $temp_meta_value;
		} else {
			$page_layout = amiso_get_redux_option( 'page-settings-sidebar-layout' );
		}


		//If both sidebar then
		if( $page_layout == 'both-sidebar-25-50-25' ) {

			//Sidebar 2 Position
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_two_position', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$sidebar_two_position = $temp_meta_value;
			} else {
				$sidebar_two_position = amiso_get_redux_option( 'page-settings-sidebar-layout-sidebar-two-position' );
			}

			if( $sidebar_two_position == $sidebar_position ) {
				//Sidebar Two
				//check if meta value is provided for this page or then get it from theme options
				$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_two', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
					$sidebar_id = $temp_meta_value;
				} else {
					$sidebar_id = amiso_get_redux_option( 'page-settings-sidebar-layout-sidebar-two' );
				}
			} else {
				//Sidebar Default
				//check if meta value is provided for this page or then get it from theme options
				$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_default', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
					$sidebar_id = $temp_meta_value;
				} else {
					$sidebar_id = amiso_get_redux_option( 'page-settings-sidebar-layout-sidebar-default' );
				}

			}

		} else {

			//Sidebar Default
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_default', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$sidebar_id = $temp_meta_value;
			} else {
				$sidebar_id = amiso_get_redux_option( 'page-settings-sidebar-layout-sidebar-default', 'page-sidebar' );
			}

		}

		return $sidebar_id;
	}
}


if(!function_exists('amiso_blog_archive_get_sidebar')) {
	/**
	 * Get Sidebar for Blog Archive
	 */
	function amiso_blog_archive_get_sidebar( $sidebar_position ) {
		$current_page_id = amiso_get_page_id();
		$sidebar_id = 'default-sidebar';

		$page_layout = amiso_get_redux_option( 'blog-settings-sidebar-layout' );

		//If both sidebar then
		if( $page_layout == 'both-sidebar-25-50-25' ) {
			//Sidebar 2 Position
			$sidebar_two_position = amiso_get_redux_option( 'blog-settings-sidebar-layout-sidebar-two-position' );
			if( $sidebar_two_position == $sidebar_position ) {
				//Sidebar Two
				$sidebar_id = amiso_get_redux_option( 'blog-settings-sidebar-layout-sidebar-two' );
			} else {
				//Sidebar Default
				$sidebar_id = amiso_get_redux_option( 'blog-settings-sidebar-layout-sidebar-default' );
			}
		} else {
			//Sidebar Default
			$sidebar_id = amiso_get_redux_option( 'blog-settings-sidebar-layout-sidebar-default', 'default-sidebar' );
		}

		return $sidebar_id;
	}
}


if(!function_exists('amiso_blog_single_get_sidebar')) {
	/**
	 * Get Sidebar for Blog Single
	 */
	function amiso_blog_single_get_sidebar( $sidebar_position ) {
		$current_page_id = amiso_get_page_id();
		$sidebar_id = 'default-sidebar';


		//Page Sidebar Layout
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_layout', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$page_layout = $temp_meta_value;
		} else {
			$page_layout = amiso_get_redux_option( 'blog-single-post-settings-sidebar-layout' );
		}


		//If both sidebar then
		if( $page_layout == 'both-sidebar-25-50-25' ) {

			//Sidebar 2 Position
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_two_position', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$sidebar_two_position = $temp_meta_value;
			} else {
				$sidebar_two_position = amiso_get_redux_option( 'blog-single-post-settings-sidebar-layout-sidebar-two-position' );
			}

			if( $sidebar_two_position == $sidebar_position ) {
				//Sidebar Two
				//check if meta value is provided for this page or then get it from theme options
				$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_two', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
					$sidebar_id = $temp_meta_value;
				} else {
					$sidebar_id = amiso_get_redux_option( 'blog-single-post-settings-sidebar-layout-sidebar-two' );
				}
			} else {
				//Sidebar Default
				//check if meta value is provided for this page or then get it from theme options
				$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_default', $current_page_id );
				if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
					$sidebar_id = $temp_meta_value;
				} else {
					$sidebar_id = amiso_get_redux_option( 'page-settings-sidebar-layout-sidebar-default' );
				}

			}

		} else {

			//Sidebar Default
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_default', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$sidebar_id = $temp_meta_value;
			} else {
				$sidebar_id = amiso_get_redux_option( 'blog-single-post-settings-sidebar-layout-sidebar-default', 'default-sidebar' );
			}

		}

		return $sidebar_id;
	}
}


if(!function_exists('amiso_portfolio_get_sidebar')) {
	/**
	 * Get Sidebar for portfolio
	 */
	function amiso_portfolio_get_sidebar( $sidebar_position ) {
		$current_page_id = amiso_get_page_id();
		$sidebar_id = 'default-sidebar';

		$page_layout = amiso_get_redux_option( 'portfolio-settings-sidebar-layout' );

		//If both sidebar then
		if( $page_layout == 'both-sidebar-25-50-25' ) {
			//Sidebar 2 Position
			$sidebar_two_position = amiso_get_redux_option( 'portfolio-settings-sidebar-layout-sidebar-two-position' );
			if( $sidebar_two_position == $sidebar_position ) {
				//Sidebar Two
				$sidebar_id = amiso_get_redux_option( 'portfolio-settings-sidebar-layout-sidebar-two' );
			} else {
				//Sidebar Default
				$sidebar_id = amiso_get_redux_option( 'portfolio-settings-sidebar-layout-sidebar-default' );
			}
		} else {
			//Sidebar Default
			$sidebar_id = amiso_get_redux_option( 'portfolio-settings-sidebar-layout-sidebar-default' );
		}

		return $sidebar_id;
	}
}


if(!function_exists('amiso_portfolio_single_get_sidebar')) {
	/**
	 * Get Sidebar for Portfolio Single
	 */
	function amiso_portfolio_single_get_sidebar( $sidebar_position ) {
		$current_page_id = amiso_get_page_id();
		$sidebar_id = 'default-sidebar';

		$page_layout = amiso_get_redux_option( 'portfolio-single-page-settings-sidebar-layout' );

		//If both sidebar then
		if( $page_layout == 'both-sidebar-25-50-25' ) {
			//Sidebar 2 Position
			$sidebar_two_position = amiso_get_redux_option( 'portfolio-single-page-settings-sidebar-layout-sidebar-two-position' );
			if( $sidebar_two_position == $sidebar_position ) {
				//Sidebar Two
				$sidebar_id = amiso_get_redux_option( 'portfolio-single-page-settings-sidebar-layout-sidebar-two' );
			} else {
				//Sidebar Default
				$sidebar_id = amiso_get_redux_option( 'portfolio-single-page-settings-sidebar-layout-sidebar-default' );
			}
		} else {
			//Sidebar Default
			$sidebar_id = amiso_get_redux_option( 'portfolio-single-page-settings-sidebar-layout-sidebar-default' );
		}

		return $sidebar_id;
	}
}

if(!function_exists('amiso_metabox_opt_val_is_empty')) {
	/**
	 * Check if metabox field option value is empty
	 */
	function amiso_metabox_opt_val_is_empty( $option_value ) {
		if ( ( is_array($option_value) && empty($option_value) ) || ( !is_array($option_value) && $option_value == '' ) ) {
			return true;
		} else {
			return false;
		}
	}
}


if(!function_exists('amiso_variable_val_is_empty')) {
	/**
	 * Check if variable value is empty
	 */
	function amiso_variable_val_is_empty( $variable ) {
		if ( ( is_array($variable) && empty($variable) ) || ( !is_array($variable) && $variable == '' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

if(!function_exists('amiso_is_css_folder_writable')) {
	/**
	 * Checks if css folder writable
	 */
	function amiso_is_css_folder_writable() {
		$css_dir = AMISO_ASSETS_DIR . '/css';
		return wp_is_writable( $css_dir );
	}
}

if(!function_exists('amiso_is_css_colors_folder_writable')) {
	/**
	 * Checks if css colors folder writable
	 */
	function amiso_is_css_colors_folder_writable() {
		$css_dir = AMISO_ASSETS_DIR . '/css/colors';
		return wp_is_writable( $css_dir );
	}
}


if(!function_exists('amiso_generate_dynamic_css')) {
	/**
	 * Gets content of dynamic assets files and puts that in static file
	 */
	function amiso_generate_dynamic_css() {
		global $wp_filesystem;
		WP_Filesystem();

		if ( amiso_is_css_folder_writable() ) {
			$css_dir = AMISO_ASSETS_DIR . '/css/';
			ob_start();
			include_once $css_dir . 'dynamic-style.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( $css_dir . 'dynamic-style-msid-' . amiso_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( $css_dir . 'dynamic-style.css', $css );
			}
		}
	}
}


if(!function_exists('amiso_generate_css_for_custom_theme_color_from_scss')) {
	/**
	 * Generates css custom theme color from Less dynamically when a user presses the "Save Settings" button at Redux Framework theme options
	 */
	function amiso_generate_css_for_custom_theme_color_from_scss() {
		if( mascot_core_amiso_plugin_installed() ) {
			mascot_core_amiso_generate_css_for_custom_theme_color_from_scss();
		}
	}
}


if (!function_exists('amiso_get_multisite_blog_id')) {
	/**
	 * Check is multisite and return blog id
	 *
	 * @return int
	 */
	function amiso_get_multisite_blog_id() {
		if(is_multisite()){
			return get_blog_details()->blog_id;
		}
	}
}


if(!function_exists('amiso_posts_per_page_for_different_post_types')) {
	/**
	 * WordPress Posts Per Page for Different Custom Post Type
	 */
	function amiso_posts_per_page_for_different_post_types( $query ) {
		if ( !is_admin() && $query->is_main_query() ) {

			if( class_exists('MASCOTCOREAMISO\CPT\Portfolio\CPT_Portfolio') ) {
				//Post Type: Portfolio
				$portfolio_cpt_class = CPT_Portfolio::Instance();
				if( is_post_type_archive( $portfolio_cpt_class->ptKey ) || is_tax( $portfolio_cpt_class->ptTaxKey ) || is_tax( $portfolio_cpt_class->ptTagTaxKey ) ) {
					$items_per_page = amiso_get_redux_option( 'portfolio-layout-settings-items-per-page' );
					$query->set( 'posts_per_page', $items_per_page );
				}
			}

			if( class_exists('MASCOTCOREAMISO\CPT\Staff\CPT_Staff') ) {
				//Post Type: Staff
				$staff_cpt_class = CPT_Staff::Instance();
				if( is_post_type_archive( $staff_cpt_class->ptKey ) || is_tax( $staff_cpt_class->ptTaxKey ) ) {
					$items_per_page = amiso_get_redux_option( 'cpt-settings-staff-archive-items-per-page' );
					$query->set( 'posts_per_page', $items_per_page );
				}
			}

		}
	}
	add_action( 'pre_get_posts', 'amiso_posts_per_page_for_different_post_types' );
}


if(!function_exists('amiso_get_redux_option')) {
	/**
	 * Retuns Redux Theme Option
	 */
	function amiso_get_redux_option( $id, $fallback = false, $param = false ) {
		global $amiso_redux_theme_opt;

		if ( $fallback == false ) $fallback = '';

		$output = ( isset( $amiso_redux_theme_opt[$id] ) && $amiso_redux_theme_opt[$id] !== '' ) ? $amiso_redux_theme_opt[$id] : $fallback;

		if ( !empty( $amiso_redux_theme_opt[$id] ) && $param ) {
			$output = $amiso_redux_theme_opt[$id][$param];
		}
		return $output;
	}
}


if(!function_exists('amiso_get_rwmb_group')) {
	/**
	 * Retuns RWMB Group Value
	 */
	function amiso_get_rwmb_group( $group_id, $child = null, $page_id = null, $fallback = false ) {
		$group_value = rwmb_meta( $group_id, '', $page_id );
		if ( $fallback == false ) $fallback = '';

		$output = isset( $group_value[$child] ) ? $group_value[$child] : $fallback;
		return $output;
	}
}


if(!function_exists('amiso_get_rwmb_group_advanced')) {
	/**
	 * Retuns RWMB Group Value for advanced image and file fields
	 */
	function amiso_get_rwmb_group_advanced( $group_id, $child = null, $page_id = null, $fallback = false, $size = false, $for_all_img_size = 'thumbnail' ) {
		$image_ids = amiso_get_rwmb_group( $group_id, $child, $page_id, $fallback );
		$file_info = '';

		if ( empty($image_ids) ) {
			return '';
		} else if ( !$size ) {
			$file_info = wp_get_attachment_image_url( $image_ids[0], $size );
		} else if ( $size == 'all' ) {
			if ( is_array( $image_ids ) && !empty( $image_ids ) ) {
				$file_info = array();
				foreach ( $image_ids as $image_id ) {
					$file_info[] = RWMB_Image_Field::file_info( $image_id, array( 'size' => $for_all_img_size ) );
				}
			}
		} else if ( !empty($size) ) {
			$file_info = wp_get_attachment_image_url( $image_ids[0], $size );
		} else {
			$file_info = wp_get_attachment_image_url( $image_ids[0], 'full' );
		}

		return $file_info;
	}
}


if(!function_exists('amiso_metabox_get_image_advanced_field_url')) {
	/**
	 * Get Full URL of image_advanced metabox field
	 */
	function amiso_metabox_get_image_advanced_field_url( $image_field_array ) {
		$first_key = key( $image_field_array );
		return $image_field_array[$first_key]['full_url'];
	}
}


if(!function_exists('amiso_metabox_get_file_advanced_field_url')) {
	/**
	 * Get Full URL of file_advanced metabox field
	 */
	function amiso_metabox_get_file_advanced_field_url( $image_field_array ) {
		$first_key = key( $image_field_array );
		return $image_field_array[$first_key]['url'];
	}
}



if(!function_exists('amiso_render_pagination_html')) {
	/**
	 * Function that renders and returns Pagination HTML Codes
	 * @return HTML
	 */
	function amiso_render_pagination_html() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer
		$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'	=> esc_html__( '&laquo;', 'amiso' ),
			'next_text'	=> esc_html__( '&raquo;', 'amiso'),
		) );
		$output = '';

		if ( is_array( $pages ) ) {
			$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var( 'paged' );

			$output .=  '<ul class="pagination">';
			foreach ( $pages as $key => $page ) {
				$output .= '<li class="page-item">' . $page . '</li>';
			}
			$output .= '</ul>';
			// Create an instance of DOMDocument
			$dom = new \DOMDocument();

			// Populate $dom with $output, making sure to handle UTF-8, otherwise
			// problems will occur with UTF-8 characters.
			$dom->loadHTML( mb_encode_numericentity(wp_specialchars_decode( htmlentities($output, ENT_NOQUOTES, 'UTF-8', false), ENT_NOQUOTES ), [0x80, 0x10FFFF, 0, ~0], 'UTF-8' ) );

			// Create an instance of DOMXpath and all elements with the class 'page-numbers'
			$xpath = new \DOMXpath( $dom );

			// http://stackoverflow.com/a/26126336/3059883
			$page_numbers = $xpath->query( "//*[contains(concat(' ', normalize-space(@class), ' '), ' page-numbers ')]" );

			// Iterate over the $page_numbers node...
			foreach ( $page_numbers as $page_numbers_item ) {

				// Add class="mynewclass" to the <li> when its child contains the current item.
				if( isset($page_numbers_item->attributes->item(1)->value) ) {
					$page_numbers_item_classes = explode( ' ', $page_numbers_item->attributes->item(1)->value );
				}
				if ( in_array( 'current', $page_numbers_item_classes ) ) {
					$list_item_attr_class = $dom->createAttribute( 'class' );
					$list_item_attr_class->value = 'page-item active';
					$page_numbers_item->parentNode->appendChild( $list_item_attr_class );
					$page_numbers_item->attributes->item(1)->value = 'page-link';
				}

				// Replace the class 'page-numbers' with 'page-link'
				$page_numbers_item->attributes->item(0)->value = str_replace(
								'page-numbers',
								'page-link',
								$page_numbers_item->attributes->item(0)->value );
			}

			// Save the updated HTML and output it.
			$body = $dom->getElementsByTagName('ul');
			if ( $body && 0<$body->length ) {
				$body = $body->item(0);
				$output = $dom->savehtml($body);
			}
		}

		echo wp_kses(
				$output,
				array(
					'ul' => array(
						'class' => array(),
					),
					'li' => array(
						'class' => array(),
					),
					'span' => array(
						'class' => array(),
					),
					'a' => array(
						'href' => array(),
						'class' => array(),
					),
				)
			);
	}
}

if(!function_exists('amiso_sl_get_simple_likes_button')) {
	/**
	 * WordPress Post Like System
	 */
	function amiso_sl_get_simple_likes_button( $post_id ) {
		if ( mascot_core_amiso_plugin_installed() && function_exists( 'mascot_core_amiso_sl_get_simple_likes_button' ) ) {
			mascot_core_amiso_sl_get_simple_likes_button( $post_id );
		}
	}
}

if ( ! function_exists( 'amiso_get_custom_post_type_terms_with_link' ) ) {
	/**
	 * Return comma separated Custom Post Type Terms with link.
	 *
	 */
	function amiso_get_custom_post_type_terms_with_link( $taxonomy ) {
		$on_draught = '';
		$terms = get_the_terms( get_the_ID(), $taxonomy );
		if ( $terms && ! is_wp_error( $terms ) ) :

			$draught_links = array();

			foreach ( $terms as $term ) {
				$draught_links[] = wp_kses(
					'<a href="' . get_tag_link($term->term_id). '">' .$term->name. '</a>',
					array(
						'a' => array(
						'href' => array(),
						'title' => array()
						),
					)
				);
			}

			$on_draught = join( ", ", $draught_links );
		endif;

		return $on_draught;
	}
}



if(!function_exists('amiso_inline_style')) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param $value string | array attribute value
	 *
	 * @see amiso_get_inline_style()
	 */
	function amiso_inline_style($value) {
		echo amiso_get_inline_style($value);
	}
}

if(!function_exists('amiso_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 *
	 * @param $value string | array value of style attribute
	 *
	 * @return string generated style attribute
	 *
	 * @see amiso_get_inline_style()
	 */
	function amiso_get_inline_style($value) {
		return amiso_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('amiso_class_attribute')) {
	/**
	 * Function that echoes class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @see amiso_get_class_attribute()
	 */
	function amiso_class_attribute($value) {
		echo amiso_get_class_attribute($value);
	}
}

if(!function_exists('amiso_get_class_attribute')) {
	/**
	 * Function that returns generated class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @return string generated class attribute
	 *
	 * @see amiso_get_inline_attr()
	 */
	function amiso_get_class_attribute($value) {
		return amiso_get_inline_attr($value, 'class', ' ');
	}
}

if(!function_exists('amiso_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function amiso_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, array_filter($value));
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}

if(!function_exists('amiso_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function amiso_inline_attr($value, $attr, $glue = '') {
		echo amiso_get_inline_attr($value, $attr, $glue);
	}
}



if(!function_exists('amiso_slice_excerpt_by_length')) {
	/**
	 * Slice Excerpt by length
	 *
	 * @return string
	 */
	function amiso_slice_excerpt_by_length( $post_excerpt, $excerpt_length = '' ) {
		//plain text
		$post_excerpt = wp_strip_all_tags( strip_shortcodes( $post_excerpt ) );

		//remove leading dots if those exists
		$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

		//if clean excerpt has text left
		if($clean_excerpt !== '') {
			//explode current excerpt to words
			$excerpt_word_array = explode( ' ', $clean_excerpt );

			//cut down that array based on the number of the words option
			$excerpt_word_array = array_slice( $excerpt_word_array, 0, $excerpt_length );

			//add exerpt postfix
			$excert_postfix	= apply_filters( 'amiso_excerpt_postfix', '' );

			//and finally implode words together
			$post_excerpt = implode( ' ', $excerpt_word_array ) . $excert_postfix;
		}

		return $post_excerpt;
	}
}



if(!function_exists('amiso_slice_text_by_length')) {
	/**
	 * Slice Text by length
	 *
	 * @return string
	 */
	function amiso_slice_text_by_length( $text, $word_length = 0 ) {
		//plain text
		$text = wp_strip_all_tags( strip_shortcodes( $text ) );

		//if clean excerpt has text left
		if($text !== '' && $word_length !== '') {
			//explode current excerpt to words
			$word_array = explode( ' ', $text );

			//cut down that array based on the number of the words option
			$text = array_slice( $word_array, 0, $word_length );

			//and finally implode words together
			$text = implode( ' ', $text );
		}

		return $text;
	}
}




if(!function_exists('amiso_custom_loadmore_enque_script')) {
	/**
	 * Enque custom loadmore script
	 *
	 * @return string
	 */
	function amiso_custom_loadmore_enque_script( $cpt_type, $params, $class_instance ) {
		if (  $params['loadmore_show_view_details_button'] === 'true' ) {
			$holder_id = str_replace('-', '_', $params['holder_id']);
			$params['holder_id_underline'] = $holder_id;
			$params['wp_ajax_load_for_cpt'] = $cpt_type;

			wp_localize_script( 'mascot-custom', 'tm_loadmore_params_'.$holder_id, array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',

				'class_instance' => $class_instance,
				'params' => $params,

				'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			) );
			wp_enqueue_script( 'mascot-custom' );
		}
	}
}




if(!function_exists('mascot_core_amiso_loadmore_ajax_handler')) {
	/**
	 * wp ajax handler for tm
	 *
	 */
	function mascot_core_amiso_loadmore_ajax_handler() {
		$paged = sanitize_text_field( $_POST['page'] ) + 1; //we need next page to be loaded

		//received from params
		$class_instance = sanitize_text_field( $_POST['class_instance'] );
		$params = sanitize_text_field( $_POST['params'] );
		$params['paged'] = $paged;
		$params['from_loadmore_ajax_handler'] = true;

		switch ( $params['wp_ajax_load_for_cpt'] ) {
			case 'post':
				# code...
				echo mascot_core_amiso_elementor_sc_blog_render_output( $class_instance, $params );
				break;

			case 'tribe_events':
				# code...
				echo mascot_core_amiso_elementor_sc_tribe_events_render_output( $class_instance, $params );
				break;

			case 'give-campaigns':
				# code...
				echo mascot_core_amiso_elementor_sc_give_campaigns_render_output( $class_instance, $params );
				break;

			case 'amisole-campaigns':
				# code...
				echo mascot_core_amiso_elementor_sc_amisole_campaigns_render_output( $class_instance, $params );
				break;

			case 'learnpress_list_courses':
				# code...
				echo mascot_core_amiso_elementor_sc_learnpress_list_courses_render_output( $class_instance, $params );
				break;



			case 'gallery':
				# code...
				echo mascot_core_amiso_elementor_cpt_sc_gallery_render_output( $class_instance, $params );
				break;

			case 'projects':
				# code...
				echo mascot_core_amiso_elementor_cpt_sc_projects_render_output( $class_instance, $params );
				break;

			case 'services':
				# code...
				echo mascot_core_amiso_elementor_cpt_sc_services_render_output( $class_instance, $params );
				break;

			case 'staff':
				# code...
				echo mascot_core_amiso_elementor_cpt_sc_staff_render_output( $class_instance, $params );
				break;

			case 'testimonials':
				# code...
				echo mascot_core_amiso_elementor_cpt_sc_testimonials_render_output( $class_instance, $params );
				break;

			default:
				# code...
				break;
		}

		die;
	}
}
add_action('wp_ajax_tm_loadmore_ajax_action', 'mascot_core_amiso_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_tm_loadmore_ajax_action', 'mascot_core_amiso_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}




if (!function_exists('amiso_shortcode_get_blog_post_format')) {
	/**
	 * Return Shortcode Blog Post Format HTML
	 */
	function amiso_shortcode_get_blog_post_format( $post_format = '', $params = array() ) {

		$format = $post_format ? : 'standard';
		$params['post_format'] = $format;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_shortcode_template_part( 'post-format', $format, 'blog/tpl/post-format', $params, true );
		return $html;
	}
}

if ( ! function_exists( 'amiso_post_shortcode_meta' ) ) {
	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 */
	function amiso_post_shortcode_meta( $post_meta_options = array(), $exclude = array() ) {
		if ( empty($post_meta_options) ) {
			return;
		}
		$post_meta_options = explode(',', $post_meta_options);
		if ( ! empty($exclude) ) {
			$post_meta_options = array_diff($post_meta_options, $exclude);
		}
	?>
	<ul class="entry-meta list-inline">
	<?php
		if ( in_array( "show-post-date", $post_meta_options ) ) {
	?>
			<li class="list-inline-item posted-date"><i class="fa fa-calendar-o"></i> <?php amiso_posted_on();?></li>
	<?php
		} if ( in_array( "show-post-by-author", $post_meta_options ) ) {
	?>
			<li class="list-inline-item author"><i class="fa fa-user-circle-o"></i> <?php amiso_posted_by();?></li>
	<?php
		} if ( in_array( "show-post-category", $post_meta_options ) ) {
	?>
			<li class="list-inline-item categories"><i class="fa fa-folder-o"></i> <?php amiso_post_category();?></li>
	<?php
		} if ( in_array( "show-post-comments-count", $post_meta_options ) ) {
	?>
			<li class="list-inline-item comments"><i class="fa fa-comments-o"></i> <?php amiso_get_comments_number(); ?></li>
	<?php
		} if ( in_array( "show-post-tag", $post_meta_options ) ) {
	?>
			<li class="list-inline-item tags"><i class="fa fa-tags"></i> <?php amiso_post_tag();?></li>
	<?php
		} if ( in_array( "show-post-like-button", $post_meta_options ) ) {
	?>
			<li class="list-inline-item likes"><?php amiso_sl_get_simple_likes_button( get_the_ID() ); ?></li>
	<?php
		}
	?>
	</ul>
	<?php
	}
}

if ( ! function_exists( 'amiso_post_shortcode_single_meta' ) ) {
	/**
	 * Return single post meta.
	 *
	 */
	function amiso_post_shortcode_single_meta( $post_meta = '' ) {
		if ( $post_meta == "show-post-by-author" ) {
	?>
			<i class="fa fa-user-circle-o"></i> <?php amiso_posted_by();?>
	<?php
		} else if ( $post_meta == "show-post-date" ) {
	?>
			<?php amiso_posted_on_date();?>
	<?php
		} else if ( $post_meta == "show-post-date-split" ) {
	?>
			<?php amiso_posted_on_split_date();?>
	<?php
		} else if ( $post_meta == "show-post-category" ) {
	?>
			<i class="fa fa-folder-o"></i> <?php amiso_post_category();?>
	<?php
		} else if ( $post_meta == "show-post-comments-count" ) {
	?>
			<i class="fa fa-comments-o"></i> <?php amiso_get_comments_number(); ?>
	<?php
		} else if ( $post_meta == "show-post-tag" ) {
	?>
			<i class="fa fa-tags"></i> <?php amiso_post_tag();?>
	<?php
		} else if ( $post_meta == "show-post-like-button" ) {
	?>
			<?php amiso_sl_get_simple_likes_button( get_the_ID() ); ?>
	<?php
		}
	}
}



// Check if Give WP is installed and activated
if ( ! function_exists( 'amiso_exists_givewp' ) ) {
	function amiso_exists_givewp() {
		return class_exists( 'Give' );
	}
}
// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'amiso_givewp_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'amiso_givewp_theme_setup', 9 );
	function amiso_givewp_theme_setup() {
		if ( amiso_exists_givewp() ) {
			add_action( 'wp_enqueue_scripts', 'amiso_givewp_elementor_widgets', 1100 );
		}
	}
}

// Enqueue styles for elementor widgets
if ( ! function_exists( 'amiso_givewp_elementor_widgets' ) ) {
	function amiso_givewp_elementor_widgets( $force = false ) {
		static $tm_givewp_css_loaded = false;
		if ( ! $tm_givewp_css_loaded ) {
			$tm_givewp_css_loaded = true;
			if( is_rtl() ) {
				wp_enqueue_style( 'amiso-givewp-elementor', AMISO_TEMPLATE_URI . '/assets/css/give/give-elementor-rtl.css' );
			} else {
				wp_enqueue_style( 'amiso-givewp-elementor', AMISO_TEMPLATE_URI . '/assets/css/give/give-elementor.css' );
			}
		}
	}
}



// Check if Tribe Events is installed and activated
if ( ! function_exists( 'amiso_exists_tribe_events' ) ) {
	function amiso_exists_tribe_events() {
		return class_exists( 'Tribe__Events__Main' );
	}
}

// Return true, if current page is any tribe_events page
if ( ! function_exists( 'amiso_is_tribe_events_page' ) ) {
	function amiso_is_tribe_events_page() {
		$rez = false;
		if ( amiso_exists_tribe_events() ) {
			if ( ! is_search() ) {
				$rez = tribe_is_event()
						|| tribe_is_event_query()
						|| tribe_is_event_category()
						|| tribe_is_event_venue()
						|| tribe_is_event_organizer();
			}
		}
		return $rez;
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'amiso_tribe_events_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'amiso_tribe_events_theme_setup', 9 );
	function amiso_tribe_events_theme_setup() {
		if ( amiso_exists_tribe_events() ) {
			add_action( 'wp_enqueue_scripts', 'amiso_tribe_events_elementor_widgets', 1100 );
			add_action( 'wp_enqueue_scripts', 'amiso_tribe_events_frontend_scripts', 1100 );
			add_action( 'wp_enqueue_scripts', 'amiso_tribe_events_frontend_scripts_responsive', 2000 );
		}
	}
}

// Enqueue styles for elementor widgets
if ( ! function_exists( 'amiso_tribe_events_elementor_widgets' ) ) {
	function amiso_tribe_events_elementor_widgets( $force = false ) {
		static $tm_tribe_events_css_loaded = false;
		if ( ! $tm_tribe_events_css_loaded ) {
			$tm_tribe_events_css_loaded = true;
			if( is_rtl() ) {
				wp_register_style( 'amiso-the-events-calendar-elementor', AMISO_TEMPLATE_URI . '/assets/css/tribe-events/the-events-calendar-elementor-rtl.css' );
			} else {
				wp_register_style( 'amiso-the-events-calendar-elementor', AMISO_TEMPLATE_URI . '/assets/css/tribe-events/the-events-calendar-elementor.css' );
			}
		}
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'amiso_tribe_events_frontend_scripts' ) ) {
	function amiso_tribe_events_frontend_scripts( $force = false ) {
		if(amiso_is_tribe_events_page()) {
			static $tm_tribe_events_css_loaded = false;
			if ( ! $tm_tribe_events_css_loaded ) {
				$tm_tribe_events_css_loaded = true;
				if( is_rtl() ) {
					wp_enqueue_style( 'amiso-the-events-calendar', AMISO_TEMPLATE_URI . '/assets/css/tribe-events/the-events-calendar-rtl.css' );
				} else {
					wp_enqueue_style( 'amiso-the-events-calendar', AMISO_TEMPLATE_URI . '/assets/css/tribe-events/the-events-calendar.css' );
				}
			}
		}
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'amiso_tribe_events_frontend_scripts_responsive' ) ) {
	function amiso_tribe_events_frontend_scripts_responsive( $force = false ) {
		if(amiso_is_tribe_events_page()) {
			static $tm_tribe_events_css_loaded = false;
			if ( ! $tm_tribe_events_css_loaded ) {
				$tm_tribe_events_css_loaded = true;
				if( is_rtl() ) {
					wp_enqueue_style( 'amiso-the-events-calendar-responsive', AMISO_TEMPLATE_URI . '/assets/css/tribe-events/the-events-calendar-responsive-rtl.css' );
				} else {
					wp_enqueue_style( 'amiso-the-events-calendar-responsive', AMISO_TEMPLATE_URI . '/assets/css/tribe-events/the-events-calendar-responsive.css' );
				}
			}
		}
	}
}



// header_nav_search_icon_popup_html
if ( ! function_exists( 'amiso_header_nav_search_icon_popup_html' ) ) {
	function amiso_header_nav_search_icon_popup_html( $nav_search_holder_id ) {
		if( isset($nav_search_holder_id) && is_array($nav_search_holder_id) ) {
			foreach ($nav_search_holder_id as $holder_id) {
	?>
	<div id="<?php echo esc_attr($holder_id)?>" class="top-nav-search-form clearfix">
		<div class="nav-search-inner">
			<form action="<?php echo esc_url(home_url()) ?>" method="GET">
				<div class="input-group">
					<input type="text" name="s" value="" placeholder="<?php echo esc_attr__('Type and Press Enter...', 'amiso') ?>" autocomplete="off" />
					<span class="input-group-button">
						<button type="submit"><i aria-hidden="true" class="fas fa-search"></i></button>
					</span>
				</div>
			</form>
			<a href="#" class="close-search-btn" data-target="<?php echo esc_attr($holder_id)?>"><i class="fa fa-times"></i></a>
		</div>
	</div>
	<?php
			}
		}
	}
}
add_action('amiso_nav_search_icon_popup_html', 'amiso_header_nav_search_icon_popup_html', 10, 1);





// Check if WooCommerce installed and activated
if ( ! function_exists( 'amiso_exists_woocommerce' ) ) {
	function amiso_exists_woocommerce() {
		return class_exists( 'Woocommerce' );
	}
}
// Return true, if current page is any woocommerce page
if ( ! function_exists( 'amiso_is_woocommerce_page' ) ) {
	function amiso_is_woocommerce_page() {
		$rez = false;
		if ( amiso_exists_woocommerce() ) {
			$rez = is_woocommerce() || is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		}
		return $rez;
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'amiso_woo_shop_frontend_scripts' ) ) {
	function amiso_woo_shop_frontend_scripts( $force = false ) {
		if(amiso_is_woocommerce_page()) {
			static $tm_woo_shop_css_loaded = false;
			if ( ! $tm_woo_shop_css_loaded ) {
				$tm_woo_shop_css_loaded = true;
				if( is_rtl() ) {
					wp_enqueue_style( 'amiso-woo-shop' );
				} else {
					wp_enqueue_style( 'amiso-woo-shop' );
				}
			}
		}
	}
}
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'amiso_woo_shop_theme_setup' ) ) {
	//add_action( 'after_setup_theme', 'amiso_woo_shop_theme_setup', 9 );
	function amiso_woo_shop_theme_setup() {
		add_action( 'wp_enqueue_scripts', 'amiso_woo_shop_frontend_scripts', 1100 );
	}
}