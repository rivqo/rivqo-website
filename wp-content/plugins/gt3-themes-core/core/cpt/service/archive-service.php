<?php
/**
 * The template for displaying archive pages
 *
 */

get_header();
if ( !post_password_required() ) {

	$layout = gt3_option('page_sidebar_layout');
	$sidebar = gt3_option('page_sidebar_def');
	$column = 12;

	if ( $layout == 'left' || $layout == 'right' ) {
		$column = apply_filters( 'gt3_column_width', 9 );
	}else{
		$sidebar = '';
	}
	$row_class = ' sidebar_'.$layout;


?>


	<div class="container">
		<div class="row<?php echo esc_attr($row_class); ?>">
			<div class="content-container span<?php echo (int)esc_attr($column); ?>">
				<section id='main_content'>
					<?php

					$args = array(
						'post_type' => array( 'service' )
					);
					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) :
						// Start the Loop
						while ( $the_query->have_posts() ) : $the_query->the_post();
							echo '<div class="gt3-service_item">';
					        if ( has_post_thumbnail() ) { ?>
							<div class="gt3-service-img">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							</div>
							<?php }
							echo '<h2 class="blogpost_title"><a href="' . esc_url(get_permalink()) . '">' . wp_kses_post(get_the_title()) . '</a></h2>';

							echo '</div>';
							// End the Loop
						endwhile;
					else:
// If no posts match this query, output this text.
						_e( 'Sorry, no posts matched your criteria.', 'gt3_themes_core' );
					endif;

					wp_reset_postdata();

					?>
				</section>
			</div>
			<?php
			if ($layout == 'left' || $layout == 'right') {
				?><div class="sidebar-container span<?php echo (12 - (int)esc_attr($column)); ?>"><?php
				if (is_active_sidebar( $sidebar )) {
					?><aside class='sidebar'><?php
					dynamic_sidebar( $sidebar );
					?></aside><?php
				}
				?></div><?php // end sidebar-container
			}
			?>
		</div>
	</div>

<?php
} else {
	?>
	<div class="pp_block">
        <div class="container_vertical_wrapper">
            <div class="container a-center pp_container">
                <h1><?php echo esc_html__('Password Protected', 'gt3_themes_core'); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
	</div>
<?php
}
get_footer();
?>
