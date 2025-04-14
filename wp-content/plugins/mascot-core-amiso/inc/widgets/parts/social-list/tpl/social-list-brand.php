<?php
	$social_links_color = amiso_social_links_colors();
?>
<ul class="tm-widget tm-widget-social-list tm-widget-social-list-brand styled-icons styled-icons-brand <?php echo esc_attr( $icon_size );?> <?php echo esc_attr( $icon_style );?> <?php echo esc_attr( $custom_css_class );?>">
	<?php
	if( $social_links ): foreach( $social_links as $key => $value ) {
		if( !_empty( amiso_get_redux_option( 'social-links-url-'.$key ) ) ) :
	 ?>
	<li><a class="social-link styled-icons-item" data-tm-bg-color="<?php echo esc_attr( $social_links_color[$key]['color'] );?>" href="<?php echo esc_url( amiso_get_redux_option( 'social-links-url-'.$key ) ); ?>" target="<?php $target = amiso_get_redux_option( 'social-links-open-in-window', '_blank' ); echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
	<?php endif; } endif; ?>
</ul>