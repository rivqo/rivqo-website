
	<?php
	/**
	* amiso_before_top_sliders_container hook.
	*
	*/
	do_action( 'amiso_before_top_sliders_container' );
	?>
	<div class="top-sliders-container">
		<?php
			/**
			* amiso_top_sliders_container_start hook.
			*
			*/
			do_action( 'amiso_top_sliders_container_start' );
		?>

		<?php
			echo amiso_get_top_main_slider();
		?>

		<?php
			/**
			* amiso_top_sliders_container_end hook.
			*
			*/
			do_action( 'amiso_top_sliders_container_end' );
		?>
	</div>
	<?php
	/**
	* amiso_after_top_sliders_container hook.
	*
	*/
	do_action( 'amiso_after_top_sliders_container' );
	?>
