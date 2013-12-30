<?php

// hide dashboard for users
// if ( ! current_user_can( 'manage_options' ) ) {
// 	show_admin_bar( false );
// }

// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT SYSADMIN
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins 
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}


// Show only posts and media related to logged in author
function query_set_only_author( $wp_query ) {
    global $current_user;
    if( is_admin() && !current_user_can('edit_others_posts') ) {
        $wp_query->set( 'author', $current_user->ID );
        add_filter('views_edit-post', 'fix_post_counts');
        add_filter('views_upload', 'fix_media_counts');
    }
}
// add_action('pre_get_posts', 'query_set_only_author' );


// Two functions fix_post_counts and fix_media_counts. Only show posts and media of the logged-in Author & fix the post/media counts on the filter bars.
// Fix post counts
function fix_post_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'post',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(__('<a href="%s"'. $class .'>All <span class="count">(%d)</span></a>', 'all'),
                admin_url('edit.php?post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(__('<a href="%s"'. $class .'>Published <span class="count">(%d)</span></a>', 'publish'),
                admin_url('edit.php?post_status=publish&post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(__('<a href="%s"'. $class .'>Draft'. ((sizeof($result->posts) > 1) ? "s" : "") .' <span class="count">(%d)</span></a>', 'draft'),
                admin_url('edit.php?post_status=draft&post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(__('<a href="%s"'. $class .'>Pending <span class="count">(%d)</span></a>', 'pending'),
                admin_url('edit.php?post_status=pending&post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(__('<a href="%s"'. $class .'>Trash <span class="count">(%d)</span></a>', 'trash'),
                admin_url('edit.php?post_status=trash&post_type=post'),
                $result->found_posts);
        endif;
    }
    return $views;
}
// Fix media counts
function fix_media_counts($views) {
    global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
    $views = array();
    $_num_posts = array();
    $count = $wpdb->get_results( "
        SELECT post_mime_type, COUNT( * ) AS num_posts 
        FROM $wpdb->posts 
        WHERE post_type = 'attachment' 
        AND post_author = $current_user->ID 
        AND post_status != 'trash' 
        GROUP BY post_mime_type
    ", ARRAY_A );
    foreach( $count as $row )
        $_num_posts[$row['post_mime_type']] = $row['num_posts'];
    $_total_posts = array_sum($_num_posts);
    $detached = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
    if ( !isset( $total_orphans ) )
        $total_orphans = $wpdb->get_var("
            SELECT COUNT( * ) 
            FROM $wpdb->posts 
            WHERE post_type = 'attachment' 
            AND post_author = $current_user->ID 
            AND post_status != 'trash' 
            AND post_parent < 1
        ");
    $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
    foreach ( $matches as $type => $reals )
        foreach ( $reals as $real )
            $num_posts[$type] = ( isset( $num_posts[$type] ) ) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
    $class = ( empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status']) ) ? ' class="current"' : '';
    $views['all'] = "<a href='upload.php'$class>" . sprintf( __('All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts )) . '</a>';
    foreach ( $post_mime_types as $mime_type => $label ) {
        $class = '';
        if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
            continue;
        if ( !empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
            $class = ' class="current"';
        if ( !empty( $num_posts[$mime_type] ) )
            $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), $num_posts[$mime_type] ) . '</a>';
    }
    $views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';
    return $views;
}


/* login via ulogin */
function os_login(){
    $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
    $user = json_decode($s, true);

    if (isset($user['uid'])) {
        $user_id = get_user_by('login', 'ulogin_' . $user['network'] . '_' . $user['uid']);
        if (isset($user_id->ID)) {
            $user_id = $user_id->ID;
        } else {
            $user_id = wp_insert_user(array('user_pass' => wp_generate_password(), 'user_login' => 'ulogin_' . $user['network'] . '_' . $user['uid'], 'user_url' => $user['identity'], 'user_email' => $user['email'], 'first_name' => $user['first_name'], 'last_name' => $user['last_name'], 'display_name' => $user['first_name'] . ' ' . $user['last_name'], 'nickname' => $user['first_name'] . ' ' . $user['last_name']));
            $i = 0;
            $email = explode('@', $user['email']);
            while (!is_int($user_id)) {
                $i++;
                $user_id = wp_insert_user(array('user_pass' => wp_generate_password(), 'user_login' => 'ulogin_' . $user['network'] . '_' . $user['uid'], 'user_url' => $user['identity'], 'user_email' => $email[0] . '+' . $i . '@' . $email[1], 'first_name' => $user['first_name'], 'last_name' => $user['last_name'], 'display_name' => $user['first_name'] . ' ' . $user['last_name'], 'nickname' => $user['first_name'] . ' ' . $user['last_name']));
            
                if(isset($user['photo_big'])){
                    update_usermeta($user_id, 'ulogin_photo', $user['photo_big']);
                    update_usermeta($user_id, 'ava', '-1');
                }

                if(isset($user['bdate'])){
                    update_usermeta($user_id, 'bdate', $user['bdate']);
                }
                if(isset($user['sex'])){
                    update_usermeta($user_id, 'sex', $user['sex']);
                }
                if(isset($user['phone'])){
                    update_usermeta($user_id, 'phone', $user['phone']);
                }
                if(isset($user['city'])){
                    update_usermeta($user_id, 'city', $user['city']);
                }
                if(isset($user['country'])){
                    update_usermeta($user_id, 'country', $user['country']);
                }
            }
        }

        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);
    }

    if(isset($_GET['location'])){
        $location=$_GET['location'];
    } else {
        $location=site_url( );
    }
    wp_redirect( $location );
    exit();
};
add_action( 'wp_ajax_nopriv_login', 'os_login' );
add_action( 'wp_ajax_login', 'os_login' );

/*
<?php if(!is_user_logged_in()){?>
<script src="//ulogin.ru/js/ulogin.js"></script>
<a href="#" id="uLogin" data-ulogin="display=window;fields=first_name,last_name,photo_big,bdate,sex,phone,city,country;providers=vkontakte,odnoklassniki,mailru,facebook,twitter,googleplus;hidden=other;redirect_uri=<?php
    $location=site_url($_SERVER["REQUEST_URI"]);
    echo urlencode(admin_url('admin-ajax.php?action=login&location='.$location) );
    ?>">
    <img width="187" height="30" alt="МультиВход" src="https://ulogin.ru/img/button.png" />
</a>
<?php } else {
?>
<div>
    Вы вошли как <?php global $current_user;
    echo $current_user->display_name; ?> <a href="<?php echo wp_logout_url( $_SERVER['REQUEST_URI'] ); ?>">Выйти</a>
</div>
<?php
} ?>
*/

