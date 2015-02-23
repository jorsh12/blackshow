define(function(require) {
	
	var $ = require('jquery');

		require('bootstrapjs');

	var heightImage = $(".image-right").outerHeight();
	$('.equal').css('height', heightImage + 'px');

});