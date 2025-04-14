<?php
$hide_class = "";
if( $hide_this_section_in_responsive == 'yes' ) {
	$hide_class = "hide-this-in-responsive";
}
$repeater_item_class = 'each-item elementor-repeater-item-' . $_id . ' ' .$hide_class;
?>


<div class='ms-section <?php echo esc_attr( $repeater_item_class) ?>'>
	<div class="section-wrapper">
		<?php
		if ( isset($slide_content_templates) ) {
			$id = $slide_content_templates;
			$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($id);
			echo $content;
		}
		?>
	</div>
</div>
