<?php
	$rating = esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_rating_value' ) );
	if( is_numeric( $rating ) && $rating > 0) {
		if( $rating > 5 ) {
			$rating = 5;
		}
	} else {
		$rating = 0;
	}
?>
<div class="star-rating">
	<span style="width: <?php echo esc_attr( ( $rating / 5 ) * 100 ); ?>%"></span>
</div>