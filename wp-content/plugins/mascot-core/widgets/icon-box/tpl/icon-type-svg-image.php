<?php

if (function_exists('mascot_core_core_plugin_installed')) {
	$svg_source_code = $svg_source_code;
}
wp_register_script( 'vivus', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/vivus.min.js', null, false, true );
wp_enqueue_script( 'vivus' );


$kses_defaults = wp_kses_allowed_html( 'post' );

$svg_args = array(
    'svg'   => array(
        'class' => true,
        'aria-hidden' => true,
        'aria-labelledby' => true,
        'role' => true,
        'xmlns' => true,
        'width' => true,
        'height' => true,
        'viewbox' => true, // <= Must be lower case!
    ),
    'g'     => array( 'fill' => true ),
    'title' => array( 'title' => true ),
    'path'  => array( 'd' => true, 'fill' => true,  ),
);

$allowed_tags = array_merge( $kses_defaults, $svg_args );
?>

<svg
	version="1.1"
	class="tm-vivus-svg-animation"
	id="tm-vivus-svg-animation-<?php echo esc_attr( rand(99, 1111) ) ?>"
	xmlns="http://www.w3.org/2000/svg"
	x="0"
	y="0"
	width="100%"
	height="100%"
	viewBox="0 0 <?php echo esc_attr($svg_width) ?> <?php echo esc_attr($svg_height) ?>"
	enable-background="new 0 0 <?php echo esc_attr($svg_width) ?> <?php echo esc_attr($svg_height) ?>"
	preserveAspectRatio="none"
	style="
	<?php 
		$inline_style = '';
		if (!empty($svg_container_width)) {
			$inline_style = 'width: ' . esc_attr($svg_container_width);
		}
		echo $inline_style;
	?>"
	xml:space="preserve"><?php echo wp_kses( $svg_source_code, $allowed_tags ); ?></svg>