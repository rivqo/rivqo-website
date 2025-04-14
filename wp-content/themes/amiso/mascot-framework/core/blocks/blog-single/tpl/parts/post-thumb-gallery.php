<?php amiso_enqueue_script_lightgallery(); ?>
<?php amiso_enqueue_script_owl_carousel(); ?>
<?php $gallery_images = amiso_get_rwmb_group_advanced( 'amiso_' . "blog_mb_pf_gallery_settings",  "gallery_images", null, false, 'all', 'large' );?>

<?php if ( has_post_thumbnail() || !empty( $gallery_images ) ) { ?>
<div class="post-thumb lightgallery-lightbox">
	<div class="owl-carousel owl-theme tm-owl-carousel-1col owl-dots-center-bottom" data-nav="true" data-dots="true" data-autoplay="true">
		<?php
		if ( has_post_thumbnail() ) {
			$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$full_image_url = $full_image_url[0];
		?>

		<div class="box-hover-effect">
			<div class="effect-wrapper">
				<div class="thumb">
					<?php amiso_get_blocks_template_part( 'thumb', null, 'blog-single/tpl/parts', $params ); ?>
				</div>
				<div class="overlay-shade"></div>
				<div class="icons-holder icons-holder-middle">
					<div class="icons-holder-inner">
						<div class="styled-icons icon-sm icon-dark">
							<a class="lightgallery-trigger styled-icons-item" href="<?php echo esc_url( $full_image_url );?>" title="<?php the_title_attribute(); ?>" data-exthumbimage="<?php echo esc_url( $full_image_url );?>" data-src="<?php echo esc_url( $full_image_url );?>"><i class="fa fa-picture-o"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		}


		if ( !empty( $gallery_images ) ) {
			foreach ( $gallery_images as $each_gallery_image ) {
		?>
		<div class="box-hover-effect">
			<div class="effect-wrapper">
				<div class="thumb">
					<img src="<?php echo esc_url( $each_gallery_image['url'] );?>" alt="<?php the_title_attribute(); ?>" class="img-fluid">
				</div>
				<div class="overlay-shade"></div>
				<div class="icons-holder icons-holder-middle">
					<div class="icons-holder-inner">
						<div class="styled-icons icon-sm icon-dark">
							<a class="lightgallery-trigger styled-icons-item" href="<?php echo esc_url( $each_gallery_image['full_url'] );?>" title="<?php the_title_attribute(); ?>" data-exthumbimage="<?php echo esc_url( $each_gallery_image['full_url'] );?>" data-src="<?php echo esc_url( $each_gallery_image['full_url'] );?>"><i class="fa fa-picture-o"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		}
		?>
	</div>
</div>
<?php } ?>