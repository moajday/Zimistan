<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Write
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function write_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'write_pingback_header' );

/**
 * Change excerpt length.
 */
if ( 'ja' !== get_bloginfo( 'language' ) ) {
	function write_change_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		return 35;
	}
	add_filter( 'excerpt_length', 'write_change_excerpt_length', 999 );
}

/**
 * Change the [...] string in the excerpt.
 */
function write_change_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return '...';
}
add_filter( 'excerpt_more', 'write_change_excerpt_more' );

/**
 * Modify the read more link text
 */
function write_modify_read_more_link() {
	return '<a class="continue-reading" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Continue reading &rarr;', 'write' ) . '</a>';
}
add_filter( 'the_content_more_link', 'write_modify_read_more_link' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function write_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'write_page_menu_args' );