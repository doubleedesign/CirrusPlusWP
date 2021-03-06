<?php
/**
 * Register custom image sizes
 */
function doublee_register_image_sizes() {
	//add_image_size('container_width', 1280, 0, false);
}
add_action('after_setup_theme', 'doublee_register_image_sizes');


/*
 * Convert an iframe (like from an ACF oEmbed field) to a Vimeo background embed
 */
function doublee_convert_embed_to_vimeo_background($embed) {
	if($embed && strpos($embed, 'vimeo.com') !== false) {
		$embed = doublee_add_params_to_embed($embed, array('background' => 1));
	}

	return $embed;
}

/*
 * Add extra parameters to an embed's src attribute
 */
function doublee_add_params_to_embed($embed, $params) {
	// Break at the src attribute
	$embed = explode('src="', $embed, 2);
	$before_src = $embed[0];

	// Break after the src attribute value
	$embed = explode('"', $embed[1], 2);
	$after_src = $embed[1];

	// Add the background parameter to the src attribute value
	$src = $embed[0];
	$src = add_query_arg($params, $src);

	// Reassemble
	$embed = $before_src.'src="'.$src.'"'.$after_src;

	return $embed;
}