<?php

use lithium\util\Validator;

//Validator::add('handlerRule', function($value, $format, $options) {
	//return false;
//});

Validator::add(array(
	'zeroToNine' => '/^[0-9]$/',
	'RFC' => '/^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]{3}$/',
));

?>
