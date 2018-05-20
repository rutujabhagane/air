<?php
$app->get('/data/user/associatedfarms/get/{user_uid}',function($request,$response){
	require_once('class/class.farms.php');
	$farms = new Farms();
	$user_uid = $request->getAttribute('user_uid');
	$api_response = $farms->getUserAssociatedFarms($user_uid);
	return $this->response->withJson($api_response)->withStatus($api_response['statusCode']);
});

