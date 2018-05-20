<?php
	require_once('../classes/admin.class.php');
	$response = array();
	$admin = new Admin();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid'])){
		
		$uid =  trim(strip_tags($_POST['uid']));
	
		if(!empty($uid)){
			$admin->deleteAdmin($uid);
			$response['success'] = "success";
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>