<?php
	$link_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_link_settings", 'link_url' );
	$link_target = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_link_settings", 'link_target' );
	if( $link_target == '' ) $link_target = '_blank';
	if( !empty($link_url) ) :
?>
<a target="<?php echo esc_attr( $link_target );?>" class="post-link text-center display-block" href="<?php echo esc_url( $link_url );?>">
	<?php echo get_the_title(); ?> <span><?php echo esc_html( $link_url );?></span>
</a>
<?php else: ?>
<div class="post-excerpt">
	<?php the_content();?>
	<div class="clearfix"></div>
</div>
<?php endif; ?>