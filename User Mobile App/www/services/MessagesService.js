angular.module('starter.controllers', [])

app.service("MessagesService",function($http,$localStorage,$q){
	
	this.getUnreadMessages = function(){
		var def = $q.defer();
		$http.get("http://airgh.com/api/public/data/messages/unread/"+$localStorage.uid)
		  .success(function(response){
			def.resolve(response['messages']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}
	
	this.getReadMessages = function(){
		var def = $q.defer();
		$http.get("http://airgh.com/api/public/data/messages/read/"+$localStorage.uid)
		  .success(function(response){
			def.resolve(response['messages']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}
	
	
	this.readMessage = function(msg_id){
		var def = $q.defer();
		$http.put("http://airgh.com/api/public/data/messages/unread/"+msg_id+"/read")
		  .success(function(response){
			def.resolve(response['text']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}
	
	this.deleteMessage = function(msg_id){
		var def = $q.defer();
		$http.delete("http://airgh.com/api/public/data/messages/"+msg_id+"/delete")
		  .success(function(response){
			def.resolve(response['text']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}
})