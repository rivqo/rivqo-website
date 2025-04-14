<?php
	$term_slugs_list = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "slugs") );
	$term_slugs_list_string = implode( ' ', $term_slugs_list );


	$masonry_tiles_image_size_class = 'tm-masonry-default';
	if ( $use_masonry_tiles_featured_image_size == 'yes' ) :
		$settings['featured_image_size'] = $meta_featured_image_size = amiso_get_rwmb_group( 'amiso_' . "portfolio_mb_featured_image_size_settings", 'masonry_tiles_featured_image_size' );

		$masonry_tiles_image_size_class = 'tm-masonry-default';
		switch ( $meta_featured_image_size ) {
			case 'amiso_height':
				# code...
				$masonry_tiles_image_size_class = 'tm-masonry-large-height';
				break;

			case 'amiso_wide':
				# code...
				$masonry_tiles_image_size_class = 'tm-masonry-large-wide';
				break;

			case 'amiso_width_height':
				# code...
				$masonry_tiles_image_size_class = 'tm-masonry-large-width-height';
				break;

			case 'default':
				$masonry_tiles_image_size_class = 'tm-masonry-default';
				$settings['featured_image_size'] = $featured_image_size;
				# code...
				break;

			default:
				# code...
				break;
		}

		if( $settings['display_type'] != 'masonry-tiles') {
			$masonry_tiles_image_size_class = '';
		}
	endif;
?>