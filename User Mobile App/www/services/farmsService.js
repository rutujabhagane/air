angular.module('starter.controllers', [])

app.service("FarmsService",function($http,$localStorage,$q){
	
	this.getAssociatedFarms = function(){
		var def = $q.defer();
		$http.get("http://airgh.com/api/public/data/user/associatedfarms/get/"+$localStorage.uid)
		  .success(function(response){
			def.resolve(response['farms']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}

	this.getMoistureReadings = function(farm_id){
		var def = $q.defer();
		$http.get("http://airgh.com/api/public/data/moisture/get/"+farm_id)
		  .success(function(response){
			def.resolve(response['readings']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}

	this.getTemperatureReadings = function(farm_id){
		var def = $q.defer();
		$http.get("http://airgh.com/api/public/data/temperature/get/"+farm_id)
		  .success(function(response){
			def.resolve(response['readings']);
		}).error(function(error){
			def.reject(error);
		});
		return def.promise;
	}
	
})