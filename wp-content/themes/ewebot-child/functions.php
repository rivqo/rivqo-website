<?php

 function gt3_child_scripts() {
   wp_enqueue_style( 'gt3-parent-style', get_template_directory_uri(). '/style.css' );
   wp_enqueue_style( 'gt3-child-style', get_stylesheet_directory_uri(). '/style.css' );
 }
add_action( 'wp_enqueue_scripts', 'gt3_child_scripts' );

/**
 * Your code here.
 *
 */
