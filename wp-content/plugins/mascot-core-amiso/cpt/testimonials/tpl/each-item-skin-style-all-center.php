<div <?php post_class( 'testimonial-skin-style-all-center' ); ?>>
	<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) : ?>
		<div class="author-thumb">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-thumbnail rounded-circle' ) );?>
		</div>
	<?php endif; ?>
	<?php if ( $show_testimonial_text == 'yes' ) : ?>
		<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'author-text', null, 'testimonials/tpl', $params, false ); ?>
	<?php endif; ?>
	<?php if ( $show_rating == 'yes' ) : ?>
		<?php include( 'star-rating.php' ); ?>
	<?php endif; ?>
	<div class="author-info clearfix">
		<?php if ( $show_author_name == 'yes' ) : ?>
			<<?php echo esc_attr( $author_name_tag );?> class="name"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_name' ) );?>,</<?php echo esc_attr( $author_name_tag );?>>
		<?php endif; ?>
		<?php if ( $show_author_job_position == 'yes' ) : ?>
			<h6 class="job-position"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_job_position' ) );?></h6>
		<?php endif; ?>
	</div>
</div>