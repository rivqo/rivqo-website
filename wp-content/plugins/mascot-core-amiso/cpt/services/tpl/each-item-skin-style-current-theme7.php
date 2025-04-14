<?php
$title = get_the_title();
$first_letter_title = substr($title,0,1);
?>

<div id="post-<?php the_ID() ?>" <?php post_class( '' );?>>
<div class="service-item-current-style7">
  <div class="service-inner ">
    <div class="image">
      <?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
      <span class="icon"><?php echo $first_letter_title; ?></span>
    </div>
    <?php if ( $show_title == 'yes' ) : ?>
		<<?php echo esc_attr( $title_tag );?> class="title feature-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
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
  </div>
</div>
</div>