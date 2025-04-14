<ul class="tm-widget tm-widget-social-list styled-icons <?php echo esc_attr( $icon_size );?> <?php echo esc_attr( $icon_color );?> <?php if( isset($icon_border_style) && $icon_border_style == 'on' ) { echo esc_attr( 'icon-bordered' ); }?> <?php echo esc_attr( $icon_style );?> <?php if( !empty($icon_theme_colored) ) { echo esc_attr( 'icon-theme-colored' . $icon_theme_colored ); }?> <?php echo esc_attr( $custom_css_class );?>">
	<?php
	if( $social_links ): foreach( $social_links as $key => $value ) {
		if( !_empty( amiso_get_redux_option( 'social-links-url-'.$key ) ) ) :
	 ?>
	<li><a class="social-link styled-icons-item" href="<?php echo esc_url( amiso_get_redux_option( 'social-links-url-'.$key ) ); ?>" target="<?php $target = amiso_get_redux_option( 'social-links-open-in-window', '_blank' ); echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
	<?php endif; } endif; ?>
</ul>