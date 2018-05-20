<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/farm.class.php');
		require_once('classes/user.class.php');
		require_once('classes/farm_unit.class.php');
		require_once('classes/moisture_sensor.class.php');
		require_once('classes/temperature_sensor.class.php');
		$admin = new Admin();
		$farm = new Farm();
		$user = new User();
		$farm_unit= new Farm_Unit();
		$moisture_sensor = new MoistureSensor();
		$temperature_sensor = new TemperatureSensor();
		
		//Irrigation Type
		if($farm->getNumberOfFarms()["COUNT(*)"] > 0){
			$percentage_of_surface_farms = ($farm->getNumberOfFarmsIrrigationType("surface")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			$percentage_of_sprinkler_farms = ($farm->getNumberOfFarmsIrrigationType("sprinkler")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;;
			$percentage_of_drip_farms = ($farm->getNumberOfFarmsIrrigationType("drip")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			$percentage_of_center_farms = ($farm->getNumberOfFarmsIrrigationType("center")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			
			//soil Type
			$percentage_of_sandy_farms = ($farm->getNumberOfFarmsSoilType("sandy")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			$percentage_of_loamy_farms = ($farm->getNumberOfFarmsSoilType("loamy")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;;
			$percentage_of_clayey_farms = ($farm->getNumberOfFarmsSoilType("clayey")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
		
			//crop types
			$percentage_of_maize_farms = ($farm->getNumberOfFarmsCultivatingCrop("maize")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			$percentage_of_groundnut_farms = ($farm->getNumberOfFarmsCultivatingCrop("groundnut")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;;
			$percentage_of_tomato_farms = ($farm->getNumberOfFarmsCultivatingCrop("tomato")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			$percentage_of_millet_farms = ($farm->getNumberOfFarmsCultivatingCrop("millet")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
			$percentage_of_pepper_farms = ($farm->getNumberOfFarmsCultivatingCrop("pepper")["COUNT(*)"]/$farm->getNumberOfFarms()["COUNT(*)"])*100;
		}
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

    <title>Report</title>

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
				$sidebar_report =1;
				
					
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
							<h3 style="margin-left:1em;">Report</h3>
							
							
							<div class='col-md-9'>
							
							
							
							<table class="table table-bordered  table-condensed" style='margin-left:1em;'>
                           
							  
                              <tbody>
                              <tr>
                                  <td><a href='viewusers'>Number of farmers</a></td>
                                  <td><?php echo $user->getNumberOfUsers()["COUNT(*)"];?></td>
                              </tr>
							  
							  <tr>
                                  <td><a href='viewfarms'>Number of farm sections</a></td>
                                  <td><?php echo $farm->getNumberOfFarms()["COUNT(*)"];?></td>
                              </tr>
							
							  <tr>
                                  <td>Number of farm units</td>
                                  <td><?php echo $farm_unit->getNumberOfFarmsUnits()["COUNT(*)"];?></td>
                              </tr>
							  
							  <tr>
                                  <td><a href='viewadmins'>Number of administrators</a></td>
                                   <td><?php echo $admin->getNumberOfAdmin()["COUNT(*)"];?></td>
                              </tr>
                              
                              </tbody>
                          </table>
							
							
							
							
							
						
							</div>
							
						</div>
					</div>
					
					
					<div class="content-panel" style="margin-top:1em;">
						<div class='row'>
							<h3 style="margin-left:1em;">Data Report</h3>
							
							
							<div class='col-md-9'>
							
							<table class="table table-bordered  table-condensed" style='margin-left:1em;'>
								<thead>
		                          <tr>
		                              <th>Farm name</th>
									  <th>Location</th>
		                              <th>Unit Id</th>
		                              <th>Moisture Readings(% of water)</th>
									  <th>Temperature Readings(Degrees Celcius)</th>
									  <th>Date</th>
		                          </tr>
		                        </thead>
							  
                              <tbody>
							  <?php
							  
								foreach($moisture_sensor->getAllMoistureReadings() as $readings){
									$the_id = $readings['id'];
									$unit_id = $readings['unit_id'];
									$m_reading = $readings['reading'];
									$date = $readings['date'];
									$t_readings = $temperature_sensor->getReadingsWithId($the_id)['reading'];
									foreach($farm->getUserFarms($farm_unit->getFarmsUnitFarmId($unit_id)) as $farm_details){
										$farm_name = $farm_details['farm_name'];
										$location = $farm_details['region']." / ".$farm_details['town'];
									}
							  ?>
							  
							  
							  
                              <tr>
                                  <td><?php echo $farm_name?></td>
								  <td><?php echo $location?></td>
								  <td><?php echo $unit_id?></td>
								  <td><?php echo $m_reading?></td>
								  <td><?php echo $t_readings?></td>
								  <td><?php echo $date?></td>
                              </tr>
								<?php }?>
                              
                              </tbody>
                          </table>
							
							
							
							
							
						
							</div>
							
						</div>
					</div>
					
					
					
					

					<div class="tab-pane" id="chartjs">
							<div class="row mt">
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Percentage of crop farms</h4>
									  <div class="panel-body text-center">
										  <div id="percentage_crop_farms"></div>
									  </div>
								  </div>
							  </div>
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Crop farms</h4>
									  <div class="panel-body text-center">
										 
										<table class="table table-bordered  table-condensed" >
                           
							  
											  <tbody>
											  <tr>
												  <td style='text-align:left;'>Number of maize farms</td>
												  <td><?php echo $farm->getNumberOfFarmsCultivatingCrop("maize")["COUNT(*)"];?></td>
											  </tr>
											  
											  <tr>
												  <td style='text-align:left;'>Number of groundnut farms</td>
												  <td><?php echo $farm->getNumberOfFarmsCultivatingCrop("groundnut")["COUNT(*)"];?></td>
											  </tr>
											
											  <tr>
												  <td style='text-align:left;'>Number of tomato farms</td>
												  <td><?php echo $farm->getNumberOfFarmsCultivatingCrop("tomato")["COUNT(*)"];?></td>
											  </tr>
											  
											  <tr>
												  <td style='text-align:left;'>Number of millet farms</td>
												   <td><?php echo $farm->getNumberOfFarmsCultivatingCrop("millet")["COUNT(*)"];?></td>
											  </tr>
											  
											  <tr>
												  <td style='text-align:left;'>Number of pepper farms</td>
												   <td><?php echo $farm->getNumberOfFarmsCultivatingCrop("pepper")["COUNT(*)"];?></td>
											  </tr>
											  
											  </tbody>
										</table>
										 
										 
										 
										 
									  </div>
								  </div>
							  </div>
							</div>
					</div>
					
					
					<div class="tab-pane" id="chartjs">
							<div class="row mt">
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Percentage of farms using specific irrigation type</h4>
									  <div class="panel-body text-center">
										  <div id="percentage_irrigationtype_farms"></div>
									  </div>
								  </div>
							  </div>
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Number of farms using specific Irrigation type</h4>
									  <div class="panel-body text-center">
										 
										<table class="table table-bordered  table-condensed" >
                           
							  
											  <tbody>
											  <tr>
												  <td style='text-align:left;'>Surface Irriagion</td>
												  <td><?php echo $farm->getNumberOfFarmsIrrigationType("surface")["COUNT(*)"];?></td>
											  </tr>
											  
											  <tr>
												  <td style='text-align:left;'>Sprinkler Irrigation</td>
												  <td><?php echo $farm->getNumberOfFarmsIrrigationType("sprinkler")["COUNT(*)"];?></td>
											  </tr>
											
											  <tr>
												  <td style='text-align:left;'>Drip Irrigation</td>
												  <td><?php echo $farm->getNumberOfFarmsIrrigationType("drip")["COUNT(*)"];?></td>
											  </tr>
											  
											  <tr>
												  <td style='text-align:left;'>Center Irrigation</td>
												   <td><?php echo $farm->getNumberOfFarmsIrrigationType("center")["COUNT(*)"];?></td>
											  </tr>
											  
											  </tbody>
										</table>
										 
										 
										 
										 
									  </div>
								  </div>
							  </div>
							</div>
					</div>
					
					
					<div class="tab-pane" id="chartjs">
							<div class="row mt">
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Percentage of farms with specific soil type</h4>
									  <div class="panel-body text-center">
										  <div id="percentage_soiltype_farms"></div>
									  </div>
								  </div>
							  </div>
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Number of farms with specific Irrigation type</h4>
									  <div class="panel-body text-center">
										 
										<table class="table table-bordered  table-condensed" >
                           
							  
											  <tbody>
											  <tr>
												  <td style='text-align:left;'>Sandy Soil</td>
												  <td><?php echo $farm->getNumberOfFarmsSoilType("sandy")["COUNT(*)"];?></td>
											  </tr>
											  
											  <tr>
												  <td style='text-align:left;'>Loamy Soil</td>
												  <td><?php echo $farm->getNumberOfFarmsSoilType("loamy")["COUNT(*)"];?></td>
											  </tr>
											
											  <tr>
												  <td style='text-align:left;'>Calayey Soil</td>
												  <td><?php echo $farm->getNumberOfFarmsSoilType("clayey")["COUNT(*)"];?></td>
											  </tr>
											  
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

	<!-- chart dependencies -->
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>
	
	<script>
		Morris.Donut({
		  element: 'percentage_crop_farms',
		  data: [
			{label: "% Maize farms", value: <?php echo $percentage_of_maize_farms;?>},
			{label: "% Groundnut farms", value: <?php echo $percentage_of_groundnut_farms;?>},
			{label: "% Tomato farms", value: <?php echo $percentage_of_tomato_farms;?>},
			{label: "% Millet farms", value: <?php echo $percentage_of_millet_farms;?>},
			{label: "% Pepper farms", value: <?php echo $percentage_of_pepper_farms;?>}
		  ],
		  colors: [
			'#CB4335',
			'#9B59B6',
			'#2980B9',
			'#1ABC9C',
			'#F1C40F',
			'#E67E22'
			]
		});
		
		Morris.Donut({
		  element: 'percentage_irrigationtype_farms',
		  data: [
			{label: "% Surface farms", value: <?php echo $percentage_of_surface_farms;?>},
			{label: "% Sprinkler farms", value: <?php echo $percentage_of_sprinkler_farms;?>},
			{label: "% Drip farms", value: <?php echo $percentage_of_drip_farms;?>},
			{label: "% Center farms", value: <?php echo $percentage_of_center_farms;?>},
		  ],
		  colors: [
			'#784212',
			'#0B5345',
			'#5B2C6F',
			'#E67E22'
			]
		});
		
		Morris.Donut({
		  element: 'percentage_soiltype_farms',
		  data: [
			{label: "% Sand soil farms", value: <?php echo $percentage_of_sandy_farms;?>},
			{label: "% Loamy soil farms", value: <?php echo $percentage_of_loamy_farms;?>},
			{label: "% Clayey farms", value: <?php echo $percentage_of_clayey_farms;?>},
		  ],
		  colors: [
			'#641E16',
			'#9C640C',
			'#F4D03F'
			]
		});
		
	</script>
	
    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
	<script type="text/javascript" src="assets/js/core.js"></script>
    <!--script for this page-->
	<script type="text/javascript" src="assets/js/filestyle.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
     <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>

  </body>
</html>
