<div class="testimonial-block-two">
  <div class="inner-box">
    <div class="image-box">
      <?php if ( $show_testimonial_text == 'yes' ) : ?>
        <?php mascot_core_amiso_get_cpt_shortcode_template_part( 'author-text', null, 'testimonials/tpl', $params, false ); ?>
      <?php endif; ?>
      <div class="info-box">
        <?php if ( $show_author_name == 'yes' ) : ?>
          <<?php echo esc_attr( $author_name_tag );?> class="name"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_name' ) );?></<?php echo esc_attr( $author_name_tag );?>>
        <?php endif; ?>
        <?php if ( $show_author_job_position == 'yes' ) : ?>
          <span class="job-position"><?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "testimonials_mb_settings", 'author_job_position' ) );?></span>
        <?php endif; ?>
        <span class="icon icon-quote"></span>
      </div>
      <div class="rating">
        <?php if ( $show_rating == 'yes' ) : ?>
          <?php include( 'star-rating.php' ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>