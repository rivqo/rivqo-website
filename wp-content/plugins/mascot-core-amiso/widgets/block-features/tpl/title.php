
		<?php if( !empty( $title ) ) : ?>
		<<?php echo esc_attr( $title_tag );?> class="feature-title <?php echo esc_attr(implode(' ', $title_classes)); ?>">
			<?php if( !empty( $url ) ): ?>
			<a 
				<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
				href="<?php echo esc_url( $url );?>">
				<?php echo $title;?>
			</a>
			<?php else: ?>
				<?php echo $title;?>
			<?php endif ?>
		</<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>