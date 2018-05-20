<?php
	class dbConnection{
		private $db_host = "irr.airgh.com";
		private $db_username = "irrdbadmin";
		private $db_password = "airsysadmin";
		private $db_name = "irr_db";

		public function connect(){
			try {
				$this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name","$this->db_username","$this->db_password");
				//$this->db_Conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $this->db_conn;
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}
		}
	}
?>