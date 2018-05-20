<?php	
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		die("<script>location.href = 'dashboard'</script>");
	}
	require_once('inc/url_routes/route_1.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="An irrigation system">

    <title>Administrator Login</title>

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
			  
		      <form action="" method="POST" class='admin_login form-login' autocomplete="off">
		        <h2 class="form-login-heading"><i class="fa fa-server"></i> ADMINISTRATOR LOGIN</h2>
		        <div class="login-wrap">
		            <div class="login_username_div"> 
                        <input placeholder="Your username" type="text" class="input-normal" id="login_username">
                    </div>
					<br>
		            <div class="login_password_div"> 
                        <input placeholder="Your password" type="password" class="input-normal" id="login_password">
                    </div>
					
					<!--
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot password?</a>
		
		                </span>
		            </label>
					-->
					</br>
		            <button class="btn btn-theme btn-block" id="login_btn" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
					
					<div id='error_output'></div>
					<div id='load' style='text-align:center;margin-top:0.8em;'></div>
					
		            <hr>
		            
		            <div class="registration">
						<div style="text-align:-webkit-auto;margin-left: 0.9em;">
							This is a login page for administrators of AIR System.If you mistakley navigated to this page please navigate back or close the page.
						</div>
						</br>
						<ul class='login_footer'>
							<li><a href='<?php echo ABOUT_URL;?>'>About</a></li>
							<li><a href='<?php echo HELP_URL;?>'>Help & Contact</a></li>
							<li><a href='<?php echo TERMS_URL;?>'>Terms of service</a></li>
							<li>© 2018</li>
						</ul>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="input-normal placeholder-no-fix" style="width: 43.1em;">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
	<!-- Core js file -->
	<script src="assets/js/core.js"></script>
	
    <script src="assets/js/bootstrap.min.js"></script>
	
	
	<!-- Tips js -->
	<script src="assets/js/tips.js"></script>
	<script src="assets/js/tips_functions.js"></script>
	
    <!--BACKSTRETCH-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/sys_background.jpg", {speed: 500});
    </script>


  </body>
</html>
