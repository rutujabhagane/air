<?php
	require_once('../classes/message.class.php');
	$message = new Message();
?>
<section id="container" >
      <!-- Top bar & Notification -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo USERHOME_URL?>" class="logo"><img src='assets/img/logo_1.png' style="width:5em;"></a>
            <!--logo end-->
            
			
		
			<div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start 
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
					-->
                    <!-- settings end -->
					
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme"><?php echo $message->getNumberOfUserUnreadMessages($_SESSION['user_uid_login'])["COUNT(*)"];?></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
							
							<?php if($message->getNumberOfUserUnreadMessages($_SESSION['user_uid_login'])["COUNT(*)"] != 0){ ?>
                            <li>
                                <p class="green">You have <?php echo $message->getNumberOfUserUnreadMessages($_SESSION['user_uid_login'])["COUNT(*)"];?> new messages</p>
                            </li>
							
							<?php
								foreach($message->getUserUnreadMessagesTop($_SESSION['user_uid_login']) as $fetchedMessage){
									$themsgg_id = $fetchedMessage['id'];
									$subject = $fetchedMessage['subject'];
									$msg = $fetchedMessage['message'];
									$date = $fetchedMessage['date'];
									if(strlen($msg)>38)
										$msg = substr($msg,0,37)."..";
										
							?>
							
                            <li>
                                <a href="usermessage&id=<?php echo $themsgg_id;?>">
                                    <span class="subject">
                                    <span class="from"><?php echo $subject;?></span>
                                    <span class="time"><?php echo time_ago($date);?></span>
                                    </span>
                                    <span class="message">
                                        <?php echo $msg;?>
                                    </span>
                                </a>
                            </li>
     
							<?php }?>
	 
                            <li>
                                <a href="<?php echo USERMSG_URL;?>">See all messages</a>
                            </li>
							<?php }else{ ?>
								<li>
									<p class="green">You have no new messages</p>
								</li>
							<?php  }?>
							
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
			
			
			
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="userlogout">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->