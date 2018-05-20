<?php
	require_once('../classes/admin.class.php');
	$response = array();
	$admin = new Admin();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid']) && isset($_POST['password']) &&isset($_POST['retype_password'])){
		
		$uid =  trim(strip_tags($_POST['uid']));
		$password =  trim(strip_tags($_POST['password']));
		$retype_password =  trim(strip_tags($_POST['retype_password']));
		
		if(!empty($uid)){
			
			if(strlen($password)>0){//if a password is provided
				if(!strlen($password)<12 || !strlen($password)>20){
					if($password === $retype_password){
						$encrypt_pswd = password_hash($password, PASSWORD_BCRYPT);
						$admin->updateAdminPassword($uid,$encrypt_pswd);
						$response['success'] = "success";
					}else{
						$response['error'] = "The passwords you entered do not match";
					}
				}else{
					$response['error'] = "Your password must be between 12 and 20 characters";
				}
			}else{ //if password is not provided -- reset password
				$encrypt_pswd = password_hash("airsysadmin1", PASSWORD_BCRYPT);										 
				$admin->updateAdminPassword($uid,$encrypt_pswd);	
				$response['success'] = "success";
			}
			
		}else{
			$response['error'] = "An unexpected error occured, please try again";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>