<?php

    require_once '../controladores/habitacion.controlador.php';
	
	require_once '../modelos/habitacion.modelo.php';

	require_once '../modelos/conexion.modelo.php';


    class AjaxHabitacion{

        public $id_habitacion;
        public $numHabitacion;
        public $id_hotel;

        public function EditarHabitacion(){

            $item="ID_HABITACION";
            $valor=$this->id_habitacion;
            $valor2=null;


            $respuesta=ControladorHabitacion::ctrMostrarHabitacion($item,$valor,$valor2);

            echo json_encode($respuesta);

        }

        public function MostrarUltimoId(){
 
            $valor=$this->id_hotel;
 
            $respuesta=ControladorHabitacion::ctrMostrarUltimoId($valor);

            echo json_encode($respuesta);

        }

        public function VerificarExistenciaHab(){

            $item=null;

            $valor=null;
            
            $num2habitacion=$this->numHabitacion;

            $flag=false;

            $registros=ControladorHabitacion::ctrMostrarHabitacion($item,$valor,$valor2);

            foreach ($registros as $key => $value) {
                
                if($value['NUMERO_HABITACION']==$num2habitacion){

                    $flag=true;

                }

            }

            if($flag){

                $respuesta="Existe la habitacion";

            }else{

                $respuesta="No existe la habitacion";

            }

            echo json_encode($respuesta);

        }


    }

    if(isset($_POST['idHabitacion'])){


        $Habitacion=new AjaxHabitacion();

        $Habitacion -> id_habitacion=$_POST['idHabitacion'];

        $Habitacion -> EditarHabitacion();

    }

    if(isset($_POST['idHotel'])){

        $Habitacion=new AjaxHabitacion();

        $Habitacion -> id_hotel=$_POST['idHotel'];

        $Habitacion -> MostrarUltimoId();

    }

    if(isset($_POST['numHabitacion'])){

        $Habitacion=new AjaxHabitacion();

        $Habitacion -> numHabitacion= $_POST['numHabitacion'];

        $Habitacion -> VerificarExistenciaHab();

    }

?>