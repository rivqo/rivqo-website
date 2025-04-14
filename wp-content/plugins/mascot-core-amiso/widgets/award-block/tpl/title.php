<?php
	//link url
	$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
	$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="feature-title">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php echo $target;?>
			href="<?php echo esc_url( $url );?>">
			<?php echo $title;?>
		</a>
		<?php else: ?>
			<?php echo $title;?>
		<?php endif ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>