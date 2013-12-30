<?php

function os_return_time( $seconds=7200 ) {
	return $seconds;
}


/* отключаем стили и скрипты плагинов для остальных страниц */
function deregister_cf7_javascript() {
    if ( !is_page(15) ) { // проверить номер страницы
        wp_deregister_script( 'contact-form-7' );
    }
}
// add_action( 'wp_print_scripts', 'deregister_cf7_javascript', 15 );
function deregister_cf7_styles() {
    if ( !is_page(15) ) { // проверить номер страницы
        wp_deregister_style( 'contact-form-7' );
    }
}
// add_action( 'wp_print_styles', 'deregister_cf7_styles', 15 );


