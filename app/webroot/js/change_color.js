define(function(require) {
	
	var $ = require('jquery');

	var el = $("#change-color");

	var main = $('.contenedor-main');
	var color = el.val();

	main.removeClass('image-fondo-pink');
	main.removeClass('image-fondo-light_blue');

	if (color !== 'default') {
		main.addClass('image-fondo-' + color);
	}


	$("#change-color").change(function(event){
		var color = $(this).val()

		var dir = window.location.pathname.split('/');
		var url = '';

		console.log(dir);

		$.each(dir, function(i, item){
			if (i >= 1){
				if (item !== 'pink' && item !== 'light_blue'){
					url += '/' + item
				}
			}
		});

		if (url.substring(url.length - 1) === '/') {
			url = url.substring(0, url.length - 1);
		}

		if (color !== 'default') {
			window.location.href = url + '/' + color;	
		} else {
			window.location.href = url;
		}
		
	});

});