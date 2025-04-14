<?php $settings['settings'] = $settings;?>
<div class="feature-current-item-style6 f-counter <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
  <div class="inner-box ">
    <div class="icon-box">
      <?php mascot_core_amiso_get_shortcode_template_part( 'icon', null, 'block-features/tpl', $settings, false );?>
      <span class="count"><?php echo esc_html( $counting_number ); ?></span>
    </div>
    <div class="content-box">
      <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'block-features/tpl', $settings, false );?>
      <?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'block-features/tpl', $settings, false );?>
    </div>
  </div>
</div>