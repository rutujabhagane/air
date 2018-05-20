angular.module('starter.controllers', [])

app.controller('MessageCtrl', function($scope,$state,$ionicPopup,$ionicHistory,$ionicLoading,MessagesService) {
	
	$scope.message_subject = $state.params.message_subject; //Getting message subject dynamically from what was clicked
	$scope.message = $state.params.message; //Getting message dynamically from what was clicked
	$scope.message_id = $state.params.message_id; //Getting message id dynamically from what was clicked
	$scope.user_read = $state.params.user_read; //Getting message id dynamically from what was clicked
	$scope.date = $state.params.date; //Getting message id dynamically from what was clicked
	
	if($scope.user_read == "0"){
		MessagesService.readMessage($scope.message_id).then(function(data){
			//Success
		}).catch(function(error){
			//error occured while setting message as being read , error message won't be showed to the user
		});
	}
	
	$scope.deleteMessage = function(){
		var confirmPopup = $ionicPopup.confirm({
			title: 'Confirm Deletion',
			template: 'Are you sure you want to delete this message'
		});
		
		confirmPopup.then(function(res) {
			if(res) {
				//If OK delete message else just cancel
				
				$ionicLoading.show({
					template: '<ion-spinner icon="android"></ion-spinner> <br/> Loading music',
					noBackdrop: true
				});
				
				MessagesService.deleteMessage($scope.message_id).then(function(data){
					//Success
					console.log(data);
					$ionicLoading.hide(); //hide loading here
					$ionicHistory.goBack();
				}).catch(function(){
					//error occured while updating plays , error message won't be showed to the user
					//$cordovaToast.show("Message could not be deleted,server is taking to long to respond. Try again", 'long', 'bottom');
				});
			}
	   });
	}
	
	
});