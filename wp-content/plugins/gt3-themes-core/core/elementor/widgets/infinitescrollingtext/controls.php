<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_InfiniteScrollingText $widget */

$widget->start_controls_section(
	'basic',
	array(
		'label' => esc_html__('General', 'gt3_themes_core')
	)
);

$widget->add_control(
	'text_content',
	array(
		'label' => esc_html__( 'Text', 'gt3_themes_core' ),
		'type' => Controls_Manager::TEXTAREA,
		'dynamic' => array(
			'active' => true,
		),
		'placeholder' => esc_html__( 'Enter your text', 'gt3_themes_core' ),
		'default' => esc_html__( 'Add Your Text Here', 'gt3_themes_core' ),
	)
);

$widget->add_control(
	'scrolling_direction',
	array(
		'label'     => esc_html__('Scrolling Direction', 'gt3_themes_core'),
		'type'      => Controls_Manager::SELECT,
		'options'   => array(
			'ltr' => esc_html__('Standard', 'gt3_themes_core'),
			'rtl' => esc_html__('Reverse', 'gt3_themes_core'),
		),
		'default'   => 'ltr',
	)
);

$widget->add_control(
	'scrolling_speed',
	array(
		'label'     => esc_html__('Scrolling Speed', 'gt3_themes_core'),
		'type'      => Controls_Manager::SELECT,
		'options'   => array(
			'slower' => esc_html__('Slower', 'gt3_themes_core'),
			'slowest' => esc_html__('Slowest', 'gt3_themes_core'),
			'slow' => esc_html__('Slow', 'gt3_themes_core'),
			'medium' => esc_html__('Medium', 'gt3_themes_core'),
			'fast' => esc_html__('Fast', 'gt3_themes_core'),
			'static' => esc_html__('Static', 'gt3_themes_core'),
		),
		'default'   => 'slower',
	)
);

$widget->add_control(
	'text_repeat_number',
	array(
		'label'     => esc_html__('Text Repeat Counts', 'gt3_themes_core'),
		'type'      => Controls_Manager::SELECT,
		'options'   => array(
			'2' => esc_html__('2', 'gt3_themes_core'),
			'3' => esc_html__('3', 'gt3_themes_core'),
			'4' => esc_html__('4', 'gt3_themes_core'),
			'5' => esc_html__('5', 'gt3_themes_core'),
			'6' => esc_html__('6', 'gt3_themes_core'),
			'7' => esc_html__('7', 'gt3_themes_core'),
			'8' => esc_html__('8', 'gt3_themes_core'),
		),
		'default'   => '2',
	)
);

$widget->add_control(
	'overflow_visibility',
	array(
		'label'     => esc_html__('Overflow Visibility', 'gt3_themes_core'),
		'type'      => Controls_Manager::SELECT,
		'options'   => array(
			'visible' => esc_html__('Visible', 'gt3_themes_core'),
			'hidden' => esc_html__('Hidden', 'gt3_themes_core'),
		),
		'default'   => 'visible',
	)
);

$widget->end_controls_section();

$widget->start_controls_section(
	'section_text_style',
	array(
		'label' => esc_html__( 'Text Style', 'gt3_themes_core' ),
		'tab' => Controls_Manager::TAB_STYLE,
	)
);

$widget->add_control(
	'text_color',
	array(
		'label'     => esc_html__('Color', 'gt3_themes_core'),
		'type'      => Controls_Manager::COLOR,
		'selectors' => array(
			'{{WRAPPER}} .gt3-scrolling-text-wrapper' => 'color: {{VALUE}};',
		),
	)
);

$widget->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'text_typography',
		'selector' => '{{WRAPPER}} .gt3-scrolling-text-wrapper',
	)
);

$widget->end_controls_section();
