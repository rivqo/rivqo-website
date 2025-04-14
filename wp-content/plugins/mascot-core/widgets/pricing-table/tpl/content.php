<ul class="features-list">
<?php 
//echo wp_kses( $content, 'post' );

foreach (  $settings['features_list'] as $item ) {
	$feature_classes = array();
	if( $item['disable_item'] == 'yes' ) {
		$feature_classes[] = 'no-action';
	}
	if( $item['line_through'] == 'yes' ) {
		$feature_classes[] = 'line-through';
	}
	?>
	<li class="<?php echo esc_attr(implode(' ', $feature_classes)); ?>">
		<?php 

			if( $item['disable_item'] == 'yes' ) {
				\Elementor\Icons_Manager::render_icon( $settings['features_list_noaction_icon'], [ 'aria-hidden' => 'true' ] );
			} else if( $item['line_through'] == 'yes' ) {
				\Elementor\Icons_Manager::render_icon( $settings['features_list_line_through_icon'], [ 'aria-hidden' => 'true' ] );
			} else {
				\Elementor\Icons_Manager::render_icon( $settings['features_list_icon'], [ 'aria-hidden' => 'true' ] );
			}
		?>
		<span>
		<?php
			echo wp_kses( 
				$item['content'],
				array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
				)
			);
		?>
		</span>
		<div class="has-tooltip" data-toggle="tooltip" title="<?php echo esc_attr($item['tooltip_text']); ?>"><i class="fas fa-info-circle"></i></div>
	</li>
<?php } ?>
</ul>