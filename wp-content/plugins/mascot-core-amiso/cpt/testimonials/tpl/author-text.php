<div class="author-text">
	<?php $text = amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_text' );?>
	<?php if ( empty($testimonial_text_length) ) { ?>
	<?php echo esc_html( $text )?>
	<?php } else { ?>
	<?php echo esc_html( amiso_slice_excerpt_by_length( $text, $testimonial_text_length ) ); ?>
	<?php } ?>
</div>