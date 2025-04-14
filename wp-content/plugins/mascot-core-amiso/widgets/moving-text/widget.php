<?php
namespace MascotCoreAmiso\Widgets\MovingText;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Modules\Shapes\Module as Shapes_Module;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_MovingText extends Widget_Base {
    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-moving-text', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/moving-text/moving-text-loader' . $direction_suffix . '.css' );
		}

		wp_register_script( 'tm-moving-text-script', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/widgets/moving-text.js', 'elementor-frontend', '1.0.0', true );
    }

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tm-ele-moving-text';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Moving Text - Amiso', 'mascot-core-amiso' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tm-elementor-widget-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tm' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'mascot-core-hellojs', 'tm-moving-text-script' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
	}

	public function get_keywords() {
		return [ 'moving text', 'movingtext', 'text on path', 'text path', 'word art' ];
	}

	protected function register_content_tab() {
		$mascot_shape = [];
		$mascot_shape['mascot_wave'] = esc_html__( 'Mascot Wave', 'mascot-core-amiso' );
		$mascot_shape['mascot_line_simple'] = esc_html__( 'Mascot Line', 'mascot-core-amiso' );

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'Moving Text', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'mascot-core-amiso' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'rows' => 3,
				'label_block' => true,
				'default' => esc_html__( 'Sample Moving Text', 'mascot-core-amiso' ),
				'frontend_available' => true,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'path',
			[
				'label' => esc_html__( 'Path Type', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SELECT,
				'options' => $mascot_shape + Shapes_Module::get_paths(),
				'default' => 'mascot_line_simple',
			]
		);

		$this->add_control(
			'custom_path',
			[
				'label' => esc_html__( 'SVG', 'mascot-core-amiso' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [
					'svg',
				],
				'condition' => [
					'path' => 'custom',
				],
				'dynamic' => [
					'active' => true,
				],
				'description' => sprintf( esc_html__( 'Want to create custom text paths with SVG?' , 'mascot-core-amiso' ).' <a target="_blank" href="%s">Learn More</a>', 'https://go.elementor.com/text-path-create-paths' ),
			]
		);

		$this->add_control(
			'svg_animation',
			[
				'label' => esc_html__( 'Animation', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
                    'none' => esc_html__('None', 'mascot-core-amiso'),
                    'scroll' => esc_html__('Scroll', 'mascot-core-amiso'),
                    'loop' => esc_html__('Loop', 'mascot-core-amiso'),
                ],
				'default' => 'loop',
			]
		);

		$this->add_control(
            'stop_hover',
            [
                'label' => esc_html__('Stop on Hover', 'mascot-core-amiso'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'mascot-core-amiso' ),
				'label_off' => esc_html__( 'Off', 'mascot-core-amiso' ),
				'default' => 'yes',
				'condition' => [
					'svg_animation' => 'loop',
				],
            ]
        );

		$this->add_control(
			'divider_text',
			[
				'label' => esc_html__( 'Add Divider', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'mascot-core-amiso' ),
				'label_off' => esc_html__( 'Off', 'mascot-core-amiso' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'divider_type',
			[
				'label' => esc_html__( 'Type', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
                    'line' => esc_html__('Line', 'mascot-core-amiso'),
                    'star' => esc_html__('Star', 'mascot-core-amiso'),
					'arrow' => esc_html__('Arrow', 'mascot-core-amiso'),
                    'custom' => esc_html__('Custom', 'mascot-core-amiso'),
                ],
				'condition' => [
					'divider_text' => 'yes',
				],
				'default' => 'custom',
			]
		);

		$this->add_control(
			'divider_custom',
			[
				'label' => esc_html__( 'Divider Custom', 'mascot-core-amiso' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '●', 'mascot-core-amiso' ),
				'frontend_available' => true,
				'render_type' => 'template',
				'condition' => [
					'divider_type' => 'custom',
					'divider_text' => 'yes',
				]
			]
		);

		$this->add_control(
			'clone_text',
			[
				'label' => esc_html__( 'Clone Text', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'mascot-core-amiso' ),
				'label_off' => esc_html__( 'Off', 'mascot-core-amiso' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
            'backspace_count',
            [
                'label' => esc_html__('Space After Cloned Element', 'mascot-core-amiso'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
				'condition' => [
					'clone_text' => 'yes',
					'path!' => 'mascot_line_simple',
				],
                'default' => 1,
            ]
        );

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'mascot-core-amiso' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Paste URL or type', 'mascot-core-amiso' ),
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'mascot-core-amiso' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => '',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'mascot-core-amiso' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'mascot-core-amiso' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'mascot-core-amiso' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--alignment: {{VALUE}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'show_path',
			[
				'label' => esc_html__( 'Show Path', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'mascot-core-amiso' ),
				'label_off' => esc_html__( 'Off', 'mascot-core-amiso' ),
				'separator' => 'before',
				'default' => '',
				'condition' => [
					'path!' => 'mascot_line_simple',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--path-stroke: {{VALUE}}; --path-fill: transparent;',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls under style tab.
	 */
	protected function register_style_tab() {

		$this->start_controls_section(
			'section_style_svg',
			[
				'label' => esc_html__( 'SVG', 'mascot-core-amiso' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__('Margin', 'mascot-core-amiso'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .simple_line' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
		/**
		 * Text styling section.
		 */
		$this->start_controls_section(
			'section_style_text_path',
			[
				'label' => esc_html__( 'Text Styling', 'mascot-core-amiso' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'text_path_bg_color',
            [
                'label' => esc_html__('Background Color', 'mascot-core-amiso'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
 				'condition' => [
					'path' => ['mascot_line_simple']
				],
                'selectors' => [
                    '{{WRAPPER}} .tm-moving-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 10,
					],
					'px' => [
						'min' => 0,
						'max' => 8000,
						'step' => 50,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rotation',
			[
				'label' => esc_html__( 'Rotate', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => '',
				],
				'tablet_default' => [
					'unit' => 'deg',
					'size' => '',
				],
				'mobile_default' => [
					'unit' => 'deg',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--rotate: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_heading',
			[
				'label' => esc_html__( 'Text', 'mascot-core-amiso' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}}',
				'fields_options' => [
					'font_size' => [
						'default' => [
							'size' => '40',
							'unit' => 'px',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'word_spacing',
			[
				'label' => esc_html__( 'Word Spacing', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 20,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => '',
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--word-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'animation_speed',
            [
                'label' => esc_html__('Animation Duration', 'mascot-core-amiso'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 10000,
				'condition' => [
					'svg_animation' => 'loop',
				],
				'frontend_available' => true,
				'render_type' => 'none',
            ]
        );

		$this->add_responsive_control(
			'start_point',
			[
				'label' => esc_html__( 'Starting Point', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
                    '%' => ['min' => -1000, 'max' => 1000],
                ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--start-point: {{SIZE}}%;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'end_point',
			[
				'label' => esc_html__( 'Ending Point', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
                    '%' => ['min' => -1000, 'max' => 1000],
                ],
				'default' => [
					'unit' => '%',
					'size' => -10,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--end-point:{{SIZE}}%;',
				],
				'frontend_available' => true,
				'condition' => [
					'svg_animation!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'text_style' );

		/**
		 * Normal tab.
		 */
		$this->start_controls_tab(
			'text_normal',
			[
				'label' => esc_html__( 'Normal', 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'text_color_normal',
			[
				'label' => esc_html__( 'Fill Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				//'default' => WGL_Globals::get_h_font_color(),
				'selectors' => [
					'{{WRAPPER}} svg text' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .text--word' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_theme_colored',
			[
				'label' => esc_html__( "Fill Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg text' => 'fill: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .text--word' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_responsive_control(
            'stroke_text_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'mascot-core-amiso' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} svg textPath' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .text--word' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'stroke_text_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg textPath, {{WRAPPER}} svg text' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .text--word' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stroke_text_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg textPath, {{WRAPPER}} svg text' => 'stroke: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .text--word' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->end_controls_tab();

		/**
		 * Hover tab.
		 */
		$this->start_controls_tab(
			'text_hover',
			[
				'label' => esc_html__( 'Hover', 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( 'Fill Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg text:hover' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .text--word:hover .text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_theme_colored_hover',
			[
				'label' => esc_html__( "Fill Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg text:hover' => 'fill: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .text--word:hover .text' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_responsive_control(
            'stroke_text_width_hover',
            [
                'label' => esc_html__( 'Stroke Width', 'mascot-core-amiso' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} svg text:hover textPath, {{WRAPPER}} svg text:hover' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .text--word:hover .text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'stroke_text_color_hover',
			[
				'label' => esc_html__( 'Stroke Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg text:hover textPath, {{WRAPPER}} svg text:hover' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .text--word:hover .text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stroke_text_theme_colored_hover',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} svg text:hover textPath, {{WRAPPER}} svg text:hover' => 'stroke: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .text--word:hover .text' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'mascot-core-amiso' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
					'unit' => 's',
				],
				'range' => [
					's' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--transition: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/**
		 * Path styling section.
		 */
		$this->start_controls_section(
			'section_style_divider',
			[
				'label' => esc_html__( 'Divider Styling', 'mascot-core-amiso' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'divider_text!' => '',
				],
			]
		);


        $this->add_responsive_control(
            'top_offset',
            [
                'label' => esc_html__('Top Offset', 'mascot-core-amiso'),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
				'step' => 1,
				'default' => '-3',
				'selectors' => [
					'{{WRAPPER}}' => '--top-offset: {{VALUE}};',
					'{{WRAPPER}} .text--word .divider' => 'top: {{VALUE}}px;',
				],
			]
        );

		$this->add_responsive_control(
            'left_offset',
            [
                'label' => esc_html__('Left Offset', 'mascot-core-amiso'),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
				'step' => 1,
				'default' => '0',
				'selectors' => [
					'{{WRAPPER}}' => '--left-offset: {{VALUE}};',
					'{{WRAPPER}} .text--word .divider' => 'left: {{VALUE}}px;',
				],
			]
        );

		$this->add_control(
		    'divider_arrow_rotate',
		    [
			    'label' => esc_html__('Rotate', 'mascot-core-amiso'),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => ['deg', 'turn'],
			    'range' => [
				    'deg' => ['max' => 360],
				    'turn' => ['min' => 0, 'max' => 1, 'step' => 0.1],
			    ],
			    'default' => ['unit' => 'deg', 'size' => 45],
				'condition' => [
					'divider_type' => 'arrow',
				],
			    'selectors' => [
				    '{{WRAPPER}} .divider svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
			    ],
		    ]
	    );

		$this->add_responsive_control(
            'divider_margin',
            [
                'label' => esc_html__('Margin', 'mascot-core-amiso'),
                'type' => Controls_Manager::DIMENSIONS,
	            'default' => [
		            'top' => '',
		            'right' => '23',
		            'bottom' => '',
		            'left' => '11',
		            'unit'  => 'px',
		            'isLinked' => false
	            ],
                'allowed_dimensions' => 'horizontal',
                'size_units' => ['px', 'em', '%'],
				'condition' => [
					'path' => 'mascot_line_simple',
				],
                'selectors' => [
                    '{{WRAPPER}} .text--word .divider' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'arrow_size',
            [
                'label' => esc_html__('Size', 'mascot-core-amiso'),
                'type' => Controls_Manager::SLIDER,
				'condition' => [
					'divider_type' => 'arrow',
				],
                'range' => [
                    'px' => ['min' => 0, 'max' => 250 ],
                ],
				'default' => ['size' => 91],
                'selectors' => [
                    '{{WRAPPER}} .divider svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'divider_typography',
				'condition' => [
					'divider_type!' => 'arrow',
				],
				'fields_options' => [
					'typography' => [
						'default' => 'yes',
					],
					'font_size' => [
						'default' => [ 'size' => '29', 'unit' => 'px' ]
					],
				],
				'selector' => '{{WRAPPER}} tspan.divider, {{WRAPPER}} .divider svg, {{WRAPPER}} .text--word .divider',
			]
		);


		$this->start_controls_tabs( 'divider_style' );

		/**
		 * Normal tab.
		 */
		$this->start_controls_tab(
			'divider_normal',
			[
				'label' => esc_html__( 'Normal', 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'divider_fill_normal',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				//'default' => WGL_Globals::get_primary_color(),
				'selectors' => [
					'{{WRAPPER}} tspan.divider' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .divider svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .text--word .divider' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'divider_fill_theme_colored_normal',
			[
				'label' => esc_html__( "Fill Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} tspan.divider' => 'fill: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .divider svg' => 'fill: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .text--word .divider' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'stroke_divider_heading_normal',
			[
				'label' => esc_html__( 'Stroke', 'mascot-core-amiso' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'stroke_divider_color_normal',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} tspan.divider' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .divider svg' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .text--word .divider' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stroke_divider_theme_colored_normal',
			[
				'label' => esc_html__( "Fill Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} tspan.divider' => 'stroke: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .divider svg' => 'stroke: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .text--word .divider' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'stroke_divider_width_normal',
			[
				'label' => esc_html__( 'Width', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} tspan.divider' => 'stroke-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .divider svg' => 'stroke-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .text--word .divider' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		/**
		 * Hover tab.
		 */
		$this->start_controls_tab(
			'divider_hover',
			[
				'label' => esc_html__( 'Hover', 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'divider_fill_hover',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover tspan.divider' => 'fill: {{VALUE}};',
					'{{WRAPPER}}:hover .divider svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}}:hover .text--word .divider' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'divider_fill_theme_colored_hover',
			[
				'label' => esc_html__( "Fill Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover tspan.divider' => 'fill: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .divider svg' => 'fill: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .text--word .divider' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'stroke_divider_heading_hover',
			[
				'label' => esc_html__( 'Stroke', 'mascot-core-amiso' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'stroke_divider_color_hover',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .divider svg' => 'stroke-color: {{VALUE}};',
					'{{WRAPPER}}:hover .text--word .divider' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stroke_divider_theme_colored_hover',
			[
				'label' => esc_html__( "Fill Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .divider svg' => 'stroke-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .text--word .divider' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'stroke_divider_width_hover',
			[
				'label' => esc_html__( 'Width', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover tspan.divider' => 'stroke-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}:hover .divider svg' => 'stroke-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}:hover .text--word .divider' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
            'stroke_divider_transition',
            [
                'label' => esc_html__('Transition Duration', 'mascot-core-amiso'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => ['min' => 0, 'max' => 2, 'step' => 0.1 ],
                ],
                'default' => ['size' => 0.4, 'unit' => 's'],
                'selectors' => [
                    '{{WRAPPER}} tspan.divider, {{WRAPPER}} .divider svg' => 'transition: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Path styling section.
		 */
		$this->start_controls_section(
			'section_style_path',
			[
				'label' => esc_html__( 'Path', 'mascot-core-amiso' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_path!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'path_style' );

		/**
		 * Normal tab.
		 */
		$this->start_controls_tab(
			'path_normal',
			[
				'label' => esc_html__( 'Normal', 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'path_fill_normal',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => '--path-fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stroke_heading_normal',
			[
				'label' => esc_html__( 'Stroke', 'mascot-core-amiso' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'stroke_color_normal',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stroke_width_normal',
			[
				'label' => esc_html__( 'Width', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--stroke-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		/**
		 * Hover tab.
		 */
		$this->start_controls_tab(
			'path_hover',
			[
				'label' => esc_html__( 'Hover', 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'path_fill_hover',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => '--path-fill-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stroke_heading_hover',
			[
				'label' => esc_html__( 'Stroke', 'mascot-core-amiso' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'stroke_color_hover',
			[
				'label' => esc_html__( 'Color', 'mascot-core-amiso' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => '--stroke-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stroke_width_hover',
			[
				'label' => esc_html__( 'Width', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--stroke-width-hover: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'stroke_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
					'unit' => 's',
				],
				'range' => [
					's' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--stroke-transition: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_content_tab();
		$this->register_style_tab();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-moving-text-current-item-style1', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/moving-text/moving-text-current-item-style1' . $direction_suffix . '.css' );

		if ( 'mascot_wave' === $settings['path'] ) {
			$path_svg = '
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080">
					<g>
						<path d="M-724.4,671.5c47.9,17.5,93.6,25.9,139.6,25.9c105.3,0,186.5-43.2,272.5-88.9
							c86.4-45.9,175.7-93.4,290.1-93.4s203.8,47.5,290.1,93.4c86,45.7,167.2,88.9,272.5,88.9c105.3,0,186.5-43.2,272.5-88.9
							c86.4-45.9,175.7-93.4,290.1-93.4c114.4,0,203.7,47.5,290.1,93.4c86,45.7,167.2,88.9,272.5,88.9c105.3,0,186.5-43.2,272.5-88.9
							c86.4-45.9,175.7-93.4,290.1-93.4c114.4,0,203.8,47.5,290.1,93.4c86,45.7,167.2,88.9,272.5,88.9c46,0,91.6-8.5,139.6-25.9"/>
					</g>
				</svg>';
		}elseif ( 'mascot_line_simple' === $settings['path'] ) {
			$path_svg = '<div class="simple_line"></div>';
		}
		elseif ( 'custom' !== $settings['path'] ) {
			$path_svg = method_exists('Elementor\Modules\Shapes\Module', 'get_path_url') ? Shapes_Module::get_path_url( $settings['path'] ) : '';
			$path_svg = file_get_contents( $path_svg );
		} else {
			$url = $settings['custom_path']['url'];
			$path_svg = ( 'svg' === pathinfo( $url, PATHINFO_EXTENSION ) ) ? file_get_contents( $url ) : '';
		}

		$this->add_render_attribute(
            'text_path',
            [
                'class' => [
                    'tm-moving-text',
                    'none' !== $settings[ 'svg_animation' ] ? $settings[ 'svg_animation' ] . '_animation' : '',
					!empty($settings['hover_animation']) ? 'elementor-animation-' . $settings['hover_animation'] : '',
					!empty($settings['clone_text']) ? 'clone_text' : '',
					!empty($settings['divider_text']) ? 'add_divider' : '',
					'loop' === $settings[ 'svg_animation' ] && !empty($settings['stop_hover']) ? 'stop_on_hover' : '',
                ],
            ]
		);

		if ( ! empty( $settings['clone_text'] ) ) {
			$this->add_render_attribute( 'text_path', 'data-backspace-count', $settings['backspace_count'] );
		}

		if ( ! empty( $settings['divider_text'] ) ) {
			$this->add_render_attribute( 'text_path', 'data-d-type', $settings['divider_type'] );
			if ( 'custom' === $settings['divider_type'] ) {
				$this->add_render_attribute( 'text_path', 'data-d-custom', !empty($settings['divider_custom']) ? $settings['divider_custom'] : '.');
			}
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'text_path' ); ?> data-type-svg="<?php echo $settings['path']; ?>" data-text="<?php echo $settings['text']; ?>">
			<?php echo $path_svg; ?>
		</div>
		<?php
	}
}
