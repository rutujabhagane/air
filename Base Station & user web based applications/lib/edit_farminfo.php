<?php
	require_once('../classes/farm.class.php');
	$response = array();
	$farm = new Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['id']) && isset($_POST['farm_name']) && isset($_POST['crop']) && isset($_POST['size']) && isset($_POST['soil_type']) && isset($_POST['irrigation_type']) && isset($_POST['farm_region']) && isset($_POST['farm_town']) && isset($_POST['block_id'])){
		
		$id = trim(strip_tags($_POST['id']));
		
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
											
											//Updating details
											$farm->updateFarmProfile($id,$farm_name,$crop,$size,$soil_type,$irrigation_type,$farm_region,$farm_town,$block_id);
											
											$response['success'] = "success";
											$response['id'] = $id;
											$response['size'] = $size;
											
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

	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>