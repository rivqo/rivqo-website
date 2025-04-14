<?php 
if ( $title_cpt_widget_area ) :
?>
<section class="tm-page-title-elementor">
	<div class="page-title-wrapper">
	<?php 
		//query args
		$args = array(
			'post_type' => 'page-title',
			'p' => $title_cpt_widget_area,
		);
		$the_query = new \WP_Query( $args );
		$params['the_query'] = $the_query;
		if ( $the_query->have_posts() ) : 
			while ( $the_query->have_posts() ) : 
				$the_query->the_post();
				the_content(get_the_ID());
			endwhile;
			wp_reset_postdata();
		endif;
	?>
	</div>
</section>
<?php endif; ?>
