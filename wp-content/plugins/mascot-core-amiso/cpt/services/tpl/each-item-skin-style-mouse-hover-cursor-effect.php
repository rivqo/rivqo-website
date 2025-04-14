<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-services service-mouse-hover-cursor-effect <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php
				$post_thumb = get_the_post_thumbnail_url(get_the_ID(), $feature_thumb_image_size);
			?>
			<div class="each-service" <?php if(!empty($post_thumb)) { ?> data-mouse-helper="hover" data-mouse-helper-mode="normal" data-mouse-helper-image="<?php echo esc_url($post_thumb); ?>" <?php } ?>>
				<div class="service-inner">
					<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'title', null, 'services/tpl', $params, false ); ?>
					<?php if ( $show_view_details_button == 'yes' ) : ?>
					<a href="<?php the_permalink();?>"
					class="service-btn">
						<i class="fas fa-long-arrow-alt-right"></i>
					</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>
		<!-- end of the loop -->
		<?php wp_reset_postdata(); ?>
	</div>


<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>

