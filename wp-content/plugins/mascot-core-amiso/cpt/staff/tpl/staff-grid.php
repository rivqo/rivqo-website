
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-staff tm-sc-staff-grid <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php include('filter.php'); ?>

		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">

        <!-- the loop -->
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php include('filter-term-list-each-post.php'); ?>
        <div class="isotope-item <?php echo esc_attr( $term_slugs_list_string );?>">
            <?php mascot_core_amiso_get_cpt_shortcode_template_part( 'each-item', $_skin, 'staff/tpl', $params, false ); ?>
        </div>
        <?php endwhile; ?>
        <!-- end of the loop -->
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>