<div class="funfact-icon funfact-thumb">
<?php
	$image = wp_get_attachment_image_src( $image_icon['id'], $image_icon_predefined_image_size);
	if( !empty($image[0]) ) {
?>
<img src="<?php echo esc_url( $image[0] ); ?>" width="<?php echo esc_attr( $image[1] );?>" height="<?php echo esc_attr( $image[2] );?>"
 alt="<?php esc_attr_e( 'Image', 'mascot-core'); ?>">
<?php } ?>
</div>