<?php

	require_once(LIB_CONEXION);
//	require_once FOLDER_MODEL_DATA . "clsAddSupportOSTicket.inc.php";

class clsSession extends clsBasicCommon
{
	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	private $nombre;
	private $id_login;
	private $id_usuario;
	private  $id_rol;
	public $_lastTime;
	public $_lastTimeSoporte;


	public $_ejecucionPendiente=array();

	private $_data=array();

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#--------------------------------------------Control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	var $__s=array("_lastTimeSoporte","_lastTime","_data",
	"id_login","id_usuario", "id_rol",
		"nombre");

	public function __construct()
	{

	}


	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#----------------------------------------Setter Getter------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function setData($k,$v)
	{
		$this->_data[$k]=$v;
	}

	public function getData($k)
	{
		return $this->_data[$k];
	}

	public function getNombre()
	{
		return $this->nombre;
	}

		public function getUserName()
	{
		return $this->user_name;
	}

	public function getLastTime()
	{
		return $this->_lastTime;
	}
	
	public function getIdLogin()
	{
		return $this->id_login;
	}
	
	public function getIdUser()
	{
		return $this->id_usuario;
	}
	
	public function getIdRol(){
		return $this->id_rol;
	}
	

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Acciones--------------------------------------------#
	#-----------------------------------------------------------------------------------------------#
	
	public function isSessionActive()
	{
		return time()-$this->_lastTime<defined("SESSION_TIME")?SESSION_TIME:1800;
	}

	public function updateTime()
	{
		$this->_lastTime=time();
	}

	public function setObjetoGetInfo($oGI)
	{

		foreach($oGI as $k=>$v)
		{
			if(in_array($k, $this->__s))
			{
				$this->$k=$v;
			}
		}

	}


	public function resetError()
	{
		$this->error=false;
		$this->strError="";
	}




	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#
}