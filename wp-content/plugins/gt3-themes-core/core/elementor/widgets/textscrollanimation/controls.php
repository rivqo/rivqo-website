<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

use Elementor\Group_Control_Text_Shadow;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_TextScrollAnimation $widget */


$widget->start_controls_section(
	'section_scrolling',
	array(
		'label' => esc_html__( 'Text Scroll Animation', 'gt3_themes_core' ),
	)
);

$widget->add_control(
	'title',
	array(
		'label' => esc_html__( 'Text', 'gt3_themes_core' ),
		'type' => Controls_Manager::TEXTAREA,
		'dynamic' => array(
			'active' => true,
		),
		'placeholder' => esc_html__( 'Enter your title', 'gt3_themes_core' ),
		'default' => esc_html__( 'Add Your Scrolling Text Here', 'gt3_themes_core' ),
	)
);

$widget->add_responsive_control(
	'align',
	array(
		'label' => esc_html__( 'Alignment', 'gt3_themes_core' ),
		'type' => Controls_Manager::CHOOSE,
		'options' => array(
			'left' => array(
				'title' => esc_html__( 'Left', 'gt3_themes_core' ),
				'icon' => 'eicon-text-align-left',
			),
			'center' => array(
				'title' => esc_html__( 'Center', 'gt3_themes_core' ),
				'icon' => 'eicon-text-align-center',
			),
			'right' => array(
				'title' => esc_html__( 'Right', 'gt3_themes_core' ),
				'icon' => 'eicon-text-align-right',
			),
			'justify' => array(
				'title' => esc_html__( 'Justified', 'gt3_themes_core' ),
				'icon' => 'eicon-text-align-justify',
			),
		),
		'default' => '',
		'selectors' => array(
			'{{WRAPPER}}' => 'text-align: {{VALUE}};',
		),
	)
);

$widget->end_controls_section();

$widget->start_controls_section(
	'section_scrolling_style',
	array(
		'label' => esc_html__( 'Text Scroll Animation', 'gt3_themes_core' ),
		'tab' => Controls_Manager::TAB_STYLE,
	)
);

$widget->add_control(
	'text_color',
	array(
		'label' => esc_html__( 'Text Color', 'gt3_themes_core' ),
		'type' => Controls_Manager::COLOR,
		'global' => array(
			'default' => Global_Colors::COLOR_PRIMARY,
		),
		'selectors' => array(
			'{{WRAPPER}} .gt3-text-scroll-wrapper' => 'color: {{VALUE}};',
		),
		'condition' => array(
			'enable_theme_textgradient' => '',
		),
	)
);

$widget->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name' => 'typography',
		'global' => array(
			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
		),
		'selector' => '{{WRAPPER}} .gt3-text-scroll-wrapper',
	)
);

/**/

$widget->add_control(
	'enable_theme_textgradient',
	array(
		'label'       => esc_html__('Enable Text Color Gradient?', 'gt3_themes_core'),
		'type'        => Elementor\Controls_Manager::SWITCHER,
		'description' => esc_html__('If checked, enable text color gradient', 'gt3_themes_core'),
		'default'     => '',
		'label_block' => true,
		'prefix_class' => 'gt3_theme_textgradient-',
	)
);
$widget->add_control(
	'textgradient_color_start',
	array(
		'label'   => esc_html__('Text Color Gradient Start','gt3_themes_core'),
		'type'    => Elementor\Controls_Manager::COLOR,
		'default' => '#ff4c6c',
		'selectors'   => array(
			'{{WRAPPER}} .gt3-text-scroll-wrapper' => '--textgradient_color1: {{VALUE}};',
		),
		'condition' => array(
			'enable_theme_textgradient!' => '',
		),
	)
);
$widget->add_control(
	'textgradient_color_end',
	array(
		'label'   => esc_html__('Text Color Gradient End','gt3_themes_core'),
		'type'    => Elementor\Controls_Manager::COLOR,
		'default' => '#fa9d4d',
		'selectors'   => array(
			'{{WRAPPER}} .gt3-text-scroll-wrapper' => '--textgradient_color2: {{VALUE}};',
		),
		'condition' => array(
			'enable_theme_textgradient!' => '',
		),
	)
);

/**/

$widget->end_controls_section();


