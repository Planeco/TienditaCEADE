<?php
$seccion="";
$subseccion="";


$arrSeccionesPagina=array(
	"dashboard"=>"inicio",
		"soporte"=>"soporte",
	
);


$idOp='';
$seccion=isset($arrSeccionesPagina[$__FILE_NAME__])?$arrSeccionesPagina[$__FILE_NAME__]:"";
$subseccion=$__FILE_NAME__;
//echo "[" . $seccion . "][" . $subseccion . "]";


?>
