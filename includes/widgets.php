<?php

// Widgetized Sidebar HTML5 Markup
// if ( function_exists('register_sidebars') ) {

	$args = array(
		'name'          => sprintf(__('Sidebar %d'), $i ),
		'id'            => "sidebar-$i",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	);


	register_sidebars( 1, $args );

	// register_sidebar(array(
	// 	'before_widget' => '<section>',
	// 	'after_widget' => '</section>',
	// 	'id'            => 'right',
	// 	'name'        => __( 'Правый сайдбар' ),
	// 	'description' => __( 'Сайдбар в правой части сайта.' ),
	// 	'before_title' => '<h2 class="widgettitle">',
	// 	'after_title' => '</h2>',
	// ));
	// register_sidebar(array(
	// 	'before_widget' => '<section>',
	// 	'after_widget' => '</section>',
	// 	'id'            => 'bottom',
	// 	'name'        => __( 'Нижний левый' ),
	// 	'description' => __( 'Сайдбар в нижней части сайта.' ),
	// 	'before_title' => '<h2 class="widgettitle">',
	// 	'after_title' => '</h2>',
	// ));
// }

// Enable shortcodes in widgets
if ( !is_admin() ){
    add_filter('widget_text', 'do_shortcode', 11);
}
// Enable oEmbed in Text/HTML Widgets
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );


function register_widgets() {
	wp_register_sidebar_widget('os_last','Последние записи', 'os_latest');
	
	// TODO
	// old api
	// wp_register_sidebar_widget('os_twi','Твиттер', 'os_twitter');
	// wp_register_widget_control('os_twi','Твиттер', 'os_twi_control');

	wp_register_sidebar_widget('os_comments','Комментарии', 'os_comments');
	wp_register_widget_control('os_comments','Комментарии', 'os_comments_control' );
}
add_action('init', 'register_widgets');

function os_latest($args){
	extract($args);

	$args=array(
		'posts_per_page' => 2
	);
	$last_posts=new WP_Query($args);
	if($last_posts->have_posts()){
		echo $before_widget;
		echo $before_title;
		?>Последние статьи<?php
		echo $after_title; 
		while ($last_posts->have_posts()) {
			$last_posts->the_post();
			?><div class="one-third notopmargin last">
<div class="blog-cloud"><div class="date"><?php the_time( 'j' ); ?></div><div class="month"><?php the_time( 'F' ); ?></div></div>
<span><a href="<?php the_permalink(); ?>" class="link"><?php the_title(); ?></a></span>
<br/>
<span class="footer-small">
<?php
		$custom=get_post_custom();
			if(isset($custom['_aioseop_description']) && !empty($custom['_aioseop_description']) ){
				echo $custom['_aioseop_description']['0'];
			} else {
				echo get_the_excerpt();
			};
?></span>
<br/>
<br/>
</div><?php
		}
		echo $after_widget;
	}
}

function os_comments($args){
	extract($args);

	echo $before_widget;

	echo $before_title;
	echo get_option('os_comments_title');
	echo $after_title; 

	$count=get_option('os_comments_count');

	$comments=get_comments(array(
			'number' => $count,
			// 'orderby' => '',
			'order' => 'DESC',
			'status' => 'approve',
			));
?>
<ul>
	<?php
	foreach ( $comments as $item ) :
	?><li>
	<span class="testimonials_arrow"></span><?php
	echo wp_trim_words($item->comment_content,20);
	?><div class="clear"></div>
	<div class="author"><?php echo $item->comment_author; ?> к '<a href="<?php echo get_permalink($item->comment_post_ID); ?>" ><?php echo get_the_title( $item->comment_post_ID ); ?></a>'</div>
</li><?php
	endforeach;
?>
</ul>
<?php
	echo $after_widget;

}
function os_comments_control() {
	if (!empty($_REQUEST['os_comments_title'])) {
		update_option('os_comments_title', $_REQUEST['os_comments_title']);
	}
	if (!empty($_REQUEST['os_comments_source'])) {
		update_option('os_comments_source', $_REQUEST['os_comments_source']);
	}
	if (!empty($_REQUEST['os_comments_count'])) {
		update_option('os_comments_count', $_REQUEST['os_comments_count']);
	}
	?>Заголовок&nbsp;:&nbsp;<input type="text" name="os_comments_title" value="<?php echo get_option( 'os_comments_title', 'Комментарии' ); ?>" /><?
	?><br/>Выводить&nbsp;:&nbsp;<input type="text" name="os_comments_count" value="<?php echo get_option( 'os_comments_count', '2' ); ?>" /><?
}



