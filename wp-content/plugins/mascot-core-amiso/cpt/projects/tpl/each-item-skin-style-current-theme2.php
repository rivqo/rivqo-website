<div class="projects-current-theme2">
	<div class="inner-box">
		<div class="image-box">
			<div class="image">
				<a href="<?php the_permalink();?>" class="lightbox-image">
					<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
				</a>
			</div>
		</div>
		<div class="content-box">
			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>

			<?php if ( $show_cat == 'yes' ) : ?>
				<ul class="cat-list">
					<?php include('term-list-each-post.php'); ?>
				</ul>
			<?php endif; ?>
			<a href="<?php the_permalink();?>" class="icon"><i class="fa fa-long-arrow-alt-right"></i></a>
		</div>
	</div>
</div>
