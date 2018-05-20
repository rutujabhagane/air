<?php
require_once("dbconnection.class.php");

	class Farms{
		protected $link;
		public function __construct(){
		$dbconnection = new dbconnection();
		$this->link = $dbconnection->connection();
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
		
		
		//Getting users farms
		public function getUserFarms($farm_id){
			try {
				$query = $this->link->query("SELECT * FROM farm WHERE id='$farm_id'");
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
		
		
		public function getUserAssociatedFarms($user_uid){
			//$response = array();
			$response['farms'] = [];
			if($this->getUserFarmsId($user_uid) != 0){
				foreach ($this->getUserFarmsId($user_uid) as $user_farm_details) {
					$farm_id = $user_farm_details['farm_id'];
					array_push($response['farms'],$this->getUserFarms($farm_id));
				}
				$response['error'] = false;
				$response['statusCode']=200;
			
			}else{
				$response['error'] = true;
				$response['statusCode']=400;
				$response['errorMessage'] = "No farms are associated with user";
			}
			return $response;
		}
		
		
}
?>