
var $ = jQuery.noConflict();

$(document).ready(function() {
	"use strict";
	
	$('.photo-finisheds').each(function(index, el) {

		$(el).find('img').eq(0).addClass('active');

	});

	$('.colors li').on('click', function(event) {
		event.preventDefault();

		var $colors = $(this).parent();
		var $photof = $colors.prev();

		$colors.find('.active').removeClass('active');
		$(this).addClass('active');


		$photof.find('.active').removeClass('active');
		$photof.find('img').eq($colors.find("li").index(this)).addClass('active');

	});


	$('.colors').each(function(index, el) {
		$(el).find('li').eq(0).addClass('active');
	});


});
