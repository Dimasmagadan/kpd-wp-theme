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

