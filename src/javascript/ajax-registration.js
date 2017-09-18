jQuery(document).ready(function($) {
 
  $('#reg-new-user').click( function(event) {
		event.preventDefault();		
    
    var reg_nonce = $('#new_user_nonce').val();
    var reg_user  = $('#reg_username').val();
    var reg_pass  = $('#reg_pass').val();
    var reg_mail  = $('#reg_email').val();
    var reg_name  = $('#reg_name').val();
    var reg_nick  = $('#reg_nickname').val();
 
    var ajax_url = ajax_register_object.ajax_url; 
    
    var data = {
      action: 'register_user',
      nonce: reg_nonce,
      user: reg_user,
      pass: reg_pass,
      mail: reg_mail,
      // name: reg_name,
      nick: reg_nick,
		}; 
    
    $.post( ajax_url, data, function(response) {
 
      if( response ) {
        if( response === '1' ) {
					$('.result-message').html('Your submission is complete.').addClass('alert-success').show();
					document.location.href = '/myaccount';
        } else {
          $('.result-message').html( response ).addClass('alert-danger').show(); 
        }
      }
    });
  });
});