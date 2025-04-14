<?php $full_image_url = get_the_post_thumbnail_url( get_the_ID(), $feature_thumb_image_size ); ?>
<div id="post-<?php the_ID() ?>" <?php post_class( '' ); ?>>
  <div class="service-item-current-style6" style="--service-current-style6-bg-featured-image: url('<?php echo esc_url($full_image_url);?>');">
    <div class="service-inner">
      <a class="service-infobox-link" href="<?php the_permalink();?>"></a>
      <div class="service-infobox-wrapper">
        <div class="content-wrapper">
          <div class="infobox-title-wrapper">
            <?php if ( $show_title == 'yes' ) : ?>
            <<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
            <?php endif; ?>
          </div>
        </div>
        <div class="service-infobox-button_wrapper">
          <div class="service-infobox-button">
            <span class="infobox_button">
              <img decoding="async" src="<?php echo esc_url(MASCOT_CORE_AMISO_URL_PATH . 'assets/images/current-theme/arrow-white.png')?>" alt="image">
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>