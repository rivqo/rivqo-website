      <div class="info-box">
        <?php if ( $show_title == 'yes' ) : ?>
        <<?php echo esc_attr( $item['title_tag'] ); ?> class="title"><?php echo esc_html( $item['title'] ); ?></<?php echo esc_attr( $item['title_tag'] ); ?>>
        <?php endif; ?>

        <?php if ( $show_subtitle == 'yes' ) : ?>
        <div class="subtitle"><?php echo esc_html( $item['subtitle'] ); ?></div>
        <?php endif; ?>

        <?php if ( $show_date == 'yes' ) : ?>
        <div class="date">
          <?php echo esc_html( $item['date_range'] ); ?>
        </div>
        <?php endif; ?>

        <?php if ( $show_excerpt == 'yes' ) : ?>
        <div class="content">
          <?php echo do_shortcode($item['content']); ?>
        </div>
        <?php endif; ?>
      </div>