<?php
	require_once('../../classes/message.class.php');
	$response = array();
	$message = new Message();
	
	header('Content-Type: application/json');
	if(isset($_POST['msg_id'])){
		
		$msg_id =  trim(strip_tags($_POST['msg_id']));
	
		if(!empty($msg_id)){
			$message->deleteMessage($msg_id);
			$response['success'] = "success";
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>