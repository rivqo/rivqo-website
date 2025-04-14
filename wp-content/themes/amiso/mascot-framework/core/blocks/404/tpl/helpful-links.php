<div class="helpful-links">
	<h5 class="heading"><?php echo esc_html( $helpful_links_heading ); ?></h5>
	<?php
	if ( has_nav_menu( $helpful_links_nav ) ) {
		$defaults = array(
			'theme_location'  => $helpful_links_nav,
			'menu'			=> '',
			'container'		=> 'false',
			'menu_class'	=> 'page-404-helpful-links-nav',
			'menu_id'		=> '',
			'echo'			=> true,
			'before'		=> '',
			'after'			=> '',
			'link_before'	=> '',
			'link_after'	=> '',
			'depth'			=> 0,
			'walker'		=> class_exists( 'Mascot_Theme_Nav_Walker' ) ? new Mascot_Theme_Nav_Walker : ''
		);

		if( !empty( $helpful_links_nav ) || $helpful_links_nav != '' ) {
			wp_nav_menu( $defaults );
		}

	} else {
		echo '<p>' . sprintf( esc_html__( 'Please Create a Menu from %1$shere%2$s and set it\'s Display Location to %3$sPage 404 Helpful Links%4$s', 'amiso' ), '<a target="_blank" href="' . esc_url( admin_url('nav-menus.php') ) . '">', '</a>', '<strong>', '</strong>') . '</p>';
	}
	?>
</div>