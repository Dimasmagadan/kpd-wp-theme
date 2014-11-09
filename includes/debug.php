<?php
/**
*
* Debug and helper functions
*
**/
if(WP_DEBUG){
    error_reporting(E_ALL);
}

// Output which theme template file a post/page is using in the header
function show_template() {
    if(WP_DEBUG){
        global $template;
        print_r($template);
    }
}
add_action('wp_head', 'show_template');

function de($a, $force = false){
    if(WP_DEBUG || $force){
        echo '<pre>';
        var_dump($a);
        echo '</pre>';
    }
}

function deb($a, $name = false){
    if(function_exists('dbgx_trace_var')){
        dbgx_trace_var($a, $name);
    } else {
        de($a);
    }
}
