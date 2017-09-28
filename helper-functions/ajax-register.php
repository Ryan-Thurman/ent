<?php 

function ajax_register() {
  wp_register_script('ajax-register-script', get_template_directory_uri() . '/src/javascript/ajax-registration.js', array('jquery'), null, false);
  wp_enqueue_script('ajax-register-script');
 
  wp_localize_script( 'ajax-register-script', 'ajax_register_object', array(
        'ajax_url' => home_url() . '/wp-admin/admin-ajax.php',
      )
  );
}

add_action('wp_enqueue_scripts', 'ajax_register', 100);

function reg_new_user() {
 
  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'new_user' ) )
    die( 'Ooops, something went wrong, please try again later.' );
 
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $email = $_POST['mail'];
    $first = $_POST['first_name'];
		$last = $_POST['last_name'];
    // $nickname    = $_POST['nick'];
 
    $userdata = array(
        'user_login' => $username,
        'user_pass'  => $password,
        'user_email' => $email,
        'first_name' => $first,
				'last_name' => $last,
        // 'nickname'   => $nickname,
    );
 
    $user_id = wp_insert_user( $userdata ) ;

		wp_set_current_user($user_id);
 
    if( !is_wp_error($user_id) ) {
        echo '1';
    } else {
        echo $user_id->get_error_message();
    }
  die();
 
}
 
add_action('wp_ajax_register_user', 'reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'reg_new_user');