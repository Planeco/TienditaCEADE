<?php
/* This is a PHP Secure login system. The latest copy: http://www.php-developer.org/php-secure-authentication-of-user-logins/
* Copyright (c) 2011 PHP Secure login system -- http://www.php-developer.org | AUTHORS: Codex-m
* Refer to license.txt to how code snippets from other authors or sources are attributed. Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */

// Require config and start session
session_start();
require('../include/config.php');
include_once('../include/general.php');
 
if (($_SESSION['logged_in']) == TRUE)
{
	$iprecreate = $_SERVER['REMOTE_ADDR'];
	$useragentrecreate = $_SERVER["HTTP_USER_AGENT"];
	$signaturerecreate = $_SESSION['signature'];
 
	//Extract original salt from authorized signature 
	$saltrecreate = substr($signaturerecreate, 0, $length_salt);
 
	//Extract original hash from authorized signature
	$originalhash = substr($signaturerecreate, $length_salt, 40);
 
	//Re-create the hash based on the user IP and user agent
	//then check if it is authorized or not
	$hashrecreate = sha1($saltrecreate . $iprecreate . $useragentrecreate);
 
	if (!($hashrecreate == $originalhash)) {
		//Signature submitted by the user does not matched with the authorized signature
		//This is unauthorized access Block it
		//header(sprintf("Location: %s", $forbidden_url));
		//exit;
		
		//Temp fixed for drolls and other Unexperienced user.
		session_destroy();
		session_unset();
		//redirect the user back to login page for re-authentication
		$redirectback = $domain;
		header(sprintf("Location: %s", $redirectback));
		
		
		
	}
 
	//Session Lifetime control for inactivity
	//Credits: http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes
	if ((isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout))) {
		session_destroy();
		session_unset();
		//redirect the user back to login page for re-authentication
		$redirectback = $domain;
		header(sprintf("Location: %s", $redirectback));
	}
	
$_SESSION['LAST_ACTIVITY'] = time();
}
 
//Pre-define validation
$validationresults = TRUE;
$registered = TRUE;
$recaptchavalidation = TRUE;
$authorizedIP = TRUE;
 
//Trapped brute force attackers and give them more hard work by providing a captcha-protected page
$iptocheck = $_SERVER['REMOTE_ADDR'];
$iptocheck = mysql_real_escape_string($iptocheck);

if($fetch = mysql_fetch_array(mysql_query("SELECT `loggedip` FROM `ipcheck` WHERE `loggedip`='$iptocheck'"))) {
	//Already has some IP address records in the database
	//Get the total failed login attempts associated with this IP address
	$resultx = mysql_query("SELECT `failedattempts` FROM `ipcheck` WHERE `loggedip`='$iptocheck'");
	$rowx = mysql_fetch_array($resultx);
	$loginattempts_total = $rowx['failedattempts'];
 
	if($loginattempts_total > $maxfailedattempt) {
		//too many failed attempts allowed, redirect and give 403 forbidden.
		header(sprintf("Location: %s", $forbidden_url));
		exit;
	}
}
 
//Check if a user has logged-in
if (!isset($_SESSION['logged_in'])) {
	$_SESSION['logged_in'] = FALSE;
}
 
//Check if the form is submitted
//if ((isset($_POST["password"])) && (isset($_POST["username"])) && ($_SESSION['LAST_ACTIVITY'] == FALSE)) {
 if (($_SESSION['LAST_ACTIVITY'] == FALSE) && $_GET['e']=='t') {
//	$user = sanitize($_POST["username"]);
//	$pass = sanitize($_POST["password"]);
	$user = sanitize($_SESSION['unique_name']);
	$pass = sanitize($_SESSION['given_name']);
 	
	//validate username
	if(!($fetch = mysql_fetch_array(mysql_query("SELECT `username` FROM `authentication` WHERE `username`='$user'")))) {
		//no records of username in database or user is not yet registered
		$registered = FALSE;
	}
 
	if ($registered == TRUE) {
		//Grab login attempts from MySQL database for a corresponding username
		$result1 = mysql_query("SELECT `loginattempt` FROM `authentication` WHERE `username`='$user'");
		$row = mysql_fetch_array($result1);
		$loginattempts_username = $row['loginattempt'];
	}
	
 
	if (($loginattempts_username > 6) || ($registered == FALSE) || ($loginattempts_total > 6))
	{
		//temp fix.
		$msg = '<div class="spacer-40"></div>
				<div class="alert alert-block alert-dismissable alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>Usurio o contrase&ntilde;a inv&aacute;lida</p>
				</div>';
	
	
		//Require those user with login attempts failed records to submit captcha and validate recaptcha
		require_once('recaptchalib.php');
		$resp =	recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		if (!$resp->is_valid){
			//captcha validation fails
		$recaptchavalidation = FALSE;
		}else{
		$recaptchavalidation = TRUE;
		}
	}  
	//Get correct hashed password based on given username stored in MySQL database
	if ($registered == TRUE) {
		//username is registered in database, now get the hashed password and permision
		//Aqui Tomo lo que necesito de datos extra del login, como permisos, nivel de acceso, etc.
    $result = mysql_query("SELECT `id_user`, `password`,`nombre`,`id_rol`  FROM `authentication` WHERE `username`='$user'");
		$row = mysql_fetch_array($result);
		$idusuario = $row['id_user'];
		$correctpassword = $row['password'];
		$nombrecompleto = $row['nombre'];
		$permisos = $row['id_rol'];
		$salt = substr($correctpassword, 0, 64);
		$correcthash = substr($correctpassword, 64, 64);
		$userhash = hash("sha256", $salt . $pass);
		
		
		$access = array();
		$sql="SELECT * FROM rbac WHERE id_rol = '$permisos'";
		$res=mysql_query($sql);
		if($res&&mysql_numrows($res)>0)
		{
			while($row_inf=mysql_fetch_assoc($res))
			{
				array_push($access, $row_inf['id_seccion']);
			}
		}
		
	}

	//Validacion de todos los campos, estoy agregando la version de las IP's-
	//if ((!($userhash == $correcthash)) || ($registered == FALSE) || ($recaptchavalidation == FALSE)) {
  if (($registered == FALSE) || ($recaptchavalidation == FALSE)) {
		//user login validation fails
		$validationresults = FALSE;
		
		//log login failed attempts to database
		if ($registered == TRUE){
			$loginattempts_username = $loginattempts_username + 1;
			$loginattempts_username = intval($loginattempts_username);                 
			//update login attempt records
			mysql_query("UPDATE `authentication` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'");
			
			//Possible brute force attacker is targeting registered usernames check if has some IP address records
			if (!($fetch = mysql_fetch_array(mysql_query("SELECT `loggedip` FROM `ipcheck` WHERE `loggedip`='$iptocheck'")))) {
				//no records
				//insert failed attempts
				$fecha = date("Y-m-d");
				$loginattempts_total = 1;
				$loginattempts_total = intval($loginattempts_total);
				mysql_query("INSERT INTO `ipcheck` (loggedip, date, failedattempts) VALUES ('$iptocheck', '$fecha', '$loginattempts_total')");
			}else{
				//has some records, increment attempts
				$fecha = date("Y-m-d");
				$loginattempts_total = $loginattempts_total + 1;
				mysql_query("UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total', date = '$fecha' WHERE `loggedip` = '$iptocheck'");
			}
		}
 
		//Possible brute force attacker is targeting randomly
		if ($registered == FALSE) {
			if (!($fetch = mysql_fetch_array(mysql_query("SELECT `loggedip` FROM `ipcheck` WHERE `loggedip`='$iptocheck'")))){
				//no records, insert failed attempts
				$loginattempts_total = 1;
				$loginattempts_total = intval($loginattempts_total);
				mysql_query("INSERT INTO `ipcheck` (`loggedip`, `failedattempts`) VALUES ('$iptocheck', '$loginattempts_total')");
			}else{
				//has some records, increment attempts
				$loginattempts_total = $loginattempts_total + 1;
				mysql_query("UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");
			}
		}
	}
	else
	{
		//user successfully authenticates with the provided username and password
		//Reset login attempts for a specific username to 0 as well as the ip address
		$loginattempts_username = 0;
		$loginattempts_total = 0;
		$loginattempts_username = intval($loginattempts_username);
		$loginattempts_total = intval($loginattempts_total);
		mysql_query("UPDATE `authentication` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'");
		mysql_query("UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");
 
		//Generate unique signature of the user based on IP address and the browser then append it to session
		//This will be used to authenticate the user session To make sure it belongs to an authorized
		//user and not to anyone else. Generate random salt
		function genRandomString() {
			//credits: http://bit.ly/a9rDYd
			$length = 50;
			$characters = "0123456789abcdef";
			for ($p = 0; $p < $length; $p++) {
				$string .= $characters[mt_rand(0, strlen($characters))];
			}
			return $string;
		}
 
		$random = genRandomString();
		$salt_ip = substr($random, 0, $length_salt);
 
		//hash the ip address, user-agent and the salt
		$useragent = $_SERVER["HTTP_USER_AGENT"];
		$hash_user = sha1($salt_ip . $iptocheck . $useragent);
 
		//concatenate the salt and the hash to form a signature
		$signature = $salt_ip . $hash_user;
 
		//Regenerate session id prior to setting any session variable
		//to mitigate session fixation attacks
		session_regenerate_id();

		//Finally store user unique signature in the session
		//and set logged_in to TRUE as well as start activity time
		//Aqui asigno los valores de Sesión que necesito extras =)
		$_SESSION['signature'] = $signature;
		$_SESSION['logged_in'] = TRUE;
		$_SESSION['LAST_ACTIVITY'] = time();
		$_SESSION['usuario'] = $user;
		$_SESSION['rbac'] = $access;
		$_SESSION['alias'] = $nombrecompleto;
		$_SESSION['accesslvl'] = $permisos;
				
	}
}
 
if (!$_SESSION['logged_in']):
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8 no-js">      <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9 no-js">           <![endif]-->
<!--[if gt IE 9]>  <html class="no-js">                       <![endif]-->
<!--[if !IE]><!--> <html class="no-js">                       <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Tiendita Godin</title>
        
    <meta name="apple-mobile-web-app-title" content="Unifica Webapp">
    <meta name="application-name" content="Focim OMS">
    <meta name="msapplication-TileColor" content="#333333" />
	<meta name="msapplication-TileImage" content="images/mobile/windows8-icon.png" />    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="HandheldFriendly" content="true"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
	<meta name="rating" content="Private" />
	<meta name="robots" content="noindex,nofollow" />
		
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/mobile/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/mobile/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/mobile/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/mobile/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/mobile/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/mobile/apple-touch-icon-72x72.png" />
    
    <link rel="apple-touch-icon-precomposed" href="images/mobile/apple-touch-icon.png" />
    <link rel="shortcut icon" href="images/favicons/favicon.ico" />
    
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" href="/images/mobile/apple-touch-startup-image-1536x2008.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" href="/images/mobile/apple-touch-startup-image-1496x2048.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" href="/images/mobile/apple-touch-startup-image-768x1004.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" href="/images/mobile/apple-touch-startup-image-748x1024.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="/images/mobile/apple-touch-startup-image-640x1096.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" href="/images/mobile/apple-touch-startup-image-640x920.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" href="/images/mobile/apple-touch-startup-image-320x460.png"/>
    <link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-custom.css"/>
    <link rel="stylesheet" href="css/bootstrap-extended.css"/>
    <link rel="stylesheet" href="css/login.css"/>
    <link rel="stylesheet" href="css/light-theme.css"/>    

    <script src="js/plugins/modernizr.min.js"></script> 
    <script src="js/plugins/mobiledevices.js"></script>    
    <script src="js/libs/jquery-1.11.0.min.js"></script>
    <script src="js/libs/jquery-ui-1.10.4.min.js"></script>    
    <script src="bootstrap/core/dist/js/bootstrap.min.js"></script>
    <script src="js/plugins/showpassword.1.0.min.js"></script>
    <script src="js/plugins/nanogress.1.0.min.js"></script>
    <script src="js/plugins/powerwizard.1.0.min.js"></script>    
    <script src="js/plugins/jquery.pwstrength.min.js"></script>
    <script src="js/plugins/login.js"></script>
     
</head>
<body class="whitebox2"> 
	<div id="container" class="clearfix"> 
     	<div class="window">  
			<div class="row ext-raster">
				
				<div id="plecaTop">&nbsp;</div>
				
				<div class="col-sm-12">
					<div class="inner-padding">
						<div id="logosLogin">
							<img src="images/logo/logo.png" alt="Tiendita Godin" title="Tiendita Godin" id="RMLogo" />

							<div class="spacer-40"></div>

							<img src="images/theme/ceade.png" alt="" title="" class="logoCompany" />
							<img src="images/logo/rm.png" alt="Reinventando a Mexico" title="Reinventando a Mexico" class="logoCompany" />
						</div>
					</div>
				</div>
				
				<div class="vacio">&nbsp;</div>
				
				<div id="plecaBottom">&nbsp;</div>
				
				
				<div class="col-sm-12">
					<div class="inner-padding">
                        <div class="spacer-20"></div>
                        
                        <div class="col-sm-12">
							<div id="login-box">
								<div class="login-box-inner clearfix">
								
									<?php if(isset($msg)): ?>
										<?php echo $msg ?>
									<?php endif ?>
									
									<div class="spacer-10"></div>   
									<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="form-login">
				
										<div id="bannerLogin">
											<img src="images/theme/helpdesk.png" alt="Help Desk" />
										</div>
					
										<div class="login-fields-wrapper">
											<div class="row">  
												<div class="col-lg-12">	
													<input class="form-control input-lg" type="text" placeholder="Correo Electr&oacute;nico" tabindex="1" name="username" />
												</div>
											</div>
											<div class="spacer-10"></div>  
											<div class="row">  
												<div class="col-lg-12">	
													<input class="form-control input-lg" name="password" type="password" id="password" placeholder="Contrase&ntilde;a" tabindex="2" />
												</div>
											</div>
											
											
											<?php if (($loginattempts_username > 6) || ($registered == FALSE) || ($loginattempts_total > 6)) { ?>
												<div class="spacer-20"></div>
												<div id="captcha_block">
													<p>Escribe el Captcha a continuaci&oacute;n:</p>
													<?php
													require_once('recaptchalib.php');
													echo recaptcha_get_html($publickey);
													?>
												</div>
											<?php } ?>
											
											<div class="spacer-20"></div>	
											<div class="row">
												<div class="col-lg-12">	
													<!-- this needs to be a button/input element -->
													<input type="submit" class="btn btn-default btn-lg" value="Iniciar Sesi&oacute;n" />
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						
						<div class="spacer-20"></div>
						
						<footer id="login-footer">
							<strong>Derechos Rerservados Grupo Empresarial Reinventando a Mexico&copy; <?php echo date('Y'); ?></strong>
						</footer>
						
                    </div>
     			</div>
     			
     			
     			
     		</div>
     	</div>
    </div><!-- End #container --> 
</body>
</html>
<?php
	exit();
	endif;
?>