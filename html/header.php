			<div class="sidebar-logo">
            	<a href="dashboard.php" id="logo-big">
            		<h1>Tiendita</h1>
            	</a>
            </div><!-- End .sidebar-logo -->
                    
            <div class="sidebar-module"> 
                <div class="sidebar-profile">
                	<div class="dropdown ext-dropdown-profile">
						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
						<img src="images/users/user-1.jpg" alt="" class="avatar"/>
							Hola, <strong><?php echo $objSession->getNombre() ?></strong>
							<i class="fa fa-caret-down pull-right"></i>
						</a>
						<ul role="menu" class="dropdown-menu">
							<li>
								<a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a>
							</li>
							<li>
								<a href="preferencias.php"><i class="fa fa-cogs"></i> Preferencias</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><i class="fa fa-sign-out"></i> Salir</a>
							</li>
						</ul>
	                </div>
                </div>
            </div><!-- /sidebar -->
                    
            <div class="sidebar-line"><!-- A seperator line --></div>
            <?php 
            include 'activarmenus.php';
            ?>