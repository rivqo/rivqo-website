<?php $settings['settings'] = $settings;?>
<div class="feature-current-item-style5 <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
  <div class="inner-box">
    <div class="icon-box">
      <?php mascot_core_amiso_get_shortcode_template_part( 'icon', null, 'block-features/tpl', $settings, false );?>
    </div>
    <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'block-features/tpl', $settings, false );?>
    <?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'block-features/tpl', $settings, false );?>
  </div>
</div>