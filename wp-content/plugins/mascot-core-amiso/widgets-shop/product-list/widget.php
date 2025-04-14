<?php
namespace MascotCoreAmiso\Widgets\Product_List;

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
class TM_Elementor_Product_List extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-product-list', MASCOT_CORE_AMISO_URL_PATH . 'assets/css/woo/product-list/product-list-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-product-list';
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
		return esc_html__( 'TM Product List', 'mascot-core-amiso' );
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
		return [ 'tm-product-list' ];
	}

    /**
     * Skins
     */
    protected function register_skins() {
        $this->add_skin( new Skins\Skin_Current_Theme1( $this ) );
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

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'mascot-core-amiso'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'style_list',
            [
                'label'     => esc_html__('List Style', 'mascot-core-amiso'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 1,
                'options'   => [
                    1 => esc_html__('Style 1', 'mascot-core-amiso'),
                    2 => esc_html__('Style 2', 'mascot-core-amiso'),
                ],
            ]
        );

        $options_product_type = [
            'recent_products'      => esc_html__( 'Recent products', 'mascot-core-amiso' ),
            'featured_products'    => esc_html__( 'Featured Products', 'mascot-core-amiso' ),
            'top_rated_products'   => esc_html__( 'Top Rated Products', 'mascot-core-amiso' ),
            'sale_products'        => esc_html__( 'Products on Sale', 'mascot-core-amiso' ),
            'best_selling_products'=> esc_html__( 'Best Selling Products', 'mascot-core-amiso' )
        ];

        if (mascot_core_amiso_is_elementor_pro_activated()) {
            $options_product_type['ids'] = esc_html__('Product Ids', 'mascot-core-amiso');
        }

        $this->add_control(
            'product_type',
            [
                'label'   => esc_html__('Product Type', 'mascot-core-amiso'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent_products',
                'options' => $options_product_type,
            ]
        );

        if (mascot_core_amiso_is_elementor_pro_activated()) {
            $this->add_control(
                'product_ids',
                [
                    'label'        => esc_html__('Product ids', 'mascot-core-amiso'),
                    'type'         => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'label_block'  => true,
                    'autocomplete' => [
                        'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'product',
                        ],
                    ],
                    'multiple'     => true,
                    'condition'    => [
                        'product_type' => 'ids'
                    ]
                ]
            );
        }

        $this->add_control(
            'limit',
            [
                'label'   => esc_html__('Posts Per Page', 'mascot-core-amiso'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'          => esc_html__('columns', 'mascot-core-amiso'),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options'        => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( "Choose Image Size", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => mascot_core_get_available_image_sizes(),
                'default' => 'thumbnail',
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label'     => esc_html__('Advanced', 'mascot-core-amiso'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'     => esc_html__('Order By', 'mascot-core-amiso'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'date',
                'options'   => [
                    'date'       => esc_html__('Date', 'mascot-core-amiso'),
                    'id'         => esc_html__('Post ID', 'mascot-core-amiso'),
                    'menu_order' => esc_html__('Menu Order', 'mascot-core-amiso'),
                    'popularity' => esc_html__('Number of purchases', 'mascot-core-amiso'),
                    'rating'     => esc_html__('Average Product Rating', 'mascot-core-amiso'),
                    'title'      => esc_html__('Product Title', 'mascot-core-amiso'),
                    'rand'       => esc_html__('Random', 'mascot-core-amiso'),
                ],
                'condition' => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     => esc_html__('Order', 'mascot-core-amiso'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'asc'  => esc_html__('ASC', 'mascot-core-amiso'),
                    'desc' => esc_html__('DESC', 'mascot-core-amiso'),
                ],
                'condition' => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'mascot-core-amiso'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->get_product_categories(),
                'label_block' => true,
                'multiple'    => true,
                'condition'   => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label'     => esc_html__('Category Operator', 'mascot-core-amiso'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => esc_html__('AND', 'mascot-core-amiso'),
                    'IN'     => esc_html__('IN', 'mascot-core-amiso'),
                    'NOT IN' => esc_html__('NOT IN', 'mascot-core-amiso'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'tag',
            [
                'label'       => esc_html__('Tags', 'mascot-core-amiso'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_tags(),
                'multiple'    => true,
                'condition'   => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $this->add_control(
            'tag_operator',
            [
                'label'     => esc_html__('Tag Operator', 'mascot-core-amiso'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => esc_html__('AND', 'mascot-core-amiso'),
                    'IN'     => esc_html__('IN', 'mascot-core-amiso'),
                    'NOT IN' => esc_html__('NOT IN', 'mascot-core-amiso'),
                ],
                'condition' => [
                    'tag!' => ''
                ],
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
                'selector' => '{{WRAPPER}} .product .product-title,{{WRAPPER}} .product .product-title a',
            ]
        );
        $this->add_control(
            'title_text_color',
            [
                'label' => esc_html__( "Title Text Color", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product .product-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product .product-title a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'title_text_color_hover',
            [
                'label' => esc_html__( "Title Text Color (Hover)", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product .product-title:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product .product-title a:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'title_theme_colored',
            [
                'label' => esc_html__( "Title Theme Colored", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => mascot_core_amiso_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product .product-title' => 'color: var(--theme-color{{VALUE}});',
                    '{{WRAPPER}} .product .product-title a' => 'color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'title_theme_colored_hover',
            [
                'label' => esc_html__( "Title Theme Colored (Hover)", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => mascot_core_amiso_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product .product-title:hover' => 'color: var(--theme-color{{VALUE}});',
                    '{{WRAPPER}} .product .product-title a:hover' => 'color: var(--theme-color{{VALUE}});'
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
                    '{{WRAPPER}} .product .product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();





        $this->start_controls_section(
            'amount_styling_options',
            [
                'label' => esc_html__( 'Price Amount Styling', 'mascot-core-amiso' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'amount_typography',
                'label' => esc_html__( 'Typography', 'mascot-core-amiso' ),
                'selector' => '{{WRAPPER}} .product .amount',
            ]
        );
        $this->add_control(
            'amount_text_color',
            [
                'label' => esc_html__( "Text Color", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product .amount' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'amount_text_color_hover',
            [
                'label' => esc_html__( "Text Color (Hover)", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product:hover .entry-meta' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'amount_theme_colored',
            [
                'label' => esc_html__( "Text Theme Colored", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => mascot_core_amiso_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product .amount' => 'color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'amount_theme_colored_hover',
            [
                'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-amiso' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => mascot_core_amiso_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product:hover .entry-meta' => 'color: var(--theme-color{{VALUE}});',
                ],
            ]
        );
        $this->add_responsive_control(
            'amount_margin',
            [
                'label' => esc_html__( 'Margin', 'mascot-core-amiso' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .product .amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'label' => esc_html__( 'List Border', 'mascot-core-amiso' ),
                'selector' => '{{WRAPPER}} .product',
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
                    '{{WRAPPER}} .product:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .product:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'last_item_border',
                'label' => esc_html__( 'Border', 'mascot-core-amiso' ),
                'selector' => '{{WRAPPER}} .product:last-child',
            ]
        );
        $this->end_controls_section();
    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }

        return $results;
    }

    protected function get_product_tags() {
        $tags = get_terms(array(
                'taxonomy'   => 'product_tag',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $results[$tag->slug] = $tag->name;
            }
        }

        return $results;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->woocommerce_default($settings);
    }

    private function woocommerce_default($settings) {
        global $woocommerce;
        $meta_query = '';
        $tax_query = array();
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        if ( 'recent_products' == $settings['product_type'] ) {
            $meta_query = WC()->query->get_meta_query();
        }

        if ( 'featured_products' == $settings['product_type'] ) {
            $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN', // or 'NOT IN' to exclude feature products
            );
        }

        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $settings['limit'],
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'paged'               => $paged,
            'meta_query'          => $meta_query,
            'tax_query'          => $tax_query,
        );

        if ( 'sale_products' == $settings['product_type'] ) {
            $product_ids_on_sale = wc_get_product_ids_on_sale();
            $args['post__in'] = $product_ids_on_sale;
        }

        if ( 'best_selling_products' == $settings['product_type'] ) {
            $args['meta_key']   = 'total_sales';
            $args['orderby']    = 'meta_value_num';
        }

        if ( 'top_rated_products' == $settings['product_type'] ) {
            $args['meta_key']   = '_wc_average_rating';
            $args['orderby']    = 'meta_value_num';
        }

        //if category selected
        if( ! empty( $settings['categories'] ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => implode(',', $settings['categories']),
                    'operator' => $settings['cat_operator'],
                )
            );
        }

        if (!empty($settings['tag'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => array_map( 'sanitize_title', explode( ',', implode(',', $settings['tag']) ) ),
                    'operator' => $settings['tag_operator'],
                )
            );
        }


        $the_query = new \WP_Query( $args );
        $settings['the_query'] = $the_query;

        $settings['settings'] = $settings;

        //Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
        $html = mascot_core_amiso_get_shortcode_shop_template_part( 'product-list', null, 'product-list/tpl', $settings, true );

        echo $html;
    }
}