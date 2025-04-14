
			<div class="pricing-table-title-area">
				<?php if ( $title ) { ?>
				<?php mascot_core_get_shortcode_template_part( 'title', null, 'pricing-table/tpl', $settings, false );?>
				<?php } ?>
				<?php if ( $sub_title ) { ?>
				<?php mascot_core_get_shortcode_template_part( 'subtitle', null, 'pricing-table/tpl', $settings, false );?>
				<?php } ?>
			</div>