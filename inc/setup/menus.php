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


/**
 * Add classes to header menu <li> tags
 * @param $classes
 * @param $item
 * @param $args
 * @param $depth
 *
 * @return mixed
 */
function doublee_header_menu_item_class($classes, $item, $args, $depth) {
	array_push($classes, 'nav-item');

	if($args->theme_location == 'header-menu' && in_array('menu-item-has-children', $classes)) {
		array_push($classes, 'has-sub');
		array_push($classes, 'toggle-hover');
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'doublee_header_menu_item_class', 10, 4);


function doublee_header_menu_link_class($atts, $item, $args, $depth) {

	if($args->theme_location == 'header-menu' && $depth == 0 && in_array('menu-item-has-children', $item->classes)) {
		$atts['class'] = 'nav-dropdown-link';
	}

	return $atts;
}
add_filter('nav_menu_link_attributes', 'doublee_header_menu_link_class', 10, 4);


/**
 * Add classes to sub-menu <ul> in header menu
 * @param $classes
 * @param $args
 *
 * @return mixed
 */
function doublee_header_menu_submenu_class($classes, $args) {
	if($args->theme_location == 'header-menu') {
		array_push($classes, 'dropdown-menu');
		array_push($classes, 'dropdown-animated');
	}

	return $classes;
}
add_filter('nav_menu_submenu_css_class', 'doublee_header_menu_submenu_class', 10, 2);