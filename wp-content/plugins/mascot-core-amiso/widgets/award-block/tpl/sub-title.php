
		<?php if( !empty( $subtitle ) ) : ?>
		<<?php echo esc_attr( $subtitle_tag );?> class="feature-subtitle">
			<?php if( !empty( $url ) ): ?>
			<a
				<?php echo $target;?>
				href="<?php echo esc_url( $url );?>">
				<?php echo esc_html( $subtitle );?>
			</a>
			<?php else: ?>
				<?php echo esc_html( $subtitle );?>
			<?php endif ?>
		</<?php echo esc_attr( $subtitle_tag );?>>
		<?php endif; ?>