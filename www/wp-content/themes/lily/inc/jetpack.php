<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Lily
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function lily_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'lily_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function lily_jetpack_setup
add_action( 'after_setup_theme', 'lily_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function lily_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function lily_infinite_scroll_render
