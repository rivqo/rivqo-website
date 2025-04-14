<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Controls_Manager;
use GT3\ThemesCore\Elementor\Controls\Query;
use Elementor\Group_Control_Typography;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_PortfolioTitle $widget */

$widget->start_controls_section(
	'query',
	array(
		'label' => esc_html__('Query', 'gt3_themes_core'),
	)
);
$widget->add_control(
	'query',
	array(
		'label'       => esc_html__('Query', 'gt3_themes_core'),
		'type'        => Query::type(),
		'settings'    => array(
			'showCategory'  => true,
			'showUser'      => true,
			'showPost'      => true,
			'post_type'     => $widget->POST_TYPE,
			'post_taxonomy' => $widget->TAXONOMY,
		),
	)
);

$widget->end_controls_section();

$widget->start_controls_section(
	'general',
	array(
		'label' => esc_html__('Main Settings', 'gt3_themes_core'),
		'tab'   => Controls_Manager::TAB_SETTINGS,
	)
);

$widget->add_control(
	'type',
	array(
		'label'   => esc_html__('Type', 'gt3_themes_core'),
		'type'    => Controls_Manager::SELECT,
		'options' => array(
			'1' => esc_html__('Type 1', 'gt3_themes_core'),
			'2' => esc_html__('Type 2', 'gt3_themes_core'),
			'3' => esc_html__('Type 3', 'gt3_themes_core'),
		),
		'default' => '1',
		'prefix_class' => 'type-',
	)
);

$widget->add_control(
	'show_category',
	array(
		'label' => esc_html__('Show Category', 'gt3_themes_core'),
		'type'  => Controls_Manager::SWITCHER,
		'default'   => 'yes'
	)
);

$widget->add_control(
	'show_date',
	array(
		'label' => esc_html__('Show Date', 'gt3_themes_core'),
		'type'  => Controls_Manager::SWITCHER,
		'default'   => 'yes',
		'condition' => array(
			'type' => array(
				'2',
				'3'
			)
		),
	)
);

$widget->add_control(
	'show_description',
	array(
		'label' => esc_html__('Show Description', 'gt3_themes_core'),
		'type'  => Controls_Manager::SWITCHER,
		'default'   => 'yes',
		'condition' => array(
			'type' => array(
				'2',
				'3'
			)
		),
	)
);

$widget->add_control(
	'content_cut',
	array(
		'label'       => esc_html__('Cut off text in Description', 'gt3_themes_core'),
		'type'        => Controls_Manager::SWITCHER,
		'description' => esc_html__('If checked, cut off text in Description', 'gt3_themes_core'),
		'condition'   => array(
			'show_description!' => '',
			'type' => array(
				'2',
				'3'
			)
		),
		'default'   => 'yes'
	)
);

$widget->add_control(
	'symbol_count',
	array(
		'label'       => esc_html__('Symbol count', 'gt3_themes_core'),
		'type'        => Controls_Manager::SLIDER,
		'default'     => array(
			'size' => 110,
			'unit' => 'px',
		),
		'range'       => array(
			'px' => array(
				'min'  => 0,
				'max'  => 500,
				'step' => 1,
			),
		),
		'size_units'  => array( 'px' ),
		'condition'   => array(
			'content_cut!' => '',
			'show_description!' => '',
			'type' => array(
				'2',
				'3'
			)
		)
	)
);

$widget->add_control(
	'show_image',
	array(
		'label' => esc_html__('Show Image (Hovered State)', 'gt3_themes_core'),
		'type'  => Controls_Manager::SWITCHER,
		'description' => esc_html__('If checked and post has featured image', 'gt3_themes_core'),
		'default'   => 'yes',
		'condition' => array(
			'type' => '1'
		),
	)
);

$widget->add_responsive_control(
	'height',
	array(
		'label'     => esc_html__('Height (% of window height)', 'gt3_themes_core'),
		'type'      => Controls_Manager::SELECT,
		'options'   => array(
			'30'  => esc_html__('30%', 'gt3_themes_core'),
			'35'  => esc_html__('35%', 'gt3_themes_core'),
			'40'  => esc_html__('40%', 'gt3_themes_core'),
			'45'  => esc_html__('45%', 'gt3_themes_core'),
			'50'  => esc_html__('50%', 'gt3_themes_core'),
			'55'  => esc_html__('55%', 'gt3_themes_core'),
			'60'  => esc_html__('60%', 'gt3_themes_core'),
			'65'  => esc_html__('65%', 'gt3_themes_core'),
			'70'  => esc_html__('70%', 'gt3_themes_core'),
			'75'  => esc_html__('75%', 'gt3_themes_core'),
			'80'  => esc_html__('80%', 'gt3_themes_core'),
			'85'  => esc_html__('85%', 'gt3_themes_core'),
			'90'  => esc_html__('90%', 'gt3_themes_core'),
			'95'  => esc_html__('95%', 'gt3_themes_core'),
			'100' => esc_html__('100%', 'gt3_themes_core'),
		),
		'default'   => '100',
		'condition' => array(
			'type!' => '1'
		),
		'selectors' => array(
			'{{WRAPPER}}.type-2 .portfolio_wrapper, {{WRAPPER}}.type-3 .portfolio_wrapper' => 'height: {{VALUE}}vh; min-height: {{VALUE}}vh;',
		),
	)
);

$widget->end_controls_section();

$widget->start_controls_section(
	'section',
	array(
		'label' => esc_html__('Style', 'gt3_themes_core'),
		'tab'   => Controls_Manager::TAB_STYLE
	)
);

$widget->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'      => 'title_typography',
		'label'     => esc_html__('Title Typography', 'gt3_themes_core'),
		'selector'  => '{{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle .portfolio_item_wrap > a',
	)
);

$widget->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'      => 'categories_typography',
		'label'     => esc_html__('Meta Typography', 'gt3_themes_core'),
		'condition' => array(
			'show_category!' => '',
			'show_date!' => '',
		),
		'selector'  => '{{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle .portfolio_item_wrap, {{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle .portfolio_item_text span',
	)
);

$widget->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'      => 'descr_typography',
		'label'     => esc_html__('Description Typography', 'gt3_themes_core'),
		'condition'   => array(
			'show_description!' => '',
			'type' => array(
				'2',
				'3'
			)
		),
		'selector'  => '{{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle .portfolio_item_text p',
	)
);

$widget->add_control(
	'title_color',
	array(
		'label'       => esc_html__('Text Color', 'gt3_themes_core'),
		'type'        => Controls_Manager::COLOR,
		'label_block' => false,
		'selectors'   => array(
			'{{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle .portfolio_item_wrap, {{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle .portfolio_item_text' => 'color: {{VALUE}};',
		),
	)
);

$widget->add_control(
	'title_color_active',
	array(
		'label'       => esc_html__('Active Text Color', 'gt3_themes_core'),
		'type'        => Controls_Manager::COLOR,
		'label_block' => false,
		'selectors'   => array(
			'{{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle.type-1 .portfolio_item_wrap:hover, {{WRAPPER}}.elementor-widget-gt3-core-portfoliotitle.type-1 .portfolio_item_wrap.active' => 'color: {{VALUE}};',
		),
		'condition' => array(
			'type' => '1'
		),
	)
);

$widget->end_controls_section();

