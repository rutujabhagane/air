<?php
	require_once('../classes/message.class.php');
	require_once('../classes/user_farm.class.php');
	require_once('../classes/farm.class.php');
	$response = array();
	$msg = new Message();
	$user_farm = new User_Farm();
	$farm = new Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['message']) && isset($_POST['region'])){
		
		$message =  trim(strip_tags($_POST['message']));
		$region =  trim(strip_tags($_POST['region']));
		$subject =  trim(strip_tags($_POST['subject']));
		$date = date('Y-m-d H:i:s');
		
		if($region != 'none'){
			if(!(strlen($subject)>24)){
				if(!empty($message)){
					
					if(empty($subject)){
						$subject = "Message from AirSys";
					}
					
					foreach($farm->getFarmsWithRegion($region) as $farm_details){
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
			$response['error'] = "Select a region";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>