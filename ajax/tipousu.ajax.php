<?php

    require_once '../controladores/tipousu.controlador.php';
	
	require_once '../modelos/tipousu.modelo.php';

	require_once '../modelos/conexion.modelo.php';

    class AjaxTipoUsu{

        public $id_tipo_usu;

        public function EditarTipoUsu(){

            $item="ID_TIPO_USU";
            $valor=$this->id_tipo_usu;

            $respuesta=ControladorTipoUsu::ctrMostarTipoUsu($item,$valor);

            echo json_encode($respuesta);

        }

    }

    if(isset($_POST['idTipoUsu'])){

        $TipoUsu=new AjaxTipoUsu();

        $TipoUsu -> id_tipo_usu=$_POST['idTipoUsu'];

        $TipoUsu -> EditarTipoUsu();

    }

?>