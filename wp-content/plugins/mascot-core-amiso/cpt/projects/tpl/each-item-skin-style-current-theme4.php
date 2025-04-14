<div class="projects-current-theme4">
  <div class="inner-box">
    <a href="<?php the_permalink();?>" class="image-box">
      <?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
    </a>
    <div class="overlay-box">
      <?php if ( $show_title == 'yes' ) : ?>
        <<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
      <?php endif; ?>
      <?php if ( $show_cat == 'yes' ) : ?>
        <ul class="cat-list">
          <?php include('term-list-each-post.php'); ?>
        </ul>
      <?php endif; ?>
    </div>
    <a href="<?php the_permalink();?>" class="arrow">+</a>
  </div>
</div>