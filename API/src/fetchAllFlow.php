<?php

$app->get('/sensors/flowread/', function($request){
	require_once('class/class.flowrate.php');
	$flowInst= new Flowrate;

	//$id=$request->getAttribute('id');
	try{
		$result=$flowInst->get_FlowrateInfo();
	}catch(Exception $ex){
		return $ex->getMessage();
	}
	if(isset($result)){
		echo json_encode($result);
	}
});