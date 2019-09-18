<?php

	require_once '../controladores/registroIngreso.controlador.php';
  
    require_once '../modelos/registroIngreso.modelo.php';

    require_once '../modelos/conexion.modelo.php';

	class AjaxIngreso{ 

		public $numero_Piso;

		public $id_hotel;

		public $idHabitacion;

		public $dniCliente;

		public $idHabitacionEst;

		public $estado;

		public function MostrarHabitacionesAjax(){

			$item="PISO";
	        $valor=$this->numero_Piso;
			$valor2=$this->id_hotel;
 
	        $respuesta=ControladorIngreso::ctrMostrarHabitaciones($item,$valor,$valor2);
 
	        foreach ($respuesta as $key => $value) {
	                  
	                echo '<div class="tarjetas-hab estado'.$value['NOMBRE_ESTADO'].'" 
	                	data-toggle="modal" 
	                	data-target="#'.$value['NOMBRE_ESTADO'].'" 
	                	id_Habitacion="'.$value['ID_HABITACION'].'"
	                	estado="'.$value['NOMBRE_ESTADO'].'"> 
	              
	                          <div class="uno '.$value['NOMBRE_ESTADO'].'1" style="display: flex;justify-content: center;align-items: center;">
	                              
	                              <img src="vistas/img/plantilla/hab_logo.png" width="50px">

	                          </div>
	                        
	                          <div class="dos '.$value['NOMBRE_ESTADO'].'2"> 
	                            
	                            <p>'.$value['TIPO_HABITACION'].'</p>
	                            <p>S/.'.$value['PRECIO'].'</p>
	                            <h4>Hab '.$value['NUMERO_HABITACION'].'</h4>

	                          </div>

	                      </div>';

	        }


		}

		public function ObtenerHabitacion(){

			$item="ID_HABITACION";

			$valor=$this->idHabitacion;

			$respuesta=ControladorIngreso::ctrMostrarHabitacion($item,$valor);

			echo json_encode($respuesta);

		}

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

		public function MostrarRegistroHospedaje(){

			$valor1=$this->idHabitacionEst;
			$valor2=$this->estado;

			$respuesta=ControladorIngreso::ctrMostrarRegistroHospedaje($valor1,$valor2);

			echo json_encode($respuesta);


		}

	}

	if(isset($_REQUEST['numeroPiso'])){

		$RegistroIngreso=new AjaxIngreso();

		$RegistroIngreso -> numero_Piso =$_REQUEST['numeroPiso'];
		$RegistroIngreso -> id_hotel =$_REQUEST['idHotel'];

		$RegistroIngreso -> MostrarHabitacionesAjax();

	}

	if (isset($_POST['idHabitacion'])){

		$RegistroIngreso2=new AjaxIngreso();

		$RegistroIngreso2 -> idHabitacion =$_POST['idHabitacion'];

		$RegistroIngreso2 -> ObtenerHabitacion();

	}

	if(isset($_POST['dniCliente'])){

		$RegistroIngreso3=new AjaxIngreso();

		$RegistroIngreso3 -> dniCliente =$_POST['dniCliente'];

		$RegistroIngreso3 -> VerificarExistenciaCliente();


	}
  
	if(isset($_POST['idHabitacionEst']) && isset($_POST['estadoEst'])){

		$RegistroIngreso4=new AjaxIngreso();

		$RegistroIngreso4 -> idHabitacionEst =$_POST['idHabitacionEst'];

		$RegistroIngreso4 -> estado =$_POST['estadoEst'];

		$RegistroIngreso4 -> MostrarRegistroHospedaje();

	}
	

?>