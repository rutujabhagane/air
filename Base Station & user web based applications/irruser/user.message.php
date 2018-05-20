<?php
	require_once('../inc/inc.funcs.php');
	if(login_user()==true){
		
			require_once('../inc/url_routes/route_1.php');
			require_once('../classes/user.class.php');
			require_once('../classes/message.class.php');
			$user = new User();
			$message_obj  = new Message();
			require_once('../inc/loggedinuser.php'); // Getting logged in user's data
			
			
			if($message_obj->getMessaage($_GET['id'])){
				foreach($message_obj->getMessaage($_GET['id']) as $fetchedMessage){
					$themsg_id = $fetchedMessage['id'];
					$themsg_subject = $fetchedMessage['subject'];
					$themsg = $fetchedMessage['message'];
					$themsg_date = $fetchedMessage['date'];
					$themsg_userRead = $fetchedMessage['user_read'];
					
					//making message as read when opened
					if($themsg_userRead == 0){
						$message_obj->readMessage($themsg_id);
					}
				}
			}else{
				die("<script>location.href = '404'</script>");
			}
		
	}else{
		die("<script>location.href = 'index'</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/messages.css">

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
			$sidebar_msg =1;
		
			require_once('../inc/inc.user.sidebar.php')
		?>
		<!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          	<div class="row mt">
			
          		<div class="col-lg-12">
					<div class="form-panel">
						<div class="row">
							
							
							<div class='col-md-9'>
								<h3>Messages <i class='fa fa-angle-right'></i> <?php echo $themsg_subject;?></h3>
								
								<div class='row pull-right' style='margin-right:0em;'>
								
									<span class='' style='margin-right:1.5em;'><?php echo time_ago($themsg_date);?></span>
									<input type='hidden' id='msgdelete'>
									<button msg_id='<?php echo $themsg_id;?>' type="button" class="btn btn-danger delete_message"><i class="fa fa-trash-o "></i> Delete message</button>
								</div>
								</br>
								
								<div id='edit_personal_info' style='background:#eee;padding-top:2em;font-size:1.1em;'>
									
									<span class="help-block">
										<?php echo $themsg;?>
									</span>
									
								</div>
									
								<div id='msg_body'>						
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
	<script type="text/javascript" src="assets/js/irruser/core.js"></script>
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>

  </body>
</html>
