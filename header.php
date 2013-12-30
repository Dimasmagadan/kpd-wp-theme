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

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!--[if lt IE 7]>
		<p class="chromeframe">Вы используете устаревший браузер. <a href="http://browsehappy.com/">Обновите браузер сейчас</a> или <a href="http://www.google.com/chromeframe/?redirect=true">установите Chrome Frame</a>.</p>
	<![endif]-->
<?php
// speed up page load
ob_flush();
flush();
?>
	<div id="container">
		<header role="banner">
		<h1><a href="<?php echo get_option('home'); ?>/">
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
		</a></h1>
		<!-- <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1> -->
		<p class="description"><?php bloginfo('description'); ?></p>
		</header>
			
<!-- меню без ul и li -->
<?php
$menuParameters = array(
'container'       => false,
'echo'            => false,
'items_wrap'      => '%3$s',
'depth'           => 0,
);

echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
?>

<?php
wp_nav_menu( array(
	'theme_location'  => 'top',
	'menu'            => 'top',
	'container'       => 'div', 
	'container_class' => 'menu-{menu slug}-container', 
	// 'container_id'    => ,
	'menu_class'      => 'menu', 
	// 'menu_id'         => ,
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	// 'before'          => ,
	// 'after'           => ,
	// 'link_before'     => ,
	// 'link_after'      => ,
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	// 'walker'          =>  
	) );
?>


