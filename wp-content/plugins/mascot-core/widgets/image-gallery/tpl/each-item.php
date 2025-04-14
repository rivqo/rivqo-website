<div class="tm-gallery-item">
	<div class="tm-gallery-inner">
		<?php
			$attachment = wp_get_attachment_image_src( $clients_logo['logo']['id'], $featured_image_size );
			$attachment_full = wp_get_attachment_image_src( $clients_logo['logo']['id'], 'full' );

			if( !empty( $attachment ) ) {
				if( $attachment[0] ) {
					echo '<a class="lightgallery-trigger" data-exthumbimage="' . esc_url( $attachment_full[0] ) . '" data-src="' . esc_url( $attachment_full[0] ) . '" href="' . esc_url( $attachment_full[0] ) . '">';
				}
				echo '<img class="thumb" src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
				if( $attachment[0] ) {
					echo '</a>';
				}

			} else {
				if( $clients_logo['logo']['url'] ) {
					echo '<a class="lightgallery-trigger" data-exthumbimage="' . esc_url( $clients_logo['logo']['url'] ) . '" data-src="' . esc_url( $clients_logo['logo']['url'] ) . '" href="' . esc_url( $clients_logo['logo']['url'] ) . '"></a>';
				}
				echo '<img class="thumb" src=" ' . esc_url( $clients_logo['logo']['url'] ) . ' " alt="">';
				if( $clients_logo['logo']['url'] ) {
					echo '</a>';
				}

			}
		?>
	</div>
</div>