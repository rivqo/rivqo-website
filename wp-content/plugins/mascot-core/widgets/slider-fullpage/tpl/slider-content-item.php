<?php
$repeater_item_class = 'each-item elementor-repeater-item-' . $_id;
?>
<div class='slide <?php echo esc_attr( $repeater_item_class) ?>'>
	<div class="section-wrapper">
		<div class="fp-content">
			<?php
			if ( isset($slide_content_templates) ) {
				$id = $slide_content_templates;
				$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($id);
				echo $content;
			}
			?>
		</div>
	</div>
</div>
