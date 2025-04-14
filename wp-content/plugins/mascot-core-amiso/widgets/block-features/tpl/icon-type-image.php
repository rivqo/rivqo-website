<?php if( isset( $feature_image['id'] ) && !empty( $feature_image['id'] ) ): ?>
<div class="icon icon-img <?php if( isset( $feature_image_hover['id'] ) && !empty( $feature_image_hover['id'] ) ) echo "has-thumb-hover" ?>">
	<img class="thumb" src="<?php $image = wp_get_attachment_image_src( $feature_image['id'], $feature_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
	<?php if( isset( $feature_image_hover['id'] ) && !empty( $feature_image_hover['id'] ) ) { ?>
	<img class="thumb-hover" src="<?php $image = wp_get_attachment_image_src( $feature_image_hover['id'], $feature_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
	<?php } ?>
</div>
<?php endif; ?>