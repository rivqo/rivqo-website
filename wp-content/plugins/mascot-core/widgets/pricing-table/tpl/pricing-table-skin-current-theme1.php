<?php $settings['settings'] = $settings;?>
<div class="tm-sc-pricing-table <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-table-skin-current-theme1">
	<div class="pricing-table-inner-wrapper">
		<div class="pricing-table-inner">
			<div class="pricing-table-head">
				<?php mascot_core_get_shortcode_template_part( 'thumb', null, 'pricing-table/tpl', $settings, false );?>
			</div>
			<div class="pricing-table-content">
				<?php mascot_core_get_shortcode_template_part( 'pricing', null, 'pricing-table/tpl', $settings, false );?>
				<?php if ( $title || $sub_title ) { ?>
				<?php mascot_core_get_shortcode_template_part( 'title-area', null, 'pricing-table/tpl', $settings, false );?>
				<?php } ?>
				<?php mascot_core_get_shortcode_template_part( 'content', null, 'pricing-table/tpl', $settings, false );?>

				<?php if ( $show_view_details_button == 'yes' ) : ?>
				<div class="pricing-table-footer">
					<?php mascot_core_get_shortcode_template_part( 'button', null, 'pricing-table/tpl', $settings, false );?>
					<?php mascot_core_get_shortcode_template_part( 'footer-hint-text', null, 'pricing-table/tpl', $settings, false );?>
				</div>
				<?php endif; ?>
			</div>
			<?php if( in_array('has-label', $classes) ) { ?>
				<span class="pricing-table-label"><?php echo esc_html( $label_text ); ?></span>
			<?php } ?>
		</div>
	</div>
</div>