
	<div class="related-posts">
		<?php if ( $related_posts_query_result->have_posts() ): ?>
		<h4 class="title"><?php esc_html_e('Related Posts', 'amiso' ); ?></h4>
		<div class="row">
			<?php
				// Start the Loop.
				while ( $related_posts_query_result->have_posts() ): $related_posts_query_result->the_post();
				?>
				<div class="col-md-4">
					<?php amiso_get_blocks_template_part( 'post-related-posts-common', null, 'blog-single/tpl/parts', $params ); ?>
				</div>
				<?php
				endwhile;
			?>
		</div>
		<?php endif; wp_reset_postdata();?>
	</div>