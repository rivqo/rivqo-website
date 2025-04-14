<?php if( $subtitle_text != '' ): ?>
	<?php if( $animation_effect != '' ): ?>
		<<?php echo esc_attr( $subtitle_tag ); ?> class="subtitle" style="<?php echo esc_attr( $subtitle_color ); ?>"><?php echo esc_html( $subtitle_text ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
	<?php else: ?>
		<<?php echo esc_attr( $subtitle_tag ); ?> class="subtitle" style="<?php echo esc_attr( $subtitle_color ); ?>"><?php echo esc_html( $subtitle_text ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
	<?php endif; ?>
<?php endif; ?>