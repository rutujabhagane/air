<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/user.class.php');
		require_once('classes/farm.class.php');
		$admin = new Admin();
		$user = new User();
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

    <title>Send Message</title>

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
	<style>
		.user_checkbox{
			display:inline-block;
			padding: 5px;
		}
	</style>
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
			//$sidebar_farmMenu =1;
			//$sidebar_addFarm =1;
			
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
							<h3 style="margin-left:1em;">Send or broadcast a message</h3>
						
							<div class='col-md-9'>
								<div id='edit_personal_info'>
									
									<?php if($user->getUsers()!= 0){?>
									<form class="form-horizontal style-form snd_message" method="post" style='margin-top:1em;'>
										
										<div class="form-group">
										  <label style="width: 20em;" class="col-sm-2 col-sm-2 control-label">Who do you want to send message to?</label>
										  <select class="form-control" style="width:45em;margin-left:1em;" id="snd_msg_q">
											<option value='allusers'>Send message to all users</option>
											<option value='selectedusers'>Send message to certain users</option>
											<option value='regions'>Send message to users in a particular region</option>
											<option value='croptype'>Send message to users with a particular crop type</option>
											<option value='irrigationtype'>Send message to users with a particular irrigation type</option>
										  </select>
										</div>
										
										
										<div class="form-group" id='msg_region_selected'>
											  <select class="form-control" style="width:45em;margin-left:1em;" id="farm_region">
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
										
										<div class="form-group" id='msg_crop_selected'>
											<select class="form-control" style="width:45em;margin-left:1em;" id="crop">
												<option value='none'>Select crop</option>
												<option value='maize'>Maize</option>
												<option value='groundnut'>Groudnut</option>
												<option value='tomato'>Tomato</option>
												<option value='millet'>Millet</option>
												<option value='pepper'>Pepper</option>
											</select>
										</div>
										
										<div class="form-group" id='msg_irrigation_selected'>
											  <select class="form-control" style="width:45em;margin-left:1em;" id="irrigation_type">
												<option value='none'>Select irrigation type</option>
												<option value='surface'>Surface</option>
												<option value='sprinkler'>Sprinkler</option>
												<option value='drip'>Drip</option>
												<option value='center'>Center pivot</option>
											  </select>
										</div>
							
										
										<div class="form-group" id='msg_users_selected'>
											<h4>Select user/users</h4>
											
											<?php foreach($user->getUsers() as $user){
												$uid = $user['uid'];
												$first_name = $user['firstname'];
												$last_name = $user['lastname'];
												$other_names = $user['othernames'];
												$phone = $user['phone'];
												if(empty($loggedin_other_names))
													$name = $first_name." ".$last_name;
												else
													$name = $first_name." ".$other_names.". ".$last_name;
											?>
											<div class='user_checkbox'>
												<input type='checkbox' class='users_selected' value='<?php echo $uid;?>'/> <?php echo $name;?> (<?php echo $phone?>)
											</div>
											<?php }?>
											
										</div>
										
										<div class="form-group">
										  <label class="col-sm-2 col-sm-2 control-label" style="font-weight:bold;">Subject</label></br></br>
										  <div class="col-sm-10">
											  <input type="text" placeholder='Message subject here' class="form-control" id='subject' maxlength='24' value="" style="width:45em;">
										  </div>
										</div>
										
										<textarea cols='99' rows='9' id='message' placeholder='Enter message here'></textarea>
										<br/><br/>
										
										<button type="submit" class="btn btn-theme btn-lg"> Send message</button>
										
										
										
										
									</form>
									<?php }else{?>
										<div style="margin:2em;" class="alert alert-warning">No users or farmers have been registered with the system yet</div>
									<?php }?>
									
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
