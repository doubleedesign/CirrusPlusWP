<?php
/**
 * Enqueue front-end scripts and styles
 */
function doublee_enqueue_frontend() {
	// Dequeue existing scripts
	wp_dequeue_script('jquery');
	wp_deregister_script('jquery');

	// Third-party styles

	// Our styles
	wp_enqueue_style('main-style', get_template_directory_uri().'/dist/css/main.min.css');

	// Third-party scripts
	wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.4.1.min.js', '', '', true);
	if(defined('GMAPS_KEY') && GMAPS_KEY) { wp_enqueue_script('gmaps_api', 'https://maps.googleapis.com/maps/api/js?key='.GMAPS_KEY, '', '', true); }

	// Our scripts
	wp_enqueue_script('vendor-script', get_template_directory_uri().'/dist/js/vendor.min.js', 'jquery','', true);
	wp_enqueue_script('main-script', get_template_directory_uri().'/dist/js/main.min.js', array('jquery', 'bootstrap'),'', true);
}
add_action('wp_enqueue_scripts', 'doublee_enqueue_frontend');


/**
 * Enqueue CMS scripts and styles
 */
function doublee_enqueue_admin() {
	add_editor_style(get_template_directory_uri().'/dist/css/editor-styles.css');
}
add_action('admin_init', 'doublee_enqueue_admin');
