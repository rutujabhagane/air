<?php
	require_once('../classes/ration.class.php');
	require_once('../classes/farm.class.php');
	$response = array();
	$ration = new Ration();
	$farm = new Farm();
	
	header('Content-Type: application/json');
	if(isset($_POST['water_volume']) && isset($_POST['times']) && isset($_POST['block_id'])){
		
		$water_volume = trim(strip_tags($_POST['water_volume']));
		$times = trim(strip_tags($_POST['times']));
		$block_id = trim(strip_tags($_POST['block_id']));
		$theArray = array();
		$text = "";
		
		if($block_id != 'none'){
			if(!empty($water_volume) && !empty($times)){

				foreach($ration->runFxn('farm',$block_id,0.5,$times,$water_volume) as $fetched){
					$id = $fetched['id'];
					$vol = $fetched['vol'];
					$ration->postVol($id,$vol);
					$object_readings = array('farm_id'=>$id,'vol'=>$vol);
					array_push($theArray, $object_readings);
				}
				$response['returned'] = $theArray;
				
				
				
				
				/**/
				$text .="
					<table class='table table-bordered  table-condensed' style='margin-top:1em;'>
								<thead>
		                          <tr>
		                              <th>Farm id</th>
									  <th>Farm name</th>
									  <th>Volume of water (litres)</th>
		                          </tr>
		                        </thead>
								<tbody>
				";		
					foreach($theArray as $ar){
					$farm_id = $ar['farm_id'];
					$volume = $ar['vol'];
					foreach($farm->getUserFarms($farm_id) as $details){
						$farm_name = $details['farm_name'];
					}
						$text .="
									<tr>
									  <td>$farm_id</td>
									  <td>$farm_name</td>
									  <td>$volume</td>
									</tr>
						";
					}
				$text .="
								</tbody>
					</table>
				";
				
				$response['response_text'] = $text;
				$response['success'] = "success";
				
			}else{
				$response['error'] = "Water volume and times fields are required";
			}
		}else{
			$response['error'] = "Select a block to run algorithm on";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>