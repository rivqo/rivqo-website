<?php
	/**
	* amiso_before_blog_section hook.
	*
	*/
	do_action( 'amiso_before_blog_section' );
?>
<section>
	<div class="<?php echo esc_attr( $container_type ); ?>">
		<?php
			/**
			* amiso_blog_container_start hook.
			*
			*/
			do_action( 'amiso_blog_container_start' );
		?>

		<div class="blog-posts">
			<?php
				amiso_get_blog_sidebar_layout();
			?>
		</div>

	<?php
		/**
		* amiso_blog_container_end hook.
		*
		*/
		do_action( 'amiso_blog_container_end' );
	?>
	</div>
</section>
<?php
	/**
	* amiso_after_blog_section hook.
	*
	*/
	do_action( 'amiso_after_blog_section' );
?>
