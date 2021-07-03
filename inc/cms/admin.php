<?php
/**
 * Remove the margin-top on <html> that the admin bar applies
 */
add_theme_support('admin-bar', array('callback' => '__return_false'));


/**
 * Customise login screen logo
 */
function doublee_login_logo() {
	?>
	<style type="text/css">
		.login h1 a {
			background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/header-logo.png') !important;
			padding-bottom: 0 !important;
			background-size: contain !important;
			background-position: center !important;
			height: 52px !important;
			width: 237px !important;
		}
	</style>
	<?php
}
add_action('login_enqueue_scripts', 'doublee_login_logo');


/**
 * Change the excerpt explanation in the backend
 * @param $translated_text
 * @param $text
 * @param $domain
 *
 * @return string
 */
function doublee_change_excerpt_explanation( $translated_text, $text, $domain ) {
	$post_type = get_post_type();
	switch ($translated_text) {
		case 'Excerpts are optional hand-crafted summaries of your content that can be used in your theme. <a href="%s">Learn more about manual excerpts</a>.' :
			if($post_type == 'page') {
				$translated_text = 'Preview text';
				break;
			}
			if($post_type == 'post') {
				$translated_text = 'Preview text';
				break;
			}
	}

	return $translated_text;
}
add_filter( 'gettext', 'doublee_change_excerpt_explanation', 20, 3 );


/**
 * Move Yoast SEO to the bottom of edit screens
 */
add_filter( 'wpseo_metabox_prio', 'doublee_move_yoast_seo_metabox' );
function doublee_move_yoast_seo_metabox() {
	return 'low';
}


/**
 * Remove unwanted metaboxes
 */
function doublee_remove_meta_boxes() {
	remove_meta_box('nf_admin_metaboxes_appendaform', array('page', 'post'), 'side');
}
add_action('add_meta_boxes', 'doublee_remove_meta_boxes',  99);


/**
 * Load editor styles in ACF WYSIWYG fields
 * Ref: https://pagegwood.com/web-development/custom-editor-stylesheets-advanced-custom-fields-wysiwyg/
 * @param $mce_init
 *
 * @return mixed
 */
function doublee_add_editor_styles_to_tinymce($mce_init) {

	$content_css = '/dist/css/editor-styles.css';
	$version = filemtime(get_stylesheet_directory() . $content_css);
	$content_css = get_stylesheet_directory_uri() . $content_css . '?v=' . $version; // it caches hard, use this to force a refresh

	if (isset($mce_init[ 'content_css' ])) {
		$content_css_new =  $mce_init['content_css'].','.$content_css;
		$mce_init['content_css'] = $content_css_new;
	}

	return $mce_init;
}
add_filter('tiny_mce_before_init', 'doublee_add_editor_styles_to_tinymce');


/**
 * Add predefined colours to TinyMCE
 * @param $buttons
 *
 * @return mixed
 */
/*function doublee_add_mce_colours($settings) {
	$colours = array(
		'000000' => 'Black',
		'FFFFFF' => 'White',
	);

	if(!empty($colours)) {
		$map = array();
		foreach($colours as $value => $label) {
			$map[] = '"'.$value.'","'.$label.'"';
		}

		$settings['textcolor_map'] = '['.implode($map, ',').']';
	}

	return $settings;
}
add_filter('tiny_mce_before_init', 'doublee_add_mce_colours');
*/


/**
 * Add custom text formats to TinyMCE
 * Note: 'selector' for block-level element that format is applied to; 'inline' to add wrapping tag e.g.'span'
 * @param $buttons
 *
 * @return mixed
 */
function doublee_add_mce_styleselect($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'doublee_add_mce_styleselect');

function doublee_add_mce_styles($init_array) {
	$style_formats = array(
		array(
			'title' => 'Lead paragraph',
			'selector' => 'p',
			'classes' => 'lead'
		),
	);

	$init_array['style_formats'] = json_encode($style_formats);

	return $init_array;
}
add_filter('tiny_mce_before_init', 'doublee_add_mce_styles');


/**
 * Add custom image sizes to to editor image size dropdown
 */
/*function doublee_media_sizes_dropdown($sizes) {
	$sizes['container_width'] = 'Container width';

	return $sizes;
}
add_filter('image_size_names_choose', 'doublee_media_sizes_dropdown');
*/


/**
 * Add "attachment" post type to link popup search
 * @param $query
 *
 * @return array
 */
function doublee_link_query($query) {
	$query['post_type'][] = 'attachment';
	$query['post_status'] = array($query['post_status'], 'inherit');

	return $query;
}
add_filter('wp_link_query_args', 'doublee_link_query', 10, 1);

function doublee_link_query_results($results) {
	array_walk($results, function(&$r) {
		$post = get_post($r['ID']);
		if($post->post_type == 'attachment') {
			$r['permalink'] = $post->guid;
		}
	});

	return $results;
}
add_filter('wp_link_query', 'doublee_link_query_results', 10, 1);