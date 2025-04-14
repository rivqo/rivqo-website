<div <?php post_class( '' ); ?>>
	<div class="type-services service-item-current-style1 service-block">
		<div class="service-inner">
				<div class="icon-box">
					<?php if(isset($service_icon_array_new[get_the_ID()]['icon_type'])) mascot_core_amiso_get_cpt_shortcode_template_part( 'icon', $service_icon_array_new[get_the_ID()]['icon_type'], 'services/tpl', $params, false ); ?>
				</div>
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

				<?php if ( $show_view_details_button == 'yes' ) : ?>
          <a href="<?php the_permalink();?>" class="read-more"><i class="fa fa-long-arrow-alt-right"></i> <?php echo esc_html( $view_details_button_text  ); ?></a>
				<?php endif; ?>
		</div>
	</div>
</div>