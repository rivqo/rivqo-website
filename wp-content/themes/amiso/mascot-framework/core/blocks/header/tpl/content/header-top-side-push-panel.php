<div class="element">
	<div id="side-panel-trigger" class="side-panel-trigger">
		<a href="#">
			<div class="hamburger-box">
				<div class="hamburger-inner"></div>
			</div>
		</a>
	</div>
	<div class="side-panel-body-overlay"></div>
	<div id="side-panel-container" class="dark">
		<div class="side-panel-wrap">
			<div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="fa fa-times side-panel-trigger-icon"></i></a></div>
			<?php if ( is_active_sidebar( 'header-side-push-panel-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'header-side-push-panel-sidebar' ); ?>
			<?php else: ?>
			<h4><?php esc_html_e( 'This is your Side Push Panel Sidebar!', 'amiso' )?></h4>
			<p><?php echo sprintf( esc_html__( 'Please add your sidebar widgets to this section from %1$sAppearance > Widgets%2$s (Side Push Panel Sidebar).', 'amiso' ), '<strong>', '</strong>')?></p>
			<?php endif; ?>
		</div>
	</div>
</div>