<div class="info-box">
  <?php if ( $show_date == 'yes' ) : ?>
  <div class="info-left">
    <div class="date">
      <?php if ( $date_year_placement == 'top' ) : ?>
      <span class="year"><?php echo esc_html( $item['date_year'] ); ?></span>
      <?php endif; ?>
      <span class="month"><?php echo esc_html( $item['date_month'] ); ?></span>
      <?php if ( $date_year_placement == 'bottom' ) : ?>
      <span class="year"><?php echo esc_html( $item['date_year'] ); ?></span>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="info-content">
    <?php if ( $show_subtitle == 'yes' &&  $subtitle_placement == 'top' ) : ?>
    <div class="subtitle"><?php echo esc_html( $item['subtitle'] ); ?></div>
    <?php endif; ?>

    <?php if ( $show_title == 'yes' ) : ?>
    <<?php echo esc_attr( $item['title_tag'] ); ?> class="title"><?php echo esc_html( $item['title'] ); ?></<?php echo esc_attr( $item['title_tag'] ); ?>>
    <?php endif; ?>

    <?php if ( $show_subtitle == 'yes' &&  $subtitle_placement == 'center' ) : ?>
    <div class="subtitle"><?php echo esc_html( $item['subtitle'] ); ?></div>
    <?php endif; ?>

    <?php if ( $show_excerpt == 'yes' ) : ?>
    <div class="content">
      <?php echo do_shortcode($item['content']); ?>
    </div>
    <?php endif; ?>

    <?php if ( $show_subtitle == 'yes' &&  $subtitle_placement == 'bottom' ) : ?>
    <div class="subtitle"><?php echo esc_html( $item['subtitle'] ); ?></div>
    <?php endif; ?>
  </div>
</div>