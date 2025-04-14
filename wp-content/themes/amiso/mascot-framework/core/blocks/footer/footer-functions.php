<?php


if(!function_exists('amiso_get_footer_parts')) {
	/**
	 * Function that Renders Footer HTML Codes
	 * @return HTML
	 */
	function amiso_get_footer_parts() {
		$current_page_id = amiso_get_page_id();
		$params = array();
		$footer_classes_array = array();
		$params['footer_classes'] = '';


		//Footer Visibility
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_footer_settings", 'footer_visibility', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['footer_visibility'] = $temp_meta_value;
		} else {
			$params['footer_visibility'] = amiso_get_redux_option( 'footer-settings-footer-visibility', true );
		}

		if( !$params['footer_visibility'] ) {
			return;
		}


		//Fixed Footer Bottom Effect
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_footer_settings", 'footer_fixed_footer_bottom', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			if( $temp_meta_value ) {
				$footer_classes_array[] = 'fixed-footer';
			}
		} else if( amiso_get_redux_option( 'footer-settings-fixed-footer-bottom' ) ) {
			$footer_classes_array[] = 'fixed-footer';
		}

		//make array into string
		if( is_array( $footer_classes_array ) && count( $footer_classes_array ) ) {
			$params['footer_classes'] = esc_attr(implode(' ', $footer_classes_array));
		}


		//Enable Default Footer
		$params['footer_enable_default'] = $footer_enable_default = amiso_get_redux_option( 'footer-settings-enable-default-footer', true );

		if ( mascot_core_amiso_plugin_installed() ) {
			//Footer Widget Area
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_footer_settings", 'footer_widget_area', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$params['footer_widget_area'] = $temp_meta_value;
			} else {
				$params['footer_widget_area'] = amiso_get_redux_option( 'footer-settings-choose-footer-widget-area' );
			}

			if( !$params['footer_widget_area'] ) {
				//return;
			}

			//query args
			$args = array(
				'post_type' => 'footer',
				'p' => $params['footer_widget_area'],
			);
			$the_query = new \WP_Query( $args );
			$params['the_query'] = $the_query;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'footer-parts', null, 'footer/tpl', $params );

		return $html;
	}
}


if (!function_exists('amiso_register_footer_sidebar')) {
	/**
	 * Register Footer Sidebar
	 */
	function amiso_register_footer_sidebar() {
		$title_line_bottom_class = '';

		if( amiso_get_redux_option( 'footer-settings-footer-widget-title-show-line-bottom', 1 ) ) {
			$title_line_bottom_class = 'widget-title-line-bottom line-bottom-footer-widget ';

			$line_bottom_theme_colored = amiso_get_redux_option( 'footer-settings-footer-widget-title-line-bottom-theme-colored', 1 );
			if( $line_bottom_theme_colored != '' ) {
				$title_line_bottom_class .= 'line-bottom-theme-colored' . $line_bottom_theme_colored;
			}
		}

		// Footer Widget Area Sidebar Column 1
		register_sidebar( array(
			'name' => esc_html__( 'Footer Widget Area Column 1', 'amiso' ),
			'id' => 'footer-sidebar-top-column-1',
			'description'	=> esc_html__( 'Widgets in this area will be shown on Footer Widget Area Column 1. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );

		// Footer Widget Area Sidebar Column 2
		register_sidebar( array(
			'name' => esc_html__( 'Footer Widget Area Column 2', 'amiso' ),
			'id' => 'footer-sidebar-top-column-2',
			'description'	=> esc_html__( 'Widgets in this area will be shown on Footer Widget Area Column 2. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );

		// Footer Widget Area Sidebar Column 3
		register_sidebar( array(
			'name' => esc_html__( 'Footer Widget Area Column 3', 'amiso' ),
			'id' => 'footer-sidebar-top-column-3',
			'description'	=> esc_html__( 'Widgets in this area will be shown on Footer Widget Area Column 3. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );

		// Footer Widget Area Sidebar Column 4
		register_sidebar( array(
			'name' => esc_html__( 'Footer Widget Area Column 4', 'amiso' ),
			'id' => 'footer-sidebar-top-column-4',
			'description'	=> esc_html__( 'Widgets in this area will be shown on Footer Widget Area Column 4. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'amiso_register_footer_sidebar', 1000 );
}




/**
 * Adding and Handling a Custom Field in WP Navigation Menu Widget
 */
if (!function_exists('amiso_add_custom_fields_in_wp_nav_menu_widget')) {
	/**
	 * Displaying a Custom Field in WP Navigation Menu Widget
	 */
	function amiso_add_custom_fields_in_wp_nav_menu_widget( $widget, $return, $instance ) {

		// Are we dealing with a nav menu widget?
		if ( 'nav_menu' == $widget->id_base ) {

			// Display the split-nav-menu option.
			$split_nav_menu = isset( $instance['split-nav-menu'] ) ? $instance['split-nav-menu'] : '';
			?>
				<p>
					<input class="form-check" type="checkbox" id="<?php echo esc_attr( $widget->get_field_id( 'split-nav-menu' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'split-nav-menu' ) ); ?>" <?php checked( true , $split_nav_menu ); ?> />
					<label for="<?php echo esc_attr( $widget->get_field_id( 'split-nav-menu' ) ); ?>">
						<?php esc_html_e( 'Split This Navigation Menu Into Two Columns', 'amiso' ); ?>
					</label>
				</p>
			<?php
		}

	}
	add_filter('in_widget_form', 'amiso_add_custom_fields_in_wp_nav_menu_widget', 10, 3 );
}

if (!function_exists('amiso_save_custom_fields_in_wp_nav_menu_widget')) {
	/**
	 * Saving a Custom Field in WP Navigation Menu Widget
	 */
	function amiso_save_custom_fields_in_wp_nav_menu_widget( $instance, $new_instance ) {

		// Is the instance a nav menu and are descriptions enabled?
		if ( isset( $new_instance['nav_menu'] ) && !empty( $new_instance['split-nav-menu'] ) ) {
			$instance['split-nav-menu'] = 1;
		}

		return $instance;
	}
	add_filter( 'widget_update_callback', 'amiso_save_custom_fields_in_wp_nav_menu_widget', 10, 2 );
}

if (!function_exists('amiso_control_custom_fields_in_wp_nav_menu_widget')) {
	/**
	 * Control Custom Field in WP Navigation Menu Widget
	 */
	function amiso_control_custom_fields_in_wp_nav_menu_widget( $params ) {

		// Gets every custom menu widget from the database.
		$widget_settings = get_option('widget_nav_menu');
		// Does the current menu widget have split menu turned on?
		if ( !empty( $widget_settings[$params[1]['number']]['split-nav-menu'] ) ) {
			$classe_to_add = 'split-nav-menu clearfix '; // make sure you leave a space at the end
			$classe_to_add = 'class=" '.$classe_to_add;
			$params[0]['before_widget'] = str_replace('class="',$classe_to_add,$params[0]['before_widget']);
		} else {
		}
		// Return the unmodified $params.
		return $params;
	}
	add_filter( 'dynamic_sidebar_params', 'amiso_control_custom_fields_in_wp_nav_menu_widget');
}