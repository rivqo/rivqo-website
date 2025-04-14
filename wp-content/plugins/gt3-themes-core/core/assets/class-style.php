<?php

namespace GT3\ThemesCore\Assets;

use Elementor\Plugin as Elementor_Plugin;
use Elementor\Widget_Base;
use ElementorModal\Widgets\GT3_Core_Widget_Base;
use GT3\ThemesCore\Customizer;

class Style extends Asset {
	protected        $sub_folder  = 'css';
	protected        $ext         = 'css';
	protected        $option_name = '';
	protected static $instance    = null;

	protected $schedule_hook = 'gt3-core-clear-css';
	/**
	 * @param Widget_Base $widget
	 *
	 * @return array
	 */
	protected static function get_depends($widget){
		$depts = array();
		if(is_object($widget) && ($widget instanceof GT3_Core_Widget_Base)) {
			if(method_exists($widget, 'get_main_script_depends')) {
				$depts = array_merge($depts, $widget->get_main_script_depends());
			} else if(method_exists($widget, 'get_style_depends')) {
				$depts = array_merge($depts, $widget->get_style_depends());
			}
		}

		return $depts;
	}

	protected static function enqueue_wp_asset($handle, $url = '', $deps = array(), $ver = false){
		wp_enqueue_style($handle, $url, $deps, $ver);
	}

	public function elements_registered(){
		$this->is_preview  = class_exists('Elementor\Plugin') && (Elementor_Plugin::instance()->preview->is_preview() || Elementor_Plugin::instance()->editor->is_edit_mode());
		
		if (is_admin()) {
			return;
		}
		
		$this->isMinimizedAll = !$this->is_preview && Customizer::instance()->get_option('optimize_merge_all_css');
		$this->isMinimized = !$this->isMinimizedAll && !$this->is_preview && Customizer::instance()->get_option('optimize_css');
	}


	public function process_header(){
		parent::process_header();
		if(!$this->isMinimized) {
			return false;
		}

		$assets = $this->enqueued;
		if(!(is_array($assets) && count($assets))) {
			return false;
		}

		list($hash, $path) = $this->asset_get();

		if(false === $path) {
			$path = $this->upload_dir['path'].$hash.'.'.$this->ext;
			static::save_file($assets, $path, '', '');
		}
		$this->done();
		wp_enqueue_style('gt3-assets-header', $this->upload_dir['url'].$hash.'.'.$this->ext, array(), filemtime($path), 'all');

		return true;
	}

	public function process_footer(){
		parent::process_footer();
		if(!$this->isMinimized) {
			return false;
		}

		$assets = $this->enqueued;
		if(!(is_array($assets) && count($assets))) {
			return false;
		}

		list($hash, $path) = $this->asset_get('footer');

		if(false === $path) {
			$path = $this->upload_dir['path'].$hash.'.'.$this->ext;
			static::save_file($assets, $path, '', '');
		}

		wp_enqueue_style('gt3-assets-footer', $this->upload_dir['url'].$hash.'.'.$this->ext, array(), filemtime($path), 'all');
		$this->done();

		return true;
	}

	protected function process_file($content, $asset){
		$matches = array();
		preg_match_all("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"])(.+?)['\"]?\s*\)/ui", $content, $matches);
		foreach($matches[1] as $a) {
			$content = str_replace(trim($a), $this->path_to_url($a, $asset), $content);
		}

		return $content;
	}


	protected function init(){
		static $started = false;
		if($started) {
			return;
		}

		$started = true;

		parent::init();
		add_action('wp_print_styles', array( $this, 'wp_print_styles' ), 50);
	}

	public function wp_print_styles(){
		global $wp_styles;
		if(!$this->isMinimizedAll) {
			return;
		}

		$this->global_registered = &$wp_styles->registered;
		$this->global_queue      = [];

		$wp_styles->all_deps($wp_styles->queue);

		$hash = [];
		foreach($wp_styles->to_do as $key => $handle) {
			$asset = $this->global_registered[$handle];
			if(empty($asset->src) && key_exists('after', $asset->extra) && count($asset->extra['after'])) {
				$hash[$handle]     = $handle.'-'.md5($key.$handle);
				$wp_styles->done[] = $handle;
				unset($wp_styles->to_do[$key]);
				continue;
			}
			$path = $this->convert_url_to_path($asset->src);
			if(null !== $path) {
				$hash[$handle]     = $handle.'-'.filemtime($path);
				$wp_styles->done[] = $handle;
				unset($wp_styles->to_do[$key]);
			}
		}
		$filename = md5(implode(',-,', $hash));

		if ( is_front_page() && is_home() ) {
			$filename = 'fp_h';
		} elseif ( is_front_page() ) {
			$filename = 'fp';
		} elseif ( is_home() ) {
			$filename = 'h';
		} else {
			$queried_object = get_queried_object();
			if ($queried_object instanceof \WP_Post) {
				$filename = 'p_'.$queried_object->ID;
			} else if ($queried_object instanceof \WP_Term) {
				$filename = 't_'.$queried_object->term_id;
			}
		}

		$hash_file = $this->upload_dir['path'].$filename.'.css';

		if(!file_exists($hash_file)) {
			$fp = fopen($hash_file, 'w+');
			if(!$fp) {
				return;
			}

			foreach($hash as $handle => $ver) {
				$asset = $this->global_registered[$handle];
				$path  = $this->convert_url_to_path($asset->src);

				fwrite($fp, PHP_EOL.'/*-'.$handle.'-*/'.PHP_EOL);

				if(!empty($path) && is_file($path) && is_readable($path)) {
					$FH = fopen($path, "r");

					$args_close = '';
					if(!empty($asset->args) && 'all' !== $asset->args) {
						fputs($fp, '@media '.$asset->args.' {');
						$args_close = '}';
					}

					$line = $this->process_file(fgets($FH), $asset);
					while($line !== false) {
						fputs($fp, $line);
						$line = $this->process_file(fgets($FH), $asset);
					}
					if (!empty($args_close)) {
						fputs($fp, $args_close);
					}
					fclose($FH);
				}

				$output = $wp_styles->get_data($handle, 'after');

				if(!empty($output)) {
					$output = implode("\n", $output);
					fputs($fp, PHP_EOL.'/*inline style - '.$handle.'*/'.PHP_EOL);
					fputs($fp, $output);
				}
			}
			fclose($fp);
		}

		wp_enqueue_style('gt3-combined', $this->abs_path_to_url($hash_file), array(), filemtime($hash_file));

	}

	protected function add_global_asset($asset){
		if(is_string($asset) && key_exists($asset, $this->global_registered)) {
			$asset = $this->global_registered[$asset];
		}
		if(!($asset instanceof \_WP_Dependency)) {
			return;
		}

		if(count($asset->deps)) {
			foreach($asset->deps as $style) {
				if(!key_exists($style, $this->global_registered)) {
					continue;
				}
				$asset = $this->global_registered[$style];
				$this->add_global_asset($asset);
			}
		}
		if(!in_array($style, $this->global_queue)) {
			$this->global_queue[] = $asset->handle;
		}
	}


}
