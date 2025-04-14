
	<?php if( isset( $pricing_image['id'] ) && !empty( $pricing_image['id'] ) ): ?>
	<div class="pricing-table-thumb <?php if( isset( $pricing_image_hover['id'] ) && !empty( $pricing_image_hover['id'] ) ) echo "has-thumb-hover" ?>">
		<img class="thumb" src="<?php $image = wp_get_attachment_image_src( $pricing_image['id'], $pricing_predefined_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
		<?php if( isset( $pricing_image_hover['id'] ) && !empty( $pricing_image_hover['id'] ) ) { ?>
		<img class="thumb-hover" src="<?php $image = wp_get_attachment_image_src( $pricing_image_hover['id'], $pricing_predefined_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
		<?php } ?>
	</div>
	<?php endif; ?>