<?php

namespace GT3\ThemesCore\Import;

trait Reset_Trait {

	function action_before_reset(){
		
		$installed_plugins = get_plugins();
		$installed_plugins = array_column(array_map(function($key, $v){
			$path = $key;
			$key  = explode('/', $key);
			$key  = $key[0];
			
			return [ $key, $path ];
		}, array_keys($installed_plugins), $installed_plugins), 1, 0);
		
		remove_all_actions('update_option_active_plugins');
		update_option('active_plugins', array( $installed_plugins['gt3-themes-core'] ));
	}
	
	function action_reset_site($params = array()){
		global $current_user, $wpdb, $wp_rewrite;
		
		require_once(ABSPATH.'/wp-admin/includes/upgrade.php');
		
		require_once ABSPATH.'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH.'wp-admin/includes/class-wp-filesystem-direct.php';
		
		$upload_dir   = wp_upload_dir();
		$upload_folder = trailingslashit($upload_dir['basedir']);
		
		WP_Filesystem();
		$fs = new \WP_Filesystem_Direct(false);
		$fs->rmdir($upload_folder, true);
		
		$blogname       = get_option('blogname');
		$blog_public    = get_option('blog_public');
		$active_theme   = wp_get_theme();
		
		$installed_plugins = get_plugins();
		$installed_plugins = array_column(array_map(function($key, $v){
			$path = $key;
			$key  = explode('/', $key);
			$key  = $key[0];
			
			return [ $key, $path ];
		}, array_keys($installed_plugins), $installed_plugins), 1, 0);
		
		remove_all_actions('update_option_active_plugins');
		
		if('admin' != $current_user->user_login) {
			$user = get_user_by('login', 'admin');
		}
		
		// Check user Levels.
		// @see https://codex.wordpress.org/User_Levels#User_Levels_9_and_10.
		if(empty($user->user_level) || 10 > $user->user_level) {
			$user = $current_user;
		}
		
		$prefix = str_replace('_', '\_', $wpdb->prefix);
		$tables = $wpdb->get_col(sprintf("SHOW TABLES LIKE '%s%%'", $prefix)); // WPCS: unprepared SQL OK.
		foreach($tables as $table) {
			$wpdb->query(sprintf("DROP TABLE %s", $table)); // WPCS: unprepared SQL OK.
		}
		
		// Install WordPress.
		$result = wp_install($blogname, $user->user_login, $user->user_email, $blog_public);
		
		$url              = $result['url'];
		$user_id          = $result['user_id'];
		$password         = $result['password'];
		$password_message = $result['password_message'];
		
		// Set current user password.
		$query = $wpdb->prepare("UPDATE $wpdb->users SET user_pass = %s, user_activation_key = '' WHERE ID = %d", $user->user_pass, $user_id);
		$wpdb->query($query); // WPCS: unprepared SQL OK.
		
		$get_user_meta    = function_exists('get_user_meta') ? 'get_user_meta' : 'get_usermeta';
		$update_user_meta = function_exists('update_user_meta') ? 'update_user_meta' : 'update_usermeta';
		
		// Do not generated password for the current user.
		if($get_user_meta($user_id, 'default_password_nag')) {
			$update_user_meta($user_id, 'default_password_nag', false);
		}
		
		if($get_user_meta($user_id, $wpdb->prefix.'default_password_nag')) {
			$update_user_meta($user_id, $wpdb->prefix.'default_password_nag', false);
		}
		
		update_option('active_plugins', array( $installed_plugins['gt3-themes-core'] ));
		
		switch_theme($active_theme->get_stylesheet());
		
		$wp_rewrite->set_permalink_structure('/%postname%/');
		flush_rewrite_rules(true);
		
		// Clear current auth cookies.
//		wp_clear_auth_cookie();
		
		// Set current user auth cookies.
		wp_set_auth_cookie($user_id);
		
		die(json_encode(array(
			'finish'   => true,
			'error'     => false,
			'next_step' => true,
			'_ajax_nonce' => wp_create_nonce(self::$nonce_key)
		)));
	}
}