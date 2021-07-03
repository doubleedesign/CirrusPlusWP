<?php
/**
 * Register theme support for the relevant features
 */
function doublee_register_theme_support() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'doublee_register_theme_support');