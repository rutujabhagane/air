<?php

require_once("dbconnection.class.php");

class Flowrate{
	protected $link;
	public function __construct(){
		$dbconnection = new dbconnection();
		$this->link = $dbconnection->connection();
	}
	//get info about moisture sensor
	public function get_FlowrateInfo(){
		try{
			$query= $this->link->query("SELECT * FROM flowrate_sensor");
			$row = $query->rowCount();
			if($row==0){
				return false;
			}else{
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}

		}catch(Exception $ex){
			return $ex->getMessage();		}


	}
	//info about particular sensor
	public function get_FlowrateInfo_ById($id){
		try {	
					
					$query = $this->link->query("SELECT * FROM flowrate_sensor WHERE id=$id");
					$row =  $query->rowCount();
					if($row == 0){
						return false;
					}else{
						return $query->fetchAll(PDO::FETCH_ASSOC);
					}
				}catch(Exception $ex) {
					return $ex->getMessage();
				}

	}
}

?>