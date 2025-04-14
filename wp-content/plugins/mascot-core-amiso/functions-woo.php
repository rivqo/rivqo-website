<?php

if (!function_exists('mascot_core_amiso_woocommerce_get_product_label_stock')) {
    function mascot_core_amiso_woocommerce_get_product_label_stock() {
        /**
         * @var $product WC_Product
         */
        global $product;
        if ($product->get_stock_status() == 'outofstock') {
            echo '<span class="stock-label">' . esc_html__('Out Of Stock', 'mascot-core-amiso') . '</span>';
        }
    }
}
if (!function_exists('mascot_core_amiso_quickview_button')) {
    function mascot_core_amiso_quickview_button() {
        if (function_exists('woosq_init')) {
            echo do_shortcode('[woosq]');
        }
    }
}

if (!function_exists('mascot_core_amiso_compare_button')) {
    function mascot_core_amiso_compare_button() {
        if (function_exists('woosc_init')) {
            echo do_shortcode('[woosc]');
        }
    }
}

if (!function_exists('mascot_core_amiso_wishlist_button')) {
    function mascot_core_amiso_wishlist_button() {
        if (function_exists('woosw_init')) {
            echo do_shortcode('[woosw]');
        }
    }
}

if (!function_exists('mascot_core_amiso_header_search_product_popup')) {
    function mascot_core_amiso_header_search_product_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"></a>
                <?php
                if (class_exists( 'WooCommerce' )) {
                    mascot_core_amiso_product_search("product");
                } else {
                    mascot_core_amiso_product_search();
                }
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('mascot_core_amiso_header_search_popup')) {
    function mascot_core_amiso_header_search_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"></a>
                <?php
                mascot_core_amiso_product_search();
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('mascot_core_amiso_product_search')) {
    /**
     * Display Product Search
     *
     * @return void
     * @uses  mascot_core_amiso_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function mascot_core_amiso_product_search($woo = "default") {
        if (class_exists( 'WooCommerce' )) {
            static $index = 0;
            $index++;
            ?>
            <div class="tm-widget-search-form">
                <form role="search" method="get" class="search-form-default" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>" class="form-control search-field" placeholder="<?php echo esc_attr__('Search products&hellip;', 'mascot-core-amiso'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="search-submit"><i class="lnr lnr-icon-search"></i></button>
                    <?php if($woo == "product") {?>
                    <input type="hidden" name="post_type" value="product">
                    <?php } ?>
                </form>
            </div>
            <?php
        }
    }
}