
	<?php if ( $show_name == 'yes' ) { ?>
	<<?php echo esc_attr( $title_tag );?> class="name">
		<?php if ( $link_title ) { ?>
		<a href="<?php the_permalink();?>"><?php the_title();?></a>
		<?php } else { ?>
		<?php the_title();?>
		<?php } ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php } ?>

	<?php if ( $show_speciality == 'yes' ) : ?>
	<div class="speciality"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "staff_mb_general_info", 'staff_speciality' ) );?></div>
	<?php endif; ?>

	<?php if ( $show_short_bio == 'yes' ) : ?>
	<?php if ( empty($excerpt_length) ) { ?>
		<?php $excerpt = amiso_get_rwmb_group( 'amiso_' . "staff_mb_general_info", 'staff_short_bio' ); ?>
			<?php if ( !empty($excerpt) ) { ?>
				<div class="short-bio">
					<?php echo esc_html( strip_shortcodes( $excerpt ) )?>
				</div>
			<?php } ?>
	<?php } else { ?>
		<?php $excerpt = amiso_get_rwmb_group( 'amiso_' . "staff_mb_general_info", 'staff_short_bio' ); ?>
			<?php if ( !empty($excerpt) ) { ?>
				<div class="short-bio">
					<?php echo esc_html( amiso_slice_excerpt_by_length( strip_shortcodes( $excerpt ), $excerpt_length ) ); ?>
				</div>
			<?php } ?>
		<?php } ?>
	<?php endif; ?>