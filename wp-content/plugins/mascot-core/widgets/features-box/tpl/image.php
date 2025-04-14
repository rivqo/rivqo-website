<div class="thumb">
	<a href="#">
		<?php
		$image = wp_get_attachment_image_src( $featured_image['id'], $predefined_image_size);
		if( !empty($image[0]) ) {
		?>
		<img class="featured-image" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
		<?php } ?>

		<?php
		$image_hover = wp_get_attachment_image_src( $featured_image_hover['id'], $predefined_image_size);
		if( !empty($image_hover[0]) ) {
		?>
		<img class="featured-image-hover" src="<?php echo esc_url( $image_hover[0] ); ?>" alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
		<?php } ?>
	</a>
</div>