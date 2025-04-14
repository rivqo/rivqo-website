<?php
/*
Plugin Name: Sweet Custom Menu
Plugin URL: http://remicorson.com/sweet-custom-menu
Description: A little plugin to add attributes to WordPress menus
Version: 0.1
Author: Remi Corson
Author URI: http://remicorson.com
Contributors: corsonr
Text Domain: rc_scm
Domain Path: languages
*/

if( !class_exists( 'Amiso_RC_Sweet_Custom_Menu' ) ) {
class Amiso_RC_Sweet_Custom_Menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// load the plugin translation files

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields'), 10, 3 );

		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'rc_scm_edit_walker'), 10, 2 );

        add_action('admin_enqueue_scripts', array($this, 'iconpicker_enqueue_style'));

	} // end constructor


	/**
	 * Load the plugin's text domain
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function textdomain() {
	}

    function iconpicker_enqueue_style()
    {
        wp_enqueue_style('jquery.fonticonpicker.min.css', AMISO_TEMPLATE_URI . '/assets/js/plugins/iconpicker/css/jquery.fonticonpicker.min.css', array(), 'all');
        wp_enqueue_style('jquery.fonticonpicker.grey.min.css', AMISO_TEMPLATE_URI . '/assets/js/plugins/iconpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css', array(), 'all');
        wp_enqueue_script('jquery.fonticonpicker.js', AMISO_TEMPLATE_URI . '/assets/js/plugins/iconpicker/jquery.fonticonpicker.js', array('jquery'));
    }

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function rc_scm_add_custom_nav_fields( $menu_item ) {

		$menu_item->mascot_dropdownposition = get_post_meta( $menu_item->ID, '_menu_item_mascot_dropdownposition', true );
		$menu_item->mascot_subtitle = get_post_meta( $menu_item->ID, '_menu_item_mascot_subtitle', true );
		$menu_item->mascot_menuicon = get_post_meta( $menu_item->ID, '_menu_item_mascot_menuicon', true );
		$menu_item->mascot_custombadge = get_post_meta( $menu_item->ID, '_menu_item_mascot_custombadge', true );
		$menu_item->mascot_submenu_title = get_post_meta( $menu_item->ID, '_menu_item_mascot_submenu_title', true );

		if( amiso_get_redux_option( 'header-menu-megamenu-enable-megamenu' ) == 1 ) {
			$menu_item->mascot_megamenu_cpt = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_cpt', true );
			if ( ! $menu_item->menu_item_parent ) {
				$menu_item->mascot_megamenu_status = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_status', true );
				$menu_item->mascot_megamenu_containerwidth = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_containerwidth', true );
				$menu_item->mascot_megamenu_dropdownposition = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_dropdownposition', true );
			} else {
				$menu_item->mascot_megamenu_gridcolumnwidth = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_gridcolumnwidth', true );
				$menu_item->mascot_megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_widgetarea', true );
			}
			$menu_item->mascot_megamenu_bgimage = get_post_meta( $menu_item->ID, '_menu_item_mascot_megamenu_bgimage', true );
		}
		return $menu_item;

	}

	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function rc_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		// Check if element is properly sent
		if ( ! isset( $_REQUEST[ 'menu-item-mascot-dropdownposition' ][ $menu_item_db_id ] ) ) {
			$_REQUEST[ 'menu-item-mascot-dropdownposition' ][ $menu_item_db_id ] = '';
		}
		$dropdownposition_value = $_REQUEST[ 'menu-item-mascot-dropdownposition' ][ $menu_item_db_id ];
		update_post_meta( $menu_item_db_id, '_menu_item_mascot_dropdownposition', $dropdownposition_value );

		if ( isset( $_REQUEST['menu-item-mascot-subtitle'][$menu_item_db_id] ) && is_array( $_REQUEST['menu-item-mascot-subtitle'] ) ) {
				$subtitle_value = $_REQUEST['menu-item-mascot-subtitle'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_mascot_subtitle', $subtitle_value );
		}
		if ( isset( $_REQUEST['menu-item-mascot-menuicon'][$menu_item_db_id] ) && is_array( $_REQUEST['menu-item-mascot-menuicon'] ) ) {
				$subtitle_value = $_REQUEST['menu-item-mascot-menuicon'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_mascot_menuicon', $subtitle_value );
		}
		if ( isset( $_REQUEST['menu-item-mascot-custombadge'][$menu_item_db_id] ) && is_array( $_REQUEST['menu-item-mascot-custombadge'] ) ) {
				$subtitle_value = $_REQUEST['menu-item-mascot-custombadge'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_mascot_custombadge', $subtitle_value );
		}
		if ( isset( $_REQUEST['menu-item-mascot-submenu-title'][$menu_item_db_id] ) && is_array( $_REQUEST['menu-item-mascot-submenu-title'] ) ) {
				$subtitle_value = $_REQUEST['menu-item-mascot-submenu-title'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_mascot_submenu_title', $subtitle_value );
		}


		if( amiso_get_redux_option( 'header-menu-megamenu-enable-megamenu' ) == 1 ) {
			$field_name_suffix = array( 'gridcolumnwidth', 'cpt', 'widgetarea', 'bgimage' );
			if ( ! $args['menu-item-parent-id'] ) {
				$field_name_suffix = array( 'status', 'containerwidth', 'cpt', 'dropdownposition', 'bgimage' );
			}
			foreach ( $field_name_suffix as $key ) {
				if ( ! isset( $_REQUEST[ 'menu-item-mascot-megamenu-' . $key ][ $menu_item_db_id ] ) ) {
					$_REQUEST[ 'menu-item-mascot-megamenu-' . $key ][ $menu_item_db_id ] = '';
				}
				$value = $_REQUEST[ 'menu-item-mascot-megamenu-' . $key ][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_mascot_megamenu_' . $key, $value );
			}
		}
	}

	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function rc_scm_edit_walker($walker,$menu_id) {

		return 'Amiso_Walker_Nav_Menu_Edit_Custom';

	}

}
}

// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new Amiso_RC_Sweet_Custom_Menu();


include_once( 'edit_custom_walker.php' );
include_once( 'custom_walker.php' );