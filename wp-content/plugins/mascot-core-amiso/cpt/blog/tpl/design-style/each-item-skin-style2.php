<div class="blog-skin-style2">
	<?php if ( $show_featured_image == 'yes' ) : ?>
		<div class="entry-header">
			<?php amiso_get_post_thumbnail( $post_format, $featured_image_size ); ?>
			<?php if ( $show_post_meta == 'yes' ) : ?>
				<?php
				$post_meta_options_array = explode(',', $post_meta_options);
				if ( in_array( $show_post_meta_over_featured_image, $post_meta_options_array ) ) {
					?>
					<div class="post-single-meta">
						<?php amiso_post_shortcode_single_meta( $show_post_meta_over_featured_image ); ?>
					</div>
					<?php
				}
				?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
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
			<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'button', null, 'blog/tpl/post-format', $settings, false );?>
		<?php endif; ?>
	</div>
</div>