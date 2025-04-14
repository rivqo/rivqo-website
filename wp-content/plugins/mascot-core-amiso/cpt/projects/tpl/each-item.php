<div <?php post_class( 'tm-project' ); ?>>
	<div class="project-skin-style1">
		<div class="project-block">
			<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) { ?>
				<div class="thumb">
					<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
				</div>
			<?php } ?>
			<div class="content">
				<?php if ( $show_cat == 'yes' ) : ?>
				<ul class="cat-list">
					<?php include('term-list-each-post.php'); ?>
				</ul>
				<?php endif; ?>
				<?php if ( $show_title == 'yes' ) : ?>
					<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
				<?php endif; ?>
				<?php if ( $show_excerpt == 'yes' ) : ?>
					<?php if ( empty($excerpt_length) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
						</div>
					<?php } else { ?>
						<div class="excerpt">
							<?php $excerpt = get_the_excerpt(); echo esc_html( amiso_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
						</div>
					<?php } ?>
				<?php endif; ?>
				<a class="btn-link" href="#">
					<i class="fas fa-chevron-up"></i>
				</a>
			</div>
		</div>
	</div>
</div>

