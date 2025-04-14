<?php $settings['settings'] = $settings;?>
<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style3">
	<div class="pricing-plan-inner-wrapper">
		<div class="pricing-plan-inner">
			<div class="pricing-plan-head">
				<?php mascot_core_amiso_get_shortcode_template_part( 'thumb', null, 'pricing-plan/tpl', $settings, false );?>
			</div>
			<div class="pricing-plan-content">
				<?php if ( $title ) { ?>
				<div class="pricing-plan-title-area">
					<?php mascot_core_amiso_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
				</div>
				<?php } ?>

				<?php mascot_core_amiso_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>

				<?php if ( $sub_title ) { ?>
				<?php mascot_core_amiso_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
				<?php } ?>

				<div class="pricing-plan-footer">
					<?php if ( $show_view_details_button == 'yes' ) : ?>
					<?php mascot_core_amiso_get_shortcode_template_part( 'button', null, 'pricing-plan/tpl', $settings, false );?>
					<?php endif; ?>
					<?php mascot_core_amiso_get_shortcode_template_part( 'footer-hint-text', null, 'pricing-plan/tpl', $settings, false );?>
				</div>


				<?php mascot_core_amiso_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>


			</div>
			<?php if( in_array('has-label', $classes) ) { ?>
				<span class="pricing-plan-label"><?php echo esc_html( $label_text ); ?></span>
			<?php } ?>
		</div>
	</div>
</div>