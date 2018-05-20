<?php
	require_once('inc/inc.funcs.php');
	if(login_admin()==true){
		require_once('inc/url_routes/route_1.php');
		require_once('classes/admin.class.php');
		$admin = new Admin();
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

    <title>Administrators</title>

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
			$sidebar_adminMenu =1;
			$sidebar_viewAdmins =1;
			
			require_once('inc/inc.sidebar.php')
		?>          
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
			
							<h3 style="margin-left:1em;"> Administrators </h3> 
	                  	  	<hr>
							  
							  <?php
								if($admin->getAdmins($_SESSION['admin_uid_login']) != 0){
							  ?>
								<thead>
									<tr>
										<th style="width:15em"><i class="fa fa-user-circle-o"></i> Name</th>
										<th><i class="fa fa-vcard"></i> Username</th>
										<th><i class="fa fa-id-badge"></i> Privilege</th>
										<th><i class=" fa fa-envelope"></i> email</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							  <?php
									foreach($admin->getAdmins($_SESSION['admin_uid_login']) as $adminFetched){
										$id = $adminFetched['id'];
										$uid = $adminFetched['uid'];
										$username = $adminFetched['username'];
										$first_name = $adminFetched['firstname'];
										$last_name = $adminFetched['lastname'];
										$other_names = $adminFetched['othernames'];
										$email = $adminFetched['email'];
										$privilege = $adminFetched['title'];
										if(empty($other_names))
											$name = $first_name." ".$last_name;
										else
											$name = $first_name." ".$other_names.". ".$last_name;
							  ?>
								<tr id='admin-list'>
                                  <td><a href="editadmin&id=<?php echo $id;?>"><?php echo $name;?></a></td>
                                  <td><?php echo $username;?></td>
                                  <td><?php echo $privilege;?></td>
                                  <td><?php echo $email;?></td>
                                  <td>
                                      <a href='editadmin&id=<?php echo $id;?>'><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                      <button uid="<?php echo $uid;?>" class="btn btn-danger btn-xs delete_admin"><i class="fa fa-trash-o "></i></button>
                                  </td>
								</tr>
							  <?php 
									}
							  ?>
								</tbody>
							  <?php
								}else{
							  ?>
								
								<div style="margin:2em;" class="alert alert-warning">No other administrators have been created  <a href="<?php echo ADDADMIN_URL;?>"><button class='btn btn-small btn-theme'>Add an admin</button></a></div>
							  <?php
								}
							  ?>
                          </table>
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
