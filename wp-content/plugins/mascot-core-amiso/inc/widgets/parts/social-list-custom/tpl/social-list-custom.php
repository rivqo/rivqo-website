<ul class="tm-widget tm-widget-social-list tm-widget-social-list-custom styled-icons <?php echo esc_attr( $icon_size );?> <?php echo esc_attr( $icon_color );?> <?php if( isset($icon_border_style) ) { echo 'icon-bordered'; }?> <?php echo esc_attr( $icon_style );?> <?php if( !empty($icon_theme_colored) ) { echo esc_attr( 'icon-theme-colored' . $icon_theme_colored ); }?> <?php echo esc_attr( $custom_css_class );?>">
	<?php 
		for ($i=1; $i <= 15 ; $i++) { 
		$link = 'link_'.$i;
		$link_network = 'link_'.$i.'_network';
		if( !empty( $$link ) ) :
	 ?>
	<li><a class="social-link styled-icons-item" href="<?php echo esc_url( $$link ); ?>" ><i class="fa <?php echo esc_attr( $$link_network ); ?>"></i></a></li>
	<?php endif; } ?>
</ul>