<div class="spin-text-around-logo">
	<?php if( isset( $spin_image ) && !empty( $spin_image ) ): ?>
	<img class="spin-img" src="<?php $image = wp_get_attachment_image_src( $spin_image['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
	<?php endif; ?>
	<span class="letter"><?php echo esc_html( $text );?></span>
</div>