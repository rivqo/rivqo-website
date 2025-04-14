<?php
namespace MascotCoreAmiso\Widgets\Testimonials\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREAMISO\Lib;
use MASCOTCOREAMISO\CPT\Testimonials\CPT_Testimonials;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme3 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-cpt-testimonials/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme3';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme3', 'mascot-core-amiso' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
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
		wp_enqueue_style( 'tm-swiper-style' );

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-testimonial-skin-current-theme3', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/testimonials/testimonial-skin-current-theme3' . $direction_suffix . '.css' );

		//register swiper slider
		wp_enqueue_style( 'tm-swiper-style', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/swiper/swiper.min.css' );
		wp_enqueue_script( 'tm-swiper-script', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/swiper/swiper.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'tm-testimonial-thumb-carousel-script', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/widgets/testimonial-thumb-carousel.js', array('jquery'), false, true );

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
		$html = mascot_core_amiso_get_cpt_shortcode_template_part( 'each-item-skin-style-current-theme3', null, 'testimonials/tpl', $settings, true );

		echo $html;
	}
}
