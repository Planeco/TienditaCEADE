<link rel="stylesheet" href="css/style.css"/>

<div class="sidebar-module">
	<nav class="sidebar-nav-v2">
		<ul>
			<?php if($seccion=="inicio"):?>
			<li <?php if ($subseccion=="dashboard" ){echo 'class="page-arrow active-page"';}?>>
				<a href="dashboard.php">
				<i class="fa fa-home"></i> Principal  
				</a>
			</li>
			<?php endif;?>
			
			
			<?php if($seccion=="caja"):?>
			<li <?php if ($subseccion=="puntoVenta"){echo 'class="page-arrow active-page"';}?>>
				<a href="puntoVenta.php">
				<i class="fa fa-shopping-cart"></i> Punto de venta  
				</a>
			</li>
			<li <?php if ($subseccion=="cancelarRecibo"){echo 'class="page-arrow active-page"';}?>>
				<a href="cancelarRecibo.php">
				<i class="fa fa-exclamation"></i> Cancelar recibo  
				</a>
			</li>
			<li <?php if ($subseccion=="corteDia"){echo 'class="page-arrow active-page"';}?>>
				<a href="corteDia.php">
				<i class="fa fa-archive"></i> Corte del d&iacute;a  
				</a>
			</li>
			
			
			<?php endif;?>
			
			
			<?php if($seccion=="inventario"):?>
			<li <?php if ($subseccion=="altaProducto"){echo 'class="page-arrow active-page"';}?>>
				<a href="altaProducto.php">
				<i class="fa fa-plus"></i> Agregar producto   
				</a>
			</li>
			<li <?php if ($subseccion=="ingreso"){echo 'class="page-arrow active-page"';}?>>
				<a href="ingreso.php">
				<i class="fa fa-usd"></i> Ingreso   
				</a>
			</li>
			<li <?php if ($subseccion=="reportes" || $subseccion=="reportes"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa fa-folder-open"></i> Reportes
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>
				</ul>
			</li>
			<li <?php if ($subseccion=="busqueda"){echo 'class="page-arrow active-page"';}?>>
				<a href="busqueda.php">
				<i class="fa fa-search-plus"></i> B&uacute;squeda   
				</a>
			</li>
			
			<?php endif;?>
			
			
			<?php if($seccion=="soporte"):?>
			<li <?php if ($subseccion=="ticket"){echo 'class="page-arrow active-page"';}?>>
				<a href="ticket.php">
				<i class="fa fa-ticket"></i> Mis tickets    
				</a>
			</li>
			<li <?php if ($subseccion=="ticketadd"){echo 'class="page-arrow active-page"';}?>>
				<a href="ticketadd.php">
				<i class="fa fa-pencil"></i> Crear ticket
				</a>
			</li>
			<li <?php if ($subseccion=="tickethis"){echo 'class="page-arrow active-page"';}?>>
				<a href="tickethis.php">
				<i class="fa fa-clock-o"></i> Hist&oacute;rico    
				</a>
			</li>
			
			<?php endif;?>
			
			
			<?php if($seccion=="preferencias"):?>
			<li <?php if ($subseccion==""){echo 'class="page-arrow active-page"';}?>>
				<a href="contrasena.php">
				<i class="fa fa-pencil-square-o"></i> Contrase&ntilde;a  
				</a>
			</li>
			
			<?php endif;?>
				</ul>
		
	</nav><!-- End .sidebar-nav-v1 -->
</div> 			