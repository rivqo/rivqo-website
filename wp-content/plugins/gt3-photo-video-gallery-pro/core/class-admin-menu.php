<?php

namespace GT3\PhotoVideoGalleryPro;
defined('ABSPATH') or exit;
#[AllowDynamicProperties]
class Admin_Menu {
	private static $instance = null;

	protected $jsurl = '';
	protected $imgurl = '';
	protected $cssurl = '';
	protected $rooturl = '';
	protected $rootpath = '';

	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
		add_action('admin_menu', array( $this, 'admin_menu_handler' ), 11);

		$this->jsurl    = plugins_url('assets/js/', GT3PG_PRO_FILE);
		$this->imgurl   = plugins_url('assets/img/', GT3PG_PRO_FILE);
		$this->cssurl   = plugins_url('assets/css/', GT3PG_PRO_FILE);
		$this->rooturl  = plugins_url('/', GT3PG_PRO_FILE);
		$this->rootpath = plugin_dir_path(GT3PG_PRO_FILE).'/';
	}

	public function admin_menu_handler(){
		if(!current_user_can('administrator')) {
			return;
		}
		remove_menu_page('gt3_photo_gallery_options');
		$function = 'gt3pg_plugin_options';
		$hookname = get_plugin_page_hookname('gt3_photo_gallery_options', '');
		if(!empty($function) && !empty($hookname)) {
			remove_action($hookname, $function);
		}

		add_menu_page(
			'GT3 Gallery Pro',
			'GT3 Gallery Pro',
			'administrator',
			'gt3_photo_gallery_options',
			array( $this, 'add_menu_page' ),
			Assets::get_dist_url().'img/logo.png',
			"10.9"
		);

		add_submenu_page(
			'gt3_photo_gallery_options',
			'Settings',
			'Settings',
			'administrator',
			'gt3_photo_gallery_options'
		);

		add_action('admin_print_scripts-toplevel_page_gt3_photo_gallery_options', array( $this, 'remove_admin_notices' ));

	}

	public function remove_admin_notices(){
		remove_all_actions('admin_notices');
	}

	public function add_menu_page(){
		global $current_screen;
		?>
		<div class="gt3pg_admin_wrap">
			<div class="gt3pg_inner_wrap">
				<form action="" method="post" class="gt3pg_page_settings">
					<div class="gt3pg_main_line">
						<div class="gt3pg_themename">
							GT<span class="digit">3</span> Photo & Video Gallery - Pro
							<span class="gt3pg_theme_ver"><?php echo GT3PG_PRO_PLUGIN_VERSION ?></span>
						</div>
						<div class="gt3pg_links">
							<a href="https://help.gt3themes.com/gt3-photo-video-gallery-wordpress-plugin/" target="_blank"><?php esc_html_e('Need Help?', 'gt3pg') ?></a>
						</div>
						<div class="clear"></div>
					</div>
					<?php
					if(function_exists('register_block_type')) {
						wp_enqueue_script('block-library');
						wp_enqueue_script('editor');
						wp_enqueue_script('wp-editor');
						wp_enqueue_script('wp-components');

						wp_enqueue_style('wp-components');
						wp_enqueue_style('wp-element');
						wp_enqueue_style('wp-blocks-library');

						wp_enqueue_script('gt3pg_settings', $this->rooturl.'dist/js/admin/settings.js');

						$settings = Settings::instance();
						$assets   = Assets::instance();

						$strtolower_function = function_exists('mb_strtolower') ? 'mb_strtolower' : 'strtolower';

						wp_localize_script(
							'gt3pg_settings',
							'gt3pg_pro',
							apply_filters(
								'gt3pg-pro/settings',
								array(
									'defaults' => $settings->getSettings(),
									'blocks'   => array_map($strtolower_function, $settings->getBlocks()),
									'plugins'  => $assets->getPlugins(),
								)
							)
						);
						wp_enqueue_style('gt3pg_settings', $this->rooturl.'dist/css/admin/settings.css');
						wp_enqueue_style('gt3pg_skin_css', $this->rooturl.'dist/css/admin/gt3-theme-new-style.css');
						?>
						<div class="edit-post-layout">
							<div class="edit-post-sidebar">
								<div id="gt3_editor"></div>
							</div>
						</div>
					<?php } ?>
				</form>
			</div>
			<div id="container_redux"></div>

		</div>
		<?php
	}
}

