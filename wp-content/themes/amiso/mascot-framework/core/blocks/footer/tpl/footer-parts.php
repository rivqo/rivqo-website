	<!-- Footer -->
	<?php
	/**
	* amiso_before_footer hook.
	*
	*/
	do_action( 'amiso_before_footer' );
	?>
	<footer id="footer" class="footer <?php echo esc_attr( $footer_classes );?>">
	<?php
		/**
		* amiso_footer_start hook.
		*
		*/
		do_action( 'amiso_footer_start' );
	?>
		<div class="footer-widget-area">
			<div class="container">
				<?php if ( isset($footer_widget_area) && !empty($footer_widget_area) && mascot_core_amiso_plugin_installed() ) { ?>
				<div class="row">
					<div class="col-md-12">
					<?php if ( $the_query->have_posts() ) : ?>
						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php the_content(get_the_ID()); ?>
						<?php endwhile; ?>
						<!-- end of the loop -->
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					</div>
				</div>
				<?php } else if ( $footer_enable_default ) { ?>
				<div class="row <?php if ( is_active_sidebar( 'footer-sidebar-top-column-1' ) || is_active_sidebar( 'footer-sidebar-top-column-2' ) || is_active_sidebar( 'footer-sidebar-top-column-3' ) || is_active_sidebar( 'footer-sidebar-top-column-4' ) ) { echo esc_attr( "pt-100 pb-50" );} ?>">
					<?php if ( is_active_sidebar( 'footer-sidebar-top-column-1' ) ) : ?>
					<div class="col-md-6 col-lg-3">
						<?php dynamic_sidebar( 'footer-sidebar-top-column-1' ); ?>
						<div class="clearfix"></div>
					</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-sidebar-top-column-2' ) ) : ?>
					<div class="col-md-6 col-lg-3">
						<?php dynamic_sidebar( 'footer-sidebar-top-column-2' ); ?>
						<div class="clearfix"></div>
					</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-sidebar-top-column-3' ) ) : ?>
					<div class="col-md-6 col-lg-3">
						<?php dynamic_sidebar( 'footer-sidebar-top-column-3' ); ?>
						<div class="clearfix"></div>
					</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-sidebar-top-column-4' ) ) : ?>
					<div class="col-md-6 col-lg-3">
						<?php dynamic_sidebar( 'footer-sidebar-top-column-4' ); ?>
						<div class="clearfix"></div>
					</div>
					<?php endif; ?>
				</div>
				<?php } ?>
			</div>
		</div>
	<?php
		/**
		* amiso_footer_end hook.
		*
		*/
		do_action( 'amiso_footer_end' );
	?>
	</footer>
	<?php
	/**
	* amiso_after_footer hook.
	*
	*/
	do_action( 'amiso_after_footer' );
	?>