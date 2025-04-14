<?php if( $header_slider_type != 'no-slider' && $header_slider_position == 'above-header' ) : ?>
	<?php amiso_get_blocks_template_part( 'header-parts-top-slider', null, 'header/tpl', $params ); ?>
	<?php if( $params['header_visibility'] ) { ?>
	<?php amiso_get_blocks_template_part( 'header-parts-header', null, 'header/tpl', $params ); ?>
	<?php } ?>
<?php else : ?>
	<?php if( $params['header_visibility'] ) { ?>
	<?php amiso_get_blocks_template_part( 'header-parts-header', null, 'header/tpl', $params ); ?>
	<?php } ?>
	<?php amiso_get_blocks_template_part( 'header-parts-top-slider', null, 'header/tpl', $params ); ?>
<?php endif; ?>