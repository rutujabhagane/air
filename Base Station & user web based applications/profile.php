<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		
			require_once('inc/url_routes/route_1.php');
			require_once('classes/admin.class.php');
			$admin = new Admin();
			require_once('inc/loggedinadmin.php'); // Getting logged in admin's data
			
		
	}else{
		die("<script>location.href = 'adminlogin'</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<!-- Filestyle css -->
	<link rel="stylesheet" type="text/css" href="assets/css/filestyle.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
	  
		<!-- Top bar & notification -->	
		<!--header start-->
		<?php  require_once('inc/inc.top-bar.php');?>
		<!--header end-->
	 
      
		<!--sidebar start-->
        <?php
			//variables for sidemenu bar highlights
			$sidebar_profileMenu =1;
			$sidebar_profile =1;
					
			require_once('inc/inc.sidebar.php')
		?>
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="form-panel">
						<div class="row">
							<div class='col-md-3 col-offset-3'>
								<div id='profilepic_section'>
									<h3>Your profile photo</h3>
									<img id='profile_pic' src='<?php if(isset($loggedin_profile_pic))echo $loggedin_profile_pic;?>'>	
								</div>
							</div><!-- profile pic section -->
							
							<div class='col-md-9'>
								<div id='edit_personal_info'>
									<h3> Your login information</h3>
									<form class="form-horizontal style-form" method="get">
										
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Username</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_username))echo $loggedin_username;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">password</label>
										  <div class="col-lg-10">
											  <p class="form-control-static">*************</p>
										  </div>
										</div>
										
										<a href='<?php echo EDITPROFILE_URL;?>#changePassword'><button type="button" class="btn btn-theme btn-lg"><i class="fa fa-cog"></i> Change password</button></a>
									</form>
								</div>
								
								<div id='edit_personal_info'>
									<h3> Your account details</h3>
									<form class="form-horizontal style-form" method="get">
										
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">First Name</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_first_name))echo $loggedin_first_name;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Last Name</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_last_name))echo $loggedin_last_name;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Other Names</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_other_names))echo $loggedin_other_names;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Email</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_email))echo $loggedin_email;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Privilege</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_privilege))echo $loggedin_privilege;?></p>
										  </div>
										</div>
										
										<a href='<?php echo EDITPROFILE_URL;?>'><button type="button" class="btn btn-theme btn-lg"><i class="fa fa-cog"></i> Change details</button></a>
									</form>
								</div>
							
							</div>
						</div>
					</div>
          		</div>
          	</div>
		  
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
		<?php require_once('inc/inc.footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
	<script type="text/javascript" src="assets/js/core.js"></script>
    <!--script for this page-->
	<script type="text/javascript" src="assets/js/filestyle.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>

  </body>
</html>
