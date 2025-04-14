<?php
namespace MascotCoreAmiso\Widgets\FeatureBlock;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_BlockFeatures extends Widget_Base {
    public function __construct($data = [], $args = null) {
			parent::__construct($data, $args);
			if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
				$direction_suffix = is_rtl() ? '.rtl' : '';
				wp_enqueue_style( 'tm-block-features', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/block-features/block-features-loader' . $direction_suffix . '.css' );
			}
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
		return 'tm-ele-block-features';
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
		return esc_html__( 'Block Features', 'mascot-core-amiso' );
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


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Style3( $this ) );
		$this->add_skin( new Skins\Skin_Style4( $this ) );
		$this->add_skin( new Skins\Skin_Style5( $this ) );
		$this->add_skin( new Skins\Skin_Style6( $this ) );
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
			'general',
			[
				'label' => esc_html__( 'General', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a section title", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h3'
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a section subtitle", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Subtitle Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h3'
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				]
			]
		);
		$this->add_control(
			'counting_number',
			[
				'label' => esc_html__( "Counting Number", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "01", 'mascot-core-amiso' ),
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Thumb Type", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'font-icon' => esc_html__( 'Font/Flat Icon', 'mascot-core-amiso' ),
					'image' => esc_html__( 'JPG/PNG Image', 'mascot-core-amiso' ),
				],
				'default' => 'font-icon'
			]
		);
		$this->add_control(
			'feature_image',
			[
				'label' => esc_html__( "Thumbnail Image", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'mascot-core-amiso' ),
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'feature_image_hover',
			[
				'label' => esc_html__( "Thumbnail Image (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'mascot-core-amiso' ),
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'feature_image_size',
			[
				'label' => esc_html__( "Choose Image Size", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'full',
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_responsive_control(
			'feature_image_width',
			[
				'label' => esc_html__( "Image Custom Width", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'icon_type' => array('image')
				],
				'selectors' => [
					'{{WRAPPER}} .icon img' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'mascot-core-amiso'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-chart-bar',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('font-icon')
				]
			]
		);


		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'mascot-core-amiso' ),
				"description" => esc_html__( "It will be displayed above/under title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Paragraph Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-details' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Paragraph Color on Hover", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .feature-details' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();













		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Icon Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'mascot-core-amiso' ),
					'rotate' => esc_html__( 'Rotate', 'mascot-core-amiso' ),
					'rotate-x' => esc_html__( 'Rotate X', 'mascot-core-amiso' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'mascot-core-amiso' ),
					'translate'  => esc_html__( 'Translate', 'mascot-core-amiso' ),
					'translate-x'  => esc_html__( 'Translate X', 'mascot-core-amiso' ),
					'translate-y'  => esc_html__( 'Translate Y', 'mascot-core-amiso' ),
					'scale'  => esc_html__( 'Scale', 'mascot-core-amiso' ),
				],
				'default' => '',
			]
		);

		$this->end_controls_section();




		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Title Options', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .feature-title',
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'subtitle_section',
			[
				'label' => esc_html__( 'Subtitle Options', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .feature-subtitle',
			]
		);
		$this->end_controls_section();





		//other settings
		$this->start_controls_section(
			'other_options',
			[
				'label' => esc_html__( 'Other Options', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'box_animation',
			[
				'label' => esc_html__( "Box Animation Style", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  =>  esc_html__( 'No Animation', 'mascot-core-amiso' ),
					'iconbox-style1-current-theme-animation'  =>  esc_html__( 'Style 1 - Current Theme Animation', 'mascot-core-amiso' ),
					'iconbox-style2-border-bottom'  =>  esc_html__( 'Style 2 - Border Bottom', 'mascot-core-amiso' ),
					'iconbox-style3-moving-border-bottom' =>  esc_html__( 'Style 3 - Moving Border Bottom', 'mascot-core-amiso' ),
					'iconbox-style4-bgcolor'  =>  esc_html__( 'Style 4 - Hover BG Color', 'mascot-core-amiso' ),
					'iconbox-style5-moving-bgcolor' =>  esc_html__( 'Style 5 - Hover Moving BG Color', 'mascot-core-amiso' ),
					'iconbox-style6-moving-double-bgcolor'  =>  esc_html__( 'Style 6 - Hover Moving Double BG Color', 'mascot-core-amiso' ),
					'iconbox-style7-hover-moving-border'  =>  esc_html__( 'Style 7 - Hover Moving Border Around Box', 'mascot-core-amiso' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'box_shadow',
			[
				'label' => esc_html__( "Box Shadow?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'box_shadow_on_hover',
			[
				'label' => esc_html__( "Box Shadow only on Hover?", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_viewdetails_button_arraylist($this, 1);
		mascot_core_get_viewdetails_button_arraylist($this, 2);
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
				'label' => esc_html__( 'Button Color/Typography', 'mascot-core-amiso' ),
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


		//link url
		$settings['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';



		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-icon-on-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}
		$settings['classes'] = $classes;

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-block-feature-current-item-style1', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/block-features/block-feature-current-item-style1' . $direction_suffix . '.css' );


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$settings['title_classes'] = $title_classes;

		//subtitle classes
		$subtitle_classes = array();
		$settings['subtitle_classes'] = $subtitle_classes;

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_amiso_get_shortcode_template_part( 'block-features-skin-style1', null, 'block-features/tpl', $settings, true );

		echo $html;
	}
}
