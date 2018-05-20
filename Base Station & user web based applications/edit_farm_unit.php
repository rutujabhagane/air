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
		
		
		if($farm_unit->getFarmsUnitDetails($_GET['id'])){
				foreach($farm_unit->getFarmsUnitDetails($_GET['id']) as $unit_details){
					$id = $unit_details['id'];		
					$farm_unit_id = $unit_details['unit_id'];					
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
							<h3 style="margin-left:1em;">Edit Farm Unit <i class='fa fa-angle-right'></i> <?php echo $farm_unit_id;?></h3>
						
							<div class='col-md-9'>
								<div id='edit_personal_info'>
									<h3 style='margin-bottom:1em;'>Edit farm details</h3>
									<form class="form-horizontal style-form edit_farm_unit" method="post">
										<input type='hidden' value='<?php echo $_GET['id'];?>' id="id">
										<div class="form-group">
											  <label class="col-sm-2 col-sm-2 control-label">Farm unit id</label>
											  <div class="col-sm-10">
												  <input type="text" class="form-control" id='farm_unit_id' value="<?php echo $farm_unit_id;?>">
											  </div>
											</div>
										

										<button type="submit" class="btn btn-theme btn-lg"> Make change</button>
										
										<div id='error_output'></div>
										<div id='success_output'></div>
										
									</form>
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
