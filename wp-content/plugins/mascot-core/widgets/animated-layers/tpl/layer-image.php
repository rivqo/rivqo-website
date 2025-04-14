<?php 
	//classes_first
	$classes_first = array();
	if( !empty($display_type) ) {
		$classes_first[] = $display_type;
	}
	if( !empty($image_animation_effect) ) {
		$classes_first[] = 'tm-animation '.$image_animation_effect;
	}
	$classes_first[] = $main_parent_wrapper_custom_css_class;
	if ( $make_item_fullwidth == 'yes' ) {
		$classes_first[] = 'layer-image-fullwidth';
	}
	$classes_first = $classes_first;


	$classes_layer_image_innner = array();
	if( !empty($image_hover_effect) ) {
		$classes_layer_image_innner[] = 'image-hover-'.$image_hover_effect;
	}
?>

<?php if( isset( $image ) && !empty( $image ) ) { ?>
<div class="layer-image-wrapper <?php echo esc_attr(implode(' ', $classes_first)); ?> elementor-repeater-item-<?php echo $item['_id']; ?>" style="<?php echo esc_attr($wrapper_inline_css); ?>">
	<div class="layer-inner layer-image <?php echo esc_attr($image_parent_custom_css_class); ?> <?php echo esc_attr($animation_type); ?>">
		<div class="layer-image-inner-wrapper <?php echo esc_attr(implode(' ', $classes_layer_image_innner)); ?>">
			<img class="<?php echo esc_attr($image_custom_css_class); ?>" src="<?php $image = wp_get_attachment_image_src( $image['id'], $image_size); echo esc_url( $image[0] );?>" width="<?php echo esc_attr( $image[1] );?>" height="<?php echo esc_attr( $image[2] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core' ); ?>">
		</div>
	</div>
</div>
<?php } ?>
