<?php
	require_once('../classes/message.class.php');
	require_once('../classes/user.class.php');
	$response = array();
	$msg = new Message();
	$user = new User();
	header('Content-Type: application/json');
	if(isset($_POST['message'])){
		$message =  trim(strip_tags($_POST['message']));
		$subject =  trim(strip_tags($_POST['subject']));
		$date = date('Y-m-d H:i:s');
		
		if(!(strlen($subject)>24)){
			if(!empty($message)){
				
				if(empty($subject)){
					$subject = "Message from AirSys";
				}
				
				foreach($user->getUsers() as $user_fetched){
					$msg->addMessage($user_fetched['uid'],$subject,$message,$date,0);
				}
				$response['success'] = 'success';
			}else{
				$response['error'] = "Enter in a message to send";
			}
		}else{
			$response['error'] = "Subject shouldn't be more than 24 characters";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>