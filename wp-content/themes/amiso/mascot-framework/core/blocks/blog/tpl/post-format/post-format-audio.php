<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php do_action( 'amiso_blog_post_entry_header_start' ); ?>
		<?php amiso_get_post_thumbnail( $post_format ); ?>
		<?php do_action( 'amiso_blog_post_entry_header_end' ); ?>
	</div>
	<div class="entry-content">
		<?php do_action( 'amiso_blog_post_entry_content_start' ); ?>
		<?php amiso_post_meta(); ?>
		<?php amiso_get_post_title(); ?>
		<div class="post-excerpt">
			<?php amiso_get_excerpt(); ?>
		</div>
		<?php do_action( 'amiso_blog_post_entry_content_end' ); ?>

    <a href="<?php the_permalink();?>" class="read-more"><i class="fa fa-long-arrow-alt-right"></i> <?php echo esc_html__('Read more', 'amiso'); ?></a>
	</div>
	<div class="clearfix"></div>
</article>