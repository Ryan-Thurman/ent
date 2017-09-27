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
			console.log(data)
			submit.removeAttr("disabled").removeClass('disabled');
			message.html(data);
		});
		return false
	})
	)

	$("form#resetPasswordForm").submit(function () {
		var submit = $("div#resetPassword #submit"),
			preloader = $("div#resetPassword #preloader"),
			message = $("div#resetPassword #message"),
			contents = {
				action: 'reset_pass',
				nonce: this.rs_user_reset_password_nonce.value,
				pass1: this.pass1.value,
				pass2: this.pass2.value,
				user_key: this.user_key.value,
				user_login: this.user_login.value
			};

		submit.attr("disabled", "disabled").addClass('disabled');

		preloader.css({
			'visibility': 'visible'
		});

		$.post(theme_ajax.url, contents, function (data) {
			submit.removeAttr("disabled").removeClass('disabled');

			preloader.css({
				'visibility': 'hidden'
			});

			message.html(data);
		});

		return false;
	});

});