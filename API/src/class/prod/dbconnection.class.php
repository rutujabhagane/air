<?php
class dbConnection{
	protected $db_conn;
	private $db_host = "irr.airgh.com";
	private $db_username = "irrdbadmin";
	private $db_password = "airsysadmin";
	private $db_name = "irr_db";


	
	public function connection(){
		try{
			$this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name","$this->db_username","$this->db_password");
			return $this->db_conn;

		}catch(PDOException $ex)
		{
			$ex->getMessage();
		}
	}
}
?>