<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'post-single clearfix ' . $enable_drop_caps ) ); ?>>
	<?php if( $show_post_featured_image ) { ?>
	<div class="entry-header">
		<?php do_action( 'amiso_blog_single_entry_header_start' ); ?>
		<?php amiso_get_blog_single_post_thumbnail( $post_format ); ?>
		<?php do_action( 'amiso_blog_single_entry_header_end' ); ?>
	</div>
	<?php } ?>
	<div class="entry-content">
		<?php do_action( 'amiso_blog_single_entry_content_start' ); ?>
		<?php amiso_get_single_post_title(); ?>
		<div class="post-excerpt">
			<?php the_content();?>
			<div class="clearfix"></div>
		</div>
		<?php amiso_get_post_wp_link_pages(); ?>
		<?php amiso_blog_single_post_meta(); ?>
		<?php do_action( 'amiso_blog_single_entry_content_end' ); ?>
	</div>
</article>