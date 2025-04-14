<?php

namespace GT3\ThemesCore\Import;

use WP_Error;
use WP_REST_Request;
use WP_HTTP_Response;
use WP_REST_Response;

use WP_Filesystem_Direct;
use WP_Filesystem_Base;
use WP_Ajax_Upgrader_Skin;
use Plugin_Upgrader;
use Language_Pack_Upgrader;

trait Plugins_Trait {
	
	public function install_plugin($request){
		global $wp_filesystem;
		
		require_once ABSPATH.'wp-admin/includes/file.php';
		require_once ABSPATH.'wp-admin/includes/plugin.php';
		require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
		require_once ABSPATH.'wp-admin/includes/plugin-install.php';
		
		$request = array_merge(array(
			'slug' => false,
			'source' => false,
			'status' => 'active'
		), $request);
		
		if (!$request['slug'] || !$request['status']) {
			return new WP_Error(
				'slug_or_source_empty',
				'Slug or source empty',
				array( 'status' => 500 )
			);
		}
		
		$slug   = $request['slug'];
		$source = $request['source'];
		
		// Verify filesystem is accessible first.
		$filesystem_available = $this->is_filesystem_available();
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
		if ($source && !is_file($source)) {
			$source = $this->fetch_file($source);
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
				__('Unable to connect to the filesystem. Please confirm your credentials.'),
				array( 'status' => 500 )
			);
		}
		
		$file = $upgrader->plugin_info();
		
		if(!$file) {
			return new WP_Error(
				'unable_to_determine_installed_plugin',
				__('Unable to determine what plugin was installed.'),
				array( 'status' => 500 )
			);
		}
		
		if('inactive' !== $request['status']) {
			$can_change_status = $this->plugin_status_permission_check($file, $request['status'], 'inactive');
			
			if(is_wp_error($can_change_status)) {
				return $can_change_status;
			}
			
			$changed_status = $this->handle_plugin_status($file, $request['status'], 'inactive');
			
			if(is_wp_error($changed_status)) {
				return $changed_status;
			}
		}
		;
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
		
		if ($remove_source) {
			@unlink($source);
		}
		
		return $response;
	}
	
	protected function handle_plugin_status($plugin, $new_status, $current_status){
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
				__('Network only plugin must be network activated.'),
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
	
	protected function is_filesystem_available(){
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
		
		return new WP_Error('fs_unavailable', __('The filesystem is currently unavailable for managing plugins.'), array( 'status' => 500 ));
	}
	
	protected function plugin_status_permission_check($plugin, $new_status, $current_status){
		if(is_multisite() && ('network-active' === $current_status || 'network-active' === $new_status) && !current_user_can('manage_network_plugins')) {
			return new WP_Error(
				'rest_cannot_manage_network_plugins',
				__('Sorry, you are not allowed to manage network plugins.'),
				array( 'status' => rest_authorization_required_code() )
			);
		}
		
		if(('active' === $new_status || 'network-active' === $new_status) && !current_user_can('activate_plugin', $plugin)) {
			return new WP_Error(
				'rest_cannot_activate_plugin',
				__('Sorry, you are not allowed to activate this plugin.'),
				array( 'status' => rest_authorization_required_code() )
			);
		}
		
		if('inactive' === $new_status && !current_user_can('deactivate_plugin', $plugin)) {
			return new WP_Error(
				'rest_cannot_deactivate_plugin',
				__('Sorry, you are not allowed to deactivate this plugin.'),
				array( 'status' => rest_authorization_required_code() )
			);
		}
		
		return true;
	}
}
