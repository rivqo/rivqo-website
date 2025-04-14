<nav id="top-primary-nav-elementor-<?php echo esc_attr($holder_id)?>" class="menuzord-primary-nav menuzord menuzord-responsive">
<?php
	$menu_class = 'menuzord-menu';

	$current_page_id = amiso_get_page_id();
	$enable_one_page_nav_scrolling_effect = amiso_get_rwmb_group( 'amiso_' . "page_mb_header_settings", 'enable_one_page_nav_scrolling_effect', $current_page_id );
	$one_page_nav_effect = ( $enable_one_page_nav_scrolling_effect ) ? ' onepage-nav' : '';
	$menu_class = $menu_class . $one_page_nav_effect;


	if( $custom_primary_nav_menu != '' ) {
		wp_nav_menu(
			array(
				'menu'				=> $custom_primary_nav_menu,
				'menu_class'		=> $menu_class,
				'menu_id'			=> 'main-nav-' . esc_attr($holder_id),
				'container'			=> '',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'walker'			=> new Mascot_Theme_Nav_Walker
			)
		);
	} else if (has_nav_menu('primary'))  {
		wp_nav_menu(
			array(
				'theme_location'	=> 'primary',
				'menu_class'		=> $menu_class,
				'menu_id'			=> 'main-nav-' . esc_attr($holder_id),
				'container'			=> '',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'walker'			=> new Mascot_Theme_Nav_Walker
			)
		);
	}
?>
</nav>