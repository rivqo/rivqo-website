<div class="section-wrapper">
	<div class="pp-content">
		<?php
		if ( isset($slide_content_templates) ) {
			$id = $slide_content_templates;
			$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($id);
			echo $content;
		}
		?>
	</div>
</div>
