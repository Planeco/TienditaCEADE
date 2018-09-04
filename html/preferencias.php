<?php
	require('authenticate.php');
	
	$nav = 'inicio';
	$subnav = '';
	
if(($_SERVER['REQUEST_METHOD'] == 'POST') AND (isset($_POST['btnSend'])))
{
	$desired_password = sanitize($_POST["desired_password"]);
	$desired_password1 = sanitize($_POST["desired_password1"]);
	
	if (empty($desired_password)) {
	$passwordnotempty = FALSE;
	} else {
	$passwordnotempty = TRUE;
	}
 
	if ((!(ctype_alnum($desired_password))) || ((strlen($desired_password)) < 6)) {
	$passwordvalidate = FALSE;
	} else {
	$passwordvalidate = TRUE;
	}
 
	if ($desired_password == $desired_password1) {
	$passwordmatch = TRUE;
	} else {
	$passwordmatch = FALSE;
	}
	
	//check for password save or present errors
	if (($passwordnotempty == TRUE) && ($passwordmatch == TRUE) && ($passwordvalidate == TRUE)) {
	
		function HashPassword($input) {
			$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			$hash = hash("sha256", $salt . $input);
			$final = $salt . $hash;
			return $final;
		}
 
		$hashedpassword = HashPassword($desired_password);
		
		//mysql update
		if(mysql_query("UPDATE authentication SET password = '$hashedpassword' WHERE `username`='{$_SESSION['usuario']}'"))
		{
			//success
			$messagepasswd = '<div class="alert alert-block alert-dismissable alert-success">
        	            	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	            			<p>Su contrase&ntilde;a se cambi&oacute; con &eacute;xito.</p>
	    		            </div>';
	    	
	    	//headers to dashboard
	    	header("refresh:1;url=dashboard.php");
	    	
		}
		else
		{
			//error
			$messagepasswd = '<div class="alert alert-block alert-dismissable alert-danger">
        	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	            			<p>No se ha podido actualizar su contrase&ntilde;a, intente mas tarde o contacte a soporte.</p>
	    		            </div>';
		}
	}else{
		//display error
		$messagepasswd = '<div class="alert alert-block alert-dismissable alert-danger">
        	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		if($passwordnotempty == FALSE){$messagepasswd .= "<p>La contrase&ntilde;a est&aacute; vac&iacute;a</p>";}
		if($passwordmatch == FALSE){$messagepasswd .= "<p>Las contrase&ntilde;as no coinciden.</p>";}
		if($passwordvalidate == FALSE){$messagepasswd .= "<p>La contrase&ntilde;a tiene que ser mayor a 6 caracteres.</p>";}
	}
		$messagepasswd .= "</div>";
}


if(($_SERVER['REQUEST_METHOD'] == 'POST') AND (isset($_POST['btnCancel'])))
{
	header("location: dashboard.php");
}	
	
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

    <title>Preferencias para <?php echo $_SESSION['alias']; ?></title>

    <!-- // IOS webapp icons // -->
    
    <meta name="apple-mobile-web-app-title" content="Karma Webapp">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/mobile/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/mobile/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/mobile/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/mobile/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/mobile/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/mobile/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" href="images/mobile/apple-touch-icon.png" />
    <link rel="shortcut icon" href="images/favicons/favicon.ico" />
    
    <!-- // IOS webapp splash screens // -->
    
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
          href="/images/mobile/apple-touch-startup-image-1536x2008.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
          href="/images/mobile/apple-touch-startup-image-1496x2048.png"/>     
 	<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)"
          href="/images/mobile/apple-touch-startup-image-768x1004.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)"
          href="/images/mobile/apple-touch-startup-image-748x1024.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" 
          href="/images/mobile/apple-touch-startup-image-640x1096.png"/>    
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"
          href="/images/mobile/apple-touch-startup-image-640x920.png"/>    
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"
          href="/images/mobile/apple-touch-startup-image-320x460.png"/>    
    
    <!-- // Windows 8 tile // -->
    <meta name="application-name" content="Unifica">
    <meta name="msapplication-TileColor" content="#333333" />
	<meta name="msapplication-TileImage" content="images/mobile/windows8-icon.png" />

    <!-- // Handheld devices misc // -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="HandheldFriendly" content="true"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
    
    <!-- // Stylesheets // -->
    <link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="bootstrap/typeahead/typeahead.min.css"/>
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-custom.css"/>
    <link rel="stylesheet" href="css/bootstrap-extended.css"/>
    <link rel="stylesheet" href="css/animate.min.css"/>
    <link rel="stylesheet" href="css/helpers.css"/>
    <link rel="stylesheet" href="css/base.css"/>
    <link rel="stylesheet" href="css/light-theme.css"/>
    <link rel="stylesheet" href="css/mediaqueries.css"/>
    
    <!-- // Helpers // -->
    <script src="js/plugins/modernizr.min.js"></script> 
    <script src="js/plugins/mobiledevices.js"></script>
    
    <!-- // jQuery core // -->
    <script src="js/libs/jquery-1.11.0.min.js"></script>
    <script src="js/libs/jquery-ui-1.10.4.min.js"></script>
    
    <!-- // Bootstrap // -->
    <script src="bootstrap/core/dist/js/bootstrap.min.js"></script>
	<script src="bootstrap/bootboxjs/bootboxjs.min.js"></script>
    <script src="bootstrap/holder/holder.min.js"></script>
    <script src="bootstrap/typeahead/typeahead.min.js"></script>
    
    <!-- // Custom/premium plugins // -->
    <script src="js/plugins/mainmenu.1.0.min.js"></script>
    <script src="js/plugins/bootstraptabsextend.1.0.min.js"></script>
 	<script src="js/plugins/nanogress.1.0.min.js"></script>
    <script src="js/plugins/simpleselect.1.0.min.js"></script>
      
    <!-- // Third-party plugins // -->
    <script src="js/plugins/tinyscrollbar.min.js"></script>
    <!-- mouse wheel opt-->
    <script src="js/plugins/h5f.min.js"></script>
    <script src="js/plugins/hogan-2.0.0.js"></script>
    <script src="js/plugins/jquery.autosize-min.js"></script>
    <script src="js/plugins/layout.min.js"></script>
    <script src="js/plugins/masonry.pkgd.min.js"></script>
    
    <!-- // Custom //-->
    <script src="js/plugins/generics.js"></script>
     
</head>
<body> 
	<div id="container" class="clearfix">
                   
		<aside id="sidebar-main" class="sidebar">
            
        	<?php include_once('header.php'); ?>
            
			<?php include_once('navhome.php'); ?>
            
        </aside><!-- End aside -->
        
        
        
        <div id="main" class="clearfix">
       
			<?php include_once('topnav.php'); ?>
        
        
        
            <div id="content" class="clearfix">

                
                <header id="header-sec"> 
                	<div class="inner-padding"> 
                        <div class="pull-left">
                            <h2>Preferencias</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12">
                            <div class="row">
                            	<div class="col-sm-12">
                                    <div class="inner-padding">
											
											<?php if(isset($messagepasswd)): ?>
                	                			<?php echo $messagepasswd ?>
		                                	<?php endif ?>
											
											
                                        		<div class="spacer-25"></div>
                                        		<div class="col-sm-12">
												<div class="subheading">
													<h3>Contrase&ntilde;a</h3>
													<p>Puede cambiar su contrase&ntilde;a a continuaci&oacute;n:</p>
												</div>
												</div>
												
												<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" />
													<!--
													<div class="row"> 
														<div class="col-sm-3 text-right"> 
															<label>Contrase&ntilde;a Actual</label>
														</div>
														<div class="col-sm-7">
															<input name="" class="form-control" type="password" />
														</div>
													</div>
													-->
													<div class="spacer-15"></div>
													<div class="row"> 
														<div class="col-sm-3 text-right"> 
															<label>Contrase&ntilde;a Nueva</label>
														</div>
														<div class="col-sm-7">
															<input name="desired_password" class="form-control" type="password" />
														</div>
													</div>
													<div class="spacer-15"></div>
													<div class="row"> 
														<div class="col-sm-3 text-right"> 
															<label>Repetir Contrase&ntilde;a</label>
														</div>
														<div class="col-sm-7">
															<input name="desired_password1" class="form-control" type="password" />
														</div>
													</div>
													<div class="spacer-25"></div>
													
													<div class="col-sm-10">
														<div class="pull-right">
															<a href="dashboard.php" class="btn btn-warning">Cancelar</a>
															<input type="submit" class="btn btn-success" value="Cambiar Contrase&ntilde;a" name="btnSend" />
														</div>
					                                </div>
					                                
												</form>
												
											<div class="spacer-40"></div>
                                        
                                    </div><!-- End .inner-padding -->  
                                </div>
                            </div><!-- End .row -->
                        </div>
                        
                    </div>
                </div><!-- End .window -->
                
                
                <?php include_once('footer.php'); ?>
            </div><!-- End #content -->  
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container --> 
</body>
</html>