
	<?php if ( $show_social_link == 'yes' ) : ?>
	<ul class="<?php echo esc_attr( apply_filters( 'amiso_sc_staff_social_links', 'styled-icons icon-dark icon-theme-colored1 icon-circled icon-sm') ); ?>">
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