<!-- Service Block Two -->
<div id="post-<?php the_ID() ?>" <?php post_class( '' ); ?>>
	<div class="service-block service-item-current-style4">
		<div class="service-inner">
			<span class="count"><em></em></span>
			<?php if(isset($service_icon_array_new[get_the_ID()]['icon_type'])) mascot_core_amiso_get_cpt_shortcode_template_part( 'icon', $service_icon_array_new[get_the_ID()]['icon_type'], 'services/tpl', $params, false ); ?>
			<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'title', null, 'services/tpl', $params, false ); ?>
			<?php if ( $show_excerpt == 'yes' ) : ?>
				<?php if ( empty($excerpt_length) ) { ?>
					<div class="excerpt service-details">
						<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
					</div>
				<?php } else { ?>
					<div class="excerpt service-details">
						<?php $excerpt = get_the_excerpt(); echo esc_html( amiso_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
					</div>
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</div>