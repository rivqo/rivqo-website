<?php


if(!function_exists('amiso_get_blog')) {
	/**
	 * Function that Renders Blog HTML Codes
	 * @return HTML
	 */
	function amiso_get_blog( $container_type = 'container' ) {
		$params = array();

		$params['container_type'] = $container_type;

		if( amiso_get_redux_option( 'blog-settings-fullwidth' ) ) {
			$params['container_type'] = 'container-fluid';
		}
		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'blog-parts', null, 'blog/tpl', $params );

		return $html;
	}
}

if (!function_exists('amiso_get_blog_sidebar_layout')) {
	/**
	 * Return Blog Sidebar Layout HTML
	 */
	function amiso_get_blog_sidebar_layout() {
		$params = array();

		$sidebar = 'no-sidebar';
		if ( is_active_sidebar('default-sidebar')  ) {
			$sidebar = 'sidebar-right-33';
		}
		if( amiso_get_redux_option( 'blog-settings-sidebar-layout' ) ) {
			$sidebar = amiso_get_redux_option( 'blog-settings-sidebar-layout', $sidebar );
		}
		if ( !is_active_sidebar('default-sidebar')  ) {
			$sidebar = 'no-sidebar';
		}
		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'blog', $sidebar, 'blog/tpl/sidebar-columns', $params );

		return $html;
	}
}

if (!function_exists('amiso_get_blog_post_layout')) {
	/**
	 * Return Blog Post Layout HTML
	 */
	function amiso_get_blog_post_layout() {
		$params = array();

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post', amiso_get_redux_option( 'blog-settings-archive-page-layout', 'masonry-2-col' ), 'blog/tpl/post-layout', $params );

		return $html;
	}
}

if (!function_exists('amiso_get_blog_post_format')) {
	/**
	 * Return Blog Post Format HTML
	 */
	function amiso_get_blog_post_format( $post_format = '' ) {
		global $supported_post_formats;
		$params = array();

		if( !in_array( $post_format, $supported_post_formats ) ) {
			$post_format = 'standard';
		}
		$params['post_format'] = $post_format;

		$params['show_post_featured_image'] = amiso_get_redux_option( 'blog-settings-show-post-featured-image', true );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-format', $post_format, 'blog/tpl/post-format', $params );

		return $html;
	}
}

if(!function_exists('amiso_get_post_thumbnail')) {
	/**
	 * Function that Renders Header HTML Codes
	 * @return HTML
	 */
	function amiso_get_post_thumbnail( $post_format = '', $img_size = '' ) {
		global $supported_post_formats;
		$params = array();

		$params['img_size'] = $img_size;

		if( $img_size == '' ) {
			$params['img_size'] = amiso_get_redux_option( 'blog-settings-post-featured-image-size', 'amiso_wide' );
		}

		//format
		if( !in_array( $post_format, $supported_post_formats ) ) {
			$post_format = 'standard';
		}
		$params['post_format'] = $post_format;

		if ( ( $params['post_format'] == "standard" || $params['post_format'] == "image" ) && !has_post_thumbnail() ) {
			return;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-thumb', $post_format, 'blog/tpl/parts', $params );

		return $html;
	}
}

if(!function_exists('amiso_get_post_title')) {
	/**
	 * Function that Renders Post Title HTML Codes
	 * @return HTML
	 */
	function amiso_get_post_title() {
		$params = array();

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-title', null, 'blog/tpl/parts', $params );

		return $html;
	}
}

if(!function_exists('amiso_get_post_wp_link_pages')) {
	/**
	 * Function that Displays page-links for paginated posts
	 * @return HTML
	 */
	function amiso_get_post_wp_link_pages() {
		$params = array();

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-link-pages', null, 'blog/tpl/parts', $params );

		return $html;
	}
}

if(!function_exists('amiso_get_pagination')) {
	/**
	 * Function that Renders Pagination HTML Codes
	 * @return HTML
	 */
	function amiso_get_pagination() {

		//Show Pagination
		$params['show_pagination'] = amiso_get_redux_option( 'blog-settings-show-pagination', true );

		if( !$params['show_pagination'] ) {
			return;
		}

		amiso_render_pagination_html();
	}
}

if ( ! function_exists( 'amiso_post_meta' ) ) {
	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 */
	function amiso_post_meta() {
	?>
	<ul class="entry-meta list-inline">
	<?php
		if( amiso_get_redux_option( 'blog-settings-post-meta', true, 'show-post-date' ) ) {
	?>
			<li class="list-inline-item posted-date"><i class="fa fa-calendar-o"></i> <?php amiso_posted_on();?></li>
	<?php
		}
		if( amiso_get_redux_option( 'blog-settings-post-meta', true, 'show-post-by-author' ) ) {
	?>
			<li class="list-inline-item author"><i class="fa fa-user-circle-o"></i> <?php amiso_posted_by();?></li>
	<?php
		} if( has_category() && amiso_get_redux_option( 'blog-settings-post-meta', false, 'show-post-category' ) ) {
	?>
			<li class="list-inline-item categories"><i class="fa fa-folder-o"></i> <?php amiso_post_category();?></li>
	<?php
		} if( comments_open() && amiso_get_redux_option( 'blog-settings-post-meta', false, 'show-post-comments-count' ) ) {
	?>
			<li class="list-inline-item comments"><i class="fa fa-comments-o"></i> <?php amiso_get_comments_number(); ?></li>
	<?php
		} if( has_tag() && amiso_get_redux_option( 'blog-settings-post-meta', false, 'show-post-tag' ) ) {
	?>
			<li class="list-inline-item tags"><i class="fa fa-tags"></i> <?php amiso_post_tag();?></li>
	<?php
		} if( amiso_get_redux_option( 'blog-settings-post-meta', false, 'show-post-like-button' ) ) {
	?>
			<li class="list-inline-item likes"><?php amiso_sl_get_simple_likes_button( get_the_ID() ); ?></li>
	<?php
		}
	?>
	</ul>
	<?php
	}
}

if ( ! function_exists( 'amiso_posted_on' ) ) {
	/**
	 * Print HTML posted on
	 *
	 */
	function amiso_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		printf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		);
	}
}

if ( ! function_exists( 'amiso_posted_on_split_date' ) ) {
	/**
	 * Print HTML posted on
	 *
	 */
	function amiso_posted_on_split_date() {
		printf( '<a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s"><span class="day">%3$s</span> <span class="month">%4$s</span><span class="year">, %5$s</span></time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date('d') ),
			esc_html( get_the_date('M') ),
			esc_html( get_the_date('Y') )
		);
	}
}

if ( ! function_exists( 'amiso_posted_on_date' ) ) {
	/**
	 * Print HTML posted on
	 *
	 */
	function amiso_posted_on_date() {
		printf( '<span class="post-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}
}

if ( ! function_exists( 'amiso_posted_by' ) ) {
	/**
	 * Print HTML posted by.
	 *
	 */
	function amiso_posted_by() {
		printf( '<span class="byline">'.esc_html__( 'By', 'amiso' ).' <span class="author vcard"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
}

if ( ! function_exists( 'amiso_post_category' ) ) {
	/**
	 * Print HTML post category.
	 *
	 */
	function amiso_post_category() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( esc_html__( ', ', 'amiso' ) );
		if ( $categories_list ) {
		?>
			<span class="categories-links"><?php
			echo wp_kses(
					$categories_list,
					array(
						'a' => array(
							'href' => array(),
							'rel' => array(),
						),
					)
				);
			?></span>
        <?php
		}
	}
}

if ( ! function_exists( 'amiso_post_tag' ) ) {
	/**
	 * Print HTML post tag.
	 *
	 */
	function amiso_post_tag() {
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', esc_html__( ', ', 'amiso' ) );
		if ( $tag_list ) {
		?>
			<span class="tags-links"><?php
			echo wp_kses(
					$tag_list,
					array(
						'a' => array(
							'href' => array(),
							'rel' => array(),
						),
					)
				);
			?></span>
        <?php
		}
	}
}

if ( ! function_exists( 'amiso_get_comments_number' ) ) {
	/**
	 * Print HTML get comments number.
	 *
	 */
	function amiso_get_comments_number() {
		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('No Comments', 'amiso');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . esc_html__(' Comments', 'amiso');
			} else {
				$comments = esc_html__('1 Comment', 'amiso');
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		} else {
			$write_comments =  esc_html__('Comments off', 'amiso');
		}

		echo wp_kses( $write_comments, array(
			'a' => array(
				'href' => true,
			)
		) );
	}
}

if (!function_exists('amiso_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function amiso_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'amiso_excerpt_more');
}

if(!function_exists('amiso_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function amiso_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if (!function_exists('amiso_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function amiso_modify_read_more_link() {
		$link = '<div class="mascot-more-link-container">';
			$link .= '<a class="' . apply_filters( 'amiso_the_content_more_link', 'more-link btn btn-plain-text') . '" href="' . get_permalink() . '">' . esc_html__('Continue reading', 'amiso') . '</a>';
		$link .= '</div>';
		return $link;
	}
	add_filter( 'the_content_more_link', 'amiso_modify_read_more_link');
}

if (!function_exists('amiso_blog_read_more_link')) {
	/**
	 * read more link output.
	 */
	function amiso_blog_read_more_link() {
		$link = '<div class="post-btn-readmore">';
			$link .= '<a class="'. apply_filters( 'amiso_blog_read_more_link_btn', 'btn btn-plain-text-with-arrow-right') . '" href="' . get_permalink() . '">' . esc_html__('Read more', 'amiso') . '</a>';
		$link .= '</div>';
		return $link;
	}
}

if (!function_exists('amiso_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function amiso_excerpt_length( $length ) {

		if( amiso_get_redux_option( 'blog-settings-excerpt-length', 25 ) !== ''){
			return esc_attr( amiso_get_redux_option( 'blog-settings-excerpt-length', 25 ) );
		} else {
			return 25;
		}
	}
	add_filter( 'excerpt_length', 'amiso_excerpt_length', 999 );
}

if ( ! function_exists( 'amiso_get_excerpt' ) ) {
	/**
	 * Print HTML get excerpt.
	 *
	 */
	function amiso_get_excerpt( $excerpt_length = '' ) {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		} elseif( $excerpt_length != '0' ) {
			$word_count = AMISO_POST_EXCERPT_LENGTH;
			if( amiso_get_redux_option( 'blog-settings-excerpt-length', AMISO_POST_EXCERPT_LENGTH ) != '' ) {
				$word_count = esc_attr( amiso_get_redux_option( 'blog-settings-excerpt-length', AMISO_POST_EXCERPT_LENGTH ) );
			}
			if( is_numeric($excerpt_length) && $excerpt_length > 0 ) {
				$word_count = $excerpt_length;
			}
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : wp_strip_all_tags(get_the_excerpt($post->ID));

			//plain text
			$post_excerpt = do_shortcode( $post_excerpt );

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode( ' ', $clean_excerpt );

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice( $excerpt_word_array, 0, $word_count );

				//add exerpt postfix
				$excert_postfix	= apply_filters( 'amiso_excerpt_postfix', '' );

				//and finally implode words together
				$excerpt = implode( ' ', $excerpt_word_array ) . $excert_postfix;

				//is excerpt different than empty string?
				if( $excerpt !== '' ) {
					echo '<div class="mascot-post-excerpt">'.esc_html( wp_strip_all_tags( $excerpt ) ).'</div>';
				}
			}
		}
	}
}

if ( ! function_exists( 'amiso_related_posts_get_excerpt' ) ) {
	/**
	 * Print HTML Related Posts get excerpt.
	 *
	 */
	function amiso_related_posts_get_excerpt() {
		$related_posts_excerpt_length = amiso_get_redux_option( 'blog-single-post-settings-show-related-posts-excerpt-length', AMISO_POST_EXCERPT_LENGTH );
		amiso_get_excerpt( $related_posts_excerpt_length );
	}
}

if ( ! function_exists( 'amiso_custom_excerpt_length' ) ) {
	/**
	 * Filter the except length to 20 words
	 *
	 */
	function amiso_custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'amiso_custom_excerpt_length', 999 );
}

if ( ! function_exists( 'amiso_docs_excerpt_more' ) ) {
	/**
	 * Filter the excerpt "read more" string.
	 */
	function amiso_docs_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'amiso_docs_excerpt_more' );
}

if (!function_exists('amiso_register_blog_sidebar')) {
	/**
	 * Register Blog Sidebar
	 */
	function amiso_register_blog_sidebar() {
		$title_line_bottom_class = '';

		if( amiso_get_redux_option( 'sidebar-settings-sidebar-title-show-line-bottom', 1 ) ) {
			$title_line_bottom_class = 'widget-title-line-bottom';
		}
		$line_bottom_theme_colored = amiso_get_redux_option( 'sidebar-settings-sidebar-title-line-bottom-theme-colored', 1 );
		if( $line_bottom_theme_colored != '' ) {
			$title_line_bottom_class .= ' line-bottom-theme-colored' . $line_bottom_theme_colored;
		}


		// Blog Default Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Blog Sidebar', 'amiso' ),
			'id'			=> 'default-sidebar',
			'description'   => esc_html__( 'This is a default sidebar for blog. Widgets in this area will be shown on sidebar of blog/single page. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );

		// Blog Secondary Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Blog Secondary Sidebar', 'amiso' ),
			'id'			=> 'blog-secondary-sidebar',
			'description'   => esc_html__( 'This is a Secondary sidebar for blog. Widgets in this area will be shown on another sidebar of blog/single page. Drag and drop your widgets here.', 'amiso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'amiso_register_blog_sidebar', 999 );
}