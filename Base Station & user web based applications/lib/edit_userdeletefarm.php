<?php
	require_once('../classes/user_farm.class.php');
	require_once('../classes/user.class.php');
	$response = array();
	$user_farm = new User_Farm();
	$user = new User();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid']) && isset($_POST['farm_id']) && isset($_POST['check'])){
		
		$uid =  trim(strip_tags($_POST['uid']));
		$farm_id =  trim(strip_tags($_POST['farm_id']));
		$check =  trim(strip_tags($_POST['check']));
		
		if(!empty($uid)){
			if($check == "true"){
				if($user_farm->getNumberOfUserFarms($uid)["COUNT(*)"]>1){
					$user_farm->deleteUserFarm($uid,$farm_id);
					$response['success'] = "success";
				}else{
					$response['error'] = "At least one farm should be associated with each farmer";
				}
			}elseif($check == "false"){
				$user_farm->deleteUserFarm($uid,$farm_id);
				if($user_farm->getNumberOfUserFarms($uid)["COUNT(*)"] <= 1){
					$user->deleteUser($uid);
				}
				$response['success'] = "success";
			}else{
				$response['error'] = "An unexpected error occured, please try again";
			}
		
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>