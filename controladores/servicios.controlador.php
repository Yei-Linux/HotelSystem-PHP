<?php

    class ControladorServicio{

        static public function ctrAgregarServicio(){

            if(isset($_POST['nuevoNombreServ'])){

                $tabla1="servicio";

                $datos=array("servicio"=>$_POST['nuevoNombreServ'],
                             "descripcion"=>$_POST['nuevaDescripcionServ'],
                             "precio"=>$_POST['nuevoPrecioServ']);

                $respuesta=ModeloServicio::mdlAgregarServicio($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

											swal({

											  	type: "success",
											  	title: "El servicio ha sido guardado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "servicios";

												}

											})

										</script>';

                }else{

                    echo'<script>

											swal({

											  	type: "error",
											  	title: "El servicio no ha sido guardado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "servicios";

												}

											})

										</script>';

                }

            }


        }

        static public function ctrMostrarServicios($item,$valor){

            $respuesta=ModeloServicio::mdlMostrarServicio($item,$valor);

            return $respuesta;

        }

        static public function ctrEditarServicio(){


            if(isset($_POST['editNombreServ'])){

                $tabla1="servicio";

                $datos=array("servicio"=>$_POST['editNombreServ'],
                             "descripcion"=>$_POST['ediDescripcionServ'],
                             "precio"=>$_POST['editPrecioServ'],
                             "idServ"=>$_POST['idEditServicio']);

                $respuesta=ModeloServicio::mdlEditarServicio($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

											swal({

											  	type: "success",
											  	title: "El servicio ha sido editado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "servicios";

												}

											})

										</script>';

                }else{

                    echo'<script>

											swal({

											  	type: "error",
											  	title: "El servicio no ha sido editado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "servicios";

												}

											})

										</script>';

                }

            }


        }

        static public function ctrEliminarServicio(){

            if(isset($_GET['idElimServ'])){

                $tabla1="servicio";
                $item="ID_SERVICIO";
                $valor=$_GET['idElimServ'];

                $respuesta=ModeloServicio::mdlEliminarServicio($tabla1,$item,$valor);

                if($respuesta=="ok"){

                    echo'<script>

											swal({

											  	type: "success",
											  	title: "El servicio ha sido eliminado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "servicios";

												}

											})

										</script>';

                }else{

                    echo'<script>

											swal({

											  	type: "error",
											  	title: "El servicio no ha sido eliminado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "servicios";

												}

											})

										</script>';

                }

            }
        }

    }














?>