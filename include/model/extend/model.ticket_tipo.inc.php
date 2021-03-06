<?php
require FOLDER_MODEL_BASE . "model.base.ticket_tipo.inc.php";

class ModeloTicket_tipo extends ModeloBaseTicket_tipo
{

    // ------------------------------------------------------------------------------------------------------#
    // ----------------------------------------------Propiedades---------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    var $_nombreClase = "ModeloBaseTicket_tipo";

    var $__ss = array();

    // ------------------------------------------------------------------------------------------------------#
    // --------------------------------------------Inicializacion--------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {}

    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Setter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // -----------------------------------------------Unsetter-----------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Getter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Querys------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Otras-------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    public function validarDatos()
    {
        return true;
    }

    function obtenerTipoTickets()
    {
        $sql = "SELECT id_ttipo,nombre FROM ticket_tipo WHERE id_padre = '0' ORDER BY nombre ASC";
        $res = mysqli_query($this->dbLink, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            $arrCategrias = array();
            while ($row_inf = mysqli_fetch_assoc($res)) {
                $arrCategrias[$row_inf['id_ttipo']] = $row_inf['nombre'];
            }
            return $arrCategrias;
        } else {
            return array("" => "No hay categoriad disponibles");
        }
    }
}

