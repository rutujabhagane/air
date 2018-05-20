<?php
require_once("dbconnection.class.php");

	class User{
		protected $link;
		public function __construct(){
		$dbconnection = new dbconnection();
		$this->link = $dbconnection->connection();
		}
		
		
		//Function to get user data in a particular table
		public function getUserData($uid){
			try {
				$query = $this->link->query("SELECT * FROM user WHERE uid = '$uid'");
				$row  = $query->rowCount();
				if($row){
					return $query->fetch(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}	
			}catch(Exception $ex) {
				$response['errorMessage'] = $ex->getMessage();
				return $response;
			}
		 }
		 
		 //Getting user account
		 public function getUser($uid){
			$response = array();
			if($this->getUserData($uid) != 0){
				$response['error'] = false;
				$response['statusCode']=200;
				$response['user'] = $this->getUserData($uid);
			}else{
				$response['error'] = true;
				$response['statusCode']=400;
				$response['errorMessage'] = "User information could not be fetched";
			}
			return $response;
		 }
		
		
		public function getUserLogin($phone){
			try {
				$query = $this->link->query("SELECT id,uid,phone,pin FROM user WHERE phone='$phone'");
				$row = $query->rowCount();
				if($row){
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}
			} catch(Exception $ex) {
				return $ex->getMessage();
			}	
		}
		
		public function login($phone,$pin){
			$response = array();
			if($this->getUserLogin($phone) != 0){
				foreach ($this->getUserLogin($phone) as $key ) {
					$id = $key['id'];
					$phone = $key['phone'];
					$uid = $key['uid'];
					$database_pin = $key['pin'];
				}
				if(password_verify($pin, $database_pin)) {
					$response['error'] = false;
					$response['statusCode']=200;
					$response['id'] = $id;
					$response['uid'] = $uid;
					$response['phone'] = $phone;
					$response['pin'] = $pin;
				}else{
					$response['error'] = true;
					$response['statusCode']=400;
				    $response['errorMessage'] = "Wrong pin entered";
				}
			}else{
				$response['phone'] = $phone;
				$response['error'] = true;
				$response['statusCode']=400;
				$response['errorMessage'] = "The phone number is not associated with any account";
			}
			return $response;
		}
}
?>