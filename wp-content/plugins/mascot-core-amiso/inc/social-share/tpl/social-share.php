
<?php if ( $enabled_social_networks ) : ?>
	<div class="tm-social-share-icons">
		<div class="title"><i class="fa fa-share-alt"></i> <?php echo esc_html( $sharing_heading );?></div>
		<?php
			if( $social_icon_type == 'icon' ) {
				mascot_core_amiso_get_inc_folder_template_part( 'icon', null, 'social-share/tpl', $params );
			} else if ( $social_icon_type == 'text' ) {
				mascot_core_amiso_get_inc_folder_template_part( 'text', null, 'social-share/tpl', $params );
			} else if ( $social_icon_type == 'icon-brand' ) {
				mascot_core_amiso_get_inc_folder_template_part( 'icon-brand', null, 'social-share/tpl', $params );
			}
		?>
	</div>
<?php endif; ?>