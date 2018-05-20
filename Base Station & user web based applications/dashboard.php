<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/user.class.php');
		require_once('classes/system.class.php');
		require_once('classes/farm.class.php');
		$admin = new Admin();
		$user = new User();
		$system = new System();
		$farm = new Farm();
		$number_of_users = $user->getNumberOfUsers()["COUNT(*)"];
		$number_of_farms = $farm->getNumberOfFarms()["COUNT(*)"];
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

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

 
	  <!-- Top bar & notification -->	
      <!--header start-->
		<?php  require_once('inc/inc.top-bar.php');?>
      <!--header end-->
      
	  
	  
      <!-- MAIN SIDEBAR MENU-->
		<!--sidebar start-->
			<?php 
				//variables for sidemenu bar highlights
				$sidebar_dashboard =1;
					
				require_once('inc/inc.sidebar.php')
			?>
		<!--sidebar end-->
      
      <!-- MAIN CONTENT -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3> DASHBOARD</h3> 
			<span>
				You are currently logged in as <b><?php echo $loggedin_username;?></b>  
				<span class='label label-success'><?php echo $loggedin_privilege;?></span>
			</span>
          	<div class="row mt">
          		<div class="col-lg-12">
          		
					<! -- 1st ROW OF PANELS -->
					<div class="row">
						
						<?php if($loggedin_privilege == "Admin"){?>
						<!-- Administrating other admins -->
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="steps pn">
							    <a href='<?php echo VIEWADMINS_URL;?>'><label for='op1'>View administrators</label></a>
							    <a href='<?php echo ADDADMIN_URL?>'><label for='op2'>Add Administrator</label></a>
								<a href='<?php echo EDITPROFILE_URL?>'><label for='op2'>Edit your profile</label></a>
							    <a href='<?php echo EDITPROFILE_URL;?>#changePassword'><label for='op3'>Change password</label></a>
							</div>
						</div><!-- /col-md-4 -->
						<?php }else{ ?>
							
							<div class="col-lg-4 col-md-4 col-sm-4 mb">
								<div class="content-panel pn">
									<div id="profile-02">
										<div class="user">
											<img src="<?php if(isset($loggedin_profile_pic))echo $loggedin_profile_pic;?>" class="img-circle" width="80" style="border:1px solid #eee">
											<h4><?php if(isset($loggedin_name))echo $loggedin_name;?></h4>
										</div>
									</div>
									<div class="centered" style='padding-top:1.3em;'>
										<a href="<?php echo PROFILE_URL;?>">VIEW YOUR PROFILE</a>
									</div>
								</div><! --/panel -->
							</div><! --/col-md-4 -->
							
						<?php }?>
						
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<!-- Users -->
							<a href='<?php echo VIEWFARMERS_URL;?>'>
								<div class="darkblue-panel pn">
									<div class="darkblue-header">
										<h5>Farmers</h5>
									</div>
									<h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
									<p><?php echo $number_of_users;?> Farmers</p>
									<footer>
										<div class="centered">
											<h5><i class="fa fa-eye"></i> View farmers</h5>
										</div>
									</footer>
								</div>
							</a>
						</div><!-- /col-md-4 -->
						
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<!-- INSTAGRAM PANEL -->
							<div class="instagram-panel pn">
								<i class="fa fa-tree fa-4x"></i></br></br>
								<p>No of farms: <?php echo $number_of_farms;?><br/>
								<p>Crop Types: 5<br/>
								<p>Units #: 100<br/>
								</p>
								<a href='<?php echo VIEWFARMS_URL;?>'><p style='font-weight:bold;font-size:14px;'><i class="fa fa-eye"></i> View farm sections</p></a>
							</div>
						</div><!-- /col-md-4 -->
					</div><! --/END 1ST ROW OF PANELS -->
					
					<! -- 2ND ROW OF PANELS -->
					<div class="row">
						<! -- Server information -->
						<a href='<?php echo SERVERINFO_URL;?>'>
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="green-panel pn">
					  			<div class="green-header">
						  			<h5>Server Information</h5>
					  			</div>
								<canvas id="serverstatus03" height="120" width="120"></canvas>
								<?php
									$getUsedDatabaseSizeOverall = $system->getUsedDatabaseSizeOverall()["SIZE"];
									$used_space_percentage = ($getUsedDatabaseSizeOverall/$MYSQL_DB_TOTAL_SIZE)*100;
									$free_space_percentage = 100 - $used_space_percentage;
								?>
								<script>
									var doughnutData = [
											{
												value: <?php echo $used_space_percentage;?>,
												color:"#2b2b2b"
											},
											{
												value : <?php echo $free_space_percentage;?>,
												color : "#fffffd"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
								</script>
								<h3><?php echo $used_space_percentage;?>% USED</h3>
					  		</div>
						</div><! --/col-md-4 -->
						</a>
						
						<! -- PROFILE 01 PANEL -->
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="steps pn">
							    <a href='<?php echo ADDFARMER_URL;?>'><label for='op1'>Add user/farmer</label></a>
								<a href='<?php echo	VIEWFARMERS_URL;?>'><label for='op2'>View users/farmers</label></a>
							    <a href='<?php echo	ADDFARM_URL;?>'><label for='op2'>Add farm profile</label></a>
							    <a href='<?php echo	VIEWFARMS_URL;?>'><label for='op3'>View farm profiles</label></a>
							</div>
						</div><! --/col-md-4 -->
						
						<!-- Generate & download report -->
						<a href='<?php echo REPORT_URL;?>'>
							<div class="col-lg-4 col-md-4 col-sm-4 mb">
								<div class="product-panel-2 pn">
									<div style="padding-top: 6em;">
										<h5 class="mt">Get system report</h5>
										<h6>Date: <?php echo date('Y/m/d H:i:s');?></h6>
										<button class="btn btn-small btn-theme04">View system report</button>
									</div>
								</div>
							</div><! --/col-md-4-->
						</a>
						
						
						
					</div><! --/END 2ND ROW OF PANELS -->
					
					<! -- 3RD ROW OF PANELS -->
					<!-- Profile -->
					<div class="row">
						<?php if($loggedin_privilege=="Admin"){?>
							<div class="col-lg-4 col-md-4 col-sm-4 mb">
								<div class="content-panel pn">
									<div id="profile-02">
										<div class="user">
											<img src="<?php if(isset($loggedin_profile_pic))echo $loggedin_profile_pic;?>" class="img-circle" width="80" style="border:1px solid #eee">
											<h4><?php if(isset($loggedin_name))echo $loggedin_name;?></h4>
										</div>
									</div>
									<div class="centered" style='padding-top:1.3em;'>
										<a href="<?php echo PROFILE_URL;?>">VIEW YOUR PROFILE</a>
									</div>
								</div><! --/panel -->
							</div><! --/col-md-4 -->
						<?php }?>
						
						<!-- Generate & download report -->
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="product-panel-2 pn">
								<div style="padding-top: 6em;">
									<h5 class="mt">Send a message to a user or broadcast a message</h5>
									</br>
									<a href='<?php echo SENDMSG_URL;?>'><button class="btn btn-small" style='background-color:#00A572;color:white;'>Send a message</button></a>
								</div>
							</div>
						</div><! --/col-md-4-->
						
						<!-- new panel -->
					
					</div><! -- END 3RD ROW OF PANELS -->
          		
					
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
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
