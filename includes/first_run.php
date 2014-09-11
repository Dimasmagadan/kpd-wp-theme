<?php

function os_theme_init() {
	/* удаляем стандартные размеры, добавляем свои */
	update_option( 'thumbnail_size_h', 100 );
	update_option( 'thumbnail_size_w', 100 );
	update_option( 'medium_size_h', 0 );
	update_option( 'medium_size_w', 0 );
	update_option( 'large_size_h', 0 );
	update_option( 'large_size_w', 0 );
}
add_action('after_switch_theme', 'os_theme_init');
