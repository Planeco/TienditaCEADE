<?php
	function is_valid_cadgrl($cadena)
	{
		return (preg_match("/^\S+$/",trim($cadena)));
	}
	function is_valid_frase($cadena)
	{
		return (preg_match("/^.+$/",trim($cadena)));
	}
	function is_valid_url($cadena)
	{
		return (preg_match("/^(ftp|https|http):\/\/[a-z0-9-_%]+((\.|\/)[a-z0-9-_%]+)*(\.[a-z]{2,6})(\?[a-z0-9-_%]+=[a-z0-9-_%]+(&[a-z0-9-_%]+=[a-z0-9-_%]+)*)?$/i",trim($cadena)));
	}
	function is_valid_cp($cadena)
	{
		return (preg_match("/^\d{5}$/",trim($cadena)));
	}
	function is_valid_mail($cadena)
	{
		return (preg_match("/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)+$/",trim($cadena)));
	}
	function is_valid_curp($cadena)
	{
		return (preg_match("/^[A-Z]{4}\d{6}[HM][A-Z]{5}[0A]\d$/",strtoupper(trim($cadena))));
	}
	function is_valid_rfc($cadena)
	{
		return (preg_match("/^[A-Z]{3,4}\d{6}[A-Z\d]{2}[\dA]$/",strtoupper(trim($cadena))));
	}
	function is_valid_numero($cadena)
	{
		return (preg_match("/^\d{1,4}$/",trim($cadena)));
	}
	function is_valid_telefono($cadena)
	{
		return (preg_match("/^\d{7,10}$/",trim($cadena)));
	}
	function xhtml_dtd()
	{
		if(stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")){
			header("Content-Type: application/xhtml+xml; charset=UTF-8");
			return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
		}
		else {
			header("Content-Type: text/html; charset=UTF-8");
			return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		}
	}
	function xmlentities($s,$charset)
	{
		$table1 = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
		foreach ($table1 as $k=>$v){
			$table1[$k] = "/$v/";
			$c = htmlentities($k,ENT_QUOTES,$charset);
			$table2[$c] = "&#".ord($k).";";
		}
		return preg_replace($table1,$table2,$s);
	}
	function escapar_cadena($entrada)
	{
		$cadena = $entrada;
		if(is_string($cadena)){
			$cadena = preg_replace("@<style[^>]*>.*</style[^>]*>@si",'',trim($cadena));
			$cadena = preg_replace("@<script[^>]*>.*</script[^>]*>@si",'',$cadena);
		}
		return $cadena;
	}
	function escapar_arreglo(&$arreglo)
	{
		if(count($arreglo)>0) foreach($arreglo as &$elemento)
			$elemento = escapar_cadena($elemento);
	}
	function limpiar($val)
	{
		return mysql_real_escape_string($val);
	}
	function charset($cadena)
	{
		return mb_detect_encoding($cadena,"UTF-8,ISO-8859-1");
	}
	function entidades($cadena)
	{
		return htmlentities($cadena,ENT_QUOTES,charset($cadena));
	}
	function sin_entidades($cadena)
	{
		return html_entity_decode($cadena,ENT_QUOTES,charset($cadena));
	}
	function plain_mail($para,$asunto,$mensaje,$de)
	{
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=utf-8\r\n";
		$headers .= "From: {$de} <{$de}>\r\n";
		$headers .= "Reply-To: {$de}";
		return mail($para,$asunto,$mensaje,$headers);
	}
  function enviar_mail($para,$asunto,$mensaje){
  /*  require_once('PHPMailer/class.phpmailer.php');
    require_once("PHPMailer/class.smtp.php");    
    $mailWeb = new PHPMailer();    
    $mailWeb->IsSMTP();    
    $mailWeb->SMTPSecure = 'tls';    
    $mailWeb->Host = "smtp.office365.com";    
    $mailWeb->SMTPDebug = 0;        
    $mailWeb->SMTPAuth = true;    
    $mailWeb->Port = 587;    
    $mailWeb->Username = "noreply@planeco.net";    
    $mailWeb->Password = "temp2016Focim";    
    $mailWeb->SetFrom("noreply@planeco.net", "No Reply");    
    $mailWeb->AddReplyTo("noreply@planeco.net", "No Reply");    
    $mailWeb->Subject = $asunto;    
    $mailWeb->AltBody = $mensaje;        
    $mailWeb->MsgHTML($mensaje);
    $mailWeb->AddAddress($para);                  
    try{    
      $mailWeb->Send();        
    }catch(Exception $e){
      echo $e;
    }*/  
  }
	
function filtrar_archivo($nombre,$mime_arr,$ban=true,$w_max=2000,$h_max=2000)
{
		if(!is_string($nombre)) return false;
		if(is_string($mime_arr)) $mime_arr = array($mime_arr);
		else if(!is_array($mime_arr)) return false;
		if($_FILES[$nombre]['error']!=UPLOAD_ERR_OK || in_array($_FILES[$nombre]['type'],$mime_arr)!=$ban) return false;
		list($tipo,$ext) = explode("/",$_FILES[$nombre]['type']);
		switch($tipo){
			case "image":
				list($ancho, $altura, $tipo, $atr) = getimagesize($_FILES[$nombre]['tmp_name']);
				return ($ancho <= $w_max && $altura <= $h_max);
				break;
			default:
				return true;
		}
	}
	
function guardar_archivo($nombre,$ruta)
{
	$arc = md5(time()).sanitize2($_FILES[$nombre]['name']);
	move_uploaded_file($_FILES[$nombre]['tmp_name'],$ruta.$arc);
	chmod($ruta.$arc,0644);
	$ruta_final = $ruta.$arc;
	return $ruta_final;
}
	
function sanitize($data)
{
$data = trim($data);
$data = htmlspecialchars($data);
$data = mysql_real_escape_string($data);
return $data;
}

function sanitize2($string, $force_lowercase = true, $anal = false)
{
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
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

function fecha_mes_a_texto($fecha)
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
  return "$mes de $anio";
}

/* Funciones para solicitudes */
  function tieneVacacionesPendientes($id_perfil){
    $sql="SELECT id_vacacion FROM vacaciones WHERE id_perfil_solicitante = '".$id_perfil."' AND (estatus = 'nuevo' OR estatus = 'invalido')";
    $bandera = false;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $bandera = true;
      }
    }      
    return $bandera;
  }
  function tiene_cobro_mes(){
    $mes = date('m');    
    $sql="SELECT id_costo_mensual FROM costos_mensuales WHERE MONTH(fecha) = '".$mes."'";    
    $bandera = false;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $bandera = true;
      }
    }      
    return $bandera;
  }
  function obtenerDiasVacacionesUtilizados($id_perfil){
    $sql="SELECT dias FROM vacaciones WHERE id_perfil_solicitante = '".$id_perfil."' AND estatus = 'autorizado'";    
    $dias = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $dias += $row_inf['dias'];
      }
    }      
    return $dias;    
  }
  function obtenerDiasVacacionesCorrespondientes($arreglo){
    if($arreglo['anos']==1){
      return 6;
    }else if($arreglo['anos']==2){
      return 8;    
    }else if($arreglo['anos']==3){
      return 10;    
    }else if($arreglo['anos']==4){
      return 12;    
    }else if($arreglo['anos']>=5 && $arreglo['anos']<=9){                      
      return 14;    
    }else if($arreglo['anos']>=10 && $arreglo['anos']<=14){
      return 16;    
    }else if($arreglo['anos']>=15 && $arreglo['anos']<=19){
      return 18;    
    }else if($arreglo['anos']>=20 && $arreglo['anos']<=25){
      return 20;    
    }else if($arreglo['anos']>25){
      return 22;    
    }else{
      return 0;
    }         
  }  
  function validarFecha($fecha){
    $d = DateTime::createFromFormat('Y-m-d', $fecha);
    return $d && $d->format('Y-m-d') == $fecha;
  }
  function obtenerAnoLaboral($inicio_labores){  
    $siguiente_ano = date('Y-m-d', strtotime("+12 months $inicio_labores"));
    $ano_laboral = date('Y-m-d', strtotime("-1 day $siguiente_ano"));  
    $hoy = date('Y-m-d');
    $bandera = false;
    $anos = 0;
    while($bandera==false){
      if (($hoy > $inicio_labores) && ($hoy < $ano_laboral)){
        $arreglo['anos'] = $anos;
        $arreglo['inicio_ano_laboral'] = $inicio_labores;
        $arreglo['fin_ano_laboral'] = $ano_laboral;       
        return $arreglo;        
        $bandera = true;
      }            
      $inicio_labores = date('Y-m-d', strtotime("+12 months $inicio_labores"));
      $ano_laboral = date('Y-m-d', strtotime("+12 months -1 day $inicio_labores"));    
      $anos++;
      if($anos==10){
        $bandera = true;
      }      
    }
  }
  function solicitarPermisos($id_perfil, $tipo, $fecha_inicio, $fecha_fin, $hora_inicio, $hora_fin, $opcion_goce_sueldo){
    $arreglo = '';
    $arreglo['mensaje'] = 'true';
    $goce_sueldo = 0;
    $ausencia = 0;
    $entrada_salida = 0;
    $mes = date('m');    
    if($tipo=='ausencia'){      
      if(validarFecha($fecha_inicio) && validarFecha($fecha_fin)){    
        $sql = "SELECT * FROM perfil_permisos WHERE id_perfil_solicitante  = '".$id_perfil."' AND MONTH(fecha_solicitud) = '".$mes."' AND estatus = 'autorizado' AND tipo = 'ausencia'";
        $res=mysql_query($sql);
        if($res&&mysql_numrows($res)>0){
      	  while($row_inf=mysql_fetch_assoc($res)){
            if($row_inf['tipo']=='ausencia'){
              $ausencia++;
            }            
            if($row_inf['goce_sueldo']=='si'){
              $goce_sueldo++;
            }
          }          
        }                       
      }else{
        $arreglo['mensaje'] = 'Error, formato de fecha erróneo';    
      }
    }else{
       $sql = "SELECT * FROM perfil_permisos WHERE id_perfil_solicitante  = '".$id_perfil."' AND MONTH(fecha_solicitud) = '".$mes."' AND estatus = 'autorizado' AND tipo = 'entradaysalida'";       
       $res=mysql_query($sql);
        if($res&&mysql_numrows($res)>0){
      	  while($row_inf=mysql_fetch_assoc($res)){            
            if($row_inf['tipo']=='entradaysalida'){
              $entrada_salida++;
            }
            if($row_inf['goce_sueldo']=='si'){
              $goce_sueldo++;
            }
          }          
        }
    }
    $arreglo['registrar_intento'] = 'false';        
    if($tipo=='ausencia'){
      if($goce_sueldo>0 && $opcion_goce_sueldo=='si'){      
        $arreglo['mensaje'] = 'Error, ya se ha solicitado una ausencia con goce de sueldo para el mes actual.';                    
        $arreglo['registrar_intento'] = 'true';
      }
      if($ausencia>=2 && $goce_sueldo>=1){
        $arreglo['mensaje'] = 'Error, ya se han utilizado los permisos para el mes actual.';                    
        $arreglo['registrar_intento'] = 'true';  
      }
      if($ausencia>=2 && $opcion_goce_sueldo>='no'){
        $arreglo['mensaje'] = 'Error, ya se han utilizado los permisos para el mes actual.';                    
        $arreglo['registrar_intento'] = 'true';  
      }            
    }else{
      if($entrada_salida>=2){
        $arreglo['mensaje'] = 'Error, ya se han utilizado los permisos para el mes actual.';                    
        $arreglo['registrar_intento'] = 'true';  
      }    
    }
    return $arreglo;
  }
  function solicitarVacaciones($inicio_labores, $inicio_vacaciones, $fin_vacaciones, $sabado, $perfil){
    $arreglo = '';
    if(validarFecha($inicio_labores) && validarFecha($inicio_vacaciones) && validarFecha($fin_vacaciones)){
      if($sabado){
        $dias_aborables = [1, 2, 3, 4, 5, 6];  
      }else{
        $dias_aborables = [1, 2, 3, 4, 5];
      }                      
      $arreglo = obtenerAnoLaboral($inicio_labores);      
      $dias_utilizados = obtenerDiasVacacionesUtilizados($perfil['id_perfil']);
      $dias_correspondientes = obtenerDiasVacacionesCorrespondientes($arreglo);            
      $dias_restantes = $dias_correspondientes - $dias_utilizados;            
      $dias_feriados = [];
      $dias_laborables = obtenerDiasLaborables($inicio_vacaciones,$fin_vacaciones,$dias_aborables,$dias_feriados);      
      $arreglo['dias_laborables'] = $dias_laborables;
      $arreglo['mensaje'] = 'true';                    
      $arreglo['registrar_intento'] = 'false';
      if($dias_restantes < $dias_laborables){      
        $arreglo['mensaje'] = 'Error, no tiene antig&uuml;edad suficiente';
        $arreglo['registrar_intento'] = 'true';                
      }                                          
    }else{
      $arreglo['mensaje'] = 'Error, formato de fecha erróneo';    
    }
    return $arreglo;
  }       
  function obtener_datos_perfil_por_id_perfil($id_usuario){
    $sql="SELECT P.sabado, P.id_depto, P.email_trabajo, D.nombre AS departamento, E.nombre AS empresa, PU.nombre AS puesto, U.nombre AS ubicacion, R.nombre AS region, P.nombre, P.paterno, P.materno, P.fecha_ingreso, P.id_perfil
    FROM perfil P
    INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
    INNER JOIN ubicacion U ON U.id_ubicacion = P.id_ubicacion
    INNER JOIN region R ON R.id_region = P.id_region
    INNER JOIN empresa E ON E.id_empresa = P.id_empresa
    INNER JOIN departamento D ON D.id_depto = P.id_depto
    WHERE P.id_perfil = '".$id_usuario."'";            
    $perfil = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil['id_perfil'] = $row_inf['id_perfil'];        
        $perfil['puesto'] = $row_inf['puesto'];
        $perfil['ubicacion'] = $row_inf['ubicacion'];
        $perfil['region'] = $row_inf['region'];
        $perfil['nombre'] = $row_inf['nombre'];
        $perfil['paterno'] = $row_inf['paterno'];
        $perfil['materno'] = $row_inf['materno'];
        $perfil['departamento'] = $row_inf['departamento'];
        $perfil['id_depto'] = $row_inf['id_depto'];
        $perfil['empresa'] = $row_inf['empresa'];
        $perfil['fecha_ingreso'] = $row_inf['fecha_ingreso'];
        $perfil['email_trabajo'] = $row_inf['email_trabajo'];
        $perfil['sabado'] = $row_inf['sabado'];        
      } 
    }      
    return $perfil;
  }
  function saldo_perfil_en_rango($id_perfil){
    $sql="SELECT saldo FROM perfil_saldo WHERE id_perfil = '".$id_perfil."'";
    $bandera = true;
    $saldo = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $saldo = $row_inf['saldo'];  
      }
    }
    if($saldo>=5000){
      $bandera = false;
    }
    return $bandera;
  }
  function obtener_perfil_saldo($id_perfil){
    $sql="SELECT saldo FROM perfil_saldo WHERE id_perfil = '".$id_perfil."'";
    $saldo = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $saldo = $row_inf['saldo'];  
      }
    }
    return $saldo;
  }
  function obtener_finanzas_pagos_por_tipo($id_pago_a_realizar, $tipo){
    $sql="SELECT * FROM finanzas_registro_pagos WHERE id_pago_a_realizar = '".$id_pago_a_realizar."' AND tipo_pago_a_realizar = '".$tipo."'";            
    $pago = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $pago[] = $row_inf;                
      } 
    }      
    return $pago;
  }
  function obtener_catalogo_conceptos_costo(){
    $sql="SELECT * FROM costos_conceptos_catalogo";            
    $conceptos = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $conceptos[] = $row_inf;                
      } 
    }      
    return $conceptos;
  }
  function obtener_catalogo_conceptos_costo_guardados($id_costo_mensual){
    $sql="SELECT * FROM costos_conceptos_catalogo CCC
          INNER JOIN costos C ON C.id_concepto = CCC.id_costo_concepto
          WHERE C.tipo_concepto = 'catalogo' AND C.id_costo_mensual = '".$id_costo_mensual."'";            
    $conceptos = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $conceptos[] = $row_inf;                
      } 
    }      
    return $conceptos;
  }
  function obtener_extra_conceptos_costo_guardados($id_costo_mensual){
    $sql="SELECT * FROM costos_conceptos_extra CCE
          INNER JOIN costos C ON C.id_concepto = CCE.id_costo_concepto
          WHERE C.tipo_concepto = 'extra' AND C.id_costo_mensual = '".$id_costo_mensual."'";            
    $conceptos = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $conceptos[] = $row_inf;                
      } 
    }      
    return $conceptos;
  }       
  function tiene_pagos($id_reembolso, $tipo){
    $sql="SELECT id_finanzas_registro_pago FROM finanzas_registro_pagos WHERE tipo_pago_a_realizar = '".$tipo."' AND id_pago_a_realizar = '".$id_reembolso."'";    
    $bandera = false;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $bandera = true;                                                                                                
      }
    }
    return $bandera;    
  }
  function obtener_total_monto_reembolso($id_reembolso){
    $sql="SELECT SUM(total) AS total FROM reembolsos_conceptos
    WHERE id_reembolso = '".$id_reembolso."'";            
    $total = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $total = $row_inf['total'];               
      } 
    }      
    return $total;
  }
  function obtener_total_monto_anticipo($id_anticipo){
    $sql="SELECT SUM(total) AS total FROM anticipos_conceptos
    WHERE id_anticipo = '".$id_anticipo."'";    
    $total = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $total = $row_inf['total'];               
      } 
    }      
    return $total;
  }
  
  function obtener_total_monto_compra($id_compra){
    $sql="SELECT SUM(CC.total) AS total FROM compras_costos CC
          INNER JOIN compras_conceptos CCO ON CCO.id_compra_concepto = CC.id_compra_concepto 
          WHERE CCO.id_compra = '".$id_compra."'";    
    $total = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $total = $row_inf['total'];               
      } 
    }      
    return $total;
  }
  
  function obtener_total_pago_proveedores($id_pago_proveedor){
    $sql="SELECT SUM(PPC.total) AS total FROM pagos_proveedores_conceptos PPC           
          WHERE PPC.id_pago_proveedor = '".$id_pago_proveedor."'";    
    $total = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $total = $row_inf['total'];               
      } 
    }      
    return $total;
  }    
  
/* Colores para todos para los estatus */
  function obtener_reembolsos_listado($id_involucrado){
    $sql="SELECT DISTINCT(id_solicitud), A.* FROM solicitud_involucrados SI
    INNER JOIN reembolsos A ON A.id_reembolso = SI.id_solicitud
    WHERE tipo_solicitud = 'reembolso' AND id_perfil_involucrado = '".$id_involucrado."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = obtener_total_monto_reembolso($row_inf['id_reembolso']);                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="reembolsosodificar.php?id='.$row_inf['id_reembolso'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }
  function obtener_reembolsos_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM reembolsos
          WHERE id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = obtener_total_monto_reembolso($row_inf['id_reembolso']);                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="reembolsosodificar.php?id='.$row_inf['id_reembolso'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }
  
  function obtener_soporte_solicitante($id_solicitante){
    $sql="SELECT * FROM soporte
          WHERE id_perfil_solicitante = '".$id_solicitante."'";                       
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
      	while($row_inf=mysql_fetch_assoc($res)){                  
        $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);
  			if($row_inf['estatus']=='autorizado')
  			{			  
  			  $evaluacion = obtener_datos_evaluacion($row_inf['id_soporte'], 'compras');
  			  if($evaluacion=='')
  			  {
  				$listado.='<li>
  							<img src="images/users/money_auth.png" alt="" class="avatar" />
  							<ul>
  								<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-success">Resuelto</span></li>
  								<li>Tu solicitud de soporte ['.$row_inf['id_soporte'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido resuelta.</li>
  								<li><a href="evaluacionalta.php?tipo=soporte&id='.$row_inf['id_soporte'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
  							</ul>
  						</li>';
  			  }
  			  else
  			  {
  				$listado.='<li>
  							<img src="images/users/money_auth.png" alt="" class="avatar" />
  							<ul>
  								<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-success">Resuelto</span></li>
  								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de soporte ['.$row_inf['id_soporte'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido resuelta.</li>
  							</ul>
  						</li>';
  			  }
  			}elseif($row_inf['estatus']=='asignado' && $row_inf['estado']=='feedback')
  			{			  

  				$listado.='<li>
  							<img src="images/users/money_auth.png" alt="" class="avatar" />
  							<ul>
  								<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-warning">Feedback</span></li>
  								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de soporte ['.$row_inf['id_soporte'].'] del '.fecha_a_texto($arreglo_fecha[0]).' requiere feedback.
                  <a href="soportedetalle.php?id='.$row_inf['id_soporte'].'&t=3"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li></li>
  							</ul>
  						</li>';
  			  
  			}elseif($row_inf['estatus']=='asignado')
  			{			  

  				$listado.='<li>
  							<img src="images/users/money_auth.png" alt="" class="avatar" />
  							<ul>
  								<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-success">Reasignado</span></li>
  								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de soporte ['.$row_inf['id_soporte'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido reasignada.</li>
  							</ul>
  						</li>';
  			  
  			}elseif($row_inf['estatus']=='nuevo')
  			{
  			  $listado.='<li>
  							<img src="images/users/money_proceso.png" alt="" class="avatar" />
  							<ul>
  								<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-primary"> En Proceso</span></li>
  								<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de soporte ['.$row_inf['id_soporte'].'] del '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
  							</ul>
  						</li>';
  			}                                                
      } 
    }      
    return $listado;  
  }
  
  function obtener_anticipos_listado($id_involucrado){
    $sql="SELECT DISTINCT(id_solicitud), A.* FROM solicitud_involucrados SI
    INNER JOIN anticipos A ON A.id_anticipo = SI.id_solicitud
    WHERE tipo_solicitud = 'anticipo' AND id_perfil_involucrado = '".$id_involucrado."'";         
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td class="monto_mxn">'.number_format($row_inf['cantidad_solicitada'],2,',','').'</td>';
          $listado.='<td class="monto_mxn">'.number_format($row_inf['cantidad_aprobada'],2,',','').'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="anticiposmodificar.php?id='.$row_inf['id_anticipo'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }  
    
  function obtener_anticipos_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT C.*, CT.tipo FROM cartas C
          INNER JOIN tipos_cartas CT ON CT.id_tipo_carta = C.id_tipo_carta
          WHERE C.id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['tipo'].'</td>';          
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="cartasdetalle.php?id='.$row_inf['id_carta'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }
  
  function obtener_soporte_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM soporte
          WHERE id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['tema'].'</td>';
          $listado.='<td>'.$row_inf['prioridad'].'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="soportemodificar.php?id='.$row_inf['id_soporte'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="soportedetalle.php?id='.$row_inf['id_soporte'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }
  
  function obtener_soporte_listado(){
    $sql="SELECT * FROM soporte
          ORDER BY fecha_solicitud DESC";                       
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $asignado = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_asignado']);                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$asignado['nombre'].' '.$asignado['paterno'].' '.$asignado['materno'].'</td>';
          $listado.='<td>'.$row_inf['tema'].'</td>';
          $listado.='<td>'.$row_inf['prioridad'].'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="soportedetalle.php?id='.$row_inf['id_soporte'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }  
  
  function obtener_requisiciones_personal_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM requisicion_personal
          WHERE id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['oficina_fisica'].'</td>';
          $listado.='<td>'.$row_inf['tipo_posicion'].'</td>';
          $listado.='<td>'.$row_inf['sueldo_neto'].'</td>';
          $listado.='<td>'.$row_inf['sueldo_bruto'].'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="requisicionpersonalmodificar.php?id='.$row_inf['id_requisicion_personal'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="requisicionpersonaldetalle.php?id='.$row_inf['id_requisicion_personal'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }  
  
  function obtener_requisiciones_personal_listado(){
    $sql="SELECT * FROM requisicion_personal RP
          INNER JOIN perfil P ON P.id_perfil = RP.id_perfil_solicitante 
          ORDER BY fecha_solicitud DESC";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['oficina_fisica'].'</td>';
          $listado.='<td>'.$row_inf['tipo_posicion'].'</td>';
          $listado.='<td>'.$row_inf['sueldo_neto'].'</td>';
          $listado.='<td>'.$row_inf['sueldo_bruto'].'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="requisicionpersonalmodificar.php?id='.$row_inf['id_requisicion_personal'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="requisicionpersonaldetalle.php?id='.$row_inf['id_requisicion_personal'].'&h=true" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }    
  
  function obtener_proveedores_listado(){
    $sql="SELECT P.id_proveedor AS idProveedor, P.estatus, P.razon_social, P.rfc, PC.* FROM proveedores P
          LEFT JOIN proveedores_contacto PC ON PC.id_proveedor = P.id_proveedor
          ORDER BY P.razon_social ASC";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['razon_social'].'</td>';
          $listado.='<td>'.$row_inf['rfc'].'</td>';
          $listado.='<td>'.$row_inf['nombre'].' '.$row_inf['apellido_paterno'].' '.$row_inf['apellido_materno'].'</td>';
          $listado.='<td>'.$row_inf['telefono'].'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="proveedoresmodificar.php?id='.$row_inf['idProveedor'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="proveedoresdetalle.php?id='.$row_inf['idProveedor'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a><a class="btn btn-default btn-circle" href="proveedoresmodificar.php?id='.$row_inf['idProveedor'].'"><i class="fa fa-pencil"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }    
  
  function obtener_compras_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM compras
          WHERE id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = obtener_total_monto_compra($row_inf['id_compra']); 
          $total = $total * 1.16;                 
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="comprasmodificar.php?id='.$row_inf['id_compra'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';
          }else{
            $listado.='<td><a href="comprasdetalle.php?id='.$row_inf['id_compra'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';
          }                                                
      } 
    }      
    return $listado;
  }
  
  function obtener_pago_proveedores_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM pagos_proveedores
          WHERE id_perfil_solicitante = '".$id_solicitante."'";                       
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = obtener_total_pago_proveedores($row_inf['id_pago_proveedor']);                          
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          if($row_inf['tipo']=='nacional'){
            $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
          }else{
            $listado.='<td class="monto_usd">'.number_format($total,2,',','').'</td>';
          }          
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="pagoproveedormodificar.php?id='.$row_inf['id_pago_proveedor'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="pagoproveedordetalle.php?id='.$row_inf['id_pago_proveedor'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                                          
      } 
    }      
    return $listado;
  }
  
  function obtener_compras_listado($id_involucrado){
    $sql="SELECT DISTINCT(id_solicitud), A.* FROM solicitud_involucrados SI
    INNER JOIN compras A ON A.id_compra = SI.id_solicitud
    WHERE tipo_solicitud = 'compra' AND id_perfil_involucrado = '".$id_involucrado."'";                 
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = obtener_total_monto_compra($row_inf['id_compra']); 
          $total = $total * 1.16;                 
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="comprasmodificar.php?id='.$row_inf['id_compra'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';
          }else{
            $listado.='<td><a href="comprasdetalle.php?id='.$row_inf['id_compra'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';
          }                                                
      } 
    }      
    return $listado;
  }
  
  function validacion_sistema(){
    return true;
  }
  function obtener_permisos_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM perfil_permisos
          WHERE id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['tipo'].'</td>';
          if($row_inf['tipo']=='ausencia'){
            $listado.='<td>'.$row_inf['fecha_desde'].'</td>';
            $listado.='<td>'.$row_inf['fecha_hasta'].'</td>';
          }else{
            $listado.='<td>'.$row_inf['hora_entrada'].'</td>';
            $listado.='<td>'.$row_inf['hora_salida'].'</td>';
          }          
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="permisosmodificar.php?id='.$row_inf['id_permiso'].'">modificar</a></span></td>';            
          }else{            
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="permisosdetalle.php?id='.$row_inf['id_permiso'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }   
  function obtener_permisos_listado(){
    $sql="SELECT * FROM perfil_permisos PM 
          INNER JOIN perfil P ON P.id_perfil = PM.id_perfil_solicitante 
          ORDER BY fecha_solicitud DESC";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['nombre'].' '.$row_inf['paterno'].' '.$row_inf['materno'].'</td>';
          $listado.='<td>'.$row_inf['tipo'].'</td>';
          if($row_inf['tipo']=='ausencia'){
            $listado.='<td>'.$row_inf['fecha_desde'].'</td>';
            $listado.='<td>'.$row_inf['fecha_hasta'].'</td>';
          }else{
            $listado.='<td>'.$row_inf['hora_entrada'].'</td>';
            $listado.='<td>'.$row_inf['hora_salida'].'</td>';
          }          
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else{            
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="permisosdetalle.php?id='.$row_inf['id_permiso'].'&h=true" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }    
  function obtener_vacaciones_listado_por_id_solicitante($id_solicitante){
    $sql="SELECT * FROM vacaciones
          WHERE id_perfil_solicitante = '".$id_solicitante."'";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>';
          $listado.='<td>'.$row_inf['fecha_desde'].'</td>';
          $listado.='<td>'.$row_inf['fecha_hasta'].'</td>';
          if($row_inf['estatus']=='autorizado_empresa'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else if($row_inf['estatus']=='invalido'){
            $listado.='<td><span class="label label-default"><a href="vacacionesmodificar.php?id='.$row_inf['id_vacacion'].'">modificar</a></span></td>';            
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="vacacionesdetalle.php?id='.$row_inf['id_vacacion'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  } 
  function obtener_vacaciones_listado(){
    $sql="SELECT * FROM vacaciones V
          INNER JOIN perfil P ON P.id_perfil = V.id_perfil_solicitante 
          ORDER BY fecha_solicitud DESC";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>'; 
          $listado.='<td>'.$row_inf['nombre'].' '.$row_inf['paterno'].' '.$row_inf['materno'].'</td>';                    
          $listado.='<td>'.$row_inf['fecha_desde'].'</td>';
          $listado.='<td>'.$row_inf['fecha_hasta'].'</td>';
          if($row_inf['estatus']=='autorizado_empresa'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="vacacionesdetalle.php?id='.$row_inf['id_vacacion'].'&h=true" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }
  function obtener_cartas_listado(){
    $sql="SELECT * FROM cartas C
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN tipos_cartas CT ON CT.id_tipo_carta = C.id_tipo_carta 
          ORDER BY fecha_solicitud DESC";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){                  
          $listado.='<tr>';
          $listado.='<td>'.$row_inf['fecha_solicitud'].'</td>'; 
          $listado.='<td>'.$row_inf['nombre'].' '.$row_inf['paterno'].' '.$row_inf['materno'].'</td>';                    
          $listado.='<td>'.$row_inf['tipo'].'</td>';          
          if($row_inf['estatus']=='autorizado'){
            $listado.='<td><span class="label label-success">Autorizado</span></td>';
          }else{
            $listado.='<td><span class="label label-default">'.$row_inf['estatus'].'</span></td>';          
          }
          $listado.='<td><a href="cartasdetalle.php?id='.$row_inf['id_carta'].'&h=true" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }
  function obtener_costos_listado(){
    $sql="SELECT * FROM costos_mensuales ORDER BY fecha DESC";             
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $arreglo = explode(" ",$row_inf['fecha']);                  
        $listado.='<tr>';
        $listado.='<td>'.fecha_mes_a_texto($arreglo[0]).'</td>';        
        if($row_inf['estatus']=='cerrado'){
          $listado.='<td><span class="label label-success">Cerrado</span></td>';
        }else{
          $listado.='<td><span class="label label-default">Guardado</span></td>';          
        }
        $listado.='<td><a href="cuentamensualdetalle.php?id='.$row_inf['id_costo_mensual'].'" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a></td>';                                      
      } 
    }      
    return $listado;    
  }        
  function obtenerDiasLaborables($fechaInicio, $fechaFin, $diasLaborables, $diasFeriados) {        
    $fechaInicio = new DateTime($fechaInicio);
    $fechaFin = new DateTime($fechaFin);
    $fechaFin->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($fechaInicio, $interval, $fechaFin);
    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $diasLaborables)) continue;
        if (in_array($period->format('Y-m-d'), $diasFeriados)) continue;
        if (in_array($period->format('*-m-d'), $diasFeriados)) continue;
        $days++;
    }
    return $days;
  }
    
  function diasRestantesVacaciones($id_usuario, $inicio_labores, $perfil){
    $arreglo = '';
    if(validarFecha($inicio_labores)){          
      if(existeUsuario($id_usuario)){
        $arreglo = obtenerAnoLaboral($inicio_labores);
        $dias_utilizados = obtenerDiasVacacionesUtilizados($perfil['id_perfil']);
        $dias_correspondientes = obtenerDiasVacacionesCorrespondientes($arreglo);
        $dias_restantes = $dias_correspondientes - $dias_utilizados;
        $arreglo['utilizados'] = $dias_utilizados;                   
        $arreglo['correspondientes'] = $dias_correspondientes;
        $arreglo['restantes'] = $dias_restantes;
        $arreglo['mensaje'] = 'true';
        $arreglo['registrar_intento'] = 'false';
        if($dias_correspondientes==0){
          $arreglo['mensaje'] = 'Error, no tiene antig&uuml;edad suficiente';
          $arreglo['registrar_intento'] = 'true';
        }else if($dias_restantes == 0){
          $arreglo['mensaje'] = 'Error, no cuenta con d&iacute;as disponibles';
          $arreglo['registrar_intento'] = 'true';
        }
      }else{
        $arreglo['mensaje'] = 'Error, usuario no existente';
      }  
    }else{
      $arreglo['mensaje'] = 'Error, formato de fecha erróneo';
    }
    return $arreglo;
  }
  function existeUsuario(){
    return true;
  }
  function obtener_datos_evaluacion($id, $tipo){
    $sql="SELECT * FROM encuestas WHERE tipo_solicitud = '".$tipo."' AND id_solicitud = '".$id."'";            
    $evaluacion = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $evaluacion['fecha'] = $row_inf['fecha'];        
        $evaluacion['calificacion'] = $row_inf['calificacion'];
        $evaluacion['comentarios'] = $row_inf['comentarios'];
        $evaluacion['id_perfil_involucrado'] = $row_inf['id_perfil_involucrado'];
      } 
    }      
    return $evaluacion;
  }
  
  function obtener_vacaciones_solicitante($id_perfil)
  {
    $sql="SELECT * FROM vacaciones WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
        if($row_inf['estatus']=='invalido')
        {
          $cadena.='<li>
          				<img src="images/users/trip_deny.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
							<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de vacaciones del  '.fecha_a_texto($row_inf['fecha_desde']).' - '.fecha_a_texto($row_inf['fecha_hasta']).'
							tiene inconsistencias. <a href="vacacionesmodificar.php?id='.$row_inf['id_vacacion'].'"><i class="fa fa-pencil">&nbsp;</i> Editar mi solicitud</a></li>
						</ul>
					</li>';
        }
        elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
        {
          $cadena.='<li>
          				<img src="images/users/trip_deny.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-danger">Cancelada</span></li>
							<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de vacaciones del  '.fecha_a_texto($row_inf['fecha_desde']).' - '.fecha_a_texto($row_inf['fecha_hasta']).' han sido denegadas/canceladas en sistema.</li>
						</ul>
					</li>';
        }
        elseif($row_inf['estatus']=='autorizado')
        {
          $evaluacion = obtener_datos_evaluacion($row_inf['id_vacacion'], 'vacacion');
          if($evaluacion=='')
          {
            $cadena.='<li>
							<img src="images/users/trip_authorized.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-success">Autorizada</span></li>
								<li> Tus vacaciones del '.fecha_a_texto($row_inf['fecha_desde']).' - '.fecha_a_texto($row_inf['fecha_hasta']).' han sido autorizadas!.</li>
								<li><a href="evaluacionalta.php?tipo=vacacion&id='.$row_inf['id_vacacion'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
          }
          else
          {
            $cadena.='<li>
							<img src="images/users/trip_authorized.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-success">Autorizada</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> Vacaciones autorizadas del '.fecha_a_texto($row_inf['fecha_desde']).' al '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							</ul>
						</li>';
          }
        }
        elseif($row_inf['estatus']=='nuevo')
        {
          $cadena.='<li>
          				<img src="images/users/trip_proceso.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-primary">En Proceso</span></li>
							<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de vacaciones del  '.fecha_a_texto($row_inf['fecha_desde']).' - '.fecha_a_texto($row_inf['fecha_hasta']).' esta en proceso de aprobaci&oacute;n.</li>
						</ul>
					</li>';
        }
      } 
    }      
    return $cadena;    
  }
    
  function obtener_cartas_solicitante($id_perfil)
  {
    $sql="SELECT * FROM cartas WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
        $arreglo_fecha = explode(" ",$row_inf['fecha_cambio_estatus']);        
        $arreglo_fecha_solicitud = explode(" ",$row_inf['fecha_solicitud']);
        if($row_inf['estatus']=='autorizado')
        {
          $evaluacion = obtener_datos_evaluacion($row_inf['id_carta'], 'carta');
          if($evaluacion=='')
          {
            $cadena.='<li>
							<img src="images/users/trip_authorized.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Cartas</a> &bull; <span class="text-success">Autorizada</span></li>
								<li> Tu carta del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada!.</li>
								<li><a href="evaluacionalta.php?tipo=carta&id='.$row_inf['id_carta'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
          }
          else
          {
            $cadena.='<li>
							<img src="images/users/trip_authorized.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Cartas</a> &bull; <span class="text-success">Autorizada</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> Carta autorizada el '.fecha_a_texto($arreglo_fecha[0]).'</li>
							</ul>
						</li>';
          }
        }
        elseif($row_inf['estatus']=='nuevo')
        {
          $cadena.='<li>
          				<img src="images/users/trip_proceso.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Carta</a> &bull; <span class="text-primary">En Proceso</span></li>
							<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de cartas el '.fecha_a_texto($arreglo_fecha_solicitud[0]).' esta en proceso de aprobaci&oacute;n.</li>
						</ul>
					</li>';
        }
      } 
    }      
    return $cadena;    
  }
  
  
  function obtener_requisicion_personal_solicitante($id_perfil)
  {
    $sql="SELECT * FROM requisicion_personal WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                
    $cadena = '';    
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);
        if($row_inf['estatus']=='invalido')
        {
          $cadena.='<li>
          				<img src="images/users/permiso_deny.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Requesici&oacute;n de Personal</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
							<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de requisici&oacute;n de personal creada en '.fecha_a_texto($arreglo_fecha[0]).' tiene inconsistencias. <a href="requisicionpersonalmodificar.php?id='.$row_inf['id_requisicion_personal'].'"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li>
						</ul>
					</li>
					';
        }
        elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
        {
          $cadena.='<li>
          				<img src="images/users/permiso_deny.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Requesici&oacute;n de Personal</a> &bull; <span class="text-danger">Cancelada</span></li>
							<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de requisici&oacute;n de personal creada en '.fecha_a_texto($arreglo_fecha[0]).' ha sido cancelada/denegada en sistema.</li>
						</ul>
					</li>
					';
        }
        elseif($row_inf['estatus']=='autorizado')
        {
          $evaluacion = obtener_datos_evaluacion($row_inf['id_requisicion_personal'], 'requisicion_personal');
			if($evaluacion=='')
			{
	            $cadena.='<li>
							<img src="images/users/permiso_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Requesici&oacute;n de Personal</a> &bull; <span class="text-success">Autorizado</span></li>
								<li>Tu solicitud de requisici&oacute:n de personal creada en '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
								<li><a href="evaluacionalta.php?tipo=requisicion_personal&id='.$row_inf['id_requisicion_personal'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
        	}
    	    else
	        {
    	        $cadena.='<li>
							<img src="images/users/permiso_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Requesici&oacute;n de Personal</a> &bull; <span class="text-success">Autorizado</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> La requisici&oacute;n de personal creada en '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada!</li>
							</ul>
						</li>';
        	}
        }
        elseif($row_inf['estatus']=='nuevo')
        {
          $cadena.='<li>
						<img src="images/users/permiso_proceso.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Requesici&oacute;n de Personal</a> &bull; <span class="text-primary">En Proceso</span></li>
							<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de requisici&oacute;n de personal creada en '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
						</ul>
					</li>';        
        }
      } 
    }      
    return $cadena;    
  }
    
  function obtener_permisos_solicitante($id_perfil)
  {
    $sql="SELECT * FROM perfil_permisos WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                
    $cadena = '';    
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);
        if($row_inf['estatus']=='invalido')
        {
          $cadena.='<li>
          				<img src="images/users/permiso_deny.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
							<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de permiso para el '.fecha_a_texto($arreglo_fecha[0]).' tiene inconsistencias. <a href="permisosmodificar.php?id='.$row_inf['id_permiso'].'"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li>
						</ul>
					</li>
					';
        }
        elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
        {
          $cadena.='<li>
          				<img src="images/users/permiso_deny.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-danger">Cancelada</span></li>
							<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de permiso para el '.fecha_a_texto($arreglo_fecha[0]).' ha sido cancelada/denegada en sistema.</li>
						</ul>
					</li>
					';
        }
        elseif($row_inf['estatus']=='autorizado')
        {
          $evaluacion = obtener_datos_evaluacion($row_inf['id_permiso'], 'permiso');
			if($evaluacion=='')
			{
	            $cadena.='<li>
							<img src="images/users/permiso_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-success">Autorizado</span></li>
								<li>Tu solicitud de permiso para el '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
								<li><a href="evaluacionalta.php?tipo=permiso&id='.$row_inf['id_permiso'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
        	}
    	    else
	        {
    	        $cadena.='<li>
							<img src="images/users/permiso_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-success">Autorizado</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> El permiso solicitado para el '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizado!</li>
							</ul>
						</li>';
        	}
        }
        elseif($row_inf['estatus']=='nuevo')
        {
          $cadena.='<li>
						<img src="images/users/permiso_proceso.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-primary">En Proceso</span></li>
							<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de permiso para el '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
						</ul>
					</li>';        
        }
      } 
    }      
    return $cadena;    
  }
  
  function obtener_reembolsos_solicitante($id_perfil)
  {
    $sql="SELECT * FROM reembolsos WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
      $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);
			if($row_inf['estatus']=='invalido')
			{
			  $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Reembolsos</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
								<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de reembolso ['.$row_inf['id_reembolso'].'] del '.fecha_a_texto($arreglo_fecha[0]).' tiene inconsistencias. <a href="reembolsosmodificar.php?id='.$row_inf['id_reembolso'].'"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li>
							</ul>
						</li>';
			}
			elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
			{
			  $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Reembolsos</a> &bull; <span class="text-danger">Denegada</span></li>
								<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de reembolso ['.$row_inf['id_reembolso'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido denegada/cancelada en el sistema.</li>
							</ul>
						</li>';
			}
			elseif($row_inf['estatus']=='autorizado')
			{			  
			  $evaluacion = obtener_datos_evaluacion($row_inf['id_reembolso'], 'compra');
			  if($evaluacion=='')
			  {
				$cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Reembolsos</a> &bull; <span class="text-success">Autorizado</span></li>
								<li>Tu solicitud de reembolso ['.$row_inf['id_reembolso'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
								<li><a href="evaluacionalta.php?tipo=compra&id='.$row_inf['id_reembolso'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
			  }
			  else
			  {
				$cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Reembolsos</a> &bull; <span class="text-success">Autorizado</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de reembolso ['.$row_inf['id_reembolso'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizado.</li>
							</ul>
						</li>';
			  }
			}
			elseif($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
							<img src="images/users/money_proceso.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Reembolsos</a> &bull; <span class="text-primary"> En Proceso</span></li>
								<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de reembolso ['.$row_inf['id_reembolso'].'] del '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
							</ul>
						</li>';
			}
      } 
    }      
    return $cadena;    
  }    
   
  function obtener_pagos_proveedores_solicitante($id_perfil)
  {
    $sql="SELECT * FROM pagos_proveedores WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
      $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);      
			if($row_inf['estatus']=='invalido' || ($row_inf['estatus']=='invalidado_perfil' && $row_inf['id_perfil_modificar']==$id_perfil))
			{
			  $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Pago a Proveedor</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
								<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de pago a proveedor ['.$row_inf['id_pago_proveedor'].'] del '.fecha_a_texto($arreglo_fecha[0]).' tiene inconsistencias. <a href="pagoproveedormodificar.php?id='.$row_inf['id_pago_proveedor'].'"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li>
							</ul>
						</li>';
			}
			elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
			{
			  $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Pago a Proveedor</a> &bull; <span class="text-danger">Denegada</span></li>
								<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de pago a proveedor ['.$row_inf['id_pago_proveedor'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido denegada/cancelada en el sistema.</li>
							</ul>
						</li>';
			}
			elseif($row_inf['estatus']=='autorizado')
			{			  
			  $evaluacion = obtener_datos_evaluacion($row_inf['id_compra'], 'pago_proveedor');
			  if($evaluacion=='')
			  {
				$cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Pago a Proveedor</a> &bull; <span class="text-success">Autorizado</span></li>
								<li>Tu solicitud de compras ['.$row_inf['id_pago_proveedor'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
								<li><a href="evaluacionalta.php?tipo=compra&id='.$row_inf['id_pago_proveedor'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
			  }
			  else
			  {
				$cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Pago a Proveedor</a> &bull; <span class="text-success">Autorizado</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de pago a proveedor ['.$row_inf['id_pago_proveedor'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizado.</li>
							</ul>
						</li>';
			  }
			}
			elseif($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
							<img src="images/users/money_proceso.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Pago a Proveedor</a> &bull; <span class="text-primary"> En Proceso</span></li>
								<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de pago a proveedor ['.$row_inf['id_pago_proveedor'].'] del '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
							</ul>
						</li>';
			}
      } 
    }      
    return $cadena;    
  }
  
  function obtener_compras_solicitante($id_perfil)
  {
    $sql="SELECT * FROM compras WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
      $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);
			if($row_inf['estatus']=='invalido')
			{
			  $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
								<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de compras ['.$row_inf['id_compra'].'] del '.fecha_a_texto($arreglo_fecha[0]).' tiene inconsistencias. <a href="comprasmodificar.php?id='.$row_inf['id_compra'].'"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li>
							</ul>
						</li>';
			}
			elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
			{
			  $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-danger">Denegada</span></li>
								<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de compras ['.$row_inf['id_compra'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido denegada/cancelada en el sistema.</li>
							</ul>
						</li>';
			}
			elseif($row_inf['estatus']=='autorizado')
			{			  
			  $evaluacion = obtener_datos_evaluacion($row_inf['id_compra'], 'compra');
			  if($evaluacion=='')
			  {
				$cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-success">Autorizado</span></li>
								<li>Tu solicitud de compras ['.$row_inf['id_compra'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
								<li><a href="evaluacionalta.php?tipo=compra&id='.$row_inf['id_compra'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
			  }
			  else
			  {
				$cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-success">Autorizado</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de compras ['.$row_inf['id_compra'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizado.</li>
							</ul>
						</li>';
			  }
			}
			elseif($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
							<img src="images/users/money_proceso.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> En Proceso</span></li>
								<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de compras ['.$row_inf['id_compra'].'] del '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
							</ul>
						</li>';
			}
      } 
    }      
    return $cadena;    
  }
    
  function obtener_anticipos_solicitante($id_perfil){
    $sql="SELECT * FROM anticipos WHERE id_perfil_solicitante = '".$id_perfil."' AND fecha_solicitud >= DATE_SUB(SYSDATE(), INTERVAL 30 DAY)";                
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
        $arreglo_fecha = explode(" ",$row_inf['fecha_solicitud']);
        if($row_inf['estatus']=='invalido')
        {  
           $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-warning">Inv&aacute;lida</span></li>
								<li><i class="fa fa-exclamation-triangle">&nbsp;</i> Tu solicitud de reembolso ['.$row_inf['id_anticipo'].'] del '.fecha_a_texto($arreglo_fecha[0]).' tiene inconsistencias.
								<a href="anticiposmodificar.php?id='.$row_inf['id_anticipo'].'"><i class="fa fa-pencil">&nbsp;</i> Verificar mi solicitud</a></li>
							</ul>
						</li>';
        }
        elseif($row_inf['estatus']=='denegado' OR $row_inf['estatus']=='cancelado')
        {
           $cadena.='<li>
							<img src="images/users/money_deny.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-danger">Denegada</span></li>
								<li><i class="fa fa-ban">&nbsp;</i> Tu solicitud de anticipo ['.$row_inf['id_anticipo'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido
								denegada/cancelada en sistema.</li>
							</ul>
						</li>';
        }
        elseif($row_inf['estatus']=='autorizado')
        {          
          $evaluacion = obtener_datos_evaluacion($row_inf['id_anticipo'], 'anticipo');
          if($evaluacion=='')
          {
            $cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-success">Autorizado</span></li>
								<li>Tu solicitud de anticipo ['.$row_inf['id_anticipo'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
								<li><a href="evaluacionalta.php?tipo=anticipo&id='.$row_inf['id_anticipo'].'"><i class="fa fa-check-circle">&nbsp;</i> Evaluar el Servicio</a></li>
							</ul>
						</li>';
          }
          else
          {
            $cadena.='<li>
							<img src="images/users/money_auth.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-success">Autorizado</span></li>
								<li><i class="fa fa-thumbs-up">&nbsp;</i> Tu solicitud de anticipo ['.$row_inf['id_anticipo'].'] del '.fecha_a_texto($arreglo_fecha[0]).' ha sido autorizada.</li>
							</ul>
						</li>';
          }
        }
        elseif($row_inf['estatus']=='nuevo')
        {
          $cadena.='<li>
							<img src="images/users/money_proceso.png" alt="" class="avatar" />
							<ul>
								<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-primary">En Proceso</span></li>
								<li><i class="fa fa-flag-checkered">&nbsp;</i> Tu solicitud de anticipo ['.$row_inf['id_anticipo'].'] del '.fecha_a_texto($arreglo_fecha[0]).' est&aacute; en proceso de aprobaci&oacute;n.</li>
							</ul>
						</li>';        
        }
      } 
    }      
    return $cadena;    
  }

/* Auth functions */
  function obtener_vacaciones_autorizar($id_perfil){
    $sql="SELECT * FROM vacaciones WHERE id_perfil_autoriza = '".$id_perfil."' LIMIT 0,10";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
	        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
			if($row_inf['estatus']=='modificado')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha editado su solicitud de vacaciones del '.fecha_a_texto($row_inf['fecha_desde']).' al '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							<li><a href="vacacionesdetalle.php?id='.$row_inf['id_vacacion'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
			elseif($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Vacaciones</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado vacaciones del '.fecha_a_texto($row_inf['fecha_desde']).' al '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							<li><a href="vacacionesdetalle.php?id='.$row_inf['id_vacacion'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
      } 
    }      
    return $cadena;    
  }
  
  function obtener_soporte_asignar(){
    $sql="SELECT * FROM soporte WHERE estatus = 'nuevo' LIMIT 0,10";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
        $arreglo_fecha = explode(" ", $row_inf['fecha_solicitud']);
        $arreglo_fecha_modificado = explode(" ", $row_inf['fecha_cambio_estatus']);
	      $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
			if($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado soporte el '.fecha_a_texto($arreglo_fecha[0]).'</li>
							<li><a href="soportedetalle.php?id='.$row_inf['id_soporte'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
      } 
    }      
    return $cadena;
  }
  
  function obtener_cartas_autorizar(){
    $sql="SELECT C.*, CT.tipo FROM cartas C
          INNER JOIN tipos_cartas CT ON CT.id_tipo_carta = C.id_tipo_carta 
          WHERE C.estatus = 'nuevo' LIMIT 0,10";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{        
        $arreglo_fecha = explode(" ", $row_inf['fecha_solicitud']);        
	      $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
			if($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Carta</a> &bull; <span class="text-primary"> Asignada</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado una carta el '.fecha_a_texto($arreglo_fecha[0]).'</li>
							<li><a href="cartasdetalle.php?id='.$row_inf['id_carta'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
      } 
    }      
    return $cadena;
  }
  
  function obtener_soporte_asignar_por_id_perfil($id_perfil){
    $sql="SELECT * FROM soporte WHERE id_perfil_asignado = '".$id_perfil."' AND (estatus = 'asignado' OR estatus = 'feedback') LIMIT 0,10";                        
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
        $arreglo_fecha = explode(" ", $row_inf['fecha_solicitud']);
        $arreglo_fecha_modificado = explode(" ", $row_inf['fecha_cambio_estatus']);
	      $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
			if($row_inf['estatus']=='feedback')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-primary"> con feedback</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha editado su solicitud de soporte el '.fecha_a_texto($arreglo_fecha_modificado[0]).'</li>
							<li><a href="soportedetalle.php?id='.$row_inf['id_soporte'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
			elseif($row_inf['estatus']=='asignado')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Soporte</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado soporte el '.fecha_a_texto($arreglo_fecha[0]).'</li>
							<li><a href="soportedetalle.php?id='.$row_inf['id_soporte'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
      } 
    }      
    return $cadena;
  }  
  
  function obtener_anticipos_autorizar($id_perfil){
    $sql="SELECT * FROM anticipos WHERE id_perfil_aprobador = '".$id_perfil."' AND (estatus = 'nuevo' OR estatus = 'modificado') LIMIT 0,10";                   
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
	        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
			if($row_inf['estatus']=='modificado')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipos</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha editado su solicitud de anticipos del '.fecha_a_texto($row_inf['fecha_solicitud']).'</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
			elseif($row_inf['estatus']=='nuevo')
			{
			  $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipos</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado anticipos del '.fecha_a_texto($row_inf['fecha_solicitud']).'</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
			}
      } 
    }      
    return $cadena;    
  }
  
  function obtener_permisos_autorizar($id_perfil){
    $sql="SELECT * FROM perfil_permisos WHERE id_perfil_autoriza = '".$id_perfil."' AND (estatus = 'nuevo' OR estatus = 'modificado') LIMIT 0,10";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
        if($row_inf['estatus']=='modificado'){
          if($row_inf['tipo']=='ausencia'){
            $cadena.='<li>
          				<img src="images/users/permiso_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Ausencia</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha modificado su solicitud de ausencia del '.fecha_a_texto($row_inf['fecha_desde']).' al '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							<li><a href="permisosdetalle.php?id='.$row_inf['id_permiso'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
          }else{
            $cadena.='<li>
          				<img src="images/users/permiso_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha modificado su permiso para el '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							<li><a href="permisosdetalle.php?id='.$row_inf['id_permiso'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
          }
        }else if($row_inf['estatus']=='nuevo'){
          if($row_inf['tipo']=='ausencia'){
            $cadena.='<li>
          				<img src="images/users/permiso_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Ausencia</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado permiso de ausencia del '.fecha_a_texto($row_inf['fecha_desde']).' al '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							<li><a href="permisosdetalle.php?id='.$row_inf['id_permiso'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
          }else{
            $cadena.='<li>
          				<img src="images/users/permiso_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Permiso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha solicitado permiso para el '.fecha_a_texto($row_inf['fecha_hasta']).'</li>
							<li><a href="permisosdetalle.php?id='.$row_inf['id_permiso'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
          }        
        }
      } 
    }      
    return $cadena;    
  }
  
  function obtener_listado_general_finanzas(){
    $sql="SELECT * FROM finanzas_pagos";       
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
        if($row_inf['tipo_pago_a_realizar']=='compras'){
          $informacion_tipo = obtener_datos_compra($row_inf['id_pago_a_realizar']);
          $total = obtener_total_monto_compra($row_inf['id_pago_a_realizar']) * 1.16;
          $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'compras');
        }else if($row_inf['tipo_pago_a_realizar']=='anticipos'){
          $informacion_tipo = obtener_datos_anticipo($row_inf['id_pago_a_realizar']);
          $total = $informacion_tipo['cantidad_aprobada'];
          $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'anticipos');
        }else if($row_inf['tipo_pago_a_realizar']=='reembolsos'){
          $informacion_tipo = obtener_datos_reembolso($row_inf['id_pago_a_realizar']);            
          $total = obtener_total_monto_reembolso($row_inf['id_pago_a_realizar']);
          $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'reembolsos');
        }
        $solicitante = obtener_datos_perfil_por_id_perfil($informacion_tipo['id_perfil_solicitante']);                            
        $listado.='<tr>';
        $listado.='<td style="text-transform:capitalize;">'.$row_inf['tipo_pago_a_realizar'].'</td>';
        $listado.='<td>'.$informacion_tipo['fecha_solicitud'].'</td>';
        $listado.='<td>'.$solicitante['nombre'].' '.$solicitante['paterno'].' '.$solicitante['materno'].'</td>';
        $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
        if($bandera){
          $listado.='<td><span class="label label-success">Pagado</span></td>';
          $listado.='<td><div id="fecha_tentatitva_'.$row_inf['id_finanza_pago'].'">'.$row_inf['fecha_tentativa'].'</div></td>';
          $listado.='<td><a href="javascript:openmodal('.$row_inf['id_finanza_pago'].')" class="btn btn-default btn-circle fa fa-clock-o" ></a></td>';
        }else{
          $listado.='<td><span class="label label-default">Sin pagos</span></td>';
          $listado.='<td><div id="fecha_tentatitva_'.$row_inf['id_finanza_pago'].'">'.$row_inf['fecha_tentativa'].'</div></td>';
          $listado.='<td><a href="javascript:openmodal('.$row_inf['id_finanza_pago'].')" class="btn btn-default btn-circle fa fa-clock-o" ></a></td>';            
        }                                      
      } 
    }      
    return $listado;    
  }
  
  function obtener_listado_general_finanzas_pagados(){
    $sql="SELECT * FROM finanzas_pagos WHERE fecha_pago !='0000-00-00 00:00:00'";       
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
        if($row_inf['tipo_pago_a_realizar']=='compras'){
          $informacion_tipo = obtener_datos_compra($row_inf['id_pago_a_realizar']);
          $total = obtener_total_monto_compra($row_inf['id_pago_a_realizar']) * 1.16;
          $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'compras');
        }else if($row_inf['tipo_pago_a_realizar']=='anticipos'){
          $informacion_tipo = obtener_datos_anticipo($row_inf['id_pago_a_realizar']);
          $total = $informacion_tipo['cantidad_aprobada'];
          $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'anticipos');
        }else if($row_inf['tipo_pago_a_realizar']=='reembolsos'){
          $informacion_tipo = obtener_datos_reembolso($row_inf['id_pago_a_realizar']);            
          $total = obtener_total_monto_reembolso($row_inf['id_pago_a_realizar']);
          $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'reembolsos');
        }
        $solicitante = obtener_datos_perfil_por_id_perfil($informacion_tipo['id_perfil_solicitante']);                            
        $listado.='<tr>';  
        $listado.='<td style="text-transform:capitalize;">'.$row_inf['tipo_pago_a_realizar'].'</td>';
        $listado.='<td>'.$informacion_tipo['fecha_solicitud'].'</td>';
        $listado.='<td>'.$solicitante['nombre'].' '.$solicitante['paterno'].' '.$solicitante['materno'].'</td>';
        $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
        if($bandera){
          $listado.='<td><span class="label label-success">Pagado</span></td>';
          $listado.='<td><div id="fecha_tentatitva_'.$row_inf['id_finanza_pago'].'">'.$row_inf['fecha_tentativa'].'</div></td>';
          $listado.='<td><a href="finanzaslistadopagosalta.php?id='.$row_inf['id_finanza_pago'].'" class="btn btn-default btn-circle fa fa-eye"></a></td>';
        }else{
          $listado.='<td><span class="label label-default">Sin pagos</span></td>';
          $listado.='<td><div id="fecha_tentatitva_'.$row_inf['id_finanza_pago'].'">'.$row_inf['fecha_tentativa'].'</div></td>';
          $listado.='<td><a href="finanzaslistadopagosalta.php?id='.$row_inf['id_finanza_pago'].'" class="btn btn-default btn-circle fa fa-eye"></a></td>';            
        }                                      
      } 
    }      
    return $listado;    
  }
  
  function obtener_select_proyectos($id_proyecto){
    $sql = "SELECT * FROM proyectos";
    $res=mysql_query($sql);
    $cadena = '';
   if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
        ?><option <?php if($row_inf['id_proyecto']==$id_proyecto){ echo 'selected="selected"'; } ?> value="<?php echo $row_inf['id_proyecto']; ?>"><?php echo $row_inf['nombre']; ?></option><?php
      }
    }
  }
  
  function obtener_select_perfiles_asignar_solicitud($id_solicitud, $id_perfil, $tipo){
    $sql = "SELECT DISTINCT(id_perfil_involucrado)
            FROM solicitud_involucrados
            WHERE tipo_solicitud = '".$tipo."'
            AND id_solicitud = '".$id_solicitud."'
            AND id_perfil_involucrado != '".$id_perfil."';";
    $res=mysql_query($sql);
    $cadena = '';
   if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_involucrado']);      
        ?><option value="<?php echo $perfil['id_perfil']; ?>"><?php echo $perfil['nombre'].' '.$perfil['paterno'].' '.$perfil['materno']; ?></option><?php
      }
    }
  }
  
  function obtener_select_cartas($id_tipo_carta){
    $sql = "SELECT * FROM tipos_cartas";
    $res=mysql_query($sql);
    $cadena = '';
   if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
        ?><option <?php if($row_inf['id_tipo_carta']==$id_tipo_carta){ echo 'selected="selected"'; } ?> value="<?php echo $row_inf['id_tipo_carta']; ?>"><?php echo $row_inf['tipo']; ?></option><?php
      }
    }
  }  
  
  function obtener_select_soporte_asignar_ticket($id_perfil, $id_perfil_asignado){
    $sql = "SELECT * FROM perfil WHERE id_estatus = 1 ORDER BY nombre ASC";
    $res=mysql_query($sql);
    $cadena = '';
   if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
        ?><option <?php if($row_inf['id_perfil']==$id_perfil_asignado){ echo 'selected="selected"'; } ?> value="<?php echo $row_inf['id_perfil']; ?>"><?php echo $row_inf['nombre'].' '.$row_inf['paterno'].' '.$row_inf['materno']; ?></option><?php
      }
    }
  }
  
  function obtener_select_proveedores($id_proveedor){
    $sql = "SELECT * FROM proveedores WHERE estatus = 'autorizado'";
    $res=mysql_query($sql);
    $cadena = '';
   if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
        ?><option <?php if($row_inf['id_proveedor']==$id_proveedor){ echo 'selected="selected"'; } ?> value="<?php echo $row_inf['id_proveedor']; ?>"><?php echo $row_inf['razon_social'].' ('.$row_inf['rfc'].')'; ?></option><?php
      }
    }
  }
  
  function obtener_listado_general_finanzas_pendientes(){
    $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
    $saturday = date( 'Y-m-d', strtotime( 'saturday this week' ) );
    $sql="SELECT * FROM finanzas_pagos F
          WHERE NOT EXISTS(
          SELECT 1 FROM finanzas_registro_pagos FR
          WHERE FR.id_pago_a_realizar = F.id_pago_a_realizar
          AND FR.tipo_pago_a_realizar = F.tipo_pago_a_realizar
          )
          AND F.fecha_tentativa < DATE('".$saturday."') ORDER BY F.fecha_autorizacion DESC";                                         
    $listado = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){      
          if($row_inf['tipo_pago_a_realizar']=='compras'){
            $informacion_tipo = obtener_datos_compra($row_inf['id_pago_a_realizar']);
            $total = obtener_total_monto_compra($row_inf['id_pago_a_realizar']) * 1.16;
            $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'compras');
          }else if($row_inf['tipo_pago_a_realizar']=='anticipos'){
            $informacion_tipo = obtener_datos_anticipo($row_inf['id_pago_a_realizar']);
            $total = $informacion_tipo['cantidad_aprobada'];
            $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'anticipos');
          }else if($row_inf['tipo_pago_a_realizar']=='reembolsos'){
            $informacion_tipo = obtener_datos_reembolso($row_inf['id_pago_a_realizar']);            
            $total = obtener_total_monto_reembolso($row_inf['id_pago_a_realizar']);
            $bandera = tiene_pagos($row_inf['id_pago_a_realizar'],'reembolsos');
          }
          $solicitante = obtener_datos_perfil_por_id_perfil($informacion_tipo['id_perfil_solicitante']);                            
          $listado.='<tr>';
          $listado.='<td style="text-transform:capitalize;">'.$row_inf['tipo_pago_a_realizar'].'</td>';
          $listado.='<td>'.$informacion_tipo['fecha_solicitud'].'</td>';
          $listado.='<td>'.$solicitante['nombre'].' '.$solicitante['paterno'].' '.$solicitante['materno'].'</td>';
          $listado.='<td class="monto_mxn">'.number_format($total,2,',','').'</td>';
          if($bandera){
            $listado.='<td><span class="label label-success">Pagado</span></td>';
          }else{
            $listado.='<td><span class="label label-default">Sin pagos</span></td>';            
          }
          $listado.='<td>'.$row_inf['fecha_tentativa'].'</td>';          
          $listado.='<td><a href="finanzaslistadopagosalta.php?id='.$row_inf['id_finanza_pago'].'" class="btn btn-default btn-circle fa fa-money"></a></td>';                  
      } 
    }      
    return $listado;    
  }
  
  function obtener_reembolsos_autorizar($informacion_laboral){
    $sql="SELECT R.id_reembolso, R.estatus, R.fecha_solicitud, R.id_perfil_solicitante FROM reembolsos R          
          INNER JOIN perfil P ON P.id_perfil = R.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE PU.id_empresa = '".$informacion_laboral['id_empresa']."' AND (R.estatus = 'nuevo' OR R.estatus = 'modificado') LIMIT 0,10";                         
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
        if($row_inf['estatus']=='nuevo' || $row_inf['estatus']=='modificado')
        {
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Reembolso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de reembolso.</li>
							<li><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
        }
      } 
    }          
    return $cadena;    
  }
  
  function obtener_requisicion_personal_autorizar($informacion_laboral){
    $sql="SELECT RP.id_requisicion_personal, RP.estatus, RP.fecha_solicitud, RP.id_perfil_solicitante FROM requisicion_personal RP          
          INNER JOIN perfil P ON P.id_perfil = RP.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE PU.id_empresa = '".$informacion_laboral['id_empresa']."' AND (RP.estatus = 'autorizado_auxiliar' OR RP.estatus = 'autorizado_jefe_inmediato') LIMIT 0,10";     
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
        if($row_inf['estatus']=='autorizado_auxiliar'){
          $t = '2';
        }else{
          $t = '3';
        }
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Requisici&oacute;n de Personal</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de requisici&oacute;n de personal.</li>
							<li><a href="requisicionpersonaldetalle.php?id='.$row_inf['id_requisicion_personal'].'&t='.$t.'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';

      } 
    }      
    return $cadena;    
  }    
  
  function obtener_requisicion_personal_autorizar_auxiliar_rh ($informacion_laboral){
    $sql="SELECT RP.id_requisicion_personal, RP.estatus, RP.fecha_solicitud, RP.id_perfil_solicitante FROM requisicion_personal RP         
          WHERE (RP.estatus = 'nuevo' OR RP.estatus = 'modificado') LIMIT 0,10";                    
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
        if($row_inf['estatus']=='nuevo' || $row_inf['estatus']=='modificado')
        {
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Requisici&oacute;n de Personal</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de requisici&oacuten.</li>
							<li><a href="requisicionpersonaldetalle.php?id='.$row_inf['id_requisicion_personal'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
        }
      } 
    }      
    return $cadena;    
  }
  
  function obtener_compras_autorizar($informacion_laboral){
    $sql="SELECT C.id_compra, C.estatus, C.fecha_solicitud, C.id_perfil_solicitante FROM compras C          
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE PU.id_empresa = '".$informacion_laboral['id_empresa']."' AND (C.estatus = 'nuevo' OR C.estatus = 'modificado') LIMIT 0,10";         
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
        if($row_inf['estatus']=='nuevo' || $row_inf['estatus']=='modificado')
        {
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="comprasdetalle.php?id='.$row_inf['id_compra'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
        }
      } 
    }      
    return $cadena;    
  }
  
  function obtener_pagos_proveedor_autorizar($informacion_laboral){
    $sql="SELECT PP.id_pago_proveedor, PP.estatus, PP.fecha_solicitud, PP.id_perfil_solicitante FROM pagos_proveedores PP          
          INNER JOIN perfil P ON P.id_perfil = PP.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE PU.id_empresa = '".$informacion_laboral['id_empresa']."' AND (PP.estatus = 'nuevo' OR PP.estatus = 'modificado') LIMIT 0,10";                   
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
        if($row_inf['estatus']=='nuevo' || $row_inf['estatus']=='modificado')
        {
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Pago de Proveedores</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de pago de proveedores.</li>
							<li><a href="pagoproveedordetalle.php?id='.$row_inf['id_pago_proveedor'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
        }
      } 
    }      
    return $cadena;    
  }  
  
  function obtener_compras_autorizar_perfil($id_perfil){
    $sql="SELECT * FROM compras                    
          WHERE id_perfil_modificar = '".$id_perfil."' AND estatus = 'invalidado_perfil' LIMIT 0,10";         
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>Se ha asignado una compra de: '.$solicitante['nombre'].' '.$solicitante['paterno'].', favor de modificarla.</li>
							<li><a href="comprasmodificar.php?id='.$row_inf['id_compra'].'"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';        
      } 
    }      
    return $cadena;   
  }

  function obtener_anticipos_autorizar_finanzas($informacion_laboral){
    $sql="SELECT A.id_anticipo, A.estatus, A.fecha_solicitud, A.id_perfil_solicitante FROM anticipos A          
          INNER JOIN perfil P ON P.id_perfil = A.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE A.estatus = 'autorizado_compras' LIMIT 0,10";                                 
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
        $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de anticipo.</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=4"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_reembolsos_autorizar_finanzas($informacion_laboral){
  /*  $sql="SELECT R.id_reembolso, R.estatus, R.fecha_solicitud, R.id_perfil_solicitante FROM reembolsos R          
          INNER JOIN perfil P ON P.id_perfil = R.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE R.estatus = 'autorizado_compras'";*/
    $sql="SELECT R.id_reembolso, R.estatus, R.fecha_solicitud, R.id_perfil_solicitante FROM reembolsos R          
          INNER JOIN perfil P ON P.id_perfil = R.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE R.estatus = 'autorizado_empresa' LIMIT 0,10";                                           
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
        $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Reembolso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de reembolso.</li>
							<li><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'&t=4"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_reembolsos_autorizar_compras(){
    $sql="SELECT R.id_reembolso, R.estatus, R.fecha_solicitud, R.id_perfil_solicitante FROM reembolsos R          
          INNER JOIN perfil P ON P.id_perfil = R.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE R.estatus = 'autorizado_finanzas_test'";             
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Reembolso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de reembolso.</li>
							<li><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'&t=3"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_anticipos_autorizar_empresa($id_perfil){
    $sql="SELECT A.id_anticipo, A.estatus, A.fecha_solicitud, A.id_perfil_solicitante FROM anticipos A          
          INNER JOIN perfil P ON P.id_perfil = A.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE A.estatus = 'autorizado_jefe_inmediato' OR (A.id_perfil_aprobador = '".$id_perfil."' AND A.estatus = 'nuevo') LIMIT 0,10";                             
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/trip_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipos</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de anticipos.</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena; 
  }
  
  function obtener_compras_autorizar_compras(){
    $sql="SELECT C.tipo_compra, C.id_compra, C.estatus, C.fecha_solicitud, C.id_perfil_solicitante FROM compras C          
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE C.estatus = 'autorizado_empresa' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);   
        if($row_inf['tipo_compra']=='cerrada'){
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'&t=3"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';        
        }else{
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="compraspropuesta.php?id='.$row_inf['id_compra'].'&t=3"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';        
        }             
      } 
    }      
    return $cadena;    
  }
  
  function obtener_compras_autorizar_compras_propuestas(){
    $sql="SELECT C.id_compra, C.estatus, C.fecha_solicitud, C.id_perfil_solicitante FROM compras C          
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE C.estatus = 'autorizado_compras_propuesta' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_proveedores_autorizar_compras(){
    $sql="SELECT P.id_proveedor FROM proveedores P
          INNER JOIN compras_propuestas CP ON CP.id_proveedor = P.id_proveedor
          INNER JOIN compras C ON C.id_compra = CP.id_compra
          WHERE P.estatus = 'nuevo' 
          AND C.id_compra_propuesta = CP.id_compra_propuesta
          AND C.estatus = 'autorizado_administracion_rm' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Proveedores</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li><a href="proveedoresmodificar.php?id='.$row_inf['id_proveedor'].'&t=1"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_proveedores_autorizar_direccion(){
    $sql="SELECT * FROM proveedores WHERE estatus = 'autorizado_compras' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Proveedores</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li><a href="proveedoresdetalle.php?id='.$row_inf['id_proveedor'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }  
  
  function obtener_compras_autorizar_compras_jefe_compras(){
    $sql="SELECT C.id_compra, C.estatus, C.fecha_solicitud, C.id_perfil_solicitante FROM compras C          
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE C.estatus = 'autorizado_direccion' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'&t=6"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }    
  
  function obtener_compras_autorizar_finanzas(){
    $sql="SELECT C.id_compra, C.estatus, C.fecha_solicitud, C.id_perfil_solicitante FROM compras C          
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE C.estatus = 'autorizado_administracion_rm' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'&t=4"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_compras_autorizar_direccion(){
    $sql="SELECT C.id_compra, C.estatus, C.fecha_solicitud, C.id_perfil_solicitante FROM compras C          
          INNER JOIN perfil P ON P.id_perfil = C.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE C.estatus = 'autorizado_finanzas' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Compras</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="comprasdetallepropuesta.php?id='.$row_inf['id_compra'].'&t=5"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }  
  
  function obtener_requisicion_personal_autorizar_direccion(){
    $sql="SELECT RP.id_requisicion_personal, RP.estatus, RP.fecha_solicitud, RP.id_perfil_solicitante FROM requisicion_personal RP          
          WHERE RP.estatus = 'autorizado_empresa' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Requisici&oacute;n de Personal</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de compras.</li>
							<li><a href="requisicionpersonaldetalle.php?id='.$row_inf['id_requisicion_personal'].'&t=4"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function verificar_proveedor_autorizado($id_compra_propuesta){
    $sql="SELECT P.estatus FROM proveedores P
          INNER JOIN compras_propuestas CP ON CP.id_proveedor = P.id_proveedor          
          WHERE P.estatus = 'autorizado' AND CP.id_compra_propuesta = '".$id_compra_propuesta."'";                      
    $bandera = false;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $bandera = true;
      } 
    }      
    return $bandera;    
  }
  
  function verificar_existe_proveedor($rfc){
    $sql="SELECT P.estatus FROM proveedores P           
          WHERE P.rfc = '".$rfc."'";                      
    $bandera = false;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $bandera = true;
      } 
    }      
    return $bandera;    
  }        
  
  function obtener_compra_propuestas($idCompra){
    $sql="SELECT * FROM compras_propuestas CP
          INNER JOIN proveedores P ON P.id_proveedor = CP.id_proveedor
          WHERE CP.id_compra = '".$idCompra."' ORDER BY CP.id_compra_propuesta ASC";                      
    $arreglo = array();
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $arreglo[] = $row_inf;
      } 
    }      
    return $arreglo;    
  }
  
  function obtener_reembolsos_autorizar_auxiliar(){
    $sql="SELECT R.id_reembolso, R.estatus, R.fecha_solicitud, R.id_perfil_solicitante FROM reembolsos R          
          INNER JOIN perfil P ON P.id_perfil = R.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE R.estatus = 'autorizado_empresa' LIMIT 0,10";             
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Reembolso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de reembolso.</li>
							<li><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_anticipos_autorizar_auxiliar(){
    $sql="SELECT A.id_anticipo, A.estatus, A.fecha_solicitud, A.id_perfil_solicitante FROM anticipos A          
          INNER JOIN perfil P ON P.id_perfil = A.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE A.estatus = 'autorizado_empresa' LIMIT 0,10";             
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de anticipo.</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=2"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_anticipos_autorizar_compras(){
    $sql="SELECT A.id_anticipo, A.estatus, A.fecha_solicitud, A.id_perfil_solicitante FROM anticipos A          
          INNER JOIN perfil P ON P.id_perfil = A.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE A.estatus = 'autorizado_finanzas' LIMIT 0,10";                       
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de anticipo.</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=3"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_reembolsos_autorizar_direccion(){
    $sql="SELECT R.id_reembolso, R.estatus, R.fecha_solicitud, R.id_perfil_solicitante FROM reembolsos R          
          INNER JOIN perfil P ON P.id_perfil = R.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE R.estatus = 'autorizado_finanzas' LIMIT 0,10";             
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Reembolso</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de reembolso.</li>
							<li><a href="reembolsosdetalle.php?id='.$row_inf['id_reembolso'].'&t=5"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  function obtener_anticipos_autorizar_direccion(){
    $sql="SELECT A.id_reembolso, A.estatus, A.fecha_solicitud, A.id_perfil_solicitante FROM anticipos A          
          INNER JOIN perfil P ON P.id_perfil = A.id_perfil_solicitante
          INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
          WHERE A.estatus = 'autorizado_finanzas' LIMIT 0,10";             
    $cadena = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $solicitante = obtener_datos_perfil_por_id_perfil($row_inf['id_perfil_solicitante']);        
          $cadena.='<li>
          				<img src="images/users/money_eval.png" alt="" class="avatar" />
						<ul>
							<li><a href="#" class="bold">Solicitud de Anticipo</a> &bull; <span class="text-primary"> Asignado</span></li>
							<li>'.$solicitante['nombre'].' '.$solicitante['paterno'].' ha hecho una solicitud de anticipo.</li>
							<li><a href="anticiposdetalle.php?id='.$row_inf['id_anticipo'].'&t=5"><i class="fa fa-gavel">&nbsp;</i> Evaluar Petici&oacute;n</a></li>
						</ul>
					</li>';
      } 
    }      
    return $cadena;    
  }
  
  
  
  
  
  function obtener_id_usuario($id_usuario){
    $sql="SELECT id_user FROM authentication WHERE username = '".$id_usuario."'";        
    $res=mysql_query($sql);
    $id_usuario = 0;
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $id_usuario = $row_inf['id_user'];
      }  
    }
    return $id_usuario;
  }
  
  function obtener_id_perfil($id_usuario){
    $sql="SELECT M.id_perfil FROM mainprofile M
    INNER JOIN authentication A ON A.id_user = M.id_user
    WHERE A.username = '".$id_usuario."'";            
    $res=mysql_query($sql);        
    $id_perfil = 0;
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $id_perfil = $row_inf['id_perfil'];
      }  
    }
    return $id_perfil;
  }
  
  function obtener_informacion_laboral_por_id($id_perfil){
    $sql="SELECT C.id_jerarquia, P.id_perfil, P.id_empresa, P.id_cargo, P.id_puesto, P.id_depto, P.id_subdepto 
          FROM perfil P 
          INNER JOIN cargo C ON C.id_cargo = P.id_cargo
          WHERE P.id_perfil = '".$id_perfil."'";            
    $perfil = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil['id_perfil'] = $row_inf['id_perfil'];        
        $perfil['id_empresa'] = $row_inf['id_empresa'];
        $perfil['id_cargo'] = $row_inf['id_cargo'];
        $perfil['id_puesto'] = $row_inf['id_puesto'];
        $perfil['id_jerarquia'] = $row_inf['id_jerarquia'];
        $perfil['id_depto'] = $row_inf['id_depto'];
        $perfil['id_subdepto'] = $row_inf['id_subdepto'];
      }  
    }
    return $perfil;
  }
  function obtener_informacion_costo($id_costo_mensual){
    $sql="SELECT * FROM costos_mensuales WHERE id_costo_mensual = '".$id_costo_mensual."'";            
    $costo = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $costo['fecha'] = $row_inf['fecha'];        
        $costo['estatus'] = $row_inf['estatus'];
      }  
    }
    return $costo;
  }  
  
  function obtener_cargo_jefe_subdepto_inmediato($perfil){
    $sql="SELECT * FROM cargo WHERE id_empresa = '".$perfil['id_empresa']."' AND id_depto = '".$perfil['id_depto']."' AND id_subdepto = '".$perfil['id_subdepto']."' AND id_jerarquia < '".$perfil['id_jerarquia']."' ORDER BY id_jerarquia DESC LIMIT 0,1";        
    $cargo = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){               
        $cargo['id_empresa'] = $row_inf['id_empresa'];
        $cargo['id_cargo'] = $row_inf['id_cargo'];        
        $cargo['id_jerarquia'] = $row_inf['id_jerarquia'];
      } 
    }        
    return $cargo;
  }
  
  function obtener_cargo_jefe_depto_inmediato($perfil){
    //$sql="SELECT * FROM cargo WHERE id_empresa = '".$perfil['id_empresa']."' AND id_depto = '".$perfil['id_depto']."' AND id_jerarquia < '".$perfil['id_jerarquia']."' ORDER BY id_jerarquia DESC LIMIT 0,1";        
    $sql="SELECT * FROM cargo WHERE id_empresa = '".$perfil['id_empresa']."' AND id_subdepto = '1' AND id_depto = '".$perfil['id_depto']."' AND id_jerarquia < '".$perfil['id_jerarquia']."' ORDER BY id_jerarquia DESC LIMIT 0,1";    
    $cargo = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){               
        $cargo['id_empresa'] = $row_inf['id_empresa'];
        $cargo['id_cargo'] = $row_inf['id_cargo'];        
        $cargo['id_jerarquia'] = $row_inf['id_jerarquia'];
      } 
    }        
    return $cargo;
  }
  
  function obtener_jefe_inmediato($perfil){
    $sql="SELECT * FROM cargo WHERE id_empresa = '".$perfil['id_perfil']."' AND id_departamento = '".$perfil['id_departamento']."' AND id_subdepartamento = '".$perfil['id_subdepartamento']."' AND id_jerarquia < '".$perfil['id_jerarquia']."' ORDER BY id_jerarquia DESC LIMIT 0,1";    
    $perfil = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil['id_perfil'] = $row_inf['id_perfil'];        
        $perfil['id_empresa'] = $row_inf['id_empresa'];
        $perfil['id_cargo'] = $row_inf['id_cargo'];
        $perfil['id_puesto'] = $row_inf['id_puesto'];
        $perfil['id_jerarquia'] = $row_inf['id_jerarquia'];
      } 
    }    
    
    return $perfil;
  }
  
  function obtener_informacion_jefe_por_id_cargo($id_cargo){
    $sql="SELECT id_perfil, nombre, paterno, materno FROM perfil WHERE id_cargo = '".$id_cargo."' AND id_estatus = 1";            
    $res=mysql_query($sql);
    $slcJefeInmediato = '';
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $slcJefeInmediato.='<option value="'.$row_inf['id_perfil'].'">'.$row_inf['nombre'].' '.$row_inf['paterno'].' '.$row_inf['materno'].'</option>';
      }  
    }
    return $slcJefeInmediato;
  }
  
  function obtener_informacion_por_id_cargo($id_cargo){
    $sql="SELECT id_perfil, nombre, paterno, materno FROM perfil WHERE id_cargo = '".$id_cargo."'";            
    $res=mysql_query($sql);
    $slcJefeInmediato = '';
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $slcJefeInmediato.='<option value="'.$row_inf['id_perfil'].'">'.$row_inf['nombre'].' '.$row_inf['paterno'].' '.$row_inf['materno'].'</option>';
      }  
    }
    return $slcJefeInmediato;
  }   
  
  function obtener_datos_perfil_por_id_cargo($id_cargo){
    $sql="SELECT P.id_depto, P.email_trabajo, D.nombre AS departamento, E.nombre AS empresa, PU.nombre AS puesto, U.nombre AS ubicacion, R.nombre AS region, P.nombre, P.paterno, P.materno, P.fecha_ingreso, P.id_perfil
    FROM perfil P
    INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
    INNER JOIN ubicacion U ON U.id_ubicacion = P.id_ubicacion
    INNER JOIN region R ON R.id_region = P.id_region
    INNER JOIN empresa E ON E.id_empresa = P.id_empresa
    INNER JOIN departamento D ON D.id_depto = P.id_depto
    WHERE P.id_cargo = '".$id_cargo."'";            
    $perfil = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil[] = $row_inf;                
      } 
    }     
    return $perfil;
  }
  
  function obtener_datos_perfil_por_id_puesto($id_puesto){
    $sql="SELECT P.id_depto, P.email_trabajo, D.nombre AS departamento, E.nombre AS empresa, PU.nombre AS puesto, U.nombre AS ubicacion, R.nombre AS region, P.nombre, P.paterno, P.materno, P.fecha_ingreso, P.id_perfil
    FROM perfil P
    INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
    INNER JOIN ubicacion U ON U.id_ubicacion = P.id_ubicacion
    INNER JOIN region R ON R.id_region = P.id_region
    INNER JOIN empresa E ON E.id_empresa = P.id_empresa
    INNER JOIN departamento D ON D.id_depto = P.id_depto
    WHERE P.id_puesto = '".$id_puesto."'";            
    $perfil = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil[] = $row_inf;                
      } 
    }     
    return $perfil;
  }     
          
  function obtener_cargo_jefe_empresa($perfil){
    $sql="SELECT * FROM cargo WHERE id_empresa = '".$perfil['id_empresa']."' AND id_jerarquia = 0";    
    $cargo = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){               
        $cargo['id_empresa'] = $row_inf['id_empresa'];
        $cargo['id_cargo'] = $row_inf['id_cargo'];        
        $cargo['id_jerarquia'] = $row_inf['id_jerarquia'];
      } 
    }        
    return $cargo;
  }    
    
  function obtener_datos_perfil($id_usuario){
    $sql="SELECT P.email_trabajo, D.nombre AS departamento, E.nombre AS empresa, PU.nombre AS puesto, U.nombre AS ubicacion, R.nombre AS region, P.nombre, P.paterno, P.materno, P.fecha_ingreso, P.id_perfil
    FROM perfil P
    INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
    INNER JOIN ubicacion U ON U.id_ubicacion = P.id_ubicacion
    INNER JOIN region R ON R.id_region = P.id_region
    INNER JOIN empresa E ON E.id_empresa = P.id_empresa
    INNER JOIN departamento D ON D.id_depto = P.id_depto
    WHERE P.email_trabajo = '".$id_usuario."'";                
    $perfil = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil['id_perfil'] = $row_inf['id_perfil'];        
        $perfil['puesto'] = $row_inf['puesto'];
        $perfil['ubicacion'] = $row_inf['ubicacion'];
        $perfil['region'] = $row_inf['region'];
        $perfil['nombre'] = $row_inf['nombre'];
        $perfil['paterno'] = $row_inf['paterno'];
        $perfil['materno'] = $row_inf['materno'];
        $perfil['departamento'] = $row_inf['departamento'];
        $perfil['empresa'] = $row_inf['empresa'];
        $perfil['fecha_ingreso'] = $row_inf['fecha_ingreso'];
        $perfil['email_trabajo'] = $row_inf['email_trabajo'];        
      } 
    }      
    return $perfil;
  }
  
  function hay_gastos_autorizados(){
    $sql="SELECT COUNT(*) AS total FROM gastos                    
          WHERE estatus = 'autorizado'";
    $total = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = $row_inf['total'];
      }
    }
    return $total;          
  }
  
  function hay_anticipos_autorizados(){
    $sql="SELECT COUNT(*) AS total FROM anticipos                    
          WHERE estatus = 'autorizado'";
    $total = 0;
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
          $total = $row_inf['total'];
      }
    }
    return $total;          
  }
  
  function presupuesto_disponible(){
    return true;
  }
  
  function obtener_datos_finanzas_pago($id_finanzas_pago){
    $sql="SELECT * FROM finanzas_pagos WHERE id_finanza_pago = '".$id_finanzas_pago."'";            
    $finanza_pago = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $finanza_pago['id_pago_a_realizar'] = $row_inf['id_pago_a_realizar'];        
        $finanza_pago['tipo_pago_a_realizar'] = $row_inf['tipo_pago_a_realizar'];
        $finanza_pago['fecha_autorizacion'] = $row_inf['fecha_autorizacion'];
        $finanza_pago['fecha_pago'] = $row_inf['fecha_pago'];  
      } 
    }      
    return $finanza_pago;
  }
  
  function obtener_datos_reembolso($id_reembolso){
    $sql="SELECT * FROM reembolsos WHERE id_reembolso = '".$id_reembolso."'";            
    $reembolso = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res))
    	{
        $reembolso['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $reembolso['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $reembolso['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $reembolso['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $reembolso['proyecto'] = $row_inf['proyecto'];
        $reembolso['estatus'] = $row_inf['estatus'];
        $reembolso['id_empresa'] = $row_inf['id_empresa'];
      }
      
      if($reembolso['id_empresa'] != '0')
      {
      	$idemp = $reembolso['id_empresa'];
      	$sql="SELECT * FROM empresa WHERE id_empresa = '".$idemp."'";
	    $res=mysql_query($sql);
	    if($res&&mysql_numrows($res)>0)
	    {
	    	$row_inf=mysql_fetch_assoc($res);
	    	$reembolso['empresa'] = $row_inf['nombre'];
	    }
      }
      else
		{
	    	$reembolso['empresa'] = 'No hay empresa seleccionada';
		}
      
    }      
    return $reembolso;
  }
  
    function obtener_datos_requisicion($id_requisicion){
    $sql="SELECT * FROM requisicion_personal WHERE id_requisicion_personal = '".$id_requisicion."'";        
    $requisicion = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $requisicion['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $requisicion['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $requisicion['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $requisicion['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $requisicion['oficina_fisica'] = $row_inf['oficina_fisica'];
        $requisicion['tipo_posicion'] = $row_inf['tipo_posicion'];
        $requisicion['justificacion_vacante'] = $row_inf['justificacion_vacante'];
        $requisicion['sueldo_neto'] = $row_inf['sueldo_neto'];
        $requisicion['sueldo_bruto'] = $row_inf['sueldo_bruto'];        
        $requisicion['estatus'] = $row_inf['estatus'];  
      } 
    }      
    return $requisicion;
  }
  
  function obtener_datos_compra($id_compra){
    $sql="SELECT * FROM compras WHERE id_compra = '".$id_compra."'";                
    $gasto = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $gasto['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $gasto['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $gasto['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $gasto['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $gasto['fecha_requerida'] = $row_inf['fecha_requerida'];        
        $gasto['en_presupuesto'] = $row_inf['en_presupuesto'];
        $gasto['comentarios'] = $row_inf['comentarios'];
        $gasto['orden_compra'] = $row_inf['orden_compra'];
        $gasto['id_compra_propuesta'] = $row_inf['id_compra_propuesta'];
        $gasto['tipo_compra'] = $row_inf['tipo_compra'];        
        $gasto['id_proyecto'] = $row_inf['id_proyecto'];
        $gasto['comparativa'] = $row_inf['comparativa'];
        $gasto['cotizacion'] = $row_inf['cotizacion'];
        $gasto['estatus'] = $row_inf['estatus'];  
      } 
    }      
    return $gasto;
  }
  
  function obtener_datos_pago_proveedor($id_pago_proveedor){
    $sql="SELECT * FROM pagos_proveedores WHERE id_pago_proveedor = '".$id_pago_proveedor."'";                
    $pago_proveedor = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $pago_proveedor['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $pago_proveedor['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $pago_proveedor['id_proveedor'] = $row_inf['id_proveedor'];      
        $pago_proveedor['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $pago_proveedor['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $pago_proveedor['tipo'] = $row_inf['tipo'];        
        $pago_proveedor['comentarios'] = $row_inf['comentarios'];
        $pago_proveedor['archivo'] = $row_inf['archivo'];
        $pago_proveedor['archivo_pdf'] = $row_inf['archivo_pdf'];                                    
        $pago_proveedor['estatus'] = $row_inf['estatus'];  
      } 
    }      
    return $pago_proveedor;
  }
  
  function obtener_datos_propuesta($id_propuesta){
    $sql="SELECT * FROM compras_propuestas                     
          WHERE id_compra_propuesta = '".$id_propuesta."'";          
    $propuesta = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $propuesta['id_compra'] = $row_inf['id_compra'];                                  
        $propuesta['id_proveedor'] = $row_inf['id_proveedor'];
        $propuesta['condiciones_pago'] = $row_inf['condiciones_pago'];
        $propuesta['documento_cotizacion'] = $row_inf['documento_cotizacion'];
        $propuesta['imagen_producto'] = $row_inf['imagen_producto'];
        $propuesta['estatus'] = $row_inf['estatus'];
      } 
    }      
    return $propuesta;
  }  
  
  function obtener_datos_proveedor($id_proveedor){
    $sql="SELECT * FROM proveedores P
          LEFT JOIN proveedores_contacto PC ON PC.id_proveedor = P.id_proveedor                    
          WHERE P.id_proveedor = '".$id_proveedor."'";                  
    $proveedor = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $proveedor['id_proveedor'] = $row_inf['id_proveedor'];                                  
        $proveedor['razon_social'] = $row_inf['razon_social'];
        $proveedor['rfc'] = $row_inf['rfc'];
        $proveedor['moneda'] = $row_inf['moneda'];
        $proveedor['segmento_contable_1'] = $row_inf['segmento_contable_1'];
        $proveedor['segmento_contable_2'] = $row_inf['segmento_contable_2'];
        $proveedor['segmento_contable_3'] = $row_inf['segmento_contable_3'];
        $proveedor['telefono_1'] = $row_inf['telefono_1'];
        $proveedor['telefono_2'] = $row_inf['telefono_2'];
        $proveedor['telefono_3'] = $row_inf['telefono_3'];
        $proveedor['telefono_4'] = $row_inf['telefono_4'];
        $proveedor['email'] = $row_inf['email'];
        $proveedor['direccion_web'] = $row_inf['direccion_web'];       
        $proveedor['estatus'] = $row_inf['estatus'];
        $proveedor['nombre'] = $row_inf['nombre'];
        $proveedor['apellido_paterno'] = $row_inf['apellido_paterno'];
        $proveedor['apellido_materno'] = $row_inf['apellido_materno'];        
        $proveedor['telefono'] = $row_inf['telefono'];
      } 
    }      
    return $proveedor;
  }
  
  function obtener_datos_proveedor_contacto_domicilio($id_proveedor, $tipo){
    $sql="SELECT * FROM proveedores_contacto_domicilio  
          WHERE id_proveedor = '".$id_proveedor."' AND tipo_pertenece = '".$tipo."'";          
    $direccion = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $direccion['id_proveedor'] = $row_inf['id_proveedor'];                                  
        $direccion['tipo_pertenece'] = $row_inf['tipo_pertenece'];
        $direccion['pais'] = $row_inf['pais'];
        $direccion['estado'] = $row_inf['estado'];
        $direccion['municipio'] = $row_inf['municipio'];
        $direccion['ciudad'] = $row_inf['ciudad'];
        $direccion['colonia'] = $row_inf['colonia'];
        $direccion['codigo_postal'] = $row_inf['codigo_postal'];
        $direccion['calle'] = $row_inf['calle'];
        $direccion['numero_exterior'] = $row_inf['numero_exterior'];
        $direccion['numero_interior'] = $row_inf['numero_interior'];     
      } 
    }      
    return $direccion;
  }    
  
  function obtener_datos_proveedores_por_id_compra($id_compra){
    $sql="SELECT * FROM proveedores P
          INNER JOIN compras_propuestas CP ON CP.id_proveedor = P.id_proveedor
          LEFT JOIN proveedores_contacto PC ON PC.id_proveedor = P.id_proveedor 
          WHERE CP.id_compra = '".$id_compra."' ORDER BY CP.id_compra_propuesta ASC";                      
    $arreglo = array();
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $arreglo[] = $row_inf;
      } 
    }      
    return $arreglo;
  }      
  
  function obtener_datos_anticipo($id_anticipo){
    $sql="SELECT * FROM anticipos WHERE id_anticipo = '".$id_anticipo."'";            
    $anticipo = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $anticipo['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $anticipo['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $anticipo['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $anticipo['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $anticipo['motivo'] = $row_inf['motivo'];
        $anticipo['id_proyecto'] = $row_inf['id_proyecto'];
        $anticipo['dias'] = $row_inf['dias'];
        $anticipo['cantidad_solicitada'] = $row_inf['cantidad_solicitada'];
        $anticipo['cantidad_aprobada'] = $row_inf['cantidad_aprobada'];
        $anticipo['observaciones'] = $row_inf['observaciones'];
        $anticipo['estatus'] = $row_inf['estatus'];  
      } 
    }      
    return $anticipo;
  }
  
  function obtener_datos_soporte($id_soporte){
    $sql="SELECT * FROM soporte WHERE id_soporte = '".$id_soporte."'";            
    $soporte = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $soporte['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $soporte['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $soporte['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $soporte['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $soporte['tema'] = $row_inf['tema'];
        $soporte['archivo_anexo'] = $row_inf['archivo_anexo'];
        $soporte['prioridad'] = $row_inf['prioridad'];
        $soporte['descripcion'] = $row_inf['descripcion'];
        $soporte['comentarios'] = $row_inf['comentarios'];
        $soporte['estatus'] = $row_inf['estatus'];  
      } 
    }      
    return $soporte;
  }    
  
  function obtener_datos_motivos($tabla, $id_primaria, $id_columna, $id){
    $sql="SELECT * FROM $tabla WHERE $id_columna = '".$id."' ORDER BY $id_primaria DESC";                
    $motivos = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $motivos[] = $row_inf;                
      } 
    }      
    return $motivos;
  }
  
  function obtener_datos_solicitud_involucrados($tipo_solicitud, $id){
    $sql="SELECT * FROM solicitud_involucrados WHERE id_solicitud = '".$id."' AND tipo_solicitud = '".$tipo_solicitud."' ORDER BY id_solicitud_involucrado DESC";                
    $involucrados = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $involucrados[] = $row_inf;                
      } 
    }      
    return $involucrados;
  }  
  
  function obtener_datos_reembolso_conceptos($id_reembolso){
    $sql="SELECT * FROM reembolsos_conceptos WHERE id_reembolso = '".$id_reembolso."'";                
    $gasto_concepto = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $gasto_concepto[] = $row_inf;                
      } 
    }      
    return $gasto_concepto;
  }  
  
  function obtener_datos_compra_conceptos($id_compra){
    $sql="SELECT * FROM compras_conceptos WHERE id_compra = '".$id_compra."' ORDER BY id_compra_concepto ASC";                
    $compra_concepto = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $compra_concepto[] = $row_inf;                
      } 
    }      
    return $compra_concepto;
  }
  
  function obtener_datos_pago_proveedor_conceptos($id_pago_proveedor){
    $sql="SELECT * FROM pagos_proveedores_conceptos WHERE id_pago_proveedor = '".$id_pago_proveedor."' ORDER BY id_pago_proveedor_concepto ASC";                
    $pago_proveedor_concepto = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $pago_proveedor_concepto[] = $row_inf;                
      } 
    }      
    return $pago_proveedor_concepto;
  }  
  
  function obtener_datos_compra_costos($id_compra_concepto){
    $sql="SELECT * FROM compras_costos WHERE id_compra_concepto = '".$id_compra_concepto."'";                
    $compra_costo = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $compra_costo[] = $row_inf;                
      } 
    }      
    return $compra_costo;
  }
  
  function obtener_moneda_compra($id_compra){
    $sql="SELECT DISTINCT(CC.moneda) 
          FROM compras_costos CC 
          INNER JOIN compras_conceptos CCO ON CCO.id_compra_concepto = CC.id_compra_concepto
          WHERE CCO.id_compra = '".$id_compra."'";                
    $moneda = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $moneda = $row_inf['moneda'];                
      } 
    }      
    return $moneda;
  }    
  
  function obtener_datos_anticipo_conceptos($id_anticipo){
    $sql="SELECT * FROM anticipos_conceptos WHERE id_anticipo = '".$id_anticipo."'";                        
    $anticipo_concepto = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $anticipo_concepto[] = $row_inf;                
      } 
    }      
    return $anticipo_concepto;
  }
  
  function obtener_datos_pago_gasto($id_reembolso){
    $sql="SELECT * FROM registro_pago WHERE id_tipo = '".$id_reembolso."' AND tipo = 'gasto'";            
    $pago = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $pago[] = $row_inf;                
      } 
    }      
    return $pago;
  }    
  
  function obtener_datos_vacacion($id_vacacion){
    $sql="SELECT * FROM vacaciones WHERE id_vacacion = '".$id_vacacion."'";                
    $vacacion = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $vacacion['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $vacacion['id_perfil_autoriza'] = $row_inf['id_perfil_autoriza'];
        $vacacion['fecha_desde'] = $row_inf['fecha_desde'];
        $vacacion['fecha_hasta'] = $row_inf['fecha_hasta'];
        $vacacion['dias'] = $row_inf['dias'];
        $vacacion['estatus'] = $row_inf['estatus'];              
        $vacacion['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $vacacion['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
      } 
    }      
    return $vacacion;
  }
  
  function obtener_datos_carta($id_carta){
    $sql="SELECT C.*, CT.tipo FROM cartas C INNER JOIN tipos_cartas CT ON CT.id_tipo_carta = C.id_tipo_carta WHERE C.id_carta = '".$id_carta."'";                
    $carta = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $carta['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $carta['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $carta['id_tipo_carta'] = $row_inf['id_tipo_carta'];
        $carta['fecha_solicitud'] = $row_inf['fecha_solicitud'];        
        $carta['observaciones'] = $row_inf['observaciones'];
        $carta['estatus'] = $row_inf['estatus'];      
        $carta['tipo'] = $row_inf['tipo'];
        $carta['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
      } 
    }      
    return $carta;
  }  
  
  function obtener_datos_permiso($id_permiso){
    $sql="SELECT * FROM perfil_permisos WHERE id_permiso = '".$id_permiso."'";                
    $permiso = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $permiso['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];        
        $permiso['id_perfil_autoriza'] = $row_inf['id_perfil_autoriza'];
        $permiso['fecha_desde'] = $row_inf['fecha_desde'];
        $permiso['fecha_hasta'] = $row_inf['fecha_hasta'];
        $permiso['hora_entrada'] = $row_inf['hora_entrada'];
        $permiso['hora_salida'] = $row_inf['hora_salida'];
        $permiso['dias'] = $row_inf['dias'];
        $permiso['estatus'] = $row_inf['estatus'];      
        $permiso['motivo_solicitante'] = $row_inf['motivo_solicitante'];
        $permiso['motivo_autoriza'] = $row_inf['motivo_autoriza'];
        $permiso['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $permiso['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $permiso['tipo'] = $row_inf['tipo'];
        $permiso['responsable'] = $row_inf['responsable'];
        $permiso['goce_sueldo'] = $row_inf['goce_sueldo'];
      } 
    }      
    return $permiso;
  }
  
  function obtener_datos_requisicion_personal($id_requisicion_personal){
    $sql="SELECT * FROM requisicion_personal WHERE id_requisicion_personal = '".$id_requisicion_personal."'";                
    $permiso = '';
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $permiso['id_requisicion_personal'] = $row_inf['id_requisicion_personal'];        
        $permiso['id_perfil_solicitante'] = $row_inf['id_perfil_solicitante'];
        $permiso['id_perfil_aprobador'] = $row_inf['id_perfil_aprobador'];
        $permiso['fecha_solicitud'] = $row_inf['fecha_solicitud'];
        $permiso['fecha_cambio_estatus'] = $row_inf['fecha_cambio_estatus'];
        $permiso['oficina_fisica'] = $row_inf['oficina_fisica'];
        $permiso['tipo_posicion'] = $row_inf['tipo_posicion'];
        $permiso['justificacion_vacante'] = $row_inf['justificacion_vacante'];      
        $permiso['sueldo_neto'] = $row_inf['sueldo_neto'];
        $permiso['sueldo_bruto'] = $row_inf['sueldo_bruto'];
        $permiso['estatus'] = $row_inf['estatus'];                                                                       
      } 
    }      
    return $permiso;
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
  
  function obtener_datos_perfil_solicitante($id_perfil){
    $sql="SELECT P.email_trabajo, D.nombre AS departamento, E.nombre AS empresa, PU.nombre AS puesto, U.nombre AS ubicacion, R.nombre AS region, P.nombre, P.paterno, P.materno, P.fecha_ingreso, P.id_perfil
    FROM perfil P
    INNER JOIN puesto PU ON P.id_puesto = PU.id_puesto
    INNER JOIN ubicacion U ON U.id_ubicacion = P.id_ubicacion
    INNER JOIN region R ON R.id_region = P.id_region
    INNER JOIN empresa E ON E.id_empresa = P.id_empresa
    INNER JOIN departamento D ON D.id_depto = P.id_depto    
    WHERE P.id_perfil = '".$id_perfil."'";    
    $perfil = '';        
    $res=mysql_query($sql);
    if($res&&mysql_numrows($res)>0){
    	while($row_inf=mysql_fetch_assoc($res)){
        $perfil['id_perfil'] = $row_inf['id_perfil'];        
        $perfil['puesto'] = $row_inf['puesto'];
        $perfil['ubicacion'] = $row_inf['ubicacion'];
        $perfil['region'] = $row_inf['region'];
        $perfil['nombre'] = $row_inf['nombre'];
        $perfil['paterno'] = $row_inf['paterno'];
        $perfil['materno'] = $row_inf['materno'];
        $perfil['departamento'] = $row_inf['departamento'];
        $perfil['empresa'] = $row_inf['empresa'];
        $perfil['fecha_ingreso'] = $row_inf['fecha_ingreso'];
        $perfil['email_trabajo'] = $row_inf['email_trabajo'];        
      } 
    }      
    return $perfil;
  }

  function array2csv(array &$array){
     if (count($array) == 0) {
       return null;
     }
     ob_start();
     $df = fopen("php://output", 'w');
     fputcsv($df, array_keys(reset($array)));
     foreach ($array as $row) {
        fputcsv($df, $row);
     }
     fclose($df);
     return ob_get_clean();
  }

  function download_send_headers($filename) {
      // disable caching
      $now = gmdate("D, d M Y H:i:s");
      header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
      header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
      header("Last-Modified: {$now} GMT");
      // force download  
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");
      // disposition / encoding on response body
      header("Content-Disposition: attachment;filename={$filename}");
      header("Content-Transfer-Encoding: binary");
  }  
  function conectaWS($URL, $parametro){
  	$content = 'request=' . $parametro;
  	$curl = curl_init ( $URL );
  	curl_setopt ( $curl, CURLOPT_HEADER, false );
  	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
  	curl_setopt ( $curl, CURLOPT_POST, true );
  	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $content );
  	$json_response = curl_exec ( $curl );
  	curl_close ( $curl );
  	return json_decode($json_response,true);
  }
  if (isset($_POST['obJSON'])){
  	require 'graficas/GraficasChart.php';
  	//grafica tickets por ubicacion
  	$arrayDatos=$_POST['obJSON'];
  	//echo json_encode(array('mo'=>$arrayDatos['clave']));
  	 
  	$request=json_encode($arrayDatos);
  	$resp=conectaWS("http://delamanocontigo.ppi.mx/webservice_rup.php", $request);
  	$arrayTicketsU=$resp['data'];
  	//var_dump($arrayTicketsU);
  	//echo json_encode($resp);
  	 
  	$GraficaChart = new DatosGraficaChart ();
  	$GraficaChart->setAleaotorio ( false );
  	$GraficaChart->setTipoGrafica("Barras");
  	$datosGraf = $GraficaChart->GraficaValores ( $arrayTicketsU );
  	 
  	echo json_encode($datosGraf,true);
  	 
  }    
?>