<?php
namespace MascotCoreElementor\Widgets\VerticalBgImgList;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Vertical_Bg_Img_List extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-vertical-bg-img-list-style', MASCOT_CORE_ELEMENTOR_URL_PATH . 'assets/css/shortcodes/vertical-bg-img-list/vertical-bg-img-list-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-vertical-bg-img-list';
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
		return esc_html__( 'Vertical Bg Img List', 'mascot-core' );
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
		return [ 'mascot-core-hellojs' ];
	}

	public function get_style_depends() {
		return [ 'tm-vertical-bg-img-list-style' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style2( $this ) );
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
		$this->start_controls_section(
			'general', [
				'label' => esc_html__( 'General', 'mascot-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'slide_image', [
				'label' => __( 'Image', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'slide_subtitle', [
				'label' => __( 'Sub Title', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'slide_title', [
				'label' => __( 'Title', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'slide_description', [
				'label' => __( 'Description', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'slide_link_title', [
				'label' => __( 'Link Title', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'slide_link', [
				'label' => __( 'Link URL', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			]
		);
		$this->add_control(
			'slides',
			[
				'label' => __( 'Column Images (Maximum 4)', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ slide_title }}}',
				'default' => [
					[
						'slide_image' => Utils::get_placeholder_image_src(),
						'slide_subtitle' => __( '01', 'mascot-core' ),
						'slide_title' => __( 'Title 1', 'mascot-core' ),
						'slide_description' => __( 'Write a short description, that will describe something useful', 'mascot-core' ),
						'slide_link_title' => __( 'Read More', 'mascot-core' ),
					],
					[
						'slide_image' => Utils::get_placeholder_image_src(),
						'slide_subtitle' => __( '02', 'mascot-core' ),
						'slide_title' => __( 'Title 2', 'mascot-core' ),
						'slide_description' => __( 'Write a short description, that will describe something useful', 'mascot-core' ),
						'slide_link_title' => __( 'Read More', 'mascot-core' ),
					],
					[
						'slide_image' => Utils::get_placeholder_image_src(),
						'slide_subtitle' => __( '03', 'mascot-core' ),
						'slide_title' => __( 'Title 3', 'mascot-core' ),
						'slide_description' => __( 'Write a short description, that will describe something useful', 'mascot-core' ),
						'slide_link_title' => __( 'Read More', 'mascot-core' ),
					],
					[
						'slide_image' => Utils::get_placeholder_image_src(),
						'slide_subtitle' => __( '04', 'mascot-core' ),
						'slide_title' => __( 'Title 4', 'mascot-core' ),
						'slide_description' => __( 'Write a short description, that will describe something useful', 'mascot-core' ),
						'slide_link_title' => __( 'Read More', 'mascot-core' ),
					],
				],
			]
		);

		/** End slides repeat list */

		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h6',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h3'
			]
		);
		$this->add_responsive_control(
		    'height',
		    [
		        'label' => __( 'Height', 'mascot-core' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 600,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 2000,
		                'step' => 5,
		            ],
		            'vh' => [
		                'min' => 5,
		                'max' => 100,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px', 'vh' ],
		        'selectors' => [
		            '{{WRAPPER}} .each-vertical-column' => 'min-height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'transition',
		    [
		        'label' => __( 'Transition (in milliseconds)', 'mascot-core' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 800,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 10000,
		                'step' => 100,
		            ]
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .vertical-bg-img-list .bg-img' => 'transition-duration: {{SIZE}}ms;',
		        ],

		    ]
		);

		$this->add_control(
		    'background_overlay',
		    [
		        'label' => __( 'Background Overlay', 'mascot-core' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(0,0,0,0.3)',
		        'selectors' => [
		            '{{WRAPPER}} .vertical-bg-img-list .bg-overlay' => 'background: {{VALUE}}',
		        ],
		    ]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Link Options', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_button_arraylist($this, 1);
		mascot_core_get_button_arraylist($this, 2);
		mascot_core_get_button_arraylist($this, 3);
		mascot_core_get_button_arraylist($this, 4);
		mascot_core_get_button_arraylist($this, 5);
		mascot_core_get_button_arraylist($this, 6);
		mascot_core_get_button_arraylist($this, 7);
		mascot_core_get_button_arraylist($this, 8);
		mascot_core_get_button_arraylist($this, 9);
		mascot_core_get_button_arraylist($this, 10);
		mascot_core_get_button_arraylist($this, 11);
		mascot_core_get_button_arraylist($this, 12);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Link Color/Typography', 'mascot-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_button_text_color_typo_arraylist($this, 1);
		mascot_core_get_button_text_color_typo_arraylist($this, 2);
		mascot_core_get_button_text_color_typo_arraylist($this, 3);
		mascot_core_get_button_text_color_typo_arraylist($this, 4);
		mascot_core_get_button_text_color_typo_arraylist($this, 5);
		mascot_core_get_button_text_color_typo_arraylist($this, 6);
		mascot_core_get_button_text_color_typo_arraylist($this, 7);
		mascot_core_get_button_text_color_typo_arraylist($this, 8);
		mascot_core_get_button_text_color_typo_arraylist($this, 9);
		$this->end_controls_section();
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

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		if(!empty($settings['slides'])) {
			$count_slides = count($settings['slides']);
			switch($count_slides) {
				case 1:
					$column_class = 'one-column';
				break;

				case 2:
					$column_class = 'two-column';
				break;

				case 3:
					$column_class = 'three-column';
				break;

				case 4:
				default:
					$column_class = 'four-column';
				break;
			}
		}
		$settings['column_class'] = $column_class;
		$settings['count_slides'] = $count_slides;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_get_shortcode_template_part( 'each-list', null, 'vertical-bg-img-list/tpl', $settings, true );

		echo $html;
	}
}