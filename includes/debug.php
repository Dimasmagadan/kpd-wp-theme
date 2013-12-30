<?php
/**
*
* Debug and perfomance
*
**/

error_reporting(E_ALL); // dev

// Output which theme template file a post/page is using in the header
function show_template() {
    global $template;
    print_r($template);
}
add_action('wp_head', 'show_template');


/*
Usage:
    $frag = new CWS_Fragment_Cache( 'unique-key', 3600 ); // Second param is TTL
    if ( !$frag->output() ) { // NOTE, testing for a return of false
        functions_that_do_stuff_live();
        these_should_echo();
        // IMPORTANT
        $frag->store();
        // YOU CANNOT FORGET THIS. If you do, the site will break.
    }
*/
class CWS_Fragment_Cache {
    const GROUP = 'cws-fragments';
    var $key;
    var $ttl;

    public function __construct( $key, $ttl ) {
        $this->key = $key;
        $this->ttl = $ttl;
    }

    public function output() {
        $output = wp_cache_get( $this->key, self::GROUP );
        if ( !empty( $output ) ) {
            // It was in the cache
            echo $output;
            return true;
        } else {
            ob_start();
            return false;
        }
    }

    public function store() {
        $output = ob_get_flush(); // Flushes the buffers
        wp_cache_add( $this->key, $output, self::GROUP, $this->ttl );
    }
}

