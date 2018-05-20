<?php
	require_once('dbConnection.class.php');
	class System{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		
		
		/*Getting space occupied database */
		public function getUsedDatabaseSizeOverall(){
			try {
				$query = $this->link->query("SELECT TABLE_SCHEMA AS `DATABASE NAME`, ROUND(SUM((DATA_LENGTH + INDEX_LENGTH)/ 1024 / 1024),2) AS `SIZE` FROM information_schema.TABLES WHERE TABLE_SCHEMA='irr'");
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
		
		public function getUsedDatabaseSize(){
			try {
				$query = $this->link->query("SELECT  TABLE_NAME AS `Table`, ROUND(((DATA_LENGTH + INDEX_LENGTH)/ 1024 / 1024),2) AS `SIZE` FROM information_schema.TABLES WHERE TABLE_SCHEMA='irr' ORDER BY (DATA_LENGTH + INDEX_LENGTH) DESC");
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