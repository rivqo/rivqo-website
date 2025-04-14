
	<?php if( isset( $service_icon_array_new[get_the_ID()]['img']['id'] ) && !empty( $service_icon_array_new[get_the_ID()]['img']['id'] ) ): ?>
	<div class="icon icon-img <?php if( isset( $service_icon_array_new[get_the_ID()]['img_hover']['id'] ) && !empty( $service_icon_array_new[get_the_ID()]['img_hover']['id'] ) ) echo "has-thumb-hover" ?>">
		<img class="thumb" src="<?php $image = wp_get_attachment_image_src( $service_icon_array_new[get_the_ID()]['img']['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
		<?php if( isset( $service_icon_array_new[get_the_ID()]['img_hover']['id'] ) && !empty( $service_icon_array_new[get_the_ID()]['img_hover']['id'] ) ) { ?>
		<img class="thumb-hover" src="<?php $image = wp_get_attachment_image_src( $service_icon_array_new[get_the_ID()]['img_hover']['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-amiso'); ?>">
		<?php } ?>
	</div>
	<?php endif; ?>