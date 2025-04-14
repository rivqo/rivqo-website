<?php if( isset( $icon_bg_img ) && !empty( $icon_bg_img ) ) { ?>
<?php $image = wp_get_attachment_image_src( $icon_bg_img['id'], 'full');?>
<div class="counter-icon counter-thumb" style="--counter-current-theme1-icon-bg-image: url('<?php echo esc_url($image[0]);?>');">
<?php } else {?>
<div class="counter-icon counter-thumb">
<?php }?>
<?php
	$image = wp_get_attachment_image_src( $image_icon['id'], 'large');
	if( !empty($image[0]) ) {
?>
<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
<?php } ?>
</div>