<?php
$title = ( $title_html_tag_allow == 'yes' ) ? get_the_title() : wp_strip_all_tags(get_the_title());
if ( isset($service_title_array_new[get_the_ID()]) && !empty($service_title_array_new[get_the_ID()])) {
	$title = $service_title_array_new[get_the_ID()];
}
?>
<?php if ( $show_title == 'yes' ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="title service-title">
	<?php if ( $link_title ) { ?>
	<a href="<?php the_permalink();?>"><?php echo $title;?></a>
	<?php } else { ?>
	<?php echo $title;?>
	<?php } ?>
	</<?php echo esc_attr( $title_tag );?>>
<?php endif; ?>