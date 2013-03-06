<?php
/*
* kpd theme panel v1.0
* TODO kpd theme panel v1.0
*/
$kpd_version='1.1';

global $kpd_options;
$kpd_options = get_option( 'kpd_options', $kpd_options );


if( empty($kpd_options) || is_wp_error($kpd_options) ){
	$kpd_logo_title = get_bloginfo('name');
	$kpd_logo_description = get_bloginfo('blogdescription');
	$kpd_options = array(
		'kpd_logo_title' => $kpd_logo_title, // оставил для совместимости
		'kpd_logo_description' => $kpd_logo_description, // оставил для совместимости
		'kpd_sape_code' => '',
		'kpd_ga_code' => '',
		'kpd_metrika_code' => '',
		'kpd_adsense1' => '',
		'kpd_adsense2' => '',
		'kpd_adsense3' => '',
		'kpd_adsense4' => '',
		'kpd_adsense5' => '',
		'kpd_yandex1' => '',
		'kpd_yandex2' => '',
		'kpd_yandex3' => '',
		'kpd_yandex4' => '',
		'kpd_yandex5' => '',

		'kpd_ba_show' => '',
		'kpd_ba_img' => '',
		'kpd_ba_link' => '',

		'kpd_text1' => '',
		'kpd_text2' => '',
		'kpd_text3' => '',

		'version' => $kpd_version
	);
}

// function kpd_theme_options_init() {
// 	wp_enqueue_style( 'gazpo-theme-options-style', get_template_directory_uri() . '/kpd/options.css' );
// }
// add_action( 'admin_init', 'kpd_theme_options_init' );


function kpd_validate_options( $input ) {
	global $kpd_options;	

	$settings = get_option( 'kpd_options', $kpd_options );
	
	
	if ( ! isset( $input['kpd_logo_title'] ) )
	$input['kpd_logo_title'] = null;
	$input['kpd_logo_title'] = wp_kses_stripslashes($input['kpd_logo_title']);
	
	if ( ! isset( $input['kpd_logo_description'] ) )
	$input['kpd_logo_description'] = null;
	$input['kpd_logo_description'] = wp_kses_stripslashes($input['kpd_logo_description']);	

	if ( ! isset( $input['marker'] ) )
	$input['marker'] = null;
	$input['marker'] = wp_kses_stripslashes($input['marker']);

	if ( ! isset( $input['post_token'] ) )
	$input['post_token'] = null;
	$input['post_token'] = wp_kses_stripslashes($input['post_token']);
	if ( ! isset( $input['get_token'] ) )
	$input['get_token'] = null;
	$input['get_token'] = wp_kses_stripslashes($input['get_token']);
	if ( ! isset( $input['api_get_url'] ) )
	$input['api_get_url'] = null;
	$input['api_get_url'] = wp_kses_stripslashes($input['api_get_url']);
	if ( ! isset( $input['api_post_url'] ) )
	$input['api_post_url'] = null;
	$input['api_post_url'] = wp_kses_stripslashes($input['api_post_url']);
	




	if ( ! isset( $input['kpd_sape_code'] ) )
	$input['kpd_sape_code'] = null;
	$input['kpd_sape_code'] = wp_kses_stripslashes($input['kpd_sape_code']);
	
	if ( ! isset( $input['kpd_metrika_code'] ) )
	$input['kpd_metrika_code'] = null;
	$input['kpd_metrika_code'] = wp_kses_stripslashes($input['kpd_metrika_code']);
	
	if ( ! isset( $input['kpd_ga_code'] ) )
	$input['kpd_ga_code'] = null;
	$input['kpd_ga_code'] = wp_kses_stripslashes($input['kpd_ga_code']);
	
	
	if ( ! isset( $input['kpd_adsense1'] ) )
	$input['kpd_adsense1'] = null;
	$input['kpd_adsense1'] = wp_kses_stripslashes($input['kpd_adsense1']);

	if ( ! isset( $input['kpd_adsense2'] ) )
	$input['kpd_adsense2'] = null;
	$input['kpd_adsense2'] = wp_kses_stripslashes($input['kpd_adsense2']);
	
	if ( ! isset( $input['kpd_adsense3'] ) )
	$input['kpd_adsense3'] = null;
	$input['kpd_adsense3'] = wp_kses_stripslashes($input['kpd_adsense3']);
	
	if ( ! isset( $input['kpd_adsense4'] ) )
	$input['kpd_adsense4'] = null;
	$input['kpd_adsense4'] = wp_kses_stripslashes($input['kpd_adsense4']);
	
	if ( ! isset( $input['kpd_adsense1'] ) )
	$input['kpd_adsense5'] = null;
	$input['kpd_adsense5'] = wp_kses_stripslashes($input['kpd_adsense5']);
	
	
	if ( ! isset( $input['kpd_yandex1'] ) )
	$input['kpd_yandex1'] = null;
	$input['kpd_yandex1'] = wp_kses_stripslashes($input['kpd_yandex1']);

	if ( ! isset( $input['kpd_yandex2'] ) )
	$input['kpd_yandex2'] = null;
	$input['kpd_yandex2'] = wp_kses_stripslashes($input['kpd_yandex2']);
	
	if ( ! isset( $input['kpd_yandex3'] ) )
	$input['kpd_yandex3'] = null;
	$input['kpd_yandex3'] = wp_kses_stripslashes($input['kpd_yandex3']);
	
	if ( ! isset( $input['kpd_yandex4'] ) )
	$input['kpd_yandex4'] = null;
	$input['kpd_yandex4'] = wp_kses_stripslashes($input['kpd_yandex4']);
	
	if ( ! isset( $input['kpd_yandex1'] ) )
	$input['kpd_yandex5'] = null;
	$input['kpd_yandex5'] = wp_kses_stripslashes($input['kpd_yandex5']);
	return $input;
}


if ( is_admin() ) : 

//register settings and call sanitation functions
function kpd_register_settings() {
	register_setting( 'kpd_theme_options', 'kpd_options', 'kpd_validate_options' );
}
add_action( 'admin_init', 'kpd_register_settings' );

function kpd_theme_options() {
	add_theme_page('KPD '.__('Настройки темы','silverorchid'), 'KPD '.__('Настройки темы','silverorchid'), 'edit_theme_options', 'theme-options', 'kpd_theme_options_page' );
}
add_action( 'admin_menu', 'kpd_theme_options' );

//default options
function kpd_default_options() {
	global $kpd_options;

	$kpd_options_temp = $kpd_options;
	$options = get_option( 'kpd_options', $kpd_options );
	foreach ( $kpd_options as $kpd_option_key => $kpd_option_value ) {
		if ( isset($options[$kpd_option_key])) {
			$kpd_options[$kpd_option_key] = $options[$kpd_option_key];
		}
	}
	$kpd_options['version'] = $kpd_version;

	if(!empty($kpd_options['kpd_logo_title'])){
		update_option('blogname', $kpd_options['kpd_logo_title']);
	}
	if(!empty($kpd_options['kpd_logo_description'])){
		update_option('blogdescription', $kpd_options['kpd_logo_description']);
	}
	update_option( 'kpd_options', $kpd_options );
}
add_action( 'init', 'kpd_default_options' );

//generate options page
function kpd_theme_options_page() {
	global $kpd_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	if( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) 
		delete_option( 'kpd_options' );
?>
	<div id="gazpo-admin" class="wrap">
	
	<div class="options-form">
	
	<?php screen_icon(); echo "<h2>" . __( 'Настройки темы' ,'silverorchid' ) . "</h2>"; ?>
	<?php if ( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) : ?>
	<div class="updated_status fade"><?php _e( 'Настройки успешно сброшены. Не забудьте сохранить настройки по умолчанию!','silverorchid' ); ?></div>
	<?php elseif ( $_REQUEST['settings-updated'] ) : ?>
	<div class="updated_status fade"><?php _e( 'Настройки успешно сохранены!','silverorchid' ); ?></div>
	<?php endif;?>
	
	<form method="post" action="options.php">

	<?php $settings = get_option( 'kpd_options', $kpd_options ); ?>	
	<?php settings_fields( 'kpd_theme_options' ); ?>
		
	
	<h3>Общие настройки</h3>

	<div class="field">
		<label><?php _e( 'Название сайта в логотипе','silverorchid' ); ?></label>
		<input class="input" id="kpd_logo_title" name="kpd_options[kpd_logo_title]" type="text" value="<?php esc_attr_e($settings['kpd_logo_title']); ?>" />
		<span><?php _e( 'Введите название сайта в логотипе.','silverorchid' ); ?></span>
	</div>
	<div class="field">
		<label><?php _e( 'Описание сайта в логотипе','silverorchid' ); ?></label>
		<input class="input" id="kpd_logo_description" name="kpd_options[kpd_logo_description]" type="text" value="<?php esc_attr_e($settings['kpd_logo_description']); ?>" />
		<span><?php _e( 'Введите описание сайта в логотипе','silverorchid' ); ?></span>
	</div>
	<div class="field">
		<label>Дополнительный текст 1</label>
		<input class="input" id="kpd_text1" name="kpd_options[kpd_text1]" type="text" value="<?php esc_attr_e($settings['kpd_text1']); ?>" />
		<span>Текст, выводится в шаблоне.</span>
	</div>
	<div class="field">
		<label>Дополнительный текст 2</label>
		<input class="input" id="kpd_text2" name="kpd_options[kpd_text2]" type="text" value="<?php esc_attr_e($settings['kpd_text2']); ?>" />
		<span>Текст, выводится в шаблоне.</span>
	</div>
	<div class="field">
		<label>Дополнительный текст 3</label>
		<input class="input" id="kpd_text3" name="kpd_options[kpd_text3]" type="text" value="<?php esc_attr_e($settings['kpd_text3']); ?>" />
		<span>Текст, выводится в шаблоне.</span>
	</div>

	<h3>Баннер</h3>

	<div class="field">
		<label>Ссылка</label>
		<input type="text" id="kpd_ba_link" name="kpd_options[kpd_ba_link]" value="<?php echo stripslashes($settings['kpd_ba_link']); ?>">
		<span>Сюда вы можете вставить ссылку вашего баннера.</span>
	</div>
	<div class="field">
		<label>Путь до картинки</label>
		<input type="text" id="kpd_ba_img" name="kpd_options[kpd_ba_img]" value="<?php echo stripslashes($settings['kpd_ba_img']); ?>">
		<span>Сюда вы можете вставить путь к картинке баннера.</span>
	</div>
	<div class="field">
		<label>Автоматически показывать</label>
		<input type="checkbox" name="kpd_options[kpd_ba_show]" value="1" <?php checked( $settings['kpd_ba_show'], '1' ); ?> /> после записей
		<span>Включить показ баннера после записей.</span>
	</div>
	
	<h3>Разное</h3>

	<div class="field">
		<label><?php _e( 'Код биржы Sape и т.п.','silverorchid' ); ?></label>
		<textarea class="textarea" id="kpd_sape_code" name="kpd_options[kpd_sape_code]" ><?php echo stripslashes($settings['kpd_sape_code']); ?></textarea>
		<span><?php _e( 'Сюда вы можете вставить код биржы Sape', 'silverorchid' ); ?></span>
	</div>
	<div class="field">
		<label><?php _e( 'Код Яндекс.Метрики','silverorchid' ); ?></label>
		<textarea class="textarea" id="kpd_metrika_code" name="kpd_options[kpd_metrika_code]" ><?php echo stripslashes($settings['kpd_metrika_code']); ?></textarea>
		<span><?php _e( 'Сюда вы можете вставить код Яндекс.Метрики', 'silverorchid' ); ?></span>
	</div>
		<div class="field">
		<label><?php _e( 'Код Google Analytics','silverorchid' ); ?></label>
		<textarea class="textarea" id="kpd_ga_code" name="kpd_options[kpd_ga_code]" ><?php echo stripslashes($settings['kpd_ga_code']); ?></textarea>
		<span><?php _e( 'Сюда вы можете вставить код Google Analytics', 'silverorchid' ); ?></span>
	</div>

	
	<h3>Google Adsense</h3>

	<div class="field">
		<label><?php _e( 'Adsense №1','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_adsense1" name="kpd_options[kpd_adsense1]" ><?php echo stripslashes($settings['kpd_adsense1']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код Google Adsense для шорткода [adsense n=1]', 'silverorchid' ); ?></span>
	</div>	
	
	<div class="field">
		<label><?php _e( 'Adsense №2','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_adsense2" name="kpd_options[kpd_adsense2]" ><?php echo stripslashes($settings['kpd_adsense2']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код Google Adsense для шорткода [adsense n=2]', 'silverorchid' ); ?></span>
	</div>
	
		<div class="field">
		<label><?php _e( 'Adsense №3','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_adsense3" name="kpd_options[kpd_adsense3]" ><?php echo stripslashes($settings['kpd_adsense3']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код Google Adsense для шорткода [adsense n=3]', 'silverorchid' ); ?></span>
	</div>
	
		<div class="field">
		<label><?php _e( 'Adsense №4','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_adsense4" name="kpd_options[kpd_adsense4]" ><?php echo stripslashes($settings['kpd_adsense4']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код Google Adsense для шорткода [adsense n=4]', 'silverorchid' ); ?></span>
	</div>
	
		<div class="field">
		<label><?php _e( 'Adsense №5','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_adsense5" name="kpd_options[kpd_adsense5]" ><?php echo stripslashes($settings['kpd_adsense5']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код Google Adsense для шорткода [adsense n=5]', 'silverorchid' ); ?></span>
	</div>
	
	<h3>РСЯ</h3>
	
	<div class="field">
		<label><?php _e( 'РСЯ №1','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_yandex1" name="kpd_options[kpd_yandex1]" ><?php echo stripslashes($settings['kpd_yandex1']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код РСЯ для шорткода [yandex n=1]', 'silverorchid' ); ?></span>
	</div>	
	
	<div class="field">
		<label><?php _e( 'РСЯ №2','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_yandex2" name="kpd_options[kpd_yandex2]" ><?php echo stripslashes($settings['kpd_yandex2']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код РСЯ для шорткода [yandex n=2]', 'silverorchid' ); ?></span>
	</div>
	
		<div class="field">
		<label><?php _e( 'РСЯ №3','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_yandex3" name="kpd_options[kpd_yandex3]" ><?php echo stripslashes($settings['kpd_yandex3']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код РСЯ для шорткода [yandex n=3]', 'silverorchid' ); ?></span>
	</div>
	
	<div class="field">
		<label><?php _e( 'РСЯ №4','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_yandex4" name="kpd_options[kpd_yandex4]" ><?php echo stripslashes($settings['kpd_yandex4']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код РСЯ для шорткода [yandex n=4]', 'silverorchid' ); ?></span>
	</div>
	
	<div class="field">
		<label><?php _e( 'РСЯ №5','silverorchid' ); ?></label>
       	<textarea class="textarea" id="kpd_yandex5" name="kpd_options[kpd_yandex5]" ><?php echo stripslashes($settings['kpd_yandex5']); ?></textarea>
		<span><?php _e( 'Вставьте ваш код РСЯ для шорткода [yandex n=5]', 'silverorchid' ); ?></span>
	</div>
	
	</div> <!-- /kpd_options -->
	<!---- /form fields ---->
	
	
	<p class="submit"><input type="submit" class="button-primary" value="Сохранить настройки" /></p>
	</form>
	
	<form method="post">
		<p class="submit">
			<input class="button" name="reset" type="submit" value="Восстановить настройки по умолчанию" />
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>

	</div>

	<?php
}

endif;  // EndIf is_admin()


function adsense_shortcode( $atts ) {
	global $kpd_options;
	$kpd_settings = get_option( 'kpd_options', $kpd_options );

	extract(shortcode_atts(array(
	'n' => 1,
	), $atts));

	switch ($n) {
	case 1 :
	$ad = $kpd_settings['kpd_adsense1'];
	break;
	case 2 :
	$ad = $kpd_settings['kpd_adsense2'];
	break;
	case 3 :
	$ad = $kpd_settings['kpd_adsense3'];
	break;
	case 4 :
	$ad = $kpd_settings['kpd_adsense4'];
	break;
	case 5 :
	$ad = $kpd_settings['kpd_adsense5'];
	break;
	}
	return $ad;
	}
	add_shortcode('adsense', 'adsense_shortcode');

	function yandex_shortcode( $atts ) {
	global $kpd_options;
	$kpd_settings = get_option( 'kpd_options', $kpd_options );

	extract(shortcode_atts(array(
	'n' => 1,
	), $atts));

	switch ($n) {
	case 1 :
	$ad = $kpd_settings['kpd_yandex1'];
	break;
	case 2 :
	$ad = $kpd_settings['kpd_yandex2'];
	break;
	case 3 :
	$ad = $kpd_settings['kpd_yandex3'];
	break;
	case 4 :
	$ad = $kpd_settings['kpd_yandex4'];
	break;
	case 5 :
	$ad = $kpd_settings['kpd_yandex5'];
	break;
	}
	return $ad;
}
add_shortcode('yandex', 'yandex_shortcode');


function add_button() {
	if (current_user_can('edit_posts') && current_user_can('edit_pages') ){
		add_filter('mce_external_plugins', 'add_plugin');  
		add_filter('mce_buttons', 'register_button');  
	}
} 

function register_button($buttons) {  
	array_push($buttons, "adsense_1");  
	array_push($buttons, "adsense_2"); 
	array_push($buttons, "adsense_3"); 
	array_push($buttons, "adsense_4"); 
	array_push($buttons, "adsense_5"); 

	array_push($buttons, "yandex_1");  
	array_push($buttons, "yandex_2"); 
	array_push($buttons, "yandex_3"); 
	array_push($buttons, "yandex_4"); 
	array_push($buttons, "yandex_5"); 
	
	return $buttons;  
}  

function add_plugin($plugin_array) {  
	$plugin_array['adsense_1'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['adsense_2'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['adsense_3'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['adsense_4'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['adsense_5'] = get_template_directory_uri().'/kpd/customcodes.js';  

	$plugin_array['yandex_1'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['yandex_2'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['yandex_3'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['yandex_4'] = get_template_directory_uri().'/kpd/customcodes.js';  
	$plugin_array['yandex_5'] = get_template_directory_uri().'/kpd/customcodes.js'; 
	
	return $plugin_array;  
}  
add_action('init', 'add_button');


function os_print_footer(){
	global $kpd_options;
	if(!empty($kpd_options['kpd_ga_code'])){
		echo $kpd_options['kpd_ga_code'];
	};
	if(!empty($kpd_options['kpd_metrika_code'])){
		echo $kpd_options['kpd_metrika_code'];
	};
}
add_action('wp_footer', 'os_print_footer', 100);


function os_content_banner($content){
	if(is_single() || is_page()){
		global $kpd_options;

		if( isset($kpd_options['kpd_ba_show']) && $kpd_options['kpd_ba_show']==1){
			$out='';
			if(!empty($kpd_options['kpd_ba_img'])){
				$out='<img src="'.$kpd_options['kpd_ba_img'].'" alt="" class="kpd_img" />';
			}

			if(!empty($out) && !empty($kpd_options['kpd_ba_link'])){
				$out='<a href="'.$kpd_options['kpd_ba_link'].'" target="_blank" class="kpd_link">'.$out.'</a>';
			}
			$content=$content.$out;
		}
	}
	return $content;
}
add_filter( 'the_content', 'os_content_banner', 500 );

