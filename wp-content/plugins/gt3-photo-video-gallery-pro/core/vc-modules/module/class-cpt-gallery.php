<?php

namespace GT3\PhotoVideoGalleryPro\VC_modules\Module;
defined('ABSPATH') OR exit;

use GT3_Post_Type_Gallery;
use GT3\PhotoVideoGalleryPro\Settings;

class CPT_Gallery extends Basic {
	protected $SHORTCODE = 'gt3pg_gallery';
	protected $name = 'cpt_gallery';

	public function map(){
//		$settings = Settings::instance()->getDefaultsSettings();
//		$basic    = $settings['basic'];
//		$module   = $settings[$this->name];

		return array(
			'name'        => esc_html__('CPT Gallery', 'gt3pg_pro'),
			"category"    => esc_html__('GT3 Galleries', 'gt3pg_pro'),
			'description' => esc_html__('CPT Gallery', 'gt3pg_pro'),
			'base'        => $this->SHORTCODE,
			'icon'        => 'gt3-editor-icon gt3_icon_'.$this->name,
			'params'      => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Select Gallery', 'gt3pg_pro'),
					'param_name' => 'gallery',
					'std'        => '',
					"value"      => array_merge(array(
						esc_html__('Select Gallery') => ''
					), array_flip(GT3_Post_Type_Gallery::get_galleries())),
				),
			),
		);
	}

	protected function render($atts){
		/* @var \GT3_Post_Type_Gallery $gallery */
		$gallery = GT3_Post_Type_Gallery::instance();

		$gallery_id = $atts['gallery'];

		if (empty($gallery_id) || is_null(get_post($gallery_id))) {
			return;
		}

		$atts    = array_merge($atts, array(
			'_uid'       => mt_rand(9999, 99999),
			'_blockName' => $this->name,
			'className'  => '',
			'blockAlignment' => '',
			'id' => $gallery_id
		));

		echo $gallery->render_shortcode($atts);
	}
}

