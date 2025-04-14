<div class="tm-gallery-item-currenty-style1">
	<div class="tm-gallery-inner">
		<div class="thumb">
		<?php
			$attachment = wp_get_attachment_image_src( $clients_logo['logo']['id'], $featured_image_size );
			$attachment_full = wp_get_attachment_image_src( $clients_logo['logo']['id'], 'full' );

			if( !empty( $attachment ) ) {
				if( $attachment[0] ) {
				}
			?>
				<img class="thumb" src="<?php echo esc_url( $attachment[0] ) ?>" alt="">
			<?php
				if( $attachment[0] ) {
				}

			} else {
				if( $clients_logo['logo']['url'] ) {
				}
			?>
				<img src="<?php echo esc_url( $clients_logo['logo']['url'] ) ?>" alt="">
			<?php
				if( $clients_logo['logo']['url'] ) {
				}

			}
		?>
		</div>

		<?php if( !empty( $attachment ) ) { ?>
    	<a class="btn-more lightgallery-trigger" data-exthumbimage="<?php echo esc_url( $attachment_full[0] ); ?>" title="photo" href="<?php echo esc_url( $attachment_full[0] ); ?>"><i class="fas fa-chevron-up"></i></a>
		<?php } ?>
	</div>
</div>