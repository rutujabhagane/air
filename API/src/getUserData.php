<?php
$app->get('/data/user/get/{user_uid}',function($request,$response){
	require_once('class/class.user.php');
	$user = new User();
	$user_uid = $request->getAttribute('user_uid');
	$api_response = $user->getUser($user_uid);
	return $this->response->withJson($api_response)->withStatus($api_response['statusCode']);
});

