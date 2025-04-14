<?php
namespace MascotCoreAmiso\Widgets\Testimonials;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

use MASCOTCOREAMISO\Lib;
use MASCOTCOREAMISO\CPT\Testimonials\CPT_Testimonials;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Testimonials extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-testimonials-style', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/testimonials/testimonials-loader' . $direction_suffix . '.css' );
		}

		//register swiper slider
		wp_register_style( 'tm-swiper-style', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/swiper/swiper.min.css' );
		wp_register_script( 'tm-swiper-script', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/swiper/swiper.min.js', array('jquery'), false, true );
		wp_register_script( 'tm-testimonial-thumb-carousel-script', MASCOT_CORE_AMISO_URL_PATH . 'assets/js/widgets/testimonial-thumb-carousel.js', array('jquery'), false, true );
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
		return 'tm-ele-cpt-testimonials';
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
		return esc_html__( 'Testimonials Grid', 'mascot-core-amiso' );
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
		$this->add_skin( new Skins\Skin_Style_Current_Theme1( $this ) );
		$this->add_skin( new Skins\Skin_Style_Current_Theme2( $this ) );
		$this->add_skin( new Skins\Skin_Style_Current_Theme3( $this ) );
		$this->add_skin( new Skins\Skin_Style_Current_Theme4( $this ) );
		$this->add_skin( new Skins\Skin_StyleAllCenter( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Style3( $this ) );
		$this->add_skin( new Skins\Skin_Style4( $this ) );
		$this->add_skin( new Skins\Skin_Style_Thumb( $this ) );
	}

	protected function get_supported_ids() {
		$new_cpt_class = CPT_Testimonials::Instance();
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
			'post_type' => $new_cpt_class->ptKey,
			'post_status' => 'publish'
		) );

		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$supported_ids[get_the_ID()] = get_the_title();
			}
		}

		return $supported_ids;
	}

	public function get_supported_taxonomies() {
		$new_cpt_class = CPT_Testimonials::Instance();
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => $new_cpt_class->ptTaxKey,
			'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
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
		$new_cpt_class = CPT_Testimonials::Instance();
		$posts_array = mascot_core_amiso_get_post_list_array_by_post_type( $new_cpt_class->ptKey );
		$orderby_parameters_list = mascot_core_amiso_orderby_parameters_list();

		$this->start_controls_section(
			'general', [
				'label' => esc_html__( 'General', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class', [
				'label' => esc_html__( "Custom CSS class", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core-amiso' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'display_type', [
				'label' => esc_html__( "Display Type", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'  =>  esc_html__( 'Grid', 'mascot-core-amiso' ),
					'masonry' =>  esc_html__( 'Masonry', 'mascot-core-amiso' ),
					'carousel'  =>  esc_html__( 'Carousel', 'mascot-core-amiso' ),
					'thumb-carousel' =>  esc_html__( 'Thumb Carousel', 'mascot-core-amiso' ),
					'single-testimonial' =>  esc_html__( 'Single Testimonial', 'mascot-core-amiso' )
				],
				'default' => 'grid'
			]
		);
		$this->add_control(
			'columns', [
				'label' => esc_html__( "Columns Layout", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  =>  '1',
					'2'  =>  '2',
					'3'  =>  '3',
					'4'  =>  '4',
					'5'  =>  '5',
					'6'  =>  '6',
				],
				'default' => '3'
			]
		);

		//responsive grid layout
		mascot_core_amiso_elementor_grid_responsive_columns($this);

		$this->add_control(
			'gutter',
			[
				'label' => esc_html__( "Gutter", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_isotope_gutter_list_elementor(),
				'default' => 'gutter-15',
				'condition' => [
					'display_type' => array('grid', 'masonry', 'masonry-tiles')
				]
			]
		);
		$this->add_control(
			'custom_quote_icon',
			[
				'label' => esc_html__( "Custom Quote Icon", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload the custom quote icon", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'custom_quote_icon_opacity',
			[
				'label' => esc_html__( "Custom Quote Icon Opacity", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Set opacity to the custom quote icon. Opacity value must be between 0 to 1", 'mascot-core-amiso' ),
			]
		);
		$this->add_control(
			'custom_quote_icon_alignment', [
				'label' => esc_html__( "Custom Quote Icon Alignment", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'custom-quote-icon-left'  =>  'Left',
					'custom-quote-icon-center'  =>  'Center',
					'custom-quote-icon-right'  =>  'Right',
				],
				'default' => 'custom-quote-icon-left'
			]
		);

		$this->end_controls_section();



		//Query Options
		$this->start_controls_section(
		'query', [
				'label' => esc_html__( 'Query', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'total_items', [
				'label' => esc_html__( "Number of Items to Query from Database", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "How many items do you wish to show? Put -1 to show all. Default 3", 'mascot-core-amiso' ),
				'default' => '3'
			]
		);
		$this->add_control(
			'show_only_selected_single_post', [
				'label' => esc_html__( "Show Only Selected Single Item", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'selected_single_post', [
				'label' => esc_html__( "Choose Single Item", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $posts_array,
				'condition' => [
					'show_only_selected_single_post' => array('yes')
				]
			]
		);
		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);
		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'mascot-core-amiso' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);
		$this->add_control(
			'order_by', [
				'label' => esc_html__( "Order By", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $orderby_parameters_list,
			]
		);
		$this->add_control(
			'order', [
				'label' => esc_html__( "Order", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'DESC' => esc_html__( 'Descending', 'mascot-core-amiso' ),
					'ASC' => esc_html__( 'Ascending', 'mascot-core-amiso' ),
				],
			]
		);

		$this->end_controls_section();



		//Content Options
		$this->start_controls_section(
			'content_section', [
				'label' => esc_html__( 'Content', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_thumb', [
				'label' => esc_html__( "Show Thumb", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'feature_thumb_image_size', [
				'label' => esc_html__( "Thumbnail Image Size", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'thumbnail',
				'condition' => [
					'show_thumb' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_testimonial_text', [
				'label' => esc_html__( "Show Testimonial Text", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'testimonial_text_length', [
				'label' => esc_html__( "Testimonial Text Length", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Number of words to display", 'mascot-core-amiso' ),
				'condition' => [
					'show_testimonial_text' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_testimonial_title', [
				'label' => esc_html__( "Show Testimonial Title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'title_tag', [
				'label' => esc_html__( "Title Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h5',
				'condition' => [
					'show_testimonial_title' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_author_name', [
				'label' => esc_html__( "Show Author Name", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'author_name_tag', [
				'label' => esc_html__( "Author Name Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h5',
				'condition' => [
					'show_author_name' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_rating', [
				'label' => esc_html__( "Show Rating", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_quote_icon', [
				'label' => esc_html__( "Show Default Quote Icon", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'show_author_job_position', [
				'label' => esc_html__( "Show Job Position", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'show_author_company', [
				'label' => esc_html__( "Show Company", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->end_controls_section();





		//Carousel Options
		$this->start_controls_section(
			'carousel_options', [
				'label' => esc_html__( 'Carousel Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 2, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 3, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 4, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 5, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 6, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 7, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 8, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 9, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 10, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 11, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 12, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 13, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 14, '', array('display_type' => array('carousel') ) );
		$this->end_controls_section();

		//Carousel Arrow Navigation Options
		$this->start_controls_section(
			'carousel_arrow_nav_options', [
				'label' => esc_html__( 'Carousel Arrow Navigation Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_nav_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_nav_arraylist( $this, 2, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 3, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 4, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 5, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 6, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 7, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 8, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 9, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 10, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 11, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 12, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 13, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 14, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 15, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 16, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 17, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 18, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 19, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 20, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 21, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 22, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 23, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 24, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 25, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 26, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 27, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 28, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 29, '');
		$this->end_controls_section();






		//Carousel Arrow Navigation Options
		$this->start_controls_section(
			'carousel_arrow_nav_bs5_breakpoints_options', [
				'label' => esc_html__( 'Carousel Arrow Nav Bootstrap5 Breakpoints', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 1, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 2, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 3, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 4, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 5, '');

		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 6, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 7, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 8, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 9, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 10, '');
		$this->end_controls_section();






		//Carousel Bullets/Dots Options
		$this->start_controls_section(
			'carousel_arrow_dots_options', [
				'label' => esc_html__( 'Carousel Bullets/Dots Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_dots_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_dots_arraylist( $this, 2, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 3, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 4, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 5, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 6, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 7, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 8, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 9, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 10, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 11, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 12, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 13, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 14, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 15, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 16, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 17, '');
		$this->end_controls_section();







		//Category Filter
		$this->start_controls_section(
			'cat_filter_section', [
				'label' => esc_html__( 'Category Filter', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_cat_filter_arraylist( $this, 1, array('display_type' => array('grid', 'masonry', 'carousel') ) );
		mascot_core_get_cat_filter_arraylist( $this, 2 );
		mascot_core_get_cat_filter_arraylist( $this, 3 );
		mascot_core_get_cat_filter_arraylist( $this, 4 );

		$this->end_controls_section();









		$this->start_controls_section(
			'author_text_section_styling',
			[
				'label' => esc_html__( 'Testimonial Text Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_text_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .author-text',
			]
		);
		$this->add_responsive_control(
			'author_text_margin',
			[
				'label' => esc_html__( 'Text Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .author-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_text_padding',
			[
				'label' => esc_html__( 'Text Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .author-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'author_text_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'author_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .author-text' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'author_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .author-text' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .author-text' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'author_text_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .author-text' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'name_section_styling',
			[
				'label' => esc_html__( 'Author Name Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .name',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'label' => esc_html__( 'Name Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'name_padding',
			[
				'label' => esc_html__( 'Name Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'name_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'name_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .name' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'name_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'name_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .name' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'job_position_section_styling',
			[
				'label' => esc_html__( 'Job Position Styling', 'mascot-core-amiso' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'job_position_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} .job-position',
			]
		);
		$this->add_responsive_control(
			'job_position_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .job-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'job_position_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .job-position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'job_position_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'job_position_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .job-position' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'job_position_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .job-position' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'job_position_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .job-position' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'job_position_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .job-position' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();
	}



	public function query_posts($class_instance) {
		$settings = $this->get_settings_for_display();
		$paged = isset($settings['paged']) ? $settings['paged'] : '';
		$new_cpt_class = $class_instance;

		//if single post selected
		if( $settings['show_only_selected_single_post'] == 'yes' && !empty( $settings['selected_single_post'] )) {
			//query args
			$args = array(
				'p' => $settings['selected_single_post'],
				'post_type' => $new_cpt_class['ptKey'],
			);
		} else {
			//query args
			$args = array(
				'post_type' => $new_cpt_class['ptKey'],
				'orderby' => $settings['order_by'],
				'order' => $settings['order'],
				'posts_per_page' => $settings['total_items'],
				'paged' => $paged,
			);


			if( ! empty( $settings['ids'] ) ) {
				$args['post__in'] = $settings['ids'];
			}

			if( ! empty( $settings['category'] ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $new_cpt_class['ptTaxKey'],
						'field'    => 'term_id',
						'terms'    => $settings['category'],
					),
				);
			}
		}

		//if order by testimonial_author_name selected
		if( $settings['order_by'] == 'testimonial_author_name' ) {
			$args['meta_key'] = 'amiso_' . 'cpt_author_name';
			$args['orderby']  = 'meta_value';
		}

		return $the_query = new \WP_Query( $args );
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

		$new_cpt_class = CPT_Testimonials::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = amiso_get_isotope_holder_ID('testimonials');


		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->query_posts($new_cpt_class);

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-testimonial-skin-style1', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/cpt/testimonials/testimonial-skin-style1' . $direction_suffix . '.css' );

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