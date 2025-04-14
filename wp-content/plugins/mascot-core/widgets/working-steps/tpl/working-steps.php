<?php $item['item'] = $item;?>
<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="working-steps-item-inner">
		<div class="image-holder-wrapper">
			<div class="image-holder">
				<div class="image-holder-inner">
					<?php if( $icon_type == 'image' && isset( $image ) && !empty( $image ) ): ?>
					<?php
						$attachment = wp_get_attachment_image_src( $image['id'], $image_size );

						if( !empty( $attachment ) ) {
							if( $attachment[0] ) {
							}
						?>
							<img src="<?php echo esc_url( $attachment[0] ) ?>" alt="<?php esc_attr_e( 'Image', 'mascot-core' ); ?>">
						<?php
							if( $attachment[0] ) {
							}

						} else {
							if( $image['url'] ) {
							}
						?>
							<img src="<?php echo esc_url( $image['url'] ) ?>" alt="">
						<?php
							if( $image['url'] ) {
							}

						}
					?>
					<?php endif; ?>
					<?php if( isset( $icon_type ) && $icon_type == 'text' ): ?>
					<div class="text-img"><?php echo esc_attr( $text_img );?></div>
					<?php endif; ?>
					<?php if( isset( $icon_type ) && $icon_type == 'flaticon' ): ?>
					<div class="text-flaticon elementor-icon"><?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?></div>
					<?php endif; ?>
				</div>
				<?php if(!empty($tag)) : ?>
				<div class="tag"><?php echo esc_html($tag); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php if(!empty($title) || !empty($text)) : ?>
		<div class="content-holder">
			<?php if(!empty($title)) : ?>
				<div class="title-holder">
					<?php mascot_core_get_shortcode_template_part( 'title', null, 'working-steps/tpl', $item, false );?>
				</div>
			<?php endif; ?>


			<?php if ( $show_paragraph == 'yes' ) { ?>
			<?php if(!empty($text)) : ?>
				<div class="text-holder">
					<?php echo wp_kses( $text, 'post' ); ?>
				</div>
			<?php endif; ?>
			<?php } ?>
		</div>
		<?php endif; ?>
	</div>
	<?php if( isset( $arrow_symbol_img ) && !empty( $arrow_symbol_img ) ): ?>
	<div class="arrow-symbol-img">
		<?php
			$arrow_symbol_img_attachment = wp_get_attachment_image_src( $arrow_symbol_img['id'], 'full' );

			if( !empty( $arrow_symbol_img_attachment ) ) {
			?>
				<img src="<?php echo esc_url( $arrow_symbol_img_attachment[0] ) ?>" alt="<?php esc_attr_e( 'Image', 'mascot-core' ); ?>">
			<?php
			}
		?>
	</div>
	<?php endif; ?>
</div>