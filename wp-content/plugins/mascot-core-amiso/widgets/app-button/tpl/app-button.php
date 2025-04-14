<a 
	class="tm-app-btn" 
    <?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
    href="<?php echo esc_url( $url );?>"
    >
	<div class="icon">
		<?php if( isset($icon[ 'value' ]) && !empty( $icon[ 'value' ] ) ){ ?>
			<i class="<?php echo esc_attr( $icon[ 'value' ] );  ?>"></i>
		<?php } ?>
	</div>
	<div class="content">
		<div class="subtitle"><?php echo esc_html( $subtitle );?></div>
		<div class="title"><?php echo esc_html( $title );?></div>
	</div>
</a>