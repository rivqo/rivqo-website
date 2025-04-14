<p class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<span class="dropcaps" <?php echo html_entity_decode( esc_attr( $text_inline_css ) );?>><?php echo esc_html($text[0]); ?></span><?php echo esc_html(substr($text, 1)); ?>
</p>