<?php


    class ControladorProducto{

        static public function ctrAgregarProducto(){

            if(isset($_POST['nuevoProd'])){

                $tabla1="producto";

                $id_categoria=0;

                if($_POST['nuevaCategoria']=="Cereales"){

                    $id_categoria=1;

                }

                if($_POST['nuevaCategoria']=="Gaseosa"){

                    $id_categoria=2;

                }

                if($_POST['nuevaCategoria']=="Snacks"){

                    $id_categoria=3;

                }

                if($_POST['nuevaCategoria']=="Galletas"){

                    $id_categoria=4;

                }

                $ruta="";

				if(isset($_FILES['nuevaFotoProducto']['tmp_name'])){

					list($ancho,$alto)=getimagesize($_FILES['nuevaFotoProducto']['tmp_name']);

					$nuevoAncho=500;
					$nuevoAlto=500;

					$directorio="vistas/img/productos/".$_POST['nuevoProd'];

					mkdir($directorio,0755);

					if($_FILES['nuevaFotoProducto']['type']=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/productos/".$_POST['nuevoProd']."/".$aleatorio.".jpg";

						$ruta2=$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES['nuevaFotoProducto']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagejpeg($destino,$ruta);

					}

					if($_FILES['nuevaFotoProducto']['type']=="image/png"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/productos/".$_POST['nuevoProd']."/".$aleatorio.".png";

						$ruta2=$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES['nuevaFotoProducto']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagepng($destino,$ruta);

					}


				}

                $datos=array("descripcion"=>$_POST['nuevoProd'],
                             "precio"=>$_POST['nuevoPrecioProd'],
                             "foto_producto"=>$ruta,
                             "ruta_fotoproducto2"=>$ruta2,
                             "id_categoria"=>$id_categoria);


                $respuesta=ModeloProducto::mdlAgregarProducto($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

								swal({

									type: "success",
									title: "El producto ha sido guardado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';

                }else{

                    echo'<script>

								swal({

									type: "error",
									title: "El producto no ha sido guardado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';

                }

            }


        } 

        static public function ctrMostrarProductos($item,$valor){

            $tabla1="producto";

            $respuesta=ModeloProducto::mdlMostrarProducto($tabla1,$item,$valor);

            return $respuesta;


        }

        static public function ctrEditarProducto(){

            if(isset($_POST['editProd'])){

                $tabla1="producto";

                $id_categoria=0;

                if($_POST['editCategoria']=="Cereales"){

                    $id_categoria=1;

                }

                if($_POST['editCategoria']=="Bebidas"){

                    $id_categoria=2;

                }

                if($_POST['editCategoria']=="Snacks"){

                    $id_categoria=3;

                }

                if($_POST['editCategoria']=="Galletas"){

                    $id_categoria=4;

                }

                $ruta="";
                $ruta2="";

                $directorio_old="vistas/img/productos/".$_POST['editOldProd'];

				$directorio_new="vistas/img/productos/".$_POST['editProd'];

				rename($directorio_old,$directorio_new);

				if(isset($_FILES['editFotoProducto']['tmp_name']) && !empty($_FILES['editFotoProducto']['tmp_name'])){

					list($ancho,$alto)=getimagesize($_FILES['editFotoProducto']['tmp_name']);

					$nuevoAncho=500;
					$nuevoAlto=500;

					if($_FILES['editFotoProducto']['type']=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/productos/".$_POST['editProd']."/".$aleatorio.".jpg";

						$ruta2=$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES['editFotoProducto']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagejpeg($destino,$ruta);

					}

					if($_FILES['editFotoProducto']['type']=="image/png"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/productos/".$_POST['editProd']."/".$aleatorio.".png";
 
						$ruta2=$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES['editFotoProducto']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagepng($destino,$ruta);

					}
 

				}else{

                    $item="ID_PRODUCTO";
                    $valor=$_POST["editIdProd"];

                    $tabla1="producto";

                    $respuesta=ModeloProducto::mdlMostrarProducto($tabla1,$item,$valor);

					$ruta="vistas/img/productos/".$_POST['editProd']."/".$respuesta['RUTA_FOTOPRODUCTO2'];

					$ruta2=$respuesta['RUTA_FOTOPRODUCTO2'];

                }

                $datos=array("descripcion"=>$_POST['editProd'],
                             "precio"=>$_POST['editPrecioProd'],
                             "foto_producto"=>$ruta,
                             "ruta_fotoproducto2"=>$ruta2,
                             "id_categoria"=>$id_categoria,
                             "idProd"=>$_POST["editIdProd"]);


                $respuesta=ModeloProducto::mdlEditarProducto($tabla1,$datos);

                if($respuesta=="ok"){

                    echo'<script>

								swal({

									type: "success",
									title: "El producto ha sido editado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';

                }else{

                    echo'<script>

								swal({

									type: "error",
									title: "El producto no ha sido editado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';

                }

            }

        }

		static public function ctrVerificarProducto(){

			$tabla1="producto";

			$respuesta=ModeloProducto::mdlVerificarProducto($tabla1);

			return $respuesta;

		}

		static public function deleteDirectoryProd($dir){

		
			if(!$dh = @opendir($dir)) return;

			while (false !== ($current = readdir($dh))) {

				if($current != '.' && $current != '..') {

					echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';

					if (!@unlink($dir.'/'.$current)) {

						deleteDirectory($dir.'/'.$current);

					}

				}       
			}

			closedir($dh);

			@rmdir($dir);

		}

		static public function ctrEliminarProducto(){

			if(isset($_GET['idElimProducto'])){

				$tabla1="producto";
				$item="ID_PRODUCTO";
				$valor=$_GET['idElimProducto'];

				$dir="vistas/img/productos/".$_GET['ruta2'];

				self::deleteDirectoryProd($dir);

				$respuesta=ModeloProducto::mdlEliminarProducto($tabla1,$item,$valor);

				if($respuesta=="ok"){

					 echo'<script>

								swal({

									type: "success",
									title: "El producto ha sido eliminado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';		

				}else{

					 echo'<script>

								swal({

									type: "error",
									title: "El producto no ha sido eliminado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';

				}

			}

		}

		static public function ctrMostrarCategorias(){

			$tabla1="categorias";

			$respuesta=ModeloProducto::mdlMostrarCategorias($tabla1);

			return $respuesta;


		}

		static public function ctrEditarCategorias(){

			if(isset($_POST['putCat1'])){

				$tabla1="categorias";

				$datos=array("cat1"=>$_POST['putCat1'],
							 "cat2"=>$_POST['putCat2'],
							 "cat3"=>$_POST['putCat3'],
							 "cat4"=>$_POST['putCat4']);

				$respuesta=ModeloProducto::mdlEditarCategorias($tabla1,$datos);

				if($respuesta=="ok"){

					echo'<script>

								swal({

									type: "success",
									title: "Las Categorias han sido editadas correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';


				}else{

					echo'<script>

								swal({

									type: "error",
									title: "Las Categorias no han sido editadas correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "productos";

									}

								})

							</script>';


				}


			}

		}
        
    }

?>