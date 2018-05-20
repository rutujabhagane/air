<?php
	require_once('dbConnection.class.php');
	class Farm_Unit{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		/*Post data to db*/
		public function add_farmUnit($farm_id,$farm_unit_id){
			try {
				$query = $this->link->prepare("INSERT INTO farm_unit (farm_id,unit_id) VALUES(?,?)");
				$values = array($farm_id,$farm_unit_id);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*For checking if unit id already belongs to another farm profile*/
		public function checkIfUnitIfExist($unit_id){	
			try {	
				$query = $this->link->query("SELECT * FROM farm_unit WHERE unit_id = '$unit_id'");
				$row =  $query->rowCount();
				if($row == 0){
					return false;
				}else{
					return true;
				}
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
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
		
		/*Getting last unit of a particular farm*/
		public function getLastFarmsUnits($farm_id){
			try {
				$query = $this->link->query("SELECT * FROM farm_unit WHERE farm_id='$farm_id' ORDER BY id DESC LIMIT 1");
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
		
		/*Getting number of a particular farm*/
		public function getFarmsUnitsNumber($farm_id){
			try {
				$query = $this->link->query("SELECT * FROM farm_unit WHERE farm_id='$farm_id'");
				return $query->rowCount();
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}	
		}
		
		/*Getting number of a particular farm*/
		public function getFarmsUnitFarmId($unit_id){
			try {
				$query = $this->link->query("SELECT farm_id FROM farm_unit WHERE unit_id='$unit_id'");
				return $query->rowCount();
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}	
		}
		
		
		
		/*geting number of farm units */
		public function getNumberOfFarmsUnits(){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `farm_unit`");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		public function getNumberOfUsers(){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `user`");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Getting units of a particular farm*/
		public function getFarmsUnitDetails($id){
			try {
				$query = $this->link->query("SELECT * FROM farm_unit WHERE id='$id'");
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
		
		
		public function UpdateFarmUnit($id,$unit_id){
			try {
				$query = $this->link->prepare("UPDATE farm_unit SET `unit_id`=:unit_id WHERE id='$id'");
				$query->bindValue(":unit_id", $unit_id);
				$query->execute();
				$row = $query->rowcount();
				if($row){
					return true;
				}else{
					return false;
				}	
			}catch(Exception $e) {
				return $ex->getMessage();	
			}
		}
		
		/*Delete user's farm */
		public function deleteFarmUnit($id){	
			try {	
				$query = $this->link->query("DELETE FROM farm_unit WHERE id='$id'");
				//return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Deleting farms's user_farm entry*/
		public function deleteAllFarmUnits($farm_id){	
			try {	
				$query = $this->link->query("DELETE FROM farm_unit WHERE `farm_id`='$farm_id'");
				//return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
	
	}	
?>