<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */




// Custom HTML5 Comment Markup
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<header class="comment-author vcard">
	<?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	<time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a></time>
	<?php edit_comment_link(__('(Edit)'),'  ','') ?>
	</header>
	<?php if ($comment->comment_approved == '0') : ?>
	<em><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
	<?php endif; ?>

	<?php comment_text() ?>

	<nav>
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</nav>
	</article>
	<!-- </li> is added by wordpress automatically -->
<?php
}


// Widgetized Sidebar HTML5 Markup
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'id'            => 'right',
		'name'        => __( 'Нижний левый' ),
		'description' => __( 'Сайдбар в нижней части сайта.' ),
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

// $GLOBALS["TEMPLATE_URL"] = get_bloginfo('template_url')."/";
// $GLOBALS["TEMPLATE_RELATIVE_URL"] = wp_make_link_relative($GLOBALS["TEMPLATE_URL"]);
// function versioned_stylesheet($relative_url, $add_attributes=""){
// 	echo '<link rel="stylesheet" href="'.versioned_resource($relative_url).'" '.$add_attributes.'>'."\n";
// }
// function versioned_javascript($relative_url, $add_attributes=""){
// 	echo '<script src="'.versioned_resource($relative_url).'" '.$add_attributes.'></script>'."\n";
// }
// function versioned_resource($relative_url){
// 	$file = $_SERVER["DOCUMENT_ROOT"].$relative_url;
// 	$file_version = "";

// 	if(file_exists($file)) {
// 		$file_version = "?v=".filemtime($file);
// 	}

// 	return $relative_url.$file_version;
// }

if ( ! isset( $content_width ) )
	$content_width = 850; /* pixels */

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
// add_image_size( 'preview', 190, 140);
// add_image_size( 'long', 850, 9999);

register_nav_menus( array(
	'header' => __( 'Основное меню', 'header' ),
	'footer' => __( 'Нижнее меню', 'footer' ),
) );


function styles_and_scripts() {
	$ver=time(); //dev!!!

	if(!is_admin()){
		// normalize & boilerplate css
		wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.min.css' );
		wp_enqueue_style( 'main', get_template_directory_uri().'/css/main.css' );

		wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css' );

		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', null, '2.5.2', false );
		wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), $ver, true );
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery','plugins' ), $ver, true );

		wp_localize_script('main','os',array('ajaxurl'=>admin_url('admin-ajax.php'),'base'=>site_url() ));
	}
}
add_action( 'wp_enqueue_scripts', 'styles_and_scripts' );



function register_widgets() {
	wp_register_sidebar_widget('os_last','Последние записи', 'os_latest');
	// wp_register_sidebar_widget('os_pop','Популярные записи', 'os_popular');
	// wp_register_sidebar_widget('os_com','Обсуждаемые', 'os_commented');
	
	wp_register_sidebar_widget('os_twi','Твиттер', 'os_twitter');
	wp_register_widget_control('os_twi','Твиттер', 'os_twi_control' );
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

function os_return_time( $seconds ) {
	return 7200;
}
function os_twitter($args){
	extract($args);

	echo $before_widget;

	echo $before_title;
	echo get_option('os_twi_title');
	echo $after_title; 

	$name=get_option('os_twi_source');
	$count=get_option('os_twi_count');

	if(!empty($name) && !empty($count)) {

		$url='http://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.$name.'&count='.$count;

		add_filter( 'wp_feed_cache_transient_lifetime' , 'os_return_time' );
		$rss = fetch_feed($url);
		remove_filter( 'wp_feed_cache_transient_lifetime' , 'os_return_time' );
		
		if (!is_wp_error( $rss ) ) : 
			$maxitems = $rss->get_item_quantity($count);
			$rss_items = $rss->get_items(0, $maxitems); 
		endif;

		if (!isset($maxitems) || $maxitems == 0) echo 'Нет данных';
	    else
	    foreach ( $rss_items as $item ) :
		?><div class="tweeter">
	<p class="tweet"><?php echo esc_html( $item->get_description() ); ?></p>
	<span class="footer-small italic link"><?php echo $item->get_date('j.m.Y'); ?></span>
	</div><?php
		endforeach;
	};

	echo $after_widget;
}
function os_twi_control() {
	if (!empty($_REQUEST['os_twi_title'])) {
		update_option('os_twi_title', $_REQUEST['os_twi_title']);
	}
	if (!empty($_REQUEST['os_twi_source'])) {
		update_option('os_twi_source', $_REQUEST['os_twi_source']);
	}
	if (!empty($_REQUEST['os_twi_count'])) {
		update_option('os_twi_count', $_REQUEST['os_twi_count']);
	}
	?>Заголовок&nbsp;:&nbsp;<input type="text" name="os_twi_title" value="<?php echo get_option( 'os_twi_title', 'Наш твиттер' ); ?>" /><?
	?><br/>Аккаунт&nbsp;:&nbsp;<input type="text" name="os_twi_source" value="<?php echo get_option( 'os_twi_source', 'HOMECREDIT_BANK' ); ?>" /><?
	?><br/>Выводить&nbsp;:&nbsp;<input type="text" name="os_twi_count" value="<?php echo get_option( 'os_twi_count', '2' ); ?>" /><?
}






/* rare */


function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}


function os_first_attachment_src($post_ID,$size='large',$attr=''){
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => 1,
		'post_parent' => $post_ID
	) );

	if ( $attachments ) {
		$img = wp_get_attachment_image_src( $attachments['0']->ID, $size );
		$out='<img alt="" src="'.$img[0].'" '.$attr.' />';
	} else {
		$out='';
	}

	return $out;
}


function os_force_get_img($post_ID,$size='large',$attr=''){
	if(has_post_thumbnail($post_ID) ){
		$out=get_the_post_thumbnail( $post_ID, $size, $attr );
	} else {

		if(is_array($attr)){ // TODO
			$out='';
			foreach ($attr as $key => $value) {
				if($key=='class')
					$out.=' '.$value;
			}
			$attr=$out;
		} // TODO //

		$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => 1,
			'post_parent' => $post_ID
		) );

		//$attr - array?
		if ( $attachments ) {
			$img = wp_get_attachment_image_src( $attachments['0']->ID, $size );
			$out='<img alt="" src="'.$img[0].'" '.$attr.' />';
		} else {
			$width=get_option( $size.'_size_w' );
			$height=get_option( $size.'_size_h' );
			$dummy='<img alt="" src="http://fpoimg.com/'.$width.'x'.$height.'" '.$attr.' />';

			$out=$dummy;
		}
	}

	return $out;
}
