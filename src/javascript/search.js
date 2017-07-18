$(document).ready(function(){
	
	$(".desktop-search").on("click", function () {
		$(this).removeClass('show').addClass('no-show');
		$(".desktop-remove").removeClass('no-show').addClass('show')

		$('#nav-search').addClass('show-nav').removeClass('no-show-nav')
	})

	$(".desktop-remove").on('click',function () {
		$(this).removeClass('show').addClass('no-show');
		$(".desktop-search").removeClass('no-show').addClass('show')

		$('#nav-search').addClass('no-show-nav').removeClass('show-nav')
		
	})

	$(".mobile-remove").on('click',function () {
		$(this).removeClass('show').addClass('no-show');
		$(".mobile-search").removeClass('no-show').addClass('show')

		$('#nav-search-mobile').addClass('no-show-nav').removeClass('show-nav')
		
	})

	$(".mobile-search").on('click',function () {
		$(this).removeClass('show').addClass('no-show');
		$(".mobile-remove").removeClass('no-show').addClass('show')

		$('#nav-search-mobile').addClass('show-nav').removeClass('no-show-nav')
		
	})

})