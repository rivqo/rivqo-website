<?php
	$video_type = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_type' );

	$youtube_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_youtube_url' );
	$vimeo_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_vimeo_url' );

	$self_hosted_video_image = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_self_hosted_video_image' );
	$self_hosted_mp4_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_self_hosted_mp4_url' );
	$self_hosted_webm_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_self_hosted_webm_url' );
	$self_hosted_ogv_url = amiso_get_rwmb_group( 'amiso_' . "blog_mb_pf_video_settings", 'video_self_hosted_ogv_url' );


	$self_hosted_video_image_url = '';
	if ( !empty( $self_hosted_video_image ) ) {
		foreach ( $self_hosted_video_image as $each_gallery_image ) {
			$self_hosted_video_image_url = $each_gallery_image['url'];
		}
	}

?>
<div class="post-thumb">
	<?php amiso_get_blocks_template_part( 'thumb', null, 'blog/tpl/parts', $params ); ?>
	<?php
		if( $video_type == 'youtube' ){
			if( $youtube_url ){
				echo wp_oembed_get( $youtube_url );
			}
		}elseif( $video_type == 'vimeo' ){
			if( $vimeo_url ){
				echo wp_oembed_get( $vimeo_url );
			}
		}elseif( $video_type == 'self_hosted' ){
?>
	<div class="video-player-wrapper">
		<video width="640" height="360" id="video-player-post-<?php the_ID(); ?>" class="video w-100 h-100" poster="<?php echo esc_url( $self_hosted_video_image_url );?>" controls preload="none">
			<!-- MP4 source must come first for iOS -->
			<source type="video/mp4" src="<?php echo esc_url( $self_hosted_mp4_url );?>" />
			<!-- WebM for Firefox 4 and Opera -->
			<source type="video/webm" src="<?php echo esc_url( $self_hosted_webm_url );?>" />
			<!-- OGG for Firefox 3 -->
			<source type="video/ogg" src="<?php echo esc_url( $self_hosted_ogv_url );?>" />
			<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
			<object width="320" height="180" type="application/x-shockwave-flash" data="<?php AMISO_TEMPLATE_URI . '/assets/js/mediaelementjs'?>/flashmediaelement.swf">
				<param name="movie" value="<?php AMISO_TEMPLATE_URI . '/assets/js/mediaelementjs'?>/flashmediaelement.swf" />
				<param name="flashvars" value="controls=true&amp;file=<?php echo esc_url( $self_hosted_mp4_url );?>" />
				<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed -->
				<img src="<?php echo esc_url( $self_hosted_video_image_url );?>" width="640" height="360" alt="<?php the_title_attribute(); ?>"
					title="<?php esc_attr_e( 'No video playback capabilities', 'amiso' ); ?>" />
			</object>
		</video>
	</div>
<?php

		}
	?>
</div>