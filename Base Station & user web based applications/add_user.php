<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/farm.class.php');
		$admin = new Admin();
		$farm = new Farm();
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

    <title>Add Farmer</title>

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
				$sidebar_farmersMenu =1;
				$sidebar_addFarmer =1;
					
				require_once('inc/inc.sidebar.php')
			?>
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="content-panel">
						<div class='row'>
							<h3 style="margin-left:1em;">Add Farmer</h3>
							<div class='col-md-3'>
								<div id='profilepic_section'>
									<h3>Profile photo</h3>
									<img id='profile_pic' src='assets/img/default_profile.png'>
								
									
										<input type='file' id='upload_cover' class='jfilestyle' accept='image/*' name='cover' data-input='false' data-buttonText='Choose picture'></br>
										
									
								</div>
								
							</div>
							
							<div class='col-md-9'>
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Enter in farmer details</h3>
									<form class="form-horizontal style-form add_user" method="post">
											
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">First name</label>
										  <div class="col-sm-10">
											  <input type="text" placeholder="First name" class="form-control" id='first_name'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Last name</label>
										  <div class="col-sm-10">
											  <input type="text" placeholder="Last name" class="form-control" id='last_name'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Other names</label>
										  <div class="col-sm-10">
											  <input type="text" placeholder="Other names" class="form-control" id='other_names'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Phone</label>
										  <div class="col-sm-10">
											  <input type="text" placeholder="Phone number" class="form-control" id='phone'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Region</label>
										  <select class="form-control" style="width:45.5em;margin-left:10.6em;" id="user_region">
											<option value='none'>Select Region</option>
											<option value='AR'>Greater Accra</option>
											<option value='UE'>Upper East</option>
											<option value='UW'>Upper West</option>
											<option value='NR'>Northern Region</option>
											<option value='VR'>Volta</option>
											<option value='BA'>Brong Ahafo</option>
											<option value='WR'>Western</option>
											<option value='AS'>Ashanti</option>
											<option value='ER'>Eastern</option>
											<option value='CR'>Central</option>
										  </select>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">City/Town</label>
										  <div class="col-sm-10">
											  <input type="text" placeholder="Where farmer stays" class="form-control" id='user_town'>
										  </div>
										</div>
									
								</div><!-- PERSONAL INFO -->
								
								<div id='edit_personal_info' class='form-horizontal'>
									<h3 style='margin-bottom:1em;'>PIN detatils</h3>
									<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">PIN</label>
										  <div class="col-sm-10">
											  <input type="password" placeholder="*******" class="form-control" id='pin'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Re-type PIN</label>
										  <div class="col-sm-10">
											  <input type="password" placeholder="*******" class="form-control" id='retype_pin'>
											  <span class="help-block">
												The PIN and Re-type PIN field can be left empty and a default PIN "<b>0101</b>" will be used as a PIN. User can later change this when he or she logs in.
											  </span>
										  </div>
										</div>
								</div><!-- PIN -->
								
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Farm detatils</h3>
									
									<div class="form-group">
										  <label style="width: 20em;" class="col-sm-2 col-sm-2 control-label">Have an existing farm profile?</label>
										  <select class="form-control" style="width:45em;margin-left:1em;" id="existing_farm_q">
											<option value='yes'>Yes</option>
											<option value='no'>No</option>
										  </select>
									</div>
									
									<div class="form-group" id='existing_farm_names'>
										  <label style="width: 20em;" class="col-sm-2 col-sm-2 control-label">Existing farms profiles</label>
										  
										  <select class="form-control" style="width:45em;margin-left:1em;" id="existing_farms">
											<option value='none'>Select a farm profile</option>
											<?php
													if($farm->getExistingFarmProfiles()!=0){
														foreach ($farm->getExistingFarmProfiles() as $key => $value) {
															$id = $value['id'];
															$farm_name = $value['farm_name'];
															$region = $value['region'];
															$town = $value['town'];
															$block_id = $value['block_id'];
															echo "<option value='$id'>$farm_name ($region/$town - $block_id)</option>";
														}
													}
												
											?>
		
										  </select>
										  
										  
									</div>
									
									
									<div class='form-horizontal' id='enter_farm_details'>
										<hr>
										
										<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Farm name</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='farm_name'>
											  </div>
											</div>
										
										<div class="form-group">
											<label class="col-sm-2 col-sm-2 control-label">Crop</label>
											<select class="form-control" style="width:45.5em;margin-left:10.6em;" id="crop">
												<option value='none'>Select crop</option>
												<option value='maize'>Maize</option>
												<option value='groundnut'>Groudnut</option>
												<option value='tomato'>Tomato</option>
												<option value='millet'>Millet</option>
												<option value='pepper'>Pepper</option>
											</select>
										</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Size</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='size'>
												  <span class="help-block">
													The size of the farm needed is in <b>acres</b>
												  </span>
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Soil Type</label>
											  <select class="form-control" style="width:45.5em;margin-left:10.6em;" id="soil_type">
												<option value='none'>Select soil type</option>
												<option value='sandy'>Sandy</option>
												<option value='loamy'>Loamy</option>
												<option value='clayey'>Clayey</option>
											  </select>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Irrigation type</label>
											  <select class="form-control" style="width:45.5em;margin-left:10.6em;" id="irrigation_type">
												<option value='none'>Select irrigation type</option>
												<option value='surface'>Surface</option>
												<option value='sprinkler'>Sprinkler</option>
												<option value='drip'>Drip</option>
												<option value='center'>Center pivot</option>
											  </select>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Region</label>
											  <select class="form-control" style="width:45.5em;margin-left:10.6em;" id="farm_region">
												<option value='none'>Select Region</option>
												<option value='AR'>Greater Accra</option>
												<option value='UE'>Upper East</option>
												<option value='UW'>Upper West</option>
												<option value='NR'>Northern Region</option>
												<option value='VR'>Volta</option>
												<option value='BA'>Brong Ahafo</option>
												<option value='WR'>Western</option>
												<option value='AS'>Ashanti</option>
												<option value='ER'>Eastern</option>
												<option value='CR'>Central</option>
											  </select>
											</div>
										
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">City/Town</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='farm_town'>
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Block id</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='block_id'>
											  </div>
											</div>
											
									</div>
										
										
										<button type="submit" class="btn btn-theme btn-lg"> Create user</button>
										
										<div id='error_output'></div>
										<div id='success_output'></div>
										

									</form>
								</div><!-- FARM -->
								
								
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
