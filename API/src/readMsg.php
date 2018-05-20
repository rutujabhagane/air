<?php
$app->put('/data/messages/unread/{msg_id}/read', function($request,$response){
	require_once('class/class.messages.php');
	$message = new Message();
	$msg_id = $request->getAttribute('msg_id');
	$responseAPI=$message->readMessage($msg_id);
	return $this->response->withJson($responseAPI)->withStatus($responseAPI['statusCode']);
});


