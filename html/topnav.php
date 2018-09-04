		<header id="header-main">
            	<div class="header-main-top">
                	<div class="pull-left">
                    
                    	<!-- * This is the responsive logo * --> 
                                   
                    	<a href="dashboard.php" id="logo-small"><h4>Cooperativa</h4></a>
                    </div>
                    <div class="pull-right">
                        <a href="#" id="responsive-menu-trigger">
                        	<i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>

                <div class="header-main-bottom">
                	<div>
                    	<ul class="breadcrumb">
                            <li <?php if($nav == 'inicio'){echo 'class="active"';} ?>><a href="dashboard.php">Inicio</a></li>
                        	<?php if(in_array('4', $_SESSION['rbac'])): ?>
                            <li <?php if($nav == 'inventario'){echo 'class="active"';} ?>><a href="inventario.php">Inventario</a></li>
                            <?php endif ?>
                            <?php if(in_array('3', $_SESSION['rbac'])): ?>
                            <li <?php if($nav == 'preferencias'){echo 'class="active"';} ?>><a href="preferencias.php">Preferencias</a></li>
                            <?php endif ?>
                            <li <?php if($nav == 'soporte'){echo 'class="active"';} ?>><a href="soporte.php">Soporte</a></li>
                        </ul>
                    </div> 
                </div>
            </header>