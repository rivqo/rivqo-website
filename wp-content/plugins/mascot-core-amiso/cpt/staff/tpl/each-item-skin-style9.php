<div <?php post_class( 'team-item' ); ?>>
	<div class="team-item-skin-style9">
		<div class="tm-staff staff-items type-staff-items">
			<div class="staff-inner">
				<div class="thumb-wrapper">
					<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'part-thumb', null, 'staff/tpl', $params, false );?>
					<div class="staff-social-links">
						<?php if ( $show_social_link == 'yes' ) : ?>
							<ul class="<?php echo esc_attr( apply_filters( 'amiso_sc_staff_social_links', 'staff-social-links') ); ?>">
								<?php
								foreach ($social_list_array as $key => $value) {
									$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "staff_mb_social_info", "staff_social_".$key );
									if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) ) {
										?>
										<li><a class="styled-icons-item" target="_blank" href="<?php echo esc_url( $temp_meta_value ) ?>"><i class="fa fa-<?php echo esc_attr( $key ) ?>"></i></a></li>
										<?php
									}
								}
								?>

							</ul>
						<?php endif; ?>
					</div>
				</div>
				<div class="staff-content">
					<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'part-basic-info', null, 'staff/tpl', $params, false );?>
					<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'part-contact-info', null, 'staff/tpl', $params, false );?>
					<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'part-working-hours', null, 'staff/tpl', $params, false );?>
					<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'button', null, 'staff/tpl', $params, false );?>
				</div>
			</div>
		</div>
	</div>
</div>
