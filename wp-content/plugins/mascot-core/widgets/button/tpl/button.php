<div class="tm-sc-button btn-view-details <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<a  href="<?php echo esc_url( $button['url'] ); ?>"
		<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
		<?php echo $nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';?>
		class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">


		<?php if( $add_icon == "yes" && ! empty( $button_icon_left['value'] ) ) { ?>
		<span class="btn-icon"><?php \Elementor\Icons_Manager::render_icon( $button_icon_left ); ?></span>
		<?php }?>

		<span>
		<?php
			if( !empty( $button_text ) ) {
				echo esc_html( $button_text );
			}
		?>
		</span>

		<?php if( $add_icon == "yes" && ! empty( $button_icon_right['value'] ) ) { ?>
		<span class="btn-icon"><?php \Elementor\Icons_Manager::render_icon( $button_icon_right ); ?></span>
		<?php }?>
	</a>
</div>