<section>
	<div class="<?php echo esc_attr( $container_type ); ?>">
		<div class="row">
			<?php if ( is_active_sidebar('default-sidebar')  ) { ?>
			<div class="col-lg-8">
			<?php } else { ?>
			<div class="col-lg-12">
			<?php } ?>
				<div class="main-content-area">
					<?php do_action( 'amiso_search_result_page_main_content_area_start' ); ?>
					<div class="new-search-form">
						<h3 class="search-title"><?php esc_html_e( 'New Search', 'amiso' ); ?></h3>
						<p class="search-text"><?php esc_html_e( 'Not happy with the results? Type your search again', 'amiso' ); ?></p>
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" class="form-control search-field" placeholder="<?php echo esc_attr__( 'Search &hellip;', 'amiso' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
							<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
						</form>
					</div>

					<?php
					if ( have_posts() ) :

					// Start the Loop.
					while ( have_posts() ) : the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						if ( has_post_thumbnail() ) {
						?>
						<div class="row">
							<div class="col-md-3">
								<div class="entry-header">
								<?php the_post_thumbnail( 'amiso_featured_image' ); ?>
								</div>
							</div>
							<div class="col-md-9">
								<div class="entry-content">
									<h4 class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title(); ?></a></h4>
									<div class="post-excerpt">
										<?php amiso_get_excerpt(); ?>
									</div>
									<?php echo amiso_blog_read_more_link(); ?>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<?php
						} else {
						?>
						<div class="entry-content">
							<h4 class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title(); ?></a></h4>
							<div class="post-excerpt">
								<?php amiso_get_excerpt(); ?>
							</div>
							<?php echo amiso_blog_read_more_link(); ?>
							<div class="clearfix"></div>
						</div>
						<?php
						}
						?>
					</article>
					<?php
					endwhile;

					// Previous/next page navigation.
					amiso_get_pagination();

					else :

					// If no content, include the "No posts found" template.
					?>
					<p><?php esc_html_e( 'Sorry, no results were found for this query', 'amiso' ); ?>!</p>
					<?php
					endif;
					?>
					<?php do_action( 'amiso_search_result_page_main_content_area_end' ); ?>
				</div>
			</div>
			<?php if ( is_active_sidebar('default-sidebar')  ) { ?>
			<div class="col-lg-4">
				<div class="sidebar-area tm-sidebar-area sidebar-right">
					<div class="sidebar-area-inner">
						<?php get_sidebar( 'right' ); ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>