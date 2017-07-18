$(document).ready(function(){
	
	$(".glyphicon-search").on("click", function () {
		$(this).removeClass('show').addClass('no-show');
		$(".glyphicon-remove").removeClass('no-show').addClass('show')

		$('#nav-search').addClass('show-nav').removeClass('no-show-nav')
	})

	$(".glyphicon-remove").on('click',function () {
		$(this).removeClass('show').addClass('no-show');
		$(".glyphicon-search").removeClass('no-show').addClass('show')

		$('#nav-search').addClass('no-show-nav').removeClass('show-nav')
		
	})
})