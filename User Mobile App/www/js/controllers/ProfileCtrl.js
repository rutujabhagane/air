angular.module('starter.controllers', [])

app.controller('ProfileCtrl', function($scope,$http,$state,$localStorage,$ionicLoading,$cordovaToast,AccountService) {
	$ionicLoading.show({
		content: 'Loading',
		template: '<ion-spinner icon="android"></ion-spinner>',
		animation: 'fade-in',
		noBackdrop: true,
		maxWidth: 50,
		showDelay: 0
	});
	
	//scope to store all profile information in json format	
	$scope.account = {}
	AccountService.getAccount().then(function(data){
		$scope.account.firstname = data.firstname;
		$scope.account.lastname = data.lastname;
		$scope.account.othernames = data.othernames;
		$scope.account.phone = data.phone;
		$scope.account.region = data.region;
		$scope.account.town = data.town;
		$scope.account_fetched = true;
		$ionicLoading.hide();
	}).catch(function(error){
		$ionicLoading.hide();
		$cordovaToast.show("Couldn't fetch your profile, Please try again in a moment", 'long', 'bottom');
	});
	
	//Refetching user profile
	$scope.doRefresh = function(){
		AccountService.getAccount().then(function(data){
			$scope.account.firstname = data.firstname;
			$scope.account.lastname = data.lastname;
			$scope.account.othernames = data.othernames;
			$scope.account.phone = data.phone;
			$scope.account.region = data.region;
			$scope.account.town = data.town;
			$scope.account_fetched = true;
			$ionicLoading.hide();
		}).catch(function(error){
			$ionicLoading.hide();
			$cordovaToast.show("Couldn't fetch your profile, Please try again in a moment", 'long', 'bottom');
		}).finally(function() {
			$scope.$broadcast('scroll.refreshComplete');
		});
    }
	
	$scope.logout = function(){
		delete $localStorage.id;
		delete $localStorage.uid;
		delete $localStorage.phone;
		delete $localStorage.pin;
		$localStorage.loggedin = false;
		$state.go("login");
	}
	
});