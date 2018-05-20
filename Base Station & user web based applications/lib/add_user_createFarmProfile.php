<?php
	$farm_name = trim(strip_tags($_POST['farm_name']));
	$crop = trim(strip_tags($_POST['crop']));
	$size = trim(strip_tags($_POST['size']));
	$soil_type =  trim(strip_tags($_POST['soil_type']));
	$irrigation_type = trim(strip_tags($_POST['irrigation_type']));
	$farm_region =  trim(strip_tags($_POST['farm_region']));
	$farm_town = trim(strip_tags($_POST['farm_town']));
	$block_id = trim(strip_tags($_POST['block_id']));
											
	if(!empty($farm_name) && !empty($crop) && !empty($size) && !empty($soil_type) &&!empty($irrigation_type) &&!empty($farm_region) && !empty($farm_town) && !empty($block_id)){
		if($crop != "none" && $soil_type != "none" && $irrigation_type != "none" && $farm_region != "none"){
			if(preg_match('/^[a-zA-Z_0-9]*$/',$farm_name)){
				if(!(strlen($farm_name)<2) && !(strlen($farm_name)>40)){
					if(preg_match('/^[0-9]*$/',$size)){
						if(!(strlen($size)>10)){
							if(preg_match('/^[a-zA-Z_0-9]*$/',$farm_town)){
								if(!(strlen($farm_town)<2) && !(strlen($farm_town)>40)){
									if(preg_match('/^[0-9]*$/',$block_id)){
																
										if(strlen($pin)>0){ //if a pin is provided
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
																							
																	$farm_id = $farm->createFarmProfile($farm_name,$crop,$size,$soil_type,$irrigation_type,$farm_region,$farm_town,$block_id);
																							
																	$user_farm->addUserFarm($uid,$farm_id);
																							
																	$response['success'] = "success";
																}else{
																	$response['error'] = "The profile picture must not be more than 5MB";
																}
															}else{
																$response['error'] = "The profile picture image must be a jpeg/png/gif format";
															}
																						
														}else{//If no profile pic is being uploaded
																				
															//create user
															$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,'assets/img/default_user_profile.png',$user_region,$user_town);
																				
															$farm_id = $farm->createFarmProfile($farm_name,$crop,$size,$soil_type,$irrigation_type,$farm_region,$farm_town,$block_id);
																				
															$user_farm->addUserFarm($uid,$farm_id);
																				
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
										}else{ //if pin is not provided
																	 
											if(isset($_FILES['profile_pic'])){ // If a pic is being uploaded
												$profile_pic_name=$_FILES['profile_pic']['name'];
												$profile_pic_size=$_FILES['profile_pic']['size'];
												$profile_pic_type=$_FILES['profile_pic']['type'];
										
												if(($profile_pic_type=="image/jpeg") ||($profile_pic_type=="image/png")||($profile_pic_type=="image/gif")){
													if(($profile_pic_size < 5242880)){

														if (!file_exists('../data/user_data/covers/'.$uid.'_covers'))
															mkdir('../data/user_data/covers/'.$uid.'_covers',0777, true);

														move_uploaded_file($_FILES['profile_pic']['tmp_name'],'../data/user_data/covers/'.$uid.'_covers/'.$profile_pic_name);
																							
														$encrypt_pin = password_hash("0101", PASSWORD_BCRYPT);
																							
														//create user
														$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,$uid.'_covers/'.$profile_pic_name,$user_region,$user_town);
																							
														$farm_id = $farm->createFarmProfile($farm_name,$crop,$size,$soil_type,$irrigation_type,$farm_region,$farm_town,$block_id);
																							
														$user_farm->addUserFarm($uid,$farm_id);
																							
														$response['success'] = "success";
																							
													}else{
														$response['error'] = "The profile picture must not be more than 5MB";
													}
												}else{
													$response['error'] = "The profile picture image must be a jpeg/png/gif format";
												}
																				
																				
											}else{
												$encrypt_pin = password_hash("0101", PASSWORD_BCRYPT);
																				
												//create user
												$user->createUser($uid,$first_name,$last_name,$other_names,$phone,$encrypt_pin,'assets/img/default_user_profile.png',$user_region,$user_town);
																				
												$farm_id = $farm->createFarmProfile($farm_name,$crop,$size,$soil_type,$irrigation_type,$farm_region,$farm_town,$block_id);
																				
												$user_farm->addUserFarm($uid,$farm_id);
																				
												$response['success'] = "success";
																				
																			
											}
																	 
																	 
										}
																
									}else{
										$response['error'] = "The block id should be numbers";
									}
								}else{
									$response['error'] = "Farm town/city field must be between 2 and 40 characters";
								}
							}else{
								$response['error'] = "Farm town/city field contain some invalid characters";
							}
						}else{
							$response['error'] = "Farm size must not be more than 10 characters";
						}
					}else{
						$response['error'] = "Farm size field contain some invalid characters";
					}
				}else{
					$response['error'] = "The farm name must be between 2 and 20 characters";
				}
			}else{
				$response['error'] = "The farm name contains some invalid characters";
			}
		}else{
			$response['error'] = "Make sure crop, soil type, irrigation type, region are selected";
		}
	}else{
		$response['error'] = "All farm details are required";
	}
?>