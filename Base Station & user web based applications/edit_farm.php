<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/farm.class.php');
		require_once('classes/user.class.php');
		require_once('classes/user_farm.class.php');
		require_once('classes/farm_unit.class.php');
		$admin = new Admin();
		$farm = new Farm();
		$user = new User();
		$user_farm = new User_Farm();
		$farm_unit = new Farm_Unit();
		require_once('inc/loggedinadmin.php'); // Getting logged in admin's data
		
		
		if($farm->getFarmDetails($_GET['id'])){
				foreach($farm->getFarmDetails($_GET['id']) as $farm_details){
					$id = $farm_details['id'];
					$farm_name = $farm_details['farm_name'];
					$crop= $farm_details['crop'];
					$soil_type= $farm_details['soil_type'];
					$irrigation_type = $farm_details['irrigation_type'];
					$region = $farm_details['region'];
					$town = $farm_details['town'];
					$farm_size = $farm_details['size'];
					$block_id = $farm_details['block_id'];
					
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
					
					if($soil_type == "sandy"){
						$sandy_selected = true;
					}elseif($soil_type == "loamy"){
						$loamy_selected = true;
					}elseif($soil_type == "clayey"){
						$clayey_selected = true;
					}
					
					if($irrigation_type == "surface"){
						$surface_selected = true;
					}elseif($irrigation_type == "sprinkler"){
						$sprinkler_selected = true;
					}elseif($irrigation_type == "drip"){
						$drip_selected = true;
					}elseif($irrigation_type == "center"){
						$center_selected = true;
					}
					
					if($crop == "groundnut"){
						$groundnut_selected = true;
					}elseif($crop == "tomato"){
						$tomato_selected = true;
					}elseif($crop == "millet"){
						$millet_selected = true;
					}elseif($crop == "pepper"){
						$pepper_selected = true;
					}elseif($crop == "maize"){
						$maize_selected = true;
					}
					
					
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

    <title>Edit Farm Profile</title>

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
			$sidebar_farmMenu =1;
			$sidebar_viewFarms =1;
			
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
							<h3 style="margin-left:1em;">Edit Farm <i class='fa fa-angle-right'></i> <?php echo $farm_name;?></h3>
						
							<div class='col-md-9'>
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Edit farm details</h3>
									<form class="form-horizontal style-form edit_farm" method="post">
										<input type='hidden' value='<?php echo $id;?>' id="farm_id">
										<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Farm name</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='farm_name' value="<?php echo $farm_name;?>">
											  </div>
											</div>
										
										<div class="form-group">
											<label class="col-sm-2 col-sm-2 control-label">Crop</label>
											<select class="form-control" style="width:43.9em;margin-left:10em;" id="crop">
												<option value='none'>Select crop</option>
												<option value='maize' <?php if(isset($maize_selected))echo "selected";?>>Maize</option>
												<option value='groundnut' <?php if(isset($groundnut_selected))echo "selected";?>>Groudnut</option>
												<option value='tomato' <?php if(isset($tomato_selected))echo "selected";?>>Tomato</option>
												<option value='millet' <?php if(isset($millet_selected))echo "selected";?>>Millet</option>
												<option value='pepper' <?php if(isset($pepper_selected))echo "selected";?>>Pepper</option>
											</select>
										</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Size</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='size' value="<?php echo $farm_size;?>">
												  <span class="help-block">
													The size of the farm needed is in <b>acres</b>
												  </span>
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Soil Type</label>
											  <select class="form-control" style="width:43.9em;margin-left:10em;" id="soil_type">
												<option value='none'>Select soil type</option>
												<option value='sandy' <?php if(isset($sandy_selected))echo "selected";?>>Sandy</option>
												<option value='loamy' <?php if(isset($loamy_selected))echo "selected";?>>Loamy</option>
												<option value='clayey' <?php if(isset($clayey_selected))echo "selected";?>>Clayey</option>
											  </select>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Irrigation type</label>
											  <select class="form-control" style="width:43.9em;margin-left:10em;" id="irrigation_type">
												<option value='none'>Select irrigation type</option>
												<option value='surface' <?php if(isset($surface_selected))echo "selected";?>>Surface</option>
												<option value='sprinkler' <?php if(isset($sprinkler_selected))echo "selected";?>>Sprinkler</option>
												<option value='drip' <?php if(isset($drip_selected))echo "selected";?>>Drip</option>
												<option value='center' <?php if(isset($center_selected))echo "selected";?>>Center pivot</option>
											  </select>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Region</label>
											  <select class="form-control" style="width:43.9em;margin-left:10em;" id="farm_region">
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
											  <label class="col-sm-2 col-sm-2 control-label">City/Town</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='farm_town' value="<?php echo $town;?>">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Block id</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='block_id' value="<?php echo $block_id;?>">
											  </div>
											</div>
										
										
										
										<button type="submit" class="btn btn-theme btn-lg"> Save changes</button>
										
										<div id='error_output'></div>
										<div id='success_output'></div>
										
									</form>
								</div>
								
								
								<div id='edit_personal_info'>
									
										<a name='farmunits'><h3 style='margin-bottom:1em;'>Farm Units</h3></a>
										
										<?php if($farm_unit->getFarmsUnits($_GET['id']) != 0){?>
									<table class="table table-striped table-advance table-hover" style="border:1px solid #eee;">
										  <thead>
										  <tr>
											  <th>Unit Id</th>
											  <th></th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											foreach($farm_unit->getFarmsUnits($_GET['id']) as $unit_details){
												$u_id = $unit_details['id'];
												$unit_id = $unit_details['unit_id'];
												
										  ?>
										  <tr id='unit-list'>
											  <td><a href="editfarmunit&id=<?php echo $u_id;?>"><?php echo $unit_id;?> </a></td>
											  <td>
												  <a href='editfarmunit&id=<?php echo $u_id;?>'><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
												  <button row_id="<?php echo $u_id;?>" class="btn btn-danger btn-xs delete_farm_unit"><i class="fa fa-trash-o "></i></button>
											  </td>
										  </tr>
										  <?php
											}
										  ?>
										  </tbody>
									</table>
									
									<?php }else{?>
										<div style="margin-bottom:2em;">
											No Unit added to this farm
										</div>
									<?php }?>
									
									<form class="form-horizontal style-form add_farm_unit" method="post">
										<div class="form-group">
											<label class="col-sm-2 col-sm-2 control-label">Farm Unit Id</label>
											<div class="col-sm-10">
												<div class='row'>
													<input style='width:39em;float:left;' type="text" class="form-control" id='farm_unit_id'>
													
													<a style='float:right;margin-top:0.8em;font-weight:bold;' id='generate_id' href='#'>
														Generate id
													</a>
												</div>
											</div>
										</div>
										
										<button type="submit" class="btn btn-theme btn-lg"> Add Unit</button>
										
										<div id='error_output_5'></div>
										<div id='success_output_5'></div>
										
									</form>
									
								</div>
								
								
								
								<div id='edit_personal_info'>
									<a name='assofarmers'><h3 style='margin-bottom:1em;color:#797979;'>Associated farmers</h3></a>
									
									<?php if($user_farm->getUserOfFarm($id) != 0){?>
									<table class="table table-striped table-advance table-hover" style="border:1px solid #eee;">
										  <thead>
										  <tr>
											  <th>Name</th>
											  <th>Location</th>
											  <th>Phone</th>
											  <th></th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											foreach($user_farm->getUserOfFarm($id) as $user_farm_details){
												$uid = $user_farm_details['user_id'];
												foreach($user->getUserDetailsWithUid($uid) as $userFetched){
													$user_id = $userFetched['id'];
													$user_name = $userFetched['firstname']." ".$userFetched['othernames'].". ".$userFetched['lastname'];
													$user_location  = $userFetched['region']." / ".$userFetched['town'];
													$phone = $userFetched['phone'];
												}
										  ?>
										  <tr id='farm-list'>
											  <td><a href="edituser&id=<?php echo $user_id;?>"><?php echo $user_name;?> </a></td>
											  <td class="hidden-phone"><?php echo $user_location;?></td>
											  <td><?php echo $phone;?></td>
											  <td>
												  <a href='edituser&id=<?php echo $user_id;?>'><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
												  <button check='false' user_id="<?php echo $uid;?>" farm_id="<?php echo $id;?>" class="btn btn-danger btn-xs delete_user_farm"><i class="fa fa-trash-o "></i></button>
											  </td>
										  </tr>
										  <?php
											}
										  ?>
										  </tbody>
									</table>
									<div class="alert alert-info"><b>If you delete a user or user having one farm association, that user will also be deleted. Click the user to check if multiple farms are associated to it.</b></div>
									<?php }else{?>
										<div style="margin-bottom:2em;">
											No farmers are associated with this farm profile
										</div>
									<?php }?>
									<form class="form-horizontal style-form add_user_farm" method="post">
										<div class="form-group" id=''>
											  <label style="width: 20em;" class="col-sm-2 col-sm-2 control-label">Add a farmer to this farm profile </label>
											  
											  <select class="form-control" style="width:45em;margin-left:1em;" id="farmer_selected">
												<option value='none'>Select a farmer</option>
												<?php
														if($user->getUsers()!=0){
															foreach ($user->getUsers() as $key => $value) {
																$uid = $value['uid'];
																$name = $value['firstname']." ".$value['othernames'].".".$value['lastname'];
																$location = $value['region']."/".$value['town'];
																$phone = $value['phone'];
																echo "<option value='$uid'>$name ($location - $phone)</option>";
															}
														}
													
												?>
			
											  </select>
												
												</br>
												<button style="margin-left:1em;" type="submit" class="btn btn-theme btn-lg"> Add farmer</button>
											
												<div id='error_output_2'></div>
												<div id='success_output_2'></div>
											  
										</div>
									</form>
								</div>
								
								
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Delete Farm Profile</h3>
									<input type='hidden' id='admindelete' value='true'>
									<span class="help-block">
										By clicking the "Delete This Profile" button, you will be deleting the farm profile and wont be able to access components and or system associated with this profile.
									</span>
									<button type="submit" class="btn btn-danger btn-lg delete_farm"> Delete This Profile</button>
										
									<div id='error_output_4'></div>
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
