<?php
$app->get('/data/moisture/get/{farm_id}', function($request,$response){
	require_once('class/class.moisture.php');
	$moisture = new Moisture();
	$farm_id = $request->getAttribute('farm_id');
	$responseAPI=$moisture->getCurrentMoistureReadins($farm_id);
	return $this->response->withJson($responseAPI)->withStatus($responseAPI['statusCode']);
});


