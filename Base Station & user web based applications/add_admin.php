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

    <title>Add Admin</title>

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
			$sidebar_adminMenu =1;
			$sidebar_addAdmin =1;
			
			require_once('inc/inc.sidebar.php')
		?>          
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="form-panel">
						<div class='row'>
							<h3 style="margin-left:1em;">Add administrator</h3>
							<div class='col-md-3'>
								<div id='profilepic_section'>
									<h3>Profile photo</h3>
									<img id='profile_pic' src='assets/img/default_profile.png'>
								
									
										<input type='file' id='upload_cover' class='jfilestyle' accept='image/*' name='cover' data-input='false' data-buttonText='Choose picture'></br>
										
									
								</div>
								
							</div>
							
							<div class='col-md-9'>
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Enter in administrator details</h3>
									<form class="form-horizontal style-form add_admin" method="post">
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Username</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='username'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">First name</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='first_name'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Last name</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='last_name'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Other names</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='other_names'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Email</label>
										  <div class="col-sm-10">
											  <input type="email" class="form-control" id='email'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Password</label>
										  <div class="col-sm-10">
											  <input type="password" class="form-control" id='password'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Re-type password</label>
										  <div class="col-sm-10">
											  <input type="password" class="form-control" id='retype_password'>
											  <span class="help-block">
												The password and Re-type password field can be left empty and a default password "<b>airsysadmin1</b>" will be used as a password. User can later change this when he or she logs in.
											  </span>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Privilege</label>
										  <select class="form-control" style="width:45em;" id="title">
											<option value='none'>Select privelege</option>
											<option value='Admin'>Administrator</option>
											<option value='Manager'>Manager</option>
										  </select>
										</div>
										
										
										<button type="submit" class="btn btn-theme btn-lg"> Add admin</button>
										
										<div id='error_output'></div>
										<div id='success_output'></div>
										
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
