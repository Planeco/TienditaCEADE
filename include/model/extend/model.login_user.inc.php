<?php

	require FOLDER_MODEL_BASE . "model.base.login_user.inc.php";

	class ModeloLogin_user extends ModeloBaseLogin_user
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseLogin_user";

		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}
		
		public function validarUsuario($infoUsuario)
		{
		    $query = "SELECT l.password, l.salt, l.id_usuario, u.nombre, l.id_rol, l.user_name,id_login from login_user as l
                       inner join usuario as u on l.id_usuario=u.id_usuario
                     WHERE email ='" . mysqli_real_escape_string($this->dbLink, $infoUsuario['email']) . "'  LIMIT 1";
		    // die($query);
		    $arrInfoUsuario=array();
		    $result = mysqli_query($this->dbLink, $query);
		    if ($result) {
		        if (mysqli_num_rows($result) == 1) {
		            $row = mysqli_fetch_assoc($result);
		            $password = hash('sha512', $infoUsuario['password'] . $row['salt']);
		            if ($row['password'] == $password) {
		                $arrInfoUsuario['user_name'] = $row['user_nname'];
		                $arrInfoUsuario['id_rol'] = $row['id_rol'];
		                $arrInfoUsuario['id_login'] = $row['id_login'];
		                $arrInfoUsuario['id_usuario'] = $row['id_usuario'];
		                $arrInfoUsuario['nombre'] = $row['nombre'];
		                return array(true,$arrInfoUsuario);
		            } else {
		                // contraseña incorrecta
		                return array(false,'La contrase&ntilde;a ingresada es incorrecta');
		            }
		        } else {
		            // El usuario no existe.
		            return array(false,'El usuario no se encontr&oacute; en el sistema');
		        }
		    } else {
		        // die("[" . $query . "]" . mysqli_error($mysqli));
		        return array(false,$query);
		    }
		}
		

	}

