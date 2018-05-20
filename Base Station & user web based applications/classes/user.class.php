<?php
	require_once('dbConnection.class.php');
	class User{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		
		/*Getting details of Users*/
		public function getUsers(){
			try {
				$query = $this->link->query("SELECT * FROM user");
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
		
		
		//Geting details of admins via id
		public function getUserDetails($id){
			try {
				$query = $this->link->query("SELECT * FROM `user` WHERE id = '$id'");
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
		
		
		/*For checking if username already belongs to another admin*/
		public function checkDuplicatePhone($phone){	
			try {	
				$query = $this->link->query("SELECT * FROM user WHERE phone = '$phone'");
				$row =  $query->rowCount();
				if($row == 0){
					return false;
				}else{
					return true;
				}
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		//Geting details of admins via id
		public function getUserDetailsWithUid($uid){
			try {
				$query = $this->link->query("SELECT * FROM `user` WHERE uid = '$uid'");
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
		
		/*Deleting user*/
		public function deleteUser($uid){	
			try {	
				$query = $this->link->query("DELETE FROM user where `uid`='$uid'");
				return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		
		//Updating user details with cover
		public function updateUserInformationWithCover($uid,$first_name,$last_name,$other_names,$phone,$profile_pic,$region,$town){
	 	try {
	  		 $query = $this->link->prepare("UPDATE user SET `firstname`=:first_name,`lastname`=:last_name,`othernames`=:other_names,`phone`=:phone,`profile_pic`=:profile_pic,`region`=:region, `town`=:town WHERE uid='$uid'");
            $query->bindValue(":first_name", $first_name);
            $query->bindValue(":last_name", $last_name);
            $query->bindValue(":other_names", $other_names);
            $query->bindValue(":phone", $phone);
			$query->bindValue(":profile_pic", $profile_pic);
			$query->bindValue(":region", $region);
			$query->bindValue(":town", $town);
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
		
		//Updating user details without cover
		public function updateUserInformation($uid,$first_name,$last_name,$other_names,$phone,$region,$town){
			try {
				 $query = $this->link->prepare("UPDATE user SET `firstname`=:first_name,`lastname`=:last_name,`othernames`=:other_names,`phone`=:phone,`region`=:region, `town`=:town WHERE uid='$uid'");
				$query->bindValue(":first_name", $first_name);
				$query->bindValue(":last_name", $last_name);
				$query->bindValue(":other_names", $other_names);
				$query->bindValue(":phone", $phone);
				$query->bindValue(":region", $region);
				$query->bindValue(":town", $town);
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
		
		//Updating admin privilege
		public function updateUserPin($uid,$pin){
			try {
				$query = $this->link->prepare("UPDATE user SET `pin`=:pin WHERE uid='$uid'");
				$query->bindValue(":pin", $pin);
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
		
		/*Creating user*/
		public function createUser($uid,$first_name,$last_name,$other_names,$phone,$pin,$profile_pic,$region,$town){
			try {
				$query = $this->link->prepare("INSERT INTO user(uid,firstname,lastname,othernames,phone,pin,profile_pic,region,town) VALUES(?,?,?,?,?,?,?,?,?)");
				$values = array($uid,$first_name,$last_name,$other_names,$phone,$pin,$profile_pic,$region,$town);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		//farmers search
		public function farmers_search($search_query){
			try {
				$query = $this->link->query("SELECT * FROM user WHERE firstname ='$search_query' OR firstname LIKE '%".$search_query."%' OR lastname LIKE '%".$search_query."%' OR othernames LIKE '%".$search_query."%'");
				if($query->rowCount()){
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}
			} catch(PDOException $ex) {
				return $ex->getMessage();
			}
		}
		
		/*geting number of user */
		public function getNumberOfUsers(){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `user`");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		
		/********* USER FUNCTIONALITIES **********/
		
		//Loging user in 
		public function getUserLogin($phone){
			try {
				$query = $this->link->query("SELECT uid,pin FROM user WHERE phone = '$phone'");
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
	}	
?>