<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Zimistan
 */

/**
 * Add theme support for Infinite Scroll.
 */
function write_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'type'      => 'click',
		'render'    => 'write_infinite_scroll_render',
		'footer'    => false,
	) );
}
add_action( 'after_setup_theme', 'write_jetpack_setup' );

function write_infinite_scroll_render() {
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile;
}

/**
 * Remove the Related Posts from the bottom of posts
 */
function write_remove_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
add_filter( 'wp', 'write_remove_related_posts', 20 );