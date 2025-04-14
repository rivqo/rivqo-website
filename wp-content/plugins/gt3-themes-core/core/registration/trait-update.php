<?php

namespace GT3\ThemesCore\Registration;

use DateTime;
use GT3\ThemesCore\Logs;
use WP_Error;

trait Update_Trait {
	private $cron_name = 'gt3_theme_core_license_cron';

	protected function init_update(){
		$enabled = $this->get('check_update', false);
		if($enabled) {
			add_filter('pre_set_site_transient_update_plugins', array( $this, 'check_plugins_update' ), 0);
			add_filter('pre_set_site_transient_update_themes', array( $this, 'check_theme_update' ), 100);
		}

		add_action($this->cron_name, array( $this, 'cron_action' ));

		if(!wp_next_scheduled($this->cron_name)) {
			$this->next_schedule();
			do_action($this->cron_name);
		}
	}

	public function next_schedule(){
		$datetime = new DateTime('now', wp_timezone());
		$datetime->modify('+1 Hour');
		wp_schedule_single_event($datetime->getTimestamp(), $this->cron_name);
	}

	public function cron_action(){

		if(!$this->get('activated')) {
			$this->next_schedule();
			return;
		}

		$Log = Logs::instance();

		if(empty($this->get('purchase_code'))) {
			$Log->save_log(array(
					'type'     => E_USER_WARNING,
					'message'  => 'active, but code empty',
					'file'     => __FILE__,
					'line'     => __LINE__,
					'filename' => 'cron',
				));
			$this->next_schedule();
			return;
		}

		$data = $this->fetch_check_user(); //23.09

		if(is_wp_error($data)) {
			/** @var WP_Error $data */
			$data = array(
				'error'   => true,
				'respond' => $data->get_error_message()
			);
		}

		/*$actions = array(
			'purchase_code'  => '',
			'support_time'   => '',
			'activated'      => false,
			'already_linked' => false,
		);*/

		$actions = array();

		if(is_array($data) && key_exists('actions', $data) && is_array($data['actions'])) {
			$Log->save_log(array( // 23.12
					'type'     => E_USER_WARNING,
					'message'  => print_r($data['actions'], true),
					'filename' => 'cron',
					'line'     => __LINE__,
					'file'     => __FILE__
				));
			$actions = array_merge($actions, $data['actions']);
			$Log->save_log(array(
					'type'     => E_USER_WARNING,
					'message'  => print_r($actions, true),
					'filename' => 'cron',
					'line'     => __LINE__,
					'file'     => __FILE__
				));
			if(!$actions['activated']) {
				$error                    = array(
					'type'     => E_USER_ERROR,
					'message'  => 'Registration failed. Activation disabled',
					'filename' => 'registration',
					'line'     => __LINE__,
					'file'     => __FILE__
				);
				$actions['purchase_code'] = '';
				$this->save($actions);
				Logs::instance()->save_log($error);
			}
		} else if (is_array($data) && array_key_exists('error', $data) && $data['error']) {
			$data = array_merge(array(
				'respond' => 'Undefined error'
			), $data);

			$Log->save_log(array(
				'type'     => E_USER_WARNING,
				'message'  => $data['respond'],
				'filename' => 'cron',
				'line'     => __LINE__,
				'file'     => __FILE__
			));
			$this->save($actions);
		}
		$Log->save_log(array(
			'type'     => E_USER_WARNING,
			'message'  => json_encode($data),
			'filename' => 'cron',
			'line'     => __LINE__,
			'file'     => __FILE__
		));
		$this->next_schedule();
	}

	public function rest_set_update(\WP_REST_Request $request){
		$update = $request->get_param('check_update');

		$this->set('check_update', (bool) $update);

		return rest_ensure_response(array(
				'success' => true,
				'respond' => 'Saved',
				'data'    => array(
					'check_update' => $update,
				)
			));
	}

	function check_theme_update($transient){
		static $loaded = false;

		$slug = $this->theme;
		global $wp_version;

		if(empty($transient->checked) || empty($transient->checked[$slug]) || !empty($transient->response[$slug])) {
			return $transient;
		}

		$url = $this->get_update_url();

		$plugins = apply_filters('gt3/core/update/plugins', array());

		$response = $this->fetch($url, array(
				'plugins' => $plugins,
			));

		if(is_wp_error($response)) {
			return $transient;
		}

		if($this->get('activated')) {
			if(!empty($this->get('purchase_code'))) {
				$this->save($response, true);
			} else {
				$Log = Logs::instance();

				$Log->save_log(array(
						'type'    => E_USER_WARNING,
						'message' => 'active, but code empty',
						'filename'    => 'cron',
						'line'    => __LINE__,
						'file'    => __FILE__,
				));
			}
		}

		$response = array_merge(array(
				'allow_update' => false,
				'plugins'      => array(),
				'transient'    => array(
					'changelog'   => '',
					'new_version' => '1.0.0',
					'package'     => '',
					'theme'       => $this->theme,
					'url'         => '',
				)
			), $response);

		if($response['allow_update']) {
			if(isset($response['allow_update']) && $response['allow_update'] && isset($response['transient']) && version_compare($transient->checked[$slug], $response['transient']['new_version'], '<')) {
				$transient->response[$slug] = (array) $response['transient'];
			}

			if(isset($response['plugins']) && !empty($response['plugins']) && is_array($response['plugins'])) {
				update_option('gt3_plugins', $response['plugins']);
			}
		}

		$current_changelog = $this->get('changeLogVer', '1.0');

		if(isset($response['transient']) && !empty($response['transient']['changelog']) && version_compare($current_changelog, $response['transient']['new_version'], '<')) {
			$this->save_changelog($response['transient']['changelog']);
		}

		return $transient;
	}

	public function check_plugins_update($repo_updates){
		if (!property_exists($repo_updates, 'response') || !is_array($repo_updates->response)) {
			return $repo_updates;
		}

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugins = get_option('gt3_plugins');

		if(!is_array($plugins)) {
			$plugins = array();
		}
		if(!function_exists('get_plugin_data')) {
			require_once(ABSPATH.'wp-admin/includes/plugin.php');
		}

		if(count($plugins)) {
			foreach($plugins as $slug_plugin => $plugin) {
				$file_path = sprintf('%1$s/%1$s.php', $slug_plugin);
				$full_path = sprintf('%1$s/%2$s', WP_PLUGIN_DIR, $file_path);
				if(!file_exists($full_path)) {
					continue;
				}

				$plugin_info = get_plugin_data($full_path, false, false);

				if(version_compare($plugin_info['Version'], $plugin['version'], '>=')) {
					continue;
				}

				if(empty($repo_updates->response[$file_path])) {
					$repo_updates->response[$file_path] = new \stdClass;
				}

				// We only really need to set package, but let's do all we can in case WP changes something.
				$repo_updates->response[$file_path]->slug        = $slug_plugin;
				$repo_updates->response[$file_path]->plugin      = $file_path;
				$repo_updates->response[$file_path]->new_version = $plugin['version'];
				$repo_updates->response[$file_path]->package     = $plugin['source'];
				if(empty($repo_updates->response[$file_path]->url) && !empty($plugin['external_url'])) {
					$repo_updates->response[$file_path]->url = $plugin['external_url'];
				}
			}
		}

		foreach(apply_filters('gt3/tgmpa_plugins', array()) as $plugin_array) {
			if (array_key_exists('version', $plugin_array)) {
				$slug_plugin = $plugin_array['slug'];
				$file_path = sprintf('%1$s/%1$s.php', $slug_plugin);
				$full_path = sprintf('%1$s/%2$s', WP_PLUGIN_DIR, $file_path);
				if(!file_exists($full_path)) {
					continue;
				}

				$plugin_info = get_plugin_data($full_path, false, false);

				if(version_compare($plugin_info['Version'], $plugin_array['version'], '>=')) {
					continue;
				}

				if ( (array_key_exists($file_path, $repo_updates->response) ) ) {
					if (version_compare($repo_updates->response[$file_path]->new_version,$plugin_array['version'],'>'))
						continue;
				}


				if(empty($repo_updates->response[$file_path])) {
					$repo_updates->response[$file_path] = new \stdClass;
				}

				// We only really need to set package, but let's do all we can in case WP changes something.
				$repo_updates->response[$file_path]->slug        = $slug_plugin;
				$repo_updates->response[$file_path]->plugin      = $file_path;
				$repo_updates->response[$file_path]->new_version = $plugin_array['version'];
				$repo_updates->response[$file_path]->package     = $plugin_array['source'];
				if(empty($repo_updates->response[$file_path]->url) && !empty($plugin_array['external_url'])) {
					$repo_updates->response[$file_path]->url = $plugin_array['external_url'];
				}
			}
		}

		return $repo_updates;
	}


	protected function save_changelog($changelog){
		$changelog = trim($changelog);
		if(empty($changelog)) {
			return false;
		}

		$file = get_template_directory().'/changelog.txt';

		try {
			$fp = fopen($file, 'w+');
			if($fp) {
				fwrite($fp, $changelog);
				fflush($fp);
				fclose($fp);
			}
		} catch(\Exception $exception) {
			return false;
		}

		return true;
	}

	protected function get_changelog($html = false){
		$changelog = '';
		$file      = stream_resolve_include_path(get_template_directory().'/changelog.txt');
		if(false !== $file && is_file($file) && is_readable($file)) {
			$fp = fopen($file, 'r');
			if($fp) {
				while(!feof($fp)) {
					$changelog .= fread($fp, 1024);
				}
				fclose($fp);
			}
		}
		if($html) {
			$changelog = $this->modify_changelog($changelog);
		}

		return $changelog;
	}

	protected function modify_changelog($content){
		if(!empty($content)) {
			$pattern = array(
				'/(\*\*\*)(.+)(\*\*\*)/',
				'/(\=\=)(.+)(\=\=)/',
				'/(\*)/'
			);
			$replace = array( '<h1>${2}</h1>', '</br><h2>${2}</h2>', '</br>&#9642;' );
			$content = preg_replace($pattern, $replace, $content);
		}

		return $content;
	}
}
