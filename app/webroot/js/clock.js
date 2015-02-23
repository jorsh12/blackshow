define(function(require) {
	
	var $ = require('jquery');

	setInterval( function() {
		var date = new Date();

		var anio = date.getFullYear();
		var mes = date.getMonth() + 1;
		var dia = date.getDate();
		var fechaActual = ((dia < 10 ? "0" : "" ) + dia) + "/" + ((mes < 10 ? "0" : "" ) + mes) + "/" + anio;

		var hours = date.getHours();
		var minutes = date.getMinutes();
		var seconds = date.getSeconds();
		var horaActual = (( hours < 10 ? "0" : "" ) + hours) + ':' + (( minutes < 10 ? "0" : "" ) + minutes) + ':' + (( seconds < 10 ? "0" : "" ) + seconds);

		$(".clock").html(fechaActual + " " + horaActual);
		},1000);

});