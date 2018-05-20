<aside>
    <div id="sidebar"  class="nav-collapse ">
		<!-- sidebar menu start-->
		<ul class="sidebar-menu" id="nav-accordion">
				
			<!-- Logged in user profile pic and name-->
            <p class="centered">
				<a href="<?php echo EDITPROFILE_URL?>"><img src="<?php echo $loggedin_profile_pic;?>" class="img-circle" width="60"></a>
			</p>
			<h5 class="centered"><?php echo $loggedin_name;?></h5>
              	  	
            <li class="mt">
                <a <?php if(isset($sidebar_dashboard))echo "class='active'";?> href="<?php echo DASHBOARD_URL?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
					
			<li class="sub-menu">
				<a <?php if(isset($sidebar_profileMenu))echo "class='active'";?> href="javascript:;" >
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                </a>
                <ul class="sub">
                    <li <?php if(isset($sidebar_profile))echo "class='active'";?>><a href="<?php echo PROFILE_URL;?>">Profile</a></li>
                    <li <?php if(isset($sidebar_editProfile))echo "class='active'";?>><a href="<?php echo EDITPROFILE_URL;?>">Edit profile</a></li>
                </ul>
            </li>
			
			<?php if($loggedin_privilege=="Admin"){?>
				<li class="sub-menu">
					<a <?php if(isset($sidebar_adminMenu))echo "class='active'";?> href="javascript:;" >
						<i class="fa fa-cogs"></i>
						<span>Manage administrators</span>
					</a>
					<ul class="sub">
						<li <?php if(isset($sidebar_addAdmin))echo "class='active'";?>><a  href="<?php echo ADDADMIN_URL?>">Add administrator</a></li>
						<li <?php if(isset($sidebar_viewAdmins))echo "class='active'";?>><a  href="<?php echo VIEWADMINS_URL?>">View administrators</a></li>
					</ul>
				</li>
			<?php }?>
			
            <li class="sub-menu">
                <a <?php if(isset($sidebar_farmersMenu))echo "class='active'";?> href="javascript:;" >
                    <i class="fa fa-users"></i>
                    <span>Farmers</span>
                </a>
                <ul class="sub">
					<li <?php if(isset($sidebar_addFarmer))echo "class='active'";?>><a href="<?php echo ADDFARMER_URL?>">Add farmer</a></li>
                    <li <?php if(isset($sidebar_viewFarmers))echo "class='active'";?>><a href="<?php echo VIEWFARMERS_URL?>">View farmers</a></li>
                </ul>
            </li>
			
			<li class="sub-menu">
                <a <?php if(isset($sidebar_farmMenu))echo "class='active'";?> href="javascript:;" >
                    <i class="fa fa-tree"></i>
                    <span>Farm sections</span>
                </a>
				<ul class="sub">
					<li <?php if(isset($sidebar_addFarm))echo "class='active'";?>><a href="<?php echo ADDFARM_URL?>">Add farm section</a></li>
                    <li <?php if(isset($sidebar_viewFarms))echo "class='active'";?>><a href="<?php echo VIEWFARMS_URL?>">View farm section</a></li>
					<li <?php if(isset($sidebar_runalgorithm))echo "class='active'";?>><a href="<?php echo RUNALGORITHM_URL?>">Ration</a></li>
                </ul>
            </li>
			
			<li>
                <a <?php if(isset($sidebar_report))echo "class='active'";?> href="<?php echo REPORT_URL?>">
					<i class="fa fa-file-pdf-o"></i>
                    <span>Report</span>
				</a>
            </li>
			
			<li>
                <a <?php if(isset($sidebar_help))echo "class='active'";?> href="<?php echo HELP_URL?>">
					<i class="fa fa-life-buoy"></i>
                    <span>Help & support</span>
                </a>
            </li>
				 
		</ul>
		<!-- sidebar menu end-->
	</div>
</aside>