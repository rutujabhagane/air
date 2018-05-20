angular.module('starter.controllers', [])

app.controller('MessagesCtrl', function($scope,$cordovaInAppBrowser,MessagesService) {
	
	$scope.Unreadmessages = []; //Array to store unread messages
	$scope.Readmessages = []; //Array to store read messages
	$scope.unReadloading = true;
	$scope.readloading = true;
	
	//Fetching Unread messages
	MessagesService.getUnreadMessages().then(function(unReadMessages){
		if(unReadMessages.length > 0){
			$scope.Unreadmessages = unReadMessages;
			$scope.haveUnreadMessage = true;
			$scope.unReadloading = false;
		}else{
			$scope.haveUnreadMessage = false;
			$scope.unReadloading = false;
		}
	}).catch(function(error){
		$scope.unReadloading = false;
		$cordovaToast.show("Looks like the server is taking to long to respond, Pull to refresh", 'long', 'bottom');
	});
	
	
	//Fetching Unread messages
	MessagesService.getReadMessages().then(function(readMessages){
		if(readMessages.length > 0){
			$scope.Readmessages = readMessages;
			$scope.haveReadMessage = true;
			$scope.readloading = false;
		}else{
			$scope.haveReadMessage = false;
			$scope.readloading = false;
		}
	}).catch(function(error){
		$scope.readloading = false;
		$cordovaToast.show("Looks like the server is taking to long to respond, Pull to refresh", 'long', 'bottom');
	});
	
	//Refetching read and unread messages
	$scope.doRefresh = function(){
		MessagesService.getUnreadMessages().then(function(unReadMessages){
		if(unReadMessages.length > 0){
			$scope.Unreadmessages = unReadMessages;
			$scope.haveUnreadMessage = true;
			$scope.unReadloading = false;
		}else{
			$scope.haveUnreadMessage = false;
			$scope.unReadloading = false;
		}
		}).catch(function(error){
			$scope.unReadloading = false;
			$cordovaToast.show("Looks like the server is taking to long to respond, Pull to refresh", 'long', 'bottom');
		});
		
	
		MessagesService.getReadMessages().then(function(readMessages){
			if(readMessages.length > 0){
				$scope.Readmessages = readMessages;
				$scope.haveReadMessage = true;
				$scope.readloading = false;
			}else{
				$scope.haveReadMessage = false;
				$scope.readloading = false;
			}
		}).catch(function(error){
			$scope.readloading = false;
			$cordovaToast.show("Looks like the server is taking to long to respond, Pull to refresh", 'long', 'bottom');
		});
		
		$scope.$broadcast('scroll.refreshComplete');
    }
	
	
	
	
});