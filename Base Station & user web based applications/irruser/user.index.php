<?php	
	require_once('../inc/inc.funcs.php');
	if(login_user()==true){
		die("<script>location.href = 'userdashboard'</script>");
	}
	require_once('../inc/url_routes/route_1.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="An irrigation system">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<!-- tips css -->
	<link href="assets/css/tips.css" media="screen" rel="stylesheet" type="text/css" />    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

	  <div id="login-page">
	  	<div class="container">
			  
		      <form action="" method="POST" class='user_login form-login' autocomplete="off">
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <div class="login_username_div"> 
                        <input placeholder="Your phone number" type="text" class="input-normal" id="login_phone">
                    </div>
					<br>
		            <div class="login_password_div"> 
                        <input placeholder="Your PIN" type="password" class="input-normal" id="login_pin">
                    </div>
					</br>
					<!-- 
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot password?</a>
		
		                </span>
		            </label>
					-->
		            <button class="btn btn-theme btn-block" id="login_btn" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
					
					<div id='error_output'></div>
					<div id='load' style='text-align:center;margin-top:0.8em;'></div>
					
		         
		            
		            <div class="registration">
						</br>
						<ul class='login_footer'>
							<li><a href='<?php echo ABOUT_URL;?>'>About</a></li>
							<li><a href='<?php echo HELP_URL;?>'>Help & Contact</a></li>
							<li><a href='<?php echo TERMS_URL;?>'>Terms of service</a></li>
							<li>© 2018</li>
						</ul>
		            </div>
		
		        </div>
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
	<!-- Core js file -->
	<script src="assets/js/irruser/core.js"></script> <!-- User folder -->
	
    <script src="assets/js/bootstrap.min.js"></script>
	
	
	<!-- Tips js -->
	<script src="assets/js/tips.js"></script>
	<script src="assets/js/tips_functions.js"></script>
	
    <!--BACKSTRETCH-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
