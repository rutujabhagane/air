<?php
class dbConnection{
	protected $db_conn;
	private $db_host = "localhost";
	private $db_username = "root";
	private $db_password = "";
	private $db_name = "irr";

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