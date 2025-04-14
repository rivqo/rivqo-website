<div <?php post_class( '' ); ?>>
	<div class="service-skin-style4">
		<div class="thumb">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
			<div class="icon-box">
				<?php if(isset($service_icon_array_new[get_the_ID()]['icon_type'])) mascot_core_amiso_get_cpt_shortcode_template_part( 'icon', $service_icon_array_new[get_the_ID()]['icon_type'], 'services/tpl', $params, false ); ?>
			</div>
		</div>
		<div class="content">
			<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'title', null, 'services/tpl', $params, false ); ?>
			<?php if ( $show_excerpt == 'yes' ) : ?>
			<?php if ( empty($excerpt_length) ) { ?>
				<div class="excerpt">
					<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
				</div>
			<?php } else { ?>
				<div class="excerpt">
					<?php $excerpt = get_the_excerpt(); echo esc_html( amiso_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
				</div>
			<?php } ?>
			<?php endif; ?>
			<?php if ( $show_view_details_button == 'yes' ) : ?>
			<?php mascot_core_amiso_get_cpt_shortcode_template_part( 'button', null, 'services/tpl', $params, false ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>