<?php

namespace GT3\PhotoVideoGalleryPro\Block;

defined('ABSPATH') or exit;

use GT3\PhotoVideoGalleryPro\Help\Types;
use GT3\PhotoVideoGalleryPro\Lazy_Images;

class Carousel extends Isotope_Gallery {
	protected function getDefaultsAttributes(){
		return array_merge(
			parent::getDefaultsAttributes(),

			array(
				'imageSize'         => array(
					'type'    => 'string',
					'default' => 'full',
				),
				'perView'           => array(
					'type'    => 'string',
					'default' => 3,
				),
				'isAutoplay'        => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'autoplay'          => array(
					'type'    => 'string',
					'default' => '3000',
				),
				'gap'               => array(
					'type'    => 'string',
					'default' => '40',
				),
				'centerMode'        => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'animationDuration' => array(
					'type'    => 'string',
					'default' => '300',
				),
				'arrows'            => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'dots'              => array(
					'type'    => 'string',
					'default' => 'default',
				),
			)
		);
	}

	protected $name = 'carousel';

	protected function construct(){
	}

	protected function getCheckTypeSettings(){
		return array_merge(
			parent::getCheckTypeSettings(),
			array(
				'imageSize'         => Types::TYPE_STRING,
				'perView'           => Types::TYPE_INT,
				'perScroll'         => Types::TYPE_INT,
				'isAutoplay'        => Types::TYPE_BOOL,
				'autoplay'          => Types::TYPE_INT,
				'gap'               => Types::TYPE_INT,
				'centerMode'        => Types::TYPE_BOOL,
				'animationDuration' => Types::TYPE_INT,
				'arrows'            => Types::TYPE_BOOL,
				'dots'              => Types::TYPE_BOOL,
			)
		);
	}

	protected function getUnselectedSettings(){
		return array(
			'isMargin'   => 'margin',
		);
	}

	protected function renderItem($image, &$settings){
		$render                  = '';
		$this->active_image_size = $settings['imageSize'];

		$render .= '<span class="carousel__slide">';
		$render .= $this->wp_get_attachment_image($image['id'], $settings['imageSize']);
		$render .= '</span>';

		return $render;
	}

	protected function render($settings){
		$this->checkImagesNoEmpty($settings);
		if(!count($settings['ids'])) {
			return;
		}

		if($settings['imageSize'] === 'thumbnail') {
			$settings['imageSize'] = 'medium_large';
		}

		if(!isset($GLOBALS['gt3pg']) || !is_array($GLOBALS['gt3pg']) ||
		   !isset($GLOBALS['gt3pg']['extension']) || !is_array($GLOBALS['gt3pg']['extension']) ||
		   !isset($GLOBALS['gt3pg']['extension']['pro_optimized'])
		) {
			if($settings['imageSize'] === 'gt3pg_optimized') {
				$settings['imageSize'] = 'large';
			}
		}

		if($settings['rightClick']) {
			$this->add_render_attribute(
				'wrapper', array(
					'oncontextmenu' => 'return false',
					'onselectstart' => 'return false',
				)
			);
		}

		$this->add_render_attribute(
			'wrapper', 'class', array(
				'gallery-'.$this->name,
			)
		);

		$this->data_settings = array(
			'id'              => $this->render_index,
			'uid'             => $this->_id,
			'carouselOptions' => array(
				'perView'           => $settings['perView'],
				'perScroll'         => $settings['perScroll'],
				'isAutoplay'        => $settings['isAutoplay'],
				'autoplay'          => $settings['isAutoplay'] ? $settings['autoplay'] : false,
				'gap'               => $settings['gap'],
				'focusAt'           => $settings['centerMode'] ? 'center' : 0,
				'animationDuration' => $settings['animationDuration'],
				'arrows'            => $settings['arrows'],
				'dots'              => $settings['dots'],
			)
		);

		$items      = '';
		$foreachIds = $settings['ids'];

		$dots  = array();
		$index = 0;
		Lazy_Images::instance()->setup_filters();
		foreach($foreachIds as $id) {

			
			$items .= $this->renderItem($id, $settings);
			if($settings['dots']) {
				$dots[] = '<button class="carousel__bullet"></button>';
			}
		}
		Lazy_Images::instance()->remove_filters();

		
		$this->add_render_attribute('wrapper', 'class', 'gt3_pro-carousel__track');
		?>
		<div class="carousel">
			<div data-carousel-el="track" class="carousel__track">
				<div class="carousel__slides">
					<?php
					echo $items; // XSS Ok
					?>
				</div>
				<?php
				if($settings['arrows']) {
					?>
					<div data-carousel-el="controls" class="carousel__arrows">
						<button class="slider__arrow slider__arrow--prev carousel__arrow carousel__arrow--prev">
							<svg style="width: 30px; height: 30px" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
								<path d="M615.04 800.96L326.048 512l288.992-288.96 33.92 33.92L393.952 512l255.008 255.04z" />
							</svg>
						</button>

						<button class="slider__arrow slider__arrow--next carousel__arrow carousel__arrow--next">
							<svg style="width: 30px; height: 30px" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
								<path d="M408.96 800.96l-33.92-33.92L630.048 512 375.04 256.96l33.92-33.92L697.952 512z" />
							</svg>
						</button>
					</div><?php
				}
				?>
			</div>

			<?php
			if($settings['dots']) {
				echo '<div class="slider__bullets carousel__bullets" data-carousel-el="controls[nav]">
    '.implode('', $dots).'
  </div>';
			}

			?>

		</div>

		<?php
	}
}
