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