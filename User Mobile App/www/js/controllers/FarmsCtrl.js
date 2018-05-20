angular.module('starter.controllers', [])

app.controller('FarmsCtrl', function($scope,$http,$state,$localStorage,$ionicLoading,$cordovaToast,FarmsService) {
	$scope.farms= []; 
	
	$scope.loading = true; 
  
 
   FarmsService.getAssociatedFarms().then(function(data){
      $scope.farms = data;
	  $scope.loading = false;
   }).catch(function(error){
      console.log("An error occured fetching all tracks");
   });
});