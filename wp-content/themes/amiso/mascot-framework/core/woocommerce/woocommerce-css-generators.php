<?php


if (!function_exists('amiso_shop_archive_settings_gutter_size')) {
	/**
	 * Generate CSS codes for Shop Column Spacing (Gutter Size) px
	 */
	function amiso_shop_archive_settings_gutter_size() {
		global $amiso_redux_theme_opt;
		$var_name = 'shop-archive-settings-gutter-size';
		$declaration = array();
		$selector = array(
			'.isotope-layout.shop-archive .isotope-item'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$column_gutter = $amiso_redux_theme_opt[$var_name];

		$declaration['padding-left'] = $column_gutter . 'px';
		$declaration['padding-right'] = $column_gutter . 'px';
		$declaration['margin-bottom'] = ($column_gutter*2) . 'px';
		amiso_dynamic_css_generator($selector, $declaration);


		$selector = array(
			'.isotope-layout.shop-archive .isotope-layout-inner'
		);
		$declaration = array();
		$declaration['margin-left'] = '-' . $column_gutter . 'px';
		$declaration['margin-right'] = '-' . $column_gutter . 'px';
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_shop_archive_settings_gutter_size');
}


if (!function_exists('amiso_shop_settings_product_price_color')) {
	/**
	 * Generate CSS codes for Product Price Color Color
	 */
	function amiso_shop_settings_product_price_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'woocommerce-styling-product-price-color';
		$declaration = array();
		$selector = array(
			'.woocommerce .product .price'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_shop_settings_product_price_color');
}


if (!function_exists('amiso_shop_settings_product_on_sale_tag_bg_color')) {
	/**
	 * Generate CSS codes for Product On Sale Tag Background Color
	 */
	function amiso_shop_settings_product_on_sale_tag_bg_color() {
		global $amiso_redux_theme_opt;
		$var_name = 'woocommerce-styling-product-on-sale-tag-bg-color';
		$declaration = array();
		$selector = array(
			'.woocommerce .product .onsale'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $amiso_redux_theme_opt ) ) {
			return;
		}

		if( $amiso_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $amiso_redux_theme_opt[$var_name];
		amiso_dynamic_css_generator($selector, $declaration);
	}
	add_action('amiso_dynamic_css_generator_action', 'amiso_shop_settings_product_on_sale_tag_bg_color');
}

