<?php

if(!function_exists('mascot_core_amiso_theme_color_list_vc')) {
	/**
	 * Theme Color list for VC
	 */
	function mascot_core_amiso_theme_color_list_vc() {
		$theme_color_list = array();
		if( function_exists('mascot_core_theme_color_list_vc') ) {
			$theme_color_list = mascot_core_theme_color_list_vc();
		}
		return $theme_color_list;
	}
}

if(!function_exists('mascot_core_amiso_theme_color_list')) {
	/**
	 * Theme Color list
	 */
	function mascot_core_amiso_theme_color_list() {
		$theme_color_list = array();
		if( function_exists('mascot_core_theme_color_list') ) {
			$theme_color_list = mascot_core_theme_color_list();
		}
		return $theme_color_list;
	}
}

if(!function_exists('mascot_core_amiso_number_of_theme_colors')) {
	/**
	 * Number of Theme Colors Used in this theme
	 */
	function mascot_core_amiso_number_of_theme_colors() {
		$number_of_theme_colors = 2;
		if( function_exists('amiso_number_of_theme_colors') ) {
			$number_of_theme_colors = amiso_number_of_theme_colors();
		}
		return $number_of_theme_colors;
	}
}

if(!function_exists('mascot_core_amiso_icon_font_packs')) {
	/**
	 * Theme Color list
	 */
	function mascot_core_amiso_icon_font_packs( $icon_type = 'font_awesome' ) {
		$icon_font_packs = array();
		if( function_exists('amiso_icon_font_packs') ) {
			$icon_font_packs = amiso_icon_font_packs()->getIconFontPackByKey($icon_type)->getFileTypeIconList();
		}
		return $icon_font_packs;
	}
}

if(!function_exists('mascot_core_amiso_animate_css_animation_list')) {
	/**
	 * animate.css animation list https://daneden.github.io/animate.css/
	 */
	function mascot_core_amiso_animate_css_animation_list() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_animate_css_animation_list();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_tm_custom_animation_class_list')) {
	/**
	 * custom made animation list
	 */
	function mascot_core_amiso_tm_custom_animation_class_list() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_tm_custom_animation_class_list();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_jquery_easings_list')) {
	/**
	 * easings list http://api.jqueryui.com/easings/
	 */
	function mascot_core_amiso_jquery_easings_list() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_jquery_easings_list();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_orderby_parameters_list')) {
	/**
	 * Orderby Parameters list
	 */
	function mascot_core_amiso_orderby_parameters_list() {
		if( mascot_core_amiso_theme_installed() ) {
			return mascot_core_orderby_parameters_list();
		} else {
			return array(
				esc_html__( 'Date', 'mascot-core-amiso' ) 				=> 'date',
			);
		}
	}
}

if(!function_exists('mascot_core_amiso_category_orderby_parameters_list')) {
	/**
	 * Category Orderby Parameters list
	 */
	function mascot_core_amiso_category_orderby_parameters_list() {
		$orderby_parameters_list = array(
			esc_html__( 'name', 'mascot-core-amiso' ) 	=> 'name',
			esc_html__( 'id', 'mascot-core-amiso' ) 		=> 'id',
			esc_html__( 'count', 'mascot-core-amiso' ) 	=> 'count',
			esc_html__( 'slug', 'mascot-core-amiso' ) 	=> 'slug',
		);
		return $orderby_parameters_list;
	}
}

if(!function_exists('mascot_core_amiso_isotope_gutter_list')) {
	/**
	 * Gutter list
	 */
	function mascot_core_amiso_isotope_gutter_list() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_isotope_gutter_list();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_different_size_list')) {
	/**
	 * Size list
	 */
	function mascot_core_amiso_different_size_list() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_different_size_list();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_get_post_all_categories_array')) {
	/**
	 * Category List of Blog Posts as an Array
	 */
	function mascot_core_amiso_get_post_all_categories_array() {
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );
		$cats = array();
		$cats[''] = esc_html__( 'All', 'mascot-core-amiso' );
		foreach($categories as $cat){
			$cats[$cat->term_id] = $cat->name;
		}
		return $cats;
	}
}

if(!function_exists('mascot_core_amiso_get_page_list_array')) {
	/**
	 * Category List of Pages as an Array
	 */
	function mascot_core_amiso_get_page_list_array() {
		$all_pages = get_pages();
		$pages = array();
		foreach($all_pages as $each_page){
			$pages[$each_page->ID] = $each_page->post_title;
		}
		return $pages;
	}
}

if ( ! function_exists( 'mascot_core_amiso_metabox_get_list_of_predefined_theme_color_css_files' ) ) {
	/**
	 * Get list of Predefined Theme Color css files
	 */
	function mascot_core_amiso_metabox_get_list_of_predefined_theme_color_css_files() {
		$predefined_theme_colors = array();

		if( $handle = opendir( MASCOT_TEMPLATE_DIR . '/assets/css/colors/' ) ) {
			while( false !== ($entry = readdir($handle)) ) {
				if( $entry != "." && $entry != ".." ) {
					$predefined_theme_colors[$entry] = $entry;
				}
			}
			closedir($handle);
		}
		return $predefined_theme_colors;
	}
}

if ( ! function_exists( 'mascot_core_amiso_category_list_array' ) ) {
	/**
	 * Return category list array
	 */
	function mascot_core_amiso_category_list_array( $taxonomy ) {
		$list_categories = array(
			'' => esc_html__( 'All', 'mascot-core-amiso' )
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

if ( ! function_exists( 'mascot_core_amiso_load_styles' ) ) {
	/**
	 * Get style array
	 */
	function mascot_core_amiso_load_styles( $qty = 1, $param_name = 'design_style', $admin_label = false ) {
		$options = array();
		for ($i = 1; $i <= $qty; $i++) {
			$options[sprintf(esc_html__("Style %s", 'mascot-core-amiso'), $i)] = "style{$i}";
		}

		$array = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Design Style', 'mascot-core-amiso'),
			'param_name' => $param_name,
			'value'      => $options,
			'std'        => 'style1'
		);

		if ($admin_label) $array['admin_label'] = true;

		return $array;
	}
}

if(!function_exists('mascot_core_amiso_get_btn_design_style')) {
	/**
	 * Return Design Style
	 */
	function mascot_core_amiso_get_btn_design_style() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_get_btn_design_style();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_get_button_size')) {
	/**
	 * Return Button Size
	 */
	function mascot_core_amiso_get_button_size() {
		if( mascot_core_amiso_theme_installed() ) {
			return amiso_get_button_size();
		} else {
			return array();
		}
	}
}

if(!function_exists('mascot_core_amiso_get_post_list_array_by_post_type_old')) {
	/**
	 * Return Post List Array By Post Type
	 */
	function mascot_core_amiso_get_post_list_array_by_post_type_old( $cpt = '', $for_vc = false ) {
		$post_list = array();
		$args = array(
			'post_type'			=> $cpt,
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'ASC'
		);

		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				if( $for_vc ) {
					$post_list[ get_the_title() ] = get_the_ID();
				} else {
					$post_list[ get_the_ID() ] = get_the_title();
				}
			}
			wp_reset_postdata();
		}

		return $post_list;
	}
}

if(!function_exists('mascot_core_amiso_get_post_list_array_by_post_type')) {
	/**
	 * Return Post List Array By Post Type
	 */
	function mascot_core_amiso_get_post_list_array_by_post_type( $cpt = '', $for_vc = false ) {
		$post_list = array();
		$post_list[''] = esc_html__( "Select Item", 'mascot-core-amiso' );
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

if(!function_exists('mascot_core_amiso_set_admin_ajax_url')){
	/**
	 * Set admin ajax url via javascript
	 *
	 */
	function mascot_core_amiso_set_admin_ajax_url() {
		echo '<script type="application/javascript">var MascotCoreAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}
	add_action('wp_enqueue_scripts', 'mascot_core_amiso_set_admin_ajax_url');
}

if(!function_exists('mascot_core_amiso_row_typography')){
	/**
	 * Return Row Typography Array
	 *
	 */
	function mascot_core_amiso_row_typography() {
		$array = array();

		$array = array(
			"type"			=> 'dropdown',
			"heading"		=> esc_html__( "Row Typography", 'mascot-core-amiso' ) ,
			"param_name"	=> "section_typo",
			"description"	=> esc_html__( "Define the color typography of the text of this row.", 'mascot-core-amiso' ) ,
			"value" => array(
				esc_html__( 'Default', 'mascot-core-amiso' ) => '',
				esc_html__( 'Light Typography - on Dark Background', 'mascot-core-amiso' ) => 'section-typo-light',
				esc_html__( 'Dark Typography - on White Background', 'mascot-core-amiso' ) => 'section-typo-dark',
			) ,
			"weight" => "99"
		);

		return $array;
	}
}

if(!function_exists('mascot_core_amiso_base_64_decode')){
	/**
	 * Return urldecode base64_decode
	 *
	 */
	function mascot_core_amiso_base_64_decode($code) {
		return urldecode(base64_decode($code));
	}
}

if(!function_exists('mascot_core_amiso_base_64_decode_raw_html')){
	/**
	 * Return rawurldecode base64_decode
	 *
	 */
	function mascot_core_amiso_base_64_decode_raw_html($code) {
		return rawurldecode( base64_decode( wp_strip_all_tags( $code ) ) );
	}
}

if(!function_exists('mascot_core_amiso_get_animation_type')) {
	/**
	 * Return animation type
	 */
	function mascot_core_amiso_get_animation_type() {
		$array = array(
			esc_html__( 'None', 'mascot-core-amiso' )	=>	'',

			esc_html__( 'Floating Animation', 'mascot-core-amiso' )	=>	'tm-animation-floating',
			esc_html__( 'Horizontal Slide Animation', 'mascot-core-amiso' )	=>	'tm-animation-slide-horizontal',
			esc_html__( 'Scaling Animation', 'mascot-core-amiso' )	=>	'tm-animation-scaling',

			esc_html__( 'Flicker Animation', 'mascot-core-amiso' )	=>	'tm-animation-flicker',
			esc_html__( 'Spin Animation', 'mascot-core-amiso' )	=>	'tm-animation-spin',
			esc_html__( 'Rotated Half Animation', 'mascot-core-amiso' )	=>	'tm-animation-rotated-half',
			esc_html__( 'Jump Animation', 'mascot-core-amiso' )	=>	'tm-animation-jump',

			esc_html__( 'Run Animation', 'mascot-core-amiso' )	=>	'tm-animation-run',
			esc_html__( 'Scale Right Animation', 'mascot-core-amiso' )	=>	'tm-animation-scale-right',

			esc_html__( 'Random Animation 1', 'mascot-core-amiso' )	=>	'tm-animation-random-animation1',
			esc_html__( 'Random Animation 2', 'mascot-core-amiso' )	=>	'tm-animation-random-animation2',
			esc_html__( 'Random Animation 3', 'mascot-core-amiso' )	=>	'tm-animation-random-animation3',
			esc_html__( 'Random Animation 4', 'mascot-core-amiso' )	=>	'tm-animation-random-animation4',
			esc_html__( 'Random Animation 5', 'mascot-core-amiso' )	=>	'tm-animation-random-animation5',
		);
		return $array;
	}
}