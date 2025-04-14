<!-- Service Block Three-->
<div <?php post_class( '' ); ?>>
	<div class="service-item-current-style3 service-block">
		<div class="inner-box">
			<div class="image-box">
			<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'icon', $service_icon_array_new[get_the_ID()]['icon_type'], 'services/tpl', $params, false ); ?>
				<div class="image">
      			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
				</div>
			</div>
			<div class="content">
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
</div>