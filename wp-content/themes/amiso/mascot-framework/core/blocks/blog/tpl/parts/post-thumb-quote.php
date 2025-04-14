<?php
	$quote_quote = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_quote_settings", 'quote' );
	$quote_author = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_quote_settings", 'quote_author' );
	$quote_position = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_quote_settings", 'quote_position' );
?>
	<div class="quote-content-wrapper">
		<blockquote class="highlighted-quote">
			<?php if( !empty($quote_quote) ) : ?>
			<h4 class="quote"><a href="<?php echo esc_url(get_the_permalink());?>"><?php echo esc_html( $quote_quote ); ?></a></h4>
			<footer><?php echo esc_html( $quote_author ); ?> <cite><?php echo esc_html( $quote_position ); ?></cite></footer>
			<?php else: ?>
			<h4 class="title"><a href="<?php echo esc_url(get_the_permalink());?>"><?php echo get_the_title(); ?></a></h4>
			<div class="post-excerpt">
				<?php amiso_get_excerpt(); ?>
			</div>
			<?php endif; ?>
		</blockquote>
	</div>
