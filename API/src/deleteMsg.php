<?php
$app->delete('/data/messages/{msg_id}/delete', function($request,$response){
	require_once('class/class.messages.php');
	$message = new Message();
	$msg_id = $request->getAttribute('msg_id');
	$responseAPI=$message->deleteMessage($msg_id);
	return $this->response->withJson($responseAPI)->withStatus($responseAPI['statusCode']);
});


