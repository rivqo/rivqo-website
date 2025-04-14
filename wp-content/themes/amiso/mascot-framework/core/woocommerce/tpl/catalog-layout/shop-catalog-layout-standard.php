<?php

//removed product link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//removed quick_view_button
if (class_exists('YITH_WCQV_Frontend')):
remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
endif;

//add before shop loop item
add_action( 'woocommerce_before_shop_loop_item', 'amiso_catalog_standard_before_shop_loop_item', 11 );
if ( ! function_exists( 'amiso_catalog_standard_before_shop_loop_item' ) ) {
	/**
	 * Add some HTML codes
	 *
	 */
	function amiso_catalog_standard_before_shop_loop_item() {
	?>
	<div class="effect-wrapper">
	<?php
	}
}

//add before shop loop item
add_action( 'woocommerce_before_shop_loop_item', 'amiso_catalog_standard_before_shop_loop_item_two', 13 );
if ( ! function_exists( 'amiso_catalog_standard_before_shop_loop_item_two' ) ) {
	/**
	 * Add some HTML codes
	 *
	 */
	function amiso_catalog_standard_before_shop_loop_item_two() {
		$products_thumb_type = amiso_get_redux_option( 'shop-archive-settings-products-thumb-type', 'image-featured' );
	?>
		<div class="thumb <?php echo esc_attr( $products_thumb_type );?>">
	<?php
	}
}

//add before shop loop item
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 12 );


//add before shop loop item title
add_action( 'woocommerce_before_shop_loop_item_title', 'amiso_catalog_standard_before_shop_loop_item_title', 11 );
if ( ! function_exists( 'amiso_catalog_standard_before_shop_loop_item_title' ) ) {
	/**
	 * Add some HTML codes
	 *
	 */
	function amiso_catalog_standard_before_shop_loop_item_title() {
	?>
		</div>
		<div class="overlay-shade shade-white"></div>
		<div class="text-holder text-holder-top-left">
			<h5 class="woocommerce-loop-product__title product-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
			<span class="product-categories"><?php echo wc_get_product_category_list( get_the_ID() ); ?></span>
			<div><?php woocommerce_template_loop_rating(); ?></div>
			<div><?php woocommerce_template_loop_price(); ?></div>
		</div>
		<div class="text-holder text-holder-bottom-left">
			<?php woocommerce_template_loop_add_to_cart() ?>
		</div>
		<div class="text-holder text-holder-top-right">
			<ul class="yith-plugins list-inline">
			<?php if (class_exists('YITH_WCQV_Frontend')): ?>
				<?php if (get_option('yith-wcqv-enable') == 'yes'): ?>
					<?php
						global $product;
					?>
					<li class="item"><a href="#" class="button yith-wcqv-button product-single-button product-quick-view size-medium" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>" title="<?php echo esc_attr__("Product quick view", 'amiso') ?>"><i class="fa fa-search"></i></a></li>
				<?php endif ?>
			<?php endif ?>
			<?php
			if (defined('YITH_WCWL')){
				?>
				<li class="item"><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?></li>
				<?php
			}
			?>
			</ul>
		</div>
		<div class="text-holder text-holder-bottom-right">
	<?php
	}
}




//add shop loop item title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

//add after shop loop item title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );


//add after shop loop item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'amiso_catalog_standard_after_shop_loop_item', 50 );
if ( ! function_exists( 'amiso_catalog_standard_after_shop_loop_item' ) ) {
	/**
	 * Add some HTML codes
	 *
	 */
	function amiso_catalog_standard_after_shop_loop_item() {
	?>
		</div>
	</div>
	<?php
	}
}
