

	<?php if( isset($icon[ 'value' ]) && !empty( $icon[ 'value' ] ) ){ ?>

	<a class="icon"
		<?php if( !empty( $url ) ): ?>
		<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
		href="<?php echo esc_url( $url );?>"
		<?php endif ?>
	>
		<i class="<?php echo esc_attr( $icon[ 'value' ] );  ?>"></i>
	</a>

	<?php } ?>