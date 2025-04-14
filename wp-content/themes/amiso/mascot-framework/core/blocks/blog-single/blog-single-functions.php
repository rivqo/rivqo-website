<?php


if(!function_exists('amiso_get_blog_single')) {
	/**
	 * Function that Renders Blog Single HTML Codes
	 * @return HTML
	 */
	function amiso_get_blog_single( $container_type = 'container' ) {
		$params = array();


		$params['container_type'] = $container_type;

		if( amiso_get_redux_option( 'blog-single-post-settings-fullwidth' ) ) {
			$params['container_type'] = 'container-fluid';
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'blog-single-parts', null, 'blog-single/tpl', $params );

		return $html;
	}
}

if (!function_exists('amiso_get_blog_single_sidebar_layout')) {
	/**
	 * Return Blog Single Sidebar Layout HTML
	 */
	function amiso_get_blog_single_sidebar_layout() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		if( 'post' != get_post_type() ) {
			$html = amiso_get_blocks_template_part( 'blog-single', 'no-sidebar', 'blog-single/tpl/sidebar-columns', $params );
		} else {
			$sidebar = 'no-sidebar';
			if ( is_active_sidebar('default-sidebar')  ) {
				$sidebar = 'sidebar-right-33';
			}


			//Page Sidebar Layout
			//check if meta value is provided for this page or then get it from theme options
			$temp_meta_value = amiso_get_rwmb_group( 'amiso_' . "page_mb_sidebar_layout_settings", 'sidebar_layout', $current_page_id );
			if( ! amiso_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
				$params['page_layout'] = $temp_meta_value;
			} else {
				$params['page_layout'] = amiso_get_redux_option( 'blog-single-post-settings-sidebar-layout', $sidebar );
			}


			//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
			$html = amiso_get_blocks_template_part( 'blog-single', $params['page_layout'], 'blog-single/tpl/sidebar-columns', $params );
		}


		return $html;
	}
}

if (!function_exists('amiso_get_blog_single_all')) {
	/**
	 * Return Blog Single All
	 */
	function amiso_get_blog_single_all() {
		$current_page_id = amiso_get_page_id();
		$params = array();

		if( 'post' != get_post_type() ) {
			the_content();
			return;
		}

		amiso_get_blog_single_post_format( get_post_format() );

		/*$show_tags = amiso_get_redux_option( 'blog-single-post-settings-show-tags', true );
		$show_share = amiso_get_redux_option( 'blog-single-post-settings-show-share', false );
		if( $show_tags || $show_share ) {
			if( $show_tags && has_tag() && $show_share ) {
				echo '<div class="row single-post-tags-share tag-share-both">';
					echo '<div class="col-xl-6 align-self-center max-width-half"><div class="left-part">';
					amiso_get_blog_single_tags();
					echo '</div></div>';
					echo '<div class="col-xl-6 align-self-center max-width-half"><div class="right-part">';
					amiso_get_social_share_links();
					echo '</div></div>';
				echo '</div>';
			} else if( $show_tags && has_tag() ) {
				echo '<div class="row single-post-tags-share tag-share-single">';
					echo '<div class="col"><div class="left-part">';
					amiso_get_blog_single_tags();
					echo '</div></div>';
				echo '</div>';
			} else if( $show_share ) {
				echo '<div class="row single-post-tags-share tag-share-single">';
					echo '<div class="col"><div class="left-part text-center">';
					amiso_get_social_share_links();
					echo '</div></div>';
				echo '</div>';
			}
		}*/

		echo '<div class="news-details-bottom">';
		amiso_news_details_bottom();
		echo '</div>';

		if( !_empty( trim( get_the_content() ) ) && 'post' == get_post_type() && amiso_get_redux_option( 'blog-single-post-settings-author-info-box', true ) ) {
			amiso_get_blog_single_author_info_box();
		}

		if( amiso_get_redux_option( 'blog-single-post-settings-show-next-pre-post-link', false ) ) {
			amiso_get_blog_single_next_pre_post_link();
		}

		if( amiso_get_redux_option( 'blog-single-post-settings-show-related-posts', false ) ) {
			$posts_count = amiso_get_redux_option( 'blog-single-post-settings-show-related-posts-count', 3 );
			amiso_get_blog_single_related_posts( $current_page_id, $posts_count );
		}

		if( amiso_get_redux_option( 'blog-single-post-settings-show-comments', true ) ) {
			amiso_show_comments();
		}
	}
}

if (!function_exists('amiso_news_details_bottom')) {
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function amiso_news_details_bottom() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(' ', 'amiso'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="news-details__categories"><span>' . esc_html__('Posted in %1$s', 'amiso') . '</span>', '</span>' . $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'amiso'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="news-details__tags"><span>' . esc_html__('Tags %1$s', 'amiso') . '</span>', '</span>' . $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
    }
}


if (!function_exists('amiso_get_blog_single_post_format')) {
	/**
	 * Return Blog Single Post Format HTML
	 */
	function amiso_get_blog_single_post_format( $post_format = '' ) {
		global $supported_post_formats;
		$params = array();

		if( !in_array( $post_format, $supported_post_formats ) ) {
			$post_format = 'standard';
		}
		$params['post_format'] = $post_format;

		$params['show_post_featured_image'] = amiso_get_redux_option( 'blog-single-post-settings-show-post-featured-image', true );

		$params['enable_drop_caps'] = amiso_get_redux_option( 'blog-single-post-settings-enable-drop-caps' );
		if( $params['enable_drop_caps'] ) {
			$params['enable_drop_caps'] = 'drop-caps';
		} else {
			$params['enable_drop_caps'] = '';
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-format', $post_format, 'blog-single/tpl/post-format', $params );

		return $html;
	}
}

if(!function_exists('amiso_get_single_post_title')) {
	/**
	 * Function that Renders Single Post Title HTML Codes
	 * @return HTML
	 */
	function amiso_get_single_post_title() {
		if( ! amiso_get_redux_option( 'page-title-settings-show-title', true ) ) {
			//return amiso_get_post_title();
		} else if ( ! amiso_get_redux_option( 'page-title-settings-enable-default-page-title', true ) ) {
			//return amiso_get_post_title();
		}
	}
}

if(!function_exists('amiso_get_blog_single_post_thumbnail')) {
	/**
	 * Function that Renders Thumbnail HTML Codes
	 * @return HTML
	 */
	function amiso_get_blog_single_post_thumbnail( $post_format = '' ) {
		global $supported_post_formats;
		$params = array();

		//format
		$format = $post_format ? : 'standard';

		if( !in_array( $post_format, $supported_post_formats ) ) {
			$post_format = 'standard';
		}
		$params['post_format'] = $post_format;

		$params['featured_image_height'] = amiso_get_redux_option( 'blog-single-post-settings-featured-image-height', 600 );

		if ( ( $params['post_format'] == "standard" || $params['post_format'] == "image" ) && !has_post_thumbnail() ) {
			return;
		}


		//Hide featured image
		if( amiso_get_rwmb_group( 'amiso_' . "page_mb_general_settings", 'hide_featured_image' ) ) {
			return;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-thumb', $post_format, 'blog-single/tpl/parts', $params );
		return $html;
	}
}

if ( ! function_exists( 'amiso_blog_single_post_meta' ) ) {
	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 */
	function amiso_blog_single_post_meta() {
		if( 'post' != get_post_type() ) {
			return;
		}
	?>
	<ul class="entry-meta list-inline">
	<?php
		if( amiso_get_redux_option( 'blog-single-post-settings-post-meta', false, 'show-post-by-author' ) ) {
	?>
			<li class="list-inline-item author"><i class="fa fa-user-circle-o"></i> <?php amiso_posted_by();?></li>
	<?php
		} if( amiso_get_redux_option( 'blog-single-post-settings-post-meta', true, 'show-post-date' ) ) {
	?>
			<li class="list-inline-item posted-date"><i class="fa fa-calendar-o"></i> <?php amiso_posted_on();?></li>
	<?php
		} if( comments_open() && amiso_get_redux_option( 'blog-single-post-settings-post-meta', false, 'show-post-comments-count' ) ) {
	?>
			<li class="list-inline-item comments"><i class="fa fa-comments-o"></i> <?php amiso_get_comments_number(); ?></li>
	<?php
		} if( amiso_get_redux_option( 'blog-single-post-settings-post-meta', false, 'show-post-like-button' ) ) {
	?>
			<li class="list-inline-item likes"><?php amiso_sl_get_simple_likes_button( get_the_ID() ); ?></li>
	<?php
		}
	?>
	</ul>
	<?php
	}
}


if ( ! function_exists( 'amiso_get_blog_single_tags' ) ) {
	/**
	 * Return Blog Single Post Tags
	 *
	 */
	function amiso_get_blog_single_tags() {
		$params = array();

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-tags', null, 'blog-single/tpl/parts', $params );

		return $html;
	}
}

if ( ! function_exists( 'amiso_get_blog_single_author_info_box' ) ) {
	/**
	 * Return Blog Single Post Author Info
	 *
	 */
	function amiso_get_blog_single_author_info_box() {
		$params = array();

		$params['show_social_icons'] = amiso_get_redux_option( 'blog-single-post-settings-author-info-box-show-social-icons' );
		$params['show_author_email'] = amiso_get_redux_option( 'blog-single-post-settings-author-info-box-show-author-email' );

		//social icons
		if( $params['show_social_icons'] ) {
			$author_ID = get_the_author_meta( 'ID' );
			$social_icons_list = array();
			$social_icons = array(
				'facebook',
				'twitter',
				'linkedin',
				'youtube',
				'googleplus',
				'instagram',
				'pinterest',
				'tumblr'
			);

			foreach( $social_icons as $each_social_icon ){
				$social_link = get_user_meta( $author_ID, 'amiso_' . $each_social_icon, true );
				if( $social_link != '' ) {
					$social_icons_list[$each_social_icon] = array(
						'url' => $social_link,
						'class' => 'fa fa-'.$each_social_icon,
					);
				}
			}
			$params['social_icons_list'] = $social_icons_list;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-author-info', null, 'blog-single/tpl/parts', $params );

		return $html;
	}
}

if ( ! function_exists( 'amiso_get_author_info_social_links' ) ) {
	/**
	 * Return Author Social Links
	 *
	 */
	function amiso_get_author_info_social_links( $user_id ) {
		$params = array();

		$params['show_social_icons'] = amiso_get_redux_option( 'blog-single-post-settings-author-info-box-show-social-icons' );

		//social icons
		if( $params['show_social_icons'] ) {
			$social_icons_list = array();
			$social_icons = array(
				'facebook',
				'twitter',
				'linkedin',
				'youtube',
				'googleplus',
				'instagram',
				'pinterest',
				'tumblr'
			);

			foreach( $social_icons as $each_social_icon ){
				$social_link = get_user_meta( $user_id, 'amiso_' . $each_social_icon, true );
				if( $social_link != '' ) {
					$social_icons_list[$each_social_icon] = array(
						'url' => $social_link,
						'class' => 'fa fa-'.$each_social_icon,
					);
				}
			}
			$params['social_icons_list'] = $social_icons_list;
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-author-info-social', null, 'blog-single/tpl/parts', $params );

		return $html;
	}
}

if ( ! function_exists( 'amiso_get_blog_single_next_pre_post_link' ) ) {
	/**
	 * Return Blog Single Next Previous Post Link
	 *
	 */
	function amiso_get_blog_single_next_pre_post_link() {
		$params = array();

		$params['next_pre_link_within_same_cat'] = amiso_get_redux_option( 'blog-single-post-settings-show-next-pre-post-link-within-same-cat' );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-next-pre-post-link', null, 'blog-single/tpl/parts', $params );

		return $html;
	}
}

if ( ! function_exists( 'amiso_get_blog_single_related_posts' ) ) {
	/**
	 * Return Blog Single Related Posts
	 *
	 */
	function amiso_get_blog_single_related_posts( $post_id, $related_count, $args = array() ) {

		$args = wp_parse_args( (array) $args, array(
			'orderby' => 'rand',
			'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
		) );

		$related_args = array(
			'post_type'		=> get_post_type( $post_id ),
			'posts_per_page' => $related_count,
			'post_status'	=> 'publish',
			'post__not_in'   => array( $post_id ),
			'orderby'		=> $args['orderby'],
			'tax_query'		=> array()
		);

		$post		= get_post( $post_id );
		$taxonomies = get_object_taxonomies( $post, 'names' );

		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( $post_id, $taxonomy );
			if ( empty( $terms ) ) {
				continue;
			}
			$term_list					= wp_list_pluck( $terms, 'slug' );
			$related_args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field'	=> 'slug',
				'terms'	=> $term_list
			);
		}

		if ( count( $related_args['tax_query'] ) > 1 ) {
			$related_args['tax_query']['relation'] = 'OR';
		}

		if ( $args['return'] == 'query' ) {
			$params['related_posts_query_result'] = new WP_Query( $related_args );
		} else {
			$params['related_posts_query_result'] = $related_args;
		}

		//related posts
		$params['related_posts_carousel'] = amiso_get_redux_option( 'blog-single-post-settings-show-related-posts-carousel' );
		$params['related_posts_show_excerpt'] = amiso_get_redux_option( 'blog-single-post-settings-related-posts-show-excerpt' );

		$posts_carousel = '';
		if( $params['related_posts_carousel'] ) {
			$posts_carousel = 'carousel';
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = amiso_get_blocks_template_part( 'post-related-posts', $posts_carousel, 'blog-single/tpl/parts', $params );

		return $html;
	}
}


if ( ! function_exists( 'amiso_get_blog_single_custom_password_form' ) ) {
	/**
	 * Customizing And Styling The Password Protected Form
	 *
	 */
	function amiso_get_blog_single_custom_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
			<p>' . esc_html__( "This content is password protected. To view it please enter your password below:", 'amiso' ) . '<p>
			<label for="' . esc_html( $label ) . '">' . esc_html__( "Password:", 'amiso' ) . ' <input class="form-control mb-0" name="post_password" id="' . esc_html( $label ) . '" type="password" size="20" maxlength="20" /> </label> <input class="btn btn-theme-colored1 btn-default" type="submit" name="Submit" value="' . esc_attr__( "Submit", 'amiso' ) . '" />
		</form>
		';
		return $o;
	}
	add_filter( 'the_password_form', 'amiso_get_blog_single_custom_password_form' );
}

if (!function_exists('amiso_blog_single_related_posts_read_more_link')) {
	/**
	 * read more link output.
	 */
	function amiso_blog_single_related_posts_read_more_link() {
		$link = '<div class="post-btn-readmore">';
			$link .= '<a class="'. apply_filters( 'amiso_blog_single_related_posts_read_more_link_btn', 'btn btn-plain-text') . '" href="' . get_permalink() . '">' . esc_html__('Read more', 'amiso') . '</a>';
		$link .= '</div>';
		return $link;
	}
}