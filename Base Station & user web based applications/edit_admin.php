<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		if(isset($_GET['id'])){
			require_once('inc/url_routes/route_1.php');
			require_once('classes/admin.class.php');
			$admin = new Admin();
			
			require_once('inc/loggedinadmin.php'); // Getting logged in admin's data
			
			if($admin->getAdminDetails($_GET['id'])){
				foreach($admin->getAdminDetails($_GET['id']) as $admin_details){
					$uid = $admin_details['uid'];
					$username = $admin_details['username'];
					$first_name = $admin_details['firstname'];
					$last_name = $admin_details['lastname'];
					$other_names = $admin_details['othernames'];
					$email = $admin_details['email'];
					$profile_pic = $admin_details['profile_pic'];
					$privilege = $admin_details['title'];
					if($privilege == "Admin"){
						$admin_selected = true;
					}elseif($privilege == "Manager"){
						$manager_selected = true;
					}
					if($profile_pic != "assets/img/default_profile.png"){
						$profile_pic = "data/admin_data/covers/".$profile_pic;
					}
					if(empty($other_name))
						$name = $first_name." ".$last_name;
					else
						$name = $first_name." ".$other_names.". ".$last_name;
				}
			}else{
				die("<script>location.href = '404'</script>");
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

    <title>Edit Admin</title>

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
			$sidebar_viewAdmins =1;
			
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
							<h3 style="margin-left:1em;">Edit administrator <i class='fa fa-angle-right'> <?php echo $name;?></i></h3>
							
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
									<h3 style='margin-bottom:1em;'>Edit administrator details</h3>
									<form class="form-horizontal style-form edit_admininfo" method="post">
										<input type='hidden' value='<?php echo $uid;?>' id="uid">
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Username</label>
										  <div class="col-sm-10">
											  <input type="text" class="form-control" id='username' value="<?php if(isset($username))echo $username?>">
										  </div>
										</div>
										
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
										  <label class="col-sm-2 col-sm-2 control-label">Email</label>
										  <div class="col-sm-10">
											  <input type="email" class="form-control" id='email' value="<?php if(isset($email))echo $email?>">
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
									<h3 style='margin-bottom:1em;'>Change privilege</h3>
									<form class="form-horizontal style-form edit_privelege" method="post">
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Privilege</label>
										  <select class="form-control" style="width:45em;" id="title">
											<option value='none'>Select privelege</option>
											<option value='Admin' <?php if(isset($admin_selected))echo "selected";?>>Administrator</option>
											<option value='Manager' <?php if(isset($manager_selected))echo "selected";?>>Manager</option>
										  </select>
										</div>
										
										
										<button type="submit" class="btn btn-theme btn-lg"> Change privilege</button>
										
										<div id='error_output_2'></div>
										<div id='success_output_2'></div>
										
									</form>
								</div>
								
								
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Change password</h3>
									<form class="form-horizontal style-form edit_password" method="post">
										
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Password</label>
										  <div class="col-sm-10">
											  <input type="password" class="form-control" placeholder="*******" id='password'>
										  </div>
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label">Re-type password</label>
										  <div class="col-sm-10">
											  <input type="password" class="form-control" placeholder="*******" id='retype_password'>
											  <span class="help-block">
												If the password and Re-type password filds are left empty a default password "<b>airsysadmin1</b>" will be used as a password. User can later change this when he or she logs in. 
											  </span>
										  </div>
										</div>
										
										<button type="submit" class="btn btn-theme btn-lg"> Change password</button>
										
										<div id='error_output_3'></div>
										<div id='success_output_3'></div>
										
									</form>
								</div>
								
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Delete Administrator</h3>
									<span class="help-block">
										By clicking the "Delete Administrator" button, all login information about this user will be deleted and can't login with this login detatils anymore.
									</span>
									<button type="submit" class="btn btn-danger btn-lg delete_admin"> Delete Administrator</button>
										
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
