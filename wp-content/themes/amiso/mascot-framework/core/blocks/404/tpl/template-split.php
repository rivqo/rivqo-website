<section class="page-404-wrapper <?php echo esc_attr( $fullscreen );?> <?php echo esc_attr( $section_classes );?>">
	<div class="display-table">
		<div class="display-table-cell">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="page-404-main-content">

							<?php do_action( 'amiso_page_404_content_start' ); ?>

							<h1 class="title"><?php echo esc_html( $page_title );?></h1>
							<h3 class="sub-title"><?php echo esc_html( $page_subtitle );?></h3>
							<div class="content">
								<?php echo wpautop( do_shortcode( $page_content ) ); ?>
							</div>
							<?php
								if( $show_back_to_home_button ) {
									amiso_get_blocks_template_part( 'back-to-home-button', null, '404/tpl', $params );
								}
							?>

							<?php do_action( 'amiso_page_404_content_end' ); ?>

						</div>
					</div>
					<div class="col-md-5">
						<?php
							if( $show_search_box ) {
								amiso_get_blocks_template_part( 'search-box', null, '404/tpl', $params );
							}
						?>
						<?php
							if( $show_helpful_links ) {
								amiso_get_blocks_template_part( 'helpful-links', null, '404/tpl', $params );
							}
						?>
					</div>
				</div>
				<div class="row <?php echo esc_attr( $text_align );?> mt-30">
					<div class="col-md-12">
					<?php
						if( $show_social_links ) {
							amiso_get_blocks_template_part( 'social-links', null, '404/tpl', $params );
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>