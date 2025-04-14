<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .main-content div and #wrapper
 *
 */
?>


	<?php amiso_get_footer_top_callout(); ?>


	<?php
		/**
		 * amiso_main_content_end hook.
		 *
		 */
		do_action( 'amiso_main_content_end' );
	?>
	</div>
	<!-- main-content end -->
	<?php
		/**
		 * amiso_after_main_content hook.
		 *
		 */
		do_action( 'amiso_after_main_content' );
	?>


	<?php if( apply_filters('amiso_filter_show_footer', true) ): ?>
	<?php amiso_get_footer_parts(); ?>
	<?php endif; ?>

	<?php
		/**
		 * amiso_wrapper_end hook.
		 *
		 */
		do_action( 'amiso_wrapper_end' );
	?>
</div>
<!-- wrapper end -->
<?php
	/**
	 * amiso_body_tag_end hook.
	 *
	 */
	do_action( 'amiso_body_tag_end' );
?>
<?php
	/**
	 * nav_search_icon_popup_html hook.
	 *
	 */
	global $nav_search_holder_id;
	do_action( 'amiso_nav_search_icon_popup_html', $nav_search_holder_id );
?>
<?php wp_footer(); ?>
</body>
</html>
