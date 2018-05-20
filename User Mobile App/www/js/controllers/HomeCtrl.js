angular.module('starter.controllers', [])

app.controller('HomeCtrl', function($scope,$http,$state,$localStorage,$ionicLoading,$cordovaToast,FarmsService) {
	$scope.farms= []; 
	
	$scope.loading = true; 
  
 
   FarmsService.getAssociatedFarms().then(function(data){
      $scope.farms = data;
	  $scope.loading = false;
   }).catch(function(error){
      console.log("An error occured fetching all tracks");
   });
   
   //Refetching user profile
	$scope.doRefresh = function(){
		
		FarmsService.getAssociatedFarms().then(function(data){
			$scope.farms = data;
			$scope.loading = false;
		}).catch(function(error){
			$ionicLoading.hide();
			$cordovaToast.show("Couldn't fetch your profile, Please try again in a moment", 'long', 'bottom');
		}).finally(function() {
			$scope.$broadcast('scroll.refreshComplete');
		});
	
    }
   
});