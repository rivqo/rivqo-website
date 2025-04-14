	<?php amiso_enqueue_script_owl_carousel(); ?>
	<div class="related-posts">
		<?php if ( $related_posts_query_result->have_posts() ): ?>
		<h4 class="title"><?php esc_html_e('Related Posts', 'amiso' ); ?></h4>
		<div class="owl-carousel owl-theme tm-owl-carousel-3col" data-nav="true">
		<?php
			// Start the Loop.
			while ( $related_posts_query_result->have_posts() ): $related_posts_query_result->the_post();
			?>
			<div class="item">
				<?php amiso_get_blocks_template_part( 'post-related-posts-common', null, 'blog-single/tpl/parts', $params ); ?>
			</div>
			<?php
			endwhile;
		?>
		</div>
		<?php endif; wp_reset_postdata();?>
	</div>