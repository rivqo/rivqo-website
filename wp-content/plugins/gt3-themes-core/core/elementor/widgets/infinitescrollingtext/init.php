<?php

namespace ElementorModal\Widgets;

use Elementor\Widget_Base;

if(!defined('ABSPATH')) {
	exit;
}

if (!class_exists('ElementorModal\Widgets\GT3_Core_Elementor_Widget_InfiniteScrollingText')) {
	class GT3_Core_Elementor_Widget_InfiniteScrollingText extends \ElementorModal\Widgets\GT3_Core_Widget_Base {

		public function get_name(){
			return 'gt3-core-infinite-scrolling-text';
		}

		public function get_title(){
			return esc_html__('Infinite Scrolling Text', 'gt3_themes_core');
		}

		public function get_icon(){
			return 'gt3-core-elementor-icon eicon-text-field';
		}

	}
}











