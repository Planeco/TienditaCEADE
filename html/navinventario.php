			<div class="sidebar-module"> 
					<nav class="sidebar-nav-v2">                         
						<ul>
							<li <?php if(($subnav == 'inventariolista') OR ($subnav == 'inventarioproducto') OR ($subnav == 'inventarioalta') OR ($subnav == 'inventarioreportes') OR ($subnav == 'inventarioreportes')){echo 'class="menu-open"';} ?>>
                                    <a href="#"><i class="fa fa-dropbox"></i> Recursos Materiales <i class="fa fa-caret-down pull-right"></i></a>
                                    <!-- * sub menu * -->
                                    <ul>
                                        <li <?php if($subnav == 'inventariolista'){echo 'class="page-arrow active-page"';} ?>>
                                            <a href="inventario.php"><i class="fa fa-sort-alpha-asc"></i> Inventario</a>
                                        </li>
                                        <li <?php if($subnav == 'inventarioproducto'){echo 'class="page-arrow active-page"';} ?>>
                                            <a href="inventarioingreso.php"><i class="fa fa-thumbs-o-down"></i> Ingresar Producto</a>
                                        </li>
                                        <li <?php if($subnav == 'inventarioalta'){echo 'class="page-arrow active-page"';} ?>>
                                            <a href="inventarioalta.php"><i class="fa fa-plus"></i> Alta de Producto</a>
                                        </li>
                                        <li <?php if($subnav == 'inventarioreportes'){echo 'class="page-arrow active-page"';} ?>>
                                            <a href="inventarioreportes.php"><i class="fa fa-bar-chart-o"></i> Reportes</a>
                                        </li>
                                        <li <?php if($subnav == 'inventarioreportes'){echo 'class="page-arrow active-page"';} ?>>
                                            <a href="inventariobusqueda.php"><i class="fa fa-search"></i> Búsqueda Producto</a>
                                        </li>
                                    </ul>
                            </li>
						</ul>
					</nav><!-- End .sidebar-nav-v1 --> 
			</div>