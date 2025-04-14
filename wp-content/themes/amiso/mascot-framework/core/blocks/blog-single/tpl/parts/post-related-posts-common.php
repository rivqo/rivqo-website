
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<?php amiso_get_post_thumbnail( get_post_format() ); ?>
		</div>
		<div class="entry-content">
			<?php the_title( '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h6>' ); ?>
			<?php if ( is_singular( 'post' ) ) { ?>
			<div class="entry-meta"><?php amiso_posted_on(); ?></div>
			<?php } ?>
			<?php if ( $related_posts_show_excerpt ) { ?>
			<div class="post-excerpt">
				<?php amiso_related_posts_get_excerpt(); ?>
			</div>
			<?php } ?>
			<?php //echo amiso_blog_single_related_posts_read_more_link(); ?>
			<div class="clearfix"></div>
		</div>
	</article>