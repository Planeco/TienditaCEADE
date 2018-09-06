<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
	ini_set("display_errors", "1");
	//DEFINE("BASE_INCLUDE","/var/www/include/");
	DEFINE("BASE_INCLUDE",$_SERVER['DOCUMENT_ROOT'] . "TienditaCEADE/html/../include/");
//	DEFINE("BASE_INCLUDE",$_SERVER['DOCUMENT_ROOT'] . "/../include/");
	//$__incluirPerfil=true;
	require_once(BASE_INCLUDE . "common/common.inc.php");

