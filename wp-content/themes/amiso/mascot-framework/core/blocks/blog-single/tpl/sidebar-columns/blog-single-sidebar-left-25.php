<div class="row tm-blog-sidebar-row has-sidebar-left">
	<div class="col-lg-9">
		<div class="main-content-area">
			<?php do_action( 'amiso_blog_single_main_content_area_start' ); ?>

			<?php
				amiso_get_blog_single_all();
			?>

			<?php do_action( 'amiso_blog_single_main_content_area_end' ); ?>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="sidebar-area tm-sidebar-area sidebar-left">
			<div class="sidebar-area-inner">
				<?php get_sidebar( 'left' ); ?>
			</div>
		</div>
	</div>
</div>