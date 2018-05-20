<aside>
    <div id="sidebar"  class="nav-collapse ">
		<!-- sidebar menu start-->
		<ul class="sidebar-menu" id="nav-accordion">
				
			<!-- Logged in user profile pic and name-->
            <p class="centered">
				<a href="<?php echo USERPROFILE_URL?>"><img src="<?php echo $loggedin_profile_pic;?>" class="img-circle" width="60"></a>
			</p>
			<h5 class="centered"><?php echo $loggedin_name;?></h5>
              	  	
            <li class="mt">
                <a <?php if(isset($sidebar_dashboard))echo "class='active'";?> href="<?php echo USERDASHBOARD_URL?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
			
			<li>
                <a <?php if(isset($sidebar_profile))echo "class='active'";?> href="<?php echo USERPROFILE_URL?>">
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
	
           
			<li>
                <a <?php if(isset($sidebar_msg))echo "class='active'";?> href="<?php echo USERMSG_URL?>">
                    <i class="fa fa-envelope"></i>
                    <span>Messages</span>
                </a>
            </li>
		   
		   
			<li style="top:19.5em;">
                <a <?php if(isset($sidebar_help))echo "class='active'";?> href="<?php echo HELP_URL?>">
					<i class="fa fa-life-buoy"></i>
                    <span style='font-weight:bold;'>Help & support</span>
                </a>
            </li>
				 
		</ul>
		<!-- sidebar menu end-->
	</div>
</aside>