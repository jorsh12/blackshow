<?php

use li3_access\security\Access;
use lithium\net\http\Router;

Access::config(array(
	'rules' => array(
		'adapter' => 'Rules',
	)
));

Access::adapter('rules')->add('denyUsers', function($user, $request, $options) {
	//dump(!empty($user));die();
	return !empty($user);
});

Access::adapter('rules')->add('allowAnyUser', function(){
	return true;
})

// Access::adapter('rules')->add('UserMustChangePassword', function($user, $request, $options) {
// 	if ($user && $user->getMustChangePassword()) {
// 		return ($request->url === Router::match($options['redirect']));
// 	}
// 	return true;
// });

?>
