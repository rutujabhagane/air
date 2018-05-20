<?php

require_once("dbconnection.class.php");

class Message{
	protected $link;
	public function __construct(){
		$dbconnection = new dbconnection();
		$this->link = $dbconnection->connection();
	}
	
	
	/*Retrieving unread messages for a particular user,all*/
		public function getAllUserUnreadMessages($user_id){
			$response = array();
			try {
				$query = $this->link->query("SELECT * FROM `message` WHERE user_id = '$user_id' AND user_read='0' ORDER BY id DESC");
				$response['error'] = false;
				$response['statusCode']= 200;
				$response['unread_messages_fetched']= $row = $query->rowCount();
				$response['messages'] = $query->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $ex){
				$response['error'] = true;
				$response['statusCode']=500;
				$response['errorMessage'] = $ex->getMessage();
			}
			return $response;
		}
		
		
		/*Retrieving read messages for a particular user,all*/
		public function getAllUserReadMessages($user_id){
			$response = array();
			try {
				$query = $this->link->query("SELECT * FROM `message` WHERE user_id = '$user_id' AND user_read='1' ORDER BY id DESC");
				$response['error'] = false;
				$response['statusCode']= 200;
				$response['read_messages_fetched']= $row = $query->rowCount();
				$response['messages'] = $query->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $ex){
				$response['error'] = true;
				$response['statusCode']=500;
				$response['errorMessage'] = $ex->getMessage();
			}
			return $response;
		}
		
		
		public function readMessage($msg_id){
			$response = array();
		 	try {
		 		$query = $this->link->query("UPDATE `message` SET `user_read` = '1' WHERE id = '$msg_id' ");
				$response['error'] = false;
				$response['statusCode']= 200;
				$response['text'] = "Message Read";
		 	}catch(Exception $ex) {
		 		$response['error'] = true;
				$response['statusCode']=500;
				$response['errorMessage'] = $ex->getMessage();
		 	}
			return $response;
		}
		
		/*Deleting message */
		public function deleteMessage($msg_id){	
			$response = array();
			try {	
				$query = $this->link->query("DELETE FROM message where `id`='$msg_id'");
				$response['error'] = false;
				$response['statusCode']= 200;
				$response['text'] = "Message deleted";
			}catch(Exception $ex) {
				$response['error'] = true;
				$response['statusCode']=500;
				$response['errorMessage'] = $ex->getMessage();
			}
			return $response;
		}
		
		
}

?>