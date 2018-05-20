<?php
	require_once('../inc/inc.funcs.php');
	if(login_user()==true){
		
			require_once('../inc/url_routes/route_1.php');
			require_once('../classes/user.class.php');
			require_once('../classes/user_farm.class.php');
			require_once('../classes/farm.class.php');
			$user = new User();
			$user_farm = new User_Farm();
			$farm = new Farm();
			require_once('../inc/loggedinuser.php'); // Getting logged in user's data
			
		
	}else{
		die("<script>location.href = 'index'</script>");
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
		<?php  require_once('../inc/inc.user.top-bar.php');?>
		<!--header end-->
	 
      
		<!--sidebar start-->
        <?php
			//variables for sidemenu bar highlights
			$sidebar_profileMenu =1;
			$sidebar_profile =1;
					
			require_once('../inc/inc.user.sidebar.php')
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
									<h3> Your account details</h3>
									<div class="form-horizontal style-form">
										
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
										  <label class="col-lg-2 col-sm-2 control-label">Phone</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_phone))echo $loggedin_phone;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Region</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_region))echo $loggedin_region;?></p>
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-lg-2 col-sm-2 control-label">Town</label>
										  <div class="col-lg-10">
											  <p class="form-control-static"><?php if(isset($loggedin_town))echo $loggedin_town;?></p>
										  </div>
										</div>
										
									</div>
								</div>
							
							
								
								
								<div id='edit_personal_info'>
									<h3> Associated farms</h3>
									<div class="form-horizontal style-form">
									

										<table class="table">
											<thead>
												<tr>
													<th>Farm</th>
													<th>Crop</th>
													<th>Size</th>
													<th>Location</th>
												</tr>
											</thead>
											<tbody>
												
												<?php
													foreach($user_farm->getUserFarmsId($_SESSION['user_uid_login']) as $user_farm_details){
														$farm_id = $user_farm_details['farm_id'];
														foreach($farm->getUserFarms($farm_id) as $farmFetched){
															$id= $farmFetched['id'];
															$farm_name = $farmFetched['farm_name'];
															$farm_location  = $farmFetched['region']." / ".$farmFetched['town'];
															$crop = $farmFetched['crop'];
															$size = $farmFetched['size'];
															$soil_type = $farmFetched['soil_type'];
														}
													
												?>
												
												
												<tr>
													<td><?php echo $farm_name;?></td>
													<td><?php echo $crop;?></td>
													<td><?php echo $size;?> acres</td>
													<td><?php echo $farm_location;?></td>
												</tr>
												
													<?php }?>
											</tbody>
										</table>
									</div>
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
		<?php require_once('../inc/inc.footer.php');?>
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
    <!--script for this page-->
	<script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>

  </body>
</html>
