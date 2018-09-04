			<div class="sidebar-module"> 
					<nav class="sidebar-nav-v2">                         
						<ul>
							<li <?php if($subnav == 'home'){echo 'class="page-arrow active-page"';} ?>>
								<a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a>
							</li>
              				<li <?php if($subnav == 'caja'){echo 'class="page-arrow active-page"';} ?>>
								<a href="caja.php"><i class="fa fa-comments"></i> Punto de Venta</a>
							</li>
							<li <?php if($subnav == 'cancelarrecibo'){echo 'class="page-arrow active-page"';} ?>>
								<a href="cancelarrecibo.php"><i class="fa fa-user"></i> Cancelar Recibo</a>
							</li>
							<li <?php if($subnav == 'corte'){echo 'class="page-arrow active-page"';} ?>>
								<a href="corte.php"><i class="fa fa-phone"></i> Corte del día</a>
							</li>
						</ul>
					</nav><!-- End .sidebar-nav-v1 --> 
			</div>