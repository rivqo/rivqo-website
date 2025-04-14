<div class="block-testimonial-style1 <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
  <div class="quote">
    <div class="quote-wrapper">
      <?php echo do_shortcode($content); ?>
    </div>
  </div>
  <div class="thumb-singature d-flex align-items-center">
    <div class="thumb mr-20">
      <?php if( isset( $thumb_img['id'] ) && !empty( $thumb_img['id'] ) ): ?>
      <img class="rounded-circle" src="<?php $image = wp_get_attachment_image_src( $thumb_img['id'], $image_icon_predefined_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
      <?php endif; ?>
    </div>
    <div class="signature">
      <?php if( isset( $singnature_img['id'] ) && !empty( $singnature_img['id'] ) ): ?>
      <img class="rounded-circle" src="<?php $image = wp_get_attachment_image_src( $singnature_img['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
      <?php endif; ?>
      <h5><?php echo esc_html( $name_text );?></h5>
    </div>
  </div>
</div>