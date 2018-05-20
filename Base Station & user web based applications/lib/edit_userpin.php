<?php
	require_once('../classes/user.class.php');
	$response = array();
	$user = new User();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid']) && isset($_POST['pin']) &&isset($_POST['retype_pin'])){
		
		$uid =  trim(strip_tags($_POST['uid']));
		$pin =  trim(strip_tags($_POST['pin']));
		$retype_pin =  trim(strip_tags($_POST['retype_pin']));
		
		if(!empty($uid)){
			
			if(strlen($pin)>0){//if a password is provided
				if(preg_match('/^[0-9]*$/',$pin)){
					if(!strlen($pin)<4 || !strlen($pin)>6){
						if($pin === $retype_pin){
							$encrypt_pin = password_hash($pin, PASSWORD_BCRYPT);
							$user->updateUserPin($uid,$encrypt_pin);
							$response['success'] = "success";
						}else{
							$response['error'] = "The PINs you entered do not match";
						}
					}else{
						$response['error'] = "Your PIN must be between 4 and 6 characters";
					}
				}else{
					$response['error'] = "The PIN should be numbers";
				}
			}else{ //if password is not provided -- reset password
				$encrypt_pin = password_hash("0101", PASSWORD_BCRYPT);										 
				$user->updateUserPin($uid,$encrypt_pin);	
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