<?php

namespace GT3\ThemesCore\Customizer\Controls;

use GT3\ThemesCore\Assets\Script;
use GT3\ThemesCore\Assets\Style;
use WP_Customize_Control;

class Search_Post_types extends WP_Customize_Control {

	public $type = 'gt3-search-post-types';

	public $choices = array();

	public function to_json(){
		parent::to_json();

//        $post_types = get_post_types([], 'objects');
//        $posts = array();
//        foreach ($post_types as $post_type) {
//            if ($post_type->public) {
//                $posts[] = array(
//                    'id' => $post_type->name,
//                    'text' => $post_type->labels->singular_name.' ('.$post_type->name.')',
//                );
//            }
//        }

		$post_types = array(
			array(
				'id'   => 'post',
				'text' => __('Post'),
			),
			array(
				'id'   => 'page',
				'text' => __('Page'),
			),
			array(
				'id'   => 'portfolio',
				'text' => __('Portfolio'),
			),
		);

		$this->json['value'] = $this->value();
		$this->json['data']  = apply_filters('gt3/core/search/post_types', $post_types);
	}

	public function enqueue(){
		Script::enqueue_core_asset('customizer/search-post-types');
		Style::enqueue_core_asset('customizer/search-post-types');
	}

	protected function content_template(){
		?>
		<span class="customize-control-title">
					{{{ data.label }}}
				</span>
		<# if ( data.description ) { #>
		<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<# if ( data.tooltip ) { #>
		<a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span
					class='dashicons dashicons-info'></span></a>
		<# } #>
		<div class="select2-component-wrapper"></div>
		<?php
	}
}
