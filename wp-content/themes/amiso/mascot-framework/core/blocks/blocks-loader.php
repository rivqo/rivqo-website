<?php

/* Loads all blocks located in blocks folder
================================================== */
if( !function_exists('amiso_load_all_template_parts') ) {
	function amiso_load_all_template_parts() {
		foreach( glob(AMISO_FRAMEWORK_DIR.'/core/blocks/*/loader.php') as $each_template_part_loader ) {
			require_once $each_template_part_loader;
		}
	}
	add_action('amiso_before_custom_action', 'amiso_load_all_template_parts');
}