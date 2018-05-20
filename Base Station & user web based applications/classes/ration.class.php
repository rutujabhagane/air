<?php
require_once('dbConnection.class.php');

class Ration 
{

	public $link;

	public function __construct()
	{
		$dbConnection = new dbConnection();
		$this->link = $dbConnection->connect();	
		return $this->link;
	}
	
	//fetch data for function
	public function fetchDataPerRow($table,$id){
		try{
			$query= $this->link->query("SELECT * FROM $table WHERE block_id=$id");
			$row=$query->rowCount();
			if($row!= 0){
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}
			return $query;
		}catch(Exception $ex){
			return $ex;
		}
	}

	public function fetchReference($table,$refkey){
		try{
			$query= $this->link->query("SELECT `number` FROM $table WHERE `type`='$refkey'");
			$row=$query->rowCount();
			if($row!= 0){
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}
			return $query;
		}catch(Exception $ex){
			return $ex;
		}
	}

	public function countNumberOfFarms(){
		try{
			$query= $this->link->query("SELECT COUNT(id) FROM `farm`");
			$row=$query->rowCount();
			if($row!= 0){
				return $query->fetch(PDO::FETCH_ASSOC);
			}
			return $query;
		}catch(Exception $ex){
			return $ex;
		}
	}

	public function calculate_weight($crop_type,$soil_type,$irrigation_type,$farm_size,$i){
	//$weight=[];
	//for ($i=1; $i <6 ; $i++ ){ 
		$weight=$farm_size*(pow(($i/10),$crop_type)+pow(($i/10),$soil_type)+pow(($i/10),$irrigation_type));
//	}
	return $weight;
		}

	public function transform_weights($weight,$numFarms,$times,$total_waterVolume,$maxWeight){
		$w8=($weight/($numFarms*$maxWeight*$times))*$total_waterVolume;
		return $w8;
		}

	public function find_maxWeight($maxBase,$crop_type,$soil_type,$irrigation_type,$farm_size){
		return $farm_size*(pow($maxBase,$crop_type)+pow($maxBase,$soil_type)+pow($maxBase,$irrigation_type));
		}


	public function runFxn($table,$id,$maxBase,$times,$total_waterVolume){
		$vol=array();
		$allWeights=array();;
		$farmRow=$this->fetchDataPerRow($table,$id);
		$farmID = array();
		foreach ($farmRow as $row) {
			$crop_type=$this->fetchReference('crop_reference',$row['crop']);
			
			$soil_type=$this->fetchReference('soil_reference',$row['soil_type']);
			
			$irrigation_type=$this->fetchReference('irrigation_reference',$row['irrigation_type']);
			
			$farm_size=$row['size'];
			$farm_id=$row['id'];

			$Weight=$this->calculate_weight((int)$crop_type,(int)$soil_type,(int)$irrigation_type,(int)$farm_size,$maxBase);
			array_push($allWeights, $Weight);
			array_push($farmID, $farm_id);
		}
		
		
		$maxWeight=$this->find_maxWeight($maxBase,(int)$crop_type,(int)$soil_type,(int)$irrigation_type,(int)$farm_size);
		$numFarms=$this->countNumberOfFarms()["COUNT(id)"];
		$theArray = array();
		for($i=0;$i<sizeof($allWeights);$i++){
			
			$vol[$i]=$this->transform_weights($allWeights[$i],$numFarms,$times,$total_waterVolume,$maxWeight);
			
			$object_readings = array('id'=>$farmID[$i],'vol'=>$vol[$i]);
			array_push($theArray, $object_readings);
			
		}
	
		return $theArray;
	}

	
	
	/*Post data to db*/
	public function postVol($farm_id,$vol){
			try {
				$query = $this->link->prepare("INSERT INTO water_need(farm_id,volume) VALUES(?,?)");
				$values = array($farm_id,$vol);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
	}
	
	
}
?>