<?php


if(!function_exists('amiso_get_page')) {
	/**
	 * Function that Renders Page HTML Codes
	 * @return HTML
	 */
	function amiso_get_page( $container_type = 'container', $page_layout = null ) {
		$params = array();

		$params['container_type'] = $container_type;

		//page layout
		$params['page_layout'] = '';
		if( isset( $page_layout ) && $page_layout != '' ) {
			$params['page_layout'] = $page_layout;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'page-parts', null, 'page/tpl', $params );

		return $html;
	}
}

if (!function_exists('amiso_get_page_sidebar_layout')) {
	/**
	 * Return Page Sidebar Layout HTML
	 */
	function amiso_get_page_sidebar_layout( $page_layout = null ) {
		$current_page_id = amiso_get_page_id();
		$params = array();
		$params['page_layout'] = 'no-sidebar';


		//Page Sidebar Layout
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_layout', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['page_layout'] = $temp_meta_value;
		} else {
			$params['page_layout'] = amiso_get_redux_option( 'page-settings-sidebar-layout', 'no-sidebar' );
		}


		if ( !mascot_core_amiso_plugin_installed() ) {
			if ( is_active_sidebar('page-sidebar')  ) {
				$params['page_layout'] = 'sidebar-right-25';
			}
		}

		//page layout
		if( isset( $page_layout ) && $page_layout != '' ) {
			$params['page_layout'] = $page_layout;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'page', $params['page_layout'], 'page/tpl/sidebar-columns', $params );

		return $html;
	}
}

if (!function_exists('amiso_register_page_sidebar')) {
	/**
	 * Register Page Sidebar
	 */
	function amiso_register_page_sidebar() {
		$title_line_bottom_class = '';

		if( amiso_get_redux_option( 'sidebar-settings-sidebar-title-show-line-bottom' ) ) {
			$title_line_bottom_class = 'widget-title-line-bottom';
		}
		$line_bottom_theme_colored = amiso_get_redux_option( 'sidebar-settings-sidebar-title-line-bottom-theme-colored' );
		if( $line_bottom_theme_colored != '' ) {
			$title_line_bottom_class .= ' line-bottom-theme-colored' . $line_bottom_theme_colored;
		}

		// Page Default Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Page Sidebar', 'amiso' ),
			'id'			=> 'page-sidebar',
			'description'   => esc_html__( 'This is a default sidebar for page. Widgets in this area will be shown on sidebar of page. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );


		if ( mascot_core_amiso_plugin_installed() ) {
			// Page Secondary Sidebar
			register_sidebar( array(
				'name'			=> esc_html__( 'Page Sidebar Two', 'amiso' ),
				'id'			=> 'page-sidebar-two',
				'description'   => esc_html__( 'This is a Secondary sidebar for page. Widgets in this area will be shown on another sidebar of page. Drag and drop your widgets here.', 'amiso' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
				'after_title'   => '</h4>',
			) );
		}
	}
	add_action( 'widgets_init', 'amiso_register_page_sidebar', 1000 );
}


if (!function_exists('amiso_page_add_class_to_body')) {
	/**
	 * Add classes to body
	 */
	function amiso_page_add_class_to_body ( $classes ) {
		$current_page_id = amiso_get_page_id();

		//Fixed Footer Bottom Effect
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_footer_settings", 'footer_fixed_footer_bottom', $current_page_id );
		if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			if( $temp_meta_value ) {
				$classes[] = 'has-fixed-footer';
			}
		} else if( amiso_get_redux_option( 'footer-settings-fixed-footer-bottom' ) ) {
			$classes[] = 'has-fixed-footer';
		}

		return $classes;
	}
	add_filter( 'body_class', 'amiso_page_add_class_to_body' );
}

if ( ! function_exists( 'amiso_get_page_content' ) ) {
	/**
	 * Returns Page Content
	 *
	 */
	function amiso_get_page_content() {
		$params = array();

		$params['page_show_comments'] = amiso_get_redux_option( 'page-settings-show-comments', true );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'page-content', null, 'page/tpl/parts', $params );

		return $html;
	}
}