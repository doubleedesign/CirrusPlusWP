<?php
/**
 * Get the visual page title, or if empty get the regular title
 * @return string

 * @uses Advanced Custom Fields
 */
function doublee_get_page_title() {
	if((class_exists('ACF')) && get_field('visual_page_title')) {
		return get_field('visual_page_title');
	} else {
		return get_the_title();
	}
}


/**
 * Get post entry meta in a consistent format
 * @return string
 */
function doublee_entry_meta() {
	$meta = '<span class="byline author">';
	$meta .= __( 'Posted by ', '' );
	$meta .= '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">';
	$meta .= get_the_author();
	$meta .= '</a>';
	$meta .= ' on <time class="date">';
	$meta .= get_the_date('l, F j, Y');
	$meta .= '</time>';
	$meta .= '</span>';

	return $meta;
}


/**
 * Get the first paragraph from a given string
 * @param $text - the string to get the first paragraph from
 * @return string
 */
function doublee_get_first_paragraph($text){
	$text = wpautop($text);
	$text = substr( $text, 0, strpos( $text, '</p>' ) + 4 );
	$text = strip_tags($text, '<a><strong><em>');

	return $text;
}


/**
 * Split a string in half and wrap each in a span
 * useful for avoiding widows in titles
 * @param $string - the string to split
 * @return string - a new string with <span> tags added
 */
function doublee_split_text($string) {
	$word_count = str_word_count($string);
	$words = explode(' ', $string);
	$words_per_line = round($word_count/2); // if the word count is an odd number, rounding puts the larger number of words on the top (e.g. 4 then 3)
	$first_half = array_slice($words, 0, $words_per_line);
	$second_half = array_slice($words, $words_per_line, $word_count);
	$string_one = implode(' ', $first_half);
	$string_two = implode(' ', $second_half);

	$output = '<span>' . $string_one . '</span>' . ' ';
	$output .= '<span>' . $string_two . '</span>';

	return $output;
}


/**
 * Excerpt customiser
 * Strips headings and sets a custom length
 * * Template usage:
 * if(has_excerpt()) { the_excerpt(); }
 * * You can also use the function to shorten the manual excerpt:
 * doublee_custom_excerpt(get_the_excerpt());
 * * Or simply shorten the content:
 * doublee_custom_excerpt(get_the_content());
 *
 * @param $text - the string to strip headings and shorten, generally get_the_excerpt or get_the_content
 * @param $word_count - how many words to include in the output
 * @return string

 */
function doublee_custom_excerpt($text, $word_count) {

	// Remove shortcode tags from the given content
	$text = strip_shortcodes( $text );
	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);

	// Regular expression that strips the header tags and their content
	$regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
	$text = preg_replace($regex,'', $text);

	// Set the word count
	$excerpt_length = apply_filters('excerpt_length', $word_count); // WP default word count is 55

	// Set the ending
	$excerpt_end = '...'; // The WP default is [...]
	$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

	$excerpt = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	return wpautop(apply_filters('wp_trim_excerpt', $excerpt));
}


/**
 * Get ordinal word from a given integer (up to 9)
 * @param $num - the number to get the ordinal word for
 * @return string
 */
function doublee_integer_to_ordinal_word($num) {
	$word = array('first','second','third','fourth','fifth','sixth','seventh','eighth','ninth','tenth');
	if($num <= 9) {
		return $word[$num];
	} else {
		return '';
	}
}