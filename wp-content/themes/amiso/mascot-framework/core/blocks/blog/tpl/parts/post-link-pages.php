<?php
	wp_link_pages( array(
		'before'		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'amiso' ) . '</span>',
		'after'		=> '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'	=> '<span class="screen-reader-text">' . esc_html__( 'Page', 'amiso' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) );
?>