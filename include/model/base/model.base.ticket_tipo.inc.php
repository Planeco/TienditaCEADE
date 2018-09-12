<?php

	class ModeloBaseTicket_tipo extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTicket_tipo";

		
		var $id_ttipo=0;
		var $id_padre='';
		var $nombre='';
		var $grupo_atencion=0;

		var $__s=array("id_ttipo","id_padre","nombre","grupo_atencion");
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

		
		public function setId_ttipo($id_ttipo)
		{
			if($id_ttipo==0||$id_ttipo==""||!is_numeric($id_ttipo)|| (is_string($id_ttipo)&&!ctype_digit($id_ttipo)))return $this->setError("Tipo de dato incorrecto para id_ttipo.");
			$this->id_ttipo=$id_ttipo;
			$this->getDatos();
		}
		public function setId_padre($id_padre)
		{
			$this->id_padre=$id_padre;
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setGrupo_atencion($grupo_atencion)
		{
			
			$this->grupo_atencion=$grupo_atencion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_ttipo()
		{
			return $this->id_ttipo;
		}
		public function getId_padre()
		{
			return $this->id_padre;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getGrupo_atencion()
		{
			return $this->grupo_atencion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_ttipo=0;
			$this->id_padre='';
			$this->nombre='';
			$this->grupo_atencion=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ticket_tipo(id_padre,nombre,grupo_atencion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_padre) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->grupo_atencion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTicket_tipo::Insertar]");
				
				$this->id_ttipo=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE ticket_tipo SET id_padre='" . mysqli_real_escape_string($this->dbLink,$this->id_padre) . "',nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',grupo_atencion='" . mysqli_real_escape_string($this->dbLink,$this->grupo_atencion) . "'
					WHERE id_ttipo=" . $this->id_ttipo;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_tipo::Update]");
				
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
				$SQL="DELETE FROM ticket_tipo
				WHERE id_ttipo=" . mysqli_real_escape_string($this->dbLink,$this->id_ttipo);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_tipo::Borrar]");
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
						id_ttipo,id_padre,nombre,grupo_atencion
					FROM ticket_tipo
					WHERE id_ttipo=" . mysqli_real_escape_string($this->dbLink,$this->id_ttipo);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTicket_tipo::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_ttipo==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>