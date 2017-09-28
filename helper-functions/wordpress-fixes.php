<?php

add_action( 'admin_init', 'redirect_non_admin_users' );
/**
 * Redirect non-admin users to home page
 *
 * This function is attached to the 'admin_init' action hook.
 */
function redirect_non_admin_users() {
	if ( ! current_user_can( 'edit_others_posts' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('after_setup_theme', 'remove_admin_bar');


function logout () {
  wp_redirect( '/' );
  exit();
}

add_action( 'wp_logout', 'logout' );