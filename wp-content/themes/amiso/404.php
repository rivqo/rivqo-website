<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
$header_return_true_false = ( amiso_get_redux_option( '404-page-settings-show-header', true ) == true ) ? 'amiso_return_true' : 'amiso_return_false';
add_filter( 'amiso_filter_show_header', $header_return_true_false );

$footer_return_true_false = ( amiso_get_redux_option( '404-page-settings-show-footer', true ) == true ) ? 'amiso_return_true' : 'amiso_return_false';
add_filter( 'amiso_filter_show_footer', $footer_return_true_false );

get_header();

amiso_get_title_area_parts();

amiso_get_404_parts();

get_footer();
