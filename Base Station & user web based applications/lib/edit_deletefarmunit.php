<?php
	require_once('../classes/farm_unit.class.php');
	$response = array();
	$farm_unit = new Farm_Unit();
	
	header('Content-Type: application/json');
	if(isset($_POST['id'])){
		
		$id =  trim(strip_tags($_POST['id']));
	
		if(!empty($id)){
			$farm_unit->deleteFarmUnit($id);
			$response['success'] = "success";
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>