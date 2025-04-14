<?php
namespace MascotCoreAmiso\Widgets\FeatureBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-block-features/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style1';
	}


	public function get_title() {
		return __( 'Skin Style1', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		//Feature Block Skin1 Content
		$this->start_controls_section(
			'feature_skin1_content',
			[
				'label' => esc_html__( 'Feature Contnet', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		//Current Background Styling
		$this->start_controls_section(
			'current_background_styling',
			[
				'label' => esc_html__( 'Current Background Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_current_style');
		$this->start_controls_tab(
			'tabs_current_style_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-amiso'),
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box .icon-box .icon i' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_icon_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box .icon-box .icon i' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'tabs_current_style_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-amiso'),
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box:hover .icon-box .icon i' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box:hover .icon-box .icon i' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();




		//Icon Current Styling
		$this->start_controls_section(
			'current_icon_styling',
			[
				'label' => esc_html__( 'Current Icon Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_current_icon_color',
			[
				'label' => esc_html__( "Custom Icon Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box .icon-box .icon i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_current_icon_color_hover',
			[
				'label' => esc_html__( "Custom Icon Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box:hover .icon-box .icon i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_current_icon_theme_colored',
			[
				'label' => esc_html__( "Make icon Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box .icon-box .icon i' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_current_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box:hover .icon-box .icon i' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);




		$this->end_controls_section();

		//Icon Shadow Current Styling
		$this->start_controls_section(
			'current_icon_shadow_styling',
			[
				'label' => esc_html__( 'Current Shadow Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'current_icon_shadow_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-current-item-style1 .inner-box .icon-box .icon::after' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

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

		//classes


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
		$html = mascot_core_amiso_get_shortcode_template_part( 'block-features-' . $settings['_skin'], null, 'block-features/tpl', $settings, true );

		echo $html;
	}
}