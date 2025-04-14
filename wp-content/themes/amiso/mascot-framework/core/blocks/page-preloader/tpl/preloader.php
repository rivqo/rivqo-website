
	<!-- preloader -->
	<div id="preloader" class="three-layer-loaderbg">
		<?php do_action( 'amiso_page_preloader_start' ); ?>
		<div id="spinner">
			<?php amiso_get_page_preloader_type();?>
			<?php amiso_get_page_preloading_text();?>
		</div>


		<?php if ( $page_show_disable_button ) { ?>
			<div id="disable-preloader" class="<?php echo esc_attr( apply_filters( 'amiso_preloader_disable_btn', 'btn btn-theme-colored1 btn-flat btn-sm') ); ?>"><?php echo esc_html( $page_show_disable_button_text );?></div>
		<?php } ?>
		<?php do_action( 'amiso_page_preloader_end' ); ?>
		<div class="layer"><span class="overlay"></span></div>
	</div>