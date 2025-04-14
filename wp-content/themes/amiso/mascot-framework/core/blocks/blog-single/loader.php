<?php
if ( mascot_core_plugin_installed() && mascot_core_amiso_plugin_installed() ) {
	require_once AMISO_FRAMEWORK_DIR . '/core/blocks/blog-single/blog-single-metabox.php';
}
require_once AMISO_FRAMEWORK_DIR . '/core/blocks/blog-single/blog-single-css-generators.php';
require_once AMISO_FRAMEWORK_DIR . '/core/blocks/blog-single/blog-single-functions.php';