angular.module('starter.controllers', [])

app.controller('AboutCtrl', function($scope,$cordovaInAppBrowser) {
  
  //Opening links 
  $scope.openLink = function(url) {
    $cordovaInAppBrowser
     .open(url, '_blank')
     .then(function(event) {
       // success
     }, function(event) {
       // error
    });
  };
	
});