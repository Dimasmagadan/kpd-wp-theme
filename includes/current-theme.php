<?php

function os_return_time( $seconds=7200 ) {
	return $seconds;
}

/* echo error for nopriv ajax request */
function os_nopriv(){
	$out['status']='error';
	echo json_encode($out);
	exit;
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


/* ajax dummy code */
/*
function os_ (){
	$out['status']='error';


	echo json_encode($out);
	exit;
}
add_action( 'wp_ajax_nopriv_', 'os_nopriv' );
add_action( 'wp_ajax_nopriv_', '' );
add_action( 'wp_ajax_', '' );
*/

