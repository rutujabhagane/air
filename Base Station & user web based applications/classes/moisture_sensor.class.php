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
		
		
		/*Getting sensor today readings*/
		public function getAllMoistureReadings(){
			try {
				$query = $this->link->query("SELECT * FROM moisture_sensor ORDER BY id DESC");
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
		public function getTodayReadings($unit_id){
			try {
				$query = $this->link->query("SELECT * FROM moisture_sensor WHERE unit_id='$unit_id' AND DATE(date) = CURDATE()");
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
		public function getReadingsWithInterval($unit_id,$number,$interval){
			try {
				$query = $this->link->query("SELECT * FROM moisture_sensor WHERE unit_id='$unit_id' AND `date` >= DATE_SUB(CURDATE(), INTERVAL $number $interval)");
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
		public function getTodayMoistureTemperatureReadings($unit_id){
			try {
				$query = $this->link->query("SELECT moisture_sensor.reading AS moisture_readings, moisture_sensor.date , temperature_sensor.reading AS temperature_readings FROM moisture_sensor, temperature_sensor WHERE moisture_sensor.unit_id = temperature_sensor.unit_id AND moisture_sensor.unit_id='$unit_id' AND DATE(moisture_sensor.date) = CURDATE()");
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
		public function getMoistureTemperatureWithInterval($unit_id,$number,$interval){
			try {
				$query = $this->link->query("SELECT moisture_sensor.reading AS moisture_readings, moisture_sensor.date , temperature_sensor.reading AS temperature_readings FROM moisture_sensor, temperature_sensor WHERE moisture_sensor.unit_id = temperature_sensor.unit_id AND moisture_sensor.unit_id='$unit_id' AND moisture_sensor.date >= DATE_SUB(CURDATE(), INTERVAL $number $interval)");
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
		
		/*USER*/
		
		/*Getting sensor today readings*/
		public function getReadings($unit_id){
			try {
				$query = $this->link->query("SELECT reading,date FROM moisture_sensor WHERE unit_id='$unit_id' ORDER BY id DESC LIMIT 1");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetch(PDO::FETCH_ASSOC);
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}	
		}
	
	
		
		
	
	}	
?>