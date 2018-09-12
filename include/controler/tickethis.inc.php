<?php
   //require_once FOLDER_MODEL_EXTEND. "model..inc.php";
	
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
	
	function muestraTabla($arrTickets){
	    $r=new xajaxResponse();
	    global $dbLink;
		        foreach ($arrTickets as $ticket){
	            $segundos=strtotime('now') - strtotime($ticket['fecha']);
	            $diferencia_dias=intval($segundos/60/60/24);
	            if($diferencia_dias>0&&$diferencia_dias<3){
	                $cadena_dias = '<strong style="color:green;"><i class="fa fa-clock-o text-muted"></i> '.$diferencia_dias.' d&iacute;as abierto</strong>';
	            }else if($diferencia_dias>2&&$diferencia_dias<6){
	                $cadena_dias = '<strong style="color:yellow;"><i class="fa fa-clock-o text-muted"></i> '.$diferencia_dias.' d&iacute;as abierto</strong>';
	            }else if($diferencia_dias>5){
	                $cadena_dias = '<strong style="color:red;"><i class="fa fa-clock-o text-muted"> </i> '.$diferencia_dias.' d&iacute;as abierto</strong>';
	            }else if($diferencia_dias==0){
	                $cadena_dias = 'Nuevo';
	            }
	            $listado .= '<tr>
						<td>'.$ticket['id_ticket'].'</td>
						<td>'.$ticket['titulo'].'</td>
						<td>'.$ticket['nombreUsuario'].'</td>
						<td>'.($ticket['nombreUsuario2']).'</td>
						'.$ticket['tipo'].'
						<!--<td><span class="label label-'.$ticket['prioridad'].'">'.$ticket['nprioridad'].'</span></td>-->
						<td><i class="'.$ticket['estatus'].'"></i> '.$ticket['nestatus'].'</td>
<!--						<td>'.date("d M Y h:i:s", strtotime($ticket['fecha'])).'</td>
          <td>'.$cadena_dias.'</td>-->
						<td>
            		<a href="javascript:abrirTicket('.$ticket['id_ticket'].');"class="btn btn-default" name="btnPreview"><i class="fa fa-folder-open"></i></a>
						</td>
					</tr>';
	            
	        }
	    $r->assign("tbodyTickets","innerHTML", $listado);
		return $r;
	}
	$xajax->registerFunction("muestraTabla");
	

	function verTicket($idTicket)
	{
	    $r=new xajaxResponse();
	    $_SESSION['tid']=$idTicket;
	    
	    $r->redirect("ticketrev.php",2);
	    
	    return $r;
	    
	}
	$xajax->registerFunction("verTicket");
	
	
	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	if(isset($_SESSION['tid'])){unset($_SESSION['tid']);}
