// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
var app = angular.module('starter', ['ionic', 'starter.controllers','ionicProcessSpinner','ngCordova','ngStorage'])

app.run(function($ionicPlatform,$cordovaToast,loginService,$ionicHistory,$timeout,$state) {
  
  if(loginService.checkLogin() == true){
	$timeout(function(){
		$state.go('tab.dash');
	});
	
  }
	
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider) {
  $ionicConfigProvider.tabs.position('bottom');
  $ionicConfigProvider.navBar.alignTitle('center');
  $ionicConfigProvider.views.forwardCache(true); // applying foward caching
  $ionicConfigProvider.scrolling.jsScrolling(false);

  $stateProvider
	
	
   /* log in route */
  .state('login',{
      url:'/login',
      templateUrl:'templates/login.html',
      controller: 'LoginCtrl'
  })
  
  // setup an abstract state for the tabs directive
   .state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'templates/tabs.html'
  })

  .state('tab.dash', {
    url: '/dash',
    views: {
      'tab-dash': {
        templateUrl: 'templates/tab-home.html',
        controller: 'HomeCtrl'
      }
    }
  })

	.state('tab.readings', {
		url: '/dash/:farm_id',
		views: {
		  'tab-dash': {
			templateUrl: 'templates/readings.html',
			controller: 'ReadingsCtrl'
		  }
		}
	  })

  .state('tab.messages', {
      url: '/messages',
      views: {
        'tab-messages': {
          templateUrl: 'templates/tab-messages.html',
          controller: 'MessagesCtrl'
        }
      }
    })
	
	
  .state('tab.message', {
    url: "/messages/:message_id/:message/:message_subject/:user_read/:date",
    views: {
      'tab-messages': {
        templateUrl: "templates/message.html",
        controller:'MessageCtrl'
      }
    }
  })
	
  .state('tab.settings', {
    url: '/settings',
    views: {
      'tab-settings': {
        templateUrl: 'templates/tab-settings.html'
      }
    }

    
  })
  
  	
  .state('tab.profile', {
    url: '/profile',
    views: {
      'tab-settings': {
        templateUrl: 'templates/profile.html',
        controller: 'ProfileCtrl'
      }
    }

    
  })


  .state('tab.about', {
    url: '/about',
    views: {
      'tab-settings': {
        templateUrl: 'templates/About.html',
		controller: 'AboutCtrl'
      }
    }
  })
  

  .state('tab.farms', {
    url: '/farms',
    views: {
      'tab-settings': {
        templateUrl: 'templates/farms.html',
		controller: 'FarmsCtrl'
      }
    }
  })	
  
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/login');

});
