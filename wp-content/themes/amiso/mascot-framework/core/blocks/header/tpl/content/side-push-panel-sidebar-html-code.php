
	<div class="side-panel-body-overlay"></div>
	<div id="<?php echo esc_attr($holder_id)?>" class="side-panel-container <?php echo esc_attr(implode(' ', $classes)); ?>">
		<div class="side-panel-wrap">
			<div class="side-panel-trigger side-panel-trigger-close" data-target="<?php echo esc_attr($holder_id)?>"><a href="#"><i class="fa fa-times side-panel-trigger-icon"></i></a></div>




			<?php
				$side_push_panel_cpt_post = amiso_get_redux_option( 'header-settings-choose-side-push-panel-cpt-widget-area' );
			?>


			<?php if ( !$side_push_panel_cpt_post ) : ?>
			<h4><?php esc_html_e( 'This is your Side Push Panel Sidebar!', 'amiso' )?></h4>
			<p><?php echo sprintf( esc_html__( 'Step 1: Please add your content to this section from %1$sAdmin Dashboard > Parts - Side Push Panel %2$s (Side Push Panel Sidebar).', 'amiso' ), '<strong>', '</strong>')?></p>
			<p><?php echo sprintf( esc_html__( 'Step 2: Goto %1$sTheme Options > Side Push Panel Sidebar%2$s and select it from the dropdown menu.', 'amiso' ), '<strong>', '</strong>')?></p>
			<p><?php echo esc_html__( 'It\'s done!', 'amiso' )?></p>


			<?php else: ?>
			<?php
				//query args
				$post_id = '';
				$posts = get_posts([
					'post_type' => 'side-push-panel',
					'post_status' => 'publish',
					'include' => $side_push_panel_cpt_post,
				]);
				foreach ( $posts as $post ) {
					$post_id = $post->ID;
				}
			?>
			<?php if( $post_id ) { ?>
			<div class="header-top-cpt">
				<?php
					if ( did_action( 'elementor/loaded' ) ) {
						$pluginElementor = \Elementor\Plugin::instance();

						// Set edit mode as false, so don't render settings and etc. ( not need for get_builder_content_for_display() )
						$is_edit_mode = $pluginElementor->editor->is_edit_mode();
						$pluginElementor->editor->set_edit_mode( false );

						//$inline_css = $inline_css ? true : $is_edit_mode;
						$contentElementor = htmlentities($pluginElementor->frontend->get_builder_content( $post_id, true ));

						// Restore edit mode ( not need for get_builder_content_for_display() )
						$pluginElementor->editor->set_edit_mode( $is_edit_mode );
						echo html_entity_decode($contentElementor);
					}
				?>
			</div>
			<?php } ?>
			<?php endif; ?>


		</div>
	</div>