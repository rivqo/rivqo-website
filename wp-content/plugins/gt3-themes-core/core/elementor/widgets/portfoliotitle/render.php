<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Utils;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_PortfolioTitle $widget */

$settings = array(
	'show_category' => true,
	'show_image' => true,
	'type' => '1',
	'height' => '100',
	'show_date' => true,
	'show_description' => true,
);

$settings = wp_parse_args($widget->get_settings(), $settings);

global $paged;
if(empty($paged)) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$query_args = $settings['query']['query'];
unset($settings['query']['query']);
$query_args['paged'] = $paged;

$portfolio_query_arg = 'portfolio_category';

if (function_exists('gt3_option')) {
    $slug_option = gt3_option('portfolio_slug');
    if (!empty($slug_option)) {
    	$portfolio_query_arg = sanitize_title( $slug_option ) . '_cat';
    }
}

$query_raw = $settings['query'];
if(isset($_REQUEST[$portfolio_query_arg]) && !empty($_REQUEST[$portfolio_query_arg])) {
	if(isset($query_args['tax_query'])) {
		foreach($query_args['tax_query'] as $key => $value) {
			if(!is_numeric($key)) {
				continue;
			}
			if(is_array($value) && isset($value['field']) && $value['field'] == 'slug') {
				$query_args['tax_query'][$key]['terms'] = $_REQUEST[$portfolio_query_arg];
			}
		}
	}else{
		$query_args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'portfolio_category',
				'field'    => 'slug',
				'operator' => 'IN',
				'terms'    => array($_REQUEST[$portfolio_query_arg])
			)
		);
	}
} else {
	$_REQUEST[$portfolio_query_arg] = '';
}
$query   = new WP_Query($query_args);
if (!$query->post_count) {
	$paged = 1;
	$query_args['paged'] = 1;
	$query   = new WP_Query($query_args);
}
$exclude = array();
foreach($query->posts as $_post) {
	$exclude[] = $_post->ID;
}

if ($settings['type'] == '2') {
	$settings['show_image'] = 'yes';
}

if($query->have_posts()) {

	$query_args['exclude']        = $exclude;
	$data_wrapper                 = array();

	$class_wrapper = array(
		'portfolio_wrapper',
	);

	$widget->add_render_attribute('wrapper', 'class', $class_wrapper);

	$render_index = 0;

	$links = array();
	$preview = array();
	$text = array();

	if(in_array($settings['type'], [1, 2])) { ?>
		<div <?php $widget->print_render_attribute_string('wrapper') ?>>
	<?php }

		while($query->have_posts()) {
			$query->the_post();

			$potfolio_categories = '';

			if((bool)$settings['show_category']) {
				$categories = get_the_terms(get_the_ID(), $this->TAXONOMY);
				if(!$categories || is_wp_error($categories)) {
					$categories = array();
				}
				if(count($categories)) {
					$potfolio_categories = array();

					foreach($categories as $category) {
						/* @var \WP_Term $category */
						$item_class[]    = $category->slug;

						$category_link = get_category_link($category);

						$potfolio_categories[] = '<span><a href="'.esc_url($category_link).'">'.$category->name.' <sup>'. ($category->count < 10 ? '0' : '' ). $category->count.'</sup></a></span>';
					}
					$potfolio_categories = implode(', ', $potfolio_categories);
				}
			}

			$image_id = get_post_thumbnail_id();
			$src = $image_id ? wp_get_attachment_image_src($image_id, 'full') : array('');

			$preview[] = '<img class="image_background" src="'.$src[0].'" alt="'.esc_attr(get_the_title()).'"  data-index="'.$render_index.'"/>';

			$portfolio_work_link = get_post_meta(get_the_ID(), 'mb_portfolio_work_link', true);
			if (isset($portfolio_work_link) && strlen($portfolio_work_link) > 0) {
				$linkToTheWork = $portfolio_work_link;
				$target = "target='_blank'";
			} else {
				$linkToTheWork = get_permalink();
				$target = "target='_self'";
			}

			if($settings['show_description'] == 'yes') {
				ob_start();
				if(has_excerpt(get_the_ID()) && trim(get_the_excerpt(get_the_ID()))) {
					the_excerpt(get_the_ID());
				} else {
					the_content(get_the_ID());
				}
				$post_excerpt = ob_get_clean();
				if(!empty($settings['symbol_count'])) {
					$symbol_count = $settings['symbol_count']['size'];
				} else {
					$symbol_count = 100;
				}

				if(isset($settings['content_cut']) && $settings['content_cut'] == 'yes') {
					$post_excerpt              = preg_replace('~\[[^\]]+\]~', '', $post_excerpt);
					$post_excerpt_without_tags = strip_tags($post_excerpt);
					$post_descr                = gt3_smarty_modifier_truncate($post_excerpt_without_tags, $symbol_count, "...");
				} else {
					$post_descr = $post_excerpt;
				}

			}

			$links[] =  '<div class="portfolio_item_wrap" data-index="'.$render_index.'"><a href="'.esc_url($linkToTheWork).'" '.$target.'>'.get_the_title().'</a>'.
			            ((!empty($potfolio_categories) && $settings['type'] == '1') ? ' <span class="divider">/</span> <span class="categories">'.$potfolio_categories.'</span>' : '').'</div>';

			$text[] = '<div class="portfolio_item_text" data-index="'.$render_index.'">'.
			          (!empty($potfolio_categories) ? '<span class="categories">'.$potfolio_categories.'</span>' : '').(($settings['show_date'] == 'yes') ? '<span class="date">'.esc_html(get_the_time(get_option( 'date_format' ))).'</span>' : '').(($settings['show_description'] == 'yes' && !empty($post_descr)) ? '<p>'.$post_descr.'</p>' : '').'</div>';



			if($settings['type'] == '3') { ?>
			<div <?php $widget->print_render_attribute_string('wrapper') ?>>
				<div class="links_wrapper"><?php echo $links[$render_index]; ?></div>
				<div class="text_wrapper"><?php echo $text[$render_index]; ?></div>
				<?php if((bool)$settings['show_image']) { ?>
					<div class="preview_wrapper"><?php echo $preview[$render_index]; ?></div>
				<?php } ?>
			</div>
			<?php }

			$render_index++;

		}

		if(in_array($settings['type'], [1, 2])) { ?>
			<div class="links_wrapper"><?php echo implode('',$links); ?></div>
			<?php if($settings['type'] == '2') { ?>
				<div class="text_wrapper"><?php echo implode('',$text); ?></div>
			<?php } ?>
			<?php if((bool)$settings['show_image']) { ?>
				<div class="preview_wrapper"><?php echo implode('',$preview); ?></div>
			<?php }
			echo '</div>';
		}


	$widget->print_data_settings($data_wrapper);

}

wp_reset_postdata();
