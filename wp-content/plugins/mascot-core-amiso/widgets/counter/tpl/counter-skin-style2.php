<?php $settings['settings'] = $settings;?>
<div class="counter-block-two">
	<div class="inner">
		<?php if ( $show_icon_image == 'yes' ): ?>
			<?php mascot_core_amiso_get_shortcode_template_part( 'icon-type', $icon_type, 'counter/tpl', $settings, false );?>
		<?php endif;?>
		<div class="counter-details">
			<div class="count-box counted">
				<?php if ( $show_counter == 'yes' ): ?>
					<?php mascot_core_amiso_get_shortcode_template_part( 'counter', null, 'counter/tpl', $settings, false );?>
				<?php endif;?>
			</div>
			<?php if ( $show_title == 'yes' ): ?>
				<?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'counter/tpl', $settings, false );?>
			<?php endif;?>
		</div>
	</div>
</div>