<?php

namespace GT3\PhotoVideoGalleryPro\Block;

defined('ABSPATH') or exit;

use GT3\PhotoVideoGalleryPro\Help\Types;
use GT3_Post_Type_Gallery;
use GT3\PhotoVideoGalleryPro\Lazy_Images;

abstract class Isotope_Gallery extends Basic {
	protected $allowed_mime = array( 'image', 'video' );
	
	protected function getDefaultsAttributes(){
		return array_merge(
			parent::getDefaultsAttributes(),
			$this->getLightboxAttributes(),
			$this->getLoadMoreAttributes(),
			$this->getHoverAttributes(),
			array(
				// Basic
				'borderColor'    => array(
					'type'    => 'string',
					'default' => '#dddddd',
				),
				'borderPadding'  => array(
					'type'    => 'string',
					'default' => '0',
				),
				'borderSize'     => array(
					'type'    => 'string',
					'default' => '1',
				),
				'borderType'     => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'columns'        => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'columnsTablet'  => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'columnsMobile'  => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'cornersType'    => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'isMargin'       => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'margin'         => array(
					'type'    => 'string',
					'default' => '20',
				),
				'linkTo'         => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'lazyLoad'       => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'imageSize'      => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'showTitle'      => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'showCaption'    => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'animationType'  => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'search'         => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'searchAlign'    => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'searchWidth'    => array(
					'type'    => 'string',
					'default' => 'default',
				),
				'isotopeStagger' => array(
					'type'    => 'string',
					'default' => '0',
				),
			)
		);
	}
	
	protected function getHoverAttributes(){
		return array(
			'hoverType'            => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'hoverTextPosition'    => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'hoverTextColor'       => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'hoverBackgroundColor' => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'hoverTextAnimation'   => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'hoverPointer'         => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'hoverIcon'            => array(
				'type'    => 'string',
				'default' => 'default',
			),
		
		);
	}
	
	protected function getLoadMoreAttributes(){
		return array(
			'filterEnable'       => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'filterShowCount'    => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'filterText'         => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'loadMoreEnable'     => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'loadMoreLimit'      => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'loadMoreFirst'      => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'loadMoreButtonText' => array(
				'type'    => 'string',
				'default' => 'default',
			),
		);
	}
	
	protected function getLightboxAttributes(){
		return array(
			'ytWidth'                            => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxAutoplay'                   => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxContinuous'                 => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxAutoplayTime'               => array(
				'type'    => 'string',
				'default' => '6',
			),
			'lightboxThumbnails'                 => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxCover'                      => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxImageSize'                  => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxDeeplink'                   => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxAllowZoom'                  => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'socials'                            => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'allowDownload'                      => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxShowTitle'                  => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxShowCaption'                => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxAnimationType'              => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxCleanStyle'                 => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxVideoAutoplay'              => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxCloseOnSlideClick'          => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxToggleControlsOnSlideClick' => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxCapDesc'                    => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'lightboxTheme'                      => array(
				'type'    => 'string',
				'default' => 'default',
			),
			'externalVideoThumb'                 => array(
				'type'    => 'string',
				'default' => 'default',
			),
		);
	}
	
	protected function getCheckTypeSettings(){
		return array_merge(
			parent::getCheckTypeSettings(),
			array(
				'borderColor'                        => Types::TYPE_STRING,
				'borderPadding'                      => Types::TYPE_INT,
				'borderSize'                         => Types::TYPE_INT,
				'columns'                            => Types::TYPE_INT,
				'isMargin'                           => Types::TYPE_BOOL,
				'margin'                             => Types::TYPE_INT,
				'lazyLoad'                           => Types::TYPE_BOOL,
				'showTitle'                          => Types::TYPE_BOOL,
				'showCaption'                        => Types::TYPE_BOOL,
				'ytWidth'                            => Types::TYPE_BOOL,
				'lightboxAutoplay'                   => Types::TYPE_BOOL,
				'lightboxContinuous'                 => Types::TYPE_BOOL,
				'lightboxAutoplayTime'               => Types::TYPE_INT,
				'lightboxThumbnails'                 => Types::TYPE_BOOL,
				'lightboxCover'                      => Types::TYPE_BOOL,
				'lightboxDeeplink'                   => Types::TYPE_BOOL,
				'lightboxAllowZoom'                  => Types::TYPE_BOOL,
				'lightboxToggleControlsOnSlideClick' => Types::TYPE_BOOL,
				'lightboxCloseOnSlideClick'          => Types::TYPE_BOOL,
				'lightboxVideoAutoplay'              => Types::TYPE_BOOL,
				'lightboxAnimationType'              => Types::TYPE_STRING,
				'lightboxSimpleStyle'                => Types::TYPE_BOOL,
				'socials'                            => Types::TYPE_BOOL,
				'allowDownload'                      => Types::TYPE_BOOL,
				'lightboxShowTitle'                  => Types::TYPE_BOOL,
				'lightboxShowCaption'                => Types::TYPE_BOOL,
				'filterEnable'                       => Types::TYPE_BOOL,
				'filterShowCount'                    => Types::TYPE_BOOL,
				'loadMoreEnable'                     => Types::TYPE_BOOL,
				'loadMoreLimit'                      => Types::TYPE_INT,
				'loadMoreFirst'                      => Types::TYPE_INT,
				'externalVideoThumb'                 => Types::TYPE_BOOL,
				'search'                             => Types::TYPE_BOOL,
				'searchWidth'                        => Types::TYPE_INT,
				'isotopeStagger'                     => Types::TYPE_INT,
			)
		);
	}
	
	protected function getUnselectedSettings(){
		return array(
			'borderType' => array(
				'borderColor',
				'borderPadding',
				'borderSize',
			),
			'isMargin'   => 'margin',
		);
	}
	
	
	protected function construct(){
		//        $this->add_script_depends('imageloaded');
		//        $this->add_script_depends('isotope');
		//        $this->add_script_depends('youtube_api');
		//        $this->add_script_depends('vimeo_api');
		
		//        add_action('wp_ajax_gt3pg_isotope_load_images', array($this, 'ajax_handler'));
		//        add_action('wp_ajax_nopriv_gt3pg_isotope_load_images', array($this, 'ajax_handler'));
	}
	
	/*  public function ajax_handler() {
		   header('Content-Type: application/json');

		   $respond = '';
		   $settings = $_POST;

		$settings                  = $this->checkTypeSettings($settings);
		$settings['lightboxArray'] = array();
		if($settings['lazyLoad'] && $this->name !== 'slider') {
			Lazy_Images::instance()->setup_filters();
		}

		   foreach($settings['images'] as $image) {
			   foreach($image as $k => $v) {
				   $image[$k] = is_array($v) ? $v : stripslashes($v);
			   }

			   $respond .= $this->renderItem($image, $settings);
		   }

		if($settings['lazyLoad'] && $this->name !== 'slider') {
			Lazy_Images::instance()->remove_filters();
		}

		die(wp_json_encode(array(
			'post_count'    => count($settings['images']),
			'respond'       => $respond,
			'lightboxArray' => $settings['lightboxArray'],
		)));
	}
	   }*/
	
	protected function render($settings){
		return;
	}
	
	protected function renderItem($id, &$settings){
		return '';
	}
	
	protected function get_search_form($settings){
		$align = $settings['searchAlign'];
		$width = $settings['searchWidth'];
		$this->add_style(
			'.search-wrapper form.form-search', array(
				'width: %spx' => $width,
			)
		);
		
		?>
		<div class="search-wrapper <?php echo esc_attr($align) ?>">
			<form action="" class="form-search">
				<input type="search" class="search-input" placeholder="<?php echo esc_attr__('Search', 'gt3pg_pro'); ?>">
				<svg enable-background="new 0 0 413.348 413.348" height="512" viewBox="0 0 413.348 413.348" width="512" xmlns="http://www.w3.org/2000/svg">
					<path d="m413.348 24.354-24.354-24.354-182.32 182.32-182.32-182.32-24.354 24.354 182.32 182.32-182.32 182.32 24.354 24.354 182.32-182.32 182.32 182.32 24.354-24.354-182.32-182.32z" />
				</svg>
				<input type="reset" value="<?php echo esc_attr__('Reset', 'gt3pg_pro'); ?>">
			</form>
		</div>
		<?php
	}
	
	protected function renderVideo($image, &$settings){
		if($image['type'] === 'video' || (key_exists('videoOnThumbnails', $settings) && $settings['videoOnThumbnails'] && key_exists('videoLink', $image))) {
			$video_settings = array_merge(array(
				"video_type"   => "hosted",
				"youtube_url"  => "",
				"vimeo_url"    => "",
				"external_url" => "",
				"hosted_url"   => "",
				"hosted_id"    => "",
			), $image['videoLink']);
			
			$image_src = wp_get_attachment_image_url($image['id'], $settings['imageSize']);
			switch($video_settings['video_type']) {
				case 'hosted':
					if(!empty($video_settings['hosted_url'])) {
						return '<video autoplay loop muted playsinline class="video-background" height="'.$image['height'].'" width="'.$image['width'].'">
  <source src="'.$image['videoLink']['hosted_url'].'" type="video/mp4">
</video>';
					}//'<video src="'.$image['videoLink']['hosted_url'].'" loop="1" autoplay="1" muted="1" height="'.$image['height'].'" width="'.$image['width'].'" poster="'.esc_url($image_src).'"></video>';
					break;
				case 'external':
					if(!empty($video_settings['external_url'])) {
						return '<video src="'.$image['videoLink']['external_url'].'" loop="1" autoplay="1" muted="1" height="'.$image['height'].'" width="'.$image['width'].'" poster="'.esc_url($image_src).'"></video>';
					}
					break;
				case 'youtube':
					$video_id = $video_settings['youtube_url'];
					if($video_id) {
						return '<iframe height="'.$image['height'].'" width="'.$image['width'].'"
src="https://www.youtube.com/embed/'.$video_id.'?autoplay=1&mute=1&enablejsapi=1&showinfo=0&controls=0" frameborder="0"
allowfullscreen></iframe>';
					}
					
					break;
			}
		}
		
		return false;
	}
}
