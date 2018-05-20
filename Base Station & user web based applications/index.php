<?php	
	require_once('inc/inc.funcs.php');
	if(login_user()==true){
		die("<script>location.href = 'userdashboard'</script>");
	}
	require_once('inc/url_routes/route_1.php');
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>AIR System</title>
	<!--  App Description  -->
	<meta name="description" content=""/>
	<meta charset="utf-8">
	<meta name="author" content="pixelhint.com">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/owl.transitions.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/animate.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/home.css"/>
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

	
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/ajaxchimp.js"></script>
	<script type="text/javascript" src="assets/js/scrollTo.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="assets/js/wow.js"></script>
	<script type="text/javascript" src="assets/js/parallax.js"></script>
	<script type="text/javascript" src="assets/js/nicescroll.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script src="assets/js/mapdata.js"></script>
    <script src="assets/js/countrymap.js"></script>
	<style>
		tspan {
		display: none;
	}
	</style>
</head>
<body>
	
	<!--  Header Section  -->
	<header>
		<div class="container">
			<div class="logo pull-left animated wow fadeInLeft">
				<img src="assets/img/logo_1.png" alt="" title="">
				<!--<h4>AIR System</h4> -->
			</div>

			
			<nav class="pull-left">
				<ul class="list-unstyled">
					<li class="animated wow fadeInLeft" data-wow-delay=".1s"><a href="#features">Features</a></li>
					<li class="animated wow fadeInLeft" data-wow-delay=".1s"><a href="#quote">Request A Quote</a></li>
					<li class="animated wow fadeInLeft" data-wow-delay=".1s"><a href="#mission_vision">Mission & Vision</a></li>
					<li class="animated wow fadeInLeft" data-wow-delay=".2s"><a href="login">Login</a></li>
				</ul>
			</nav>

			<div class="social pull-right">
				<ul class="list-unstyled">
					<li class="animated wow fadeInRight" data-wow-delay=".2s"><a href="#"><img src="assets/img/facebook.png" alt="" title=""></a></li>
					<li class="animated wow fadeInRight" data-wow-delay=".1s"><a href="#"><img src="assets/img/twitter.png" alt="" title=""></a></li>
					<li class="animated wow fadeInRight" data-wow-delay="0s"><a href="#"><img src="assets/img/google.png" alt="" title=""></a></li>
				</ul>
			</div>

			<span class="burger_icon">menu</span>
		</div>
	</header>
	<!--  End Header Section  -->






	<!--  Hero Section  -->
	<section class="hero" id="hero">
		<div class="container">
			<div class="caption">
				<h1 class="text-uppercase  animated wow fadeInLeft" style='color:white;'>Simple irrigation management system.</h1>
				<p class="text-lowercase  animated wow fadeInLeft" style='color:white;'>With the AIR System control and mornitor an irrigation system for a centerialized irrigation system </p>

				<a  style='color:white;' href="#quote" class="app_store_btn text-uppercase animated wow fadeInLeft">
					<span>Request a Quote</span>
				</a>

				
			</div>			
		</div>
	</section>
	<!--  End Hero Section  -->


	<!--  About Section  -->
	<section class="about" id="features">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center animated wow fadeInLeft">
					<div class="iphone" style='margin-top: 8em;'>
						<img src="assets/img/placeit.png" alt="" style='width:30em'></br></br></br></br>
					</div>
				</div>
				<div class="col-md-6 animated wow fadeInRight">
					<div class="features_list">
						<h1 class="text-uppercase">Automate and monitor irrigation on your farm.</h1>
						<p>We enable you to efficiently use water for automic irrigation.</p>
						<ul class="list-unstyled">
							<li class="camera_icon">
								<span style='margin-left:3em;'>Web application for users and farmers to easily monitor all activities carried out by the automatic irrigation system on their farms.</span>
							</li>
							<li class="video_icon">
								<span style='margin-left:3em;'>Seamless communication via web application and mobile app. Farmers and users can easily receive information and messages from administrators the AIR web application and mobile application.</span>
							</li>
							<li class="eye_icon">
								<span style='margin-left:3em;'>Algorithm for centeralized dam. AIR system has an algorithm which not only help in the automatic irrigation but help in efficient rationing of water for farms using a centeralized dam.</span>
							</li>
						</ul>

						<a href="#quote" class="app_store_btn text-uppercase" id="play_video" data-video="">
							<span>Request A Quote Now!</span>
						</a>
					</div>					
				</div>
			</div>
		</div>

		<div class="about_video show_video">
			<a href="" class="close_video"></a>
		</div>
	</section>
	<!--  End About Section  -->






	<!--  App Features Section  -->
	<section class="app_features" id="app_features">
		<div class="container">

			<div class="row text-center">
				<div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay="0s">
					<i style='color:white;' class='fa fa-user fa-4x'></i>
					<h1 style='font-size:2em;'>Irrigation Administration</h1>
					<p class=""> Web based irrigation management software for admins of the system, web based and mobile application for farmers and users of the system</p>
				</div>
				<div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay=".1s">
					<i style='color:white;' class='fa fa-bar-chart fa-4x'></i>
					<h1 style='font-size:2em;'>Data management</h1>
					<p class="">Farmers and users get access to various data gathered during various irrigation operations.</p>
				</div>
				<div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay=".2s">
					<i style='color:white;' class='fa fa-mobile fa-4x'></i>
					<h1 style='font-size:2em;'>Mobile App</h1>
					<p class=""> Users have an android application where all data gathered during various operations in the automatic irrigation process can be easily accessed</p>
				</div>
			</div>
		</div>
	</section>
	<!--  And App Features Section  -->






	<!--  Testimonials Section  -->
	<section class="testimonials animated wow fadeIn" id="quote" data-wow-duration="2s" style='padding: 3em 2em 5em 2em;'>
		<div class="container">
			<h2 style='text-align:center;margin-bottom:1.4em;'>Join 500+ farmers to help your irrigation system</h2>
			<div class='col-md-6'>
				<ul class='benefits'>
					<li>Request a quote now to know the price and procedures</li>
					<li>Free mobile app to help you remotly monitor irrigation process and statistics.</li>
					<li>24-hour customer support and a dedicated client success manager at your disposal.</li>
				</ul>
				
				
				
				

			</div>
			
			<div class='col-md-6'>
				<form method='POST' class='requestQuote'>
					<div class="col-sm-10">
                        <input type="text" id='name' placeholder='Your Full Name' class="form-control custom_text_box">
						
						<input type="text" id='phone' placeholder='Enter Phone Number' class="form-control custom_text_box">
						
						<div style='width:33.4em;'>
						<input type="text" id='region' placeholder='Region' class="form-control custom_text_box half_text_box">
						<input type="text" id='town' placeholder='Town/City' class="form-control custom_text_box half_text_box" style='margin-left:0.4em;'>
						</div>
						
						<div class="form-group" id='service_selected'>
							<select class="form-control" style="width:33em;height: 50px;" id="service">
						
								<option value='whole_implementation'>Need whole sysetem implemented on my farm</option>
								<option value='rationing_algorithm'>Need rationing algorithm </option>
			
							</select>
						</div>
						
						<div id='themap'>
							<span>The regions in green is where our dams cover and the red indicates where the dams are. Make sure your farm(s) are within this region</span>
							<div id="map"></div>
						</div>
						
						
						
						<button type="submit" class="btn-request-theme btn-request">
							Send A Request Now
						</button>
						
						<div id='error_output' style='width:30em;font-size:1.1em;'></div>
						<div id='success_output' style='width:30em;font-size:1.1em;'></div>
                    </div>
				</form>
			</div>
			
		</div>
	</section>
	<!--  End Testimonials Section  -->
	
	
	
	<!--  Email Subscription Section  -->
	<section class="sub_box" id='mission_vision'>
		<div class='container'>
			<div class='col-md-5 col-md-offset-1' style='border:1px solid white;color:white;padding:2em;height:17em;font-size:1.2em;'>
				<h2>Mission</h2>
				<div>
					AIR's mission is to empower farmers with the affordable technological tools to effectively irrigate their farms to avoid over and under irrigation. Our mission is also to help farms using a centerialized dam to effectively use water.
				</div>
			</div>
			
			<div class='col-md-5 col-md-offset-1' style='border:1px solid white;color:white;padding:2em;height:17em;font-size:1.2em'>
				<h2>Vision</h2>
				<div>
					AIR's vision is to help farmers automate and remotly control irrigation process from a centerialized irrigation dam.
				</div>
			</div>
		</div>
	</section>
	<!--  End Email Subscription Section  -->
	

	<!--  Footer Section style='background-color:#43b879;' -->
	<footer >
		<ul class="list-unstyled list-inline app_platform">
			<li class="animated wow fadeInDown" data-wow-delay="0s">
				<a href=""><img src="assets/img/android_icon.png" alt="" title=""></a>
			</li>
		</ul>
		<p class="copyright animated wow fadeIn" data-wow-duration="2s">© 2018 <a href="http://www.svison.com" target="_blank"><strong>AIR System</strong></a>. All Rights Reserved</p>
	</footer>
	<!--  End Footer Section  -->
	<script>
		$('documnet').ready(function(){
			
			$('#service').change(function(){
				console.log('service changed');
			  var value = $(this).val();
			  console.log(value);
			  if(value == 'whole_implementation'){
				$('#themap').css('display','block');
			  }else{
				$('#themap').css('display','none');
			  }
			});
			
			
			
			$('.requestQuote').submit(function(){	
				 var data = {name:$('#name').val(),phone:$('#phone').val(),region:$('#region').val(),town:$('#town').val(),service:$('#service').val()};
				 $.ajax({
					url:"lib/requestQuote.php",
					type:"POST",
					data:{data:data},
					//dataType: "json",
					success:function(response){
					   if(response.success){
						  $('#error_output').css('display','none');
						  $('#name').val('');
						  $('#phone').val('');
						  $('#region').val('');
						  $('#town').val('');
						  $('#success_output').css('display','block').html("Your request has been successfully sent");
					   }else{
						  $('#error_output').css('display','block').html(response.error);
						  $('#success_output').css('display','none');
					   }
					},
					error:function($ex){
					   console.log($ex);
					   $('#error_output').css('display','block').html("An error occured, please try again");
					}
				 });
			  
			  return false;
			});
			
			
		});
		
	</script>

</body>
</html>