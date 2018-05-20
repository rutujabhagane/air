<?php
	require_once('../classes/user.class.php');
	require_once('../classes/user_farm.class.php');
	$response = array();
	$user = new User();
	$user_farm = new User_Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid'])){
		
		$uid =  trim(strip_tags($_POST['uid']));
	
		if(!empty($uid)){
			$user_farm->deleteAllUserEntries($uid); //Deleting user_farm entry
			$user->deleteUser($uid);
			$response['success'] = "success";
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>