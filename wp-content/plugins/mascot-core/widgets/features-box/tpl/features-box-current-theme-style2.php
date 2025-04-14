
	<div class="tm-sc-features-box <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php if ( $show_image == 'yes' ) : ?>
		<?php mascot_core_get_shortcode_template_part( 'image', null, 'features-box/tpl', $settings, false );?>
		<?php endif; ?>

		<?php if ( $show_title == 'yes' ) : ?>
		<?php mascot_core_get_shortcode_template_part( 'title', null, 'features-box/tpl', $settings, false );?>
		<?php endif; ?>

		<?php if ( $show_paragraph == 'yes' ) : ?>
		<?php mascot_core_get_shortcode_template_part( 'content', null, 'features-box/tpl', $settings, false );?>
		<?php endif; ?>

		<?php if ( $show_button == 'yes' ) : ?>
		<a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo ( ( $button['target'] == '' ) ? esc_attr( '_self' ) : esc_attr( trim($button['target']) ) ); ?>" class="rdm">
			<span class="d-none">
			<?php
				if( empty( $button_text ) ) {
					echo esc_html( $button['title'] );
				} else {
					echo esc_html( $button_text );
				}
			?>
			</span>
			<i class="fa fa-angle-right"></i>
		</a>
		<?php endif; ?>
	</div>