<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/farm.class.php');
		require_once('classes/user.class.php');
		require_once('classes/farm_unit.class.php');
		$admin = new Admin();
		$farm = new Farm();
		$user = new User();
		$farm_unit = new Farm_Unit();
		require_once('inc/loggedinadmin.php'); // Getting logged in admin's data
		
		if(isset($_GET['id'])){
			if($farm->getFarmDetails($_GET['id']) == 0){
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

    <title>Farm Stats</title>

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
							
							<div class="content-panel">
								<h3 style="margin-left:1em;">Farm Statistics</h3>
								
								<?php if($farm_unit->getFarmsUnits($_GET['id']) != 0){?>
								<div class="form-group">
									<input type='hidden' value='<?php echo $_GET['id']?>' id='thefarmid'>
									<label style="width: 20em;text-align:right;margin-top:0.9em;" class="col-sm-2 col-sm-2 control-label">Get data from?</label>
									<select class="form-control" style="width:45em;margin-left:1em;" id="show_graph_duration">
										<option value='none'>Select duration</option>
										<option value='today'>Today</option>
										<option value='week'>Last 7 days</option>
										<option value='monthly'>Monthly data</option>
										<option value='yearly'>Yearly</option>
									</select>
								</div>
								<?php }else{?>
									<div style="margin:2em;" class="alert alert-warning">This farm has no farm unit installed  <a href="editfarm&id=<?php echo $_GET['id']?>#farmunits" target='_blank'><button class='btn btn-small btn-theme'>Add unit to farm</button></a></div>
								<?php }?>
								
								
							</div>
							
							<!-- Today's stats -->
							<div class='col-md-12' id='today_stats'>
							
								<div class="tab-pane" id="chartjs" style='margin-top:1px solid black;'>
									<div class="row mt" >
										
									  <div class="col-lg-6">
										  <div class="content-panel">
											  <h4><i class="fa fa-angle-right"></i> Today's Moisture Readings</h4>
											  <div class="panel-body text-center">						
											
												<div id="today-moisture-sensor-readings"></div>

											  </div>
										  </div>
										  
									  </div>
									  
										<div class="col-lg-6">
										  <div class="content-panel">
											  <h4><i class="fa fa-angle-right"></i> Today's Temperature Readings</h4>
											  <div class="panel-body text-center">						
												
													<div id="today-temperature-sensor-readings"></div>
												
											  </div>
										  </div>
										</div>

									</div>
		
								</div>
								
								
								<div class="tab-pane" id="chartjs" style='margin-top:1px solid black;'>
									<div class="row mt">
									
									  <div class="col-lg-12">
										  <div class="content-panel">
											  <h4><i class="fa fa-angle-right"></i> Today's Moisture & Temperature Readings</h4>
											  <div class="panel-body text-center">						
												 
													<div id="today-moisturetemperature-sensor-readings"></div>
												
											  </div>
										  </div>	  
									  </div>		  
									</div>
								</div>
								

							</div>
							<!-- End of today's stats-->
							
							<!-- Monthly stats -->
							<div class='col-md-12' id='interval_stats'>
							
								<div class="tab-pane" id="chartjs" style='margin-top:1px solid black;'>
									<div class="row mt" >
										
									  <div class="col-lg-6">
										  <div class="content-panel">
											  <h4><i class="fa fa-angle-right"></i>Average Moisture Readings</h4>
											  <div class="panel-body text-center">						
											
												<div id="interval-moisture-sensor-readings"></div>

											  </div>
										  </div>
										  
									  </div>
									  
										<div class="col-lg-6">
										  <div class="content-panel">
											  <h4><i class="fa fa-angle-right"></i>Average Temperature Readings</h4>
											  <div class="panel-body text-center">						
												
													<div id="interval-temperature-sensor-readings"></div>
												
											  </div>
										  </div>
										</div>

									</div>
		
								</div>
								
								
								<!-- Here for full-->
								<div class="tab-pane" id="chartjs" style='margin-top:1px solid black;'>
									<div class="row mt">
									
									  <div class="col-lg-12">
										  <div class="content-panel">
											  <h4><i class="fa fa-angle-right"></i>Average Moisture & Temperature Readings</h4>
											  <div class="panel-body text-center">						
												 
													<div id="interval-moisturetemperature-sensor-readings"></div>
												
											  </div>
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
	
    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
	<script type="text/javascript" src="assets/js/core.js"></script>
    <!--script for this page-->
	<script type="text/javascript" src="assets/js/filestyle.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
     <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>

  </body>
</html>
