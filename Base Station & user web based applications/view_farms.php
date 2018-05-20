<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		require_once('classes/user.class.php');
		require_once('classes/farm.class.php');
		require_once('classes/user_farm.class.php');
		require_once('classes/farm_unit.class.php');
		require_once('classes/water_need.class.php');
		$admin = new Admin();
		$user = new User();
		$farm = new Farm();
		$user_farm = new User_Farm();
		$farm_unit = new Farm_Unit();
		$water_need = new WaterNeed();
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

    <title>Farm profiles</title>

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
                          <table class="table table-striped table-advance table-hover farmers">
							
							<div class='row'>
								<span style="margin-left:1em;font-size:2em;">Farm profiles</span>
								
								<div class="form-group pull-right">
									<div class="col-sm-10">
										<input type="text" placeholder="Search a a farm by name, crop type or by town" class="form-control farms_search_box" id='search_box'>
									</div>
								</div>
								
							</div>
							
	                  	  	<hr>
							  
							  <?php
								if($farm->getFarms() != 0){
							  ?>
								<thead>
									<tr>
										<th style="width:2em">id</th>
										<th style="width:15em"><i class="fa fa-info"></i> Name</th>
										<th style="width:20em;"><i class="fa fa-map-marker"></i> Location</th>
										<th><i class="fa fa-tree"></i> Crop</th>
										<th><i class="fa fa-tree"></i> Number of farm units</th>
										<th><i class="fa fa-stop-circle"></i> Block</th>
										<th><i class="fa fa-tint"></i> Ration status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							  <?php
									foreach($farm->getFarms() as $farmFetched){
										$id = $farmFetched['id'];
										$farm_name = $farmFetched['farm_name'];
										$crop = $farmFetched['crop'];
										$block = $farmFetched['block_id'];
										$location = $farmFetched['region']." / ".$farmFetched['town'];
										$unit_number=$farm_unit->getFarmsUnitsNumber($id);
										
										if($water_need->getFarmWaterNeed($id) != 0){
											$ration_status = "<span style='color:green'>YES</span>";
										}else{
											$ration_status = "<span style='color:red'>NO</span>";
										}
										
							  ?>
								<tr id='farm-list'>
								  <td><b><?php echo $id;?></b></td>
                                  <td><a href="editfarm&id=<?php echo $id;?>"><?php echo $farm_name ;?></a></td>
                                  <td><?php echo $location;?></td>
								  <td><?php echo $crop;?></td>
								  <td><?php echo $unit_number;?></td>
								  <td><?php echo $block;?></td>
								  <td><?php echo $ration_status;?></td>
                                  <td>
									<a href='stats&id=<?php echo $id;?>'><button class="btn btn-primary btn-xs"><i class="fa fa-line-chart"></i></button></a>
									
                                    <a href='editfarm&id=<?php echo $id;?>'><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                    <button farm_id="<?php echo $id;?>" class="btn btn-danger btn-xs delete_farm"><i class="fa fa-trash-o "></i></button>
                                  </td>
								</tr>
							  <?php 
									}
							  ?>
								</tbody>
							  <?php
								}else{
							  ?>
								
								<div style='margin:2em;' class='alert alert-warning'>No farmers have currently been registered  <a href="<?php echo ADDFARMER_URL;?>"><button class='btn btn-small btn-theme'>Register a farmer</button></a></div>
							  <?php
								}
							  ?>
                          </table>
						  
						  <!-- Search -->
						  <div class='search'>
							<h4>Search results</h4>
							<a href='#' class='view_all_farmers' style='margin-left:1em;margin-bottom:1em'>Go back</a>
							
								<ul style='margin-top:1em;' class='search_results search_ul'></ul>
						  </div>
						  
						  
                      </div><!-- /content-panel -->
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


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
    <!--script for this page-->
    <script type="text/javascript" src="assets/js/core.js"></script>
	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>

  </body>
</html>
