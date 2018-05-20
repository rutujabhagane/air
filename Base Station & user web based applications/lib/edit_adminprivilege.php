<?php
	require_once('../classes/admin.class.php');
	$response = array();
	$admin = new Admin();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid']) && isset($_POST['title']) ){
		
		$uid =  trim(strip_tags($_POST['uid']));
		$title =  trim(strip_tags($_POST['title']));
	
		if(!empty($uid) && !empty($title)){
			if($title != "none"){
				$admin->updateAdminPrivilege($uid,$title);
				$response['success'] = "success";
			}else{
				$response['error'] = "Admin Privilege is required, give admin a privilege";
			}
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>