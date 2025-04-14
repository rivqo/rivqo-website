
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-testimonials tm-sc-testimonials-single-testimonial <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="" <?php echo html_entity_decode( esc_attr( implode(' ', $owl_carousel_data_info) ) ) ?>>
			<!-- the loop -->
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="tm-carousel-item">
				<div <?php post_class( 'tm-testimonial' ); ?>>
					<div class="ceo-quote mb-60">
						<?php if ( $show_testimonial_text == 'yes' ) : ?>
						<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'author-text', null, 'testimonials/tpl', $params, false ); ?>
						<?php endif; ?>
					</div>
					<div class="ceo-thumb-singature d-flex align-items-center">
						<div class="ceo-thumb mr-20">
							<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) : ?>
							<div class="author-thumb">
							<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-thumbnail rounded-circle' ) );?>
							</div>
							<?php endif; ?>
						</div>
						<div class="ceo-signature">
							<?php if ( $show_author_name == 'yes' ) : ?>
							<<?php echo esc_attr( $author_name_tag );?> class="name"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_name' ) );?></<?php echo esc_attr( $author_name_tag );?>>
							<?php endif; ?>

							<?php if ( $show_author_job_position == 'yes' ) : ?>
							<span class="job-position"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_job_position' ) );?></span>
							<?php endif; ?>

							<?php if ( $show_author_company == 'yes' ) : ?>
							<a class="company-url" href="<?php echo esc_url( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_company_URL' ) );?>"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_company' ) );?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>