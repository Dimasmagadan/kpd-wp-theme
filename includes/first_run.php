<?php

function os_theme_init() {
	/* удаляем стандартные размеры, добавляем свои */
	update_option( 'thumbnail_size_h', 100 );
	update_option( 'thumbnail_size_w', 100 );
	update_option( 'medium_size_h', 0 );
	update_option( 'medium_size_w', 0 );
	update_option( 'large_size_h', 0 );
	update_option( 'large_size_w', 0 );

	// включаем плагины
	// if(function_exists('activate_plugin')){
	// 	// activate_plugin('w3-total-cache/w3-total-cache.php');
	// 	activate_plugin('contact-form-7/wp-contact-form-7.php');
	// 	activate_plugin('wp-postratings/wp-postratings.php');
	// 	activate_plugin('wp-pagenavi/wp-pagenavi.php');
	// 	activate_plugin('wp-polls/wp-polls.php');
	// 	activate_plugin('cyr3lat/cyr-to-lat.php');
	// }

}
add_action('after_switch_theme', 'os_theme_init');
