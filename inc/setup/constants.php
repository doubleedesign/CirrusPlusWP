<?php
/**
 * Define constants
 * See https://stackoverflow.com/questions/1290318/php-constants-containing-arrays if using PHP < 7
 */
function doublee_register_constants() {
	define('MODULES_FIELD_NAME', 'content_modules');
	define('MODULES_POST_TYPES', array('page'));
	define('MODULES_PARTIAL_PATH', 'partials/modules/');
	define('MODULES_TAXONOMIES', array('category'));
	define('MODULES_OPTIONS_PAGES', array()); // TODO
	define('GMAPS_KEY', '');
}
add_action('init', 'doublee_register_constants', 10);