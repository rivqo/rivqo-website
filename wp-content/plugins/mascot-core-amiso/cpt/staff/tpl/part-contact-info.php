
	<?php if ( $show_contact_info == 'yes' ) : ?>
	<ul class="contact-info">
		<?php if( !_empty( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_address' ) ) ): ?>
		<li class="contact-address"><i class="fa fa-map-marker"></i> <?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_address' ) );?></li>
		<?php endif; ?>

		<?php if( !_empty( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_phone' ) ) ): ?>
		<li class="contact-phone"><a href="tel:<?php echo esc_attr( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_phone' ) );?>"><i class="fa fa-phone"></i> <?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_phone' ) );?></a></li>
		<?php endif; ?>

		<?php if( !_empty( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_fax' ) ) ): ?>
		<li class="contact-fax"><i class="fa fa-fax"></i><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_fax' ) );?></li>
		<?php endif; ?>

		<?php if( !_empty( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_email' ) ) ): ?>
		<li class="contact-email"><a href="mailto:<?php echo esc_attr( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_email' ) );?>"><i class="fa fa-envelope-o"></i> <?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_email' ) );?></a></li>
		<?php endif; ?>
	</ul>
	<?php endif; ?>