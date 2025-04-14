<?php if ( $the_query->have_posts() ): ?>
<div class="testimonial-block3 testimonial-section-three">
	<div class="row">
			<!-- Content Column -->
			<div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
					<div class="inner-column">
							<!-- Swiper -->
							<div class="swiper-container tm-sc-testimonials testimonial-block-three testimonial-content">
									<div class="swiper-wrapper">
										<!-- the loop -->
										<?php while ( $the_query->have_posts() ): $the_query->the_post();?>
										<!-- Testimonial Block Two -->
										<div class="swiper-slide">
											<div class="inner-box">
												<div class="rating-box">
													<div class="rating">
														<?php if ( $show_rating == 'yes' ) : ?>
															<?php include( 'star-rating.php' ); ?>
														<?php endif; ?>
													</div>
													<span class="avg-review"><?php echo esc_attr( $rating );?> <?php echo esc_html__('Reviews', 'mascot-core-amiso')?></span>
												</div>
												<?php if ( $show_testimonial_text == 'yes' ) : ?>
													<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'author-text', null, 'testimonials/tpl', $params, false ); ?>
												<?php endif; ?>

												<?php if ( $show_author_name == 'yes' ) : ?>
													<<?php echo esc_attr( $author_name_tag );?> class="name"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_name' ) );?></<?php echo esc_attr( $author_name_tag );?>>
												<?php endif; ?>
											</div>
										</div>
										<?php endwhile;?>
										<!-- end of the loop -->
									</div>
							</div>

							<div class="swiper-nav">
								<div class="testi-button-prev"><span class="fas fa-long-arrow-alt-left"></span></div>
								<div class="testi-button-next"><span class="fas fa-long-arrow-alt-right"></span></div>
							</div>
					</div>
			</div>

			<div class="thumbs-column col-lg-6 col-md-12 col-sm-12">
				<div class="inner-column">
					<!-- Testimonial Thumbs -->
					<div class="swiper-container testimonial-thumbs">
						<div class="swiper-wrapper">
							<!-- the loop -->
							<?php while ( $the_query->have_posts() ): $the_query->the_post();?>
								<div class="swiper-slide testimonial-thumb">
									<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ): ?>
										<figure class="image"><?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-thumbnail' ) ); ?></figure>
									<?php endif;?>

								</div>
							<?php endwhile;?>
							<!-- end of the loop -->
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<?php else: ?>
	<?php mascot_core_no_posts_match_criteria_text();?>
<?php endif;?>