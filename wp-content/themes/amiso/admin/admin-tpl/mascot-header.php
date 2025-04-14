<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cannot access pages directly.' );
}
$wp_get_theme = wp_get_theme( get_template() );
$theme_name = $wp_get_theme->get('Name');
?>

	<h1><?php esc_html_e( 'Welcome to', 'amiso' ); ?> <?php echo esc_html( $theme_name ) ?></h1>
	<div class="about-text">
		<?php echo esc_html( $theme_name ) ?> <?php esc_html_e( 'Theme is installed successfully and you are ready to go live! Please install premium & required plugins and import demo content to build your awesome website! Also please activate this product and get latest updates. Happy Developing!', 'amiso' ); ?>
	</div>
	<div class="mascot-theme-logo"><span class="mascot-theme-version"><?php esc_html_e( 'Version', 'amiso' ); ?> <?php echo esc_html( $wp_get_theme->get('Version') )?></span></div>
