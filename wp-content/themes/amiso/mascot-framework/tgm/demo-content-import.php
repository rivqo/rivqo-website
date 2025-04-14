<?php
class AmisoOneClickImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;

	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;
	private $revSliderFolder_importURI;

	private $preview_base_url;
	private $base_url;
	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;

	/**
	 * @return WebOnCoreImport
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public $message = array();
	public $data = array();
	public $status;
	public $attachments = false;
	public $imported_posts = array();
	public $import_sliders;

	function __construct() {
		$this->revSliderFolder = 'tm-rev-sliders';
		$this->import_sliders = false;

		//FTP
		$this->revSliderFolder_importURI = 'https://kodesolution.live/one-click-demo-import/amiso/import-rev-sliders/';
		$this->base_url = 'https://kodesolution.live/one-click-demo-import/amiso/v1.0/';

		//HTTP
		$this->preview_base_url = 'https://wp2023.kodesolution.com/amiso/';

		add_filter( 'ocdi/import_files', array( &$this, 'import_files' ) );
		add_filter( 'ocdi/after_import', array( &$this, 'after_import_setup' ) );
		add_filter( 'ocdi/plugin_page_setup', array( &$this, 'plugin_page_setup' ) );
		add_filter( 'ocdi/disable_pt_branding', '__return_true' );
	}

	//item_variations for import btn
	public function item_variations() {
		$item_variations = array (
			'home1' => 'Main Demo',
			'rtl' => 'RTL',
			// 'app-landing' => 'App Landing',
		);
		return $item_variations;
	}


	//preview_variations for preview btn
	public function preview_variations() {
		$preview_variations = array (
			'home1' => '',
			'rtl' => 'rtl',
			// 'app-landing' => 'app-landing',
		);
		return $preview_variations;
	}

	//return array by converting comma separated into arry
	public function rev_sliders($folder) {
		$slider_variations = array (
			'home1' => 'Slider-Home1.zip,Slider-Home2.zip',
			'rtl' => 'Slider-Home-rtl.zip',
			// 'app-landing' => 'Slider-Home1.zip',
		);

		//Split a comma-delimited string into an array
		$myString = $slider_variations[$folder];
		$myArray = explode(',', $myString);
		return $myArray;
	}



	/**
	 * Predefine demo imports
	 */
	public function import_files() {
		$preview_base_url = $this->preview_base_url;
		$base_url = $this->base_url;
		$item_variations = $this->item_variations();
		$preview_variations = $this->preview_variations();


		//Don't edit below code:
		$final_output = array();
		foreach ($item_variations as $key => $eachitem) {
			$title = strtoupper( str_replace("-"," ",$eachitem) );
			if( $key != '' ) {
				$key_new =  $key . '/';
			}

			$current_url = $base_url . $key_new;
			$preview_url = $preview_base_url . $preview_variations[$key];
			if( $key == 'rtl' ) {
				$preview_url = $preview_url . '?d=rtl';
			}
			$final_output[] = array(
					'import_file_name'           => $title,
					'categories'                 => array( $title ),
					'import_file_url'            => $current_url . 'xml.xml',
					'import_widget_file_url'     => $current_url . 'wie.wie',
					'import_redux'               => array(
							array(
									'file_url'    => $current_url . 'json.json',
									'option_name' => 'amiso_redux_theme_opt',
							),
					),
					'import_preview_image_url'   => $current_url . 'screenshot.jpg',
					'import_notice'              => esc_html__( 'After you import this demo, you will have to import the slider separately. You will find slider in "import-sliders" folder in your downloaded package.', 'amiso' ),
					'preview_url'                => $preview_url,
			);
		}

		return $final_output;
	}



	/**
	 * Automatically assign “Front page”, “Posts page” and menu locations after the importer is done
	 */
	public function after_import_setup( $selected_import ) {
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Top Primary Nav', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);

		if ( 'Main Demo' === $selected_import['import_file_name'] ) {
		}


		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home' );
		//$blog_page_id  = get_page_by_title( 'News Grid' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		//update_option( 'page_for_posts', $blog_page_id->ID );

		//update theme options:
		amiso_generate_dynamic_css();
		amiso_generate_css_for_custom_theme_color_from_scss();

		//rev slider import process
		if($this->import_sliders) {
			// step 1: flip array key => value
			$array_flip = array_flip($this->item_variations());
			// step 2: change case of new keys to upper
			$array_flip_uppercase = array_change_key_case($array_flip, CASE_UPPER);
			// step 3: reterive key to value
			$import_file_name = $array_flip_uppercase[$selected_import['import_file_name']];
			// step 4: import now
			$this->rev_slider_import( strtolower(trim($import_file_name)) );
		}
	}


	/**
	 * Change the location, title and other parameters of the plugin page
	 */
	public function plugin_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'themes.php';
		$default_settings['page_title']  = esc_html__( 'One Click Demo Import - ThemeMascot' , 'amiso' );
		$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'amiso' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'tm-one-click-demo-import';

		return $default_settings;
	}



	public function rev_sliders_upload_dir($dir_name) {
		$upload     = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		return $upload_dir;
	}

	public function create_rev_slider_files( $folder ) {
		$rev_list = $this->rev_sliders($folder);
		$dir_name = $this->revSliderFolder;

		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}


		$upload_dir = $this->rev_sliders_upload_dir($dir_name);

		if ( ! is_dir( $upload_dir ) ) {
			wp_mkdir_p( $upload_dir, 0700 );
		}

		if ( ! is_dir( $upload_dir . '/' . $folder ) ) {
			wp_mkdir_p( $upload_dir . '/' . $folder, 0700 );
		}
		foreach ( $rev_list as $rev_slider ) {

			$file_data = $wp_filesystem->get_contents( $this->revSliderFolder_importURI . $folder . '/' . $rev_slider );

			if ( $file_data ) {
				$wp_filesystem->put_contents(
					$upload_dir . '/' . $folder . '/' . $rev_slider,
					$file_data );
			} else {
				return false;
			}
		}

		return true;
	}

	public function rev_slider_import( $folder ) {
		$files_created = $this->create_rev_slider_files( $folder );

		if ( $files_created ) {
			$demo_rev_sliders = $this->rev_sliders($folder);
			$dir_name         = $this->revSliderFolder;

			$upload_dir = $this->rev_sliders_upload_dir($dir_name);

			if ( class_exists( 'RevSliderSliderImport' ) ) {
				$import_instance = new RevSliderSliderImport();

				if ( ! empty( $import_instance ) && ! is_wp_error( $import_instance ) ) {
					$rev_slider_instance = new RevSliderSlider();
					$rev_sliders         = $rev_slider_instance->get_sliders_short_list();
					$rev_sliders         = ! empty( $rev_sliders ) ? array_map( function ( $item ) {
						return $item->alias;
					}, get_object_vars( $rev_sliders ) ) : array();

					foreach ( $demo_rev_sliders as $demo_rev_slider ) {

						// Check if slider already exists to prevent the double import
						if ( ! in_array( str_replace( '.zip', '', $demo_rev_slider ), $rev_sliders, true ) ) {
							$import_slider_url = $upload_dir . '/' . $folder . '/' . $demo_rev_slider;

							$rev_slider_result = $import_instance->import_slider( true, $import_slider_url );

							if ( ! $rev_slider_result['success'] ) {
								esc_html_e( 'Error while importing rev sliders', 'amiso' );
								exit;
							}
						}
					}

					esc_html_e( 'Rev sliders imported successfully', 'amiso' );
				} else {
					esc_html_e( 'RevSliderSliderImport instance is empty', 'amiso' );
				}

			} else {
				esc_html_e( 'RevSliderSliderImport class doesn\'t exist', 'amiso' );
			}

		} else {
			esc_html_e( 'Files don\'t exist', 'amiso' );
		}
	}

}

AmisoOneClickImport::get_instance();












