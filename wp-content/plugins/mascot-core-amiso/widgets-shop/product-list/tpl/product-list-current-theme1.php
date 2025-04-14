<?php $settings['settings'] = $settings; ?>
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-product-list-current-theme1 woocommerce">

		<!-- Isotope Gallery Grid -->
		<ul class="product-list">

			<!-- the loop -->
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php

				$output = '';
				$product_id    = get_the_ID();
				$post          = get_post( $product_id );
				$product_title = get_the_title();

				$product              = new WC_Product( $product_id );
				$attachment_ids       = $product->get_gallery_image_ids();
				$price                = $product->get_price_html();
				$rating               = wc_get_rating_html($product->get_average_rating());
				$product_var          = new WC_Product_Variable( $product_id );
				$available_variations = $product_var->get_available_variations();

				?>
				<li <?php wc_product_class(); ?>>
					<div class="product-block">
						<div class="content-left">
							<div class="image">
								<a href="<?php echo esc_url($product->get_permalink()) ?>">
									<?php $product_img = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), $image_size ); ?>
									<img src="<?php echo esc_url($product_img[0]) ?>" alt="img"/>
								</a>
							</div>
						</div>
						<div class="content-right">
							<?php  echo ( $rating ) ?>
							<h5 class="product-title">
								<a href="<?php echo esc_url($product->get_permalink()) ?>">
									<?php echo esc_html( $product_title ) ?>
								</a>
							</h5>
							<span class="amount">'<?php  echo ( $price ) ?></span>
						</div>
					</div>
				</li>
			<?php endwhile; ?>
			<!-- end of the loop -->
		</ul>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php mascot_core_amiso_no_posts_match_criteria_text(); ?>
<?php endif; ?>