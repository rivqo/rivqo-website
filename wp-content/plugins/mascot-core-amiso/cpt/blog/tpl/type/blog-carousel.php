<?php $settings['post_format'] = get_post_format(get_the_ID()) ? : 'standard'; $settings['settings'] = $settings; ?>
<?php amiso_enqueue_script_owl_carousel(); ?>
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-blog tm-sc-blog-carousel <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php include('filter-carousel.php'); ?>

		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="owl-carousel owl-theme tm-owl-carousel-<?php echo esc_attr( $columns );?>col <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" <?php echo html_entity_decode( esc_attr( implode(' ', $owl_carousel_data_info) ) ) ?>>

			<!-- the loop -->
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php include('filter-term-list-each-post.php'); ?>
			<div class="tm-carousel-item <?php echo esc_attr( $term_slugs_list_string );?>">
				<?php
					echo mascot_core_amiso_shortcode_get_blog_post_format( get_post_format(), $settings );
				?>
			</div>
			<?php endwhile; ?>
			<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>