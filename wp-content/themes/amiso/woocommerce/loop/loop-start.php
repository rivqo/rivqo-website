<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_layout_mode = amiso_get_redux_option( 'shop-layout-settings-select-shop-layout-mode', 'masonry' );
$products_per_row = amiso_get_redux_option( 'shop-archive-settings-products-per-row', 4 );
$holder_id = amiso_get_shop_isotope_holder_ID();

$products_per_row = apply_filters( 'amiso_shop_gallery_isotope_products_per_row_filter', $products_per_row );
?>
<div class="clearfix"></div>
<!-- Products Masonry -->
<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout shop-archive <?php echo esc_attr( $shop_layout_mode ); ?> grid-<?php echo esc_attr( $products_per_row ); ?> products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
	<div class="isotope-layout-inner">
		<?php if( $shop_layout_mode == 'masonry' ) { ?>
        <div class="isotope-item isotope-item-sizer"></div>
        <?php } ?>