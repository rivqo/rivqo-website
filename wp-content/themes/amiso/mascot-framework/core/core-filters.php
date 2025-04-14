<?php
/*
*
*	Core Filters
*	---------------------------------------
*	Mascot Framework v1.0
* 	Copyright ThemeMascot 2017 - http://www.thememascot.com
*
*/
function amiso_kses_allowed_html($tags, $context) {
	switch($context) {
		case 'img':
			$tags = array(
				'img' => array(
					'src' => array(),
					'width' => array(),
					'height' => array(),
					'class' => array(),
					'srcset' => array(),
					'sizes' => array(),
					'alt' => array(),
				)
			);
			return $tags;
		case 'link':
			$tags = array(
				'a' => array(
					'class' => array(),
					'href' => array(),
					'rel' => array(),
				),
			);
			return $tags;
		case 'basic':
			$tags = array(
				'strong' => array(
					'class' => array(),
				),
				'a' => array(
					'class' => array(),
					'href' => array(),
					'rel' => array(),
				),
				'p' => array(
					'class' => array(),
				),
			);
			return $tags;
		default:
			return $tags;
	}
}
add_filter( 'wp_kses_allowed_html', 'amiso_kses_allowed_html', 10, 2);