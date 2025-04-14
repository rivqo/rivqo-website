

	<?php if( $show_header_nav_row ): ?>
	<?php do_action( 'amiso_before_header_nav' ); ?>
	<div class="header-nav">
		<div class="header-nav-wrapper">
			<div class="menuzord-container header-nav-container <?php echo esc_attr( $header_nav_row_bg_theme_colored ); ?>">
				<div class="<?php echo esc_attr( $header_layout_container_class ); ?> position-relative">
					<div class="row">
						<div class="col">
							<?php
								/**
								* amiso_header_nav_container_start hook.
								*
								*/
								do_action( 'amiso_header_nav_container_start' );
							?>
							<div class="row header-nav-col-row">
								<div class="col-sm-auto align-self-center menuzord-brand-parent">
									<?php
										/**
										* amiso_header_logo hook.
										*
										* @hooked amiso_get_header_logo
										*/
										do_action( 'amiso_header_logo' );
									?>
								</div>
								<div class="col-sm-auto menuzord-mobile-showhide">
									<div id="responsive-showhide-trigger" class="menuzord-primary-nav menuzord menuzord-responsive menuzord-responsive">
										<a href='#' class='showhide'><em></em><em></em><em></em></a>
									</div>
								</div>
								<div class="col-sm-auto <?php echo (is_rtl()) ? esc_attr( 'me-auto' ) : esc_attr( 'ms-auto' );?> pr--0 align-self-center menuzord-primary-nav">
									<nav id="top-primary-nav" class="menuzord-primary-nav menuzord menuzord-responsive menuzord-responsive <?php echo esc_attr( $navigation_color_scheme );?>" data-effect="<?php echo esc_attr( $navigation_primary_effect );?>" data-animation="<?php echo esc_attr( $navigation_css3_animation );?>" data-align="right">
										<a href='#' class='showhide'><em></em><em></em><em></em></a>
									<?php
										/**
										* amiso_header_primary_nav hook.
										*
										* @hooked amiso_get_header_primary_nav
										*/
										do_action( 'amiso_header_primary_nav', 'main-nav' );
									?>
									</nav>
								</div>
								<div class="col-sm-auto pl--0 align-self-center pe-xl-4 menuzord-side-icon-list">
									<div class="list-inline nav-side-icon-list">
									<?php
										/**
										* amiso_header_nav_side_icons hook.
										*
										* @hooked amiso_get_header_search_icon - 10
										* @hooked amiso_get_header_mini_cart_icon - 15
										* @hooked amiso_get_header_side_push_panel_sidebar - 20
										* @hooked amiso_get_header_nav_custom_button - 25
										*/
										do_action( 'amiso_header_nav_side_icons' );
									?>
									</div>
								</div>
							</div>
							<?php
								/**
								* amiso_header_nav_container_end hook.
								*
								*/
								do_action( 'amiso_header_nav_container_end' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php do_action( 'amiso_after_header_nav' ); ?>
	<?php endif; ?>