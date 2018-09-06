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
                    	<li <?php if ($seccion=="caja"){ echo 'class="active"'; }?>><a href="puntoVenta.php">Caja</a></li>
                    	<li <?php if ($seccion=="inventario"){ echo 'class="active"'; }?>><a href="altaProducto.php">Inventario</a></li>
                    <li <?php if ($seccion=="soporte"){ echo 'class="active"'; }?>><a href="ticket.php">Soporte</a></li>
                    <li <?php if ($seccion=="preferencias"){ echo 'class="active"'; }?>><a href="contrasena.php">Preferencias</a></li>
                    
                        </ul>
                        <!-- End .breadcrumb -->

                    </div>
                </div><!-- End #header-main-bottom -->
            </header>