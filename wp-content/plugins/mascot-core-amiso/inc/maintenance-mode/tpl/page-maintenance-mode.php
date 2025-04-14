<?php
/**
 * The template for displaying Coming Soon Page
 *
 * This is the template that displays Coming Soon page by default.
 *
 */
add_filter( 'mascot_core_amiso_filter_show_header', 'mascot_core_amiso_return_false' );
add_filter( 'mascot_core_amiso_filter_show_footer', 'mascot_core_amiso_return_false' );

//change the page title
if( mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-title' ) != '' ) {
	add_filter('pre_get_document_title', 'mascot_core_amiso_change_the_title');
	function mascot_core_amiso_change_the_title() {
		return mascot_core_amiso_get_redux_option( 'maintenance-mode-settings-title' );
	}
}

?>

<?php
	mascot_core_amiso_get_maintenance_mode_parts();
?>
<?php
