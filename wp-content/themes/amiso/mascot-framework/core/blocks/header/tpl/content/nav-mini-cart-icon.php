<div class="<?php echo esc_attr( $hidden_class ); ?>">
	<div class="woocommerce top-nav-mini-cart-icon-container">
		<div class="top-nav-mini-cart-icon-contents">
			<a class="mini-cart-icon" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'amiso' ); ?>"><i class="<?php echo amiso_get_redux_option( 'header-settings-navigation-menu-cart-icon-code', 'lnr lnr-icon-cart1' ); ?>"></i><span class="items-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'amiso' ), WC()->cart->get_cart_contents_count() ); ?></span> <span class="cart-quick-info"><span class="count"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'amiso' ), WC()->cart->get_cart_contents_count() ); ?> -</span> <?php echo WC()->cart->get_cart_total(); ?></span></a>

			<div class="dropdown-content">
				<div class="widget_shopping_cart">
					<div class="widget_shopping_cart_content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>