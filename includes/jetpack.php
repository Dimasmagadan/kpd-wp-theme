<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function gridster_jetpack_setup() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'content',
        'footer'    => 'page',
        'render' => 'render_function',
        // 'type' => 'click', // 'scroll'
        // 'wrapper' => false,
    ) );
}
add_action( 'after_setup_theme', 'gridster_jetpack_setup' );
function render_function() {
    get_template_part('content');
}


