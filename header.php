<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>     <html class="no-js oldie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>        <html class="no-js oldie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>        <html class="no-js oldie lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<meta name="viewport" content="width=device-width">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!--[if lt IE 7]>
		<p class="chromeframe">Вы используете устаревший браузер. <a href="http://browsehappy.com/">Обновите браузер сейчас</a> или <a href="http://www.google.com/chromeframe/?redirect=true">установите Chrome Frame</a>.</p>
	<![endif]-->

	<div id="container">
		<header role="banner">
		<h1><a href="<?php echo get_option('home'); ?>/"><img src="<?php get_header_image(); ?>" alt=""></a></h1>
		<!-- <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1> -->
		<p class="description"><?php bloginfo('description'); ?></p>
		</header>