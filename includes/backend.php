<?php

/* --------------- editor's stuff --------------- */
// Текст по умолчанию, для проверки верстки.
function os_writing_encouragement( $content ) {
	global $post_type;
	if($post_type == "post"){
		include( get_template_directory() . '/editor-text.php' );
		return $text;
	}
}
// add_filter( 'default_content', 'os_writing_encouragement' );

/* добавляем свою админку */
// include_once ( get_template_directory().'/kpd/kpd-options.php' );

// стили для админки.
function os_adminCSS() {
	wp_enqueue_style( 'os_admin_style', get_template_directory_uri().'/css/wp-admin.css' );
	// echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/wp-admin.css"/>';
}
// add_action('admin_head', 'os_adminCSS');


// ADD CUSTOM POST TYPES TO THE 'RIGHT NOW' DASHBOARD WIDGET
function wph_right_now_content_table_end() {
	$args = array(
		'public' => true ,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	foreach( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
			$text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
		}
		echo '<tr><td class="first num b b-' . $post_type->name . '">' . $num . '</td>';
		echo '<td class="text t ' . $post_type->name . '">' . $text . '</td></tr>';
	}
	$taxonomies = get_taxonomies( $args , $output , $operator ); 
	foreach( $taxonomies as $taxonomy ) {
		$num_terms  = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ));
		if ( current_user_can( 'manage_categories' ) ) {
			$num = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num</a>";
			$text = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
		echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
	}
}
// add_action( 'right_now_content_table_end' , 'wph_right_now_content_table_end' );




