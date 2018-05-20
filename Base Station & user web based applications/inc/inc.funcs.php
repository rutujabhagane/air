<?php
	/*creating a session for a user who is logged in*/
    ob_start();
	session_start();
	
	//MYSQL DATABASE TOTAL SIZE IN MB ON SERVER 
	$MYSQL_DB_TOTAL_SIZE = 50;
	
	//ADMINSTRATOR
   	function login_admin(){
       if(isset($_SESSION['admin_uid_login']) && !empty($_SESSION['admin_uid_login'])){
            global $user_in;
            $user_in = $_SESSION['admin_uid_login'];
            return true;
       }else{
            return false;
        } 
    }
	
	//USER
	function login_user(){
       if(isset($_SESSION['user_uid_login']) && !empty($_SESSION['user_uid_login'])){
            global $user_in;
            $user_in = $_SESSION['user_uid_login'];
            return true;
       }else{
            return false;
        } 
    }
	
	function time_ago($date){

    if(empty($date)) {
        return "No date provided";
    }

    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $unix_date = strtotime($date);

    // check validity of date

    if(empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date

    if($now > $unix_date) {

    $difference = $now - $unix_date;

    $tense = "ago";

    } else {

    $difference = $unix_date - $now;
    $tense = "ago";}

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

    $difference /= $lengths[$j];

    }

    $difference = round($difference);

    if($difference != 1) {

    $periods[$j].= "s";

    }

    return "$difference $periods[$j] {$tense}";

}

  
	
	##checking mime of  file
	function the_mime_content_type($filename) {

        $mime_types = array(
		
            // audio/video
            'mp3' => 'audio/mpeg',
			'm4a' => 'audio/m4a',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
	
	  /*
		This function is raadyo send mail function 
		params: $email: where to send the mail
			    $email_subject: email's subject
				$paragraph1,$paragraph2,$paragraph3: mail function is for three paragraphs,text to be in individual paragraph should be in this vars
				$button_displayvalue: mail support a button. To show button this variable should be 'block',to hide button this variable should be 'block'
				$button_link: this varibale is for the link the button should point to
				$extra_paragraph : extra paragraph if needed
		returns: void
				
	 */
	 function sendMail($email,$email_subject,$paragraph1,$paragraph2,$paragraph3,$button_displayvalue,$button_link,$extra_paragraph,$buttonText){
		$to = $email; /* '. ',';  separated by comma for another email (useful if you want to keep records(sending to yourself))*/;
		$subject = $email_subject;

		$bound_text = "----*%$!$%*";
		$bound = "--".$bound_text."\r\n";
		$bound_last = "--".$bound_text."--\r\n";

		$headers = "From: noreply@raadyo.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n" .
				"Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;

		$message = " you may wish to enable your email program to accept HTML \r\n".
				$bound;

		$message .=
		'Content-Type: text/html; charset=UTF-8'."\r\n".
		'Content-Transfer-Encoding: 7bit'."\r\n\r\n";
		
		$message .= "
		<!doctype html>
			<html>
			  <head>
				<meta name='viewport' content='width=device-width' />
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				<title>Reset Password</title>
				<style>
				  /* -------------------------------------
					  GLOBAL RESETS
				  ------------------------------------- */
				  img {
					border: none;
					-ms-interpolation-mode: bicubic;
					max-width: 100%; }

				  body {
					background-color: #f6f6f6;
					font-family: sans-serif;
					-webkit-font-smoothing: antialiased;
					font-size: 14px;
					line-height: 1.4;
					margin: 0;
					padding: 0; 
					-ms-text-size-adjust: 100%;
					-webkit-text-size-adjust: 100%; }

				  table {
					border-collapse: separate;
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
					width: 100%; }
					table td {
					  font-family: sans-serif;
					  font-size: 14px;
					  vertical-align: top; }

				  /* -------------------------------------
					  BODY & CONTAINER
				  ------------------------------------- */

				  .body {
					background-color: #f6f6f6;
					width: 100%; }

				  /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
				  .container {
					display: block;
					Margin: 0 auto !important;
					/* makes it centered */
					max-width: 580px;
					padding: 10px;
					width: 580px; }

				  /* This should also be a block element, so that it will fill 100% of the .container */
				  .content {
					box-sizing: border-box;
					display: block;
					Margin: 0 auto;
					max-width: 580px;
					padding: 10px; }

				  /* -------------------------------------
					  HEADER, FOOTER, MAIN
				  ------------------------------------- */
				  .main {
					background: #fff;
					border-radius: 3px;
					width: 100%; }

				  .wrapper {
					box-sizing: border-box;
					padding: 20px; }

				  .footer {
					clear: both;
					padding-top: 10px;
					text-align: center;
					width: 100%; }
					.footer td,
					.footer p,
					.footer span,
					.footer a {
					  color: #999999;
					  font-size: 12px;
					  text-align: center; }

				  /* -------------------------------------
					  TYPOGRAPHY
				  ------------------------------------- */
				  h1,
				  h2,
				  h3,
				  h4 {
					color: #000000;
					font-family: sans-serif;
					font-weight: 400;
					line-height: 1.4;
					margin: 0;
					Margin-bottom: 30px; }

				  h1 {
					font-size: 35px;
					font-weight: 300;
					text-align: center;
					text-transform: capitalize; }

				  p,
				  ul,
				  ol {
					font-family: sans-serif;
					font-size: 14px;
					font-weight: normal;
					margin: 0;
					Margin-bottom: 15px; }
					p li,
					ul li,
					ol li {
					  list-style-position: inside;
					  margin-left: 5px; }

				  a {
					color: #3498db;
					text-decoration: underline; }

				  /* -------------------------------------
					  BUTTONS
				  ------------------------------------- */
				  .bttn {
					box-sizing: border-box;
					width: 100%; }
					.bttn > tbody > tr > td {
					  padding-bottom: 15px; }
					.bttn table {
					  width: auto; }
					.bttn table td {
					  background-color: #ffffff;
					  border-radius: 5px;
					  text-align: center; }
					.bttn a {
					  background-color: #ffffff;
					  border: solid 1px #3498db;
					  border-radius: 5px;
					  box-sizing: border-box;
					  color: #3498db;
					  cursor: pointer;
					  display: inline-block;
					  font-size: 14px;
					  font-weight: bold;
					  margin: 0;
					  padding: 12px 25px;
					  text-decoration: none;
					  text-transform: capitalize; }

				  .bttn-primary table td {
					background-color: #3498db; }

				  .bttn-primary a {
					background-color: #003377;
					border-color: #003377;
					color: #ffffff; }

				  /* -------------------------------------
					  OTHER STYLES THAT MIGHT BE USEFUL
				  ------------------------------------- */
				  .last {
					margin-bottom: 0; }

				  .first {
					margin-top: 0; }

				  .align-center {
					text-align: center; }

				  .align-right {
					text-align: right; }

				  .align-left {
					text-align: left; }

				  .clear {
					clear: both; }

				  .mt0 {
					margin-top: 0; }

				  .mb0 {
					margin-bottom: 0; }

				  .preheader {
					color: transparent;
					display: none;
					height: 0;
					max-height: 0;
					max-width: 0;
					opacity: 0;
					overflow: hidden;
					mso-hide: all;
					visibility: hidden;
					width: 0; }

				  .powered-by a {
					text-decoration: none; }

				  hr {
					border: 0;
					border-bottom: 1px solid #f6f6f6;
					Margin: 20px 0; }

				  /* -------------------------------------
					  RESPONSIVE AND MOBILE FRIENDLY STYLES
				  ------------------------------------- */
				  @media only screen and (max-width: 620px) {
					table[class=body] h1 {
					  font-size: 28px !important;
					  margin-bottom: 10px !important; }
					table[class=body] p,
					table[class=body] ul,
					table[class=body] ol,
					table[class=body] td,
					table[class=body] span,
					table[class=body] a {
					  font-size: 16px !important; }
					table[class=body] .wrapper,
					table[class=body] .article {
					  padding: 10px !important; }
					table[class=body] .content {
					  padding: 0 !important; }
					table[class=body] .container {
					  padding: 0 !important;
					  width: 100% !important; }
					table[class=body] .main {
					  border-left-width: 0 !important;
					  border-radius: 0 !important;
					  border-right-width: 0 !important; }
					table[class=body] .bttn table {
					  width: 100% !important; }
					table[class=body] .bttn a {
					  width: 100% !important; }
					table[class=body] .img-responsive {
					  height: auto !important;
					  max-width: 100% !important;
					  width: auto !important; }}

				  /* -------------------------------------
					  PRESERVE THESE STYLES IN THE HEAD
				  ------------------------------------- */
				  @media all {
					.ExternalClass {
					  width: 100%; }
					.ExternalClass,
					.ExternalClass p,
					.ExternalClass span,
					.ExternalClass font,
					.ExternalClass td,
					.ExternalClass div {
					  line-height: 100%; }
					.apple-link a {
					  color: inherit !important;
					  font-family: inherit !important;
					  font-size: inherit !important;
					  font-weight: inherit !important;
					  line-height: inherit !important;
					  text-decoration: none !important; } 
					.bttn-primary table td:hover {
					  background-image: -webkit-gradient(linear, center top, center bottom, from(#1863B1), to(#003366)); }
					.bttn-primary a:hover {
					  background-image: -webkit-gradient(linear, center top, center bottom, from(#1863B1), to(#003366));
					  border-color: #34495e !important; } }

				</style>
			  </head>
			  <body class=''>
				<table border='0' cellpadding='0' cellspacing='0' class='body'>
				  <tr>
					<td>&nbsp;</td>
					<td class='container'>
					  <div class='content'>

						<!-- START CENTERED WHITE CONTAINER -->
						
						<table class='main'>

						  <!-- START MAIN CONTENT AREA -->
						  <tr>
							<td class='wrapper'>
							  <table border='0' cellpadding='0' cellspacing='0'>
								<tr>
								  <td>
									<p style='font-size:1em;font-weight:bold;'>Hello $email,</p>
									
									<p style='text-align:center;'>$paragraph1</p>
									
									<p style='text-align:center;'>$paragraph2</p>
									
									<p style='text-align:center;'>$paragraph3</p>
									
									<table style='display:$button_displayvalue;margin-left:36%;' border='0' cellpadding='0' cellspacing='0' class='bttn bttn-primary' >
									  <tbody>
										<tr>
										  <td align='left'>
											<table border='0' cellpadding='0' cellspacing='0'>
											  <tbody>
												<tr>
												  <td> <a href='$button_link' target='_blank'>$buttonText</a> </td>
												</tr>
											  </tbody>
											</table>
										  </td>
										</tr>
									  </tbody>
									</table>
									
									<p style='text-align:center'>
										$extra_paragraph
									</p>
									
								  </td>
								</tr>
							  </table>
							</td>
						  </tr>

						<!-- END MAIN CONTENT AREA -->
						</table>

						<!-- START FOOTER -->
						<div class='footer'>
						  <table border='0' cellpadding='0' cellspacing='0'>
							<tr>
							  <td class='content-block'>
								<span class='apple-link'>
								<p><img src='www.raadyo.com/img/logo.png'></p></br>
								raadyo - Your music closer to you, <a href='http://www.raadyo.com'>www.raadyo.com</a></span>
								<br>raadyo, developed and maintained by Softvision Company
							  </td>
							</tr>
							<tr>
							  <td class='content-block powered-by'>
								For more info mail us <a href='mailto:info@raadyo.com'>info@raadyo.com</a>
							  </td>
							</tr>
						  </table>
						</div>
						<!-- END FOOTER -->
						
					  <!-- END CENTERED WHITE CONTAINER -->
					  </div>
					</td>
					<td>&nbsp;</td>
				  </tr>
				</table>
			  </body>
			</html>

		
		";

		$sent = mail($to, $subject, $message, $headers); // finally sending the email


	}
	
?>