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
			define("FOLDER_HTDOCS",$_SERVER['DOCUMENT_ROOT'].'omsUccCenter/');
			define("DOMINIO","http://planet/admin/");
		}

		define("FOLDER_OSTICKET",$_SERVER['DOCUMENT_ROOT'] . "/osticket/");

		define("ENVIOMAIL_SMTP",true);
		
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
		define("CONFIGURACION_DBMS_DB","planet");
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
	#--------------------------------------------------CONSTANTES DE KDUCEO-------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#


	/*
	define("DAMAKA_URL_WS","http://soap.1161.my-online-check.com/avavoip_gate.php?wsdl");
	define("DAMAKA_USER","soap_external");
	define("DAMAKA_PASS",'s0@padwscrm161');
	*/


	define("DAMAKA_URL_WS","http://soap.1161.my-online-check.com/avavoip_gate.php?wsdl");
	#define("DAMAKA_URL_WS","http://http://216.224.186.54/avavoip_gate.php?wsdl");
	
	define("DAMAKA_USER","soap_external");
	define("DAMAKA_PASS",'s0@padwscrm161');

	/*
	<soap:Header>
		<user xsi:type="xsd:string">soap_external</user>
		<password xsi:type="xsd:string">fe02d097ffa37983dccf75d11ac06aad</password>
	</soap:Header>
	*/

	#-----------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES DE DIDWW--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	//define("DIDWW_URL_WS","https://api.didww.com/api2/?wsdl");
	//define("DIDWW_USER","htmoff@hotmail.com");
	//define("DIDWW_PASS",'GIU9ENBQ1R0UEJX2A9XQBZB');


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
	define("FOLDER_MODEL_WS",FOLDER_INCLUDE . "model/ws/");
	define("FOLDER_MODEL_WSDIDWW",FOLDER_INCLUDE . "model/wsdidww/");
	define("FOLDER_MODEL_SUPPDESK",FOLDER_INCLUDE . "model/suppdesk/");
	define("FOLDER_MODEL_WSAMADEOCLOUD",FOLDER_INCLUDE . "model/wsamadeocloud/");
	define("FOLDER_CONTROLLER",FOLDER_INCLUDE . "controler/");
	

	//define("FOLDER_DATOS",FOLDER_HTDOCS . "datos/");

	define("FOLDER_JS",$_SERVER['DOCUMENT_ROOT'] . "/omsUccCenter/html/js/system/");
	define("FOLDER_LOG",FOLDER_INCLUDE . 'log/');
	define("FOLDER_CDR",FOLDER_INCLUDE . 'cdr/');
	define("FOLDER_CDR_TMP",FOLDER_INCLUDE . 'cdrTMP/');
	define("FOLDER_AUTHORIZE",FOLDER_INCLUDE . "lib/anet_php_sdk/");

	#-----------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES DE OS TICKET------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	define("INCLUDE_DIR", FOLDER_OSTICKET . "/include/");
	define("OSTICKET_PASS","p1An37@_oct");
	define("OSTICKET_CLASS_PASS",FOLDER_OSTICKET . "include/class.passwd.php");

	#-----------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------CONSTANTES DE LIBRERIAS------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#

	define("LIB_AUTHORIZE",FOLDER_LIB . "anet_php_sdk/lib/");
	define("LIB_TRANSLATE",FOLDER_LIB . "Translate/translate.inc.php");
	//define("LIB_CONEXION",FOLDER_LIB . "Conexion/Conexion.php");
	define("LIB_CONEXION",FOLDER_LIB . "Conexion/mysql.inc.php");
	define("LIB_EXCEPTION",FOLDER_LIB . "Excepciones/Exception.php");
	//define("LIB_IMAGE",FOLDER_LIB . "Image/class.clsImagen.inc.php");
	//define("LIB_EMAIL",FOLDER_LIB . "Mail/envioMail.php");
	define("LIB_NUSOAP",FOLDER_LIB . "nuSOAP/nusoap.php");
	define("LIB_UTILS",FOLDER_LIB . "Utilidades/Utils.php");
	define("LIB_XAJAX",FOLDER_LIB . "xajax_core/xajax.inc.php");
	//define("LIB_CHART",FOLDER_LIB . "phpgraphlib_v2.31/phpgraphlib.php");
	define("LIB_CSV",FOLDER_LIB . "csv/csv2mysql.inc.php");
	//define("FILE_PAGINACION",FOLDER_COMMON . "paginacion.inc.php");
	define("LIB_REVISAR_PENDIENTES_XAJAX",FOLDER_LIB . "Utilidades/xajaxRevisarPendientes.inc.php");

	#-----------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES DE CLASES-------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#


	define("CLASS_COMUN_WS",FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");
	define("CLASS_COMUN",FOLDER_MODEL. "clsBasicCommon.inc.php");
	define("CLASS_COMUN_CONSULTA",FOLDER_MODEL_DATA . "common.consulta.inc.php");
	define("CLASS_SESSION",FOLDER_MODEL_DATA . "clsSession.inc.php");

	define("RUTA_OMS", "/var/www/vhost/oms.ucc.center/html/doctos");
	define("RUTA_UCC", "/var/www/vhost/ucc.center/html/doctos");
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES DE URLS---------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------#


	define("URL_JAVASCRIPT",  "js/system/");
	define("URL_TMP", "datos/tmp/");

	#define("URL_JAVASCRIPT_AJAX_UPLOAD", DOMINIO . "javascripts/lib/AjaxUpload.2.0.min.js");
	#define("URL_JAVASCRIPT_DEFAULT", DOMINIO . "javascripts/lib/default.js");

	#define("URL_JAVASCRIPT_COMMON", DOMINIO . "javascripts/common/");
	#define("URL_JAVASCRIPT_COMMON_LIB", URL_JAVASCRIPT_COMMON . "common.js");

	/*
	define("URL_FILES_ALERT",'<script language="javascript" src="' . DOMINIO . 'js/lib/jquery.alerts-1.1/jquery.alerts.js"></script>
			<link rel="stylesheet" type="text/css" href="js/lib/jquery.alerts-1.1/jquery.alerts.css" />
			<script language="javascript" src="' . DOMINIO . 'js/lib/common.js"></script>');
	*/

	define("URL_XAJAX_JS",  "js/lib/");

	#define("URL_CSS_JQUERY_UI", DOMINIO . "css/blitzer/jquery-ui-1.9.0.custom.min.css");
	#define("URL_JAVASCRIPT_JQUERY", DOMINIO . "javascripts/lib/jquery-1.8.2.js");
	#define("URL_JAVASCRIPT_JQUERY", DOMINIO . "js/jquery-1.7.2.min.js");
	#define("URL_JAVASCRIPT_JQUERY_UI", DOMINIO . "javascripts/lib/jquery-ui-1.9.0.custom.min.js");
	#define("URL_JAVASCRIPT_JQUERY_DATAPICKER_ESP", DOMINIO . "javascripts/lib/jquery.numeric.js");
	define("URL_JAVASCRIPT_NUMERIC", DOMINIO . "js/lib/jquery.numeric.js");
	#define("URL_JAVASCRIPT_NUMERIC", DOMINIO . "javascripts/lib/ui.datepicker-es.2.js");
	#define("URL_JAVASCRIPT_TINYMCE", DOMINIO . "javascripts/lib/tinymce/tiny_mce.js");

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


	//define("DEBUG_FILE",true);
	//define("DEBUG_MOSTRAR_JSON",true);
	//define("DEBUG_PATH_FILE",FOLDER_LOG . "error.log");
	//define("ERR_AUTOR",999999);




	#---------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------CONSTANTES PARA ENVIO DE MAIL-----------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#


	//define("ENVIOMAIL_SMTP_FROM","soporte@aiidia.com");
	//define("ENVIOMAIL_SMTP_NAME","Soporte");
	//define("ENVIOMAIL_SMTP_USERNAME","soporte@aiidia.com");
	//define("ENVIOMAIL_SMTP_PASS","SooSPAiPoI9020");


	#---------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------CONSTANTES TRIAL-----------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	define("TRIAL_FOLDER",FOLDER_INCLUDE . "proveedoresPagos/trial/");

	#---------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------CONSTANTES AUTHORIZE---------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	define("AUTHORIZE_FOLDER",FOLDER_INCLUDE . "proveedoresPagos/authorize/");

	#---------------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------CONSTANTES PAYPAL--------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	define("PAYPAL_SANDBOX",true);
	
	define("PAYPAL_FOLDER",FOLDER_INCLUDE . "proveedoresPagos/paypal/");

	if(PAYPAL_SANDBOX) //TEST
	{
		define("PAYPAL_URL_ACTION","https://www.sandbox.paypal.com/cgi-bin/webscr");
		define("PAYPAL_ACCOUNT_ID","CPHXBNPCWUUT6");
	}
	else //Production
	{
		define("PAYPAL_URL_ACTION","https://www.paypal.com/cgi-bin/webscr");
		define("PAYPAL_ACCOUNT_ID","KTTXHQXS6PLCL");
	}

	#---------------------------------------------------PAYPAL Pago registro----------------------------------------------------#
	define("PAYPAL_URL_SUCCESS",DOMINIO . "success.php");
	define("PAYPAL_URL_CANCEL",DOMINIO . "cancel.php");
	define("PAYPAL_URL_IPN",DOMINIO . "ipn.php");

	#--------------------------------------------------PAYPAL Agregar credito---------------------------------------------------#
	define("PAYPAL_URL_CREDIT_SUCCESS",DOMINIO . "addcreditsuccess.php");
	define("PAYPAL_URL_CREDIT_CANCEL",DOMINIO . "addcreditcancel.php");
	define("PAYPAL_URL_CREDIT_IPN",DOMINIO . "addcreditipn.php");

	#-------------------------------------------------PAYPAL Agregar Sip Trunk--------------------------------------------------#
	define("PAYPAL_URL_SIPTRUNK_SUCCESS",DOMINIO . "successendpoint.php");
	define("PAYPAL_URL_SIPTRUNK_CANCEL",DOMINIO . "endpoints.php");
	define("PAYPAL_URL_SIPTRUNK_IPN",DOMINIO . "endpointipn.php");
	#-------------------------------------------------PAYPAL Renew License --------------------------------------------------#
	define("PAYPAL_URL_RENEWLCNS_SUCCESS",DOMINIO . "successrenewal.php");
	define("PAYPAL_URL_RENEWLCNS_CANCEL",DOMINIO . "dashboard.php");
	define("PAYPAL_URL_RENEWLCNS_IPN",DOMINIO . "renewlicenseipn.php");

	#---------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------TAMANIO DE IMAGENES--------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------PERMISOS--------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#



	#---------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------ARCHIVOS JAVASCRIPT CSS-------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	#define("URL_JAVASCRIPT_TINYMCE_INCLUDE",'<script language="javascript" src="' . URL_JAVASCRIPT_TINYMCE . '"></script>');

	#$__FILES_JAVASCRIPT_CSS=array();
	#$__FILES_JAVASCRIPT_CSS[]='<link href="' . URL_CSS_JQUERY_UI . '" rel="stylesheet" type="text/css" />';
	#$__FILES_JAVASCRIPT_CSS[]='<script language="javascript" src="' . URL_JAVASCRIPT_JQUERY . '"></script>';
	#$__FILES_JAVASCRIPT_CSS[]='<script type="text/javascript" src="' . URL_JAVASCRIPT_JQUERY_UI . '"></script>';
	#$__FILES_JAVASCRIPT_CSS[]='<script type="text/javascript" src="' . URL_JAVASCRIPT_JQUERY_DATAPICKER_ESP . '"></script>';
	#$__FILES_JAVASCRIPT_CSS[]='<script language="javascript" src="' . URL_JAVASCRIPT_AJAX_UPLOAD . '"></script>';
	#$__FILES_JAVASCRIPT_CSS[]='<script language="javascript" src="' . URL_JAVASCRIPT_COMMON_LIB . '"></script>';
	#$__FILES_JAVASCRIPT_CSS[]='<script language="javascript" src="' . URL_JAVASCRIPT_NUMERIC . '"></script>';
	#$__FILES_JAVASCRIPT_CSS[]=URL_FILES_ALERT;



	#---------------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------CONSTANTES PARA REPORTES-------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#



	#---------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	#---------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------LUGARES MENU USUARIO---------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#


	/*
	define("MENU_USER_LUGAR_ADMIN","admin");
	define("MENU_USER_LUGAR_DASHBOARD","dashboard");
	define("MENU_USER_LUGAR_REPORTES","reportes");
	define("MENU_USER_LUGAR_SERVICIOS","servicios");
	define("MENU_USER_LUGAR_COMUNIDAD","comunidad");
	define("MENU_USER_LUGAR_SOPORTE","soporte");
	define("MENU_USER_LUGAR_CUENTA","cuenta");
	define("MENU_USER_LUGAR_ASISTENCIA","asistencia");
	define("MENU_USER_LUGAR_COBERTURAS","coberturas");
	*/




	#---------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------OTRAS----------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------#

	define("_NOW_",date("Y-m-d H:i:s"));
	//define("EMAIL_SYSTEM","soporte@kduceo.com");
	$_NOW_=date("Y-m-d H:i:s");

?>
