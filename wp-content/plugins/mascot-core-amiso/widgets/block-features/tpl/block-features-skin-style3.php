<?php $settings['settings'] = $settings;?>
<div class="feature-current-item-style3 <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
  <div class="thumb">
    <?php mascot_core_amiso_get_shortcode_template_part( 'icon-type', $icon_type, 'block-features/tpl', $settings, false );?>
  </div>
  <div class="content">
    <?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'block-features/tpl', $settings, false );?>
    <?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'block-features/tpl', $settings, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
    <?php mascot_core_amiso_get_shortcode_template_part( 'button', null, 'block-features/tpl', $settings, false );?>
    <?php endif; ?>
  </div>
</div>