<?php //var_dump($_SESSION); 
//print_r($seccion); print_r($subseccion);
//echo '</pre>';
?>
 
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
			<li <?php if ($subseccion=="prospectoIndicadores"){echo 'class="page-arrow active-page"';}?>>
				<a href="prospectoIndicadores.php">
				<i class="icon-bar-chart"></i> Indicadores Ventas  
				</a>
			</li>
			<!-- 
			<li <?php if($subseccion=="ticketasig" ){echo 'class="menu-open"';}?>>
			
				<a href="#">
				<i class="fa fa-tags"></i> Tickets asignados
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>
				<li <?php if ($subseccion=="ticketasg"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasg.php">
						<i class="fa icon-cogs"></i> Soporte
						</a>
					</li>
					
				<li <?php if ($subseccion=="ticketasgFac"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasgFac.php">
						<i class="fa icon.checklist"></i> Factibilidad
						</a>
					</li>

				<li <?php if ($subseccion=="ticketasgPor"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasgPor.php">
						<i class="fa icon-headset_mic"></i> Portabilidad
						</a>
					</li>
					
				<li <?php if ($subseccion=="ticketasgInf"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasgInf.php">
						<i class="fa icon-perm_phone_msg"></i> Informes
						</a>
					</li>
					
			</ul>
			</li>
			
			<li <?php if ($subseccion=="clientesListado"){echo 'class="page-arrow active-page"';}?>>
				<a href="clientesListado.php">
				<i class="fa fa-group"></i> Clientes  
				</a>
			</li>
			
			<li <?php if ($subseccion=="contratoListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="contratoListado.php">
						<i class="fa fa-files-o"></i> Contratos 
						</a>
					</li>					
					
			<li <?php if ($subseccion=="prospectoListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="prospectoListado.php">
						<i class="fa fa-suitcase"></i> Prospectos 
						</a>
					</li>
					
								-->
			<?php endif;?>
			
			
			<?php if($seccion=="Administracion"):?>
			
			<li <?php if($subseccion=="altaCliente" || $subseccion=="edicionCliente" || $subseccion=="busquedaClientes" || $subseccion=="Clientes" || $subseccion=="crearContrato"  || $subseccion=="resumenCliente"){echo 'class="menu-open"';}?>>
			
				<a href="#">
				<i class="fa fa-suitcase"></i> Clientes
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>
				
					<li <?php if ($subseccion=="Clientes"){echo 'class="page-arrow active-page"';}?>>
						<a href="Clientes.php">
						<i class="fa fa-list"></i> Listado
						</a>
					</li>
					<li <?php if ($subseccion=="altaCliente"){echo 'class="page-arrow active-page"';}?>>
						<a href="altaCliente.php">
						<i class="fa icon-user-plus"></i> Alta de cliente
						</a>
					</li>
					<li <?php if ($subseccion=="busquedaClientes"){echo 'class="page-arrow active-page"';}?>>
						<a href="busquedaClientes.php">
						<i class="fa fa-search-plus"></i>B&uacute;squeda  
						</a>
					</li>
				</ul>
			</li>	
			
			<li <?php if( $subseccion=="altaComisionista" || $subseccion=="verComisionista" || $subseccion=="edicionComisionista" || $subseccion=="listaComisionistas" ){echo 'class="menu-open"';}?>>
			
				<a href="#">
				<i class="fa fa-suitcase"></i> Comisionistas
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>
				
					<li <?php if ($subseccion=="listaComisionistas"){echo 'class="page-arrow active-page"';}?>>
						<a href="listaComisionistas.php">
						<i class="fa fa-list"></i> Listado
						</a>
					</li>
					<li <?php if ($subseccion=="altaComisionista"){echo 'class="page-arrow active-page"';}?>>
						<a href="altaComisionista.php">
						<i class="fa icon-user-plus"></i> Alta de Comisionista
						</a>
					</li>
				</ul>
			</li>	
			
			
			<li <?php if ($subseccion=="listaSolicitudes"){echo 'class="page-arrow active-page"';}?>>
						<a href="listaSolicitudes.php">
						<i class="fa fa-check-square-o"></i> Solicitudes Pendientes
						</a>
					</li>
						

			<?php endif;?>	
			
			
			
					<?php if($seccion=="productos"):?>
			
					<li <?php if ($subseccion=="listadoProductos"){echo 'class="page-arrow active-page"';}?>>
						<a href="listadoProductos.php">
						<i class="fa fa-list"></i>Listado General 
						</a>
					</li>
					
					<li <?php if ($subseccion=="busquedaProductos"){echo 'class="page-arrow active-page"';}?>>
						<a href="busquedaProductos.php">
						<i class="fa fa-search-plus"></i>B&uacute;squeda  
						</a>
					</li>
					
					<li <?php if ($subseccion=="altaProducto"){echo 'class="page-arrow active-page"';}?>>
						<a href="altaProducto.php">
						<i class="fa fa-plus"></i>Alta de Producto 
						</a>
					</li>
					
					
					
			<?php endif;?>
							
		
		<?php if($seccion=="Almacen"):?>
					<li <?php if ($subseccion=="busquedaProductosAlmacen"){echo 'class="page-arrow active-page"';}?>>
						<a href="busquedaProductosAlmacen.php">
						<i class="fa fa-search-plus"></i>B&uacute;squeda  
						</a>
					</li>
					
					<li <?php if ($subseccion=="registroEntrada"){echo 'class="page-arrow active-page"';}?>>
						<a href="registroEntrada.php">
						<i class="fa fa-sign-in"></i>Registro de Entrada 
						</a>
					</li>
					<li <?php if ($subseccion=="registroSalida"){echo 'class="page-arrow active-page"';}?>>
						<a href="registroSalida.php">
						<i class="fa fa-sign-out"></i>Registro de Salida 
						</a>
					</li>
					<li <?php if ($subseccion=="registroTraslado"){echo 'class="page-arrow active-page"';}?>>
						<a href="registroTraslado.php">
						<i class="fa fa-share-square-o"></i>Registro de Traslado 
						</a>
					</li>
					
					
					<li <?php if ($subseccion=="historial"){echo 'class="page-arrow active-page"';}?>>
						<a href="historial.php">
						<i class="fa fa-calendar"></i>Historial 
						</a>
					</li>
					
					
			<?php endif;?>	
			
			<?php if($seccion=="Ventas"):?>
					<li <?php if ($subseccion=="prospectoAlta" || $subseccion=="prospectoListado" || $subseccion=="prospectoAutorizacion" || $subseccion=="prospectoRoot" ){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa fa-suitcase"></i> Prospecci&oacute;n
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>			
					<li <?php if ($subseccion=="prospectoAlta"){echo 'class="page-arrow active-page"';}?>>
						<a href="prospectoAlta.php">
						<i class="fa fa-tag"></i> Alta de Prospecto
						</a>
					</li>
					<li <?php if ($subseccion=="prospectoListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="prospectoListado.php">
						<i class="fa fa-list"></i> Listado 
						</a>
					</li>
					<li <?php if ($subseccion=="prospectoAutorizacion"){echo 'class="page-arrow active-page"';}?>>
						<a href="prospectoAutorizacion.php">
						<i class="fa fa-check-square-o"></i> Autorizac&oacute;n
						</a>
					</li>
						<li <?php if ($subseccion=="prospectoRoot"){echo 'class="page-arrow active-page"';}?>>
							<a href="prospectoRoot.php">
							<i class="fa fa-user"></i> Root View
							</a>
						</li>
				</ul>
			</li>
			
			<li <?php if ($subseccion=="contratoAlta" || $subseccion=="contratoListado" || $subseccion=="contratoRoot" || $subseccion=="altaNewPCliente" || $subseccion=="ClientesDocumentos" || $subseccion=="DocumentosHistorial" || $subseccion=="crearLogin" || $subseccion=="altaServiciosCliente" || $subseccion=="altaDocumentos" || $subseccion=="descargarContratoPdf" || $subseccion=="editServiciosCliente" || $subseccion=="editDocumentos" || $subseccion=="editDescargarContratoPdf"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa fa-file-text"></i> Contratos
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>			
					<li <?php if ($subseccion=="contratoAlta" || $subseccion=="altaNewPCliente" || $subseccion=="crearLogin" || $subseccion=="altaServiciosCliente" || $subseccion=="altaDocumentos" || $subseccion=="descargarContratoPdf" || $subseccion=="editServiciosCliente" || $subseccion=="editDocumentos" || $subseccion=="editDescargarContratoPdf"){echo 'class="page-arrow active-page"';}?>>
						<a href="altaNewPCliente.php">
						<i class="fa fa-plus"></i> Alta de Contrato
						</a>
					</li>
					<li <?php if ($subseccion=="contratoListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="contratoListado.php">
						<i class="fa fa-list"></i> Listado 
						</a>
					</li>					
					<li <?php if ($subseccion=="contratoRoot"){echo 'class="page-arrow active-page"';}?>>
						<a href="contratoRoot.php">
						<i class="fa fa-user"></i> Root View
						</a>
					</li>
					<li <?php if ($subseccion=="ClientesDocumentos" || $subseccion=="DocumentosHistorial"){echo 'class="page-arrow active-page"';}?>>
						<a href="ClientesDocumentos.php">
						<i class="fa fa-file-o"></i> Historial Documentos
						</a>
					</li>
				</ul>
			</li>
			
			<li <?php if ($subseccion=="factibilidadListado" || $subseccion=="factibilidadSolicitud"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa icon-checklist"></i> Factibilidad
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>								
					<li <?php if ($subseccion=="factibilidadListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="factibilidadListado.php">
						<i class="fa fa-list"></i> Listado de Factibilidad
						</a>
					</li>					
					<li <?php if ($subseccion=="factibilidadSolicitud"){echo 'class="page-arrow active-page"';}?>>
						<a href="factibilidadSolicitud.php">
						<i class="fa icon-diff"></i> Solicitud de Factibilidad 
						</a>
					</li>
				</ul>
			</li>
			
			<li <?php if ($subseccion=="portabilidadListado" || $subseccion=="portabilidadSolicitud"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa icon-headset_mic"></i> Portabilidad
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>								
					<li <?php if ($subseccion=="portabilidadListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="portabilidadListado.php">
						<i class="fa fa-list"></i> Listado de Portabilidad
						</a>
					</li>					
					<li <?php if ($subseccion=="portabilidadSolicitud"){echo 'class="page-arrow active-page"';}?>>
						<a href="portabilidadSolicitud.php">
						<i class="fa fa-pencil"></i> Solicitud de Portabilidad 
						</a>
					</li>
				</ul>
			</li>
			
			<li <?php if ($subseccion=="cotizacionesListado" || $subseccion=="detalleCotizador"|| $subseccion=="cotizador"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa fa-table"></i> Cotizador
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>								
					<li <?php if ($subseccion=="cotizacionesListado"){echo 'class="page-arrow active-page"';}?>>
						<a href="cotizacionesListado.php">
						<i class="fa fa-list"></i> Listado de Cotizaciones
						</a>
					</li>					
					<li <?php if ($subseccion=="cotizador"){echo 'class="page-arrow active-page"';}?>>
						<a href="cotizador.php">
						<i class="fa icon-calculator"></i> Cotizador
						</a>
					</li>
				</ul>
			</li>
			
			<li <?php if ($subseccion=="listadoProd" || $subseccion=="busquedaProd"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa fa-shopping-cart"></i> Productos
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>								
					<li <?php if ($subseccion=="listadoProd"){echo 'class="page-arrow active-page"';}?>>
						<a href="listadoProd.php">
						<i class="fa fa-list"></i> Listado de Productos
						</a>
					</li>					
					<li <?php if ($subseccion=="busquedaProd"){echo 'class="page-arrow active-page"';}?>>
						<a href="busquedaProd.php">
						<i class="fa fa-search"></i> Busqueda de Productos
						</a>
					</li>
				</ul>
			</li>
			

			<?php endif;?>	

		<?php if($seccion=="soporte"):?>
			
			<?php echo '<script type="text/javascript" src="js/system/adminTicketsAsg.js"></script>'; ?>
			
			<li <?php if ($subseccion=="ticket" || $subseccion=="tickethis" || $subseccion=="ticketasg" || $subseccion=="ticketadd" || $subseccion=="ticketrev" || $subseccion=="ticketroot"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa icon-cogs"></i> Tickets Soporte
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>	
					<li <?php if ($subseccion=="ticket"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticket.php">
						<i class="fa fa-stack-exchange"></i> Tickets abiertos <span id="spanTicketSop"></span>
						</a>
					</li>
					<?php if ($objSession->getIdRol()>3):?>
					<li <?php if ($subseccion=="ticketasg"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasg.php">
						<i class="fa fa-stack-exchange"></i> Tickets asignados <span id="spanTicketAsgSop"></span>
						</a>
					</li>
					<?php endif;?>
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
					<li <?php if ($subseccion=="ticketroot"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketroot.php">
						<i class="fa fa-user"></i> Root View
						</a>
					</li>
					
					
				</ul>
			</li>
			
			
			
			<li <?php if ($subseccion=="ticketFac" || $subseccion=="ticketasgFac" || $subseccion=="ticketaddFac" || $subseccion=="tickethisFac" || $subseccion=="ticketrootFac" || $subseccion=="ticketrevFac" ){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa icon-checklist"></i> Tickets de Factibilidad
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>	
					<li <?php if ($subseccion=="ticketFac"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketFac.php">
						<i class="fa fa-stack-exchange"></i> Tickets abiertos <span id="spanTicketFac"></span>
						</a>
					</li>
					<?php if ($objSession->getIdRol()>3):?>
					<li <?php if ($subseccion=="ticketasgFac"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasgFac.php">
						<i class="fa fa-stack-exchange"></i> Tickets asignados <span id="spanTicketAsgFac"></span>
						</a>
					</li>
					<?php endif;?>
					<li <?php if ($subseccion=="ticketaddFac"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketaddFac.php">
						<i class="fa fa-pencil"></i> Crear ticket
						</a>
					</li>
					<li <?php if ($subseccion=="tickethisFac"){echo 'class="page-arrow active-page"';}?>>
						<a href="tickethisFac.php">
						<i class="fa fa-clock-o"></i> Hist&oacute;rico
						</a>
					</li>
					<li <?php if ($subseccion=="ticketrootFac"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketrootFac.php">
						<i class="fa fa-user"></i> Root View
						</a>
					</li>
					
					
				</ul>
			</li>
			
			
			<li <?php if ($subseccion=="ticketPor" || $subseccion=="tickethisPor" || $subseccion=="ticketasgPor" || $subseccion=="ticketaddPor" || $subseccion=="ticketrevPor" || $subseccion=="ticketrootPor"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa icon-headset_mic"></i> Tickets de Portabilidad
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>	
					<li <?php if ($subseccion=="ticketPor"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketPor.php">
						<i class="fa fa-stack-exchange"></i> Tickets abiertos <span id="spanTicketPor"></span>
						</a>
					</li>
					<?php if ($objSession->getIdRol()>3):?>
					<li <?php if ($subseccion=="ticketasgPor"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasgPor.php">
						<i class="fa fa-stack-exchange"></i> Tickets asignados <span id="spanTicketAsgPor"></span>
						</a> 
					</li>
					<?php endif;?>
					<li <?php if ($subseccion=="ticketaddPor"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketaddPor.php">
						<i class="fa fa-pencil"></i> Crear ticket
						</a>
					</li>
					<li <?php if ($subseccion=="tickethisPor"){echo 'class="page-arrow active-page"';}?>>
						<a href="tickethisPor.php">
						<i class="fa fa-clock-o"></i> Hist&oacute;rico
						</a>
					</li>
					<li <?php if ($subseccion=="ticketrootPor"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketrootPor.php">
						<i class="fa fa-user"></i> Root View
						</a>
					</li>
					
					
				</ul>
			</li>
			
			<li <?php if ($subseccion=="ticketInf" || $subseccion=="tickethisInf" || $subseccion=="ticketasgInf" || $subseccion=="ticketaddInf" || $subseccion=="ticketrevInf" || $subseccion=="ticketrootInf"){echo 'class="menu-open"';}?>>
				<a href="#">
				<i class="fa icon-perm_phone_msg"></i> Tickets de Informes
				<i class="fa fa-caret-left pull-right"></i>
				</a>
			
				<ul>	
					<li <?php if ($subseccion=="ticketInf"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketInf.php">
						<i class="fa fa-stack-exchange"></i> Tickets abiertos <span id="spanTicketInf"></span>
						</a>
					</li>
					<?php if ($objSession->getIdRol()>3):?>
					<li <?php if ($subseccion=="ticketasgInf"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketasgInf.php">
						<i class="fa fa-stack-exchange"></i> Tickets asignados <span id="spanTicketAsgInf"></span>
						</a>
					</li>
					<?php endif;?>
					<li <?php if ($subseccion=="ticketaddInf"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketaddInf.php">
						<i class="fa fa-pencil"></i> Crear ticket
						</a>
					</li>
					<li <?php if ($subseccion=="tickethisInf"){echo 'class="page-arrow active-page"';}?>>
						<a href="tickethisInf.php">
						<i class="fa fa-clock-o"></i> Hist&oacute;rico
						</a>
					</li>
					<li <?php if ($subseccion=="ticketrootInf"){echo 'class="page-arrow active-page"';}?>>
						<a href="ticketrootInf.php">
						<i class="fa fa-user"></i> Root View
						</a>
					</li>
					
					
				</ul>
			</li>
			
			
			<?php endif;?>	
				
			
			
			<?php if($seccion=="Atencion"):?>
<!-- 			<li <?php if ($subseccion=="clientesListado"){echo 'class="page-arrow active-page"';}?>>
				<a href="clientesListado.php">
				<i class="fa fa-list"></i>  Listado de clientes
				</a>
			</li>
	-->		
			<li <?php if ($subseccion=="clientesBusqueda"){echo 'class="page-arrow active-page"';}?>>
				<a href="clientesBusqueda.php">
				<i class="fa fa-search-plus"></i> B&uacute;squeda de cliente
				</a>
			</li>
			
			<?php endif;?>
			
			
			
			<?php if($seccion=="servicios"):?>
			
					<li <?php if ($subseccion=="internetAdministracion"||$subseccion=="cloudIp"){echo 'class="page-arrow active-page"';}?>>
						<a href="internetAdministracion.php">
						<i class="fa fa-cloud"></i> Internet
						</a>
					</li>
					
					<li <?php if ($subseccion=="voiceIp"||$subseccion=="voiceIpD"){echo 'class="page-arrow active-page"';}?>>
						<a href="voiceIp.php">
						<i class="fa fa-phone"></i> Planet Voice
						</a>
					</li>
					
					
					
					<li <?php if ($subseccion=="equipamiento"||$subseccion=="equipamientoPlanetD" ){echo 'class="page-arrow active-page"';}?>>
						<a href="equipamiento.php">
						<i class="fa fa-desktop"></i> Equipamiento
						</a>
					</li>
					
					<li <?php if ($subseccion=="ucc"||$subseccion=="uccD"){echo 'class="page-arrow active-page"';}?>>
						<a href="ucc.php">
						<i class="fa fa-wrench"></i> Planet ucc
						</a>
					</li>			 					
					
				<li <?php if ($subseccion=="videoPlanet" || $subseccion=="videoServicios" ){echo 'class="menu-open active-page"';}?>>
				<a href="videoServicios.php">
				<i class="fa fa-play-circle-o"></i> Centro de Video Planet
<!-- 				<i class="fa fa-caret-left pull-right"></i> -->
				</a>
<!-- 				<ul> -->
					<li <?php if ($subseccion=="videoServicios"||$subseccion=="videoPlanet"){echo 'class="page-arrow active-page"';}?>>
<!-- 						<a href="videoServicios.php"> -->
<!-- 						<i class="fa fa-group"></i>Video						 -->
<!-- 						</a> -->
<!-- 					</li> -->
					<li <?php if ($subseccion=="videoAgendar"){echo 'class="menu-open""';}?>>
<!-- 						<a href="#"> -->
<!-- 						<i class="fa fa-calendar"></i> Administraci&oacute;n -->
<!-- 						<i class="fa fa-caret-left pull-right"></i> -->
<!-- 						</a> -->
<!-- 						<ul> -->
							<li <?php if ($subseccion=="videoPlan"){echo 'class="page-arrow active-page"';}?>>
<!-- 							<a href="videoPlan.php"> -->
<!-- 							<i class="fa fa-list-ol"></i>Planes -->
<!-- 							</a> -->
<!-- 							</li> -->
							<li <?php if ($subseccion=="videoDispositivos"){echo 'class="page-arrow active-page"';}?>>
<!-- 							<a href="videoDispositivos.php"> -->
<!-- 							<i class="fa fa-tags"></i>Dispositivos -->
<!-- 							</a> -->
<!-- 							</li> -->
							<li <?php if ($subseccion=="videoConfiguracion"){echo 'class="page-arrow active-page"';}?>>
<!-- 							<a href="videoConfiguracion.php"> -->
<!-- 							<i class="fa fa-wrench"></i>Configuraci&oacute;n -->
<!-- 							</a> -->
<!-- 							</li>						 -->
							<li <?php if ($subseccion=="videoHistorial"){echo 'class="page-arrow active-page"';}?>>
<!-- 								<a href="videoHistorial.php"> -->
<!-- 								<i class="fa fa-clock-o"></i>Historial -->
<!-- 								</a> -->
<!-- 							</li> -->
<!-- 						</ul> -->
<!-- 					</li> -->
<!-- 					<li> -->
<!-- 					<a href="#"> -->
<!-- 				<i class="fa fa-pencil-square-o"></i> Reuniones -->
<!-- 				<i class="fa fa-caret-left pull-right"></i> -->
<!-- 				</a> -->
<!-- 				<ul> -->
					<li <?php if ($subseccion=="videoReuniones"){echo 'class="page-arrow active-page"';}?>>
<!-- 						<a href="videoReuniones.php"> -->
<!-- 						<i class="fa fa-group"></i>Listado de reuniones -->
<!-- 						</a> -->
<!-- 					</li> -->
					<li <?php if ($subseccion=="videoAgendar"){echo 'class="page-arrow active-page"';}?>>
<!-- 						<a href="videoAgendar.php"> -->
<!-- 						<i class="fa fa-calendar"></i>Agendar reuni&oacute;n -->
<!-- 						</a> -->
<!-- 					</li> -->
					<li <?php if ($subseccion=="videoHistorial"){echo 'class="page-arrow active-page"';}?>>
<!-- 						<a href="videoHistorial.php"> -->
<!-- 						<i class="fa fa-clock-o"></i>Historial -->
<!-- 						</a> -->
<!-- 					</li> -->
					
<!-- 				</ul> -->
<!-- 					</li> -->
<!-- 				</ul> -->
			</li>
			<?php endif;?>
			
			
			
	
			
			
	</ul>
		
		
		
		</ul>
	</nav><!-- End .sidebar-nav-v1 -->
</div> 			