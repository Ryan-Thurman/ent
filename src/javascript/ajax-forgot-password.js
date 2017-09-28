jQuery(document).ready(function ($) {

	$("form#lostPasswordForm").on('submit', (function (e) {
		e.preventDefault();
		
		var submit = $("div#lostPassword #submit"),
			message = $("div#lostPassword #status"),
			contents = {
				action: 'lost_pass',
				user_login: $("div#lostPassword #user_login").val(),
				nonce: $('#idwe_lostpassword_security').val()
			},
			url = ajax_fp_object.ajaxurl;

		submit.attr("disabled", "disabled").addClass('disabled');

		$.post(url, contents, function (data) {
			submit.removeAttr("disabled").removeClass('disabled');
			message.html(data);
		});
		return false
	})
	)

	$("form#resetPasswordForm").submit(function (e) {
		e.preventDefault();

		var submit = $("#resetPasswordForm #submit"),
			message = $("#resetPasswordForm #message"),
			contents = {
				action: 'reset_pass',
				nonce: $('#idwe_resetpassword_security').val(),
				pass1: $('#resetPasswordForm #password_one').val(),
				pass2: $('#resetPasswordForm #password_two').val(),
				user_key: $('#resetPasswordForm #user_key').val(),
				user_login: $('#resetPasswordForm #user_login').val()
			},
			url = ajax_fp_object.ajaxurl;

			console.log(contents)

		submit.attr("disabled", "disabled").addClass('disabled');

		$.post(url, contents, function (data) {
			submit.removeAttr("disabled").removeClass('disabled');

			message.html(data);
		});

		return false;
	});

});