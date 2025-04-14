<?php if ( $gallery_images_array ) : ?>
	<div class="tm-sc-gallery tm-sc-gallery-masonry <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns );?> <?php echo esc_attr( $gutter );?> lightgallery-lightbox">
			<div class="isotope-layout-inner">
				<div class="isotope-item isotope-item-sizer"></div>

				<!-- the loop -->
				<?php foreach (  $gallery_images_array as $clients_logo ) { $settings['clients_logo'] = $clients_logo;?>
				<!-- Isotope Item Start -->
				<div class="isotope-item">
					<div class="isotope-item-inner">
						<?php mascot_core_get_shortcode_template_part( 'each-item', $_skin, 'image-gallery/tpl', $settings, false ); ?>
					</div>
				</div>
				<!-- Isotope Item End -->
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>
		<!-- End Isotope Gallery Grid -->
	</div>
<?php endif; ?>