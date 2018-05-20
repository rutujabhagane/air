<?php
	require_once('../classes/message.class.php');
	$response = array();
	$msg = new Message();
	
	header('Content-Type: application/json');
	if(isset($_POST['message']) && isset($_POST['users'])){
		
		$message =  trim(strip_tags($_POST['message']));
		$users =  trim(strip_tags($_POST['users']));
		$subject =  trim(strip_tags($_POST['subject']));
		$date = date('Y-m-d H:i:s');
		
		if(!empty($users)){
			if(!(strlen($subject)>24)){
				if(!empty($message)){
					
					$users = explode(",",$users);
					
					if(empty($subject)){
						$subject = "Message from AirSys";
					}
					
					for ($start=0; $start < count($users); $start++) {
						$msg->addMessage($users[$start],$subject,$message,$date,0);
					}
					$response['success'] = 'success';
				}else{
					$response['error'] = "Enter in a message to send";
				}
			}else{
				$response['error'] = "Subject shouldn't be more than 24 characters";
			}
		}else{
			$response['error'] = "Select a user or users";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>