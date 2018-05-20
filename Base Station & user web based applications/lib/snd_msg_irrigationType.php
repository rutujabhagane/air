<?php
	require_once('../classes/message.class.php');
	require_once('../classes/user_farm.class.php');
	require_once('../classes/farm.class.php');
	$response = array();
	$msg = new Message();
	$user_farm = new User_Farm();
	$farm = new Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['message']) && isset($_POST['crop'])){
		
		$message =  trim(strip_tags($_POST['message']));
		$irrigation_type =  trim(strip_tags($_POST['irrigation_type']));
		$subject =  trim(strip_tags($_POST['subject']));
		$date = date('Y-m-d H:i:s');
		
		if($irrigation_type != 'none'){
			if(!(strlen($subject)>24)){
				if(!empty($message)){
					
					if(empty($subject)){
						$subject = "Message from AirSys";
					}
					
					foreach($farm->getFarmsWithIrrigationType($irrigation_type) as $farm_details){
						$farm_id = $farm_details['id'];
						foreach($user_farm->getUserOfFarm($farm_id) as $user_details){
							$msg->addMessage($user_details['user_id'],$subject,$message,$date,0);
						}
					}
	
					$response['success'] = 'success';
				}else{
					$response['error'] = "Enter in a message to send";
				}
			}else{
				$response['error'] = "Subject shouldn't be more than 24 characters";
			}
		}else{
			$response['error'] = "Select an Irrigation type";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>