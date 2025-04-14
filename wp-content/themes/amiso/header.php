<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "main-content" div.
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<?php
	/**
	 * amiso_body_tag_start hook.
	 *
	 */
	do_action( 'amiso_body_tag_start' );
?>
<div id="wrapper">
	<?php
		/**
		 * amiso_wrapper_start hook.
		 *
		 */
		do_action( 'amiso_wrapper_start' );
	?>
	<?php amiso_get_page_preloader(); ?>

	<?php if( apply_filters('amiso_filter_show_header', true) ): ?>
	<?php amiso_get_header_parts(); ?>
	<?php endif; ?>

	<?php
		/**
		 * amiso_before_main_content hook.
		 *
		 */
		do_action( 'amiso_before_main_content' );
	?>
	<div class="main-content">
	<?php
		/**
		 * amiso_main_content_start hook.
		 *
		 */
		do_action( 'amiso_main_content_start' );
	?>
