define(function(require) {
	
	var $ = require('jquery');

		require('slider');	

	$('.slider').responsiveSlides({
		auto: false,
		pager: true,
		nav: true,
		prevText: 'Anterior',
		nextText: 'Siguiente'
	});

});