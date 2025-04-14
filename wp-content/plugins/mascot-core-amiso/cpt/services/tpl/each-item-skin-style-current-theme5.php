<div id="post-<?php the_ID() ?>" <?php post_class( '' ); ?>>
  <div class="service-item-current-style5">
    <div class="thumb">
      <?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
    </div>
    <div class="content">
      <div class="service-icon icon">
        <?php if(isset($service_icon_array_new[get_the_ID()]['icon_type'])) mascot_core_amiso_get_cpt_shortcode_template_part( 'icon', $service_icon_array_new[get_the_ID()]['icon_type'], 'services/tpl', $params, false ); ?>
      </div>
      <?php if ( $show_title == 'yes' ) : ?>
      <<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
      <?php endif; ?>
      <?php if ( $show_excerpt == 'yes' ) : ?>
        <?php if ( empty($excerpt_length) ) { ?>
          <p class="excerpt service-details">
            <?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
          </p>
        <?php } else { ?>
          <p class="excerpt service-details">
            <?php $excerpt = get_the_excerpt(); echo esc_html( amiso_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
          </p>
        <?php } ?>
      <?php endif; ?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <?php mascot_core_amiso_get_cpt_shortcode_template_part( 'button', null, 'services/tpl', $params, false ); ?>
      <?php endif; ?>
    </div>
    <div class="clearfix"></div>
  </div>
</div>