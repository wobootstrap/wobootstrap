<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package WoBootstrap
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function wobootstrap_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'wobootstrap_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function wobootstrap_jetpack_setup
add_action( 'after_setup_theme', 'wobootstrap_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function wobootstrap_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function wobootstrap_infinite_scroll_render
