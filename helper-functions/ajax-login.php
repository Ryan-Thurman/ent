<?php

function ajax_login_init(){
  wp_register_script('ajax-login-script', get_template_directory_uri() . '/src/javascript/ajax-login-script.js', array('jquery') ); 
  wp_enqueue_script('ajax-login-script');

  wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
    'ajaxurl' => home_url() . '/wp-admin/admin-ajax.php',
    'redirecturl' => home_url(),
    'loadingmessage' => __('Sending info, please wait...')
  ));

	add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login(){
	wp_verify_nonce( 'ajax-login-nonce', 'idwe_login_security' );

  $info = array();
  $info['user_login'] = $_POST['username'];
  $info['user_password'] = $_POST['password'];
  $info['remember'] = true;

  $user_signon = wp_signon( $info, false );
  if ( is_wp_error($user_signon) ){
      echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
  } else {
			wp_set_current_user($user_signon->ID);
      echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful!')));
  }

  die();
}