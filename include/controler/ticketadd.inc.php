<?php
   //require_once FOLDER_MODEL_EXTEND. "model..inc.php";
require_once FOLDER_MODEL_EXTEND . "model.ticket_prioridad.inc.php";
require_once FOLDER_CONTROLLER.'admintickets.inc.php';
	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax = new xajax();
	
	function GuardarTicket($arrDatosTickets,$archivos_nombre,$desc_arc)
	{
	    
	    global $objSession;
	    $r=new xajaxResponse();
	    
	    
	    $arrDatosTickets['fecha'] = date('Y-m-d H:i:s');
	    $arrDatosTickets['fechaResolucion'] = date('Y-m-d H:i:s');
	    $arrDatosTickets['idPerfil']= $objSession->getIdLogin();
	    
	    
	    if (guardaTicket($arrDatosTickets,$archivos_nombre,$desc_arc)){
	        $perfil= obtenerDatosPerfil($objSession->getIdLogin());
	        $perfil_autorizador=obtenerDatosPerfil($arrDatosTickets['perfilAsignado']);
	        $estatus = obtener_informacion_registro('ticket_status', 'id_tstatus', $arrDatosTickets['estatus']);
	        $tipo = obtener_informacion_registro('ticket_tipo', 'id_ttipo', $arrDatosTickets['tipoSolicitud']);
	        
	        $extra = '<br /><br />T&iacute;tulo: '.$arrDatosTickets['titulo'].'<br />';
	        $extra .= 'Estatus: '.$estatus['nombre'].'<br />';
	        $extra .= 'Tipo: '.$tipo['nombre'].'<br />';
	        preparar_mail_ticket($perfil, $perfil_autorizador, 'ticket', 'registrado', 'autorizador', $extra);
	        
	        $r->ocultarMensaje();
	        $r->mostrarAviso("Su petici&oacute;n ha sido registrada correctamente.<br />En breve estaremos atendiendo la petici&oacute;n.");
	        
	        $r->redirect("ticket.php",2);
	    }else{
	        $r->mostrarAviso("Ha ocurrido un error, no ha sido registrado correctamente el ticket.");
	    }
	    return $r;
	    
	}
	$xajax->registerFunction("GuardarTicket");
	
	

	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	
	$sql = "SELECT * FROM grupos_atencion WHERE id_encargado =".$objSession->getIdUser();
	$res = mysqli_query($dbLink, $sql);
	if ($res && mysqli_num_rows($res) > 0) 
	    $comboAsignar=1;
	else 
	    $comboAsignar=0;
	
	 $tprioridad= new ModeloTicket_prioridad();
	 $arrPrioridad=$tprioridad->obtenerPrioridad();