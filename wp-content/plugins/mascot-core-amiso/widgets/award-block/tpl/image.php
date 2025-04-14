
        <?php if( isset( $featured_image['id'] ) && !empty( $featured_image['id'] ) ): ?>
          <img src="<?php $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
        <?php endif; ?>