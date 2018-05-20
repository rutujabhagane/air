<?php
	session_start();
	require_once('../../classes/user.class.php');
	$user = new User();
	header('Content-Type: application/json');
	$response = array();
	if(isset($_POST['data'])){
		$data = $_POST['data'];
		if(!empty($data['phone']) && !empty($data['pin'])){
			$phone = trim(strip_tags($data['phone']));
			$pin = trim(strip_tags($data['pin']));

			if($user->getUserLogin($phone) != 0){
				$loging_user = $user->getUserLogin($phone);
				foreach ($loging_user as $key ) {
					$uid = $key['uid'];
					$db_pin = $key['pin'];
				}
				if(password_verify($pin, $db_pin)) {
					$_SESSION['user_uid_login'] = $uid;
				    $response['success'] = true;
				}else{
				    $response['error'] = "Wrong PIN entered";
				}
			}else{
				$response['error'] = "Invalid phone number entered";
			}
		}else{
			$response['error'] = "All fields are required";
		}
	}else{
		$response['error'] = "An error occured, please try again!!";
	}
	echo json_encode($response);
?>