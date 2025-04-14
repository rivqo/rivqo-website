<?php $settings['settings'] = $settings;?>
<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-default">
	<div class="pricing-plan-inner-wrapper">
		<div class="pricing-plan-inner">
			<div class="pricing-plan-head">
				<?php mascot_core_amiso_get_shortcode_template_part( 'thumb', null, 'pricing-plan/tpl', $settings, false );?>

				<?php if ( $title || $sub_title ) { ?>
				<?php mascot_core_amiso_get_shortcode_template_part( 'title-area', null, 'pricing-plan/tpl', $settings, false );?>
				<?php } ?>

				<?php mascot_core_amiso_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
			</div>
			<div class="pricing-plan-content">
				<?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>
			</div>

			<?php if ( $show_view_details_button == 'yes' ) : ?>
			<div class="pricing-plan-footer">
				<?php mascot_core_amiso_get_shortcode_template_part( 'button', null, 'pricing-plan/tpl', $settings, false );?>
				<?php mascot_core_amiso_get_shortcode_template_part( 'footer-hint-text', null, 'pricing-plan/tpl', $settings, false );?>
			</div>
			<?php endif; ?>
			<?php if( in_array('has-label', $classes) ) { ?>
				<span class="pricing-plan-label"><?php echo esc_html( $label_text ); ?></span>
			<?php } ?>
		</div>
	</div>
</div>