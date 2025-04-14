
		<div class="col-xl-auto header-top-left align-self-center text-center text-xl-<?php echo esc_attr( $header_top_column1_text_alignment );?> <?php echo esc_attr( $header_top_left_col_typography ); ?>">
			<?php
				amiso_get_header_top_column1_content();
			?>
		</div>
		<div class="col-xl-auto <?php echo (is_rtl()) ? esc_attr( 'me-xl-auto' ) : esc_attr( 'ms-xl-auto' );?> header-top-right align-self-center text-center text-xl-<?php echo esc_attr( $header_top_column2_text_alignment );?> <?php echo esc_attr( $header_top_right_col_typography ); ?>">
			<?php
				amiso_get_header_top_column2_content();
			?>
		</div>