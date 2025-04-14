<div <?php post_class( 'tm-project' ); ?>>
	<div class="project-skin-style3">
		<?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) { ?>
			<div class="thumb">
				<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
			</div>
			<div class="tm-project-content-wrapper">
				<div class="tm-project-content">
					<div class="tm-project-content-inner">
						<div class="tm-project-content-inner-wrapper">
							<div class="icons-holder-inner">
								<div class="styled-icons">
									<a class="lightproject-trigger styled-icons-item" href="<?php the_permalink();?>"><i class="fa fa-plus"></i></a>
								</div>
							</div>
							<div class="project-detials">
								<?php if ( $show_cat == 'yes' ) : ?>
								<ul class="cat-list">
									<?php include('term-list-each-post.php'); ?>
								</ul>
								<?php endif; ?>
								<?php if ( $show_title == 'yes' ) : ?>
								<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>