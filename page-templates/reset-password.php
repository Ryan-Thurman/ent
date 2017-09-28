<?php
/*
 * Template Name: Reset-Password Page
 */

$context = Timber::get_context();



if( isset($_GET['key']) && !empty($_GET['key'])) {
	$resetKey = $_GET['key'];
} else {
	$resetKey = "";
}

if( isset($_GET['login']) && !empty($_GET['login'])) {
	$resetlogin = $_GET['login'];
} else {
	$resetlogin = "";
}

$errors = new WP_Error();

// if ($resetKey === "" || $resetlogin === "") {
// 	$errors->add('wronglink', __( 'Sorry you must have come to this page on accident'));
// } else {

	$check = check_password_reset_key($resetKey , $resetLogin);

	if ( is_wp_error( $user ) ) {
		if ( $user->get_error_code() === 'expired_key' )
			$errors->add( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
		else
			$errors->add( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
	} else {
		$context['key'] = $resetKey;
		$context['user_login'] = $resetLogin;
	}
// }

$context['errors'] = $errors;

Timber::render( 'reset-password.twig', $context );