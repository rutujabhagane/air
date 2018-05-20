angular.module('starter.controllers', [])

app.service("loginService",function($http,$localStorage,$state){
	this.checkLogin= function(){
		if($localStorage.hasOwnProperty("phone") && $localStorage.hasOwnProperty("pin")){	
			return true;
		}else{
			return false;
		}
	}
})