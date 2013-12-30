<?php

add_theme_support( 'custom-header' );
$defaults = array(
	// 'default-image'          => get_template_directory_uri() . '/images/header.jpg',
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

add_theme_support( 'custom-background' );
$defaults = array(
	'default-color'          => '000000',
	// 'default-image'          => get_template_directory_uri() . '/images/background.jpg',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );


function os_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'os_display_options',
		array(
			'title'     => 'Display Options',
			'priority'  => 200
		)
	);
	$wp_customize->add_setting(
		'os_header_phone',
		array(
			'default'            => '',
			'sanitize_callback'  => 'os_sanitize_text',
			'transport'          => 'postMessage'
			// 'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'os_header_phone',
		array(
			'section'  => 'os_display_options',
			'label'    => 'Phone number',
			'type'     => 'text'
		)
	);
}
add_action( 'customize_register', 'os_customize_register' );

function os_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}

