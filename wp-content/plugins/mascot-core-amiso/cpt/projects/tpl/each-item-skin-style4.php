<div <?php post_class( 'tm-project' ); ?>>
	<div class="project-skin-style4">
		<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) { ?>
		<div class="project-thumb">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		</div>
		<?php } ?>
		<div class="project-content">
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
					<?php $excerpt = get_the_excerpt(); ?>
					<?php if ( !empty($excerpt) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
						</div>
					<?php } ?>
				<?php } else { ?>
					<?php $excerpt = get_the_excerpt(); ?>
					<?php if ( !empty($excerpt) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( amiso_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
						</div>
					<?php } ?>
				<?php } ?>
			<?php endif; ?>
			<?php if ( $show_view_details_button == 'yes' ) : ?>
				<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'button', null, 'projects/tpl', $params, false ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>