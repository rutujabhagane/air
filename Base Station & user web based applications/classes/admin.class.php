<?php
	require_once('dbConnection.class.php');
	class Admin{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		//Loging user in 
		public function getUserLogin($username){
			try {
				$query = $this->link->query("SELECT uid,password FROM admin WHERE username = '$username'");
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
		
		/*geting number of admin */
		public function getNumberOfAdmin(){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `admin`");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*For checking if email already belongs to another admin*/
		public function checkDuplicateEmail($email){	
			try {	
				$query = $this->link->query("SELECT * FROM admin WHERE email = '$email'");
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
		
		/*For checking if email already belongs to another admin When updating details*/
		public function checkDuplicateEmailUpdating($email,$uid){	
			try {	
				$query = $this->link->query("SELECT * FROM admin WHERE email = '$email' AND uid!='$uid'");
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
		
		/*For checking if username already belongs to another admin*/
		public function checkDuplicateUsername($username){	
			try {	
				$query = $this->link->query("SELECT * FROM admin WHERE username = '$username'");
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
		
		/*For checking if username already belongs to another admin when updating details*/
		public function checkDuplicateUsernameUpdating($username,$uid){	
			try {	
				$query = $this->link->query("SELECT * FROM admin WHERE username = '$username' AND uid!='$uid'");
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
		
		/*Registering admin*/
		public function createAdmin($uid,$username,$first_name,$last_name,$other_names,$password,$email,$profile_pic,$title){
			try {
				$query = $this->link->prepare("INSERT INTO admin(uid,username,firstname,lastname,othernames,password,email,profile_pic,title) VALUES(?,?,?,?,?,?,?,?,?)");
				$values = array($uid,$username,$first_name,$last_name,$other_names,$password,$email,$profile_pic,$title);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Getting details of other admins administrators*/
		public function getAdmins($uid){
			try {
				$query = $this->link->query("SELECT * FROM admin WHERE uid!='$uid'");
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
		
		/*Getting currently logged in admin*/
		public function getLoggedInAdmin($uid){
			try {
				$query = $this->link->query("SELECT * FROM admin WHERE uid='$uid'");
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
		public function getAdminDetails($id){
			try {
				$query = $this->link->query("SELECT * FROM `admin` WHERE id = '$id'");
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
		
		
		//Updating admin details with cover
		public function updateAdminInformationWithCover($uid,$username,$first_name,$last_name,$other_names,$email,$profile_pic){
	 	try {
	  		 $query = $this->link->prepare("UPDATE admin SET `username`=:username,`firstname`=:first_name,`lastname`=:last_name,`othernames`=:other_names,`email`=:email,`profile_pic`=:profile_pic WHERE uid='$uid'");
            $query->bindValue(":username", $username);
            $query->bindValue(":first_name", $first_name);
            $query->bindValue(":last_name", $last_name);
            $query->bindValue(":other_names", $other_names);
            $query->bindValue(":email", $email);
			$query->bindValue(":profile_pic", $profile_pic);
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
		
	//Updating admin details without cover
	public function updateAdminInformation($uid,$username,$first_name,$last_name,$other_names,$email){
	 	try {
	  		 $query = $this->link->prepare("UPDATE admin SET `username`=:username,`firstname`=:first_name,`lastname`=:last_name,`othernames`=:other_names,`email`=:email WHERE uid='$uid'");
            $query->bindValue(":username", $username);
            $query->bindValue(":first_name", $first_name);
            $query->bindValue(":last_name", $last_name);
            $query->bindValue(":other_names", $other_names);
            $query->bindValue(":email", $email);
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
	public function updateAdminPrivilege($uid,$title){
	 	try {
	  		$query = $this->link->prepare("UPDATE admin SET `title`=:title WHERE uid='$uid'");
            $query->bindValue(":title", $title);
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
	public function updateAdminPassword($uid,$password){
	 	try {
	  		$query = $this->link->prepare("UPDATE admin SET `password`=:password WHERE uid='$uid'");
            $query->bindValue(":password", $password);
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
	
	/*Deleting admin*/
	public function deleteAdmin($uid){	
		try {	
			$query = $this->link->query("DELETE FROM admin where `uid`='$uid'");
			return $query->fetchAll();
		}catch(Exception $ex) {
			return $ex->getMessage();
		}
	}
		
	}	
?>