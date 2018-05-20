<?php	
	//Need to require admin class and create an instance before including file in any page
	if($admin->getLoggedInAdmin($_SESSION['admin_uid_login'])){
		foreach($admin->getLoggedInAdmin($_SESSION['admin_uid_login']) as $admin_details){
			$loggedin_uid = $admin_details['uid'];
			$loggedin_username = $admin_details['username'];
			$loggedin_first_name = $admin_details['firstname'];
			$loggedin_last_name = $admin_details['lastname'];
			$loggedin_other_names = $admin_details['othernames'];
			$loggedin_email = $admin_details['email'];
			$loggedin_privilege = $admin_details['title'];
			$loggedin_profile_pic = $admin_details['profile_pic'];
			if($loggedin_profile_pic != "assets/img/default_profile.png"){
				$loggedin_profile_pic = "data/admin_data/covers/".$loggedin_profile_pic;
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