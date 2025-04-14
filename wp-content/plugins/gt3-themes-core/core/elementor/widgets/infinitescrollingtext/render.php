<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Utils;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_InfiniteScrollingText $widget */

$settings = array(
	'text_content'        => '',
	'scrolling_direction' => 'ltr',
	'scrolling_speed'     => 'slower',
	'text_repeat_number'  => '2',
	'overflow_visibility'  => 'visible',
);

$settings = wp_parse_args($widget->get_settings(), $settings);

$widget->add_render_attribute('wrapper', 'class', array(
	'gt3-scrolling-text-wrapper',
));

$content = '<div class="gt3-scrolling-text-element">' . $settings['text_content'] . '</div>';

$content_inner = '';
$text_repeat_number = (int)$settings['text_repeat_number'];

// Text Repeat
for( $i = 0; $i < $text_repeat_number; $i++ ) {
	$content_inner .= $content;
}

?>
	<div <?php $widget->print_render_attribute_string('wrapper') ?> data-direction="<?php echo esc_attr($settings['scrolling_direction']) ?>" data-speed="<?php echo esc_attr($settings['scrolling_speed']) ?>" data-visibility="<?php echo esc_attr($settings['overflow_visibility']) ?>">
		<?php echo '<div class="gt3-scrolling-text-inner">' . $content_inner . '</div>';  ?>
	</div>
<?php



