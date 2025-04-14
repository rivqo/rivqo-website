<?php
/**
 * The template for displaying Maintenance Mode Page
 *
 * This is the template that displays Maintenance Mode0 page by default.
 *
 */
add_filter( 'amiso_filter_show_header', 'amiso_return_false' );
add_filter( 'amiso_filter_show_footer', 'amiso_return_false' );

//change the page title
if( amiso_get_redux_option( 'maintenance-mode-settings-title' ) != '' ) {
	add_filter('pre_get_document_title', 'amiso_change_the_title');
	function amiso_change_the_title() {
		return amiso_get_redux_option( 'maintenance-mode-settings-title' );
	}
}

get_header();
?>

<?php
if ( mascot_core_amiso_plugin_installed() ) {
	mascot_core_amiso_get_maintenance_mode_parts();
}
?>

<?php get_footer();
