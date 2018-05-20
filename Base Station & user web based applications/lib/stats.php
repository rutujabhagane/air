<?php
	require_once('../classes/farm_unit.class.php');
	require_once('../classes/moisture_sensor.class.php');
	require_once('../classes/temperature_sensor.class.php');
	$response = array();
	$farm_unit = new Farm_Unit();
	$moisture_sensor = new MoistureSensor();
	$temperature_sensor = new TemperatureSensor();
	header('Content-Type: application/json');
	if(isset($_POST['duration']) && isset($_POST['farm_id'])){
		$duration =  trim(strip_tags($_POST['duration']));
		$farm_id =  trim(strip_tags($_POST['farm_id']));
		
		$response['moisture_sensor_single'] = [];
		$response['temperature_sensor_single'] = [];
		$response['moisturetemperature_sensor_double'] = [];
		$newArray = array(); // for moisture sensor
		$newArray2 = array(); // for temperaure sensor
		$newArray3 = array(); // for moisture temperaure sensor
		
		$number_of_m_readings = 1;
		$number_of_s_readings = 1;
		$number_of_sm_readings = 1;
		
		if(!empty($duration) && !empty($farm_id)){
			
			//function for selecting date format for the data to be posted to UI
			function selectDateFormat($duration,$date_time){
						switch($duration){
							case "today":
								$datetime = new DateTime($date_time);
								return $datetime->format('Y-m-d H:i:s');
								break;
							case "week":
								$datetime = new DateTime($date_time);
								return $datetime->format('D');
								break;
							case "monthly":
								$datetime = new DateTime($date_time);
								return $datetime->format('M');
								break;
							case "yearly":
								$datetime = new DateTime($date_time);
								return $datetime->format('Y');
								break;
						}
			}
			
			foreach($farm_unit->getFarmsUnits($farm_id) as $unit_details){	
				$farm_unit_id = $unit_details['unit_id']; //getting farm units for particular farm 
				//selecting the the data to be fetched depending on the duration
				switch($duration){
					case "today":
						$moisture_readings_db = $moisture_sensor->getTodayReadings($farm_unit_id);
						$temperature_readings_db = $temperature_sensor->getTodayReadings($farm_unit_id);
						$moisturetemperature_readings_db = $moisture_sensor->getTodayMoistureTemperatureReadings($farm_unit_id);
						break;
					case "week":
						$moisture_readings_db = $moisture_sensor->getReadingsWithInterval($farm_unit_id,7,"DAY"); //Last 7 days
						$temperature_readings_db = $temperature_sensor->getReadingsWithInterval($farm_unit_id,7,"DAY"); //Last 7 days
						$moisturetemperature_readings_db = $moisture_sensor->getMoistureTemperatureWithInterval($farm_unit_id,7,"DAY");
						break;
					case "monthly":
						$moisture_readings_db = $moisture_sensor->getReadingsWithInterval($farm_unit_id,30,"DAY"); //Last 30 days
						$temperature_readings_db = $temperature_sensor->getReadingsWithInterval($farm_unit_id,30,"DAY"); //Last 7 days
						$moisturetemperature_readings_db = $moisture_sensor->getMoistureTemperatureWithInterval($farm_unit_id,30,"DAY");
						break;
					case "yearly":
						$moisture_readings_db = $moisture_sensor->getReadingsWithInterval($farm_unit_id,1,"YEAR"); //Last 1 year
						$temperature_readings_db = $temperature_sensor->getReadingsWithInterval($farm_unit_id,1,"YEAR"); //Last 7 days
						$moisturetemperature_readings_db = $moisture_sensor->getMoistureTemperatureWithInterval($farm_unit_id,1,"YEAR");
						break;
				}
				
					//for graph for moisture sensor alone
					if($moisture_readings_db != 0){
						foreach($moisture_readings_db as $reading_details){
							$date_time = $reading_details['date'];
							$reading = $reading_details['reading'];
							
							//$response['moisture_sensor_single'] = [];
							//$response['temperature_sensor_single'] = [];
							//$response['moisturetemperature_sensor_double'] = [];
							
							
							if($duration == "today"){
								$date_time_formatted = selectDateFormat($duration,$date_time);
								$object_readings = (object)array('y' => $date_time_formatted, 'a' => $reading);
								array_push($response['moisture_sensor_single'], $object_readings);
								//var_dump ($response['moisture_sensor_single']);
							}else{
								$thedate = new DateTime($date_time);
								
								
								switch($duration){
									case "monthly":
										$dateKey = $thedate->format('m');
									break;
									case "yearly":
										$dateKey = $thedate->format('Y');
									break;
									default:
										$dateKey = $thedate->format('Y-m-d');;
								}
								if(array_key_exists($dateKey, $newArray)){
									// If we've already added this date to the new array, add the value
									$newArray[$dateKey]['value'] += $reading;
									$number_of_m_readings++;
								}
								else{
									// Otherwise create a new element with datetimeobject as key
									$newArray[$dateKey]['date'] = $date_time;
									$newArray[$dateKey]['value'] = $reading;
								}
							}
							
						}
						
					}else{
						//$response['moisture_sensor_single'] = 0;
					}
					
					//for graph for temperature sensor alone
					if( $temperature_readings_db != 0){
						foreach($temperature_readings_db as $reading_details){
							$date_time = $reading_details['date'];
							$reading = $reading_details['reading'];
							
							
							if($duration == "today"){
								$date_time_formatted = selectDateFormat($duration,$date_time);
								$object_readings = (object)array('y' => $date_time_formatted, 'a' => $reading);
								array_push($response['temperature_sensor_single'], $object_readings);
							}else{
								$thedate = new DateTime($date_time);
								
								switch($duration){
									case "monthly":
										$dateKey = $thedate->format('m');
									break;
									case "yearly":
										$dateKey = $thedate->format('Y');
									break;
									default:
										$dateKey = $thedate->format('Y-m-d');;
								}
								
								if(array_key_exists($dateKey, $newArray2)){
									// If we've already added this date to the new array, add the value
									$newArray2[$dateKey]['value'] += $reading;
									$number_of_s_readings++;
								}
								else{
									// Otherwise create a new element with datetimeobject as key
									$newArray2[$dateKey]['date'] = $date_time;
									$newArray2[$dateKey]['value'] = $reading;
								}
								
							}
							
						}
					}else{
						//$response['temperature_sensor_single'] = 0;
					}
					
					//for graph for temperature & moisture sensor combined
					if( $moisturetemperature_readings_db != 0){
						foreach($moisturetemperature_readings_db as $reading_details){
							$date_time = $reading_details['date'];
							$moisture_readings = $reading_details['moisture_readings'];
							$temperature_readings = $reading_details['temperature_readings'];
							
							
							
							if($duration == "today"){
								$date_time_formatted = selectDateFormat($duration,$date_time);
								$object_readings = (object)array('y' => $date_time_formatted, 'a' => $moisture_readings, 'b' => $temperature_readings);
								array_push($response['moisturetemperature_sensor_double'], $object_readings);
							}else{
								$thedate = new DateTime($date_time);
								
								switch($duration){
									case "monthly":
										$dateKey = $thedate->format('m');
									break;
									case "yearly":
										$dateKey = $thedate->format('Y');
									break;
									default:
										$dateKey = $thedate->format('Y-m-d');;
								}
								
								if(array_key_exists($dateKey, $newArray3)){
									// If we've already added this date to the new array, add the value
									$newArray3[$dateKey]['moisture_value'] += $moisture_readings;
									$newArray3[$dateKey]['temperature_value'] += $temperature_readings;
									$number_of_sm_readings++;
								}
								else{
									// Otherwise create a new element with datetimeobject as key
									$newArray3[$dateKey]['date'] = $date_time;
									$newArray3[$dateKey]['moisture_value'] = $moisture_readings;
									$newArray3[$dateKey]['temperature_value'] = $temperature_readings;
								}
								
							}
							
							
							
							
							
							
						}
					}else{
						//$response['moisturetemperature_sensor_double'] = 0;
					}
					

					
				}
				
				//Used when duration is not for today(CURRENT DATE)
				if($duration != "today"){
					
					$response['moisture_sensor_single'] = [];
					$response['temperature_sensor_single'] = [];
					$response['moisturetemperature_sensor_double'] = [];
					
							foreach ($newArray as $details){
								//var_dump($value);
								$reading = $details['value']/$number_of_m_readings;
								$date_time_formatted = selectDateFormat($duration,$details['date']);
								$object_readings = (object)array('y' => $date_time_formatted, 'a' => $reading);
								array_push($response['moisture_sensor_single'], $object_readings);
							}
							
							
							foreach ($newArray2 as $details){
								//var_dump($value);
								$reading = $details['value']/$number_of_s_readings;
								$date_time_formatted = selectDateFormat($duration,$details['date']);
								$object_readings = (object)array('y' => $date_time_formatted, 'a' => $reading);
								array_push($response['temperature_sensor_single'], $object_readings);
							}
							
							foreach ($newArray3 as $details){
								//var_dump($value);
								$moisture_readings = $details['moisture_value']/$number_of_sm_readings;
								$temperature_readings = $details['temperature_value']/$number_of_sm_readings;
								$date_time_formatted = selectDateFormat($duration,$details['date']);
								
								$object_readings = (object)array('y' => $date_time_formatted, 'a' => $moisture_readings, 'b' => $temperature_readings);
								
								array_push($response['moisturetemperature_sensor_double'], $object_readings);
							}
							
							
								
				}
				
		}else{
			$response['error'] = "An unexpected error just occured";
		}
	}else{
		$response['error'] = "An error occured, please try again";
	}
	
	echo json_encode($response);		
?>