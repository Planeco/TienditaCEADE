<?php

	class ModeloBaseTicket_archivo extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTicket_archivo";

		
		var $id_tarchivo=0;
		var $fecha='';
		var $id_ticket='';
		var $id_solicitante=0;
		var $descripcion='';
		var $archivo='';

		var $__s=array("id_tarchivo","fecha","id_ticket","id_solicitante","descripcion","archivo");
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

		
		public function setId_tarchivo($id_tarchivo)
		{
			if($id_tarchivo==0||$id_tarchivo==""||!is_numeric($id_tarchivo)|| (is_string($id_tarchivo)&&!ctype_digit($id_tarchivo)))return $this->setError("Tipo de dato incorrecto para id_tarchivo.");
			$this->id_tarchivo=$id_tarchivo;
			$this->getDatos();
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setId_ticket($id_ticket)
		{
			$this->id_ticket=$id_ticket;
		}
		public function setId_solicitante($id_solicitante)
		{
			
			$this->id_solicitante=$id_solicitante;
		}
		public function setDescripcion($descripcion)
		{
			
			$this->descripcion=$descripcion;
		}
		public function setArchivo($archivo)
		{
			
			$this->archivo=$archivo;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_tarchivo()
		{
			return $this->id_tarchivo;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getId_ticket()
		{
			return $this->id_ticket;
		}
		public function getId_solicitante()
		{
			return $this->id_solicitante;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getArchivo()
		{
			return $this->archivo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_tarchivo=0;
			$this->fecha='';
			$this->id_ticket='';
			$this->id_solicitante=0;
			$this->descripcion='';
			$this->archivo='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ticket_archivo(fecha,id_ticket,id_solicitante,descripcion,archivo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_ticket) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_solicitante) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->archivo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTicket_archivo::Insertar]");
				
				$this->id_tarchivo=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE ticket_archivo SET fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',id_ticket='" . mysqli_real_escape_string($this->dbLink,$this->id_ticket) . "',id_solicitante='" . mysqli_real_escape_string($this->dbLink,$this->id_solicitante) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',archivo='" . mysqli_real_escape_string($this->dbLink,$this->archivo) . "'
					WHERE id_tarchivo=" . $this->id_tarchivo;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_archivo::Update]");
				
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
				$SQL="DELETE FROM ticket_archivo
				WHERE id_tarchivo=" . mysqli_real_escape_string($this->dbLink,$this->id_tarchivo);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_archivo::Borrar]");
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
						id_tarchivo,fecha,id_ticket,id_solicitante,descripcion,archivo
					FROM ticket_archivo
					WHERE id_tarchivo=" . mysqli_real_escape_string($this->dbLink,$this->id_tarchivo);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTicket_archivo::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_tarchivo==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>