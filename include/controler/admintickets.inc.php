<?php
if(!empty($_FILES['imagen']))
{
    $carpeta=$_SERVER['DOCUMENT_ROOT']."/";
    $archivo=$_FILES['imagen'];
    if($archivo['name']!=''){
        $tempFile = $archivo['tmp_name'];
        $targetPath = "./doctos/ticket/";
        if (!file_exists($carpeta.'doctos/'))
            mkdir($carpeta.'doctos/',0777);
            if (!file_exists($carpeta.'doctos/ticket/'))
                mkdir($carpeta.'doctos/ticket/',0777);
                $targetFile =  ($_POST['id']. '_' . $archivo['name']);
                $targetFileFinal = $targetPath.$targetFile;
                try{
                    move_uploaded_file($tempFile,$targetFileFinal);
                    echo true;
                }catch(Exception $e){
                    echo false;
                }
    }
    
}

if (isset($_POST ['tipotickets'])) {
    require_once FOLDER_MODEL_EXTEND . "model.ticket_tipo.inc.php";
    $ttipo= new ModeloTicket_tipo();
    $arrTipos=$ttipo->obtenerTipoTickets();
    echo obtenCombo($arrTipos, "Selecciona una opci&oacute;n");
}

if (isset($_POST ['tipoticket'])&&isset($_POST ['asignacion'])) {
    if ($_POST['asignacion']==1){
        require_once FOLDER_MODEL_EXTEND . "model.usuario_grupo.inc.php";
        $usuarios = new ModeloUsuario_grupo();
        echo json_encode(array("info"=>obtenCombo($usuarios->obtenerUsuarioGrupo($_POST['tipoticket']),"Selecciona un usuario")));
    }else{
        require_once FOLDER_MODEL_EXTEND . "model.grupos_atencion.inc.php";
        $grupo= new ModeloGrupos_atencion();
        $arr=$grupo->obtenerUsuarioGrupo($_POST['tipoticket']);
        echo json_encode(array("info"=>$arr['nombre'],"id"=>$arr['id_usuario']));
    }
}

if (isset($_POST ['ticketCampo1'])&&isset($_POST ['ticketCampo2'])) {
    $arr=obtenerTickets($objSession->getIdLogin(), $_POST ['ticketCampo1'],$_POST ['ticketCampo2']);
    echo json_encode(array($arr[0],$arr[1]));
}

if (isset($_POST ['responder'])) {
    echo obtenCombo(getUsersResponder($_POST['responder']), "Selecciona una opci&oacute;n");
}


function guardaTicket($arrDatosTickets, $archivos_nombre, $descr_arch) {
    global $dbLink;
    $sql = "INSERT INTO ticket VALUES
			(null, ". $arrDatosTickets['idPerfil'] . ", " . $arrDatosTickets ['perfilAsignado'] . ", '" . $arrDatosTickets ['fecha'] . "', '" . $arrDatosTickets ['fechaResolucion'] . "',
					 " . $arrDatosTickets ['estatus'] . ", " . $arrDatosTickets ['tipoSolicitud'] . ", " . $arrDatosTickets ['prioridad'] . ", '" . $arrDatosTickets ['titulo'] . "', '" . $arrDatosTickets ['resumen'] . "', 0)";
    if (mysqli_query ( $dbLink,$sql )) {
        $ticketID = mysqli_insert_id ($dbLink);
        $sql= "INSERT INTO ticket_movimiento VALUES (null, $ticketID, '".$arrDatosTickets ['fecha']."', ".$arrDatosTickets ['estatus']." , ".$arrDatosTickets['idPerfil'].", ".$arrDatosTickets ['perfilAsignado'].")";
        mysqli_query($dbLink, $sql);
        $coont=0;
        if ($archivos_nombre!=null)
            foreach($archivos_nombre as $archivo){
                $sql="INSERT INTO ticket_archivo VALUES (null, '". $arrDatosTickets['fecha']."', ".$ticketID.", ". $arrDatosTickets['idPerfil'] . ", '". $descr_arch[$coont] . "', './doctos/ticket/".($archivo)."')";
                mysqli_query($dbLink, $sql);
                $coont++;
                
        }
        return true;
    }
    return false;
    
}

function sanitize($data) {
    $data = trim ( $data );
    $data = htmlspecialchars ( $data );
    //	$data = mysql_real_escape_string ( $data );
    return $data;
}

function obtenerTickets($idPerfil,$campo,$campo2){
    global $dbLink;
    
    $sql = "SELECT T.id_ticket, T.id_asignado, T.fecha, TE.tag as estatus, TE.nombre as nestatus, T.titulo, TT.nombre as tipo, concat_ws(' ', us.nombre, us.apellidos) as nombreUsuario,
(SELECT TT2.nombre from ticket_tipo as TT2 WHERE TT2.id_ttipo=TT.id_padre) as categoria, TP.tag as prioridad, TP.nombre as nprioridad FROM ticket as T
JOIN ticket_prioridad as TP ON T.id_prioridad=TP.id_tprioridad
JOIN ticket_status as TE ON T.id_tstatus=TE.id_tstatus
JOIN ticket_tipo as TT ON T.id_tipo=TT.id_ttipo
JOIN login_user as U ON ".$campo2."=U.id_login
JOIN usuario as us on U.id_usuario=us.id_usuario
WHERE T.id_tstatus != 6	AND T.id_tstatus != 7
		AND ".$campo." =".$idPerfil."
		ORDER BY T.id_ticket DESC";
    $res = mysqli_query ( $dbLink, $sql );
    $arrTickets = array ();
    $count=mysqli_num_rows ( $res );
    if ($res && $count> 0) {
        while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
            $arrTicket = array(
                'id_ticket'=>$row_inf['id_ticket'],
                'fecha'=>$row_inf['fecha'],
                'estatus'=>$row_inf['estatus'],
                'nestatus'=>$row_inf['nestatus'],
                'titulo'=>$row_inf['titulo'],
                'tipo_solicitud'=>$row_inf['tipo'],
                'categoria'=>$row_inf['categoria'],
                'prioridad'=>$row_inf['prioridad'],
                'nprioridad'=>$row_inf['nprioridad'],
                'id_asignado'=>$row_inf['id_asignado'],
                'nombreUsuario'=>($row_inf['nombreUsuario'])
            );
            $arrTickets[]=$arrTicket;
        }
        
    }
    return array($arrTickets,$count);
    
}

function obtenerHistoriaTickets($idPerfil){
    global $dbLink;
    $nombre=obtenerDatosPerfil($idPerfil);
    $nombre=$nombre['nombre'];
    $sql = "SELECT T.id_ticket, T.id_solicitante , T.id_asignado, T.fecha, TE.tag as estatus, TE.nombre as nestatus, T.titulo, T.id_tipo,
		TP.tag as prioridad, TP.nombre as nprioridad FROM ticket as T
JOIN ticket_prioridad as TP ON T.id_prioridad=TP.id_tprioridad
JOIN ticket_status as TE ON T.id_tstatus=TE.id_tstatus
WHERE T.id_solicitante=".$idPerfil." OR T.id_asignado=".$idPerfil."
		ORDER BY T.id_ticket DESC";
    
    $res = mysqli_query ( $dbLink, $sql );
    $arrTickets = array ();
    if ($res && mysqli_num_rows ( $res ) > 0) {
        
        while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
            $arrTicket = array(
                'id_ticket'=>$row_inf['id_ticket'],
                'fecha'=>$row_inf['fecha'],
                'estatus'=>$row_inf['estatus'],
                'nestatus'=>$row_inf['nestatus'],
                'titulo'=>$row_inf['titulo'],
                'prioridad'=>$row_inf['prioridad'],
                'nprioridad'=>$row_inf['nprioridad']
            );
            if ($row_inf['id_solicitante']==$idPerfil){
                $arrTicket['nombreUsuario']=$nombre;
            }else {
                $perfil=obtenerDatosPerfil($row_inf['id_solicitante']);
                $arrTicket['nombreUsuario']=$perfil['nombre'];
            }
            if ($row_inf['id_asignado']==$idPerfil){
                $arrTicket['nombreUsuario2']=$nombre;
            }else {
                $perfil=obtenerDatosPerfil($row_inf['id_asignado']);
                $arrTicket['nombreUsuario2']=$perfil['nombre'];
            }
            
            $sqlpen=mysqli_query($dbLink, "SELECT nombre from ticket_tipo WHERE id_ttipo =".$row_inf['id_tipo']);
            if($sqlpen&&mysqli_num_rows($sqlpen)>0)
            {
                $pen_inf=mysqli_fetch_assoc($sqlpen);
                $arrTicket['tipo']= '<td>'.$pen_inf['nombre'].'</td>';
            }
            else
            {
                $arrTicket['tipo'] = '<td class="text-danger"><i class="fa fa-exclamation-triangle text-danger"></i> No Disponible.</td>';
            }
            
            
            
            $arrTickets[]=$arrTicket;
        }
        
    }
    return $arrTickets;
    
}

function obtenerInfoTicket($idTicket){
    global $dbLink, $objSession;
    
    $sql = "SELECT T.id_ticket, T.id_solicitante, T.id_asignado, T.fecha, T.fecha_resolucion, T.notas, T.titulo,
			TE.tag as estatus, TE.nombre as nestatus,
			TT.nombre as tipo, concat_ws(' ', us.nombre, us.apellidos) as nombreUsuario,
			(SELECT TT2.nombre from ticket_tipo as TT2 WHERE TT2.id_ttipo=TT.id_padre) as categoria,
			TP.tag as prioridad, TP.nombre as nprioridad FROM ticket as T
			JOIN ticket_prioridad as TP ON T.id_prioridad=TP.id_tprioridad
			JOIN ticket_status as TE ON T.id_tstatus=TE.id_tstatus
			JOIN ticket_tipo as TT ON T.id_tipo=TT.id_ttipo
			JOIN login_user as U ON T.id_asignado=U.id_login
            JOIN usuario as us on U.id_usuario=us.id_usuario
			WHERE T.id_ticket =".$idTicket;
    $res = mysqli_query ( $dbLink, $sql );
    $arrInfo = array ();
    
    //información general
    if ($res && mysqli_num_rows ( $res ) > 0) {
        $row_inf = mysqli_fetch_assoc ( $res ) ;
        $arrTicket = array(
            'id_ticket'=>$row_inf['id_ticket'],
            'fecha'=>$row_inf['fecha'],
            'fecha_resolucion'=>$row_inf['fecha_resolucion'],
            'notas'=>$row_inf['notas'],
            'estatus'=>$row_inf['estatus'],
            'nestatus'=>$row_inf['nestatus'],
            'titulo'=>$row_inf['titulo'],
            'tipo_solicitud'=>$row_inf['tipo'],
            'categoria'=>$row_inf['categoria'],
            'prioridad'=>$row_inf['prioridad'],
            'nprioridad'=>$row_inf['nprioridad'],
            'id_asignado'=>$row_inf['id_asignado'],
            'id_solicitante'=>$row_inf['id_solicitante'],
            'nombreUsuario'=>($row_inf['nombreUsuario'])
        );
        $arrInfo['info_general']=$arrTicket;
        
        
        $row = mysqli_fetch_assoc ( $res ) ;
        
        
        $sql = "SELECT concat_ws(' ', us.nombre, us.apellidos) as nombreUsuario from login_user as U
                JOIN usuario as us on U.id_usuario=us.id_usuario
                    where U.id_login=".$row_inf['id_solicitante'];
       /*
                    inner join rol as  r on l.id_rol=r.id_rol
                    inner join ubicacion as u on l.id_recaudacion=u.idUbicacion where id_login=".$row_inf['id_solicitante']; */
        $res = mysqli_query ( $dbLink, $sql );
        
        if ($res && mysqli_num_rows ( $res ) > 0) {
            $row_inf_user = mysqli_fetch_assoc ( $res ) ;
            $arrSolicitante = array(
                'nombreUsuario'=>utf8_encode($row_inf_user['nombreUsuario'])
//                'ciudad'=>utf8_encode($row_inf_user['ubicacion']),                'rol'=>$row_inf_user['rol_nombre']
            );
            $arrInfo['info_solicitante']=$arrSolicitante;
        }
        
        
        //información último solicitante historial
        $sql = "SELECT id_solicitante FROM ticket_historial WHERE id_ticket = ".$idTicket." ORDER BY id_thistorial DESC LIMIT 0, 1";
        $res = mysqli_query ( $dbLink, $sql );
        
        if ($res && mysqli_num_rows ( $res ) > 0) {
            $row_inf_solicitante_historial = mysqli_fetch_assoc ( $res ) ;
            $arrSolicitanteHistorial = array(
                'id_solicitante'=>$row_inf_solicitante_historial['id_solicitante'],
                
            );
            $arrInfo['info_ultimo_historial']=$arrSolicitanteHistorial;
        }
        
        // información tickets - historial
        $sql = "SELECT * from ticket_historial WHERE id_ticket =".$idTicket;
        $res = mysqli_query ( $dbLink, $sql );
        
        if ($res && mysqli_num_rows ( $res ) > 0) {
            $arrHistorial = array ();
            while ( $row_inf_historial = mysqli_fetch_assoc ( $res ) ) {
                $sql2 = "SELECT concat_ws(' ', us.nombre, us.apellidos) as nombreUsuario from login_user as U
                JOIN usuario as us on U.id_usuario=us.id_usuario
                where U.id_login=".$row_inf_historial['id_solicitante'];
                $res2 = mysqli_query ( $dbLink, $sql2 );
                if ($res2 && mysqli_num_rows ( $res2 ) > 0) {
                    $row_inf_user_historial = mysqli_fetch_assoc ( $res2 );
                    $nombreSolicitanteHistorial = $row_inf_user_historial ['nombreUsuario'];
                } else {
                    $nombreSolicitanteHistorial= '<span class="text-danger"><i class="fa fa-exclamation-triangle text-danger"></i>Usuario dado de baja</span>';
                }
                $Historial = array (
                    'fecha' => $row_inf_historial ['fecha'],
                    'notas' => $row_inf_historial ['notas'],
                    'id_solicitante' => $row_inf_historial ['id_solicitante'],
                    'nombreUsuario' => utf8_encode($nombreSolicitanteHistorial)
                );
                $arrHistorial [] = $Historial;
            }
            $arrInfo ['info_historial'] = $arrHistorial;
        }
        
        // Información tickekt - archivos
        $sql = "SELECT * from ticket_archivo WHERE id_ticket =".$idTicket;
        $res = mysqli_query ( $dbLink, $sql );
        //echo $sql.'<br />';
        if ($res && mysqli_num_rows ( $res ) > 0) {
            $arrArchivos = array ();
            while ( $row_inf_archivo = mysqli_fetch_assoc ( $res ) ) {
                $sql2 = "SELECT concat_ws(' ', us.nombre, us.apellidos) as nombreUsuario from login_user as U
                JOIN usuario as us on U.id_usuario=us.id_usuario where U.id_login=".$row_inf_archivo['id_solicitante'];
                //echo $sql2.'<br />';
                $res2 = mysqli_query ( $dbLink, $sql2 );
                if ($res2 && mysqli_num_rows ( $res2 ) > 0) {
                    $row_inf_user_ARCHIVO = mysqli_fetch_assoc ( $res2 );
                    $nombreSolicitanteArchivo = $row_inf_user_ARCHIVO ['nombreUsuario'];
                } else {
                    $nombreSolicitanteArchivo = '<span class="text-danger"><i class="fa fa-exclamation-triangle text-danger"></i>Usuario dado de baja</span>';
                }
                $nomArchivo=explode("/", $row_inf_archivo['archivo']);
                $Archivo = array (
                    'fecha' => $row_inf_archivo ['fecha'],
                    'descripcion' => $row_inf_archivo ['descripcion'],
                    'archivo' => ($nomArchivo[count($nomArchivo)-1]),
                    'nombreUsuario' => utf8_encode($nombreSolicitanteArchivo)
                );
                $arrArchivos [] = $Archivo;
            }
            $arrInfo ['info_archivos'] = $arrArchivos;
        }
    }
    return $arrInfo;
    
}
function ticketMovimiento($movimiento, $infoDatos) {
    global $dbLink;
    switch ($movimiento) {
        case 'cerrar' :
            $idSolicitante = '';
            $res = mysqli_query ( $dbLink, "SELECT id_solicitante FROM ticket WHERE id_ticket =" . $infoDatos ['id_ticket'] );
            if ($res && mysqli_num_rows ( $res ) > 0) {
                $tkto_inf = mysqli_fetch_assoc ( $res );
                $idSolicitante = $tkto_inf ['id_solicitante'];
            }
            if ($idSolicitante == $infoDatos ['id_solicitante']) {
                if (mysqli_query ( $dbLink, "UPDATE ticket SET id_tstatus = 6 WHERE id_ticket = " . $infoDatos ['id_ticket'] )) {
                    $sql = "INSERT INTO ticket_movimiento VALUES (null," . $infoDatos ['id_ticket'] . ", '" . $infoDatos ['fecha'] . "', 6 , " . $infoDatos ['id_solicitante'] . ", " . $infoDatos ['id_solicitante'] . ")";
                    $res = mysqli_query ( $dbLink, $sql );
                    if ($res) {
                        return array (
                            true,
                            array('msg' => '<i class="fa fa-check-circle"></i> Ticket cerrado. Por favor, espere.',
                                'atype' => 'success',
                                'estatus' => obtener_informacion_registro ( 'ticket_status', 'id_tstatus', 6 ))
                        );
                    } else {
                        return array (
                            false,
                            array('msg' => '<i class="fa fa-frown"></i> No ha sido posible cerrar completamente el ticket. Por favor, intente de nuevo o contacte a soporte telef&oacute;nico.)',
                                'atype' => 'danger')
                        )
                        ;
                    }
                } else {
                    return array (
                        false,
                        array('msg' => '<i class="fa fa-frown"></i> No ha sido posible cerrar el ticket. Por favor, intente de nuevo o contacte a soporte telef&oacute;nico.)',
                            'atype' => 'danger' )
                    )
                    ;
                }
            } else {
                return array (
                    false,
                    array('msg' => '<i class="fa fa-exclamation-triangle"></i> No es posible cerrar el ticket. &nbsp;<i class="fa fa-lightbulb-o"></i>Recuerde que s&oacute;lo el creador del ticket puede cerrarlo.',
                        'atype' => 'warning')
                )
                ;
            }
            
            break;
            
        case 'reabrir':
            $res = mysqli_query ( $dbLink, "UPDATE ticket SET id_tstatus = 2 WHERE id_ticket =" . $infoDatos ['id_ticket'] );
            if ($res) {
                if (mysqli_query ( $dbLink, "INSERT INTO ticket_movimiento VALUES (null," . $infoDatos ['id_ticket'] . ", '" . $infoDatos ['fecha'] . "', 3 , " . $infoDatos ['id_solicitante'] . ", " . $infoDatos ['id_solicitante'] . ")")){
                    return array (
                        true,
                        array('msg' => '<i class="fa fa-thumbs-up"></i> Caso reabierto. Espere un momento&hellip;',
                            'atype' => 'success')
                    );
                }
            } else {
                return array (
                    false,
                    array('msg' => '<i class="fa fa-exclamation-triangle"></i> No es posible reabrir el caso, por favor, contacte a soporte.',
                        'atype' => 'danger')
                )
                ;
            }
            break;
            
        case 'movimiento' :
            $idEstatus = intval ( $infoDatos ['estatus'] );
            $arrDatosTickets = $infoDatos ['informacion'];
            $archivo_nombre = $infoDatos ['ruta'];
            $desc_arc = $infoDatos ['descripcion'];
            $fecha = date('Y-m-d H:i:s');
            $sqlupdate = "INSERT INTO ticket_historial VALUES (null, " . $arrDatosTickets ['idPerfil'] . ", " . $arrDatosTickets ['id_ticket'] . ", '" . $fecha . "', '$idEstatus', '" . $arrDatosTickets ['resumen'] . "', '0')";
            //		return $sqlupdate;
            if (mysqli_query ( $dbLink, $sqlupdate )) {
                $ticketID = $arrDatosTickets ['id_ticket'];
                $sql = "INSERT INTO ticket_movimiento VALUES (null, $ticketID, '" . $fecha . "', " . $idEstatus . " , " . $arrDatosTickets ['idPerfil'] . ", " . $arrDatosTickets ['perfilAsignado'] . ")";
                mysqli_query ( $dbLink, $sql );
                
                $coont = 0;
                foreach ( $archivo_nombre as $archivo ) {
                    $sql = "INSERT INTO ticket_archivo VALUES (null, '" . $fecha . "', " . $ticketID . ", " . $arrDatosTickets ['idPerfil'] . ", '" . $desc_arc [$coont] . "', './doctos/ticket/" . $archivo . "')";
                    mysqli_query ( $dbLink, $sql );
                    $coont++;
                }
                
                if ($idEstatus == 2 || $idEstatus == 3) {
                    mysqli_query ( $dbLink, "UPDATE ticket SET id_tstatus = " . $idEstatus . " WHERE id_ticket =" . $arrDatosTickets ['id_ticket'] );
                } else {
                    mysqli_query ( $dbLink, "UPDATE ticket SET id_tstatus = " . $idEstatus . ", id_asignado = " . $arrDatosTickets ['perfilAsignado'] . " WHERE id_ticket =" . $arrDatosTickets ['id_ticket'] );
                }
                
                return array (
                    true,
                    array (
                        'msg' => '<i class="fa fa-check-circle"></i> Ticket actualizado correctamente. Por favor, espere.',
                        'atype' => 'success'
                    )
                );
            } else {
                return array (
                    false,
                    array (
                        'msg' => '<i class="fa fa-exclamation-triangle"></i> -Hemos tenido un problema para actualizar el ticket. Intenta de nuevo o contacta a soporte telef&oacute;nico',
                        'atype' => 'danger',
                        
                    )
                );
            }
            break;
    }
}

function obtenerTicketsAsignados($id_perfil){
    global $dbLink;
    $sql="SELECT T.*, TP.nombre, TP.tag FROM ticket T
          INNER JOIN ticket_status TS ON TS.id_tstatus = T.id_tstatus
          INNER JOIN ticket_prioridad TP ON TP.id_tprioridad = T.id_prioridad
          WHERE T.id_asignado = ".$id_perfil." AND (TS.nombre != 'Cerrado' AND TS.nombre != 'Cancelado')";
    $cadena = '';
    $res=mysqli_query($dbLink,$sql);
    if($res&&mysqli_num_rows($res)>0){
        while($row_inf=mysqli_fetch_assoc($res))
        {
            $solicitante = obtenerDatosPerfil($row_inf['id_solicitante']);
            $arreglo_fecha = explode(" ",$row_inf['fecha']);
            if($row_inf['id_tstatus']==1){
                $img_nuevo = 'N_PRO.png';
            }else if($row_inf['id_tstatus']==2){
                $img_nuevo = 'EN_PRO.png';
            }else if($row_inf['id_tstatus']==3){
                $img_nuevo = 'COM_INV.png';
            }else if($row_inf['id_tstatus']==4){
                $img_nuevo = 'REA_INV.png';
            }else if($row_inf['id_tstatus']==5){
                $img_nuevo = 'RES_AUT.png';
            }else if($row_inf['id_tstatus']==6){
                $img_nuevo = 'CER_AUT.png';
            }else if($row_inf['id_tstatus']==7){
                $img_nuevo = 'CAN_AUT.png';
            }else if($row_inf['id_tstatus']==8){
                $img_nuevo = 'REA_AUT.png';
            }
            
            $cadena.='
            <li>
          		<img src="images/users/'.$img_nuevo.'" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Ticket ('.$row_inf['titulo'].')</a> &bull; <span class="text-warning">'.$row_inf['nombre'].'</span></li>
							<li>'.utf8_encode($solicitante['nombre']).' ha solicitado atenci&oacute;n a un ticket.</li>
              <li><form method="POST" action="ticketrev.php"><input type="hidden" value="'.$row_inf['id_ticket'].'" name="idTicketDashboard" /><button type="submit" name="btnPreview" class="" /><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</i></button></form></li>
						</ul>
					</li>';
        }
    }
    return $cadena;
}


function sanitize2($string, $force_lowercase = true, $anal = false)
{
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
        "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
        "—", "–", ",", "<", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
    (function_exists('mb_strtolower')) ?
    mb_strtolower($clean, 'UTF-8') :
    strtolower($clean) :
    $clean;
}


function entidades($cadena) {
    return htmlentities ( $cadena, ENT_QUOTES, charset ( $cadena ) );
}
function sin_entidades($cadena)
{
    return html_entity_decode($cadena,ENT_QUOTES,charset($cadena));
}

function charset($cadena) {
    return mb_detect_encoding ( $cadena, "UTF-8,ISO-8859-1" );
}

function obtenerDatosPerfil($idPerfil){
    global $dbLink;
    
    $sql = "SELECT user_name as nombre, email from login_user where id_login=".$idPerfil;
    $res = mysqli_query ( $dbLink, $sql );
    $arrInfo = array ();
    if ($res && mysqli_num_rows ( $res ) > 0) {
        $row_inf = mysqli_fetch_assoc ( $res ) ;
        return array(
            'nombre'=>$row_inf['nombre'],
            'email'=>$row_inf['email']
        );
        
    }else
        return array('nombre'=>'<i class="fa fa-exclamation-triangle text-danger"></i> No Disponible','email'=>'no');
        
}
function obtener_historico_tickets($id_ticket){
    global $dbLink;
    $historial = '';
    $sqlhistorial = mysqli_query($dbLink, "SELECT ticket_historial.id_thistorial, ticket.id_solicitante AS id_owner, ticket_historial.id_ticket,
		ticket_historial.fecha AS fecha, ticket_historial.id_tstatus, ticket_historial.notas AS notas, ticket_historial.ack AS ack,
		ticket_status.id_tstatus, ticket_status.nombre AS estatus
		FROM ticket_historial, ticket_status, ticket
		WHERE
		ticket.id_ticket = ticket_historial.id_ticket AND ticket_historial.id_tstatus = ticket_status.id_tstatus AND ticket_historial.id_ticket = '".$id_ticket."' ORDER BY ticket_historial.id_thistorial DESC");
    if($sqlhistorial&&mysqli_num_rows($sqlhistorial)>0)
    {
        while($histo_inf=mysqli_fetch_assoc($sqlhistorial))
        {
            
            $sqlown=mysqli_query($dbLink, "SELECT concat_ws(' ', us.nombre, us.apellidos) as nombreUsuario from login_user as U
                JOIN usuario as us on U.id_usuario=us.id_usuario WHERE U.id_login ='{$histo_inf['id_owner']}'");
            if($sqlown&&mysqli_num_rows($sqlown)>0)
            {
                $own_inf=mysqli_fetch_assoc($sqlown);
                $histowner = $own_inf['nombreUsuario'];
            }
            else
            {
                $histowner = 'Usuario Baja';
            }
            
            
            //Case for ack
            if($histo_inf['id_owner'] == $_SESSION['id_perfil'])
            {
                $ackcolor = 'primary';
            }
            else
            {
                $ackcolor = 'success';
            }
            
            $historial .= 'Fecha: '.date("d M Y h:i:s", strtotime($histo_inf['fecha'])).' &nbsp;&nbsp;&nbsp;('.$histowner.')
								<br />
								<br />Notas:
									'.$histo_inf['notas'].'
								<br /><br />______________________________________<br /><br />';
        }
    }
    else
    {
        $historial = 'Fecha: '.date("d M Y").' &nbsp;&nbsp;&nbsp;(Sistema)
							<br />
              <br />
							Ticket a&uacute;n en proceso de revisi&oacute;n.
						  <br /><br />';
    }
    return $historial;
}
function preparar_mail_ticket($perfil, $perfil_autorizador, $tipo, $estado, $para, $extra){
    if($para=='solicitante'){
        $mensaje = 'Saludos '.$perfil['nombre'].', su solicitud de '.$tipo.' ha sido '.$estado.'.<br>Le pedimos se encuentre pendiente al estado de la solicitud.';
        $mensaje.= $extra;
        $mensaje.= '<br><br><a href="http://driveid.tamaulipas.gob.mx">Mis tickets</a>';
        $email = $perfil['email'];
    }else{
        $mensaje = 'Saludos '.$perfil_autorizador['nombre'].', '.$perfil['nombre'].' ha '.$estado.' una solicitud de '.$tipo.'.<br>Favor de revisar la solicitud en el portal.';
        $mensaje.= $extra;
        $mensaje.= '<br><br><a href="http://driveid.tamaulipas.gob.mx">Mis tickets</a>';
        $email = $perfil_autorizador['email'];
    }
    enviar_mail($email,'Solicitud de '.$tipo,$mensaje);
}
function enviar_mail($para,$asunto,$mensaje){
    require_once(FOLDER_LIB.'PHPMailer/class.phpmailer.php');
    require_once(FOLDER_LIB."PHPMailer/class.smtp.php");
    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "smtp.office365.com";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "noreply@abg.technology";
    $mailWeb->Password = "Dot30122.";
    $mailWeb->SetFrom("noreply@abg.technology", "No Reply");
    $mailWeb->AddReplyTo("noreply@abg.technology", "No Reply");
    $mailWeb->Subject = $asunto;
    $mailWeb->AltBody = $mensaje;
    $mailWeb->MsgHTML($mensaje);
    $mailWeb->AddAddress($para);
    try{
        $mailWeb->Send();
    }catch(Exception $e){
        echo $e;
    }
}

function obtener_informacion_registro($tabla, $id_columna, $id){
    global $dbLink;
    $sql="SELECT * FROM $tabla WHERE $id_columna = ".$id;
    $registro = '';
    $res=mysqli_query($dbLink,$sql);
    if($res&&mysqli_num_rows($res)>0){
        while($row_inf=mysqli_fetch_assoc($res)){
            $registro = $row_inf;
        }
    }
    return $registro;
}

function fixFilesArray(&$files){
    $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);
    
    foreach ($files as $key => $part) {
        // only deal with valid keys and multiple files
        $key = (string) $key;
        if (isset($names[$key]) && is_array($part)) {
            foreach ($part as $position => $value) {
                $files[$position][$key] = $value;
            }
            // remove old key reference
            unset($files[$key]);
        }
    }
}

function fecha_a_texto($fecha)
{
    $fecha_separada=explode("-", $fecha);
    $dia= strtolower($fecha_separada[2]);
    
    switch ($fecha_separada[1]) {
        
        case "01":
            $mes="Enero";
            break;
        case "02":
            $mes="Febrero";
            break;
        case "03":
            $mes="Marzo";
            break;
        case "04":
            $mes="Abril";
            break;
        case "05":
            $mes="Mayo";
            break;
        case "06":
            $mes="Junio";
            break;
        case "07":
            $mes="Julio";
            break;
        case "08":
            $mes="Agosto";
            break;
        case "09":
            $mes="Septiembre";
            break;
        case "10":
            $mes="Octubre";
            break;
        case "11":
            $mes="Noviembre";
            break;
        case "12":
            $mes="Diciembre";
            break;
            
        default:
            break;
    }
    $anio = strtolower($fecha_separada[0]);
    return "$dia de $mes de $anio.";
}


function contarTicket($tipo, $categoria){
    require ("masterIncludeLogin.inc.php");
    switch ($categoria) {
        case 'soporte' :
            $query = "SELECT count(*) as total FROM ticket as T
					JOIN ticket_prioridad as TP ON T.id_prioridad=TP.id_tprioridad
					JOIN ticket_status as TE ON T.id_tstatus=TE.id_tstatus
					JOIN ticket_tipo as TT ON T.id_tipo=TT.id_ttipo
					WHERE T.id_tstatus != 6	AND T.id_tstatus != 7
					AND ".$tipo." =".$objSession->getIdLogin();
            break;
    }
    
    $result=mysqli_query($dbLink, $query);
    if ($result&&mysqli_num_rows($result)){
        $row=mysqli_fetch_assoc($result);
        if (intval($row['total'])>0){
            return intval($row['total']);
        }
    }
    return 0;
}

function getUsersResponder($idAsig){
            global $dbLink;
            
            $query = "SELECT l.id_login, concat_ws(' ', us.nombre, us.apellidos) as nombre from login_user as l
                     JOIN usuario as us on l.id_usuario=us.id_usuario
					join ticket_movimiento on id_origen=id_login
					where id_ticket=".$_SESSION['tid']." and  id_login<>".$idAsig." group by l.id_login";
            //return $query;
            $result = mysqli_query ( $dbLink, $query );
            if ($result && mysqli_num_rows ( $result ) > 0) {
                $arrUsers = array ();
                while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
                    $arrUsers [$row_inf ['id_login']] = ($row_inf ['nombre']);
                }
            }
            return $arrUsers;
}



function obtenCombo($array,$default){
    $combo='<option value="">'.$default.'</option>';
    foreach ($array as $key => $opcion)
        $combo.='<option value="'.$key.'">'.$opcion.'</option>';
        return $combo;
}
?>