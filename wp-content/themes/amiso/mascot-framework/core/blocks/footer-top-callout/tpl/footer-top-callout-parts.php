<section id="footer-top-callout-wrap">
	<div class="container <?php echo esc_attr( $callout_text_align ); ?>">
		<div class="row footer-top-callout-inner">
			<?php if( $left_font_icon != "" ): ?>
			<div class="col-lg-<?php echo esc_attr( $left_font_icon_position ) == "left" ? "1" : "12" ; ?> icon-<?php echo esc_attr( $left_font_icon_position ); ?> callout-icon">
				<i class="<?php echo esc_attr( $left_font_icon ); ?>"></i>
			</div>
			<?php endif; ?>
			<div class="col-lg-<?php echo esc_attr( $left_font_icon_position ) == "left" ? "11" : "12" ; ?> callout-body <?php echo esc_attr( $button_position ); ?>">
				<div class="row">
					<div class="col-lg-9">
						<div class="callout-content"><?php echo esc_html( $callout_text ); ?></div>
					</div>
					<div class="col-lg-3">
						<?php if( $button_visibility ): ?>
						<div class="callout-button">
							<a target="<?php echo esc_attr( $button_target ); ?>" class="<?php echo esc_attr( apply_filters( 'amiso_footer_top_callout_parts_btn', 'btn btn-theme-colored1') ); ?>" href="<?php echo esc_url( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>