<?php 
	//classes_first
	$classes_first = array();
	if( !empty($display_type) ) {
		$classes_first[] = $display_type;
	}
	if( !empty($image_animation_effect) ) {
		$classes_first[] = 'tm-animation '.$image_animation_effect;
	}
	$classes_first[] = $image_wrapper_custom_css_class;
	$classes_first = $classes_first;
?>
<div class="layer-image-wrapper <?php echo esc_attr(implode(' ', $classes_first)); ?> elementor-repeater-item-<?php echo $item['_id']; ?>" style="<?php echo esc_attr($wrapper_inline_css); ?>">
	
	<div class="layer-inner layer-animated-icon <?php echo esc_attr($animation_type); ?>">

		<?php if( isset( $animated_icon['id'] ) && !empty( $animated_icon['id'] ) ): ?>
		<img class="icon" src="<?php $image = wp_get_attachment_image_src( $animated_icon['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core' ); ?>">
		<?php endif; ?>


		<?php if( isset( $animated_icon_hover['id'] ) && !empty( $animated_icon_hover['id'] ) ): ?>
		<img class="icon-hover" src="<?php $image = wp_get_attachment_image_src( $animated_icon_hover['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core' ); ?>">
		<?php endif; ?>
		
	</div>
</div>