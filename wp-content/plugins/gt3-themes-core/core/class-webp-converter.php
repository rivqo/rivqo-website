<?php

namespace GT3\ThemesCore;

class Webp_Converter {
	private static $instance = null;
	private static $status     = false;

	private static $allowed_mime = array(
//		IMAGETYPE_GIF,
		IMAGETYPE_JPEG,
		IMAGETYPE_PNG,
		IMAGETYPE_BMP,
		IMAGETYPE_XBM,
	);


	/** @return Webp_Converter */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}


	private function __construct(){

		if (false === self::$status) {
			return;
		}

		add_filter("elementor/extended_allowed_html_tags/image", array( $this, 'allowed_tags' ));
		add_filter('wp_get_attachment_image', array( $this, 'wp_get_attachment_image' ), 10, 5);
	}

	public static function path_to_url($path) {
		$url = str_replace(
			wp_normalize_path(untrailingslashit(ABSPATH)),
			site_url(),
			$path
		);

		return $url;
	}

	public static function url_to_path($url) {
		$path = str_replace(
			site_url(),
			wp_normalize_path(untrailingslashit(ABSPATH)),
			$url
		);

		return $path;
	}

	public function wp_get_attachment_image($html, $attachment_id, $size = 'thumbnail', $icon = false, $attr = ''){
		$image = wp_get_attachment_image_src($attachment_id, $size, $icon);

		if($image) {
			list($src, $width, $height) = $image;

			$src_webp = static::url_to_path($src);

			$path_webp = self::convert($src_webp);

			if (false === $path_webp) {
				return $html;
			}

			$attachment = get_post($attachment_id);
			$hwstring   = image_hwstring($width, $height);
			$size_class = $size;

			if(is_array($size_class)) {
				$size_class = implode('x', $size_class);
			}

			$default_attr = array(
				'src'   => $src,
				'class' => "attachment-$size_class size-$size_class",
				'alt'   => trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true))),
			);

// Add `loading` attribute.
			if(wp_lazy_loading_enabled('img', 'wp_get_attachment_image')) {
				$default_attr['loading'] = 'lazy';
			}

			$attr = wp_parse_args($attr, $default_attr);

// If the default value of `lazy` for the `loading` attribute is overridden
// to omit the attribute for this image, ensure it is not included.
			if(array_key_exists('loading', $attr) && !$attr['loading']) {
				unset($attr['loading']);
			}

// Generate 'srcset' and 'sizes' if not already present.
			if(empty($attr['srcset'])) {
				$image_meta = wp_get_attachment_metadata($attachment_id);

				if(is_array($image_meta)) {
					$size_array = array( absint($width), absint($height) );
					$srcset     = wp_calculate_image_srcset($size_array, $src, $image_meta, $attachment_id);
					$sizes      = wp_calculate_image_sizes($size_array, $src, $image_meta, $attachment_id);

					if($srcset && ($sizes || !empty($attr['sizes']))) {
						$attr['srcset'] = $srcset;

						if(empty($attr['sizes'])) {
							$attr['sizes'] = $sizes;
						}
					}
				}
			}

			/**
			 * Filters the list of attachment image attributes.
			 *
			 * @param string[]     $attr       Array of attribute values for the image markup, keyed by attribute name.
			 *                                 See wp_get_attachment_image().
			 * @param WP_Post      $attachment Image attachment post.
			 * @param string|int[] $size       Requested image size. Can be any registered image size name, or
			 *                                 an array of width and height values in pixels (in that order).
			 *
			 * @since 2.8.0
			 *
			 */
			$attr = apply_filters('wp_get_attachment_image_attributes', $attr, $attachment, $size);

			$attr = array_map('esc_attr', $attr);

			$html = '<picture>';

			if($path_webp && file_exists($path_webp)) {

				$path_webp = str_replace(
					wp_normalize_path(untrailingslashit(ABSPATH)),
					site_url(),
					$path_webp
				);

				$html .= '<source type="image/webp" srcset="'.$path_webp.'">';
			}

			$html .= rtrim("<img $hwstring");

			foreach($attr as $name => $value) {
				$html .= " $name=".'"'.$value.'"';
			}

			$html .= ' />';

			$html .= ' </picture>';
		}

		return $html;
	}

	public function allowed_tags($tags){
		$tag  = array(
			'picture' => array(),
			'source'  => array(
				'type'   => array(),
				'srcset' => array(),
			)
		);
		$tags = array_merge($tags, $tag);

		return $tags;
	}

	static function convert($file, $compression_quality = 80){

		if (false === self::$status) {
			return false;
		}

		$file = self::url_to_path($file);

		// check if file exists
		if(!file_exists($file)) {
			return false;
		}
		$file_type = exif_imagetype($file);

		if (!in_array($file_type, static::$allowed_mime)) {
			return false;
		}
//https://www.php.net/manual/en/function.exif-imagetype.php
//exif_imagetype($file);
// 1    IMAGETYPE_GIF
// 2    IMAGETYPE_JPEG
// 3    IMAGETYPE_PNG
// 6    IMAGETYPE_BMP
// 15   IMAGETYPE_WBMP
// 16   IMAGETYPE_XBM
		$output_file = $file.'.webp';
		if(file_exists($output_file)) {
			return static::path_to_url($output_file);
		}
		if(function_exists('imagewebp')) {
			switch($file_type) {
				case '1': //IMAGETYPE_GIF
					$image = imagecreatefromgif($file);
					break;
				case '2': //IMAGETYPE_JPEG
					$image = imagecreatefromjpeg($file);
					break;
				case '3': //IMAGETYPE_PNG
					$image = imagecreatefrompng($file);
					imagepalettetotruecolor($image);
					imagealphablending($image, true);
					imagesavealpha($image, true);
					break;
				case '6': // IMAGETYPE_BMP
					$image = imagecreatefrombmp($file);
					break;
				case '15': //IMAGETYPE_Webp
					return false;
					break;
				case '16': //IMAGETYPE_XBM
					$image = imagecreatefromxbm($file);
					break;
				default:
					return false;
			}
			// Save the image
			$result = imagewebp($image, $output_file, $compression_quality);
			if(false === $result) {
				return false;
			}
			// Free up memory
			imagedestroy($image);

			$output_file = static::path_to_url($output_file);

			return $output_file;
		} else if(class_exists('Imagick')) {
			$image = new Imagick();
			$image->readImage($file);
			if($file_type === "3") {
				$image->setImageFormat('webp');
				$image->setImageCompressionQuality($compression_quality);
				$image->setOption('webp:lossless', 'true');
			}
			$image->writeImage($output_file);
			$output_file = static::path_to_url($output_file);

			return $output_file;
		}

		return false;
	}
}
