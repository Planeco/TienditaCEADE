<?php

	class ModeloBaseTicket extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTicket";

		
		var $id_ticket=0;
		var $id_solicitante='';
		var $id_asignado='';
		var $fecha='';
		var $num_horas=0;
		var $fecha_resolucion='';
		var $id_tstatus='';
		var $id_tipo='';
		var $id_prioridad='';
		var $titulo='';
		var $notas='';
		var $id_usuario_member=0;

		var $__s=array("id_ticket","id_solicitante","id_asignado","fecha","num_horas","fecha_resolucion","id_tstatus","id_tipo","id_prioridad","titulo","notas","id_usuario_member");
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

		
		public function setId_ticket($id_ticket)
		{
			if($id_ticket==0||$id_ticket==""||!is_numeric($id_ticket)|| (is_string($id_ticket)&&!ctype_digit($id_ticket)))return $this->setError("Tipo de dato incorrecto para id_ticket.");
			$this->id_ticket=$id_ticket;
			$this->getDatos();
		}
		public function setId_solicitante($id_solicitante)
		{
			$this->id_solicitante=$id_solicitante;
		}
		public function setId_asignado($id_asignado)
		{
			$this->id_asignado=$id_asignado;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setNum_horas($num_horas)
		{
			
			$this->num_horas=$num_horas;
		}
		public function setFecha_resolucion($fecha_resolucion)
		{
			$this->fecha_resolucion=$fecha_resolucion;
		}
		public function setId_tstatus($id_tstatus)
		{
			$this->id_tstatus=$id_tstatus;
		}
		public function setId_tipo($id_tipo)
		{
			$this->id_tipo=$id_tipo;
		}
		public function setId_prioridad($id_prioridad)
		{
			$this->id_prioridad=$id_prioridad;
		}
		public function setTitulo($titulo)
		{
			
			$this->titulo=$titulo;
		}
		public function setNotas($notas)
		{
			$this->notas=$notas;
		}
		public function setId_usuario_member($id_usuario_member)
		{
			
			$this->id_usuario_member=$id_usuario_member;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_ticket()
		{
			return $this->id_ticket;
		}
		public function getId_solicitante()
		{
			return $this->id_solicitante;
		}
		public function getId_asignado()
		{
			return $this->id_asignado;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getNum_horas()
		{
			return $this->num_horas;
		}
		public function getFecha_resolucion()
		{
			return $this->fecha_resolucion;
		}
		public function getId_tstatus()
		{
			return $this->id_tstatus;
		}
		public function getId_tipo()
		{
			return $this->id_tipo;
		}
		public function getId_prioridad()
		{
			return $this->id_prioridad;
		}
		public function getTitulo()
		{
			return $this->titulo;
		}
		public function getNotas()
		{
			return $this->notas;
		}
		public function getId_usuario_member()
		{
			return $this->id_usuario_member;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_ticket=0;
			$this->id_solicitante='';
			$this->id_asignado='';
			$this->fecha='';
			$this->num_horas=0;
			$this->fecha_resolucion='';
			$this->id_tstatus='';
			$this->id_tipo='';
			$this->id_prioridad='';
			$this->titulo='';
			$this->notas='';
			$this->id_usuario_member=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ticket(id_solicitante,id_asignado,fecha,num_horas,fecha_resolucion,id_tstatus,id_tipo,id_prioridad,titulo,notas,id_usuario_member)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_solicitante) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_asignado) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->num_horas) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_resolucion) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_tstatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_prioridad) . "','" . mysqli_real_escape_string($this->dbLink,$this->titulo) . "','" . mysqli_real_escape_string($this->dbLink,$this->notas) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_usuario_member) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTicket::Insertar]");
				
				$this->id_ticket=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE ticket SET id_solicitante='" . mysqli_real_escape_string($this->dbLink,$this->id_solicitante) . "',id_asignado='" . mysqli_real_escape_string($this->dbLink,$this->id_asignado) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',num_horas='" . mysqli_real_escape_string($this->dbLink,$this->num_horas) . "',fecha_resolucion='" . mysqli_real_escape_string($this->dbLink,$this->fecha_resolucion) . "',id_tstatus='" . mysqli_real_escape_string($this->dbLink,$this->id_tstatus) . "',id_tipo='" . mysqli_real_escape_string($this->dbLink,$this->id_tipo) . "',id_prioridad='" . mysqli_real_escape_string($this->dbLink,$this->id_prioridad) . "',titulo='" . mysqli_real_escape_string($this->dbLink,$this->titulo) . "',notas='" . mysqli_real_escape_string($this->dbLink,$this->notas) . "',id_usuario_member='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario_member) . "'
					WHERE id_ticket=" . $this->id_ticket;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket::Update]");
				
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
				$SQL="DELETE FROM ticket
				WHERE id_ticket=" . mysqli_real_escape_string($this->dbLink,$this->id_ticket);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket::Borrar]");
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
						id_ticket,id_solicitante,id_asignado,fecha,num_horas,fecha_resolucion,id_tstatus,id_tipo,id_prioridad,titulo,notas,id_usuario_member
					FROM ticket
					WHERE id_ticket=" . mysqli_real_escape_string($this->dbLink,$this->id_ticket);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTicket::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_ticket==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>