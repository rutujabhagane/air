<?php
	require_once('dbConnection.class.php');
	class WaterNeed{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		
		/*Getting sensor today readings*/
		public function getFarmWaterNeed($farm_id){
			try {
				$query = $this->link->query("SELECT * FROM water_need WHERE farm_id='$farm_id'");
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
	
	
	}	
?>