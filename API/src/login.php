<?php
$app->get('/data/user/login/{phone_number}/{pin}', function($request,$response){
	require_once('class/class.user.php');
	$user = new User();
	$phone = $request->getAttribute('phone_number');
	$pin = $request->getAttribute('pin');
	$responseAPI=$user->login($phone,$pin);
	return $this->response->withJson($responseAPI)->withStatus($responseAPI['statusCode']);
});


