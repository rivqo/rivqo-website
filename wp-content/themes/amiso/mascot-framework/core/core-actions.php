<?php
/*
*
*	Core Actions
*	---------------------------------------
*	Mascot Framework v1.0
* 	Copyright ThemeMascot 2017 - http://www.thememascot.com
*
*/


if(!function_exists('amiso_action_widgets_init')) {
	/**
	 * Init Widgets
	 */
	function amiso_action_widgets_init() {
	}
}


if(!function_exists('amiso_action_wp_head')) {
	/**
	 * Head Action
	 */
	function amiso_action_wp_head() {
		amiso_head_pingback();
		amiso_head_responsive_viewport();
		amiso_head_favicon();
		amiso_head_apple_touch_icons();
	}
}


if(!function_exists('amiso_head_pingback')) {
	/**
	 * link pingback
	 */
	function amiso_head_pingback() {
		if ( is_singular() && pings_open( get_queried_object() ) ) :?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php endif;
	}
}


if(!function_exists('amiso_head_responsive_viewport')) {
	/**
	 * Enable Responsive
	 */
	function amiso_head_responsive_viewport() {
		if( amiso_get_redux_option( 'general-settings-enable-responsive', true ) ) { ?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php } else { ?>
			<meta name="viewport" content="width=1140, user-scalable=yes">
		<?php }
	}
}


if(!function_exists('amiso_head_favicon')) {
	/**
	 * Add Favicon
	 */
	function amiso_head_favicon() {
		// Stop here if and icon was added via the customizer.
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
			return;
		}

		if( amiso_get_redux_option( 'general-settings-favicon', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( amiso_get_redux_option( 'general-settings-favicon', false, 'url' ) ); ?>" rel="shortcut icon">
		<?php } else { ?>
			<link href="<?php echo esc_url( AMISO_ASSETS_URI . '/images/logo/favicon.png') ?>" rel="shortcut icon" type="image/png">
		<?php }
	}
}


if(!function_exists('amiso_head_apple_touch_icons')) {
	/**
	 * Add Apple Touch Icons 144x144, 114x114, 72x72, 32x32
	 */
	function amiso_head_apple_touch_icons() {
		//apple-touch-icon
		if( amiso_get_redux_option( 'general-settings-apple-touch-32', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( amiso_get_redux_option( 'general-settings-apple-touch-32', false, 'url' ) ); ?>" rel="apple-touch-icon">
		<?php } else { ?>
			<link href="<?php echo esc_url( AMISO_ASSETS_URI . '/images/apple-touch-icon.png') ?>" rel="apple-touch-icon">
		<?php }

		//apple-touch-icon-72x72
		if( amiso_get_redux_option( 'general-settings-apple-touch-72', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( amiso_get_redux_option( 'general-settings-apple-touch-72', false, 'url' ) ); ?>" rel="apple-touch-icon" sizes="72x72">
		<?php } else { ?>
			<link href="<?php echo esc_url( AMISO_ASSETS_URI . '/images/apple-touch-icon-72x72.png') ?>" rel="apple-touch-icon" sizes="72x72">
		<?php }

		//apple-touch-icon-114x114
		if( amiso_get_redux_option( 'general-settings-apple-touch-114', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( amiso_get_redux_option( 'general-settings-apple-touch-114', false, 'url' ) ); ?>" rel="apple-touch-icon" sizes="114x114">
		<?php } else { ?>
			<link href="<?php echo esc_url( AMISO_ASSETS_URI . '/images/apple-touch-icon-114x114.png') ?>" rel="apple-touch-icon" sizes="114x114">
		<?php }

		//apple-touch-icon-144x144
		if( amiso_get_redux_option( 'general-settings-apple-touch-144', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( amiso_get_redux_option( 'general-settings-apple-touch-144', false, 'url' ) ); ?>" rel="apple-touch-icon" sizes="144x144">
		<?php } else { ?>
			<link href="<?php echo esc_url( AMISO_ASSETS_URI . '/images/apple-touch-icon-144x144.png') ?>" rel="apple-touch-icon" sizes="144x144">
		<?php }
	}
}


if(!function_exists('amiso_action_wp_head_at_the_end')) {
	/**
	 * Head Action put code at the end
	 */
	function amiso_action_wp_head_at_the_end() {
		amiso_header_custom_html_js();
	}
}


if(!function_exists('amiso_header_custom_html_js')) {
	/**
	 * Custom HTML/JS Code (in Footer)
	 */
	function amiso_header_custom_html_js() {
		if( amiso_get_redux_option( 'custom-codes-custom-html-script-header' ) ) {
			echo "\n";
			echo amiso_get_redux_option( 'custom-codes-custom-html-script-header' );
			echo "\n";
		}
	}
}


if(!function_exists('amiso_action_wp_footer')) {
	/**
	 * Footer Action
	 */
	function amiso_action_wp_footer() {
		amiso_footer_enable_smooth_scroll();
		amiso_footer_enable_backtotop();
		amiso_footer_custom_html_js();
	}
}


if(!function_exists('amiso_footer_enable_smooth_scroll')) {
	/**
	 * Enable Smooth Scrolling
	 */
	function amiso_footer_enable_smooth_scroll() {
		if( amiso_get_redux_option( 'general-settings-smooth-scroll' ) ) {
			wp_enqueue_script( 'tm-bundled-lenis' );
		}
	}
}

if(!function_exists('amiso_smooth_localscroll_add_class_to_body')) {
	/**
	 * Function add class localscroll to bg when lenis not enabled
	 */
	function amiso_smooth_localscroll_add_class_to_body ( $classes ) {
		$classes[] = '';
		if( ! amiso_get_redux_option( 'general-settings-smooth-scroll' ) ) {
			$classes[] = 'tm-enable-localscroll';
		}
		return $classes;
	}
	add_filter( 'body_class', 'amiso_smooth_localscroll_add_class_to_body' );
}


if(!function_exists('amiso_footer_enable_backtotop')) {
	/**
	 * Enable Back To Top
	 */
	function amiso_footer_enable_backtotop() {
		if( amiso_get_redux_option( 'general-settings-enable-backtotop' ) ) { ?>
			<div class="scroll-to-top"><a class="scroll-link" href="<?php echo esc_url( '#' )?>"><i class="lnr-icon-arrow-up"></i></a></div>
		<?php }
	}
}


if(!function_exists('amiso_footer_custom_html_js')) {
	/**
	 * Custom HTML/JS Code (in Footer)
	 */
	function amiso_footer_custom_html_js() {
		if( amiso_get_redux_option( 'custom-codes-custom-html-script-footer' ) ) {
			echo "\n";
			echo amiso_get_redux_option( 'custom-codes-custom-html-script-footer' );
			echo "\n";
		}
	}
}


if (!function_exists( 'amiso_require_core_plugin_message')) {
	/**
	 * Prints a mesasge in the admin if user hides TGMPA plugin activation message
	 */
	function amiso_require_core_plugin_message() {
		if ( get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_tgmpa', true ) && !mascot_core_amiso_plugin_installed() ) {
			$class = 'notice notice-error';
			$message = sprintf( esc_html__( 'For proper theme functioning, the %s plugins are required', 'amiso' ),
				"<strong>Mascot Core</strong>"
			);
			$message .= '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '">' . esc_html__( 'install', 'amiso' ) . '</a>';
			$message .= esc_html__( ' and activate the plugins.', 'amiso' );
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
		}
	}
	add_action( 'admin_notices', 'amiso_require_core_plugin_message' );
}


if(!function_exists('amiso_add_theme_page')) {
	/**
	 * Add Theme Page
	 */
	function amiso_add_theme_page() {
		global $amiso_theme_info;
		$theme_name = $amiso_theme_info->get('Name');
		add_menu_page(
			$theme_name,
			$theme_name,
			'manage_options',
			'mascot-about',
			'amiso_theme_page_about',
			'dashicons-admin-generic',
			4
		);
		add_submenu_page(
			'mascot-about',
			esc_html__( 'Support & Help', 'amiso' ),
			esc_html__( 'Support & Help', 'amiso' ),
			'manage_options',
			'mascot-docs',
			'amiso_theme_page_docs'
		);
		add_submenu_page(
			'mascot-about',
			esc_html__( 'FAQ', 'amiso' ),
			esc_html__( 'FAQ', 'amiso' ),
			'manage_options',
			'mascot-faq',
			'amiso_theme_page_faq'
		);
		add_submenu_page(
			'mascot-about',
			esc_html__( 'System Status', 'amiso' ),
			esc_html__( 'System Status', 'amiso' ),
			'manage_options',
			'mascot-system-status',
			'amiso_theme_page_system_status'
		);
		if ( mascot_core_amiso_plugin_installed() ) {
			add_submenu_page(
				'mascot-about',
				esc_html__( 'System Status', 'amiso' ),
				esc_html__( 'System Status', 'amiso' ),
				'manage_options',
				'mascot-system-status',
				'amiso_theme_page_system_status'
			);
		}
	}
	add_action('admin_menu', 'amiso_add_theme_page');
}

if(!function_exists('amiso_theme_page_about')) {
	function amiso_theme_page_about() {
		get_template_part( 'admin/admin-tpl/mascot-about' );
	}
}

if(!function_exists('amiso_theme_page_docs')) {
	function amiso_theme_page_docs() {
		get_template_part( 'admin/admin-tpl/mascot-docs' );
	}
}

if(!function_exists('amiso_theme_page_faq')) {
	function amiso_theme_page_faq() {
		get_template_part( 'admin/admin-tpl/mascot-faq' );
	}
}

if(!function_exists('amiso_theme_page_system_status')) {
	function amiso_theme_page_system_status() {
		get_template_part( 'admin/admin-tpl/mascot-system-status' );
	}
}
