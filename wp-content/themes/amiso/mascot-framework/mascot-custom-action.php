<?php

// Custom Action for this theme
add_action('after_setup_theme', 'amiso_custom_action_init', 0);

function amiso_custom_action_init() {

	do_action('amiso_before_custom_action');

	do_action('amiso_custom_action');

	do_action('amiso_after_custom_action');
}