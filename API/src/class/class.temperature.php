<?php
require_once("dbconnection.class.php");

class Temperature{
	protected $link;
	public function __construct(){
		$dbconnection = new dbconnection();
		$this->link = $dbconnection->connection();
	}
	


	/*Getting units of a particular farm*/
		public function getFarmsUnits($farm_id){
			try {
				$query = $this->link->query("SELECT * FROM farm_unit WHERE farm_id='$farm_id'");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll();
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}	
		}
		
		/*Getting sensor today readings*/
		public function getReadings($unit_id){
			try {
				$query = $this->link->query("SELECT reading FROM temperature_sensor WHERE unit_id='$unit_id' ORDER BY id DESC LIMIT 1");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}	
		}
		
		public function getCurrentTemperatureReadins($farm_id){
			$response = array();
			if($this->getFarmsUnits($farm_id) != 0){
				foreach ($this->getFarmsUnits($farm_id) as $unit_details) {
					$farm_unit_id = $unit_details['unit_id'];
					$response['readings'] = $this->getReadings($farm_unit_id);
				}
				$response['error'] = false;
				$response['statusCode']=200;
			
			}else{
				$response['error'] = true;
				$response['statusCode']=200;
				$response['readings'] = "No farm units";
			}
			return $response;
		}




}
?>