<section id="container" >
      <!-- Top bar & Notification -->
      <!--header start-->
      <header class="header black-bg">
			  
			  <?php if(!isset($gen)){?>
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
			  <?php }?>
			  
			<?php if(!isset($gen)){?>
            <!--logo start-->
            <a href="<?php echo HOME_URL?>" class="logo"><img src='assets/img/logo_1.png' style="width:5em;"></a>
            <!--logo end-->
			<?php }else{ ?>
				<a href="" class="logo"><img src='assets/img/logo_1.png' style="width:5em;"></a>
			<?php }?>
            
			<?php if(login_admin()==true){?>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout">Logout</a></li>
            	</ul>
            </div>
			<?php }?>
			
        </header>
      <!--header end-->