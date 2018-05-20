<?php

$app->get('/data/messages/unread/{user_uid}', function($request){
	require_once('class/class.messages.php');
	$msg= new Message();
	$user_uid = $request->getAttribute('user_uid');
	$api_response = $msg->getAllUserUnreadMessages($user_uid);
	return $this->response->withJson($api_response)->withStatus($api_response['statusCode']);
});

$app->get('/data/messages/read/{user_uid}', function($request){
	require_once('class/class.messages.php');
	$msg= new Message();
	$user_uid = $request->getAttribute('user_uid');
	$api_response = $msg->getAllUserReadMessages($user_uid);
	return $this->response->withJson($api_response)->withStatus($api_response['statusCode']);
});