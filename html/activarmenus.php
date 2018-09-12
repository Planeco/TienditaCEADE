<?php
$seccion = "";
$subseccion = "";

$arrSeccionesPagina = array(
    "dashboard" => "inicio",
    "ticket" => "soporte",
    "ticketadd" => "soporte",
    "ticketasig" => "soporte",
    "tickethis" => "soporte",
    "ticketrev" => "soporte",
    
    "puntoVenta" => "caja",
    "cancelarRecibo" => "caja",
    "corteDia" => "caja",
    
    "altaProducto" => "inventario",
    "ingreso" => "inventario",
    "reportes" => "inventario",
    "busqueda" => "inventario",
    
    "contrasena" => "preferencias"
);

$idOp = '';
$seccion = isset($arrSeccionesPagina[$__FILE_NAME__]) ? $arrSeccionesPagina[$__FILE_NAME__] : "";
$subseccion = $__FILE_NAME__;
//  echo "[" . $seccion . "][" . $subseccion . "]";

?>
