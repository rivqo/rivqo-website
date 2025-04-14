
<?php 
	wp_register_script( 'magnific-popup', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), false, true );
	wp_register_style( 'magnific-popup', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/magnific-popup/magnific-popup.css' );
	wp_enqueue_script( 'magnific-popup' );
	wp_enqueue_style( 'magnific-popup' );
	
	$direction_suffix = is_rtl() ? '.rtl' : '';
	wp_register_style( 'tm-video-popup-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/video-popup' . $direction_suffix . '.css' );
	//classes_first
	$classes_first = array();
	if( !empty($display_type) ) {
		$classes_first[] = $display_type;
	}
	if( !empty($image_animation_effect) ) {
		$classes_first[] = 'tm-animation '.$image_animation_effect;
	}
	$classes_first[] = $image_wrapper_custom_css_class;
	$classes_first = $classes_first;
	$item['classes_first'] = $classes_first;
?>
<?php $item['item'] = $item;?>
<?php mascot_core_get_shortcode_template_part( 'play-btn-'.$play_btn_style, null, 'animated-layers/tpl', $item, false );?>