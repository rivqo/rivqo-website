<div <?php post_class( 'tm-project' ); ?>>
	<div class="project-skin-style2">
		<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) { ?>
		<div class="thumb">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
			<div class="overlay text-center">
				<a href="<?php the_permalink();?>"><span class="icon text-white"><i class="fas fa-plus"></i></span></a>
			</div>
		</div>
		<?php } ?>
		<div class="details">
			<?php if ( $show_cat == 'yes' ) : ?>
			<ul class="cat-list">
				<?php include('term-list-each-post.php'); ?>
			</ul>
			<?php endif; ?>
			<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
		</div>
	</div>
</div>