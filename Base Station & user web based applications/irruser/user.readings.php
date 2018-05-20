<?php
	require_once('../inc/inc.funcs.php');
	if(login_user()==true){
		
			require_once('../inc/url_routes/route_1.php');
			require_once('../classes/user.class.php');
			require_once('../classes/user_farm.class.php');
			require_once('../classes/farm.class.php');
			require_once('../classes/farm_unit.class.php');
			require_once('../classes/moisture_sensor.class.php');
			require_once('../classes/temperature_sensor.class.php');
			$user = new User();
			$user_farm = new User_Farm();
			$farm_unit = new Farm_Unit();
			$moisture_sensor = new MoistureSensor();
			$temperature_sensor = new TemperatureSensor();
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

    <title>Readings</title>

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
			$sidebar_dashboard =1;
					
			require_once('../inc/inc.user.sidebar.php')
		?>
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          	<div class="row mt">
          		<div class="col-lg-12">
					
					<div class="form-panel">
							<h2><?php echo $_GET['farm_name'];?></h2>
							<div id='edit_personal_info'>
							
								<?php
									if($farm_unit->getFarmsUnits($_GET['id']) != 0){
										foreach($farm_unit->getFarmsUnits($_GET['id']) as $unit_details){
											$u_id = $unit_details['id'];
											$unit_id = $unit_details['unit_id'];
											
											$has_moisture_readings = $moisture_sensor->getReadings($unit_id);
											$moisture_readings = $moisture_sensor->getReadings($unit_id)['reading'];
											$m_date = $moisture_sensor->getReadings($unit_id)['date'];
											
											
											$has_temperature_readings = $temperature_sensor->getReadings($unit_id);
											$temperature_readings = $temperature_sensor->getReadings($unit_id)['reading'];
											$t_date = $temperature_sensor->getReadings($unit_id)['date'];
										}
								?>
								
								
								<div class="row mt">
									<?php if($has_moisture_readings != 0){ ?>
										<h5 style='text-align:center;margin-bottom:1em;'>Farm watered <b><?php echo time_ago($m_date);?></b></h5>	
									<?php }?>
									
									<div class="col-lg-6">
									  <div class="content-panel">
										  <h4><i class='fa fa-tint'></i> Moisture sensor (Percentage)</h4>
										  <div class="panel-body text-center">
											
											<?php if($has_moisture_readings != 0) {?>
									
												<h5><?php echo $m_date;?></h5>
												<h5><?php echo $moisture_readings;?></h5>
			
											<?php }else{?>
												<p style="font-size:1.5em;border:1px solid #eee;padding:1em;">
													No moisture readings from this farm
												</p>
											<?php }?>
											
											
											
										  </div>
									  </div>
									</div>
									<div class="col-lg-6">
									  <div class="content-panel">
										  <h4><i class='fa fa-thermometer'></i> Temperature sensor (Degrees Celcius)</h4>
										  <div class="panel-body text-center">
											
											
											<?php if($has_temperature_readings != 0) {?>

												<h5><?php echo $t_date;?></h5>
												<h5><?php echo $temperature_readings;?></h5>
							
											<?php }else{ ?>
												<p style="font-size:1.5em;border:1px solid #eee;padding:1em;">
													No temperature readings from this farm
												</p>
											<?php }?>
											

										  </div>
									  </div>
									</div>
									
								</div>
								
							
								
								
								<?php
									}else{
								?>
									<p style="margin-top:1em;font-size:1.5em;">
										This farm has no farm units associated to it
									</p>							
								<?php }?>
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
