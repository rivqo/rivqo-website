<?php $settings['settings'] = $settings;?>
<div class="tm-sc-icon-box icon-box icon-right icon-right-style2 <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" <?php echo mascot_core_get_inline_attrs($svg_animation_data); ?>>
	<?php mascot_core_get_shortcode_template_part( 'bgimg-hover', null, 'icon-box/tpl', $settings, false );?>
	<div class="icon-box-wrapper">
		<div class="icon-right-block">
			<div class="icon-box-icon">
				<?php mascot_core_get_shortcode_template_part( 'icon', null, 'icon-box/tpl', $settings, false );?>
			</div>
			<?php  if( $settings['switch_title_content_pos'] === 'yes' ) {?>
			<?php mascot_core_get_shortcode_template_part( 'content', null, 'icon-box/tpl', $settings, false );?>
			<?php } else {?>
			<?php mascot_core_get_shortcode_template_part( 'title', null, 'icon-box/tpl', $settings, false );?>
			<?php }?>
		</div>
		<div class="icon-text">
			<?php  if( $settings['switch_title_content_pos'] === 'yes' ) {?>
			<?php mascot_core_get_shortcode_template_part( 'title', null, 'icon-box/tpl', $settings, false );?>
			<?php } else {?>
			<?php mascot_core_get_shortcode_template_part( 'content', null, 'icon-box/tpl', $settings, false );?>
			<?php }?>

			<?php mascot_core_get_shortcode_template_part( 'bg-shadow-icon', null, 'icon-box/tpl', $settings, false );?>

			<?php if ( $show_view_details_button == 'yes' ) : ?>
			<?php mascot_core_get_shortcode_template_part( 'button', null, 'icon-box/tpl', $settings, false );?>
			<?php endif; ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>