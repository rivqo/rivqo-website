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

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_TextRevealAnimation $widget */


$widget->start_controls_section(
	'section_reveal',
	array(
		'label' => esc_html__( 'Text Reveal Animation', 'gt3_themes_core' ),
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
		'default' => esc_html__( 'Add Your Text Here', 'gt3_themes_core' ),
	)
);

$widget->add_control(
	'html_tag',
	array(
		'label' => esc_html__( 'HTML Tag', 'gt3_themes_core' ),
		'type' => Controls_Manager::SELECT,
		'options' => array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
			'div' => 'div',
			'span' => 'span',
			'p' => 'p',
		),
		'default' => 'h2',
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
	'section_reveal_style',
	array(
		'label' => esc_html__( 'Text Reveal Animation', 'gt3_themes_core' ),
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
			'{{WRAPPER}} .gt3-text-reveal-wrapper' => 'color: {{VALUE}};',
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
		'selector' => '{{WRAPPER}} .gt3-text-reveal-wrapper',
	)
);

$widget->end_controls_section();


