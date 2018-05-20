<?php
	require_once('dbConnection.class.php');
	class User_Farm{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		/*Adding farm_user details*/
		public function addUserFarm($user_id,$farm_id){
			try {
				$query = $this->link->prepare("INSERT INTO user_farm(user_id,farm_id) VALUES(?,?)");
				$values = array($user_id,$farm_id);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Getting farms from user_farm to retrive ones belonging to user*/
		public function getUserFarmsId($user_uid){
			try {
				$query = $this->link->query("SELECT * FROM user_farm WHERE user_id='$user_uid'");
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
		
		
		/*Delete user's farm */
		public function deleteUserFarm($user_id,$farm_id){	
			try {	
				$query = $this->link->query("DELETE FROM user_farm WHERE user_id='$user_id' AND farm_id='$farm_id'");
				return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		

		/*geting number of user farms */
		public function getNumberOfUserFarms($user_id){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `user_farm` WHERE user_id = '$user_id'");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Deleting user's user_farm entry*/
		public function deleteAllUserEntries($user_id){	
			try {	
				$query = $this->link->query("DELETE FROM user_farm WHERE `user_id`='$user_id'");
				//return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Deleting farms's user_farm entry*/
		public function deleteAllFarmEntries($farm_id){	
			try {	
				$query = $this->link->query("DELETE FROM user_farm WHERE `farm_id`='$farm_id'");
				//return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*geting users(id's) associated with a particular farm*/
		public function getUserOfFarm($farm_id){	
			try {	
				$query = $this->link->query("SELECT * FROM `user_farm` WHERE farm_id = '$farm_id'");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll();
				}else{
					return 0;
				}
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*cheking duplicate entry*/
		public function checkDuplicateEntry($farm_id,$user_id){	
			try {	
				$query = $this->link->query("SELECT * FROM user_farm WHERE farm_id = '$farm_id' AND user_id='$user_id'");
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
	}	
?>