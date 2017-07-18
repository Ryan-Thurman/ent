$(document).ready(function () {
	$('.swiper-container').each(function (i, v) {

		var breakpoints = {
			720: {
				slidesPerView: 1,
				spaceBetween: 20
			}
		};
		slidesPerView = $(this).data('spv');
		spaceBetween = 30;

		s = new Swiper($(this), {
			pagination: $(this).find('.swiper-pagination'),
			paginationClickable: $(this).find('.swiper-pagination'),
			// nextButton: $(this).find('.swiper-button-next'),
			// prevButton: $(this).find('.swiper-button-prev'),
			loop: true,
			paginationClickable: true,
			slidesPerView: slidesPerView,
			spaceBetween: spaceBetween,
			breakpoints: breakpoints
		});
	});
})