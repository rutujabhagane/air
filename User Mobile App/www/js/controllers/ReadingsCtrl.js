angular.module('starter.controllers', [])

app.controller('ReadingsCtrl', function($scope,$http,$state,$localStorage,$ionicLoading,$cordovaToast,$ionicPopup,FarmsService) {
	$scope.farm_id = $state.params.farm_id; //Getting farm_id dynamically from what was clicked
	
	$scope.loading = true; 
	
 
   FarmsService.getMoistureReadings($scope.farm_id).then(function(data){
      $scope.moisture_readings = data;
	  $scope.loading = false;
   }).catch(function(error){
		console.log("An error occured fetching moisture readings");

		var alertPopup = $ionicPopup.alert({
			title: "Couldn't get moisture readings",
			template: '<p style=\'text-align:center\'>Looks like the server is taking too long to respond, try again</p>'
		});

		alertPopup.then(function(res) {
			$state.go('tab.dash');
		});
   });
   
   FarmsService.getTemperatureReadings($scope.farm_id).then(function(data){
      $scope.temperature_readings = data;
	  $scope.loading = false;
   }).catch(function(error){
      console.log("An error occured fetching temperature tracks");
	  var alertPopup = $ionicPopup.alert({
			title: "Couldn't get temperature readings",
			template: '<p style=\'text-align:center\'>Looks like the server is taking too long to respond, try again</p>'
		});

		alertPopup.then(function(res) {
			$state.go('tab.dash');
		});
   });
   
   
   //Refetching read and unread messages
	$scope.doRefresh = function(){
		
		
		FarmsService.getTemperatureReadings($scope.farm_id).then(function(data){
		  $scope.temperature_readings = data;
		  $scope.loading = false;
	    }).catch(function(error){
		  console.log("An error occured fetching temperature tracks");
		  var alertPopup = $ionicPopup.alert({
				title: "Couldn't get temperature readings",
				template: '<p style=\'text-align:center\'>Looks like the server is taking too long to respond, try again</p>'
			});

			alertPopup.then(function(res) {
				$state.go('tab.dash');
			});
	    });
		
		FarmsService.getTemperatureReadings($scope.farm_id).then(function(data){
		  $scope.temperature_readings = data;
		  $scope.loading = false;
	    }).catch(function(error){
		  console.log("An error occured fetching temperature tracks");
		  var alertPopup = $ionicPopup.alert({
				title: "Couldn't get temperature readings",
				template: '<p style=\'text-align:center\'>Looks like the server is taking too long to respond, try again</p>'
			});

			alertPopup.then(function(res) {
				$state.go('tab.dash');
			});
	    });
		
		$scope.$broadcast('scroll.refreshComplete');
    }
	
});