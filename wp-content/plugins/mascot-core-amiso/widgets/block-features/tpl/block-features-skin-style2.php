<!-- Feature Block Style Two -->
<?php $settings['settings'] = $settings;
$first_letter_title = substr($title, 0, 1);
?>
<div class="feature-block feature-current-item-style2">
  <div class="inner-box ">
    <div class="image">
      <?php if( isset( $skin_style2_featured_image['id'] ) && !empty( $skin_style2_featured_image['id'] ) ): ?>
      <img src="<?php $image = wp_get_attachment_image_src( $skin_style2_featured_image['id'], $skin_style2_featured_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
      <?php endif; ?>
      <span class="icon"><?php echo $first_letter_title; ?></span>
    </div>
    <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'block-features/tpl', $settings, false );?>
    <?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'block-features/tpl', $settings, false );?>
  </div>
</div>