<?php

	class ControladorSalida{


		static public function ctrMostrarPisosSalida($item,$valor){

			$tabla1="hotel";

			$respuesta=ModeloSalida::mdlMostrarSalida($tabla1,$item,$valor);

			return $respuesta;


		}

		static public function ctrMostrarHabitacionesSalida($item,$valor,$item2,$valor2,$valor3){

			$tabla1="habitacion";
			$tabla2="tipo_habitacion";
			$tabla3="estado";

			$respuesta=ModeloSalida::mdlMostrarHabitacionesSalida($tabla1,$tabla2,$tabla3,$item,
																   $valor,$item2,$valor2,$valor3);

			return $respuesta;
 

		}

		static public function ctrMostrarRegistroHospedajeSalida($valor1,$valor2){

			$respuesta=ModeloSalida::mdlMostrarRegistroHospedajeSalida($valor1,$valor2);


			date_default_timezone_set("America/Lima");

			$fecha=date('Y-m-d');

			$hora=date('H:i:s');

			$respuesta['FECHA_SALIDA']=$fecha;

			$respuesta['HORA_SALIDA']=$hora;


			$date1 = new DateTime(substr($respuesta['FECHA_INICIO'],0,10));//MENOR
			$date2 = new DateTime($respuesta['FECHA_SALIDA']);//MAYOR
			$diff = $date1->diff($date2);

			$respuesta['CANTIDAD_DIAS']=($diff->days)+1;

			$date3 = new DateTime($respuesta['FECHA_SALIDA']);//MENOR
			$date4 = new DateTime(substr($respuesta['FECHA_FIN'],0,10));//MAYOR
			$diff2 = $date3->diff($date4);

			if(($diff2->invert)==1){

				$respuesta['COSTO_ADICIONAL']=($diff2->days)*$respuesta['PRECIO'];

				$respuesta['EMOJI_SALIDA']="molesto";

			}else{

				if(($diff2->days)==0){

					$respuesta['EMOJI_SALIDA']="feliz";

				}else{

					$respuesta['EMOJI_SALIDA']="triste";

				}

				$respuesta['COSTO_ADICIONAL']=0;

			}

			return $respuesta;

		}
 
		static public function ctrAnularHabitacion(){

			if(isset($_POST['idHabitacionSalida']) && isset($_POST['fechaSalida'])){

				$estado="Anulada";

				$item1="ID_HABITACION";
				$valor1=$_POST['idHabitacionSalida'];

				$item2="ESTADO_HOSPEDAJE";
				$valor2="Ocupada";

				$datos=array("estado_hospedaje"=>$estado,
				 			 "fechaSalida"=>$_POST['fechaSalida'],
							 "horaSalida"=>$_POST['horaSalida'],
							 "diasHospedaje"=>$_POST['cantDias'],
							 "costoAdicional"=>$_POST['costoAdicional']);

				$respuesta=ModeloSalida::mdlAnularHabitacion($item1,$valor1,$item2,$valor2,$datos);

				if($respuesta=="ok"){

					echo '<script>

								swal({
									type:"success",
									title: "El Hospedaje ha sido anulado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "registroSalida";
									}

								})
		
							 </script>
						';


				}else{

					echo '<script>

								swal({
									type:"error",
									title: "El Hospedaje no ha sido anulado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "registroSalida";
									}

								})
		
							 </script>
						';


				}

			}

		}

		static public function ctrRegistrarSalida(){

			if(isset($_POST['tipoPagoComp'])){

				$tabla1="detalle_hospedaje_hab";
				$tabla2="facturacion_pago";
				$tabla3="pago";

				$id_forma_pago=0;
				$estadoHospedaje="Facturada";

				$valor2="Ocupada";

				if($_POST['tipoPagoComp']=="Efectivo"){

					$id_forma_pago=1;

				}
				if($_POST['tipoPagoComp']=="Deposito Bancario"){

					$id_forma_pago=2;

				}
				if($_POST['tipoPagoComp']=="Tarjeta Credito"){

					$id_forma_pago=3;

				}
				if($_POST['tipoPagoComp']=="Tarjeta Debito"){

					$id_forma_pago=4;

				}

				$datos=array("monto"=>$_POST['montoComp'],
							"fechaPago"=>$_POST['fechaSalidaComp'],
							"idFormaPago"=>$id_forma_pago,
							"observaciones"=>$_POST['observacionesComp'],
							"TipoComprobante"=>$_POST['tipoComp'],
							"comprobanteSerie"=>$_POST['serieComp'],
							"comprobanteNumero"=>$_POST['numeroComp'],
							"totalFacturacion"=>$_POST['totalCompPagar'],
							"horaSalida"=>$_POST['horaSalidaComp'],
							"cantDias"=>$_POST['cantDiasComp'],
							"costoAdicional"=>$_POST['costoAdicionalComp'],
							"estadopHosp"=>$estadoHospedaje,
							"estado"=>$valor2,
							"idHab"=>$_POST['idHabComp'],
						  	"idHosp"=>$_POST['idHospedajeComp']);

				$respuesta=ModeloSalida::mdlRegistrarSalida($tabla1,$tabla2,$tabla3,$datos);

				if($respuesta=="ok"){

					echo '<script>

									swal({
										type:"success",
										title: "El Hospedaje ha sido facturado correctamente",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"

									}).then(function(result){
										
										if(result.value){
											window.location= "registroSalida";
										}

									})
			
								</script>
							';

				}else{

					echo '<script>

									swal({
										type:"error",
										title: "El Hospedaje no ha sido facturado correctamente",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"

									}).then(function(result){
										
										if(result.value){
											window.location= "registroSalida";
										}

									})
			
								</script>
							';

				}

			}

		}

		static public function ctrMostrarPagoTienda($valor){

			$respuesta=ModeloSalida::mdlMostrarPagoTienda($valor);

			return $respuesta;

		}

	}

?>