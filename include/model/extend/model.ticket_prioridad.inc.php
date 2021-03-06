<?php

	require FOLDER_MODEL_BASE . "model.base.ticket_prioridad.inc.php";

	class ModeloTicket_prioridad extends ModeloBaseTicket_prioridad
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseTicket_prioridad";

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
		
		function obtenerPrioridad() {
		$sql = "SELECT id_tprioridad, nombre FROM ticket_prioridad ORDER BY id_tprioridad ASC";
		$res = mysqli_query ( $this->dbLink, $sql );
		if ($res && mysqli_num_rows ( $res ) > 0) {
		    $arr = array ();
		    while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
		        $arr [$row_inf ['id_tprioridad']] = $row_inf ['nombre'];
		    }
		    return $arr;
		} else {
		    return array (
		        ""=>"No hay prioridades disponibles"
		    );
		}

	   }
	}

