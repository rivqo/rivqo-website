<?php
namespace MascotCoreAmiso\Widgets\Services\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREAMISO\Lib;
use MASCOTCOREAMISO\CPT\Services\CPT_Services;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme4 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-cpt-services/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme4';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme4', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;


		$this->start_controls_section(
			'current_wrapper_styling',
			[
				'label' => esc_html__( 'Current Skin Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal1',
			[
				'label' => esc_html__('Normal', 'mascot-core-amiso'),
			]
		);
		$this->add_control(
			'content_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .service-inner' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'content_wrapper_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .service-inner' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_control(
			'icon_color_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_custom_bg_color',
			[
				'label' => esc_html__( "Custom Icon Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_control(
			'count_wrapper_bg_color_options',
			[
				'label' => esc_html__( 'Count Bg Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'count_bg_custom_bg_color',
			[
				'label' => esc_html__( "Custom Bg Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .count' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'count_bg_theme_colored',
			[
				'label' => esc_html__( "Make Bg Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .count' => 'background: var(--theme-color{{VALUE}});'
				],
			]
		);



		$this->add_control(
			'count_wrapper_color_options',
			[
				'label' => esc_html__( 'Count Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'count_color_custom_bg_color',
			[
				'label' => esc_html__( "Custom Count Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .count:before' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'count_color_theme_colored',
			[
				'label' => esc_html__( "Make Count Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .count:before' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover1',
			[
				'label' => esc_html__('Hover', 'mascot-core-amiso'),
			]
		);

		$this->add_control(
			'content_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options (Hover)', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .service-inner:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4 .service-inner:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_control(
			'icon_color_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options (Hover)', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Icon Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4:hover .icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4:hover .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'count_wrapper_bg_color_options_hover',
			[
				'label' => esc_html__( 'Count Bg Color Options (Hover)', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'count_bg_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Bg Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4:hover .count' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'count_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Make Bg Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4:hover .count' => 'background: var(--theme-color{{VALUE}});'
				],
			]
		);



		$this->add_control(
			'count_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'Count Color Options (Hover)', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'count_custom_color_hover',
			[
				'label' => esc_html__( "Custom Count Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4:hover .count:before' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'count_theme_colored_hover',
			[
				'label' => esc_html__( "Make Count Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item-current-style4:hover .count:before' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);



		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$new_cpt_class = CPT_Services::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = amiso_get_isotope_holder_ID('services');

		$settings = $this->parent->sercice_custom_icon_img( $settings );
		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-service-skin-current-theme4', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/services/service-skin-current-theme4' . $direction_suffix . '.css' );

		//classes
		$classes = array();
		if( $settings['add_border_radius'] ) {
			$classes[] = 'border-radius-around-box';
		}
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		$html = mascot_core_amiso_get_cpt_shortcode_template_part( 'services', $settings['display_type'], 'services/tpl', $settings, true );

		echo $html;
	}
}
