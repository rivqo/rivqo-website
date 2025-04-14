<?php $settings['settings'] = $settings;?>
<div class="tm-sc-funfact funfact-current-theme-style1">
	<div class="funfact-inner">
		<?php if ( $show_icon_image == 'yes' ) : ?>
			<?php mascot_core_get_shortcode_template_part( 'icon-type', $icon_type, 'funfact-counter/tpl', $settings, false );?>
		<?php endif; ?>
		<div class="content">
			<?php if ( $show_counter == 'yes' ) : ?>
				<?php mascot_core_get_shortcode_template_part( 'counter', null, 'funfact-counter/tpl', $settings, false );?>
			<?php endif; ?>
			<?php if ( $show_title == 'yes' ) : ?>
				<?php mascot_core_get_shortcode_template_part( 'title', null, 'funfact-counter/tpl', $settings, false );?>
			<?php endif; ?>
		</div>
	</div>
</div>