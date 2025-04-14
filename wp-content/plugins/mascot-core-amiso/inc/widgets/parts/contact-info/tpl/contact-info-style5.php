<div class="tm-widget tm-widget-contact-info contact-info contact-info-style5 <?php echo esc_attr( $custom_css_class );?> <?php if( !empty($icon_theme_colored) ) { echo esc_attr( 'contact-icon-theme-colored' . $icon_theme_colored ); }?>">
	<?php if(!empty($logo)): ?>
	<div class="thumb <?php if( !empty($logo_css_class) ) echo esc_attr( $logo_css_class );?>"><img alt="<?php esc_attr_e( 'Logo', 'mascot-core-amiso' ); ?>" src="<?php echo esc_url( $logo );?>" style="<?php if( !empty($logo_width) ) echo 'width:'. esc_attr( $logo_width ).';';?>"></div>
	<?php endif; ?>

	<?php if(!empty($description)): ?>
	<div class="description"><?php echo wp_kses_post( $description );?></div>
	<?php endif; ?>

	<ul>
		<?php if(!empty($name)): ?>
		<li class="contact-name">
			<div class="icon"><i class="<?php echo esc_attr( $name_fonticon );?>"></i> <?php echo esc_html( $name_label );?></div>
			<div class="text"><?php echo esc_html( $name );?></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($company)): ?>
		<li class="contact-company">
			<div class="icon"><i class="<?php echo esc_attr( $company_fonticon );?>"></i> <?php echo esc_html( $company_label );?></div>
			<div class="text"><?php echo esc_html( $company );?></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($phone)): ?>
		<li class="contact-phone">
			<div class="icon"><i class="<?php echo esc_attr( $phone_fonticon );?>"></i> <?php echo esc_html( $phone_label );?></div>
			<div class="text"><a href="<?php echo esc_url( 'tel:' . $phone );?>"><?php echo esc_html( $phone );?></a></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($fax)): ?>
		<li class="contact-fax">
			<div class="icon"><i class="<?php echo esc_attr( $fax_fonticon );?>"></i> <?php echo esc_html( $fax_label );?></div>
			<div class="text"><?php echo esc_html( $fax );?></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($email)): ?>
		<li class="contact-email">
			<div class="icon"><i class="<?php echo esc_attr( $email_fonticon );?>"></i> <?php echo esc_html( $email_label );?></div>
			<div class="text"><a href="<?php echo esc_url( 'mailto:' . $email );?>"><?php echo esc_html( $email );?></a></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($website)): ?>
		<li class="contact-website">
			<div class="icon"><i class="<?php echo esc_attr( $website_fonticon );?>"></i> <?php echo esc_html( $website_label );?></div>
			<div class="text"><a target="_blank" href="<?php echo esc_url( $website );?>"><?php echo esc_html( $website );?></a></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($skype)): ?>
		<li class="contact-skype">
			<div class="icon"><i class="<?php echo esc_attr( $skype_fonticon );?>"></i> <?php echo esc_html( $skype_label );?></div>
			<div class="text"><?php echo esc_html( $skype );?></div>
		</li>
		<?php endif; ?>

		<?php if(!empty($address)): ?>
		<li class="contact-address">
			<div class="icon"><i class="<?php echo esc_attr( $address_fonticon );?>"></i> <?php echo esc_html( $address_label );?></div>
			<div class="text"><?php echo esc_html( $address );?></div>
		</li>
		<?php endif; ?>
	</ul>
</div>