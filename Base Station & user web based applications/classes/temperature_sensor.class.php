<?php
	require_once('dbConnection.class.php');
	class TemperatureSensor{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		/*Post data to db*/
		public function postTemperatureSensorData($farm_unit_id,$moisture_sensor_reading,$date){
			try {
				$query = $this->link->prepare("INSERT INTO temperature_sensor(unit_id,reading,date) VALUES(?,?,?)");
				$values = array($farm_unit_id,$moisture_sensor_reading,$date);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Getting sensor today readings*/
		public function getTodayReadings($unit_id){
			try {
				$query = $this->link->query("SELECT * FROM temperature_sensor WHERE unit_id='$unit_id' AND DATE(date) = CURDATE()");
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
				$query = $this->link->query("SELECT * FROM temperature_sensor WHERE unit_id='$unit_id' AND `date` >= DATE_SUB(CURDATE(), INTERVAL $number $interval)");
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
		
		public function getReadingsWithId($id){
			try {
				$query = $this->link->query("SELECT reading FROM temperature_sensor WHERE id='$id' ORDER BY id DESC");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetch();
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
				$query = $this->link->query("SELECT reading,date FROM temperature_sensor WHERE unit_id='$unit_id' ORDER BY id DESC LIMIT 1");
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