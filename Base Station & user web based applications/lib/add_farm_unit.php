<?php
	require_once('../classes/farm_unit.class.php');
	$response = array();
	$farm_unit = new Farm_Unit();
	
	header('Content-Type: application/json');
	if(isset($_POST['farm_unit_id']) && isset($_POST['farm_id'])){
		
		$farm_unit_id = trim(strip_tags($_POST['farm_unit_id']));
		$farm_id = trim(strip_tags($_POST['farm_id']));
		
		if(!empty($farm_unit_id)){
			
			if(preg_match('/^[0-9]*$/',$farm_unit_id)){
				if(strlen($farm_unit_id) == 5){
					if($farm_unit->checkIfUnitIfExist($farm_unit_id) == false){
						$farm_unit->add_farmUnit($farm_id,$farm_unit_id);
						$response['success'] = "success";					
					}else{
						$response['error'] = "The farm un";
					}								
				}else{
					$response['error'] = "A unit with this id already exist";
				}
			}else{
				$response['error'] = "Unit id should be numbers";
			}
			
		}else{
			$response['error'] = "Farm unit id required";
		}

	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>