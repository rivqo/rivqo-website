<div class="row post-standard-1col-classic">
	<?php
	if ( have_posts() ) :
		// Start the Loop.
		while ( have_posts() ) : the_post();
		?>
		<div class="col-md-12">
		<?php
			amiso_get_blog_post_format( get_post_format() );
		?>
		</div>
		<?php
		endwhile;
	else :
		// If no content, include the "No posts found" template.
		echo esc_html( "No posts found!" );
	endif;
	?>
</div>