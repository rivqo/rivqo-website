<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Utils;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_TextScrollAnimation $widget */

$settings = array(
);

$settings = wp_parse_args($widget->get_settings(), $settings);

$widget->add_render_attribute('wrapper', 'class', array(
	'gt3-text-scroll-wrapper',
));

$settings = $widget->get_settings_for_display();

if ( '' === $settings['title'] ) {
	return;
}

?>
	<div <?php $widget->print_render_attribute_string('wrapper') ?>>
		<?php echo $settings['title']; ?>
	</div>
<?php





