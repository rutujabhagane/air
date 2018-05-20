<?php
$app->get('/data/temperature/get/{farm_id}', function($request,$response){
	require_once('class/class.temperature.php');
	$temperature = new Temperature();
	$farm_id = $request->getAttribute('farm_id');
	$responseAPI=$temperature->getCurrentTemperatureReadins($farm_id);
	return $this->response->withJson($responseAPI)->withStatus($responseAPI['statusCode']);
});


