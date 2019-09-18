<?php

	Class ControladorTiendaServicio{

		static public function ctrAgregarVentaServicio(){

            if(isset($_POST['seleccionarCliente'])){

                $tabla1="consumo";

                $datos=array("idEmp"=>$_SESSION['id'],
                             "idCliente"=>$_POST['seleccionarCliente'],
                             "listaServicios"=>$_POST['listaServicios'],
                             "nuevoTotalVenta"=>$_POST['nuevoTotalVenta']);

                $respuesta=ModeloTiendaServicio::mdlAgregarVentaServicio($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

                            swal({
                                type: "success",
                                title: "La venta de Servicios ha sido guardada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then((result) => {
                                            if (result.value) {

                                            window.location = "tiendaServicios";

                                            }
                                        })

                            </script>';

                }else{

                    echo'<script>

                            swal({
                                type: "error",
                                title: "La venta de Servicios no ha sido guardada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then((result) => {
                                            if (result.value) {

                                                window.location = "tiendaServicios";

                                            }
                                        })

                            </script>';


                }

            }

        }

	}

?>