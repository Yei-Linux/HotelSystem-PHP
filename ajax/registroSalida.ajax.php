<?php

	require_once '../controladores/registroSalida.controlador.php';
  
    require_once '../modelos/registroSalida.modelo.php';

    require_once '../modelos/conexion.modelo.php';

	class AjaxSalida{ 

		public $numero_Piso;

		public $id_hotel;

		public $idHabitacionEst;

		public $estado;

		public $idHospedaje;

		public function MostrarHabitacionesSalidaAjax(){

			$item="PISO";
	        $valor=$this->numero_Piso;
			$valor3=$this->id_hotel;

	        $item2="NOMBRE_ESTADO";
	        $valor2="Ocupada";

	        $respuesta=ControladorSalida::ctrMostrarHabitacionesSalida($item,$valor,$item2,$valor2,$valor3);

	        foreach ($respuesta as $key => $value) {
	                  
	                echo '<div class="tarjetas-hab Salidaestado'.$value['NOMBRE_ESTADO'].'" 
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

		public function MostrarRegistroHospedaje(){

			$valor1=$this->idHabitacionEst;
			$valor2=$this->estado;

			$respuesta=ControladorSalida::ctrMostrarRegistroHospedajeSalida($valor1,$valor2);
 
			echo json_encode($respuesta);


		}

		public function MostrarPagoTienda(){

			$valor=$this->idHospedaje;

			$respuesta=ControladorSalida::ctrMostrarPagoTienda($valor);

			echo json_encode($respuesta);

		}
	}

	if(isset($_REQUEST['numeroPisoSalida'])){

		$RegistroSalida=new AjaxSalida();

		$RegistroSalida -> numero_Piso =$_REQUEST['numeroPisoSalida'];

		$RegistroSalida -> id_hotel =$_REQUEST['idHotel'];

		$RegistroSalida -> MostrarHabitacionesSalidaAjax();

	}

	if(isset($_POST['idHabitacionEst']) && isset($_POST['estadoEst'])){

		$RegistroSalida2=new AjaxSalida();

		$RegistroSalida2 -> idHabitacionEst =$_POST['idHabitacionEst'];

		$RegistroSalida2 -> estado =$_POST['estadoEst'];

		$RegistroSalida2 -> MostrarRegistroHospedaje();

	}

	if(isset($_POST['idHospedaje'])){

		$RegistroSalida=new AjaxSalida();

		$RegistroSalida -> idHospedaje =$_POST['idHospedaje'];

		$RegistroSalida -> MostrarPagoTienda();

	}

?>