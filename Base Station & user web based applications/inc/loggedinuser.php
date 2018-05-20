<?php	
	//Need to require user class and create an instance before including file in any page
	if($user->getUserDetailsWithUid($_SESSION['user_uid_login'])){
		foreach($user->getUserDetailsWithUid($_SESSION['user_uid_login']) as $user_details){
			$loggedin_uid = $user_details['uid'];
			$loggedin_first_name = $user_details['firstname'];
			$loggedin_last_name = $user_details['lastname'];
			$loggedin_other_names = $user_details['othernames'];
			$loggedin_phone = $user_details['phone'];
			$loggedin_region = $user_details['region'];
			$loggedin_town = $user_details['town'];
			
			$loggedin_profile_pic = $user_details['profile_pic'];
			if($loggedin_profile_pic != "assets/img/default_user_profile.png"){
				$loggedin_profile_pic = "data/user_data/covers/".$loggedin_profile_pic;
			}
				
			if(empty($loggedin_other_names))
				$loggedin_name = $loggedin_first_name." ".$loggedin_last_name;
			else
				$loggedin_name = $loggedin_first_name." ".$loggedin_other_names.". ".$loggedin_last_name;
		}
	}else{
		die("<script>location.href = '404'</script>");
	}
?>