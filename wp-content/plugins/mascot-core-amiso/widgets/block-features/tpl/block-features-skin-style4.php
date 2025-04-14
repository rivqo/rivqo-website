<!-- Feature Block -->
<?php $settings['settings'] = $settings;?>
<div class="feature-block feature-current-item-style4 <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
  <div class="inner-box">
    <div class="image-box">
      <figure class="image">
        <?php if( isset( $skin_style4_featured_image['id'] ) && !empty( $skin_style4_featured_image['id'] ) ): ?>
        <img src="<?php $image = wp_get_attachment_image_src( $skin_style4_featured_image['id'], $skin_style4_featured_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
        <?php endif; ?>
      </figure>
      <div class="info-box">
      <?php mascot_core_amiso_get_shortcode_template_part( 'icon-type', $icon_type, 'block-features/tpl', $settings, false );?>
      <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'block-features/tpl', $settings, false );?>
      </div>
    </div>
    <div class="overlay-content">
      <div class="info-box">
      <?php mascot_core_amiso_get_shortcode_template_part( 'icon-type', $icon_type, 'block-features/tpl', $settings, false );?>
      <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'block-features/tpl', $settings, false );?>
      <?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'block-features/tpl', $settings, false );?>
      </div>
    </div>
  </div>
</div>