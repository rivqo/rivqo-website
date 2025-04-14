<?php
namespace MascotCoreAmiso\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Blog_List extends Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-blog-list-style', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/shortcodes/blog-list' . $direction_suffix . '.css' );
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
		return 'tm-ele-blog-list';
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
		return esc_html__( 'Blog/News Widget', 'mascot-core-amiso' );
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
		return [ 'tm-blog-list-style' ];
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
		$posts_array = mascot_core_get_post_list_array_by_post_type( 'post' );
		$categories_array = mascot_core_category_list_array( 'category' );
		$orderby_parameters_list1 = mascot_core_orderby_parameters_list();
		$orderby_parameters_list2 = array(
		);
		$orderby_parameters_list = array_merge( $orderby_parameters_list2, $orderby_parameters_list1 );

		$post_meta_array = array(
			'show-post-by-author' =>  esc_html__( 'Show Author', 'mascot-core-amiso' ),
			'show-post-date'  =>  esc_html__( 'Show Date', 'mascot-core-amiso' ),
			'show-post-date-split'  =>  esc_html__( 'Show Date Split', 'mascot-core-amiso' ),
			'show-post-category'  =>  esc_html__( 'Show Category', 'mascot-core-amiso' ),
			'show-post-comments-count'  =>  esc_html__( 'Show Comments Count', 'mascot-core-amiso' ),
			'show-post-tag' =>  esc_html__( 'Show Tag', 'mascot-core-amiso' ),
			'show-post-like-button'  =>  esc_html__( 'Show Like Button', 'mascot-core-amiso' )
		);

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
		$this->add_control(
			'show_featured_image', [
				'label' => esc_html__( "Show Featured Image", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'img_options', [
				'label' => esc_html__( 'Image Options', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'featured_image_size', [
				'label' => esc_html__( "Featured Image Size", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'thumbnail',
				'condition' => [
					'show_featured_image' => array('yes')
				]
			]
		);
		$this->add_responsive_control(
			'thumb_custom_width',
			[
				'label' => esc_html__( "Custom Thumb Width", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .post-thumb' => 'width: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'thumb_margin_right',
			[
				'label' => esc_html__( "Thumb Margin Right", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .post-thumb' => 'margin-right: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'thumb_margin',
			[
				'label' => esc_html__( 'Thumb Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .post-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





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
			'category', [
				'label' => esc_html__( "Category", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $categories_array,
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
			'content',
			[
				'label' => esc_html__( 'Content Placement', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'vertical_flex_options',
			[
				'label' => esc_html__( 'Vertical Placement Option', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'flex_vertical_value',
			[
				'label' => esc_html__( "Vertical Alignment", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article' => 'align-items: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h6',
				'condition' => [
					'show_title' => array('yes')
				]
			]
		);
		$this->add_control(
			'title_length', [
				'label' => esc_html__( "Title Length", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Number of words to display", 'mascot-core-amiso' ),
				'condition' => [
					'show_title' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_excerpt', [
				'label' => esc_html__( "Show Excerpt", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'excerpt_length', [
				'label' => esc_html__( "Excerpt Length", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Number of words to display", 'mascot-core-amiso' ),
				'condition' => [
					'show_excerpt' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_post_meta',
			[
				'label' => esc_html__( "Show Post Meta", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'post_meta_placement', [
				'label' => esc_html__( "Post Meta Placement", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', 'mascot-core-amiso' ),
					'center' => esc_html__( 'Middle', 'mascot-core-amiso' ),
					'bottom' => esc_html__( 'Bottom', 'mascot-core-amiso' ),
				],
				'default' => 'center',
				'condition' => [
					'show_post_meta' => array('yes')
				]
			]
		);
		$this->add_control(
			'post_meta_options',
			[
				'label' => esc_html__( "Choose Post Meta", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $post_meta_array,
				'multiple' => true,
				'default' => [ 'show-post-date' ],
				'condition' => [
					'show_post_meta' => array('yes')
				]
			]
		);
		$this->end_controls_section();






		//Content Options
		$this->start_controls_section(
			'title_styling_options',
			[
				'label' => esc_html__( 'Title Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} article .entry-title,{{WRAPPER}} article .entry-title a',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} article .entry-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} article .entry-title a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} article .entry-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} article .entry-title a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article .entry-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} article .entry-title a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article .entry-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} article .entry-title a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'meta_styling_options',
			[
				'label' => esc_html__( 'Post Meta Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => esc_html__( 'Post Meta Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} article .entry-meta, {{WRAPPER}} article .entry-meta a, {{WRAPPER}} article .entry-meta .entry-date',
			]
		);
		$this->add_control(
			'meta_text_color',
			[
				'label' => esc_html__( "Meta Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} article .entry-meta, {{WRAPPER}} article .entry-meta a, {{WRAPPER}} article .entry-meta .entry-date' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'meta_text_color_hover',
			[
				'label' => esc_html__( "Meta Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} article:hover .entry-meta' => 'color: {{VALUE}};',
					'{{WRAPPER}} article:hover .entry-meta a' => 'color: {{VALUE}};',
					'{{WRAPPER}} article:hover .entry-meta .entry-date' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'meta_theme_colored',
			[
				'label' => esc_html__( "Meta Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article .entry-meta, {{WRAPPER}} article .entry-meta a, {{WRAPPER}} article .entry-meta .entry-date' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'meta_theme_colored_hover',
			[
				'label' => esc_html__( "Meta Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article:hover .entry-meta' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} article:hover .entry-meta a' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} article:hover .entry-meta .entry-date' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Post Meta Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article .entry-meta, {{WRAPPER}} article .entry-meta a, {{WRAPPER}} article .entry-meta .entry-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'excerpt_styling_options',
			[
				'label' => esc_html__( 'Post Excerpt Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Excerpt Typography', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} article .post-excerpt',
			]
		);
		$this->add_control(
			'excerpt_text_color',
			[
				'label' => esc_html__( "Excerpt Text Color", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} article .post-excerpt' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_text_color_hover',
			[
				'label' => esc_html__( "Excerpt Text Color (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} article:hover .post-excerpt' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_theme_colored',
			[
				'label' => esc_html__( "Excerpt Theme Colored", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article .post-excerpt' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'excerpt_theme_colored_hover',
			[
				'label' => esc_html__( "Excerpt Theme Colored (Hover)", 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} article:hover .post-excerpt' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Excerpt Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();



		//Features
		$this->start_controls_section(
			'list_styling',
			[
				'label' => esc_html__( 'List Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'list_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'label' => esc_html__( 'List Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} article',
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'last_item_options',
			[
				'label' => esc_html__( 'Last Child Styling', 'mascot-core-amiso' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'last_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'last_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'mascot-core-amiso' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} article:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'last_item_border',
				'label' => esc_html__( 'Border', 'mascot-core-amiso' ),
				'selector' => '{{WRAPPER}} article:last-child',
			]
		);
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
		$class_instance =  '';

		if(isset($settings['post_meta_options']) && !empty($settings['post_meta_options'])) {
			$settings['post_meta_options'] = implode(",", $settings['post_meta_options']);
		}

		//if single post selected
		if( $settings['show_only_selected_single_post'] == 'yes' && !empty( $settings['selected_single_post'] )) {
			//query args
			$args = array(
				'p' => $settings['selected_single_post'],
			);
		} else {
			//query args
			$args = array(
				'orderby' => $settings['order_by'],
				'order' => $settings['order'],
				'posts_per_page' => $settings['total_items'],
			);

			//if category selected
			if( $settings['category'] ) {
				$args['category_name'] = $settings['category'];
			}
		}

		$the_query = new \WP_Query( $args );
		$settings['the_query'] = $the_query;

		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_amiso_get_shortcode_template_part( 'blog-list', null, 'blog-list/tpl', $settings, true );

		echo $html;
	}
}