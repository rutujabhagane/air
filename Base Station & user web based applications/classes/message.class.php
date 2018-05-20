<?php
	require_once('dbConnection.class.php');
	class Message{
		public $link;
		
		public function __construct(){
			$dbConnection = new dbConnection();
			$this->link = $dbConnection->connect();	
			return $this->link;
		}
		
		
		/*Adding message*/
		public function addMessage($uid,$subject,$message,$date,$user_read){
			try {
				$query = $this->link->prepare("INSERT INTO message(user_id,subject,message,date,user_read) VALUES(?,?,?,?,?)");
				$values = array($uid,$subject,$message,$date,$user_read);
				$query->execute($values);
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Retrieving message for a particular user, last 4*/
		public function getUserUnreadMessagesTop($user_id){
			try {
				$query = $this->link->query("SELECT * FROM `message` WHERE user_id = '$user_id' AND user_read='0' ORDER BY id DESC LIMIT 4");
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
		
		/*Retrieving unread messages for a particular user,all*/
		public function getAllUserUnreadMessages($user_id){
			try {
				$query = $this->link->query("SELECT * FROM `message` WHERE user_id = '$user_id' AND user_read='0' ORDER BY id DESC");
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
		
		
		/*Retrieving read messages for a particular user,all*/
		public function getAllUserReadMessages($user_id){
			try {
				$query = $this->link->query("SELECT * FROM `message` WHERE user_id = '$user_id' AND user_read='1' ORDER BY id DESC");
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
		
		
		/*Retrieving unread messages for a particular user,all*/
		public function getMessaage($msg_id){
			try {
				$query = $this->link->query("SELECT * FROM `message` WHERE id = '$msg_id'");
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
		
		/*geting number of unread messages for a particular user */
		public function getNumberOfUserUnreadMessages($user_id){	
			try {	
				$query = $this->link->query("SELECT  COUNT(*) FROM `message` WHERE user_id = '$user_id' AND user_read='0'");
				return $query->fetch(PDO::FETCH_ASSOC);
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		/*Deleting message */
		public function deleteMessage($msg_id){	
			try {	
				$query = $this->link->query("DELETE FROM message where `id`='$msg_id'");
				return $query->fetchAll();
			}catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
		
		//Making message as read when opened
		public function readMessage($msg_id){
		 	try {
		 		$query = $this->link->query("UPDATE `message` SET `user_read` = '1' WHERE id = '$msg_id' ");
		 	}catch(Exception $ex) {
		 		return $ex->getMessage();	
		 	}
		 }
		
		
	}	
?>