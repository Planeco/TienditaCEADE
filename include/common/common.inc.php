<?php
	session_start();

	date_default_timezone_set('America/Mexico_City');

	if(!file_exists(BASE_INCLUDE . "conf/constantes.php"))
	{
		die("El constantes no existe");

	}




	require_once(BASE_INCLUDE . "conf/constantes.php");


	require_once(CLASS_COMUN);
	require_once(CLASS_COMUN_WS);
	require_once(CLASS_SESSION);



	$objSession=new clsSession();

	#print_r($_REQUEST);

	if(isset($_revisarSiExisteSession)&&$_revisarSiExisteSession)
	{
		if(!isset($_SESSION['objSession']))
		{
			header("Location: index.php");
			die();
		}
		$objSession=unserialize($_SESSION['objSession']);

		if(!$objSession->isSessionActive())
		{
			unset($objSession);
			session_destroy();
			header("Location: index.php");
			die();
		}
		$objSession->updateTime();
		$_SESSION['objSession']=serialize($objSession);
	}

	require_once(LIB_CONEXION);
	//require_once(LIB_CONEXION_INT);
	require_once(LIB_TRANSLATE);
	require_once(LIB_XAJAX);
	//require_once(LIB_UTILS);
	//require_once(LIB_IMAGE);
	require_once(LIB_EXCEPTION);

	//require_once(CLASS_COMUN);
	//require_once(CLASS_COMUN_CONSULTA);


	#-----------------------------------------------------------------------------------------------#
	#----------------Inicializo las conecciones a las BD necesarias, segun el Script----------------#
	#-----------------------------------------------------------------------------------------------#

	/*

	$_DB=new PDOConfig();

	if(isset($_USEDBINT))
		$_DBI=new PDOConfigIntegrantes();

	*/

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#


	#require_once $_SERVER['DOCUMENT_ROOT'] . '/redServer/protected/Configuracion/i18n/' . $_SESSION['lang'] . '.php';

	/*

	if(isset($__incluirPerfil))
	{
		require_once (FOLDER_MODEL_NEW . "/model.perfil.inc.php");
	}

	*/





	$pedazos=explode("/", $_SERVER['PHP_SELF']);
	$__FILE_NAME__=str_replace(array("/",".php"),"",$pedazos[count($pedazos)-1]);
	
	if(is_file(BASE_INCLUDE . "controler/" . $__FILE_NAME__ . ".inc.php"))
	{
		require_once(BASE_INCLUDE . "controler/" . $__FILE_NAME__ . ".inc.php");
		
	}


	if(!isset($_JAVASCRIPT_CSS))
		$_JAVASCRIPT_CSS="";

	if(isset($xajax))
		$_JAVASCRIPT_CSS.=$xajax->getJavascript("js/lib/");

	$_JAVASCRIPT_CSS.='<script type="text/javascript" src="' . URL_JAVASCRIPT . '../lib/common.js"></script>';

	if(isset($_JAVASCRIPT_OUT))
		$_JAVASCRIPT_CSS.='<script type="text/javascript">' . $_JAVASCRIPT_OUT . '</script>';


	if(isset($objSession)&&$objSession->ejecucionPendiente())
		$_JAVASCRIPT_CSS.='<script type="text/javascript">setTimeout(revisarPendientes,3000)</script>';




	if(is_file(FOLDER_JS . $__FILE_NAME__ . ".js"))
		$_JAVASCRIPT_CSS.='<script type="text/javascript" src="' . URL_JAVASCRIPT . $__FILE_NAME__ . '.js"></script>';
