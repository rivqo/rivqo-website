							
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumb">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
	</div>
	<?php } ?>