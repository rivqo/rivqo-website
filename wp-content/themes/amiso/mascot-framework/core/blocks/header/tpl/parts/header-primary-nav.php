<?php
	$menu_class = 'menuzord-menu';
	$one_page_nav_effect = ( $enable_one_page_nav_scrolling_effect ) ? ' onepage-nav' : '';
	$menu_class = $menu_class . $one_page_nav_effect;

	if( $header_layout_type == 'header-mobile-nav' || $header_layout_type == 'header-mobile-nav-floating' ) {
		$one_page_nav_effect = ( $enable_one_page_nav_scrolling_effect ) ? ' fullscreen-onepage-nav' : '';
		$menu_class = $one_page_nav_effect;
	}

	if( $header_layout_type == 'header-side-panel-nav' ) {
		$one_page_nav_effect = ( $enable_one_page_nav_scrolling_effect ) ? ' onepage-nav' : '';
		$menu_class = $one_page_nav_effect;
	}

	if( $custom_primary_nav_menu != '' ) {
		wp_nav_menu(
			array(
				'menu'				=> $custom_primary_nav_menu,
				'menu_class'		=> $menu_class,
				'menu_id'			=> 'main-nav',
				'theme_location'	=> 'primary',
				'container'			=> '',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'walker'			=> class_exists( 'Mascot_Theme_Nav_Walker' ) ? new Mascot_Theme_Nav_Walker : ''
			)
		);
	} else if (has_nav_menu('primary'))  {
		wp_nav_menu(
			array(
				'theme_location'	=> 'primary',
				'menu_class'		=> $menu_class,
				'menu_id'			=> $main_nav_id, 
				'container'			=> '',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'walker'			=> class_exists( 'Mascot_Theme_Nav_Walker' ) ? new Mascot_Theme_Nav_Walker : ''
			)
		);
	}
