<?php

	class ControladorIngreso{
 
		static public function ctrMostrarPisos($item,$valor){

			$tabla1="hotel";

			$respuesta=ModeloIngreso::mdlMostrarIngreso($tabla1,$item,$valor);

			return $respuesta;


		}

		static public function ctrMostrarHabitaciones($item,$valor,$valor2){

			$tabla1="habitacion";
			$tabla2="tipo_habitacion";
			$tabla3="estado";

			$respuesta=ModeloIngreso::mdlMostrarHabitaciones($tabla1,$tabla2,$tabla3,$item,$valor,$valor2);

			return $respuesta;


		}

		static public function ctrMostrarHabitacion($item,$valor){

			$tabla1="habitacion";

			$respuesta=ModeloIngreso::mdlMostrarHabitacion($tabla1,$item,$valor);

			return $respuesta;

		}


		static public function ctrVerificarCliente(){

			$tabla1="persona";
			$tabla2="cliente";

			$respuesta=ModeloIngreso::mdlVerificarCliente($tabla1,$tabla2);

			return $respuesta;

		}

		static public function ctrRegistrarIngreso(){

			if(isset($_POST['idCliente'])){

				$tabla1="hospedaje";
				$tabla2="detalle_hospedaje_hab";

				if(isset($_POST['idReserva'])){

					$valor=$_POST['idReserva'];

				}else{

					$valor=null;

				}

				date_default_timezone_set("America/Lima");

				$fecha=date('Y-m-d');

				$hora=date('H:i:s');

				$fechaActual=$fecha . " " . $hora;

				$fechaFin=$_POST['fechaFin'] . " " .$hora;

				$datos=array("idCliente"=>$_POST['idCliente'],
							 "idEmpleado"=>$_SESSION['id'],
							 "fechaInicio"=>$fechaActual,
							 "fechaFin"=>$fechaFin,
							 "numAdultos"=>$_POST['numAdultos'],
							 "numNinos"=>$_POST['numNinos'],
							 "idHabitacion"=>$_POST['idHabitacion']);	
 
				$respuesta=ModeloIngreso::mdlRegistrarIngreso($tabla1,$tabla2,$datos,$valor);

				if($respuesta=="ok"){

					echo '<script>

								swal({
									type:"success",
									title: "El Ingreso ha sido Registrado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "registroIngreso";
									}

								})
		
							 </script>
						';

				}else{

					echo '<script>

								swal({
									type:"error",
									title: "El Ingreso no ha sido Registrado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "registroIngreso";
									}

								})
		
							 </script>
						';

				}

			}

		}

		static public function ctrMostrarRegistroHospedaje($valor1,$valor2){

			$respuesta=ModeloIngreso::mdlMostrarRegistroHospedaje($valor1,$valor2);

			return $respuesta;



		}

	}
















?>