<div class="row tm-blog-sidebar-row">
	<div class="col-lg-4">
		<div class="sidebar-area tm-sidebar-area sidebar-left">
			<div class="sidebar-area-inner">
				<?php get_sidebar( 'left' ); ?>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="main-content-area">
			<?php do_action( 'amiso_page_main_content_area_start' ); ?>
			<?php
				amiso_get_page_content();
			?>
			<?php do_action( 'amiso_page_main_content_area_end' ); ?>
		</div>
	</div>
</div>