<?php

	define("DEVELOPER",true);

	#-----------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES DE SISTEMA--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	//define("SYSTEM_ID",1);
	//define("SYSTEM_NAME","Damaka");

	#-----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------CONSTANTES DE PRODUCCION------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	if(!DEVELOPER)
	{
		if(defined("SUBDIR"))
		{
			define("FOLDER_HTDOCS","/var/www/html/" . SUBDIR . "/");
			define("DOMINIO","http://216.46.188.242/" . SUBDIR . "/");
		}
		else
		{
			define("FOLDER_HTDOCS","/var/www/html/");
			define("DOMINIO","http://216.46.188.242/");
		}
		//define("FOLDER_OSTICKET","/var/www/html/admin/osticket/");
		//define("DOMINIO","http://vps-1152682-20296.manage.myhosting.com/admin/");

		#define("WEBSERVICE_URL","https://zonea.amadeocloud.com/axis2/services/DamakaServer/");
		#define("WEBSERVICE_KEY","20APR8710JUL8810MAY87");
		#define("CPANEL_URL","https://cpanel.amadeocloud.com");

		//define("ENVIOMAIL_SMTP",false);
		define("ERR_DEBUG",false);

		define("SESSION_TIME",1800);
		define("SOPORTE_TIME",600);

	}

	#-----------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES DE DESARROLLO-----------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	if(DEVELOPER)
	{

		if(defined("SUBDIR"))
		{
			define("FOLDER_HTDOCS",$_SERVER['DOCUMENT_ROOT'] . "/" . SUBDIR . "/");
			define("DOMINIO","http://planet/" . SUBDIR . "/");
		}
		else
		{
			define("FOLDER_HTDOCS",$_SERVER['DOCUMENT_ROOT'].'TienditaCEADE/');
			define("DOMINIO","http://planet/admin/");
		}

		
		#define("WEBSERVICE_URL","https://zonea.amadeocloud.com/axis2/services/DamakaServer/");
		#define("CPANEL_URL","https://zonea.amadeocloud.com/cpanel/");		
		#define("WEBSERVICE_KEY","20APR8710JUL8810MAY87");
		
		define("ERR_DEBUG",true);
	}
	else{
		define("FOLDER_HTDOCS",$_SERVER['DOCUMENT_ROOT']);
	}

	#---------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------CONSTANTES PARA BASE DE DATOS-----------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	if(DEVELOPER)
	{
		define("CONFIGURACION_DBMS","mysql");
		define("CONFIGURACION_DBMS_HOST","localhost");
		define("CONFIGURACION_DBMS_DB","tiendita");
		define("CONFIGURACION_DBMS_USER","root");
		define("CONFIGURACION_DBMS_PASS","");
		define("CONFIGURACION_DBMS_PREFIX","");
		#define("ISEARCH_ADMIN_PASSWORD","hJzCCNed8FmAT5dq");
	}
	else
	{

		#$username = '';
		#$password = 'QV?pPti$=P#2';
		#$hostname = 'localhost';
		#$database = '';

		define("CONFIGURACION_DBMS","mysql");
		define("CONFIGURACION_DBMS_HOST","localhost");
		define("CONFIGURACION_DBMS_DB","admin_planet");
		define("CONFIGURACION_DBMS_USER","root");
		define("CONFIGURACION_DBMS_PASS","");
		define("CONFIGURACION_DBMS_PREFIX","");
		define("ISEARCH_ADMIN_PASSWORD","hJzCCNed8FmAT5dq");
	}
	#-----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------CONSTANTES DE FOLDERS-------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	define("FOLDER_INCLUDE",BASE_INCLUDE);
	define("FOLDER_LIB",FOLDER_INCLUDE . "lib/");
	define("FOLDER_COMMON",FOLDER_INCLUDE . "common/");
	define("FOLDER_CONF",FOLDER_INCLUDE . "conf/");
	define("FOLDER_MODEL",FOLDER_INCLUDE . "model/");
	define("FOLDER_MODEL_BASE",FOLDER_MODEL . "base/");
	define("FOLDER_MODEL_EXTEND",FOLDER_MODEL . "extend/");
	define("FOLDER_MODEL_DATA",FOLDER_INCLUDE . "model/data/");
	define("FOLDER_CONTROLLER",FOLDER_INCLUDE . "controler/");

	//define("FOLDER_DATOS",FOLDER_HTDOCS . "datos/");

	define("FOLDER_JS",$_SERVER['DOCUMENT_ROOT'] . "/TienditaCEADE/html/js/system/");
	define("FOLDER_LOG",FOLDER_INCLUDE . 'log/');

	#-----------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES DE OS TICKET------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	
	#-----------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES DE LIBRERIAS------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

//	define("LIB_AUTHORIZE",FOLDER_LIB . "anet_php_sdk/lib/");
	///define("LIB_TRANSLATE",FOLDER_LIB . "Translate/translate.inc.php");
	//define("LIB_CONEXION",FOLDER_LIB . "Conexion/Conexion.php");
	define("LIB_CONEXION",FOLDER_LIB . "Conexion/Conexion.inc.php");
	define("LIB_EXCEPTION",FOLDER_LIB . "Excepciones/Exception.php");
	//define("LIB_IMAGE",FOLDER_LIB . "Image/class.clsImagen.inc.php");
	//define("LIB_EMAIL",FOLDER_LIB . "Mail/envioMail.php");
//	define("LIB_NUSOAP",FOLDER_LIB . "nuSOAP/nusoap.php");
	define("LIB_UTILS",FOLDER_LIB . "Utilidades/Utils.php");
	define("LIB_XAJAX",FOLDER_LIB . "xajax_core/xajax.inc.php");
	//define("LIB_CHART",FOLDER_LIB . "phpgraphlib_v2.31/phpgraphlib.php");
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES DE CLASES-------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#


	define("CLASS_COMUN",FOLDER_MODEL. "clsBasicCommon.inc.php");
	define("CLASS_SESSION",FOLDER_MODEL_DATA . "clsSession.inc.php");

	
	#-----------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES DE URLS---------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#


	define("URL_JAVASCRIPT",  "js/system/");
	define("URL_TMP", "datos/tmp/");

	
	define("URL_XAJAX_JS",  "js/lib/");

		#---------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES PARA URLs RUTAS-------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	define("DIR_SEPARATOR","/");


	#---------------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------NOMBRES DE FOLDERS-------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	#---------------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES PARA SESSION--------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#




	#---------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES PARA DEPURACION-------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#


	#---------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------OTRAS----------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	define("_NOW_",date("Y-m-d H:i:s"));

?>
