<?php
	require_once('../inc/inc.funcs.php');
	if(login_user()==true){
		require_once('../inc/url_routes/route_1.php');
		require_once('../classes/user.class.php');
		require_once('../classes/farm.class.php');
		require_once('../classes/user_farm.class.php');
		$user = new User();
		$farm = new Farm();
		$user_farm = new User_Farm();			
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
		<?php  require_once('../inc/inc.user.top-bar.php');?>
      <!--header end-->
      
	  
	  
      <!-- MAIN SIDEBAR MENU-->
		<!--sidebar start-->
			<?php 
				//variables for sidemenu bar highlights
				$sidebar_dashboard =1;
					
				require_once('../inc/inc.user.sidebar.php')
			?>
		<!--sidebar end-->
      
      <!-- MAIN CONTENT -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3> DASHBOARD</h3> 
			
          	<div class="row mt">
          		<div class="col-lg-12">
					
					
					
					<! -- 1st ROW OF PANELS -->
					<div class="row">
						
						<div class="form-panel">
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
										<td><a href='userreadings&id=<?php echo $id?>&farm_name=<?php echo $farm_name;?>'><?php echo $farm_name;?></a></td>
										<td><?php echo $crop;?></td>
										<td><?php echo $size;?> acres</td>
										<td><?php echo $farm_location;?></td>
									</tr>			
								<?php }?>
							</tbody>
						</table>
						</div>
						
						<!--
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="tab-pane" id="chartjs">
								<div class="col-lg-12">
									<div class="content-panel" style="height:36.2em;">
										<h4>Soil Statistics</h4>
										<div class="panel-body text-center">
										  <div id="soil_stats"></div>
										</div>
									</div>
								</div>
							</div>
						</div><! --/col-md-4 -->
							
						
						<!--
						<div class="col-lg-8 col-md-8 col-sm-8 mb">
							<div class="tab-pane" id="chartjs">
							<div class="col-lg-12">
								<div class="content-panel">
									<h4>Monthly water usage</h4>
									<div class="panel-body text-center">
										<div id="water_usage_monthly"></div>										 
									</div>
								</div>
							</div>	
							</div>
						</div><!-- /col-md-4 -->
						
						

					</div><! --/END 1ST ROW OF PANELS -->
					

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
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- <script src="assets/js/jquery.sparkline.js"></script> -->

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
	
	<!-- chart dependencies -->
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>
	
    <!--script for this page-->
	<script>
	
		Morris.Bar({
			element: 'water_usage_monthly',
			data: [
				{ y: 'Jan', a: 100},
				{ y: 'Feb', a: 75},
				{ y: 'Mar', a: 50},
				{ y: 'Apr', a: 75},
				{ y: 'May', a: 50},
				{ y: 'Jun', a: 75},
				{ y: 'Jul', a: 100},
				{ y: 'Aug', a: 30},
				{ y: 'Sep', a: 49},
				{ y: 'Oct', a: 70},
				{ y: 'Nov', a: 40},
				{ y: 'Dec', a: 100},
			],
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Monthly water usage', 'Series B']
		});
		
	
		Morris.Donut({
		  element: 'soil_stats',
		  data: [
			{label: "Wet", value: 60},
			{label: "Dry", value: 40}
		  ],
		  colors: [
			'#53a3dd',
			'#9b7653'
			],
			formatter: function (value, data) { return value + ' %'; }
		});
		
		
	</script>
    <!-- <script src="assets/js/sparkline-chart.js"></script>  --> 
    

  </body>
</html>
