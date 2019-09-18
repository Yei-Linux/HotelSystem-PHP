<?php

    class ControladorReserva{

        static public function ctrAgregarReserva(){

            if(isset($_POST['reservaDni'])){

                $tabla1="reserva";

                $estado="Reservado";

                $idEmpleado=$_SESSION['id'];

                $datos=array("idCliente"=>$_POST['reservaidCliente'],
                             "habitacion"=>$_POST['reservaHabitacion'],
                             "numAdultos"=>$_POST['reservaAdultos'],
                             "numNinos"=>$_POST['reservaNinos'],
                             "FechaReg"=>$_POST['reservaFechaReg'],
                             "FechaLleg"=>$_POST['reservaFechaLleg'],
                             "Observaciones"=>$_POST['reservaObservaciones'],
                             "estadoReserva"=>$estado,
                             "idEmpleado"=>$idEmpleado);
                
                $respuesta=ModeloReserva::mdlAgregarReserva($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

											swal({

											  	type: "success",
											  	title: "La reserva ha sido guardada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "registroReserva";

												}

											})

										</script>';

                }else{

                    echo'<script>

											swal({

											  	type: "error",
											  	title: "La reserva no ha sido guardada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "registroReserva";

												}

											})

										</script>';


                }


            }

        } 

        static public function ctrMostrarReservas($item,$valor,$valor2){

            $tabla1="reserva";

            $tabla2="cliente";

            $tabla3="persona";

            $tabla4="empleado"; 

            $tabla5="habitacion"; 

            $respuesta=ModeloReserva::mdlMostrarReservas($tabla1,$tabla2,$tabla3,$tabla4,$tabla5,$item,$valor,$valor2);

            return $respuesta;

        }

        static public function ctrMostrarReservasForIng($item,$valor,$valor2){

            $tabla1="reserva";

            $tabla2="cliente";

            $tabla3="persona";

            $tabla4="empleado"; 

            $tabla5="habitacion"; 

            $respuesta=ModeloReserva::mdlMostrarReservasForIng($tabla1,$tabla2,$tabla3,$tabla4,$tabla5,$item,$valor,$valor2);

            return $respuesta;

        }

        static public function ctrEliminarReserva(){

            if(isset($_GET['idElim_Reserva'])){

                $tabla1="reserva";
                $item="ID_RESERVA";
                $valor=$_GET['idElim_Reserva'];
                $valor2=$_GET['idHab_Reserva'];

                $respuesta=ModeloReserva::mdlEliminarReserva($tabla1,$item,$valor,$valor2);

                if($respuesta=="ok"){

                    echo'<script>

											swal({

											  	type: "success",
											  	title: "La reserva ha sido eliminada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "registroReserva";

												}

											})

										</script>';

                }else{

                    echo'<script>

											swal({

											  	type: "error",
											  	title: "La reserva no ha sido eliminada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "registroReserva";

												}

											})

										</script>';

                }

            }

        }


    }    







?>