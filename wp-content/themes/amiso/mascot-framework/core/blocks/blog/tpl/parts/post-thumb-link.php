<?php
	$link_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_link_settings", 'link_url' );
	$link_target = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_link_settings", 'link_target' );
	if( $link_target == '' ) $link_target = '_blank';

?>
	<div class="link-content-wrapper">
		<?php if( !empty($link_url) ) : ?>
		<h4 class="title"><?php echo get_the_title(); ?></h4>
		<div class="link"><?php echo esc_html( $link_url );?></div>
		<a target="<?php echo esc_attr( $link_target );?>" class="link-url" href="<?php echo esc_url( $link_url );?>"></a>
		<?php else: ?>
		<h4 class="title"><a href="<?php echo esc_url(get_the_permalink());?>"><?php echo get_the_title(); ?></a></h4>
		<div class="post-excerpt">
			<?php amiso_get_excerpt(); ?>
		</div>
		<?php endif; ?>
	</div>