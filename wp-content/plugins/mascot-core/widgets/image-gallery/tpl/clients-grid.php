<?php if ( $gallery_images_array ) : ?>
	<div class="tm-sc-clients-logo clients-grid <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- the loop -->
		<?php foreach (  $gallery_images_array as $clients_logo ) { ?>
		<?php include( 'common.php' ); ?>
		<?php } ?>
		<!-- end of the loop -->
	</div>
<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>