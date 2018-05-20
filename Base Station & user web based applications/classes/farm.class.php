<?php
	require_once('dbConnection.class.php');
	class Farm{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		/*Getting details of farms*/
		public function getFarms(){
			try {
				$query = $this->link->query("SELECT * FROM farm");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll();
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
				//return http_response_code();
			}	
		}
		
		/*Getting farms with region argurement*/
		public function getFarmsWithRegion($region){
			try {
				$query = $this->link->query("SELECT id FROM farm WHERE region = '$region'");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll();
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
				//return http_response_code();
			}	
		}
		
		/*Getting farms with crop argurement*/
		public function getFarmsWithCrop($crop){
			try {
				$query = $this->link->query("SELECT id FROM farm WHERE crop = '$crop'");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll();
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
				//return http_response_code();
			}	
		}
		
		/*Getting farms with region argurement*/
		public function getFarmsWithIrrigationType($irrigation_type){
			try {
				$query = $this->link->query("SELECT id FROM farm WHERE irrigation_type = '$irrigation_type'");
				$row =  $query->rowCount();
				if($row != 0){
					return $query->fetchAll();
				}else{
					return $row;
				}
			}catch(PDOException $ex) {
				return $ex->getMessage();
				//return http_response_code();
			}	
		}
		
		
		/*geting number of farms */
		public function getNumberOfFarms(){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `farm`");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*geting number of crop farms */
		public function getNumberOfFarmsCultivatingCrop($crop_type){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*),crop FROM `farm` WHERE crop='$crop_type'");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*geting number of irrigation type farms */
		public function getNumberOfFarmsIrrigationType($irrigation_type){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*),crop FROM `farm` WHERE irrigation_type='$irrigation_type'");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*geting number of irrigation type farms */
		public function getNumberOfFarmsSoilType($soil_type){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*),crop FROM `farm` WHERE soil_type='$soil_type'");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		
		//Geting details of admins via id
		public function getFarmDetails($id){
			try {
				$query = $this->link->query("SELECT * FROM `farm` WHERE id = '$id'");
				$row = $query->rowCount();
				if($row>0){
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}
			}catch(PDOException $ex){
				return $ex->getMessage();
			}
		}
		
		/*Creating farm profile*/
		public function createFarmProfile($farm_name,$crop,$size,$soil_type,$irrigation_type,$region,$town,$block_id){
			try {
				$query = $this->link->prepare("INSERT INTO farm(farm_name,crop,size,soil_type,irrigation_type,region,town,block_id) VALUES(?,?,?,?,?,?,?,?)");
				$values = array($farm_name,$crop,$size,$soil_type,$irrigation_type,$region,$town,$block_id);
				$query->execute($values);
				return $this->link->lastInsertId();
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		//Updating user details without cover
		public function updateFarmProfile($id,$farm_name,$crop,$size,$soil_type,$irrigation_type,$region,$town,$block_id){
			try {
				 $query = $this->link->prepare("UPDATE farm SET `farm_name`=:farm_name,`crop`=:crop,`size`=:size,`soil_type`=:soil_type,`irrigation_type`=:irrigation_type,`region`=:region,`town`=:town,`block_id`=:block_id WHERE id='$id'");
				$query->bindValue(":farm_name", $farm_name);
				$query->bindValue(":crop", $crop);
				$query->bindValue(":size", $size);
				$query->bindValue(":soil_type", $soil_type);
				$query->bindValue(":irrigation_type", $irrigation_type);
				$query->bindValue(":region", $region);
				$query->bindValue(":town", $town);
				$query->bindValue(":block_id", $block_id);
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
		
		/*getting all album covers*/
		public function getExistingFarmProfiles(){
				try {	
					$query = $this->link->query("SELECT id,farm_name,region,town,block_id FROM farm ORDER BY id DESC");
					$row = $query->rowCount();
					if($row>0){
						return $query->fetchAll();
					}else{
						return 0;
					}
				}catch(Exception $ex) {
					return $ex->getMessage();
				}
		}
		
		//Getting users farms
		public function getUserFarms($farm_id){
			try {
				$query = $this->link->query("SELECT * FROM farm WHERE id='$farm_id'");
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
		
		//Getting DISTINCT farms block_id
		public function getDISTINCTblockIds(){
			try {
				$query = $this->link->query("SELECT DISTINCT block_id FROM farm");
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
		
		//Getting farms belonging to block
		public function getFarmsOfBlockId($block_id){
			try {
				$query = $this->link->query("SELECT * FROM farm WHERE block_id='$block_id'");
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
		
		//farms search
		public function farms_search($search_query){
			try {
				$query = $this->link->query("SELECT * FROM farm WHERE farm_name ='$search_query' OR farm_name LIKE '%".$search_query."%' OR crop LIKE '%".$search_query."%' OR town LIKE '%".$search_query."%'");
				if($query->rowCount()){
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}
			} catch(PDOException $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Deleting farms's user_farm entry*/
		public function deleteFarm($farm_id){	
			try {	
				$query = $this->link->query("DELETE FROM farm WHERE `id`='$farm_id'");
				//return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
	}	
?>