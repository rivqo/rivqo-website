<?php

if(!function_exists('mascot_core_theme_color_list')) {
	/**
	 * Theme Color list
	 */
	function mascot_core_theme_color_list() {
		$theme_color_list = array(
			'' => esc_html__( 'No', 'mascot-core' ),
			'1' => esc_html__( 'Theme Color 1', 'mascot-core' ),
			'2' => esc_html__( 'Theme Color 2', 'mascot-core' ),
			'3' => esc_html__( 'Theme Color 3', 'mascot-core' ),
			'4' => esc_html__( 'Theme Color 4', 'mascot-core' )
		);
		return $theme_color_list;
	}
}

if(!function_exists('mascot_core_heading_tag_list')) {
	/**
	 * Heading Tag List
	 */
	function mascot_core_heading_tag_list() {
		$heading_tag_list = array(
			''  	=>  '',
			'h1' => 'h1',
			'h2' => 'h2',
			'h3' => 'h3',
			'h4' => 'h4',
			'h5' => 'h5',
			'h6' => 'h6',
			'p'  => 'p',
			'a'  => 'a',
			'span'  => 'span',
			'div'  => 'div',
		);
		return $heading_tag_list;
	}
}

if(!function_exists('mascot_core_animate_css_animation_list')) {
	/**
	 * animate.css animation list https://daneden.github.io/animate.css/
	 */
	function mascot_core_animate_css_animation_list() {
		$animate_css_animation_list = array(
			'' => '',
			'fadeIn' => 'fadeIn',
			'fadeInDown' => 'fadeInDown',
			'fadeInDownBig' => 'fadeInDownBig',
			'fadeInLeft' => 'fadeInLeft',
			'fadeInLeftBig' => 'fadeInLeftBig',
			'fadeInRight' => 'fadeInRight',
			'fadeInRightBig' => 'fadeInRightBig',
			'fadeInUp' => 'fadeInUp',
			'fadeInUpBig' => 'fadeInUpBig',
			'fadeOut' => 'fadeOut',
			'fadeOutDown' => 'fadeOutDown',
			'fadeOutDownBig' => 'fadeOutDownBig',
			'fadeOutLeft' => 'fadeOutLeft',
			'fadeOutLeftBig' => 'fadeOutLeftBig',
			'fadeOutRight' => 'fadeOutRight',
			'fadeOutRightBig' => 'fadeOutRightBig',
			'fadeOutUp' => 'fadeOutUp',
			'fadeOutUpBig' => 'fadeOutUpBig',
			'bounce' => 'bounce',
			'flash' => 'flash',
			'pulse' => 'pulse',
			'rubberBand' => 'rubberBand',
			'shake' => 'shake',
			'swing' => 'swing',
			'tada' => 'tada',
			'wobble' => 'wobble',
			'jello' => 'jello',
			'bounceIn' => 'bounceIn',
			'bounceInDown' => 'bounceInDown',
			'bounceInLeft' => 'bounceInLeft',
			'bounceInRight' => 'bounceInRight',
			'bounceInUp' => 'bounceInUp',
			'bounceOut' => 'bounceOut',
			'bounceOutDown' => 'bounceOutDown',
			'bounceOutLeft' => 'bounceOutLeft',
			'bounceOutRight' => 'bounceOutRight',
			'bounceOutUp' => 'bounceOutUp',
			'flip' => 'flip',
			'flipInX' => 'flipInX',
			'flipInY' => 'flipInY',
			'flipOutX' => 'flipOutX',
			'flipOutY' => 'flipOutY',
			'lightSpeedIn' => 'lightSpeedIn',
			'lightSpeedOut' => 'lightSpeedOut',
			'rotateIn' => 'rotateIn',
			'rotateInDownLeft' => 'rotateInDownLeft',
			'rotateInDownRight' => 'rotateInDownRight',
			'rotateInUpLeft' => 'rotateInUpLeft',
			'rotateInUpRight' => 'rotateInUpRight',
			'rotateOut' => 'rotateOut',
			'rotateOutDownLeft' => 'rotateOutDownLeft',
			'rotateOutDownRight' => 'rotateOutDownRight',
			'rotateOutUpLeft' => 'rotateOutUpLeft',
			'rotateOutUpRight' => 'rotateOutUpRight',
			'slideInUp' => 'slideInUp',
			'slideInDown' => 'slideInDown',
			'slideInLeft' => 'slideInLeft',
			'slideInRight' => 'slideInRight',
			'slideOutUp' => 'slideOutUp',
			'slideOutDown' => 'slideOutDown',
			'slideOutLeft' => 'slideOutLeft',
			'slideOutRight' => 'slideOutRight',
			'zoomIn' => 'zoomIn',
			'zoomInDown' => 'zoomInDown',
			'zoomInLeft' => 'zoomInLeft',
			'zoomInRight' => 'zoomInRight',
			'zoomInUp' => 'zoomInUp',
			'zoomOut' => 'zoomOut',
			'zoomOutDown' => 'zoomOutDown',
			'zoomOutLeft' => 'zoomOutLeft',
			'zoomOutRight' => 'zoomOutRight',
			'zoomOutUp' => 'zoomOutUp',
			'hinge' => 'hinge',
			'rollIn' => 'rollIn',
			'rollOut' => 'rollOut'
		);
		return $animate_css_animation_list;
	}
}

if(!function_exists('mascot_core_custom_animation_class_list')) {
	/**
	 * custom made animation list
	 */
	function mascot_core_custom_animation_class_list() {
		$class_list = array(
			''	=>	esc_html__( "None", 'mascot-core' ),
			'fade-in'	=>	esc_html__( "fade-in", 'mascot-core' ),
			'move-up'	=>	esc_html__( "move-up", 'mascot-core' ),
			'move-down'	=>	esc_html__( "move-down", 'mascot-core' ),
			'move-left'	=>	esc_html__( "move-left", 'mascot-core' ),
			'move-right'	=>	esc_html__( "move-right", 'mascot-core' ),
			'scale-up'	=>	esc_html__( "scale-up", 'mascot-core' ),
			'fall-perspective'	=>	esc_html__( "fall-perspective", 'mascot-core' ),
			'fly'	=>	esc_html__( "fly", 'mascot-core' ),
			'flip'	=>	esc_html__( "flip", 'mascot-core' ),
			'helix'	=>	esc_html__( "helix", 'mascot-core' ),
			'pop-up'	=>	esc_html__( "pop-up", 'mascot-core' )
		);
		return $class_list;
	}
}



if(!function_exists('mascot_core_wp_admin_dashicons_list')) {
	/**
	 * WordPress admin Dashicons https://developer.wordpress.org/resource/dashicons
	 */
	function mascot_core_wp_admin_dashicons_list() {
		$animate_css_animation_list = array(
			'' => '',
			'dashicons-mascot' => 'dashicons-mascot',
			'dashicons-admin-appearance' => 'dashicons-admin-appearance',
			'dashicons-admin-collapse' => 'dashicons-admin-collapse',
			'dashicons-admin-comments' => 'dashicons-admin-comments',
			'dashicons-admin-customizer' => 'dashicons-admin-customizer',
			'dashicons-admin-generic' => 'dashicons-admin-generic',
			'dashicons-admin-home' => 'dashicons-admin-home',
			'dashicons-admin-links' => 'dashicons-admin-links',
			'dashicons-admin-media' => 'dashicons-admin-media',
			'dashicons-admin-multisite' => 'dashicons-admin-multisite',
			'dashicons-admin-network' => 'dashicons-admin-network',
			'dashicons-admin-page' => 'dashicons-admin-page',
			'dashicons-admin-plugins' => 'dashicons-admin-plugins',
			'dashicons-admin-post' => 'dashicons-admin-post',
			'dashicons-admin-settings' => 'dashicons-admin-settings',
			'dashicons-admin-site' => 'dashicons-admin-site',
			'dashicons-admin-tools' => 'dashicons-admin-tools',
			'dashicons-admin-users' => 'dashicons-admin-users',
			'dashicons-album' => 'dashicons-album',
			'dashicons-align-center' => 'dashicons-align-center',
			'dashicons-align-full-width' => 'dashicons-align-full-width',
			'dashicons-align-left' => 'dashicons-align-left',
			'dashicons-align-none' => 'dashicons-align-none',
			'dashicons-align-right' => 'dashicons-align-right',
			'dashicons-align-wide' => 'dashicons-align-wide',
			'dashicons-analytics' => 'dashicons-analytics',
			'dashicons-archive' => 'dashicons-archive',
			'dashicons-arrow-down-alt' => 'dashicons-arrow-down-alt',
			'dashicons-arrow-down-alt2' => 'dashicons-arrow-down-alt2',
			'dashicons-arrow-down' => 'dashicons-arrow-down',
			'dashicons-arrow-left-alt' => 'dashicons-arrow-left-alt',
			'dashicons-arrow-left-alt2' => 'dashicons-arrow-left-alt2',
			'dashicons-arrow-left' => 'dashicons-arrow-left',
			'dashicons-arrow-right-alt' => 'dashicons-arrow-right-alt',
			'dashicons-arrow-right-alt2' => 'dashicons-arrow-right-alt2',
			'dashicons-arrow-right' => 'dashicons-arrow-right',
			'dashicons-arrow-up-alt' => 'dashicons-arrow-up-alt',
			'dashicons-arrow-up-alt2' => 'dashicons-arrow-up-alt2',
			'dashicons-arrow-up' => 'dashicons-arrow-up',
			'dashicons-art' => 'dashicons-art',
			'dashicons-awards' => 'dashicons-awards',
			'dashicons-backup' => 'dashicons-backup',
			'dashicons-book-alt' => 'dashicons-book-alt',
			'dashicons-book' => 'dashicons-book',
			'dashicons-building' => 'dashicons-building',
			'dashicons-businessman' => 'dashicons-businessman',
			'dashicons-button' => 'dashicons-button',
			'dashicons-calendar-alt' => 'dashicons-calendar-alt',
			'dashicons-calendar' => 'dashicons-calendar',
			'dashicons-camera' => 'dashicons-camera',
			'dashicons-carrot' => 'dashicons-carrot',
			'dashicons-cart' => 'dashicons-cart',
			'dashicons-category' => 'dashicons-category',
			'dashicons-chart-area' => 'dashicons-chart-area',
			'dashicons-chart-bar' => 'dashicons-chart-bar',
			'dashicons-chart-line' => 'dashicons-chart-line',
			'dashicons-chart-pie' => 'dashicons-chart-pie',
			'dashicons-clipboard' => 'dashicons-clipboard',
			'dashicons-clock' => 'dashicons-clock',
			'dashicons-cloud' => 'dashicons-cloud',
			'dashicons-controls-back' => 'dashicons-controls-back',
			'dashicons-controls-forward' => 'dashicons-controls-forward',
			'dashicons-controls-pause' => 'dashicons-controls-pause',
			'dashicons-controls-play' => 'dashicons-controls-play',
			'dashicons-controls-repeat' => 'dashicons-controls-repeat',
			'dashicons-controls-skipback' => 'dashicons-controls-skipback',
			'dashicons-controls-skipforward' => 'dashicons-controls-skipforward',
			'dashicons-controls-volumeoff' => 'dashicons-controls-volumeoff',
			'dashicons-controls-volumeon' => 'dashicons-controls-volumeon',
			'dashicons-dashboard' => 'dashicons-dashboard',
			'dashicons-desktop' => 'dashicons-desktop',
			'dashicons-dismiss' => 'dashicons-dismiss',
			'dashicons-download' => 'dashicons-download',
			'dashicons-edit' => 'dashicons-edit',
			'dashicons-editor-aligncenter' => 'dashicons-editor-aligncenter',
			'dashicons-editor-alignleft' => 'dashicons-editor-alignleft',
			'dashicons-editor-alignright' => 'dashicons-editor-alignright',
			'dashicons-editor-bold' => 'dashicons-editor-bold',
			'dashicons-editor-break' => 'dashicons-editor-break',
			'dashicons-editor-code' => 'dashicons-editor-code',
			'dashicons-editor-contract' => 'dashicons-editor-contract',
			'dashicons-editor-customchar' => 'dashicons-editor-customchar',
			'dashicons-editor-expand' => 'dashicons-editor-expand',
			'dashicons-editor-help' => 'dashicons-editor-help',
			'dashicons-editor-indent' => 'dashicons-editor-indent',
			'dashicons-editor-insertmore' => 'dashicons-editor-insertmore',
			'dashicons-editor-italic' => 'dashicons-editor-italic',
			'dashicons-editor-justify' => 'dashicons-editor-justify',
			'dashicons-editor-kitchensink' => 'dashicons-editor-kitchensink',
			'dashicons-editor-ol' => 'dashicons-editor-ol',
			'dashicons-editor-outdent' => 'dashicons-editor-outdent',
			'dashicons-editor-paragraph' => 'dashicons-editor-paragraph',
			'dashicons-editor-paste-text' => 'dashicons-editor-paste-text',
			'dashicons-editor-paste-word' => 'dashicons-editor-paste-word',
			'dashicons-editor-quote' => 'dashicons-editor-quote',
			'dashicons-editor-removeformatting' => 'dashicons-editor-removeformatting',
			'dashicons-editor-rtl' => 'dashicons-editor-rtl',
			'dashicons-editor-spellcheck' => 'dashicons-editor-spellcheck',
			'dashicons-editor-strikethrough' => 'dashicons-editor-strikethrough',
			'dashicons-editor-table' => 'dashicons-editor-table',
			'dashicons-editor-textcolor' => 'dashicons-editor-textcolor',
			'dashicons-editor-ul' => 'dashicons-editor-ul',
			'dashicons-editor-underline' => 'dashicons-editor-underline',
			'dashicons-editor-unlink' => 'dashicons-editor-unlink',
			'dashicons-editor-video' => 'dashicons-editor-video',
			'dashicons-ellipsis' => 'dashicons-ellipsis',
			'dashicons-email-alt' => 'dashicons-email-alt',
			'dashicons-email-alt2' => 'dashicons-email-alt2',
			'dashicons-email' => 'dashicons-email',
			'dashicons-exerpt-view' => 'dashicons-exerpt-view',
			'dashicons-external' => 'dashicons-external',
			'dashicons-facebook-alt' => 'dashicons-facebook-alt',
			'dashicons-facebook' => 'dashicons-facebook',
			'dashicons-feedback' => 'dashicons-feedback',
			'dashicons-filter' => 'dashicons-filter',
			'dashicons-flag' => 'dashicons-flag',
			'dashicons-format-aside' => 'dashicons-format-aside',
			'dashicons-format-audio' => 'dashicons-format-audio',
			'dashicons-format-chat' => 'dashicons-format-chat',
			'dashicons-format-gallery' => 'dashicons-format-gallery',
			'dashicons-format-image' => 'dashicons-format-image',
			'dashicons-format-quote' => 'dashicons-format-quote',
			'dashicons-format-status' => 'dashicons-format-status',
			'dashicons-format-video' => 'dashicons-format-video',
			'dashicons-forms' => 'dashicons-forms',
			'dashicons-googleplus' => 'dashicons-googleplus',
			'dashicons-grid-view' => 'dashicons-grid-view',
			'dashicons-groups' => 'dashicons-groups',
			'dashicons-hammer' => 'dashicons-hammer',
			'dashicons-heading' => 'dashicons-heading',
			'dashicons-heart' => 'dashicons-heart',
			'dashicons-hidden' => 'dashicons-hidden',
			'dashicons-id-alt' => 'dashicons-id-alt',
			'dashicons-id' => 'dashicons-id',
			'dashicons-image-crop' => 'dashicons-image-crop',
			'dashicons-image-filter' => 'dashicons-image-filter',
			'dashicons-image-flip-horizontal' => 'dashicons-image-flip-horizontal',
			'dashicons-image-flip-vertical' => 'dashicons-image-flip-vertical',
			'dashicons-image-rotate-left' => 'dashicons-image-rotate-left',
			'dashicons-image-rotate-right' => 'dashicons-image-rotate-right',
			'dashicons-image-rotate' => 'dashicons-image-rotate',
			'dashicons-images-alt' => 'dashicons-images-alt',
			'dashicons-images-alt2' => 'dashicons-images-alt2',
			'dashicons-index-card' => 'dashicons-index-card',
			'dashicons-info' => 'dashicons-info',
			'dashicons-insert' => 'dashicons-insert',
			'dashicons-laptop' => 'dashicons-laptop',
			'dashicons-layout' => 'dashicons-layout',
			'dashicons-leftright' => 'dashicons-leftright',
			'dashicons-lightbulb' => 'dashicons-lightbulb',
			'dashicons-list-view' => 'dashicons-list-view',
			'dashicons-location-alt' => 'dashicons-location-alt',
			'dashicons-location' => 'dashicons-location',
			'dashicons-lock' => 'dashicons-lock',
			'dashicons-marker' => 'dashicons-marker',
			'dashicons-media-archive' => 'dashicons-media-archive',
			'dashicons-media-audio' => 'dashicons-media-audio',
			'dashicons-media-code' => 'dashicons-media-code',
			'dashicons-media-default' => 'dashicons-media-default',
			'dashicons-media-document' => 'dashicons-media-document',
			'dashicons-media-interactive' => 'dashicons-media-interactive',
			'dashicons-media-spreadsheet' => 'dashicons-media-spreadsheet',
			'dashicons-media-text' => 'dashicons-media-text',
			'dashicons-media-video' => 'dashicons-media-video',
			'dashicons-megaphone' => 'dashicons-megaphone',
			'dashicons-menu-alt' => 'dashicons-menu-alt',
			'dashicons-menu' => 'dashicons-menu',
			'dashicons-microphone' => 'dashicons-microphone',
			'dashicons-migrate' => 'dashicons-migrate',
			'dashicons-minus' => 'dashicons-minus',
			'dashicons-money' => 'dashicons-money',
			'dashicons-move' => 'dashicons-move',
			'dashicons-nametag' => 'dashicons-nametag',
			'dashicons-networking' => 'dashicons-networking',
			'dashicons-no-alt' => 'dashicons-no-alt',
			'dashicons-no' => 'dashicons-no',
			'dashicons-palmtree' => 'dashicons-palmtree',
			'dashicons-paperclip' => 'dashicons-paperclip',
			'dashicons-performance' => 'dashicons-performance',
			'dashicons-phone' => 'dashicons-phone',
			'dashicons-playlist-audio' => 'dashicons-playlist-audio',
			'dashicons-playlist-video' => 'dashicons-playlist-video',
			'dashicons-plus-alt' => 'dashicons-plus-alt',
			'dashicons-plus-light' => 'dashicons-plus-light',
			'dashicons-plus' => 'dashicons-plus',
			'dashicons-portfolio' => 'dashicons-portfolio',
			'dashicons-post-status' => 'dashicons-post-status',
			'dashicons-pressthis' => 'dashicons-pressthis',
			'dashicons-products' => 'dashicons-products',
			'dashicons-randomize' => 'dashicons-randomize',
			'dashicons-redo' => 'dashicons-redo',
			'dashicons-rss' => 'dashicons-rss',
			'dashicons-saved' => 'dashicons-saved',
			'dashicons-schedule' => 'dashicons-schedule',
			'dashicons-screenoptions' => 'dashicons-screenoptions',
			'dashicons-search' => 'dashicons-search',
			'dashicons-share-alt' => 'dashicons-share-alt',
			'dashicons-share-alt2' => 'dashicons-share-alt2',
			'dashicons-share' => 'dashicons-share',
			'dashicons-shield-alt' => 'dashicons-shield-alt',
			'dashicons-shield' => 'dashicons-shield',
			'dashicons-slides' => 'dashicons-slides',
			'dashicons-smartphone' => 'dashicons-smartphone',
			'dashicons-smiley' => 'dashicons-smiley',
			'dashicons-sort' => 'dashicons-sort',
			'dashicons-sos' => 'dashicons-sos',
			'dashicons-star-empty' => 'dashicons-star-empty',
			'dashicons-star-filled' => 'dashicons-star-filled',
			'dashicons-star-half' => 'dashicons-star-half',
			'dashicons-sticky' => 'dashicons-sticky',
			'dashicons-store' => 'dashicons-store',
			'dashicons-tablet' => 'dashicons-tablet',
			'dashicons-tag' => 'dashicons-tag',
			'dashicons-tagcloud' => 'dashicons-tagcloud',
			'dashicons-testimonial' => 'dashicons-testimonial',
			'dashicons-text' => 'dashicons-text',
			'dashicons-thumbs-down' => 'dashicons-thumbs-down',
			'dashicons-thumbs-up' => 'dashicons-thumbs-up',
			'dashicons-tickets-alt' => 'dashicons-tickets-alt',
			'dashicons-tickets' => 'dashicons-tickets',
			'dashicons-translation' => 'dashicons-translation',
			'dashicons-trash' => 'dashicons-trash',
			'dashicons-twitter' => 'dashicons-twitter',
			'dashicons-undo' => 'dashicons-undo',
			'dashicons-universal-access-alt' => 'dashicons-universal-access-alt',
			'dashicons-universal-access' => 'dashicons-universal-access',
			'dashicons-unlock' => 'dashicons-unlock',
			'dashicons-update' => 'dashicons-update',
			'dashicons-upload' => 'dashicons-upload',
			'dashicons-vault' => 'dashicons-vault',
			'dashicons-video-alt' => 'dashicons-video-alt',
			'dashicons-video-alt2' => 'dashicons-video-alt2',
			'dashicons-video-alt3' => 'dashicons-video-alt3',
			'dashicons-visibility' => 'dashicons-visibility',
			'dashicons-warning' => 'dashicons-warning',
			'dashicons-welcome-add-page' => 'dashicons-welcome-add-page',
			'dashicons-welcome-comments' => 'dashicons-welcome-comments',
			'dashicons-welcome-learn-more' => 'dashicons-welcome-learn-more',
			'dashicons-welcome-view-site' => 'dashicons-welcome-view-site',
			'dashicons-welcome-widgets-menus' => 'dashicons-welcome-widgets-menus',
			'dashicons-welcome-write-blog' => 'dashicons-welcome-write-blog',
			'dashicons-wordpress-alt' => 'dashicons-wordpress-alt',
			'dashicons-wordpress' => 'dashicons-wordpress',
			'dashicons-yes' => 'dashicons-yes'
		);
		return $animate_css_animation_list;
	}
}

if(!function_exists('mascot_core_get_post_list_array_by_post_type')) {
	/**
	 * Return Post List Array By Post Type
	 */
	function mascot_core_get_post_list_array_by_post_type( $cpt = '', $for_vc = false ) {
		$post_list = array();
		$post_list[''] = esc_html__( "Select Item", 'mascot-core' );
		$args = array(
			'post_type'			=> $cpt,
			'numberposts'		=> -1,
			'orderby'			=> 'title',
			'order'				=> 'ASC'
		);

		$myposts = get_posts($args);
		if($myposts) {
			foreach ($myposts as $mypost) {
				if( $for_vc ) {
					$post_list[ get_the_title($mypost->ID) ] = $mypost->ID;
				} else {
					$post_list[ $mypost->ID ] = get_the_title($mypost->ID);
				}
			}
			wp_reset_postdata();
		}

		return $post_list;
	}
}

if ( ! function_exists( 'mascot_core_category_list_array' ) ) {
	/**
	 * Return category list array
	 */
	function mascot_core_category_list_array( $taxonomy ) {
		$list_categories = array(
			'' => esc_html__( 'All', 'mascot-core' )
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

if(!function_exists('mascot_core_orderby_parameters_list')) {
	/**
	 * Orderby Parameters list
	 */
	function mascot_core_orderby_parameters_list() {
		$orderby_parameters_list = array(
			'date'	=>	esc_html__( 'Date', 'mascot-core' ),
			'name'	=>	esc_html__( 'Post Name', 'mascot-core' ),
			'rand'	=>	esc_html__( 'Random Order', 'mascot-core' ),
			'modified'	=>	esc_html__( 'Last Modified Date', 'mascot-core' ),
			'author'	=>	esc_html__( 'Author', 'mascot-core' ),
			'title'	=>	esc_html__( 'Title', 'mascot-core' ),
			'ID'	=>	esc_html__( 'ID', 'mascot-core' ),
			'parent'	=>	esc_html__( 'Post/Page Parent ID', 'mascot-core' ),
			'comment_count'	=>	esc_html__( 'Number of Comments', 'mascot-core' ),
			'menu_order'	=>	esc_html__( 'Page Order', 'mascot-core' )
		);
		return $orderby_parameters_list;
	}
}

if(!function_exists('mascot_core_number_of_theme_colors')) {
	/**
	 * Number of Theme Colors Used in this theme
	 */
	function mascot_core_number_of_theme_colors() {
		return 4;
	}
}

if(!function_exists('mascot_core_jquery_easings_list')) {
	/**
	 * easings list http://api.jqueryui.com/easings/
	 */
	function mascot_core_jquery_easings_list() {
		$jquery_easings_list = array(
			'linear' => 'linear',
			'swing' => 'swing',
			'_default' => '_default',
			'easeInQuad' => 'easeInQuad',
			'easeOutQuad' => 'easeOutQuad',
			'easeInOutQuad' => 'easeInOutQuad',
			'easeInCubic' => 'easeInCubic',
			'easeOutCubic' => 'easeOutCubic',
			'easeInOutCubic' => 'easeInOutCubic',
			'easeInQuart' => 'easeInQuart',
			'easeOutQuart' => 'easeOutQuart',
			'easeInOutQuart' => 'easeInOutQuart',
			'easeInQuint' => 'easeInQuint',
			'easeOutQuint' => 'easeOutQuint',
			'easeInOutQuint' => 'easeInOutQuint',
			'easeInExpo' => 'easeInExpo',
			'easeOutExpo' => 'easeOutExpo',
			'easeInOutExpo' => 'easeInOutExpo',
			'easeInSine' => 'easeInSine',
			'easeOutSine' => 'easeOutSine',
			'easeInOutSine' => 'easeInOutSine',
			'easeInCirc' => 'easeInCirc',
			'easeOutCirc' => 'easeOutCirc',
			'easeInOutCirc' => 'easeInOutCirc',
			'easeInElastic' => 'easeInElastic',
			'easeOutElastic' => 'easeOutElastic',
			'easeInOutElastic' => 'easeInOutElastic',
			'easeInBack' => 'easeInBack',
			'easeOutBack' => 'easeOutBack',
			'easeInOutBack' => 'easeInOutBack',
			'easeInBounce' => 'easeInBounce',
			'easeOutBounce' => 'easeOutBounce',
			'easeInOutBounce' => 'easeInOutBounce',
		);
		return $jquery_easings_list;
	}
}



if(!function_exists('mascot_core_masonry_image_sizes')) {
	/**
	 * Masonry Image Size list
	 */
	function mascot_core_masonry_image_sizes() {
		$masonry_image_sizes = array(
			'mascot_core_square'			=> esc_html__( 'Default', 'mascot-core' ),
			'mascot_core_wide'			=> esc_html__( 'Width', 'mascot-core' ),
			'mascot_core_height'			=> esc_html__( 'Height', 'mascot-core' ),
			'mascot_core_width_height'	=> esc_html__( 'Both Width & Height', 'mascot-core' ),
		);
		return $masonry_image_sizes;
	}
}


if(!function_exists('mascot_core_heading_tag_list_all')) {
	/**
	 * Heading Tag List
	 */
	function mascot_core_heading_tag_list_all() {
		$heading_tag_list_all = array(
			'h1' => 'h1',
			'h2' => 'h2',
			'h3' => 'h3',
			'h4' => 'h4',
			'h5' => 'h5',
			'h6' => 'h6',
			'p'  => 'p',
			'a'  => 'a',
			'span'  => 'span',
			'div'  => 'div',
		);
		return $heading_tag_list_all;
	}
}

if(!function_exists('mascot_core_open_link_in')) {
	/**
	 * Open Link In
	 */
	function mascot_core_open_link_in() {
		$open_link_in = array(
			'_blank'	=> esc_html__( 'New Window', 'mascot-core' ),
			'_self'	=> esc_html__( 'Same Window', 'mascot-core' )
		);
		return $open_link_in;
	}
}

if(!function_exists('mascot_core_get_post_all_categories_array')) {
	/**
	 * Category List of Blog Posts as an Array
	 */
	function mascot_core_get_post_all_categories_array() {
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );
		$cats = array();
		$cats[''] = esc_html__( 'All', 'mascot-core' );
		foreach($categories as $cat){
			$cats[$cat->term_id] = $cat->name;
		}
		return $cats;
	}
}

if(!function_exists('mascot_core_get_page_list_array')) {
	/**
	 * Category List of Pages as an Array
	 */
	function mascot_core_get_page_list_array() {
		$all_pages = get_pages();
		$pages = array();
		foreach($all_pages as $each_page){
			$pages[$each_page->ID] = $each_page->post_title;
		}
		return $pages;
	}
}




if ( ! function_exists( 'mascot_core_prepare_button_classes_from_params' ) ) {
	/**
	 * Return Button Classes Collecting From Params
	 */
	function mascot_core_prepare_button_classes_from_params( $params = array(), $prefix = '' ) {
		$btn_classes = array();

		$btn_classes[] = 'btn';
		if( filter_var( $params[$prefix . 'btn_outlined'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$oldstr = $params[$prefix . 'btn_design_style'];
			$newstr = substr_replace($oldstr, 'outline-', 4, 0);
			$btn_classes[] = $newstr;
			$btn_classes[] = 'btn-outline';
		} else if( filter_var( $params[$prefix . 'btn_gradient_effect'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$oldstr = $params[$prefix . 'btn_design_style'];
			$newstr = substr_replace($oldstr, 'gradient-', 4, 0);
			$btn_classes[] = $newstr;
			$btn_classes[] = 'btn-outline';
		} else if ( $params[$prefix . 'btn_design_style'] ) {
			$btn_classes[] = $params[$prefix . 'btn_design_style'];
		}

		if( $params[$prefix . 'button_size'] != "" ) {
			$btn_classes[] = $params[$prefix . 'button_size'];
		}
		if( filter_var( $params[$prefix . 'btn_round'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$btn_classes[] = 'btn-round';
		}
		if( filter_var( $params[$prefix . 'btn_flat'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$btn_classes[] = 'btn-flat';
		}
		if( isset($params[$prefix . 'btn_block']) && filter_var( $params[$prefix . 'btn_block'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$btn_classes[] = 'btn-block';
		}
		if( filter_var( $params[$prefix . 'btn_threed_effect'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$btn_classes[] = 'btn-3d';
		}
		if( $params[$prefix . 'button_hover_animation_effect'] != "" ) {
			$btn_classes[] = $params[$prefix . 'button_hover_animation_effect'];
		}
		if( $params[$prefix . 'btn_class'] != "" ) {
			$btn_classes[] = $params[$prefix . 'btn_class'];
		}

		return $btn_classes;
	}
}


if ( ! function_exists( 'mascot_core_prepare_header_button_classes_from_params' ) ) {
	/**
	 * Return Header Button Classes Collecting From Params
	 */
	function mascot_core_prepare_header_button_classes_from_params( $params = array(), $prefix = '' ) {
		$btn_classes = array();

		$btn_classes[] = 'btn';
		if( $params[$prefix . 'custom_button_outlined'] ) {
			$oldstr = $params[$prefix . 'custom_button_design_style'];
			$newstr = substr_replace($oldstr, 'outline-', 4, 0);
			$btn_classes[] = $newstr;
			$btn_classes[] = 'btn-outline';
		} else if ( $params[$prefix . 'custom_button_design_style'] ) {
			$btn_classes[] = $params[$prefix . 'custom_button_design_style'];
		}
		if( $params[$prefix . 'custom_button_size'] ) {
			$btn_classes[] = $params[$prefix . 'custom_button_size'];
		}
		if( $params[$prefix . 'custom_button_flat'] ) {
			$btn_classes[] = 'btn-flat';
		}
		if( $params[$prefix . 'custom_button_round'] ) {
			$btn_classes[] = 'btn-round';
		}
		if( isset( $params[$prefix . 'custom_button_custom_css'] ) ) {
			$btn_classes[] = $params[$prefix . 'custom_button_custom_css'];
		}

		$btn_classes[] = 'custom-button';
		return $btn_classes;
	}
}

if ( ! function_exists( 'mascot_core_no_posts_match_criteria_text' ) ) {
	/**
	 * Return no posts matched your criteria text
	 */
	function mascot_core_no_posts_match_criteria_text() {
		return '<p>' . esc_html_e( 'Sorry, no posts matched your criteria.', 'mascot-core' ) . '</p>';
	}
}


if ( ! function_exists( 'mascot_core_prepare_owlcarousel_data_from_params' ) ) {
	/**
	 * Return Owl Carousel Data Collecting From Params
	 */
	function mascot_core_prepare_owlcarousel_data_from_params( $params = array(), $prefix = '' ) {
		$owlcarousel_data = array();

		if( filter_var( $params[$prefix . 'show_navigation'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-nav="true"';
		}
		if( filter_var( $params[$prefix . 'show_bullets'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-dots="true"';
		}
		if( filter_var( $params[$prefix . 'carousel_autoplay'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-autoplay="true"';
		}
		if( filter_var( $params[$prefix . 'carousel_loop'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-loop="true"';
		}

		if( $params[$prefix . 'animation_speed'] > -1 ) {
			if( empty( $params[$prefix . 'animation_speed'] ) ) {
				$params[$prefix . 'animation_speed'] = 6000;
			}
			$owlcarousel_data[] = 'data-duration="' . esc_attr( $params[$prefix . 'animation_speed'] ) . '"';
		}

		if( $params[$prefix . 'smart_speed'] > -1 ) {
			$owlcarousel_data[] = 'data-smartspeed="' . esc_attr( $params[$prefix . 'smart_speed'] ) . '"';
		}
		if( $params[$prefix . 'margin'] > -1 ) {
			$owlcarousel_data[] = 'data-margin="' . esc_attr( $params[$prefix . 'margin'] ) . '"';
		}
		if( $params[$prefix . 'stagepadding'] > -1 ) {
			$owlcarousel_data[] = 'data-stagepadding="' . esc_attr( $params[$prefix . 'stagepadding'] ) . '"';
		}
		if( !empty( $params[$prefix . 'laptop'] ) ) {
			$owlcarousel_data[] = 'data-laptop="' . esc_attr( $params[$prefix . 'laptop'] ) . '"';
		}
		if( !empty( $params[$prefix . 'laptop_large'] ) ) {
			$owlcarousel_data[] = 'data-laptop_large="' . esc_attr( $params[$prefix . 'laptop_large'] ) . '"';
		}
		if( !empty( $params[$prefix . 'tablet'] ) ) {
			$owlcarousel_data[] = 'data-tablet="' . esc_attr( $params[$prefix . 'tablet'] ) . '"';
		}
		if( !empty( $params[$prefix . 'tablet_extra'] ) ) {
			$owlcarousel_data[] = 'data-tablet_extra="' . esc_attr( $params[$prefix . 'tablet_extra'] ) . '"';
		}
		if( filter_var( $params[$prefix . 'center'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-center="true"';
		}
		if( filter_var( $params[$prefix . 'focused-center-image'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-focused-center-image="true"';
		}
		if( filter_var( $params[$prefix . 'zoomin-center-image'], FILTER_VALIDATE_BOOLEAN ) == true ) {
			$owlcarousel_data[] = 'data-zoomin-center-image="true"';
		}

		return $owlcarousel_data;
	}
}


if ( ! function_exists( 'mascot_core_get_wpml_languages' ) ) {
	/**
	 * Return wpml_languages
	 */
	function mascot_core_get_wpml_languages() {
		$wpml = array();
		if(defined('ICL_LANGUAGE_CODE')) {
			$current_language_code = ICL_LANGUAGE_CODE;
			$langs = icl_get_languages('skip_missing=0');

			if(!empty($langs)) {
				if(!empty($langs[$current_language_code])) {
					$current_language = $langs[$current_language_code];
					$wpml[] = array(
						'label' => $current_language['native_name'],
						'url' => $current_language['url'],
						'country_flag_url' => $current_language['country_flag_url'],
					);
				}

				foreach($langs as $lang_key => $lang_info) {
					if($lang_key !== $current_language_code) {
						$wpml[] = array(
							'label' => $lang_info['native_name'],
							'url' => $lang_info['url'],
							'country_flag_url' => $lang_info['country_flag_url'],
						);
					}
				}
			}
		}

		return apply_filters('mascot_core_get_wpml_languages', $wpml);
	}
}


if ( ! function_exists( 'mascot_core_get_wpml_language_switcher' ) ) {
	/**
	 * Return wpml_language_switcher
	 */
	function mascot_core_get_wpml_language_switcher() {

		$element['dropdown'] = mascot_core_get_wpml_languages();

		$element_id = mascot_core_random_word();

		if( !empty( $element['dropdown'] ) ) {
			$dropdown = mascot_core_get_dropdown( $element['dropdown'] );
		}

		if( !empty( $dropdown ) ): ?>
			<div class="dropdown tm-wpml-language-switcher">
				<?php if( !empty( $dropdown['first'] ) ): ?>
					<div class="dropdown-toggle"
						 id="<?php echo esc_attr( $element_id ); ?>"
						 data-toggle="dropdown"
						 aria-haspopup="true"
						 aria-expanded="true"
						 >
						 <img src="<?php echo esc_url( $dropdown['first']['country_flag_url'] ); ?>" height="12" alt="<?php echo esc_attr( $dropdown['first']['label'] ); ?>" width="18" />
						<?php echo esc_html( $dropdown['first']['label'] ); ?>
						<span class="caret"></span>
					</div>
				<?php endif; ?>

				<?php if( !empty( $dropdown['others'] ) ): ?>
					<ul class="dropdown-list dropdown-menu dropdown-menu-right"
						aria-labelledby="<?php echo esc_attr( $element_id ); ?>">
						<?php foreach( $dropdown['others'] as $key => $value): ?>
							<li>
								<a class="dropdown-item" href="<?php echo esc_url( $value['url'] ) ?>">
									<img src="<?php echo esc_url( $value['country_flag_url'] ); ?>" height="12" alt="<?php echo esc_attr( $value['label'] ); ?>" width="18" />
									<?php echo esc_html( $value['label'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php

	}
}


if(!function_exists('mascot_core_social_links_colors')) {
	/**
	 * Return Social Links Colors
	 */
	function mascot_core_social_links_colors() {
		$social_links_color = array(
			'twitter' => array(
				"name" => "Twitter",
				"icon" => "twitter",
				"color" => "#02B0E8",
			),
			'facebook' => array(
				"name" => "Facebook",
				"icon" => "facebook",
				"color" => "#3B5998",
			),
			'youtube' => array(
				"name" => "Youtube",
				"icon" => "youtube",
				"color" => "#C71F1E",
			),
			'instagram' => array(
				"name" => "Instagram",
				"icon" => "instagram",
				"color" => "#E2002B",
			),
			'google-plus' => array(
				"name" => "Google Plus",
				"icon" => "google-plus",
				"color" => "#D71619",
			),
			'linkedin' => array(
				"name" => "Linkedin",
				"icon" => "linkedin",
				"color" => "#007BB6",
			),
			'tumblr' => array(
				"name" => "Tumblr",
				"icon" => "tumblr",
				"color" => "#35455C",
			),
			'vk' => array(
				"name" => "VK",
				"icon" => "vk",
				"color" => "#4C75A3",
				"target" => "_blank",
			),
			'pinterest' => array(
				"name" => "Pinterest",
				"icon" => "pinterest",
				"color" => "#E71F28",
			),
			'reddit' => array(
				"name" => "Reddit",
				"icon" => "reddit",
				"color" => "#6CC0FF",
			),
			'envelope' => array(
				"name" => "Email",
				"icon" => "envelope-o",
				"color" => "#787482",
			),
			'external-link' => array(
				"name" => "Print",
				"icon" => "external-link",
				"color" => "#333",
			),
		);

		return $social_links_color;
	}
}



if(!function_exists('mascot_core_get_inline_attrs')) {
	/**
	 * Generate multiple inline attributes
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	function mascot_core_get_inline_attrs($attrs) {
		$output = '';

		if(is_array($attrs) && count($attrs)) {
			foreach($attrs as $attr => $value) {
				$output .= ' '.mascot_core_get_inline_attr($value, $attr);
			}
		}

		$output = ltrim($output);

		return $output;
	}
}


if(!function_exists('mascot_core_get_inline_attributes')) {
	/**
	 * Get inline attributes and it's properties
	 */
	function mascot_core_get_inline_attributes( $values, $attribute, $glue = '' ) {
		if( $values != '' ) {
			if( is_array( $values ) && count( $values ) ) {
				$properties = implode( $glue, $values );
			} elseif( $values !== '' ) {
				$properties = $values;
			}

			return $attribute . '="' . esc_attr($properties) . '"';
		}
		return '';
	}
}


if(!function_exists('mascot_core_get_inline_css')) {
	/**
	 * Get inline CSS
	 */
	function mascot_core_get_inline_css( $values ) {
		return mascot_core_get_inline_attributes( $values, 'style', $glue = ';' );
	}
}


if(!function_exists('mascot_core_get_inline_classes')) {
	/**
	 * Get inline classes
	 */
	function mascot_core_get_inline_classes( $values ) {
		return mascot_core_get_inline_attributes( $values, 'class', $glue = ' ' );
	}
}

if ( ! function_exists( 'mascot_core_get_isotope_holder_ID' ) ) {
	/**
	 * Returns Portfolio Holder ID
	 *
	 */
	function mascot_core_get_isotope_holder_ID( $id_prefix = 'id' ) {
		$random_number = wp_rand( 111111, 999999 );
		$holder_id = $id_prefix . '-holder-' . $random_number;
		return $holder_id;
	}
}

if ( ! function_exists( 'mascot_core_wp_enqueue_script_lightgallery' ) ) {
	/**
	 * wp_enqueue_script for lightgallery
	 */
	function mascot_core_wp_enqueue_script_lightgallery() {
		wp_enqueue_script( 'lightgallery' );
		wp_enqueue_style( 'lightgallery' );
		wp_enqueue_script( 'jquery-mousewheel' );
		wp_enqueue_script( 'mediko-custom-lightgallery' );
	}
}



if ( ! function_exists( 'mascot_core_wp_enqueue_script_owl_carousel' ) ) {
	/**
	 * wp_enqueue_script for owl_carousel
	 */
	function mascot_core_wp_enqueue_script_owl_carousel() {
		wp_enqueue_script( 'owl-carousel' );
		wp_enqueue_script( 'jquery-owl-filter' );
		wp_enqueue_script( 'owl-carousel2-thumbs' );
	}
}

if(!function_exists('mascot_core_if_numeric_add_suffix')) {
	/**
	 * Add Suffix from String
	 */
	function mascot_core_if_numeric_add_suffix( $string, $suffix )
	{
		if( $string != '' && is_numeric($string) ) {
			$string = $string.$suffix;
		}
		return $string;
	}
}


if(!function_exists('mascot_core_get_redux_option')) {
	/**
	 * Retuns Redux Theme Option
	 */
	function mascot_core_get_redux_option( $id, $fallback = false, $param = false ) {
		global $coprot_wp_redux_theme_opt;

		if ( $fallback == false ) $fallback = '';

		$output = ( isset( $coprot_wp_redux_theme_opt[$id] ) && $coprot_wp_redux_theme_opt[$id] !== '' ) ? $coprot_wp_redux_theme_opt[$id] : $fallback;

		if ( !empty( $coprot_wp_redux_theme_opt[$id] ) && $param ) {
			$output = $coprot_wp_redux_theme_opt[$id][$param];
		}
		return $output;
	}
}