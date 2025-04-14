<?php
namespace MascotCoreAmiso\Widgets\Testimonials\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREAMISO\Lib;
use MASCOTCOREAMISO\CPT\Testimonials\CPT_Testimonials;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-cpt-testimonials/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style2';
	}


	public function get_title() {
		return __( 'Skin - Style2', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .testimonial-skin-style2 .text-holder' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-skin-style2 .text-holder::before' => 'border-top-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-skin-style2:hover .text-holder' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-skin-style2:hover .text-holder::before' => 'border-top-color: {{VALUE}};'
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
					'{{WRAPPER}} .testimonial-skin-style2 .text-holder' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-skin-style2 .text-holder::before' => 'border-top-color: var(--theme-color{{VALUE}});'
				],
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
					'{{WRAPPER}} .testimonial-skin-style2:hover .text-holder' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-skin-style2:hover .text-holder::before' => 'border-top-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'quote_icon_styling',
			[
				'label' => esc_html__( 'Quote Icon Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'default_quote_icon_opacity',
			[
				'label' => esc_html__( "Default Quote Icon Opacity", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .testimonial-skin-style2 .text-holder .author-text:before' => 'opacity: {{VALUE}};'
				],
				"description" => esc_html__( "Set opacity to the default quote icon. Opacity value must be between 0 to 1", 'mascot-core-amiso' ),
			]
		);


		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$new_cpt_class = CPT_Testimonials::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = amiso_get_isotope_holder_ID('testimonials');


		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-testimonial-skin-style2', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/testimonials/testimonial-skin-style2' . $direction_suffix . '.css' );

		//classes
		$classes = array();
		$classes[] = 'tm-sc-'.$settings['_skin'];
		if( $settings['show_quote_icon'] == 'yes' ) {
			$classes[] = 'testimonial-has-quote-icon';
		}
		if( !empty($settings['custom_quote_icon']) ) {
			$classes[] = 'testimonial-has-custom-quote-icon';
		}
		if( !empty($settings['custom_quote_icon_alignment']) ) {
			$classes[] = $settings['custom_quote_icon_alignment'];
		}
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_amiso_get_cpt_shortcode_template_part( 'testimonials', $settings['display_type'], 'testimonials/tpl', $settings, true );

		echo $html;
	}
}
