<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		
			require_once('inc/url_routes/route_1.php');
			require_once('classes/admin.class.php');
			require_once('classes/user.class.php');
			require_once('classes/farm.class.php');
			require_once('classes/user_farm.class.php');
			$admin = new Admin();
			$user = new User();
			$farm = new Farm();
			$user_farm = new User_Farm();
			require_once('inc/loggedinadmin.php'); // Getting logged in admin's data
			
			if($user->getUserDetails($_GET['id'])){
				foreach($user->getUserDetails($_GET['id']) as $admin_details){
					$uid = $admin_details['uid'];
					$first_name = $admin_details['firstname'];
					$last_name = $admin_details['lastname'];
					$other_names = $admin_details['othernames'];
					$phone = $admin_details['phone'];
					$region = $admin_details['region'];
					$profile_pic = $admin_details['profile_pic'];
					$town = $admin_details['town'];
					
					if($profile_pic != "assets/img/default_user_profile.png"){
						$profile_pic = "data/user_data/covers/".$profile_pic;
					}
					
					if($region == "AR"){
						$AR_selected = true;
					}elseif($region == "UE"){
						$UE_selected = true;
					}elseif($region == "UW"){
						$UW_selected = true;
					}elseif($region == "NR"){
						$NR_selected = true;
					}elseif($region == "VR"){
						$VR_selected = true;
					}elseif($region == "BA"){
						$BA_selected = true;
					}elseif($region == "WR"){
						$WR_selected = true;
					}elseif($region == "AS"){
						$AS_selected = true;
					}elseif($region == "ER"){
						$ER_selected = true;
					}elseif($region == "CR"){
						$CR_selected = true;
					}
					
					if(empty($other_names))
						$name = $first_name." ".$last_name;
					else
						$name = $first_name." ".$other_names.". ".$last_name;
				}
			}else{
				die("<script>location.href = '404'</script>");
			}
			
	}else{
		die("<script>location.href = 'adminlogin'</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Farmer</title>

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
			$sidebar_viewFarmers =1;
	
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
							<h3 style="margin-left:1em;">Edit Farmer <i class='fa fa-angle-right'> <?php echo $name;?></i></h3>
							<div class="col-lg-12" style="border:1px solid #eee;margin:1em;">
							
								<div class='col-md-3'>
								
									<div id='profilepic_section'>
										<h3>Profile photo</h3>
										<img id='profile_pic' src='<?php if(isset($profile_pic))echo $profile_pic;?>'>
									
										<input type='file' id='upload_cover' class='jfilestyle' accept='image/*' name='cover' data-input='false' data-buttonText='Choose picture'></br>
											
											
									</div>
								
								</div><!-- Profile pictre section -->
								
								<div class='col-md-9'>
									<div id='edit_personal_info' style="margin-top:2em;margin-bottom:2em;">
									<h3 style='margin-bottom:1em;'>Edit famer's details</h3>
									<form class="form-horizontal style-form edit_userinfo" method="post">
										<input type='hidden' value='<?php echo $uid;?>' id="uid">
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">First name</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='first_name' value="<?php if(isset($first_name))echo $first_name?>">
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Last name</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='last_name' value="<?php if(isset($last_name))echo $last_name?>">
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Other names</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='other_names' value="<?php if(isset($other_names))echo $other_names?>">
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Phone</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='phone' value="<?php if(isset($phone))echo $phone?>">
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Region</label>
										  <select class="form-control" style="width:42em;margin-left:10em;" id="region">
											<option value='none'>Select Region</option>
											<option value='AR' <?php if(isset($AR_selected))echo "selected";?>>Greater Accra</option>
											<option value='UE' <?php if(isset($UE_selected))echo "selected";?>>Upper East</option>
											<option value='UW' <?php if(isset($UW_selected))echo "selected";?>>Upper West</option>
											<option value='NR' <?php if(isset($NR_selected))echo "selected";?>>Northern Region</option>
											<option value='VR' <?php if(isset($VR_selected))echo "selected";?>>Volta</option>
											<option value='BA' <?php if(isset($BA_selected))echo "selected";?>>Brong Ahafo</option>
											<option value='WR' <?php if(isset($WR_selected))echo "selected";?>>Western</option>
											<option value='AS' <?php if(isset($AS_selected))echo "selected";?>>Ashanti</option>
											<option value='ER' <?php if(isset($ER_selected))echo "selected";?>>Eastern</option>
											<option value='CR' <?php if(isset($CR_selected))echo "selected";?>>Central</option>
										  </select>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">City</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='town' value="<?php if(isset($town))echo $town?>">
										  </div>
										</div>
										
										<button type="submit" class="btn btn-theme btn-lg"> Save changes</button>
										
										<div id='error_output'></div>
										<div id='success_output'></div>
										
									</form>
									</div>
								</div>
								
							</div>
							
							
							<div class='col-md-3 col-offset-3'>
							
									
							</div>
							
							<div class='col-md-9'>
								
								<div id='edit_personal_info'>
									<a name='changePassword'><h3 style='margin-bottom:1em;color:#797979;'>Associated Farms</h3></a>
									
									
									<table class="table table-striped table-advance table-hover" style="border:1px solid #eee;">
									  <thead>
									  <tr>
										  <th>Farm</th>
										  <th>Crop</th>
										  <th>Size</th>
										  <th>Irrigation</th>
										  <th></th>
									  </tr>
									  </thead>
									  <tbody>
									  <?php
										foreach($user_farm->getUserFarmsId($uid) as $user_farm_details){
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
									  <tr id='farm-list'>
										  <td><a href="editfarm&id=<?php echo $id;?>"><?php echo $farm_name;?> / (<?php echo $farm_location;?>)</a></td>
										  <td class="hidden-phone"><?php echo $crop;?></td>
										  <td><?php echo $size;?> acres</td>
										  <td><?php echo $soil_type;?></td>
										  <td>
											  <a href='editfarm&id=<?php echo $id;?>'><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
											  <button check='true' user_id="<?php echo $uid;?>" farm_id="<?php echo $farm_id;?>" class="btn btn-danger btn-xs delete_user_farm"><i class="fa fa-trash-o "></i></button>
										  </td>
									  </tr>
									  <?php
										}
									  ?>
									  </tbody>
								  </table>
									
									
									
								</div>
								
								
								
								
								<div id='edit_personal_info'>
									<a name='changePassword'><h3 style='margin-bottom:1em;color:#797979;'>Change PIN</h3></a>
									<form class="form-horizontal style-form edit_pin" method="post">
										
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">PIN</label>
										  <div class="col-sm-10">
											  <input type="password" class="form-control" placeholder="*******" id='pin'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Re-type PIN</label>
										  <div class="col-sm-10">
											  <input type="password" class="form-control" placeholder="*******" id='retype_pin'>
											  <span class="help-block">
												The PIN and Re-type PIN field can be left empty and a default PIN "<b>0101</b>" will be used as a PIN. User can later change this when he or she logs in.
											  </span>
										  </div>
										</div>
										
										<button type="submit" class="btn btn-theme btn-lg"> Change PIN</button>
										
										<div id='error_output_3'></div>
										<div id='success_output_3'></div>
										
									</form>
								</div>
								
								<?php if($loggedin_privilege == "Admin"){?>
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Delete This Account</h3>
									<input type='hidden' id='admindelete' value='true'>
									<span class="help-block">
										By clicking the "Delete Account" button, all login information about with this account will be deleted and you can't login with this login detatils anymore.
									</span>
									<button type="submit" class="btn btn-danger btn-lg delete_user"> Delete Account</button>
										
									<div id='error_output_4'></div>
								</div>
								<?php }?>
								
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
