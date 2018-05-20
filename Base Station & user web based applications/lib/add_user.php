<?php
	require_once('../classes/user.class.php');
	require_once('../classes/farm.class.php');
	require_once('../classes/user_farm.class.php');
	$response = array();
	$user = new User();
	$farm = new Farm();
	$user_farm = new User_Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['other_names']) && isset($_POST['phone']) && isset($_POST['user_region']) && isset($_POST['user_town']) && isset($_POST['pin']) && isset($_POST['retype_pin']) && isset($_POST['existing_farm_q']) && isset($_POST['existing_farms']) && isset($_POST['crop']) && isset($_POST['size']) && isset($_POST['soil_type']) && isset($_POST['irrigation_type']) && isset($_POST['farm_region']) && isset($_POST['farm_town'])){
		
		$first_name =  trim(strip_tags($_POST['first_name']));
		$last_name =  trim(strip_tags($_POST['last_name']));
		$other_names =  trim(strip_tags($_POST['other_names']));
		$phone =  trim(strip_tags($_POST['phone']));
		$user_region =  trim(strip_tags($_POST['user_region']));
		$user_town =  trim(strip_tags($_POST['user_town']));
		
		
		$pin =  trim(strip_tags($_POST['pin']));
		$retype_pin = trim(strip_tags($_POST['retype_pin']));
		
		$existing_farm_q =  trim(strip_tags($_POST['existing_farm_q']));
		$existing_farms = trim(strip_tags($_POST['existing_farms']));
		
		if(!empty($first_name) && !empty($last_name) && !empty($phone) &&!empty($user_region) &&!empty($user_town)){
				
			if(!(strlen($first_name)<2) && !(strlen($first_name)>25)){
				if(preg_match('/^[a-zA-Z]*$/',$first_name)){
					if(!(strlen($last_name)<2) && !(strlen($last_name)>25)){	
						if(preg_match('/^[a-zA-Z]*$/',$last_name)){
							if(preg_match('/^[a-zA-Z]*$/',$other_names)){
								if(preg_match('/^[0-9]*$/',$phone)){
									if(!(strlen($phone)<10) && !(strlen($phone)>12)){
										if($user->checkDuplicatePhone($phone) == false){
											if($user_region != "none"){
												if(preg_match('/^[a-zA-Z_0-9]*$/',$user_town)){
													if(!(strlen($user_town)>40)){
														//$uid = trim(strip_tags(substr(base64_encode(openssl_random_pseudo_bytes(32)),0,10)));
														
														$uid = trim(substr(uniqid('', true), 0, 10));
														
														if($existing_farm_q == "yes"){//Selecting from an existing farm profile
															require_once('add_user_selectFarmProfile.php'); // Requiring operation
														}elseif($existing_farm_q == "no"){ // Creating a new farm profile
															require_once('add_user_createFarmProfile.php'); // Requiring operation
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
											$response['error'] = "The phone number is already associated with another user";
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
			$response['error'] = "Farmer's first name, last name, phone, region and town fields are required";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>