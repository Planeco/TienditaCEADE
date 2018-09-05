
<?php

	//print_r($objSession);
 include 'activarmenus.php';

	//$_menoLateral=generaMenuLateral();



?>
		<header id="header-main">
            	<div class="header-main-top">
                	<div class="pull-left">

                    	<!-- * This is the responsive logo * -->

                    	<a href="dashboard.php" id="logo-small"><h4>Unifica</h4><h5> </h5></a>
                    </div>
                    <div class="pull-right">
                        <a href="#" id="responsive-menu-trigger">
                        	<i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- End #header-main-top -->
                <div class="header-main-bottom">
                	<div>
                    	<ul class="breadcrumb">
                    	<!--
                    	<?php echo $_menuTop;?>
                    	-->
                    	<li <?php if ($seccion=="inicio"){ echo 'class="active"'; }?>><a href="dashboard.php">Inicio</a></li>
                    <li <?php if ($seccion=="soporte"){ echo 'class="active"'; }?>><a href="soporte.php">Soporte</a></li>
                    
                        </ul>
                        <!-- End .breadcrumb -->

                    </div>
                </div><!-- End #header-main-bottom -->
            </header>