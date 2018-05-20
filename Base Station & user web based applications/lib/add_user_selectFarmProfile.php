<?php
	if($existing_farms != "none"){
		if(strlen($pin)>0){//if a pin is provided
			if(preg_match('/^[0-9]*$/',$pin)){
				if(!(strlen($pin)<4) && !(strlen($pin)>6)){
					if($pin === $retype_pin){
						$encrypt_pin = password_hash($pin, PASSWORD_BCRYPT);
						if(isset($_FILES['profile_pic'])){ // If a pic is being uploaded
							$profile_pic_name=$_FILES['profile_pic']['name'];
							$profile_pic_size=$_FILES['profile_pic']['size'];
							$profile_pic_type=$_FILES['profile_pic']['type'];
										
							if(($profile_pic_type=="image/jpeg") ||($profile_pic_type=="image/png")||($profile_pic_type=="image/gif")){
								if(($profile_pic_size < 5242880)){

									if (!file_exists('../data/user_data/covers/'.$uid.'_covers'))
										mkdir('../data/user_data/covers/'.$uid.'_covers',0777, true);

									move_uploaded_file($_FILES['profile_pic']['tmp_name'],'../data/user_data/covers/'.$uid.'_covers/'.$profile_pic_name);
																							
									//create user
									$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,$uid.'_covers/'.$profile_pic_name,$user_region,$user_town);
																	
									$user_farm->addUserFarm($uid,$existing_farms);
																	
									$response['success'] = "success";
								}else{
									$response['error'] = "The profile picture must not be more than 5MB";
								}
							}else{
								$response['error'] = "The profile picture image must be a jpeg/png/gif format";
							}
											
						}else{//If no profile pic is being uploaded
																				
							//create user
							$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,"assets/img/default_user_profile.png",$user_region,$user_town);
															
							$user_farm->addUserFarm($uid,$existing_farms);
																				
							$response['success'] = "success";
						}
														

					}else{
						$response['error'] = "The PINs you entered do not match";
					}
				}else{
					$response['error'] = "Your PIN must be between 4 and 6 characters";
				}
			}else{
				$response['error'] = "The PIN should be numbers";
			}
		}else{
			$encrypt_pin = password_hash("0101", PASSWORD_BCRYPT);
			if(isset($_FILES['profile_pic'])){ // If a pic is being uploaded
				$profile_pic_name=$_FILES['profile_pic']['name'];
				$profile_pic_size=$_FILES['profile_pic']['size'];
				$profile_pic_type=$_FILES['profile_pic']['type'];
										
				if(($profile_pic_type=="image/jpeg") ||($profile_pic_type=="image/png")||($profile_pic_type=="image/gif")){
					if(($profile_pic_size < 5242880)){

						if (!file_exists('../data/user_data/covers/'.$uid.'_covers'))
							mkdir('../data/user_data/covers/'.$uid.'_covers',0777, true);

						move_uploaded_file($_FILES['profile_pic']['tmp_name'],'../data/user_data/covers/'.$uid.'_covers/'.$profile_pic_name);
																							
						//create user
						$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,$uid.'_covers/'.$profile_pic_name,$user_region,$user_town);
															
						$user_farm->addUserFarm($uid,$existing_farms);
																							
						$response['success'] = "success";
					}else{
						$response['error'] = "The profile picture must not be more than 5MB";
					}
				}else{
					$response['error'] = "The profile picture image must be a jpeg/png/gif format";
				}
																				
																				
			}else{//If no profile pic is being uploaded
																				
				//create user
				$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,"assets/img/default_user_profile.png",$user_region,$user_town);
													
				$user_farm->addUserFarm($uid,$existing_farms);
																				
				$response['success'] = "success";
			}
		}
											
	}else{
		$response['error'] = "Select an existing farm profile";
	}
					
?>