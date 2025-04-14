<?php $settings['post_format'] = get_post_format(get_the_ID()) ? : 'standard'; $settings['settings'] = $settings; ?>
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-blog tm-sc-blog-basic <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php
			echo mascot_core_amiso_shortcode_get_blog_post_format( get_post_format(), $settings );
		?>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>


<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>