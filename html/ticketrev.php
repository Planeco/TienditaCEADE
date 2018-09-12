<?php
require ("masterIncludeLogin.inc.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8 no-js">      <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9 no-js">           <![endif]-->
<!--[if gt IE 9]>  <html class="no-js">                       <![endif]-->
<!--[if !IE]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Detalle del ticket #<?php echo $infoTicket['id_ticket']?></title>

<!-- // IOS webapp icons // -->

<meta name="apple-mobile-web-app-title" content="Karma Webapp">
<link rel="apple-touch-icon-precomposed" sizes="152x152"
	href="images/mobile/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="images/mobile/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120"
	href="images/mobile/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="images/mobile/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76"
	href="images/mobile/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="images/mobile/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed"
	href="images/mobile/apple-touch-icon.png" />
<link rel="shortcut icon" href="images/favicons/favicon.ico" />

<!-- // IOS webapp splash screens // -->

<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-1536x2008.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-1496x2048.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)"
	href="/images/mobile/apple-touch-startup-image-768x1004.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)"
	href="/images/mobile/apple-touch-startup-image-748x1024.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-640x1096.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-640x920.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"
	href="/images/mobile/apple-touch-startup-image-320x460.png" />

<!-- // Windows 8 tile // -->
<meta name="application-name" content="Unifica">
<meta name="msapplication-TileColor" content="#333333" />
<meta name="msapplication-TileImage"
	content="images/mobile/windows8-icon.png" />

<!-- // Handheld devices misc // -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="HandheldFriendly" content="true" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- // Stylesheets // -->
<link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="bootstrap/typeahead/typeahead.min.css" />
<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="css/bootstrap-custom.css" />
<link rel="stylesheet" href="css/bootstrap-extended.css" />
<link rel="stylesheet" href="css/animate.min.css" />
<link rel="stylesheet" href="css/helpers.css" />
<link rel="stylesheet" href="css/base.css" />
<link rel="stylesheet" href="css/light-theme.css" />
<link rel="stylesheet" href="css/mediaqueries.css" />

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


<script src="js/plugins/generics.js"></script>
	         <script src="ckeditor/ckeditor.js"></script>
   <script src="js/plugins/formData.js"></script>
	     
    <?php
    echo $_JAVASCRIPT_CSS;
    ?>
         
</head>
<body>
	<div id="container" class="clearfix">
		<aside id="sidebar-main" class="sidebar">            
        	<?php include_once('header.php'); ?>            
			<?php include_once('navhome.php'); ?>            
        </aside>
		<!-- End aside -->

		<div id="main" class="clearfix">       
			<?php include_once('topnav.php'); ?>                    
            <div id="content" class="clearfix">
				<header id="header-sec">
					<div class="inner-padding">
						<div class="pull-left">
							<h2>Ticket de Soporte #<?php echo $infoTicket['id_ticket']?></h2>
						</div>
					</div>
				</header>
				<div class="window">
					<div class="col-sm-12 inner-padding">
						<h3></h3>

						<div class="inner-padding">
						
								<div class="widget">
														<header>
                            				<h2><i class="fa fa-gears text-muted"></i>Informaci&oacute;n general</h2>
                            				</header>
                            			<input type="hidden" id="IdTicket_" value="<?php echo $_SESSION['tid']; ?>" />
                            			<input type="hidden" id="IdAsignado_" value="<?php echo $objSession->getIdLogin(); ?>" />
                            			<input type="hidden" id="hdTitulo" value="<?php echo $titulo; ?>" />
                            			<div>
                            				<div class="row ext-raster">
                            					<div class="col-sm-5">
                            						<div class="inner-padding">
	                            						<p><strong><i class="fa fa-user text-muted"></i> <?php echo $solicitante; ?></strong></p>
        		                                        <div class="spacer-5"></div>
<!-- 		                                            	<p class="text-muted"><i class="fa fa-suitcase text-muted"></i> <?php echo $rol; ?></p>
		                                            	<div class="spacer-5"></div>
		-                                            	<p class="text-muted"><i class="fa fa-map-marker text-muted"></i> <?php echo $ubicacion2; ?></p>
		                                            	<div class="spacer-5"></div>
		 -->                                           	<div class="spacer-5"></div>
                                                  <p class="text-muted"><i class="fa fa-calendar text-muted"></i> Fecha de creaci&oacute;n:</p>
                                                  <p class="text-muted"><i class="fa fa-clock-o text-muted"></i> <?php echo $fecha; ?> hrs</p>
                                                  <div class="spacer-5"></div>
                                                  <p class="text-muted">
                                                  <?php if($actualEstatus2 != 'Cerrado' && $actualEstatus2 != 'Cancelado'){ ?>
                                                  <?php                                                    
                                                    $segundos=strtotime('now') - strtotime($fecha);
                                                    $diferencia_dias=intval($segundos/60/60/24);                                                  
                                                  ?>
                                                    <?php if($diferencia_dias>=0&&$diferencia_dias<3){ ?>                                                  
                                                      <strong style="color:green;"><i class="fa fa-clock-o text-muted"></i> <?php echo $diferencia_dias; ?> d&iacute;as abierto</strong>                                                    
                                                    <?php }else if($diferencia_dias>2&&$diferencia_dias<6){ ?>
                                                      <strong style="color:yellow;"><i class="fa fa-clock-o text-muted"></i> <?php echo $diferencia_dias; ?> d&iacute;as abierto</strong>
                                                    <?php }else if($diferencia_dias>5){ ?>
                                                      <strong style="color:red;"><i class="fa fa-clock-o text-muted"> </i><?php echo $diferencia_dias; ?> d&iacute;as abierto</strong>
                                                    <?php } ?>
                                                  <?php } ?>
                                                  
                                                  </p>
                                                  
		                                            	<div class="spacer-20"></div>
		                                            	<p class="text-muted"><?php echo $estatus; ?></p>
		                                            	<div class="spacer-5"></div>
		                                            	<p class="text-muted">Asignado a: <?php echo $asignado; ?></p>
		                                            	<div class="spacer-10"></div>                        	
		                                            </div>
                            					</div>
                            					
                            					<div class="col-sm-7">
                            						<div class="inner-padding">
                            							<p><?php echo $prioridad; ?> <strong><?php echo $titulo; ?></strong></p>
		                                            	<div class="spacer-5"></div>
		                                            	<p><?php echo $notas; ?></p>
                            						</div>
                            					</div>
                            					
                            				</div>
                            			</div>
                            		</div>
                            		
                            			<div class="spacer-20"></div>
                            					<hr />
                            					<div class="spacer-20"></div>
                            					
                            					<?php echo $archivos; ?>
                            					
                            		
                            		
                            					<h4 class="text-muted"><i class="fa fa-comments-o text-muted"></i> &nbsp;Historial</h4>
                                                <div class="spacer-30"></div>
                                                
                                                
                                                <?php echo $historial; ?>
                                                
                                                
                                                <div class="spacer-20"></div>
                            					<hr />
                            					<div class="spacer-20"></div>
                            			
                            		
                            			 <?php if(($actualEstatus2 == 'Cancelado') || ($actualEstatus2 == 'Cerrado' )){ ?>
                            					
 								<h3 class="sectionTitle">
 								<i class="fa fa-comments-o text-muted"></i> &nbsp;Opciones
									</h3>
									<div class="col-sm-12">
                                                <div class="spacer-10"></div>
                            					
                            					<div class="col-sm-12">
                                                    <div class="row">
															<div class="col-sm-12">
																<div class="spacer-20"></div>
																<div class="pull-right">
																		<input type="hidden" name="txtIdTicket" value="<?php echo $_SESSION['tid']; ?>" />
																		<input type="submit" class="btn btn-warning" name="btnReabrir" id="btnReabrir" value="Reabrir Caso" />      
																		&nbsp;&nbsp;
																		<a href="ticket.php" class="btn btn-success">Regresar al Listado</a>
																</div>
															</div>
                                                    </div>
                                                </div>
                                        <?php }else{ ?>                                                                                                                                                                           
                                        
                                        
                            					<div class="col-sm-12">
                                                    <div class="row">
															
																	
 								<h4 class="text-muted"><i class="fa fa-cogs text-muted"></i> &nbsp; Opciones</h4>
								<div class="spacer-10"></div>
			                                                
															<input type="hidden" name="txtIdTicket" value="<?php echo $_SESSION['tid']; ?>" />
                              								<input type="hidden" name="txtTitulo" value="<?php echo $titulo; ?>" />
                             <?php
                                      if(isset($perfil_ultimo) && $perfil_ultimo!=''){
                                        ?>
                                        <input type="hidden" value="<?php echo $perfil_ultimo['id_perfil']; ?>" id="id_perfil_ultimo" />
                                        <input type="hidden" value="<?php echo $perfil_laboral_ultimo['id_empresa']; ?>" id="id_empresa_ultimo" />                                        
                                        <?php
                                      
                                      }
                                      if(isset($perfil_owner) && $perfil_owner!=''){
                                        ?>
                                        <input type="hidden" value="<?php echo $perfil_owner['id_perfil']; ?>" id="id_perfil_owner" />
                                        <input type="hidden" value="<?php echo $perfil_laboral_ultimo['id_empresa']; ?>" id="id_empresa_owner" />                                        
                                        <?php
                                      
                                      }
                                      
                                    ?>
                                    <input type="hidden" name="txtEstatus" id="txtEstatus" value=""/>
                              <div class="spacer-20"></div>
                            
	
								<a href="javascript: mostrar_opciones('enterado');"
											class="btn-square-icontext opciones enterado"> <i
											class="fa fa-check-circle"></i>
											<p>Enterado</p>
										</a>
										 <a href="javascript: mostrar_opciones('responder');"
											class="btn-square-icontext opciones responder "> <i
											class="fa fa-comments-o"></i>
											<p>Responder</p>
										</a> 
										<?php //if ($objSession->getIdLogin()==405):
                                    ?>
										<a href="javascript: mostrar_opciones('reasignar');"
											class="btn-square-icontext opciones reasignar "><i
											class="fa fa-reply-all"></i>
											<p>Reasignar</p>
										</a>
										<?php //endif;
                                    ?> 
										<a href="javascript: mostrar_opciones('comentario');"
											class="btn-square-icontext opciones comentario "> <i
											class="fa fa-stack-exchange"></i>
											<p>Comentario</p>
										</a> <a href="javascript: mostrar_opciones('resolver');"
											class="btn-square-icontext opciones resolver"> <i
											class="fa fa-lightbulb-o"></i>
											<p>Resolver</p>
										</a>
										
								
								
					<input type="hidden" name="txtEstatus" id="txtEstatus" value=""/>
										
										<!-- Solo para el creador del ticket.  -->
  																<?php if($objSession->getIdLogin() == $perfil): ?>
								<button name="btnCerrar" id="btnCerrar" class="btn-square-icontext">
    																<i class="fa fa-folder"></i>
    																<p>Cerrar</p>
    															</button>
  																<?php endif; ?>  
															
															
															<a href="ticket.php" class="btn-square-icontext">
																<i class="fa fa-times"></i>
																<p>Cancelar</p>
															</a>
                                                            
								
								<div class="spacer-40"></div>
								<div class="col-sm-12">
                                                <input type="hidden" id="txtAsignacion1" name="txtAsignacion1" value="<?php echo $perfil; ?>" />
        											<div id="contenedor_general" style="display: none;">
        											
        											
  															<div class="col-sm-4">
  															<div class="spacer-30"></div>
  															<div class="row">
  																<div class="col-sm-10">
  																	<label for="txtEstatus">Fecha:</label>
  																	<input type="text" name="txtFecha" class="form-control" value="<?php echo date('d M Y'); ?>" readonly /> 
  																</div>
  															</div>
  															<div class="spacer-10"></div>
  															<div class="row">
													<div id="contenedor_opciones_extra" style="display: none;">
														<div class="spacer-10"></div>
<!-- 													<?php // if ($objSession->getIdLogin()!=405){?> -->
														<div class="col-sm-10" id="divCat" style="display: none;">
		                                                    <label for="txtCategorias">Categor&iacute;as</label>
		                                                    <select name="txtCategoria" id="slcCategorias" class="form-control">
		                                                    <option value="">Seleccione una opci&oacute;n</option>
		                                                    </select>
	                                                	</div>
	                                                	<div class="spacer-20"></div>
<!--	                                                	<?php // }?> -->
														<div class="col-sm-10">
															<label for="txtAsignacion">Asignar a:</label>
                                                            <input type="hidden" id="idPerfilActual" value="<?php echo $objSession->getIdLogin(); ?>" />
                                                            <select name="txtAsignacion" class="form-control " id="slcPersonal">
                                                            <option value="">Seleccione una opci&oacute;n</option>
		                                                    </select> 
														</div>


													</div>
												</div>
  														  </div>
  														  
  														  
  															<div class="col-sm-7">
  																<div class="row">
  																	<div class="col-sm-12">
  																		<label for="txtResumen">Agregar Comentarios:</label>
  																	<textarea class="form-control" id="txtResumen" name="txtResumen" style=""></textarea>
  																	</div>
  	<script>
	var editor=CKEDITOR.replace('txtResumen');
	</script>
  																	
  																</div>
  															</div>
  															
  															<div class="spacer-30"></div>
  															
  															
  															
  															
  															
  								<div id="contenedor_agregar_archivos" style="display: none;">
                            					 <div class="col-sm-12">
	                                                <div class="spacer-20"></div>
    	                                            <hr />
    	                                             <div class="spacer-20"></div>
    	                                    <h4><i class="fa fa-cloud-upload text-muted"></i> &nbsp;&nbsp;<span class="text-muted">Adjuntar Documentos</span></h4> 
    	                                    
    	                                        </div>
    	                                        <div class="spacer-40"></div>
    	                                        <div class="col-sm-4">
									<div class="row row_archivos">
										<div class="col-sm-12">
										<div id="msjErrorArchivo" ></div>
										</div>
										<div class="spacer-10"></div>
										
										<div class="col-sm-8">
											<label for="image">Archivo 
											</label> <input type="file" name="archivoImagen" id="archivoImagen"  accept="image/*" />
											<div class="spacer-10"></div>
											<label>Descripci&oacute;n</label>
											<input type="text" name="txtDescripcionImagen" id="txtDescripcionImagen" class="form-control"  />
										</div>

										<div class="col-sm-3">
											<a href="javascript:agregar_archivo();" 
												class="btn-square-icontext"> <i class="fa fa-plus"></i>
												<p> Agregar</p>
											</a>
										</div>
									</div>
								</div>
								
								<div class="col-sm-7">
									<div class="table-wrapper" style="display: none" id="tablaArchivos">
										<header>
											<h3>Mis archivos</h3>
										</header>
										<div class="rt-table" id="divTabla">
											<table class="table table-bordered table-striped" id="tb1"
												data-rt-breakpoint="600">
												<thead>
													<tr>
														<th scope="col" colspan="2" data-rt-column="Archivo">Archivo</th>
														<th scope="col" colspan="3" data-rt-column="Descripcion">Descipci&oacute;n</th>
														<th scope="col" data-rt-column="Opciones">Opciones</th>
													</tr>
												</thead>
												
												<tbody id="contenedor_tabla">
												</tbody>
											</table>
										</div>
									</div>
								</div>
								
								
								</div>
								
                             <div class="spacer-20"></div>
															
  															<div class="col-sm-11">
    	                                        	<div class="spacer-20"></div>
                                                    	<div class="col-sm-12">
                                                    	<br />
                                                    		<div class="pull-right">
                                                    		<button class="btn btn-default" id="btnCancelar" name="btnCancelar"> Cancelar </button>												
												<button class="btn btn-primary" id="btnGuardar" name="btnGuardar"> Actualizar </button>
	                                                    	</div>
                                                    </div>
    	                                        </div>
    	                                        
        </div>                    		
                            		</div>
                              								
														
                                                    </div>
                                        <?php } ?>
                                        
                                        <div class="spacer-50"> </div>                            		
							<div class="col-sm-12"></div>
						</div>
						<div class="spacer-30"></div>
					</div>
				</div>
			</div> 
                <?php include_once('footer.php'); ?>
                
                
            </div>
		<!-- End #content -->
		<!-- ----------------------------------------------------------------------------------------- -->
		<!-- --------------------------Seccion de alertas y mensajes modales-------------------------- -->
		<!-- ----------------------------------------------------------------------------------------- -->
		<button id="_alertShow" type="button" class="btn btn-primary"
			data-toggle="modal" data-target=".aviso-modal-sm"
			style="display: none">&nbsp;</button>
		<div id="_modalDiv" class="modal fade aviso-modal-sm">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close" id="_alertCloseUp">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="_alertTitle">Aviso</h4>
					</div>
					<div class="modal-body" id="_alertBody"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"
							id="_alertClose">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- ----------------------------------------------------------------------------------------- -->
		<!-- ----------------------Fin de seccion de alertas y mensajes modales----------------------- -->
		<!-- ----------------------------------------------------------------------------------------- -->

	</div>
	<!-- End #main -->

	<!-- End #container -->
</body>
</html>