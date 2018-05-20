angular.module('starter.controllers', [])

app.service("AccountService",function($http,$localStorage,$q){
	this.getAccount = function(){
		var def = $q.defer();
		$http.get("http://airgh.com/api/public/data/user/get/"+encodeURIComponent($localStorage.uid))
		  .success(function(response){
			def.resolve(response['user']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}
	
	
})