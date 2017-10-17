jQuery(document).ready(function ($) {
	
	$('#filter').find('input:checkbox').change(function (e) {
		if(e.target.name === 'all') {
			$('input:checkbox').not(this).prop('checked', this.checked);
		}

		var filter = $('#filter');

		var ajax_url = ajax_filter_object.ajax_url; 

		$.ajax({
			url: ajax_url,
			data: {
				action: "myfilter",
				data: filter.serializeArray()
			}, 
			type: filter.attr('method'), 
			success: function (data) {
				$('#response').empty();
				$('#response').html(data).hide().fadeIn(500)
			}
		});
		return false;
	});
});