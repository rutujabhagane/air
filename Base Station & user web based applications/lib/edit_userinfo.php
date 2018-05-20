<?php
	require_once('../classes/user.class.php');
	$response = array();
	$user = new User();
	
	header('Content-Type: application/json');
	if(isset($_POST['uid']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['other_names']) && isset($_POST['phone']) && isset($_POST['region']) && isset($_POST['town'])){
		
		$uid =  trim(strip_tags($_POST['uid']));
		$first_name =  trim(strip_tags($_POST['first_name']));
		$last_name =  trim(strip_tags($_POST['last_name']));
		$other_names =  trim(strip_tags($_POST['other_names']));
		$phone =  trim(strip_tags($_POST['phone']));
		$user_region =  trim(strip_tags($_POST['region']));
		$user_town =  trim(strip_tags($_POST['town']));
		
		if(!empty($first_name) && !empty($last_name) && !empty($phone) && !empty($user_region) && !empty($user_town)){
			
			if(!(strlen($first_name)<2) && !(strlen($first_name)>25)){
				if(preg_match('/^[a-zA-Z]*$/',$first_name)){
					if(!(strlen($last_name)<2) && !(strlen($last_name)>25)){	
						if(preg_match('/^[a-zA-Z]*$/',$last_name)){
							if(preg_match('/^[a-zA-Z]*$/',$other_names)){
								if(preg_match('/^[0-9]*$/',$phone)){
									if(!(strlen($phone)<10) && !(strlen($phone)>12)){
										if($user_region != "none"){
											if(preg_match('/^[a-zA-Z_0-9]*$/',$user_town)){
												if(!(strlen($user_town)>40)){
													
													
													
													if(isset($_FILES['profile_pic'])){ // If a new pic is being uploaded
														$profile_pic_name=$_FILES['profile_pic']['name'];
														$profile_pic_size=$_FILES['profile_pic']['size'];
														$profile_pic_type=$_FILES['profile_pic']['type'];
								
														if(($profile_pic_type=="image/jpeg") ||($profile_pic_type=="image/png")||($profile_pic_type=="image/gif")){
															if(($profile_pic_size < 5242880)){

																if (!file_exists('../data/user_data/covers/'.$uid.'_covers'))
																	mkdir('../data/user_data/covers/'.$uid.'_covers',0777, true);

																move_uploaded_file($_FILES['profile_pic']['tmp_name'],'../data/user_data/covers/'.$uid.'_covers/'.$profile_pic_name);
																					
																//Update user fields
																$user->updateUserInformationWithCover($uid,$first_name,$last_name,$other_names,$phone,$uid.'_covers/'.$profile_pic_name,$user_region,$user_town);						
																	
																	
																$response['success'] = "success";
																					
															}else{
																$response['error'] = "The profile picture must not be more than 5MB";
															}
														}else{
															$response['error'] = "The profile picture image must be a jpeg/png/gif format";
														}
																						
													}else{
														//Update user fields without cover
														$user->updateUserInformation($uid,$first_name,$last_name,$other_names,$phone,$user_region,$user_town);
															
														$response['success'] = "success";
													}
													
												}else{
													$response['error'] = "User town/city field must not be more than 40 characters";
												}
											}else{
												$response['error'] = "User town/city field contain some invalid characters";
											}
										}else{
											$response['error'] = "Select a region for the user";
										}
									}else{
										$response['error'] = "Phone number should be at most 12 numbers and not less than 10 numbers";
									}
								}else{
									$response['error'] = "Invalid phone number entered";
								}
							}else{
								$response['error'] = "The other names field contains some invalid characters";
							}
						}else{
							$response['error'] = "The last name contains some invalid characters";
						}
					}else{
						$response['error'] = "The last name must be between 2 and 25 characters";
					}
				}else{
					$response['error'] = "The first name contains some invalid characters";
				}
			}else{
				$response['error'] = "The first name must be between 2 and 25 characters";
			}
			
			
		}else{
			$response['error'] = "First name, last name, phone, region and city fields are required";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>