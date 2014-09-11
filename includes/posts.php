<?php

// MAKE CUSTOM POST TYPES SEARCHABLE
function searchAll( $query ) {
	if ( $query->is_search ) { $query->set( 'post_type', array( 'site', 'plugin', 'theme', 'person' )); } 
	return $query;
}
// add_filter( 'the_search_query', 'searchAll' );

// ADD CUSTOM POST TYPES TO THE DEFAULT RSS FEED
function custom_feed_request( $vars ) {
	if (isset($vars['feed']) && !isset($vars['post_type']))
		$vars['post_type'] = array( 'post', 'site', 'plugin', 'theme', 'person' );
	return $vars;
}
// add_filter( 'request', 'custom_feed_request' );


// Register Custom Post Type
function os_custom_post_types() {
	$labels = array(
		'name'                => _x( 'Slides', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Slide', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Slide:', 'text_domain' ),
		'all_items'           => __( 'All Slides', 'text_domain' ),
		'view_item'           => __( 'View Slide', 'text_domain' ),
		'add_new_item'        => __( 'Add New Slide', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Slide', 'text_domain' ),
		'update_item'         => __( 'Update Slide', 'text_domain' ),
		'search_items'        => __( 'Search Slide', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'slide', 'text_domain' ),
		'description'         => __( 'Slides', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'slide', $args );

}
add_action( 'init', 'os_custom_post_types', 0 );

