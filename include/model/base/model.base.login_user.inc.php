<?php

	class ModeloBaseLogin_user extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseLogin_user";

		
		var $id_login=0;
		var $id_usuario=0;
		var $user_name='';
		var $password='';
		var $salt='';
		var $id_rol=0;
		var $email='';

		var $__s=array("id_login","id_usuario","user_name","password","salt","id_rol","email");
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

		
		public function setId_login($id_login)
		{
			if($id_login==0||$id_login==""||!is_numeric($id_login)|| (is_string($id_login)&&!ctype_digit($id_login)))return $this->setError("Tipo de dato incorrecto para id_login.");
			$this->id_login=$id_login;
			$this->getDatos();
		}
		public function setId_usuario($id_usuario)
		{
			
			$this->id_usuario=$id_usuario;
		}
		public function setUser_name($user_name)
		{
			
			$this->user_name=$user_name;
		}
		public function setPassword($password)
		{
			$this->password=$password;
		}
		public function setSalt($salt)
		{
			$this->salt=$salt;
		}
		public function setId_rol($id_rol)
		{
			
			$this->id_rol=$id_rol;
		}
		public function setEmail($email)
		{
			
			$this->email=$email;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_login()
		{
			return $this->id_login;
		}
		public function getId_usuario()
		{
			return $this->id_usuario;
		}
		public function getUser_name()
		{
			return $this->user_name;
		}
		public function getPassword()
		{
			return $this->password;
		}
		public function getSalt()
		{
			return $this->salt;
		}
		public function getId_rol()
		{
			return $this->id_rol;
		}
		public function getEmail()
		{
			return $this->email;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_login=0;
			$this->id_usuario=0;
			$this->user_name='';
			$this->password='';
			$this->salt='';
			$this->id_rol=0;
			$this->email='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO login_user(id_usuario,user_name,password,salt,id_rol,email)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->user_name) . "','" . mysqli_real_escape_string($this->dbLink,$this->password) . "','" . mysqli_real_escape_string($this->dbLink,$this->salt) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_rol) . "','" . mysqli_real_escape_string($this->dbLink,$this->email) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseLogin_user::Insertar]");
				
				$this->id_login=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE login_user SET id_usuario='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "',user_name='" . mysqli_real_escape_string($this->dbLink,$this->user_name) . "',password='" . mysqli_real_escape_string($this->dbLink,$this->password) . "',salt='" . mysqli_real_escape_string($this->dbLink,$this->salt) . "',id_rol='" . mysqli_real_escape_string($this->dbLink,$this->id_rol) . "',email='" . mysqli_real_escape_string($this->dbLink,$this->email) . "'
					WHERE id_login=" . $this->id_login;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLogin_user::Update]");
				
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
				$SQL="DELETE FROM login_user
				WHERE id_login=" . mysqli_real_escape_string($this->dbLink,$this->id_login);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLogin_user::Borrar]");
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
						id_login,id_usuario,user_name,password,salt,id_rol,email
					FROM login_user
					WHERE id_login=" . mysqli_real_escape_string($this->dbLink,$this->id_login);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseLogin_user::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_login==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>