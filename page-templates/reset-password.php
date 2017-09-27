<?php
/*
 * Template Name: Reset-Password Page
 */

$context = Timber::get_context();

// $errors = new WP_Error();
// $user = check_password_reset_key($_GET['key'], $_GET['login']);

// 	if ( is_wp_error( $user ) ) {
// 		if ( $user->get_error_code() === 'expired_key' )
// 			$errors->add( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
// 		else
// 			$errors->add( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
// 	}

// 		// display error message
// 	if ( $errors->get_error_code() )
// 		echo $errors->get_error_message( $errors->get_error_code() );

Timber::render( 'reset-password.twig', $context );