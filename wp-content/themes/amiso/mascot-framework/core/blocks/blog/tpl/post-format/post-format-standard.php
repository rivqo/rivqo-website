<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if (is_sticky()) {
		echo '<div class="post-sticky-icon" title="' . esc_attr__('Sticky Post', 'amiso') . '"><i class="fas fa-map-pin"></i></div>';
	}
	?>
	<?php if( $show_post_featured_image ) { ?>
		<div class="entry-header">
			<?php do_action( 'amiso_blog_post_entry_header_start' ); ?>
			<?php amiso_get_post_thumbnail( $post_format ); ?>
			<?php do_action( 'amiso_blog_post_entry_header_end' ); ?>
		</div>
	<?php } ?>
	<div class="entry-content">
		<?php do_action( 'amiso_blog_post_entry_content_start' ); ?>
		<?php amiso_post_meta(); ?>
		<?php amiso_get_post_title(); ?>
		<div class="post-excerpt">
			<?php amiso_get_excerpt(); ?>
		</div>

    <a href="<?php the_permalink();?>" class="read-more"><i class="fa fa-long-arrow-alt-right"></i> <?php echo esc_html__('Read more', 'amiso'); ?></a>

		<?php do_action( 'amiso_blog_post_entry_content_end' ); ?>
	</div>
	<div class="clearfix"></div>
</article>