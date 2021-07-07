<?php
/**
 * Enqueue front-end scripts and styles
 */
function doublee_enqueue_frontend() {

	// Our styles
	wp_enqueue_style('theme-style', get_template_directory_uri().'/style.css', '', time());

	// Third-party scripts
	if(defined('GMAPS_KEY') && GMAPS_KEY) {
		wp_enqueue_script('gmaps_api', 'https://maps.googleapis.com/maps/api/js?key='.GMAPS_KEY, '', '', true);
	}

	// Our scripts
	wp_enqueue_script('vendor-scripts', get_template_directory_uri().'/js/dist/vendor.min.js', array('jquery'),'', true);
	wp_enqueue_script('theme-script', get_template_directory_uri().'/js/dist/theme.min.js', array('jquery'),'', true);
}
add_action('wp_enqueue_scripts', 'doublee_enqueue_frontend');


/**
 * Enqueue CMS scripts and styles
 */
function doublee_enqueue_admin() {
	add_editor_style(get_template_directory_uri().'/dist/css/editor-styles.css');
}
add_action('admin_init', 'doublee_enqueue_admin');
