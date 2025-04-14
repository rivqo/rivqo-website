<div class="blog-skin-style9">
	<div class="entry-header">
		<?php if ( $show_featured_image == 'yes' ) : ?>
			<div class="post-thumb lightgallery-lightbox">
				<div class="post-thumb-inner">
					<?php amiso_get_post_thumbnail( $post_format, $featured_image_size ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php if ( $show_post_meta == 'yes' ) : ?>
			<?php amiso_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
		<?php endif; ?>
		<?php if ( $show_title == 'yes' ) : ?>
			<?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
		<?php endif; ?>
		<?php if ( $show_excerpt == 'yes' ) : ?>
			<div class="post-excerpt">
				<?php if ( empty($excerpt_length) ) { ?>
					<?php amiso_get_excerpt(); ?>
				<?php } else { ?>
					<?php amiso_get_excerpt($excerpt_length); ?>
				<?php } ?>
			</div>
		<?php endif; ?>
		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'button', null, 'blog/tpl/post-format', $params, false );?>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
</div>
