define(function(require) {
	
	var $ = require('jquery');

	var heightImage = $(".image-right").outerHeight();
	$('.equal').css('height', heightImage + 'px');


});