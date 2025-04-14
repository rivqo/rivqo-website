<!-- Blog Masonry -->
<div id="blog-isotope-grid" class="isotope-layout blog-archive grid-3 gutter clearfix">
	<div class="isotope-layout-inner">
		<?php
        if ( have_posts() ) :
            // Start the Loop.
            while ( have_posts() ) : the_post();
            ?>
            <!-- Blog Item Start -->
            <div class="isotope-item">
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
</div>