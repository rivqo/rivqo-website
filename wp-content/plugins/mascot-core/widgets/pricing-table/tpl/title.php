
			<?php if ( $title ) { ?>
				<<?php echo esc_attr( $title_tag );?> class="pricing-table-title <?php echo esc_attr(implode(' ', $title_classes)); ?>">
					<?php echo ( $title ); ?>
				</<?php echo esc_attr( $title_tag );?>>
			<?php } ?>
