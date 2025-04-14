<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Utils;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_TextRevealAnimation $widget */

$settings = array(
);

$settings = wp_parse_args($widget->get_settings(), $settings);

$widget->add_render_attribute('wrapper', 'class', array(
	'gt3-text-reveal-wrapper',
));

$settings = $widget->get_settings_for_display();

if ( '' === $settings['title'] ) {
	return;
}

?>
	<<?php echo Utils::validate_html_tag( $settings['html_tag'] ) ?> <?php $widget->print_render_attribute_string('wrapper') ?>><?php echo $settings['title']; ?></<?php echo Utils::validate_html_tag( $settings['html_tag'] ) ?>>
<?php





