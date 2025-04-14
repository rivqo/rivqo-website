<a href="#fullpage-nav" class="fullpage-nav-toggle"> <span>Toggle menu</span> </a>


<nav id="fullpage-nav" class="panel" role="navigation">
	<div class="fullpage-nav-inner">
		<div class="fullpage-nav-menu">
			<?php
				/**
				* mascot_core_header_primary_nav hook.
				*
				* @hooked mascot_core_get_header_primary_nav
				*/
				//do_action( 'mascot_core_header_primary_nav', 'main-nav' );
				wp_nav_menu(
					array(
						'theme_location'	=> 'primary',
						'menu_class'		=> 'header-mobile-nav-floating',
						'menu_id'			=> 'main-nav', 
						'container'			=> '',
						'link_before'		=> '<span>',
						'link_after'		=> '</span>',
						'walker'			=> new Mascot_Theme_Nav_Walker
					)
				);
			?>
		</div>
		<div class="menufullpage-nav-sidebar">
			<div class="menufullpage-nav-sidebar-inner">
				<?php if ( is_active_sidebar( 'header-menufullpage-nav-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'header-menufullpage-nav-sidebar' ); ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</nav>