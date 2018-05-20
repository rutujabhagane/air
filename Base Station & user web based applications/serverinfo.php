<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/system.class.php');
		$admin = new Admin();
		$system = new System();
		require_once('inc/loggedinadmin.php'); // Getting logged in admin's data
		
		
		$getUsedDatabaseSizeOverall = $system->getUsedDatabaseSizeOverall()["SIZE"];
		$used_space_percentage = ($getUsedDatabaseSizeOverall/$MYSQL_DB_TOTAL_SIZE)*100;
		$free_space_percentage = 100 - $used_space_percentage;
		
	}else{
		die("<script>location.href = 'adminlogin'</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Server Information</title>

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
		<?php  require_once('inc/inc.top-bar.php');?>
      <!--header end-->
	 
      
		<!--sidebar start-->  
		<?php
			//variables for sidemenu bar highlights
			//
			
			require_once('inc/inc.sidebar.php')
		?>          
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<div class="row mt">
                  <div class="col-lg-12">
                      <div class="content-panel">
                        <h4>Overall system space: <b><?php echo $MYSQL_DB_TOTAL_SIZE?> MB</b> </h4>
						<h4>space used: <b><?php echo $getUsedDatabaseSizeOverall ?> MB</b> </h4> 
                      </div><!-- /content-panel -->
					  
					  
						<div class="tab-pane" id="chartjs">
							<div class="row mt">
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4> Overall System</h4>
									  <div class="panel-body text-center">
										  <div id="overall-sys"></div>
									  </div>
								  </div>
							  </div>
							  <div class="col-lg-6">
								  <div class="content-panel">
									  <h4>Tables</h4>
									  <div class="panel-body text-center">
										 <div id="individual-sys"></div>
									  </div>
								  </div>
							  </div>
							</div>
						</div>
					  
					  
					  
					  
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
			
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
	<script type="text/javascript" src="assets/js/main.js"></script>
    <!--script for this page-->
    <script type="text/javascript" src="assets/js/core.js"></script>
	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
	<script>
		Morris.Donut({
		  element: 'overall-sys',
		  data: [
			{label: "% Used", value: <?php echo $used_space_percentage;?>},
			{label: "% Free", value: <?php echo $free_space_percentage;?>}
		  ],
		  colors: [
			'#d9534f',
			'#449d44'
			]
		});
		
		Morris.Donut({
		  element: 'individual-sys',
		  data: [
			<?php 
				foreach($system->getUsedDatabaseSize() as $db){
					$table_name = $db['Table'];
					$table_size = $db['SIZE'];
			?>
			{label: "<?php echo $table_name;?>", value: <?php echo $table_size;?>},
			<?php
				}
			?>
		  ],
		  colors: [
			'#d9534f',
			'#9b59b6',
			'#34495e',
			'#584a5e',
			'#3498db'
			],
			formatter: function (value, data) { return value + ' MB'; }
		});
	</script>
  </body>
</html>
