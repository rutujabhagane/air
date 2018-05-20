<?php
	require_once('../classes/admin.class.php');
	$response = array();
	$admin = new Admin();
	
	header('Content-Type: application/json');
	if(isset($_POST['username']) &&isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['other_names']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['retype_password']) && isset($_POST['title'])){
		
		$username =  trim(strip_tags($_POST['username']));
		$first_name =  trim(strip_tags($_POST['first_name']));
		$last_name =  trim(strip_tags($_POST['last_name']));
		$other_names =  trim(strip_tags($_POST['other_names']));
		$email =  trim(strip_tags($_POST['email']));
		$password = trim(strip_tags($_POST['password']));
		$retype_password = trim(strip_tags($_POST['retype_password']));
		$title = trim(strip_tags($_POST['title']));
		
		if(!empty($username) && !empty($first_name) && !empty($last_name) &&!empty($email)){
			if($title != "none"){
				if($admin->checkDuplicateEmail($email) == false){
					if($admin->checkDuplicateUsername($username)== false){
						$uid = trim(strip_tags(substr(base64_encode(openssl_random_pseudo_bytes(32)),0,10)));
						if(!(strlen($username)<3) && !(strlen($username)>15)){
							if(preg_match('/^[a-zA-Z_0-9]*$/',$username)){
								if(!(strlen($first_name)<2) && !(strlen($first_name)>25)){
									if(preg_match('/^[a-zA-Z]*$/',$first_name)){
										if(!(strlen($last_name)<2) && !(strlen($last_name)>25)){	
											if(preg_match('/^[a-zA-Z]*$/',$last_name)){
												if(preg_match('/^[a-zA-Z]*$/',$other_names)){
													if(preg_match('/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i',$email)){
														
														
														if(strlen($password)>0){//if a password is provided
															if(!strlen($password)<12 || !strlen($password)>20){
																if($password === $retype_password){
																	$encrypt_pswd = password_hash($password, PASSWORD_BCRYPT);
																	
																	if(isset($_FILES['profile_pic'])){ // If a pic is being uploaded
																		$profile_pic_name=$_FILES['profile_pic']['name'];
																		$profile_pic_size=$_FILES['profile_pic']['size'];
																		$profile_pic_type=$_FILES['profile_pic']['type'];
								
																		if(($profile_pic_type=="image/jpeg") ||($profile_pic_type=="image/png")||($profile_pic_type=="image/gif")){
																			if(($profile_pic_size < 5242880)){

																				if (!file_exists('../data/admin_data/covers/'.$uid.'_covers'))
																					mkdir('../data/admin_data/covers/'.$uid.'_covers',0777, true);

																					move_uploaded_file($_FILES['profile_pic']['tmp_name'],'../data/admin_data/covers/'.$uid.'_covers/'.$profile_pic_name);
																					
																					//create admin
																					$admin->createAdmin($uid,$username,$first_name,$last_name,$other_names,$encrypt_pswd,$email,$uid.'_covers/'.$profile_pic_name,$title);
																					$response['success'] = "success";
																					
																			}else{
																				$response['error'] = "The profile picture must not be more than 5MB";
																			}
																		}else{
																			$response['error'] = "The profile picture image must be a jpeg/png/gif format";
																		}
																		
																		
																	}else{
																		//create admin
																		$admin->createAdmin($uid,$username,$first_name,$last_name,$other_names,$encrypt_pswd,$email,'assets/img/default_profile.png',$title);
																		$response['success'] = "success";
																	}
																	
																	
																	
																	
																}else{
																	$response['error'] = "The passwords you entered do not match";
																}
															}else{
																$response['error'] = "Your password must be between 12 and 20 characters";
															}
														}else{ //if password is not provided
															 
															 if(isset($_FILES['profile_pic'])){ // If a pic is being uploaded
																		$profile_pic_name=$_FILES['profile_pic']['name'];
																		$profile_pic_size=$_FILES['profile_pic']['size'];
																		$profile_pic_type=$_FILES['profile_pic']['type'];
								
																		if(($profile_pic_type=="image/jpeg") ||($profile_pic_type=="image/png")||($profile_pic_type=="image/gif")){
																			if(($profile_pic_size < 5242880)){

																				if (!file_exists('../data/admin_data/covers/'.$uid.'_covers'))
																					mkdir('../data/admin_data/covers/'.$uid.'_covers',0777, true);

																					move_uploaded_file($_FILES['profile_pic']['tmp_name'],'../data/admin_data/covers/'.$uid.'_covers/'.$profile_pic_name);
																					
																					$encrypt_pswd = password_hash("airsysadmin1", PASSWORD_BCRYPT);
																					
																					//create admin
																					$admin->createAdmin($uid,$username,$first_name,$last_name,$other_names,$encrypt_pswd,$email,$uid.'_covers/'.$profile_pic_name,$title);
																					$response['success'] = "success";
																					
																			}else{
																				$response['error'] = "The profile picture must not be more than 5MB";
																			}
																		}else{
																			$response['error'] = "The profile picture image must be a jpeg/png/gif format";
																		}
																		
																		
																	}else{
																		$encrypt_pswd = password_hash("airsysadmin1", PASSWORD_BCRYPT);
																		
																		//create admin
																		$admin->createAdmin($uid,$username,$first_name,$last_name,$other_names,$encrypt_pswd,$email,'assets/img/default_profile.png',$title);
																		$response['success'] = "success";
																	}
															 
															 
														}
														
														
													}else{
														$response['error'] = "The email address seems not to be valid";
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
								$response['error'] = "The username you entered contain some invalid characters";
							}
						}else{
							$response['error'] = "The username must be between 3 and 15 characters";
						}
					}else{
						$response['error'] = "This username already belongs to an existing administrator";
					}
				}else{
					$response['error'] = "This email already belongs to an existing administrator";
				}
			}else{
				$response['error'] = "Admin Privilege is required";
			}
			
		}else{
			$response['error'] = "Username, first name, last name, email and admin Privilege are required";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>