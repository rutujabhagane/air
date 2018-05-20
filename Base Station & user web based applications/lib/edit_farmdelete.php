<?php
	require_once('../classes/user.class.php');
	require_once('../classes/user_farm.class.php');
	require_once('../classes/farm.class.php');
	require_once('../classes/farm_unit.class.php');
	$response = array();
	$user = new User();
	$user_farm = new User_Farm();
	$farm = new Farm();
	$farm_unit = new Farm_Unit();
	
	header('Content-Type: application/json');
	if(isset($_POST['farm_id'])){
		
		$farm_id =  trim(strip_tags($_POST['farm_id']));
	
		if(!empty($farm_id)){
			
			if($user_farm->getUserOfFarm($farm_id) != 0){
				foreach($user_farm->getUserOfFarm($farm_id) as $user_farm_details){
					$user_id = $user_farm_details['user_id'];
					if($user_farm->getNumberOfUserFarms($user_id)["COUNT(*)"] <= 1){ //if user has only this farm profile related to it , delete it
						$user->deleteUser($user_id);
					}
				}
			}
			
			$user_farm->deleteAllFarmEntries($farm_id); //Deleting farm's user_farm entry
			$farm->deleteFarm($farm_id); //Deleting farm
			$farm_unit->deleteAllFarmUnits($farm_id); //Deleting farm units
			
			
			
			$response['success'] = "success";

		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>