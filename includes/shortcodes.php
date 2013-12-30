<?php

// Loading scripts only if post has shortcode
function has_my_shortcode($posts) {
    if ( empty($posts) )
        return $posts;
    $found = false;
    foreach ($posts as $post) {
        if ( stripos($post->post_content, '[my_shortcode') )
            $found = true;
            break;
        }
    if ($found){
        $urljs = get_bloginfo( 'template_directory' ).IMP_JS;
    wp_register_script('my_script', $urljs.'myscript.js' );
    wp_print_scripts('my_script');
}
    return $posts;
}
// add_action('the_posts', 'has_my_shortcode');

/*
Output a snapshot of any website
Use [snap url="http://wpdaily.co/" alt="WPDaily Website" w="400" h="300"]
To use this in your post add the following short code to your post replacing the url with the one you want a screenshot of.
[snap url="http://wpdaily.co/" alt="WPDaily Website" w="400" h="300"]
*/
function wp_snap($atts, $content = NULL) {
        extract(shortcode_atts(array(
            "snap" => 'http://s.wordpress.com/mshots/v1/',
            "url" => 'http://wpdaily.co/',
            "alt" => 'WPDaily',
            "w" => '400', // width
            "h" => '300' // height
        ), $atts));

        $img = '<img alt="' . $alt . '" src="' . $snap . '' . urlencode($url) . '?w=' . $w . '&h=' . $h . '" />';
        return $img;
}
// add_shortcode("snap", "wp_snap");

