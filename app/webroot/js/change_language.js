define(function(require) {
	
	var $ = require('jquery');

	// function remove(arr, position) {
	// 	for(var i = arr.length; i--;) {
	// 	    if(i === position) {
	// 	        arr.splice(i, 1);
	// 	    }
	// 	}
	// }

	$("#change-language").change(function(event){
		var dir = window.location.pathname.split('/');
		var language = $(this).val();
		var url = '';
		if (language === 'default'){
			dir.splice(2, 1);
		}

		$.each(dir, function(i, item){
			if (i >= 1){
				if (i === 2 && language !== 'default') {
					url += '/' + language;
				}
				url += '/' + item;
			}
		});

		window.location.href = url;

	});

});