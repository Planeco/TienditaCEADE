<?php

	require FOLDER_MODEL_BASE . "model.base.usuario_grupo.inc.php";

	class ModeloUsuario_grupo extends ModeloBaseUsuario_grupo
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseUsuario_grupo";

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

		function obtenerUsuarioGrupo($tticket) {
		    $sql = "SELECT l.id_login, concat_ws(' ', u.nombre, u.apellidos) as nombre_completo FROM usuario_grupo as ug
                    inner join ticket_tipo as t on ug.idGrupo=t.grupo_atencion
                    inner join usuario as u on ug.idUsuario=u.id_usuario
                    inner join login_user l on u.id_usuario=l.id_usuario 
                    where id_ttipo=$tticket ORDER BY u.nombre ASC";
		    $res = mysqli_query ( $this->dbLink, $sql );
		    if ($res && mysqli_num_rows ( $res ) > 0) {
		        $arr = array ();
		        while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
		            $arr [$row_inf ['id_login']] = $row_inf ['nombre_completo'];
		        }
		        return $arr;
		    } else {
		        return array (
		            ""=>"No existen usuarios"
		        );
		    }
		    
		}

	}

