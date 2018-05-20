angular.module('starter.controllers', [])

app.controller('LoginCtrl', function($scope,$http,$state,$localStorage,$ionicLoading,$window,$cordovaToast) {
	//Open link funtion:to open links within the app
	$scope.openLink = function(url) {
		$cordovaInAppBrowser
		 .open(url, '_blank');
	};
  
  $scope.loggedIn = $localStorage.loggedin;
  $scope.introDone = $localStorage.didIntro;
  $scope.showFooter = true; // To show footer as soon as user is the login view
  
  //To hide footer as soon as keyboard shows
  window.addEventListener('native.keyboardshow',function(){
	  $scope.showFooter = false;
  });
  
  //To show footer as soon as keyboard is hidden
  window.addEventListener('native.keyboardhide',function(){
	  $scope.showFooter = true;
  });

  $scope.loginInCredentials = {
    phone:"",
    pin:""
  }

  $scope.doLogin = function(){
    //$ionicLoading.show({
     // template:'Signing in...'
    //});
	$scope.processing = true;
    var data = {
      phone:$scope.loginInCredentials.phone,
      pin:$scope.loginInCredentials.pin
    }
	
	////http://airgh.com/api/public/data/user/login
	
     $http.post("http://airgh.com/api/public/data/user/login/"+$scope.loginInCredentials.phone+"/"+$scope.loginInCredentials.pin)
      .success(function(response){
        // $ionicLoading.hide();
		$scope.signin_error=" ";
		$scope.processing = false;
        $localStorage.loggedin = true;	
        $localStorage.id = response['id'];
		$localStorage.uid = response['uid'];
        $localStorage.phone = response['phone'];
        $localStorage.pin = response['pin'];

        $state.go("tab.dash");
       }).error(function(error){
			console.log(error);
			$scope.processing = false;
			if(error['error'] == true){
				$scope.signin_error = error['errorMessage'];
			}else{
				$cordovaToast.show("Sorry, we couldn't complete your request. Please try again in a moment", 'long', 'bottom');
			}
		});

  }
});