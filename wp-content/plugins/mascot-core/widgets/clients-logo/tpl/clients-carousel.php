<?php mascot_core_wp_enqueue_script_owl_carousel(); ?>
<?php if ( $clients_logo_array ) : ?>
	<div class="tm-sc-clients-logo clients-carousel <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<div class="owl-carousel owl-theme tm-owl-carousel-<?php echo esc_attr( $sliders_per_view );?>col" <?php echo html_entity_decode( esc_attr( implode(' ', $owl_carousel_data_info) ) ) ?>>
			<!-- the loop -->
			<?php foreach (  $clients_logo_array as $clients_logo ) { ?>
			<div class="slide-owl-wrap">
				<?php include( 'common.php' ); ?>
			</div>
			<?php } ?>
			<!-- end of the loop -->
		</div>
	</div>
<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>