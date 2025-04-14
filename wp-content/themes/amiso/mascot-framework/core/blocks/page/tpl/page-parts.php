<?php
	/**
	* amiso_before_page_section hook.
	*
	*/
	do_action( 'amiso_before_page_section' );
?>
<section class="main-content-section-wrapper">
	<div class="<?php echo esc_attr( $container_type ); ?>">
		<?php
			/**
			* amiso_page_container_start hook.
			*
			*/
			do_action( 'amiso_page_container_start' );
		?>

		<?php
			if ( have_posts() ) :
			// Start the Loop.
			while ( have_posts() ) : the_post();
				amiso_get_page_sidebar_layout( $page_layout );
			endwhile;
			endif;
		?>

		<?php
			/**
			* amiso_page_container_end hook.
			*
			*/
			do_action( 'amiso_page_container_end' );
		?>
	</div>
</section>
<?php
	/**
	* amiso_after_page_section hook.
	*
	*/
	do_action( 'amiso_after_page_section' );
?>