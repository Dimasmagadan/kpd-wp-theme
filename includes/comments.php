<?php

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

/**
* http://www.paulund.co.uk/add-relnofollow-to-wordpress-comment-reply-links
* Add a rel="nofollow" to the comment reply links
*/
function add_nofollow_to_reply_link( $link ) {
    return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
}
add_filter( 'comment_reply_link', 'add_nofollow_to_reply_link' );

/* check referers */
function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == "") {
        wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, bugger off!') );
    }
}
add_action('check_comment_flood', 'check_referrer');

/* disable comments for attachments */
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10, 2 );

function os_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) &&  (is_single() || is_page() ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'os_enqueue_comments_reply' );

// spam & delete links for all versions of wordpress
function delete_comment_link($id) {
    if (current_user_can('edit_post')) {
        echo '| <a href="'.get_bloginfo('wpurl').'/wp-admin/comment.php?action=cdc&c='.$id.'">del</a> ';
        echo '| <a href="'.get_bloginfo('wpurl').'/wp-admin/comment.php?action=cdc&dt=spam&c='.$id.'">spam</a>';
    }
}

// russian endings for comments and stuff
function os_russify_comments_number($number=0) {	
	if ($number == 0 || $number == '') {
		$output = 'Комментариев нет';
	} elseif ($number == 1) {
		$output = 'Один комментарий';
	} elseif (($number > 20) && (($number % 10) == 1)) {
		$output = str_replace('%', $number, '% комментариев');
	} elseif ((($number >= 2) && ($number <= 4)) || ((($number % 10) >= 2) && (($number % 10) <= 4)) && ($number > 20)) {
		$output = str_replace('%', $number, '% комментария');
	} else {
		$output = str_replace('%', $number, '% комментариев');
	}
	return $output;
}

