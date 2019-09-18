<?php

    require_once '../controladores/registroReserva.controlador.php';
	
	require_once '../modelos/registroReserva.modelo.php';

    require_once '../controladores/registroIngreso.controlador.php';
	
	require_once '../modelos/registroIngreso.modelo.php';

	require_once '../modelos/conexion.modelo.php';

    class AjaxReserva{
  
        public $dniCliente;
		public $idReserva;
		public $idHabitacion;
 
        public function VerificarExistenciaCliente(){

			$flag=false;
			$respuesta="";
			$nombres="";
			$idCliente="";

			$item="DNI";
			$valor=$this->dniCliente;

			$clientes=ControladorIngreso::ctrVerificarCliente();

			foreach ($clientes as $key => $value) {

				if($valor==$value['DNI']){

					$flag=true;
					$nombres=$value['APELLIDO_PATERNO'] . ' ' . $value['APELLIDO_MATERNO'] . ' ' . $value['NOMBRE'];

					$idCliente=$value['ID_CLIENTE'];

				}

			}

			if($flag){

				$respuesta=array("nombres"=>$nombres,
								 "idCliente"=>$idCliente);

			}else{

				$respuesta="No existe un cliente con ese DNI!";

			}

			echo json_encode($respuesta);

		}

		public function MostrarDetallesReserva(){

			$item="ID_RESERVA";
			$valor=$this->idReserva;
			$valor2=null;

			$respuesta=ControladorReserva::ctrMostrarReservas($item,$valor,$valor2);

			date_default_timezone_set("America/Lima");

			$fecha=date('Y-m-d');

			$date1 = new DateTime(substr($respuesta['FECHA_LLEGADA'],0,10));//MENOR
			$date2 = new DateTime($fecha);//MAYOR
			$diff = $date1->diff($date2);

			$respuesta['DIFERENCIA_DIAS']=($diff->days)+1;

			echo json_encode($respuesta);

		}

		public function MostrarDetallesReservaForIng(){

			$item="ID_HABITACION";
			$valor=$this->idHabitacion;
			$valor2=null;

			$respuesta=ControladorReserva::ctrMostrarReservasForIng($item,$valor,$valor2);

			date_default_timezone_set("America/Lima");

			$fecha=date('Y-m-d');

			$date1 = new DateTime(substr($respuesta['FECHA_LLEGADA'],0,10));//MENOR
			$date2 = new DateTime($fecha);//MAYOR
			$diff = $date1->diff($date2);

			$respuesta['DIFERENCIA_DIAS']=($diff->days)+1;

			echo json_encode($respuesta);

		}

		

    }


    if(isset($_POST['dniCliente'])){

        $Reserva=new AjaxReserva();

        $Reserva -> dniCliente=$_POST['dniCliente'];

        $Reserva -> VerificarExistenciaCliente();

    }

	if(isset($_POST['idReserva'])){

        $Reserva2=new AjaxReserva();

        $Reserva2 -> idReserva=$_POST['idReserva'];

        $Reserva2 -> MostrarDetallesReserva();

    }

	if(isset($_POST['idReservaIng'])){

        $Reserva3=new AjaxReserva();

        $Reserva3 -> idReserva=$_POST['idReservaIng'];

        $Reserva3 -> MostrarDetallesReserva();

    }

    if(isset($_POST['idHabitacion'])){

        $Reserva3=new AjaxReserva();

        $Reserva3 -> idHabitacion=$_POST['idHabitacion'];

        $Reserva3 -> MostrarDetallesReservaForIng();

    }


?>