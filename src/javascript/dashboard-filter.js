jQuery(document).ready(function ($) {
	
	$('#filter').find('input:checkbox').change(function () {
		var filter = $('#filter');
		$.ajax({
			url: filter.attr('action'),
			data: {
				action: "myfilter",
				data: filter.serializeArray()
			}, 
			type: filter.attr('method'), 
			success: function (data) {
				$('#response').empty();
				// $(data).appendTo('#response').hide().fadeIn(1000)
				$('#response').html(data).hide().fadeIn(500)
			}
		});
		return false;
	});
});