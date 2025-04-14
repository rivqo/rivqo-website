<?php
if ( is_single() ) :
	the_title( '<h2 class="entry-title">', '</h2>' );
else :
	the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
endif;