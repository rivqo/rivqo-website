<?php

/*
 * Adds Mascot_Core_Amiso_Widget_BlogList widget.
 */
if( !class_exists( 'Mascot_Core_Amiso_Widget_BlogList' ) ) {
class Mascot_Core_Amiso_Widget_BlogList extends Mascot_Core_Amiso_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-blog-list clearfix',
			'description'	=> esc_html__( 'A widget that displays list of blog posts.', 'mascot-core-amiso' ),
		);
		parent::__construct( 'tm_widget_blog_list', esc_html__( '(TM) Latest News', 'mascot-core-amiso' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {
		$this->formFields = array(
			array(
				'id'		=> 'title',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Widget Title:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Latest News', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-amiso' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-amiso' ),
			),
			array(
				'id'		=> 'num_of_posts',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Number of Posts:', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'limit_title_words',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Limit number of words to display in title:', 'mascot-core-amiso' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'blog_category',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Blog Category:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> mascot_core_amiso_get_post_all_categories_array()
			),
			array(
				'id'		=> 'order_by',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Order By:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'title'		=> esc_html__( 'Title', 'mascot-core-amiso' ),
					'date'			=> esc_html__( 'Date', 'mascot-core-amiso' ),
					'comment_count' => esc_html__( 'Number of Comments', 'mascot-core-amiso' )
				)
			),
			array(
				'id'		=> 'order',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Order:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'DESC' => esc_html__( 'DESC', 'mascot-core-amiso' ),
					'ASC'  => esc_html__( 'ASC', 'mascot-core-amiso' )
				)
			),
			array(
				'id'		=> 'disable_thumb',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Disable Thumbnail', 'mascot-core-amiso' ),
				'desc'		=> '',
				'value'	=> 'on',
			),
			array(
				'id'		=> 'post_title_tag',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Post Title Tag:', 'mascot-core-amiso' ),
				'desc'		=> '',
				'options'	=> array(
					'h6' => 'h6',
					'h5' => 'h5',
					'h4' => 'h4',
					'h3' => 'h3',
					'h2' => 'h2',
				)
			),
		);
	}



	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args	 Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] );
		}

		//default posts per page
		$posts_per_page = ( $instance['num_of_posts'] == '' ) ? -1 : $instance['num_of_posts'];
		//query args
		$query_args = array(
			'orderby' => $instance['order_by'],
			'order' => $instance['order'],
			'category__in' => $instance['blog_category'],
			'posts_per_page' => $posts_per_page,
		);

		$the_query = new \WP_Query( $query_args );
		$instance['the_query'] = $the_query;

		$instance['disable_thumb'] = isset($instance['disable_thumb']) ? $instance['disable_thumb'] : '';

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = mascot_core_amiso_get_widget_template_part( 'blog-list', null, 'blog-list/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}