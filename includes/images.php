<?php

/* =================== картинки ==========================*/
// add_image_size( 'preview', 190, 140);
// add_image_size( 'long', 850, 9999);

/**
* Add additional image sizes to the WordPress media upload/insert interface
*
* @author Daniel Roizer
* @link http://goo.gl/0tKD0
*/
function iweb_additional_image_sizes( $sizes ) {
	$additional_image_sizes = array(
	'banner' => 'preview'
	);
	return array_merge( $sizes, $additional_image_sizes );
}
add_filter( 'image_size_names_choose', 'iweb_additional_image_sizes' );


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

/*
* ссылка на пост на всех кроме single
* ссылка на полную картинку на single
* добавляем  rel="lightbox"
*/
function my_post_image_html( $html, $post_id, $post_image_id ) {
	if(!is_single()){
		$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	} else {
		$img=wp_get_attachment_image_src( $post_image_id, 'full' );
		$html = '<a href="' . $img[0] . '" rel="lightbox" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

// AUTOMATICALLY EXTRACT THE FIRST IMAGE FROM THE POST 
function getImage($num) {
	global $more;
	$more = 1;
	$link = get_permalink();
	$content = get_the_content();
	$count = substr_count($content, '<img');
	$start = 0;
	for($i=1;$i<=$count;$i++) {
		$imgBeg = strpos($content, '<img', $start);
		$post = substr($content, $imgBeg);
		$imgEnd = strpos($post, '>');
		$postOutput = substr($post, 0, $imgEnd+1);
		$postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
		$image[$i] = $postOutput;
		$start=$imgEnd+1;
	}
	if(stristr($image[$num],'<img')) { echo '<a href="'.$link.'">'.$image[$num]."</a>"; }
	$more = 0;
}

// Sharpen Resized Images (only jpg)
function ajx_sharpen_resized_files( $resized_file ) {

	$image = wp_load_image( $resized_file );
	if ( !is_resource( $image ) )
		return new WP_Error( 'error_loading_image', $image, $file );

	$size = @getimagesize( $resized_file );
	if ( !$size )
		return new WP_Error('invalid_image', __('Could not read image size'), $file);
	list($orig_w, $orig_h, $orig_type) = $size;

	switch ( $orig_type ) {
		case IMAGETYPE_JPEG:
			$matrix = array(
				array(-1, -1, -1),
				array(-1, 16, -1),
				array(-1, -1, -1),
			);

			$divisor = array_sum(array_map('array_sum', $matrix));
			$offset = 0; 
			imageconvolution($image, $matrix, $divisor, $offset);
			imagejpeg($image, $resized_file,apply_filters( 'jpeg_quality', 90, 'edit_image' ));
			break;
		case IMAGETYPE_PNG:
			return $resized_file;
		case IMAGETYPE_GIF:
			return $resized_file;
	}

	return $resized_file;
}   
add_filter('image_make_intermediate_size', 'ajx_sharpen_resized_files',900);

/**
* Filter a few parameters into YouTube oEmbed requests
*
* @link http://goo.gl/yl5D3
*/
function iweb_modest_youtube_player( $html, $url, $args ) {
	return str_replace( '?feature=oembed', '?feature=oembed&modestbranding=1&showinfo=0&rel=0', $html );
}
add_filter( 'oembed_result', 'iweb_modest_youtube_player', 10, 3 );

/***************************************************************
* Function my_oembed_wmode
* Fix oEmbed window mode for flash objects
***************************************************************/
function my_oembed_wmode( $embed ) {
    if ( strpos( $embed, '<param' ) !== false ) {
        $embed = str_replace( '<embed', '<embed wmode="transparent" ', $embed );
        $embed = preg_replace( '/param>/', 'param><param name="wmode" value="transparent" />', $embed, 1);
    }
    return $embed;
}
add_filter('embed_oembed_html', 'my_oembed_wmode', 1);





