   app.factory('DownloadService', function($scope, $ionicPlatform, $cordovaFile, $interval, $rootScope) {
		var downloading = [];
		$interval(function(){
			 downloading.forEach(download){
			   $rootScope.$broadcast('download-progress', function(){
				 mp3:download
			   })
			 }
		  }, 1000);
		  
	   //Download function 
	   this.downloadTrack = function (file,TrackTitle) {
		  var url = file;
		  var filename = url.split("/").pop();
		  var targetPath = cordova.file.externalRootDirectory + filename;
				 
		   $cordovaLocalNotification.schedule({
			  id:TrackTitle+'_download',
			  text: 'Download in progress',
			  title: 'Downloading '+ TrackTitle
			  }).then(function () {
				//alert("Instant Notification set");
			  });

		$cordovaFileTransfer.download(url, targetPath, {}, true)
		  .then(function (result) {
		  $cordovaLocalNotification.schedule({
			id: TrackTitle+'_downloadFinished',
			text: TrackTitle+' has been downloaded successfully to your memory card',
			title: 'Download finished',
			icon: "img/favico.ico"
		  }).then(function () {
			//alert("Instant Notification set");
		  });  
		},function (error) {
		  $cordovaLocalNotification.schedule({
			id: TrackTitle+'_downloadError',
			text: 'An error occured while downloading '+ TrackTitle+ ',try again',
			title: 'Error',
			icon: "img/favico.ico"
		  }).then(function () {
			//alert("Instant Notification set");
		  });    
		},function (progress) {
		
			downloading.forEach(function(download){
			   if(download.num == mp3.num){
				  download.progress = progress.loaded/progress.total;
			   }
			   cordova.plugins.notification.local.update({
				id:TrackTitle+'_download',
				text:download.progress
			  });
			 });      		  
		  });
	   }
	   
	   cordova.plugins.notification.local.on("click", function (notification, state) {
		alert('Downloaded successfully');
	   }, this)
   });