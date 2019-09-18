<?php

    class ControladorTienda{

        static public function ctrAgregarVenta(){

            if(isset($_POST['seleccionarCliente'])){

                /*=============================================
				    REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos = json_decode($_POST["listaProductos"], true);

				$tablaProductos = "producto";

				foreach ($listaProductos as $key => $value) {

					$item = "STOCK";
					$valor = $value["stock"];
                    $valor2=$value["id"];

					$nuevoStock = ModeloProducto::mdlActualizarProducto($tablaProductos, $item, $valor,$valor2);

				}

                $tabla1="consumo";

                $datos=array("idEmp"=>$_SESSION['id'],
                             "idCliente"=>$_POST['seleccionarCliente'],
                             "listaProductos"=>$_POST['listaProductos'],
                             "nuevoTotalVenta"=>$_POST['nuevoTotalVenta']);

                $respuesta=ModeloTienda::mdlAgregarVenta($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

                            swal({
                                type: "success",
                                title: "La venta ha sido guardada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then((result) => {
                                            if (result.value) {

                                            window.location = "tienda";

                                            }
                                        })

                            </script>';

                }else{

                    echo'<script>

                            swal({
                                type: "error",
                                title: "La venta no ha sido guardada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then((result) => {
                                            if (result.value) {

                                                window.location = "tienda";

                                            }
                                        })

                            </script>';


                }


            }

        }

    }

?>