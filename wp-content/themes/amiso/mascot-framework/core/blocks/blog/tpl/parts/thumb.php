<?php
	if ( has_post_thumbnail() ) {
		$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		$thumbnail_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $img_size );
	?>

	<div class="post-thumb-inner">
		<div class="thumb">
			<img src="<?php echo esc_url( $thumbnail_image_url[0] ); ?>" width="<?php echo esc_attr( $thumbnail_image_url[1] );?>" height="<?php echo esc_attr( $thumbnail_image_url[2] );?>" alt="<?php the_title_attribute(); ?>"/>
		</div>
	</div>
	<?php
	}
	?>
