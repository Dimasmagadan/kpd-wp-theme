<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

error_reporting(E_ALL); // dev
// перед запуском в продакшн заменить $ver=time() у стилей!!!

global $img_defaults;
// Максимальная ширина контента в пикселях
$img_defaults['size']=850;
// логотип по умолчанию
$img_defaults['logo']='kindajean.png';
// фон шапки по умолчанию
$img_defaults['back']='kindajean.png';
// картинка-заглушка по умолчанию
$img_defaults['img']='http://fpoimg.com/100x100';




// delete readme.html file in your root directory
remove_action('wp_head', 'wp_generator');

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );


/* =================== картинки ==========================*/
/* удаляем стандартные размеры, добавляем свои */
update_option( 'thumbnail_size_h', 0 );
update_option( 'thumbnail_size_w', 0 );
update_option( 'medium_size_h', 0 );
update_option( 'medium_size_w', 0 );
update_option( 'large_size_h', 0 );
update_option( 'large_size_w', 0 );
// add_image_size( 'preview', 190, 140);
// add_image_size( 'long', 850, 9999);

// for responsive themes, если испольуется - дописать в стилях максимально возможные размеры для всех размеров картинок ('preview, medium, etc')
function os_remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
// add_filter( 'post_thumbnail_html', 'os_remove_thumbnail_dimensions', 10, 3 );

/* добавляем rel="lightbox" и меняем title все картинкам в посте */
function os_add_lightboxrel($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
// add_filter('the_content', 'os_add_lightboxrel');



if ( ! isset( $content_width ) )
	$content_width = $img_defaults['size'];

/* добавляем свою админку */
include_once ( get_template_directory().'/kpd/kpd-options.php' );


function os_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'os_enqueue_comments_reply' );

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
	<em><?php _e('Ваш комментарий ожидает проверки модератора.') ?></em>
	<br />
	<?php endif; ?>

	<?php comment_text() ?>

	<nav>
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</nav>
	</article>
	<!-- </li> добавится автоматом -->
<?php
}


// Widgetized Sidebar HTML5 Markup
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'id'            => 'right',
		'name'        => __( 'Правый сайдбар' ),
		'description' => __( 'Сайдбар в правой части сайта.' ),
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'id'            => 'bottom',
		'name'        => __( 'Нижний левый' ),
		'description' => __( 'Сайдбар в нижней части сайта.' ),
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}




$defaults = array(
	// 'default-color'			=> '',
	'default-image'				=> get_template_directory_uri().'/img/'.$img_defaults['back'],
	// 'wp-head-callback'		=> '_custom_background_cb',
	// 'admin-head-callback'	=> '',
	// 'admin-preview-callback'	=> ''
);
add_theme_support( 'custom-background', $defaults );
$defaults = array(
	'default-image'				=> get_template_directory_uri().'/img/'.$img_defaults['logo'],
	// 'random-default'			=> false,
	'width'						=> 46,
	'height'					=> 46,
	// 'flex-height'			=> false,
	// 'flex-width'				=> false,
	// 'default-text-color'		=> '',
	// 'header-text'			=> true,
	'uploads'					=> true,
	// 'wp-head-callback'		=> '',
	// 'admin-head-callback'	=> '',
	// 'admin-preview-callback'	=> '',
);
add_theme_support( 'custom-header', $defaults );


register_nav_menus( array(
	'header' => __( 'Основное меню', 'header' ),
	'footer' => __( 'Нижнее меню', 'footer' ),
) );


function os_styles_and_scripts() {
	// заменить на версию темы перед запуском
	$ver=time(); //dev!!!

	if(!is_admin()){
		// фреймворки можно без версии
		wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.min.css' );
		wp_enqueue_style( 'main', get_template_directory_uri().'/css/main.css' );

		wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css' );

		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', null, '2.5.2', false );
		wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), $ver, true );
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery','plugins' ), $ver, true );

		wp_localize_script('main','os',array('ajaxurl'=>admin_url('admin-ajax.php'),'base'=>site_url() ));
	}
}
add_action( 'wp_enqueue_scripts', 'os_styles_and_scripts' );

// стили для админки.
function os_adminCSS() {
	wp_enqueue_style( 'os_admin_style', get_template_directory_uri().'/css/wp-admin.css' );
	// echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/wp-admin.css"/>';
}
add_action('admin_head', 'os_adminCSS');



function register_widgets() {
	wp_register_sidebar_widget('os_last','KPD Последние записи', 'os_latest');
	
	wp_register_sidebar_widget('os_twi','KPD Твиттер', 'os_twitter');
	wp_register_widget_control('os_twi','KPD Твиттер', 'os_twi_control');

	wp_register_sidebar_widget('os_comments','KPD комментарии', 'os_comments');
	wp_register_widget_control('os_comments','KPD комментарии', 'os_comments_control' );
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
	<p class="tweet"><?php echo str_replace($name, '<span class="tweetauthor">'.$name.'</span>', esc_html( $item->get_description() ) ); ?></p>
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


/*
* получаем SRC картинки поста.
* если есть миниатюра, берем ее.
* если нет, ищем первую загруженную картинку.
* если и ее нет и force=true, отдает заглушку.
*/
function os_first_attachment_src($post_ID,$size='large',$force=false){
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => 1,
		'post_parent' => $post_ID
	) );

	if ( $attachments ) {
		if(has_post_thumbnail( $post_ID ) ){
			$out = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), $size );
		} else {
			$out = wp_get_attachment_image_src( $attachments['0']->ID, $size );
		}
	} else {
		if($force) {
			if( $size=='full'){
				$width='1000';
				$height='1000';
			} else {
				$width=get_option( $size.'_size_w' );
				$height=get_option( $size.'_size_h' );
			}

			$out[0]='http://fpoimg.com/'.$height.'x'.$width;
			$out[1]=$width;
			$out[2]=$height;
		} else {
			$out=false;
		}
	}
	return $out;
}

/* --------------- editor's stuff --------------- */
// Текст по умолчанию, для проверки верстки.
function os_writing_encouragement( $content ) {
	global $post_type;
	if($post_type == "post"){
		include( get_template_directory() . '/editor-text.php' );
		return $text;
	}
}
add_filter( 'default_content', 'os_writing_encouragement' );


