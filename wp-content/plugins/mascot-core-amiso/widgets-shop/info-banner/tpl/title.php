
		<?php if( !empty( $title ) ) : ?>
		<<?php echo esc_attr( $title_tag );?> class="title">
			<?php if( $link_title == 'yes' && !empty( $url ) ): ?>
			<a 
				<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
				href="<?php echo esc_url( $url );?>">
				<?php echo wp_kses( $title, 'post' ); ?>
			</a>
			<?php else: ?>
				<?php echo wp_kses( $title, 'post' ); ?>
			<?php endif ?>
		</<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>