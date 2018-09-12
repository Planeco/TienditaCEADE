<?php

	class ModeloBaseTicket_status extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTicket_status";

		
		var $id_tstatus='';
		var $nombre='';
		var $tag='';

		var $__s=array("id_tstatus","nombre","tag");
		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			global $dbLink;
			if(is_null($dbLink))
			{
				trigger_error("La coneccion a la base de datos no esta establecida.",E_ERROR);
				return;
			}
			$this->dbLink=$dbLink;
			$this->link=$dbLink;
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function setId_tstatus()
		{
			$this->id_tstatus=1;
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setTag($tag)
		{
			
			$this->tag=$tag;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetId_tstatus()
		{
			$this->id_tstatus=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_tstatus()
		{
			return $this->id_tstatus;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getTag()
		{
			return $this->tag;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_tstatus='';
			$this->nombre='';
			$this->tag='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ticket_status(id_tstatus,nombre,tag)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_tstatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->tag) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTicket_status::Insertar]");
				
				$this->=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		protected function Actualizar()
		{
			try
			{
				$SQL="UPDATE ticket_status SET id_tstatus='" . mysqli_real_escape_string($this->dbLink,$this->id_tstatus) . "',nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',tag='" . mysqli_real_escape_string($this->dbLink,$this->tag) . "'
					WHERE =" . $this->;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_status::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Borrar()
		{
			if($this->getError())
				return false;
			try
			{
				$SQL="DELETE FROM ticket_status
				WHERE =" . mysqli_real_escape_string($this->dbLink,$this->);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_status::Borrar]");
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function getDatos()
		{
			try
			{
				$SQL="SELECT
						id_tstatus,nombre,tag
					FROM ticket_status
					WHERE =" . mysqli_real_escape_string($this->dbLink,$this->);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTicket_status::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

				if(mysqli_num_rows($result)==0)
				{
					$this->limpiarPropiedades();
				}
				else
				{
					$datos=mysqli_fetch_assoc($result);
					foreach($datos as $k=>$v)
					{
						$campo="" . $k;
						$this->$campo=$v;
					}
				}
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Guardar()
		{
			if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;
			if($this->==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>