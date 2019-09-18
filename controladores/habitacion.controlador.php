<?php

	class ControladorHabitacion{

	 	static public function ctrAgregarHabitacion(){

			if(isset($_POST['nuevoNumHabitacion'])){


				$tabla1="habitacion";
				$tabla2="hotel";
				$tabla3="tipo_habitacion";
				$tabla4="estado";

				$ruta="";

				if(isset($_FILES['nuevaFotoHabitacion']['tmp_name'])){

					list($ancho,$alto)=getimagesize($_FILES['nuevaFotoHabitacion']['tmp_name']);

					$nuevoAncho=500;
					$nuevoAlto=500;

					$directorio="vistas/img/habitaciones/".$_POST['nuevoNumHabitacion'];

					mkdir($directorio,0755);

					if($_FILES['nuevaFotoHabitacion']['type']=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/habitaciones/".$_POST['nuevoNumHabitacion']."/".$aleatorio.".jpg";

						$ruta2=$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES['nuevaFotoHabitacion']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagejpeg($destino,$ruta);

					}

					if($_FILES['nuevaFotoHabitacion']['type']=="image/png"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/habitaciones/".$_POST['nuevoNumHabitacion']."/".$aleatorio.".png";

						$ruta2=$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES['nuevaFotoHabitacion']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagepng($destino,$ruta);

					}


				}


				$id_Tipo_Habitacion=0;
				$id_Estado=0;
				$idHotel=$_POST['idHotel'];

				if($_POST['nuevoTipoHabitacion']=="Habitación Individual"){

					$id_Tipo_Habitacion=1;

				}
				if($_POST['nuevoTipoHabitacion']=="Habitación Doble"){

					$id_Tipo_Habitacion=2;

				}
				if($_POST['nuevoTipoHabitacion']=="Habitación Familiar"){

					$id_Tipo_Habitacion=3;

				}
				if($_POST['nuevoTipoHabitacion']=="Suite Individual"){

					$id_Tipo_Habitacion=4;

				}
				if($_POST['nuevoTipoHabitacion']=="Suite Doble"){

					$id_Tipo_Habitacion=5;

				}
				if($_POST['nuevoTipoHabitacion']=="Suite Familiar"){

					$id_Tipo_Habitacion=6;

				}

				if($_POST['nuevoEstado']=="Libre"){

					$id_Estado=1;

				}

				if($_POST['nuevoEstado']=="Ocupada"){

					$id_Estado=2;

				}

				if($_POST['nuevoEstado']=="Limpieza"){

					$id_Estado=3;

				}

				if($_POST['nuevoEstado']=="Mantenimiento"){

					$id_Estado=4;

				}

				$datos=array("foto"=>$ruta,
							 "foto2"=>$ruta2,
							 "numHabitacion"=>$_POST['nuevoNumHabitacion'],
							 "Piso"=>$_POST['nuevoPiso'],
							 "Descripcion"=>$_POST['nuevaDescripcion'],	
							 "Cama"=>$_POST['nuevaCama'],
							 "idTipoHabitacion"=>$id_Tipo_Habitacion,
							 "idHotel"=>$idHotel,
							 "idEstado"=>$id_Estado);

				$respuesta=ModeloHabitacion::mdlAgregarHabitacion($tabla1,$tabla2,$tabla3,$tabla4,$datos);

				if($respuesta=="ok"){

					echo'<script>

											swal({

											  	type: "success",
											  	title: "La habitacion ha sido guardada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "habitacion";

												}

											})

										</script>';

				}else{

					echo'<script>

											swal({

											  	type: "error",
											  	title: "La habitacion no ha sido guardado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "habitacion";

												}

											})

										</script>';


				}

			} 

		}

		static public function ctrMostrarHabitacion($item,$valor,$valor2){

			$tabla1="habitacion";
			$tabla2="tipo_habitacion";
			$tabla3="estado";

			$respuesta=ModeloHabitacion::mdlMostrarHabitacion($tabla1,$tabla2,$tabla3,$item,$valor,$valor2);

			return $respuesta;

		}

		static public function ctrEditarHabitacion(){

			if(isset($_POST['editarNumeroHabitacion'])){

				$tabla1="habitacion";

				$ruta="";

				$directorio_old="vistas/img/habitaciones/".$_POST['editarOldNumeroHabitacion'];

				$directorio_new="vistas/img/habitaciones/".$_POST['editarNumeroHabitacion'];

				rename($directorio_old,$directorio_new);

				if(isset($_FILES['editarFotoHabitacion']['tmp_name']) && !empty($_FILES['editarFotoHabitacion']['tmp_name'])){

					list($ancho,$alto)=getimagesize($_FILES['editarFotoHabitacion']['tmp_name']);

					$nuevoAncho=500;
					$nuevoAlto=500;

					if($_FILES['editarFotoHabitacion']['type']=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/habitaciones/".$_POST['editarNumeroHabitacion']."/".$aleatorio.".jpg";

						$ruta2=$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES['editarFotoHabitacion']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagejpeg($destino,$ruta);

					}

					if($_FILES['editarFotoHabitacion']['type']=="image/png"){

						$aleatorio=mt_rand(100,999);

						$ruta="vistas/img/habitaciones/".$_POST['editarNumeroHabitacion']."/".$aleatorio.".png";

						$ruta2=$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES['editarFotoHabitacion']['tmp_name']);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

						imagepng($destino,$ruta);

					}


				}else{

					$tabla1="habitacion";
					$tabla2="tipo_habitacion";
					$tabla3="estado";

					$item="ID_HABITACION";
					$valor=$_POST['editIdHabitacion'];
					$valor2=null;					

					$respuesta=ModeloHabitacion::mdlMostrarHabitacion($tabla1,$tabla2,$tabla3,$item,$valor,$valor2);

					$ruta="vistas/img/habitaciones/".$_POST['editarNumeroHabitacion']."/".$respuesta['RUTA_FOTO2'];

					$ruta2=$respuesta['RUTA_FOTO2'];

				}

				$id_Tipo_Habitacion=0;
				$id_Estado=0;
				$idHotel=$_POST['idHotel'];

				if($_POST['editarTipoHabitacion']=="Habitación Individual"){

					$id_Tipo_Habitacion=1;

				}
				if($_POST['editarTipoHabitacion']=="Habitación Doble"){

					$id_Tipo_Habitacion=2;

				}
				if($_POST['editarTipoHabitacion']=="Habitación Familiar"){

					$id_Tipo_Habitacion=3;

				}
				if($_POST['editarTipoHabitacion']=="Suite Individual"){

					$id_Tipo_Habitacion=4;

				}
				if($_POST['editarTipoHabitacion']=="Suite Doble"){

					$id_Tipo_Habitacion=5;

				}
				if($_POST['editarTipoHabitacion']=="Suite Familiar"){

					$id_Tipo_Habitacion=6;

				}

				if($_POST['editarEstado']=="Libre"){

					$id_Estado=1;

				}

				if($_POST['editarEstado']=="Ocupada"){

					$id_Estado=2;

				}

				if($_POST['editarEstado']=="Limpieza"){

					$id_Estado=3;

				}

				if($_POST['editarEstado']=="Mantenimiento"){

					$id_Estado=4;

				}



				$datos=array("numeroHabitacion"=>$_POST['editarNumeroHabitacion'],
							 "piso"=>$_POST['editarPiso'],
							 "descripcion"=>$_POST['editarDescripcion'],
							 "camas"=>$_POST["editarCamas"],
							 "tipoHabitacion"=>$id_Tipo_Habitacion,
							 "estado"=>$id_Estado,
							 "foto"=>$ruta,
							 "foto2"=>$ruta2,
							 "hotel"=>$idHotel,
							 "habitacion"=>$_POST['editIdHabitacion']);

				$respuesta=ModeloHabitacion::mdlEditarHabitacion($tabla1,$datos);

				if($respuesta=="ok"){

					echo'<script>

											swal({

											  	type: "success",
											  	title: "La habitacion ha sido editada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "habitacion";

												}

											})

										</script>';

				}else{

					echo'<script>

											swal({

											  	type: "error",
											  	title: "La habitacion no ha sido editada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "habitacion";

												}

											})

										</script>';


				}

			}

		}

		static public function deleteDirectory($dir){

		
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

		static public function ctrEliminarHabitacion(){

			if(isset($_GET['idElimHabitacion'])){

				$item="ID_HABITACION";
				$valor=$_GET['idElimHabitacion'];
				$dir= "vistas/img/habitaciones/" . $_GET['ruta2'];

				self::deleteDirectory($dir);
  
				$respuesta=ModeloHabitacion::mdlEliminarHabitacion($item,$valor);

				if($respuesta=="ok"){

					echo'<script>

											swal({

											  	type: "success",
											  	title: "La habitacion ha sido eliminada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "habitacion";

												}

											})

										</script>';

				}else{

					echo'<script>

											swal({

											  	type: "error",
											  	title: "La habitacion no ha sido eliminada correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "habitacion";

												}

											})

										</script>';


				}

			}

		}

		static public function ctrMostrarUltimoId($valor){

			$respuesta=ModeloHabitacion::mdlModeloHabitacion($valor);

			return $respuesta; 

		}


	}





?>	