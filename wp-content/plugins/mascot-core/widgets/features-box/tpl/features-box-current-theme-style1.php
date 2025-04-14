<div class="feature-current-item <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
  <div class="feature-icon">
		<?php mascot_core_get_shortcode_template_part( 'icon', null, 'icon-box/tpl', $settings, false );?>
  </div>
  <?php if ( $show_title == 'yes' ) : ?>
  <?php mascot_core_get_shortcode_template_part( 'title', null, 'features-box/tpl', $settings, false );?>
  <?php endif; ?>

  <?php if ( $show_paragraph == 'yes' ) : ?>
  <?php mascot_core_get_shortcode_template_part( 'content', null, 'features-box/tpl', $settings, false );?>
  <?php endif; ?>
</div>