<?php
	require_once('../classes/user_farm.class.php');
	$response = array();
	$user_farm = new User_Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['farm_id']) && isset($_POST['farmer_uid'])){
		
		$farm_id = trim(strip_tags($_POST['farm_id']));
		$farmer_uid = trim(strip_tags($_POST['farmer_uid']));
		
		if($farmer_uid != "none"){
			if($user_farm->checkDuplicateEntry($farm_id,$farmer_uid) == false){
				$user_farm->addUserFarm($farmer_uid,$farm_id);//adding user to user farm
				$response['success'] = "success";
			}else{
				$response['error'] = "Farmer is already associated with this farm profile";
			}
		}else{
			$response['error'] = "Make sure a farmer is selected";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>