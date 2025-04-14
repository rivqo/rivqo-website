<!-- Project Block Three -->
<?php
$title = ( $title_html_tag_allow == 'yes' ) ? get_the_title() : wp_strip_all_tags(get_the_title());
if ( isset($project_title_array_new[get_the_ID()]) && !empty($project_title_array_new[get_the_ID()])) {
	$title = $project_title_array_new[get_the_ID()];
}
$counter ='01';
if ( isset($project_counter_array_new[get_the_ID()]) && !empty($project_counter_array_new[get_the_ID()])) {
	$counter = $project_counter_array_new[get_the_ID()];
}
?>

<!-- Project Block Four -->
<div class="projects-current-theme5">
  <div class="inner-box">
    <span class="count"><?php echo sprintf("%02d", $counter);?></span>
    <?php if ( $show_title == 'yes' ) : ?>
      <<?php echo esc_attr( $title_tag );?> class="title service-title">
      <?php if ( $link_title ) { ?>
      <a href="<?php the_permalink();?>"><?php echo $title;?></a>
      <?php } else { ?>
      <?php echo $title;?>
      <?php } ?>
      </<?php echo esc_attr( $title_tag );?>>
    <?php endif; ?>
    <a href="<?php the_permalink();?>" class="icon-box"><i class="icon-arrow"></i></a>
    <div class="image">
        <?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
    </div>
  </div>
</div>