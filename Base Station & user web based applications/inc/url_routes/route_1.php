<?php
	/***** ADMINISTRATOR *****/
	define("DASHBOARD_URL","dashboard");
	define("ADDADMIN_URL","addadministrator");
	define("VIEWADMINS_URL","viewadmins");
	define("EDITPROFILE_URL","editprofile");
	define("PROFILE_URL","profile");
	define("ADDFARMER_URL","adduser");
	define("VIEWFARMERS_URL","viewusers");
	define("SERVERINFO_URL","sinfo");
	define("ADDFARM_URL","addfarm");
	define("VIEWFARMS_URL","viewfarms");
	define("RUNALGORITHM_URL","runalgorithm");
	define("SENDMSG_URL","sndmsg");
	define("REPORT_URL","adminreport");
	
	if(login_admin()==true){
		define("HOME_URL","dashboard");
	}else{
		define("HOME_URL","adminlogin");
	}
	
	
	/***** USER ****/
	define("USERDASHBOARD_URL","userdashboard");
	define("USERPROFILE_URL","userprofile");
	define("USERSTATS_URL","userstats");
	define("USERREPORT_URL","userreport");
	define("USERMSG_URL","usermessages");
	
	if(login_user()==true){
		define("USERHOME_URL","userdashboard");
	}else{
		define("USERHOME_URL","index");
	}
	

	
	/***** COMMON ****/
	define("ABOUT_URL","about");
	define("HELP_URL","help");
	define("TERMS_URL","terms");

?>