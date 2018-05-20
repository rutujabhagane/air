<?php
	require_once('dbConnection.class.php');
	class MoistureSensor{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		/*Post data to db*/
		public function postMoistureSensorData($farm_unit_id,$moisture_sensor_reading,$date){
			try {
				$query = $this->link->prepare("INSERT INTO moisture_sensor(unit_id,reading,date) VALUES(?,?,?)");
				$values = array($farm_unit_id,$moisture_sensor_reading,$date);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
	
	}	
?>