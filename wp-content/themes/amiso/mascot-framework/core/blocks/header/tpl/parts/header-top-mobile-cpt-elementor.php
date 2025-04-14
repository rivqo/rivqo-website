<?php if( $header_top_mobile_cpt_post ) { ?>
<div id="elementor-header-top-mobile">
	<div id="tm-header-mobile">
		<div id="tm-header-main" class="tm-header-main">
			<div class="container-fluid">
				<div class="row">
					<div class="tm-header-branding">
						<?php
							/**
							* amiso_header_logo hook.
							*
							* @hooked amiso_get_header_logo
							*/
							do_action( 'amiso_header_logo' );
						?>
					</div>
					<div class="tm-header-menu">
						<div class="tm-header-menu-scroll">
							<div class="tm-menu-close tm-close"></div>
							<?php
								//query args
								$args = array(
									'post_type' => 'header-top',
									'p' => $header_top_mobile_cpt_post,
								);
								$the_query = new \WP_Query( $args );
								$params['the_query'] = $the_query;
								if ( $the_query->have_posts() ) :
									while ( $the_query->have_posts() ) :
										$the_query->the_post();
										the_content(get_the_ID());
									endwhile;
									wp_reset_postdata();
								endif;
							?>
						</div>
					</div>
					<div class="tm-header-menu-backdrop"></div>
				</div>
			</div>
			<div id="tm-nav-mobile">
				<div class="tm-nav-mobile-button"><span></span></div>
			</div>
		</div>
	</div>
</div>
<?php } ?>