<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="page-content">
			<?php
				amiso_get_blog_single_post_thumbnail();
			?>
			<?php
				/**
				* amiso_before_page_content hook.
				*
				*/
				do_action( 'amiso_before_page_content' );
			?>
			<?php
				the_content();
			?>
			<?php
				/**
				* amiso_after_page_content hook.
				*
				*/
				do_action( 'amiso_after_page_content' );
			?>

			<?php amiso_get_post_wp_link_pages(); ?>

			<?php
				if( amiso_get_redux_option( 'page-settings-show-share' ) ) {
					amiso_get_social_share_links();
				}
			?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php
	if( $page_show_comments ) {
		amiso_show_comments();
	}
?>
