<?php

function email_to_admin() {
    /**
     * At this point, $_GET/$_POST variable are available
     *
     * We can do our normal processing here
     */ 

    // Sanitize the POST field
    // Generate email content
    // Send to appropriate email
		$name = $_POST['user'];
    $phone = $_POST['phone'] || 'N/A';
    $company = $_POST['company'] || 'N/A';
    $email = $_POST['email'];
    $message = $_POST['message'];
		$emailTo = get_option('admin_email');

		$subject = 'IDWE contact request From '.$name;

		$headers = 'From: '.$name.' <'.$emailTo.'>' . PHP_EOL  . 'Reply-To: ' .$email;
		
		wp_mail($emailTo, $subject, $message, $headers);
	
		die();
};

add_action('admin_post_nopriv_contact_form', 'email_to_admin');
add_action('admin_post_contact_form', 'email_to_admin' );