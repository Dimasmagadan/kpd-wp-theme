<?php
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
add_shortcode("snap", "wp_snap");
