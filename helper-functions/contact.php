<?php

function email_to_admin() {
    
		$name = $_POST['user'];
    $phone = $_POST['phone'] || 'N/A';
    $company = $_POST['company'] || 'N/A';
    $email = $_POST['email'];
    $message = $_POST['message'];
		$emailTo = get_option('admin_email');

		$subject = 'IDWE contact request From '.$name;

		$headers = 'From: '.$name.'';
		
		wp_mail($emailTo, $subject, $message, $headers);
	
		die();
};

add_action('admin_post_nopriv_contact_form', 'email_to_admin');
add_action('admin_post_contact_form', 'email_to_admin' );