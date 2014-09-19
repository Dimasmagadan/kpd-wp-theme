<?php

// delete readme.html file in your root directory
remove_action('wp_head', 'wp_generator');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );

if ( ! isset( $content_width ) )
	$content_width = 850;

register_nav_menus( array(
	'top' => 'top',
	'footer' => 'footer',
) );

/* подключаем скрипты и стили */
function os_styles_and_scripts() {
	// заменить на версию темы перед запуском
	$ver=time(); //dev!!!

	// фреймворки можно без версии
	wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.min.css' );
	wp_enqueue_style( 'main', get_template_directory_uri().'/css/main.css' );
	wp_enqueue_style( 'magnific', get_template_directory_uri().'/css/magnific-popup.css', false, $ver );

	wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css', array('normalize','main','magnific'), $ver );

	// овверайд премиум темы. без child-theme
	// wp_enqueue_style( 'override', get_template_directory_uri().'/css/override.css', false, $ver );

	// sccs
	// wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css', null, $ver );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', null, '2.5.2', false );

	wp_enqueue_script( 'yashare', '//yandex.st/share/share.js', null, '1', true );
	
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), $ver, true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/magnific-popup.js', array( 'jquery' ), $ver, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery','plugins','magnific-popup' ), $ver, true );

	wp_localize_script('main','os',array(
		'ajaxurl'=>admin_url('admin-ajax.php'),
		'base'=>site_url(),
		'tClose'=> __('Close (Esc)','text_domain'),
		'tLoading'=> __('Loading...','text_domain'),
		'tError'=> __('Unable to load <a href="%url%">link</a>.','text_domain'),
		'tPrev'=> __('Previous (left)','text_domain'),
		'tNext'=> __('Next (right)','text_domain'),
		'tCounter'=> __('%curr% from %total%','text_domain')
		)
	);
}
add_action( 'wp_enqueue_scripts', 'os_styles_and_scripts' );


/**

* includes

**/
include 'includes/backend.php';
include 'includes/comments.php';
include 'includes/debug.php';
include 'includes/first_run.php';
include 'includes/images.php';
include 'includes/posts.php';
include 'includes/shortcodes.php';
include 'includes/users.php';
include 'includes/meta.php';
// include 'includes/widgets.php';

include 'includes/current-theme.php';

