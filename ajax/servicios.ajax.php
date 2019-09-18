<?php

    require_once '../controladores/servicios.controlador.php';
	
	require_once '../modelos/servicios.modelo.php';

	require_once '../modelos/conexion.modelo.php';


    class AjaxServicio{

        public $idEditarServicio;

        public function EditarServicio(){

            $item="ID_SERVICIO";
            $valor=$this->idEditarServicio;

            $respuesta=ControladorServicio::ctrMostrarServicios($item,$valor);

            echo json_encode($respuesta);

        }

    }


    if(isset($_POST['idEditServ'])){

        $Servicio=new AjaxServicio();

        $Servicio -> idEditarServicio = $_POST['idEditServ'];

        $Servicio -> EditarServicio();

    }

?>