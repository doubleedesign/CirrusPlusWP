<?php
/**
 * Register menus
 */
function doublee_register_menus() {
	register_nav_menus(array(
		'header-menu' => 'Header menu',
		'footer-menu' => 'Footer menu'
	));
}
add_action('init', 'doublee_register_menus');