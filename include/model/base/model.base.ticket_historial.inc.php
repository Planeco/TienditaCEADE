<?php

	class ModeloBaseTicket_historial extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTicket_historial";

		
		var $id_thistorial=0;
		var $id_solicitante='';
		var $id_ticket='';
		var $fecha='';
		var $id_tstatus='';
		var $notas='';
		var $ack='0';

		var $__s=array("id_thistorial","id_solicitante","id_ticket","fecha","id_tstatus","notas","ack");
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

		
		public function setId_thistorial($id_thistorial)
		{
			if($id_thistorial==0||$id_thistorial==""||!is_numeric($id_thistorial)|| (is_string($id_thistorial)&&!ctype_digit($id_thistorial)))return $this->setError("Tipo de dato incorrecto para id_thistorial.");
			$this->id_thistorial=$id_thistorial;
			$this->getDatos();
		}
		public function setId_solicitante($id_solicitante)
		{
			$this->id_solicitante=$id_solicitante;
		}
		public function setId_ticket($id_ticket)
		{
			$this->id_ticket=$id_ticket;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setId_tstatus($id_tstatus)
		{
			$this->id_tstatus=$id_tstatus;
		}
		public function setNotas($notas)
		{
			$this->notas=$notas;
		}
		public function setAck()
		{
			$this->ack=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetAck()
		{
			$this->ack=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_thistorial()
		{
			return $this->id_thistorial;
		}
		public function getId_solicitante()
		{
			return $this->id_solicitante;
		}
		public function getId_ticket()
		{
			return $this->id_ticket;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getId_tstatus()
		{
			return $this->id_tstatus;
		}
		public function getNotas()
		{
			return $this->notas;
		}
		public function getAck()
		{
			return $this->ack;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_thistorial=0;
			$this->id_solicitante='';
			$this->id_ticket='';
			$this->fecha='';
			$this->id_tstatus='';
			$this->notas='';
			$this->ack='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ticket_historial(id_solicitante,id_ticket,fecha,id_tstatus,notas,ack)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_solicitante) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_ticket) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_tstatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->notas) . "','" . mysqli_real_escape_string($this->dbLink,$this->ack) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTicket_historial::Insertar]");
				
				$this->id_thistorial=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE ticket_historial SET id_solicitante='" . mysqli_real_escape_string($this->dbLink,$this->id_solicitante) . "',id_ticket='" . mysqli_real_escape_string($this->dbLink,$this->id_ticket) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',id_tstatus='" . mysqli_real_escape_string($this->dbLink,$this->id_tstatus) . "',notas='" . mysqli_real_escape_string($this->dbLink,$this->notas) . "',ack='" . mysqli_real_escape_string($this->dbLink,$this->ack) . "'
					WHERE id_thistorial=" . $this->id_thistorial;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_historial::Update]");
				
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
				$SQL="DELETE FROM ticket_historial
				WHERE id_thistorial=" . mysqli_real_escape_string($this->dbLink,$this->id_thistorial);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_historial::Borrar]");
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
						id_thistorial,id_solicitante,id_ticket,fecha,id_tstatus,notas,ack
					FROM ticket_historial
					WHERE id_thistorial=" . mysqli_real_escape_string($this->dbLink,$this->id_thistorial);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTicket_historial::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_thistorial==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>