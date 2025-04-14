<?php

namespace GT3\Ewebot;

use WP_Error;
use WP_Ajax_Upgrader_Skin;
use Plugin_Upgrader;
use WP_Filesystem_Base;

if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$installed_plugins = get_plugins();
$installed_plugins = array_column(array_map(function($key, $v){
	$slug      = $key;
	$v['path'] = WP_PLUGIN_DIR.'/'.$key;
	$key       = explode('/', $key);
	$key       = $key[0];

	return [ $key, $slug ];
}, array_keys($installed_plugins), $installed_plugins), 1, 0);

$active_plugins = array_map(function($key){
	$key = explode('/', $key);

	return $key[0];
}, get_option('active_plugins'));

$core_slug = 'gt3-themes-core';

if(!array_key_exists($core_slug, $installed_plugins) || (array_key_exists($core_slug, $installed_plugins) && !in_array($core_slug, $active_plugins))) {
	add_action('admin_notices', function() use ($core_slug, $installed_plugins, $active_plugins){

		$button = !array_key_exists($core_slug, $installed_plugins)
			? ('<button class="gt3-install-theme-core button button-primary button-large" onclick="javascript:void(0)">Install GT3 Themes Core</button>')
			: sprintf(
				'<a href="%s" class="gt3-activate-theme-core button button-primary button-large">%s</a>',
				wp_nonce_url('plugins.php?action=activate&amp;plugin='.$installed_plugins[$core_slug].'&amp;plugin_status=all&amp;paged=1&amp;', 'activate-plugin_'.$installed_plugins[$core_slug]),
				esc_html__('Activate Theme Core', 'ewebot')) ;

		echo '<div class="error gt3-notice-theme-core-wrapper">
				<img src="'.get_template_directory_uri().'/core/admin/img/logo_options.png" alt="" />
				<div class="gt3-install-theme-core-info">
					<h3>Thanks for choosing Ewebot theme!</h3>
					<p>The Ewebot theme requires GT3 Themes Core plugin installation.<br>This plugin includes extra functionality, theme dashboard, customizer, demo importer, optimization and other features.</p>
					<div style="display: inline-flex; align-items: center">
					'.$button.'
					<span class="spinner"></span>
					</div>
				</div>
			  </div>';



		echo !array_key_exists($core_slug, $installed_plugins) ? "<script>
				(function () {
					var button = document.querySelector('.gt3-install-theme-core');
					if (button) {
						button.addEventListener('click', function (event) {
							event.preventDefault();
							event.stopPropagation();
							
							button.classList.add('disabled');
							
							var wrapper = button.closest('.gt3-notice-theme-core-wrapper');
							wrapper.classList.add('loading');
							const data = new URLSearchParams({
								action: 'gt3_theme_install_core',
							});
				
							fetch(ajaxurl + '?' + data)
							.then(function (data) {
								return data.json();
							})
							.then(function (data) {
								if (data.error) {
								
								} else {
									window.location.href=data.redirect;
								}
							})
						})
					}
				})()
</script>" : "<script>
				(function () {
					var button = document.querySelector('.gt3-activate-theme-core');
					if (button) {
						button.addEventListener('click', function (event) {
							event.preventDefault();
							event.stopPropagation();
							
							button.classList.add('disabled');
							
							var wrapper = button.closest('.gt3-notice-theme-core-wrapper');
							wrapper.classList.add('loading');
							const data = new URLSearchParams({
								action: 'gt3_theme_activate_core',
							});
				
							fetch(ajaxurl + '?' + data)
							.then(function (data) {
								return data.json();
							})
							.then(function (data) {
								if (data.error) {
								
								} else {
									window.location.href=data.redirect;
								}
							})
						})
					}
				})()
</script>";
	});

	if(!array_key_exists($core_slug, $installed_plugins)) {
		add_action('wp_ajax_gt3_theme_install_core', function() use ($core_slug, $installed_plugins){
			$link = 'https://gt3accounts.com/update/tgm.php?eyJzIjoiZ3QzLXRoZW1lcy1jb3JlIiwiYSI6ImRvd25sb2FkX3BsdWdpbiJ9';
			add_filter('http_request_host_is_external', '__return_true');
			$status = install_plugin(array(
				'status' => 'active',
				'slug'   => $core_slug,
				'source' => $link
			));

			if(is_wp_error($status)) {
				wp_die(wp_json_encode(array(
					'error'   => true,
					'message' => $status->get_error_message(),
				)));
			}

			wp_die(wp_json_encode(array(
				'error' => false,
				'redirect' => add_query_arg(array( 'page' => 'gt3_dashboard' ), admin_url('admin.php'))
			)));
		});
	} else {
		add_action('wp_ajax_gt3_theme_activate_core', function() use ($core_slug, $installed_plugins){
			$status = handle_plugin_status($installed_plugins[$core_slug],'','inactive');

			if(!$status) {
				wp_die(wp_json_encode(array(
					'error'   => true,
					'message' => 'Error activation plugin.',
				)));
			}

			wp_die(wp_json_encode(array(
				'error' => false,
				'redirect' => add_query_arg(array( 'page' => 'gt3_dashboard' ), admin_url('admin.php'))
			)));
		});
	}
}

function is_filesystem_available(){
	$filesystem_method = get_filesystem_method();
	if('direct' === $filesystem_method) {
		return true;
	}
	ob_start();
	$filesystem_credentials_are_stored = request_filesystem_credentials(self_admin_url());
	ob_end_clean();
	if($filesystem_credentials_are_stored) {
		return true;
	}

	return new WP_Error('fs_unavailable', __('The filesystem is currently unavailable for managing plugins.', 'ewebot'), array( 'status' => 500 ));
}

function plugin_status_permission_check($plugin, $new_status, $current_status){
	if(is_multisite() && ('network-active' === $current_status || 'network-active' === $new_status) && !current_user_can('manage_network_plugins')) {
		return new WP_Error(
			'rest_cannot_manage_network_plugins',
			__('Sorry, you are not allowed to manage network plugins.', 'ewebot'),
			array( 'status' => rest_authorization_required_code() )
		);
	}

	if(('active' === $new_status || 'network-active' === $new_status) && !current_user_can('activate_plugin', $plugin)) {
		return new WP_Error(
			'rest_cannot_activate_plugin',
			__('Sorry, you are not allowed to activate this plugin.', 'ewebot'),
			array( 'status' => rest_authorization_required_code() )
		);
	}

	if('inactive' === $new_status && !current_user_can('deactivate_plugin', $plugin)) {
		return new WP_Error(
			'rest_cannot_deactivate_plugin',
			__('Sorry, you are not allowed to deactivate this plugin.', 'ewebot'),
			array( 'status' => rest_authorization_required_code() )
		);
	}

	return true;
}

function install_plugin($request){
	global $wp_filesystem;

	require_once ABSPATH.'wp-admin/includes/file.php';
	require_once ABSPATH.'wp-admin/includes/plugin.php';
	require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH.'wp-admin/includes/plugin-install.php';

	$slug   = $request['slug'];
	$source = $request['source'];

	// Verify filesystem is accessible first.
	$filesystem_available = is_filesystem_available();
	if(is_wp_error($filesystem_available)) {
		return $filesystem_available;
	}

	if(!$source) {
		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => $slug,
				'fields' => array(
					'sections'       => false,
					'language_packs' => true,
				),
			)
		);

		if(is_wp_error($api)) {
			if(str_contains($api->get_error_message(), 'Plugin not found.')) {
				$api->add_data(array( 'status' => 404 ));
			} else {
				$api->add_data(array( 'status' => 500 ));
			}

			return $api;
		}

		$source = $api->download_link;
	}
	$remove_source = false;
	if($source && !is_file($source)) {
		$source        = download_url($source);
		$remove_source = true;
	}

	$skin     = new WP_Ajax_Upgrader_Skin();
	$upgrader = new Plugin_Upgrader($skin);

	$result = $upgrader->install($source);

	if(is_wp_error($result)) {
		$result->add_data(array( 'status' => 500 ));

		return $result;
	}

	// This should be the same as $result above.
	if(is_wp_error($skin->result)) {
		$skin->result->add_data(array( 'status' => 500 ));

		return $skin->result;
	}

	if($skin->get_errors()->has_errors()) {
		$error = $skin->get_errors();
		$error->add_data(array( 'status' => 500 ));

		return $error;
	}

	if(is_null($result)) {
		// Pass through the error from WP_Filesystem if one was raised.
		if($wp_filesystem instanceof WP_Filesystem_Base
		   && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->has_errors()
		) {
			return new WP_Error(
				'unable_to_connect_to_filesystem',
				$wp_filesystem->errors->get_error_message(),
				array( 'status' => 500 )
			);
		}

		return new WP_Error(
			'unable_to_connect_to_filesystem',
			__('Unable to connect to the filesystem. Please confirm your credentials.', 'ewebot'),
			array( 'status' => 500 )
		);
	}

	$file = $upgrader->plugin_info();

	if(!$file) {
		return new WP_Error(
			'unable_to_determine_installed_plugin',
			__('Unable to determine what plugin was installed.', 'ewebot'),
			array( 'status' => 500 )
		);
	}

	if('inactive' !== $request['status']) {
		$can_change_status = plugin_status_permission_check($file, $request['status'], 'inactive');

		if(is_wp_error($can_change_status)) {
			return $can_change_status;
		}

		$changed_status = handle_plugin_status($file, $request['status'], 'inactive');

		if(is_wp_error($changed_status)) {
			return $changed_status;
		}
	};
	// Install translations.
	$installed_locales = array_values(get_available_languages());
	/** This filter is documented in wp-includes/update.php */
	$installed_locales = apply_filters('plugins_update_check_locales', $installed_locales);

	$path          = WP_PLUGIN_DIR.'/'.$file;
	$data          = get_plugin_data($path, false, false);
	$data['_file'] = $file;

	$response = $data;

	//		$response = $this->prepare_item_for_response( $data, $request );
	//		$response->set_status( 201 );
	//		$response->header( 'Location', rest_url( sprintf( '%s/%s/%s', $this->namespace, $this->rest_base, substr( $file, 0, - 4 ) ) ) );

	if($remove_source) {
		@unlink($source);
	}

	return $response;
}

function handle_plugin_status($plugin, $new_status, $current_status){
	if('inactive' === $new_status) {
		deactivate_plugins($plugin, false, 'network-active' === $current_status);

		return true;
	}

	if('active' === $new_status && 'network-active' === $current_status) {
		return true;
	}

	$network_activate = 'network-active' === $new_status;

	if(is_multisite() && !$network_activate && is_network_only_plugin($plugin)) {
		return new WP_Error(
			'rest_network_only_plugin',
			__('Network only plugin must be network activated.', 'ewebot'),
			array( 'status' => 400 )
		);
	}

	$activated = activate_plugin($plugin, '', $network_activate);

	if(is_wp_error($activated)) {
		$activated->add_data(array( 'status' => 500 ));

		return $activated;
	}

	return true;
}
