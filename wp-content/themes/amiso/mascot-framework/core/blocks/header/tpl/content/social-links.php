<?php
	if( !empty($social_links_label) ) {
	 ?>
		<span class="styled-icons-label"><?php echo esc_html( $social_links_label ) ?></span>
	<?php
	}
?>
<ul class="element styled-icons <?php echo esc_attr(implode(' ', $social_links_classes)); ?>">
	<?php
	if( $social_links ): foreach( $social_links as $key => $value ) {
		if( !_empty( amiso_get_redux_option( 'social-links-url-'.$key ) ) ) :
	 ?>
	<li><a class="styled-icons-item" href="<?php echo esc_url( amiso_get_redux_option( 'social-links-url-'.$key ) ); ?>" target="<?php $target = amiso_get_redux_option( 'social-links-open-in-window', '_blank' ); echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
	<?php endif; } endif; ?>
</ul>