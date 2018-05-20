<?php
	header('Content-Type: application/json');
	$response = array();
	if(isset($_POST['data'])){
		$data = $_POST['data'];
		if(!empty($data['name']) && !empty($data['phone']) && !empty($data['region']) && !empty($data['town']) && !empty($data['service'])){
			$name = trim(strip_tags($data['name']));
			$phone = trim(strip_tags($data['phone']));
			$region = trim(strip_tags($data['region']));
			$town = trim(strip_tags($data['town']));
			$service = trim(strip_tags($data['service']));
			
			if(!(strlen($name)<2) && !(strlen($name)>50)){
				if(preg_match('/^[a-zA-Z ]*$/',$name)){
					if(preg_match('/^[0-9]*$/',$phone)){
						if(!(strlen($phone)<10) && !(strlen($phone)>12)){
							if(preg_match('/^[a-zA-Z ]*$/',$region)){
								if(preg_match('/^[a-zA-Z ]*$/',$town)){
									
									if($service == "whole_implementation"){
										$service = "Need whole sysetem implemented on my farm";
									}else if($service == "rationing_algorithm"){
										$service = "Need rationing algorithm";
									}
									
									$message = "
										Name:$name</br>
										Phone:$phone</br>
										Region:$region</br>
										Town:$town</br>
										Service:$service
									";
									mail('request@airsys.com', "Quote Request", $message);
									$response['success'] = 'success';
								}else{
									$response['error'] = "Town field contains some invalid characters";
								}
							}else{
								$response['error'] = "Region field contains some invalid characters";
							}
						}else{
							$response['error'] = "Phone number should be at most 12 numbers and not less than 10 numbers";
						}
					}else{
						$response['error'] = "Invalid phone number entered";
					}
				}else{
					$response['error'] = "The name contains some invalid characters";
				}
			}else{
				$response['error'] = "The name must be between 2 and 50 characters";
			}
			
		}else{
			$response['error'] = "All fields are required";
		}
	}else{
		$response['error'] = "An error occured, please try again!!";
	}
	echo json_encode($response);
?>