<?php
	session_start();
	require_once('../classes/admin.class.php');
	$admin = new Admin();
	header('Content-Type: application/json');
	$response = array();
	if(isset($_POST['data'])){
		$data = $_POST['data'];
		if(!empty($data['username']) && !empty($data['password'])){
			$username = trim(strip_tags($data['username']));
			$password = trim(strip_tags($data['password']));

			if($admin->getUserLogin($username) != 0){
				$loging_user = $admin->getUserLogin($username);
				foreach ($loging_user as $key ) {
					$uid = $key['uid'];
					$db_password = $key['password'];
				}
				if(password_verify($password, $db_password)) {
					$_SESSION['admin_uid_login'] = $uid;
				    $response['success'] = true;
				}else{
				    $response['error'] = "Wrong password entered";
				}
			}else{
				$response['error'] = "Invalid username entered";
			}
		}else{
			$response['error'] = "All fields are required";
		}
	}else{
		$response['error'] = "An error occured, please try again!!";
	}
	echo json_encode($response);
?>