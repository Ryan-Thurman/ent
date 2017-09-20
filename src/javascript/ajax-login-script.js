jQuery(document).ready(function($) {
	// Perform AJAX login on form submit
	$('#mobileLogin').on('click', function(){
		$('.navbar-toggle').trigger('click')
	})
	
    $('form#login').on('submit', function(e){
				$('form#login p.status').show().text(ajax_login_object.loadingmessage)
				.addClass('alert-info center')
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'security': $('form#login #security').val() },
            success: function(data){
                if (data.loggedin == true){
									$('form#login p.status').text(data.message)
									.addClass('alert-success center')
                    document.location.href = '/dashboard';
                } else {
									$('form#login p.status').text(data.message)
									.addClass('alert-danger center')
								}
            }
        });
        e.preventDefault();
    });

});


