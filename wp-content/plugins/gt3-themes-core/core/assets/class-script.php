<?php

namespace GT3\ThemesCore\Assets;

use Elementor\Plugin as Elementor_Plugin;
use Elementor\Widget_Base;
use ElementorModal\Widgets\GT3_Core_Widget_Base;
use GT3\ThemesCore\Customizer;

class Script extends Asset {
	protected        $sub_folder  = 'js';
	protected        $ext         = 'js';
	protected        $option_name = 'optimize_js';
	protected static $instance    = null;

	protected $schedule_hook = 'gt3-core-clear-js';


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
			} else if(method_exists($widget, 'get_script_depends')) {
				$depts = array_merge($depts, $widget->get_script_depends());
			}
		}

		return $depts;
	}
	
	public function elements_registered(){
		$this->is_preview  = class_exists('Elementor\Plugin') && (Elementor_Plugin::instance()->preview->is_preview() || Elementor_Plugin::instance()->editor->is_edit_mode());
		
		if (is_admin()) {
			return;
		}
		
		$this->isMinimizedAll = !$this->is_preview && Customizer::instance()->get_option('optimize_merge_all_js');
		$this->isMinimized = !$this->isMinimizedAll && !$this->is_preview && Customizer::instance()->get_option('optimize_js');
	}


	protected static function enqueue_wp_asset($handle, $url = '', $deps = array(), $ver = false){
		wp_enqueue_script($handle, $url, $deps, $ver, true);
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
			static::save_file($assets, $path, ';try{', '}catch(e){console.warn(e)};');
		}
		$this->done();
		$content = ';window.resturl = window.resturl || "'.get_rest_url().'";';

		wp_enqueue_script('gt3-assets-footer', $this->upload_dir['url'].$hash.'.'.$this->ext, array(), filemtime($path), true);
		wp_script_add_data('gt3-assets-footer', 'data', $content);

		return true;
	}

	protected function init(){
		static $started = false;
		if($started) {
			return;
		}

		$started = true;

		parent::init();

		add_action('wp_head', array( $this, 'wp_head_scripts' ), 7);
		add_action('wp_print_footer_scripts', array( $this, 'wp_footer_scripts' ), 7);
	}

	public function wp_head_scripts() {
		if (!$this->isMinimizedAll) {
			return;
		}
		$this->wp_print_styles( 0);
	}

	public function wp_footer_scripts() {
		if (!$this->isMinimizedAll) {
			return;
		}
		$this->wp_print_styles( 1);
	}

	public function do_items( $handles = false, $group = false ) {
		global $wp_scripts;

		$handles = false === $handles ? $wp_scripts->queue : (array) $handles;
		$wp_scripts->all_deps( $handles );

		$hash = [];

		foreach ( $wp_scripts->to_do as $key => $handle ) {
			if ( ! in_array( $handle, $wp_scripts->done, true ) && isset( $wp_scripts->registered[ $handle ] ) ) {
				if ( $this->do_item( $handle, $group ) ) {
					$wp_scripts->done[] = $handle;
				}

				unset( $wp_scripts->to_do[ $key ] );
			}
		}

		return $wp_scripts->done;
	}


	public function wp_print_styles($group){
		global $wp_scripts;
	
		$this->global_registered = &$wp_scripts->registered;
		$this->global_queue      = [];

		$wp_scripts->all_deps($wp_scripts->queue);

		$hash = [];

		$to_do = /*array_merge(*/$wp_scripts->to_do/*, $wp_scripts->in_footer)*/;

		foreach($to_do as $key => $handle) {

			if (0 === $group &&  $wp_scripts->groups[ $handle ] > 0 ) {
				$wp_scripts->in_footer[] = $handle;
				continue;
			}

			$asset = $this->global_registered[$handle];

			$path  = $this->convert_url_to_path($asset->src);
			if(null !== $path) {
				$hash[$handle] = $handle.'-'.filemtime($path);
				$wp_scripts->done[] = $handle;
				unset($wp_scripts->to_do[$key]);
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

		$filename = ($group === 1 ? 'footer' : 'header').'-'.$filename;


		$hash_file = $this->upload_dir['path'].$filename.'.js';

		if(!file_exists($hash_file) || true) {
			$fp = fopen($hash_file, 'w+');
			if(!$fp) {
				return;
			}

			foreach($hash as $handle => $ver) {

				if ( ! key_exists( $handle, $wp_scripts->registered ) ) {
					 continue;
				}

				$obj = $wp_scripts->registered[ $handle ];
				$path  = $this->convert_url_to_path($obj->src);
				if (!$path) {
					continue;
				}

				$before_handle = $wp_scripts->get_inline_script_data( $handle, 'before', false );
				$after_handle  = $wp_scripts->get_inline_script_data( $handle, 'after', false );
				$translations = $wp_scripts->print_translations( $handle, false );
				$extra = $wp_scripts->print_extra_script( $handle, false );



				fwrite($fp, PHP_EOL.'/*-'.$handle.'-*/'.PHP_EOL);

				if ($extra) {
					fputs($fp, $extra);
				}
				if ($translations) {
					fputs($fp, $translations);
				}
				if ($before_handle) {
					fputs($fp, $before_handle);
				}
				if (!empty($path) && is_file($path) && is_readable($path)) {
					$FH   = fopen($path, "r");
					$line = fgets($FH);
					while($line !== false) {
						fputs($fp, $line);
						$line = fgets($FH);
					}
					fclose($FH);
				}
				if ($after_handle) {
					fputs($fp, $after_handle);
				}

			}
			fclose($fp);
		}

		wp_enqueue_script('gt3-'.$filename, $this->abs_path_to_url($hash_file), array(), filemtime($hash_file));
	}
}
