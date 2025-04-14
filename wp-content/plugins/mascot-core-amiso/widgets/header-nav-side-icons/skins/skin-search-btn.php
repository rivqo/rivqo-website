<?php
namespace MascotCoreAmiso\Widgets\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Search_Btn extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-header-nav-side-icons/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-search-btn';
	}


	public function get_title() {
		return __( 'Skin - Search Button', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'search_btn_options',
			[
				'label' => esc_html__( 'Search Icon Options', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'search_btn_typography',
				'label' => esc_html__( 'Icon Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .top-nav-search-btn .search-icon',
			]
		);
		$this->add_control(
			'search_btn_color',
			[
				'label' => esc_html__( "Icon Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .top-nav-search-btn .search-icon' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'search_btn_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .top-nav-search-btn .search-icon' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'search_btn_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .top-nav-search-btn .search-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'search_btn_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .top-nav-search-btn .search-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$html = '';
		$settings = $this->parent->get_settings_for_display();


		//classes
		$classes = array();
		$classes[] = 'tm-sc-header-primary-nav';
		$settings['classes'] = $classes;

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID($settings['_skin']);

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_amiso_get_shortcode_template_part( 'tpl', $settings['_skin'], 'header-nav-side-icons/tpl', $settings, true );

		echo $html;
	}
}
