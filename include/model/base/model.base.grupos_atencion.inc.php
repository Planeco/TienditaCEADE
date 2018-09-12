<?php

	class ModeloBaseGrupos_atencion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseGrupos_atencion";

		
		var $idGrupoAtencion=0;
		var $nombre='';
		var $id_encargado=0;

		var $__s=array("idGrupoAtencion","nombre","id_encargado");
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

		
		public function setIdGrupoAtencion($idGrupoAtencion)
		{
			if($idGrupoAtencion==0||$idGrupoAtencion==""||!is_numeric($idGrupoAtencion)|| (is_string($idGrupoAtencion)&&!ctype_digit($idGrupoAtencion)))return $this->setError("Tipo de dato incorrecto para idGrupoAtencion.");
			$this->idGrupoAtencion=$idGrupoAtencion;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setId_encargado($id_encargado)
		{
			
			$this->id_encargado=$id_encargado;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdGrupoAtencion()
		{
			return $this->idGrupoAtencion;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getId_encargado()
		{
			return $this->id_encargado;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idGrupoAtencion=0;
			$this->nombre='';
			$this->id_encargado=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO grupos_atencion(nombre,id_encargado)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_encargado) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseGrupos_atencion::Insertar]");
				
				$this->idGrupoAtencion=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE grupos_atencion SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',id_encargado='" . mysqli_real_escape_string($this->dbLink,$this->id_encargado) . "'
					WHERE idGrupoAtencion=" . $this->idGrupoAtencion;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseGrupos_atencion::Update]");
				
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
				$SQL="DELETE FROM grupos_atencion
				WHERE idGrupoAtencion=" . mysqli_real_escape_string($this->dbLink,$this->idGrupoAtencion);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseGrupos_atencion::Borrar]");
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
						idGrupoAtencion,nombre,id_encargado
					FROM grupos_atencion
					WHERE idGrupoAtencion=" . mysqli_real_escape_string($this->dbLink,$this->idGrupoAtencion);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseGrupos_atencion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idGrupoAtencion==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>