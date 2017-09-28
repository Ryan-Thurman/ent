<?php

function ajax_forgot_password_init(){
	wp_register_script('ajax-forgot-password-script', get_template_directory_uri() . '/src/javascript/ajax-forgot-password.js', array('jquery') );
	wp_enqueue_script( 'ajax-forgot-password-script');

	wp_localize_script( 'ajax-forgot-password-script', 'ajax_fp_object', array(
    'ajaxurl' => home_url() . '/wp-admin/admin-ajax.php'
	));

	//lost password
	add_action( 'wp_ajax_nopriv_lost_pass', 'lost_password' );
	add_action( 'wp_ajax_lost_pass', 'lost_password' );

	//reset password
	add_action( 'wp_ajax_nopriv_reset_pass', 'reset_password_func' );
	add_action( 'wp_ajax_reset_pass', 'reset_password_func' );
}

add_action('init', 'ajax_forgot_password_init');

function lost_password() {
	global $wpdb, $wp_hasher;
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ajax-lostpassword-nonce' ) ) {
    echo( 'Please Try Again');
		die();
	}
	
	$user_login = $_POST['user_login'];
	$errors = new WP_Error();

	if ( empty( $user_login ) ) {
		$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
	} else if ( strpos( $user_login, '@' ) ) {
		$user_data = get_user_by( 'email', trim( $user_login ) );
		if ( empty( $user_data ) )
			$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
	} else {
		$login = trim( $user_login );
		$user_data = get_user_by('login', $login);
	}

	do_action( 'lostpassword_post', $errors );

	if ( $errors->get_error_code() )
		return $errors;

	if ( !$user_data ) {
		$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
		return $errors;
	}

	// Redefining user_login ensures we return the right case in the email.
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;
	$key = get_password_reset_key( $user_data );

	if ( is_wp_error( $key ) ) {
		return $key;
	}

	$message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
	$message .= network_home_url( '/' ) . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
	$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";

	// replace PAGE_ID with reset page ID
	$message .= esc_url( get_permalink(358) . "/?action=rp&key=$key&login=" . rawurlencode($user_login) ) . "\r\n";

	$title = sprintf( __('[%s] Password Reset'));
	$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
	$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

	if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
		$errors->add('confirm', __('Check your e-mail for the confirmation link.'), 'message');
	}
	else {
		$errors->add('could_not_sent', __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'), 'message');
	}
	// display error message
	if ( $errors->get_error_code() ) {
		echo $errors->get_error_message( $errors->get_error_code() );
	}
	die();
}

// Reset Password func

function reset_password_func() {

	$errors = new WP_Error();

	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ajax-user-reset-password-nonce' ) ) {
    echo( 'Please Try Again');
		die();
	}

	$pass1 	= $_POST['pass1'];
	$pass2 	= $_POST['pass2'];
	$key 	= $_POST['user_key'];
	$login 	= $_POST['user_login'];

	$user = check_password_reset_key( $key, $login );

	// make sure user entered a password for both
	if( empty( $pass1 ) || empty( $pass2 ) )
		$errors->add( 'password_required', __( 'Password is required field' ) );

	// do the passwords match?
	if ( isset( $pass1 ) && $pass1 != $pass2 )
		$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );

	do_action( 'validate_password_reset', $errors, $user );

	if ( ( ! $errors->get_error_code() ) && isset( $pass1 ) && !empty( $pass1 ) ) {
		reset_password($user, $pass1);

		$errors->add( 'password_reset', __( 'Your password has been reset.' ) );
	}

	if ( $errors->get_error_code() )
		//send back error message
		echo $errors->get_error_message( $errors->get_error_code() );

	die();
}