<?php

    require_once '../controladores/tipohab.controlador.php';
	
	require_once '../modelos/tipohab.modelo.php';

	require_once '../modelos/conexion.modelo.php';

    class AjaxTipoHabitacion{

        public $id_tipo_habitacion;

        public function EditarTipoHabitacion(){

            $item='ID_TIPO_HABITACION';
            $valor=$this->id_tipo_habitacion;

            $respuesta=ControladorTipoHab::ctrMostrarTipoHab($item,$valor);

            echo json_encode($respuesta);

        }

        public function MostrarTemporadas(){

            $item="DESCUENTO";
           
            $temporadas=ControladorTipoHab::ctrMostrarTemporada($item);

            $respuesta=array();

            foreach ($temporadas as $key => $value) {
                
                $respuesta[($key+1)]=$value['DESCUENTO'];

            }

            echo json_encode($respuesta);

        }



    }

    if(isset($_POST['idTipoHabitacion'])){
        
        $TipoHabitacion=new AjaxTipoHabitacion();

        $TipoHabitacion -> id_tipo_habitacion=$_POST['idTipoHabitacion'];

        $TipoHabitacion -> EditarTipoHabitacion();

    }


    if(isset($_POST['estadoTemporada'])){

         $TipoHabitacion=new AjaxTipoHabitacion();

         $TipoHabitacion -> MostrarTemporadas();

    }












?>