<?php $settings['settings'] = $settings;?>

		<?php if( isset($icon_type) ) { ?>
		<a class="icon icon-type-<?php echo esc_attr( $icon_type );?> <?php echo esc_attr( $icon_size );?> <?php echo esc_attr( $icon_color );?> <?php if( $icon_border_style ) { echo esc_attr( 'icon-bordered' ); }?> <?php echo esc_attr( $icon_style );?> <?php echo esc_attr(implode(' ', $icon_classes)); ?>" 
			
			<?php if( !empty( $url ) ): ?>
			<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
			href="<?php echo esc_url( $url );?>"
			<?php endif ?>
			<?php echo html_entity_decode( esc_attr( $icon_parent_inline_css ) );?>
		>
			<?php mascot_core_get_shortcode_template_part( 'icon-type', $icon_type, 'icon-box/tpl', $settings, false );?>
		</a>
		<?php } ?>