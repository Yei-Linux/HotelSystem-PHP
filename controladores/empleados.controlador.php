<?php


	class ControladorEmpleado{

		static public function ctrIngresoEmpleadoalSistema(){

			if(isset($_POST['ingUsuario'])){

				$flag=false;

				$password_encriptada=crypt($_POST['ingPassword'],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla1="persona";
				$tabla2="empleado";
				$tabla3="usuario";
				$tabla4="tipo_usuario";

				$item=null;
				$valor=null;
				$valor2=null;
 
				$respuesta=ModeloEmpleado::mdlMostrarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$item,$valor,$valor2);
 
				foreach ($respuesta as $key => $value) {

					if($_POST['ingUsuario']==$value['USARIO'] 
						&& $password_encriptada==$value['PASS']){

						$datos=array("id"=>$value['ID_EMPLEADO'],
									 "nombres"=>$value['NOMBRE'],	
									 "usuario"=>$value['USARIO'],
									 "foto"=>$value['FOTO'],
									 "perfil"=>$value['NOM_TIPO_USU'],
									 "estado"=>$value['ESTADO'],
									 "correo"=>$value['CORREO'],
									 "idHotel"=>$value['ID_HOTEL'],
									 "nombreHotel"=>$value['NOMBRE_HOTEL']);

						$flag=true;

					}
				}

				if($flag){

					if($datos['estado']==1){



						$_SESSION['id']=$datos['id'];
						$_SESSION['nombres']=$datos['nombres'];
						$_SESSION['usuario']=$datos['usuario'];
						$_SESSION['foto']=$datos['foto'];
						$_SESSION['perfil']=$datos['perfil'];
						$_SESSION['correo']=$datos['correo'];
						$_SESSION['idHotel']=$datos['idHotel'];
						$_SESSION['nombreHotel']=$datos['nombreHotel'];
						$_SESSION['iniciarSesion']="ok";


						/*=============================================
							OBTENIEND LA FECHA AL MOMENTO DE LOGEARSE
							 PARA GUARDARLO EN ULTIMO LOGIN EN LA BD
						=============================================*/

						date_default_timezone_set("America/Lima");

						$fecha=date('Y-m-d');

						$hora=date('H:i:s');

						$fechaActual=$fecha . " " . $hora;

						$item="FECHA";

						$datos2=array("fecha"=>$fechaActual,
									  "id_empleado"=>$datos["id"]);

						$respuesta=ModeloEmpleado::mdlEditarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$datos2,$item);

						if($respuesta=="ok"){

							echo '<script>

									window.location = "inicio";

								</script>';

						}else{

							echo '<script>

									window.location = "salir";

								</script>';

						}

					}else{

						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';

					}

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}

		}

		static public function ctrAgregarEmpleado(){

			if(isset($_POST["nuevoApPatEmp"])){

				if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApPatEmp"]) &&
							preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApMatEmp"]) &&
							preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreEmp"]) &&
					   	   	preg_match('/^[0-9]+$/', $_POST["nuevoDniEmp"]) &&
					       	preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefonoEmp"]) && 
					       	preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccionEmp"]&&
					       	preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/'		, $_POST["nuevoCorreoEmp"]) &&
					       	preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
				   			preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])

				)){

					$ruta="";

					$ruta2="";

					/*=============================================
							VALIDANDO Y CONFIGURANDO LA FOTO
							  PARA GUARDARLA EN UN CARPETA
					=============================================*/

					if(isset($_FILES['nuevaFoto']['tmp_name'])){

						/*=============================================
								OBTENIENDO EL ANCHO Y ALTO DE 
											LA FOTO
						=============================================*/

						list($ancho,$alto)=getimagesize($_FILES['nuevaFoto']['tmp_name']);

						$nuevoAncho=500;
						$nuevoAlto=500;

						/*=============================================
								CREANDO LA CARPETA CON EL NOMMBRE 
										DEL USUARIO
						=============================================*/

						$directorio="vistas/img/usuarios/".$_POST['nuevoUsuario'];

						mkdir($directorio,0755);

						/*=============================================
										CONFIGURAR PARA JPG
						=============================================*/

						if($_FILES['nuevaFoto']['type']=="image/jpeg"){
							
							/*=============================================
									 GENERO UN NUMERO RANDOM Y LO 
									 INSERTO COMO NOMBRE DE LA FOTO	
							=============================================*/

							$aleatorio=mt_rand(100,999);

							$ruta="vistas/img/usuarios/".$_POST['nuevoUsuario']."/".$aleatorio.".jpg";

							$ruta2=$aleatorio.".jpg";

							/*=============================================
										OBTENGO LA IMAGEN FOTO
							=============================================*/

							$origen=imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);

							/*=============================================
										CREO OTRA IMAGEN FOTO CON 
											ESTAS PROPIEDADES
							=============================================*/

							$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

							/*=============================================
									RECORTO LA IMAGEN A LAS NUEVAS 
											PROPORCIONES
							=============================================*/

							imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

							/*=============================================
										EXPORTO LA IMAGEN OBTENIDA A 
											LA RUTA ESPECIFICADA
							=============================================*/

							imagejpeg($destino,$ruta);


						}

						/*=============================================
										CONFIGURAR PARA PNG
						=============================================*/

						if($_FILES['nuevaFoto']['type']=="image/png"){

							/*=============================================
									 GENERO UN NUMERO RANDOM Y LO 
									 INSERTO COMO NOMBRE DE LA FOTO	
							=============================================*/

							$aleatorio=mt_rand(100,999);

							$ruta="vistas/img/usuarios/".$_POST['nuevoUsuario']."/".$aleatorio.".png";

							$ruta2=$aleatorio.".png";

							/*=============================================
										OBTENGO LA IMAGEN FOTO
							=============================================*/

							$origen=imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);

							/*=============================================
										CREO OTRA IMAGEN FOTO CON 
											ESTAS PROPIEDADES
							=============================================*/

							$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

							/*=============================================
									RECORTO LA IMAGEN A LAS NUEVAS 
											PROPORCIONES
							=============================================*/

							imagecopyresized($destino,$origen,0,0,0,0,$nuevoAlto,$nuevoAncho,$ancho,$alto);

							/*=============================================
										EXPORTO LA IMAGEN OBTENIDA A 
											LA RUTA ESPECIFICADA
							=============================================*/

							imagepng($destino,$ruta);
						}

					}

					/*=============================================
								ENCRIPTANDO EL PASSWORD
					=============================================*/

					$password_encriptada=crypt($_POST['nuevoPassword'],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			
					$tabla1="persona";
					$tabla2="usuario";
					$tabla3="empleado";
					$id_tipo_usu=0;

					if($_POST['nuevoPerfil']=="Administrador"){
						$id_tipo_usu=1;
					}

					if($_POST['nuevoPerfil']=="Hotelero"){
						$id_tipo_usu=2;
					}

					if($_POST['nuevoPerfil']=="Vendedor"){
						$id_tipo_usu=3;
					}

					$datos=array("ap_Paterno"=>$_POST['nuevoApPatEmp'],
								 "ap_Materno"=>$_POST['nuevoApMatEmp'],
								 "nombre"=>$_POST['nuevoNombreEmp'],
								 "dni"=>$_POST['nuevoDniEmp'],
								 "direccion"=>$_POST['nuevaDireccionEmp'],
								 "telefono"=>$_POST['nuevoTelefonoEmp'],
								 "correo"=>$_POST['nuevoCorreoEmp'],
								 "usuario"=>$_POST['nuevoUsuario'],
								 "password"=>$password_encriptada,
								 "perfil"=>$id_tipo_usu,
								 "foto"=>$ruta,
								 "foto2"=>$ruta2,
								 "idHotel"=>$_POST['idHotel']
								);

					$respuesta=ModeloEmpleado::mdlAgregarEmpleado($tabla1,$tabla2,$tabla3,$datos);
 

					if($respuesta=="ok"){

						echo '<script>

								swal({
									type:"success",
									title: "El Empleado ha sido guardado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "empleados";
									}

								})
		
							 </script>
						';

					}else{

						echo '<script>

								swal({
									type:"error",
									title: "¡El Empleado no ha sido guardado correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){

										window.location= "empleados";

									}

								})
		
							 </script>
						';

					}
				}else{


					echo '<script>

								swal({
									type:"error",
									title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){

										window.location= "empleados";

									}

								})
		
							 </script>
						';



				}

			}

		}


		static public function ctrMostrarEmpleado($item,$valor,$valor2){


				$tabla1="persona";
				$tabla2="empleado";
				$tabla3="usuario";
				$tabla4="tipo_usuario";

				$respuesta=ModeloEmpleado::mdlMostrarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$item,$valor,$valor2);

				return $respuesta;
			
		}

		static public function deleteDirectoryEmp($dir){

		
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

		static public function ctrEditarEmpleado(){

			if(isset($_POST['idEmpleado'])){

				$ruta="";
				$ruta2="";

				$tabla1="persona";
				$tabla2="empleado";
				$tabla3="usuario";
				$tabla4="tipo_usuario";

				$directorio_old="vistas/img/usuarios/".$_POST['oldUsuario'];

				$directorio_new="vistas/img/usuarios/".$_POST['editUsuario'];

				if(rename($directorio_old,$directorio_new)){

					if(isset($_FILES["editFoto"]["tmp_name"]) && !empty($_FILES["editFoto"]["tmp_name"])){

						list($ancho,$alto)=getimagesize($_FILES['editFoto']['tmp_name']);

						$nuevoAncho=500;
						$nuevoAlto=500;

						if($_FILES['editFoto']['type']=="image/jpeg"){

							$aleatorio=mt_rand(100,999);

							$ruta="vistas/img/usuarios/".$_POST['editUsuario']."/".$aleatorio.".jpg";

							$ruta2=$aleatorio.".jpg";

							$origen=imagecreatefromjpeg($_FILES['editFoto']['tmp_name']);

							$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

							imagecopyresized($destino,$origen,0,0,0,0,$nuevoAlto,$nuevoAncho,$ancho,$alto);

							imagejpeg($destino,$ruta);

						}

						if($_FILES['editFoto']['type']=="image/png"){

							$aleatorio=mt_rand(100,999);

							$ruta="vistas/img/usuarios/".$_POST['editUsuario']."/".$aleatorio.".png";

							$ruta2=$aleatorio.".png";

							$origen=imagecreatefrompng($_FILES['editFoto']['tmp_name']);

							$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

							imagecopyresized($destino,$origen,0,0,0,0,$nuevoAlto,$nuevoAncho,$ancho,$alto);

							imagepng($destino,$ruta);

						}


					}else{

						$tabla1="persona";
						$tabla2="empleado";
						$tabla3="usuario";
						$tabla4="tipo_usuario";

						$item2="ID_EMPLEADO";
						$valor2=$_POST['idEmpleado'];
						$valor3=$_POST['idHotel'];					

						$respuesta=ModeloEmpleado::mdlMostrarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$item2,$valor2,$valor3);

						$ruta="vistas/img/usuarios/".$_POST['editUsuario']."/".$respuesta['FOTO2'];

						$ruta2=$respuesta['FOTO2'];

					}

					if(isset($_POST['editPassword']) && !empty($_POST['editPassword'])){

						$password_encriptada=crypt($_POST['editPassword'],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						$password_encriptada=$_POST['passwordActual'];

					}

					$id_tipo_usu=0;

					if($_POST['editPerfil']=="Administrador"){

						$id_tipo_usu=1;

					}

					if($_POST['editPerfil']=="Hotelero"){

						$id_tipo_usu=2;

					}

					if($_POST['editPerfil']=="Vendedor"){

						$id_tipo_usu=3;

					}

					$datos=array("ap_Paterno"=>$_POST['editApPatEmp'],
								"ap_Materno"=>$_POST['editApMatEmp'],
								"nombre"=>$_POST['editNombreEmp'],
								"dni"=>$_POST['editDniEmp'],
								"direccion"=>$_POST['editDireccionEmp'],
								"telefono"=>$_POST['editTelefonoEmp'],
								"correo"=>$_POST['editCorreoEmp'],
								"usuario"=>$_POST['editUsuario'],
								"password"=>$password_encriptada,
								"perfil"=>$id_tipo_usu,
								"foto"=>$ruta,
								"foto2"=>$ruta2,
								"id_empleado"=>$_POST['idEmpleado']
								);

					$item=null;

					$respuesta=ModeloEmpleado::mdlEditarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$datos,$item);


					if($respuesta=="ok"){

								echo '<script>

										swal({
											type:"success",
											title: "El Empleado ha sido acutalizado correctamente",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){
											
											if(result.value){
												window.location= "empleados";
											}

										})
				
									</script>
								';

					}else{

								echo '<script>

										swal({
											type:"error",
											title: "¡El Empleado no ha sido actualizado correctamente!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){
											
											if(result.value){

												window.location= "empleados";

											}

										})
				
									</script>
								';

					}

					

				}else{


					/*$directorio_old="vistas/img/usuarios/".$_POST['oldUsuario'];

					$directorio="vistas/img/usuarios/".$_POST['editUsuario'];

					mkdir($directorio,0755);

					exec('copy '.$directorio_old.' '.$directorio.' /Y');

					$dir= "vistas/img/usuarios/".$_POST['oldUsuario'];

					self::deleteDirectoryEmp($dir);*/

					echo '<script>

										swal({
											type:"error",
											title: "¡No se pudo renombrar la carpeta correctamente!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){
											
											if(result.value){

												window.location= "empleados";

											}

										})
				
									</script>
					';

				}

			}

		}

		static public function ctrVerificarUsuario(){

			$tabla1="persona";
			$tabla2="empleado";
			$tabla3="usuario";
			$tabla4="tipo_usuario";

			$respuesta=ModeloEmpleado::mdlVerificarUsuario($tabla1,$tabla2,$tabla3,$tabla4);

			return $respuesta;

		}

		static public function ctrActivarUsuario($item,$valor,$valor2){

			$tabla1="persona";
			$tabla2="empleado";
			$tabla3="usuario";
			$tabla4="tipo_usuario";

			$respuesta=ModeloEmpleado::mdlActivarUsuario($tabla1,$tabla2,$tabla3,$tabla4,
														 $item,$valor,$valor2);

			return $respuesta;

		}

		static public function ctrEliminarEmpleado(){

			if(isset($_GET["id_elim_persona"]) && isset($_GET["id_elim_persona"]) 
				&& isset($_GET['id_elim_usuario'])){


				$tabla1="empleado";
				$tabla2="persona";
				$tabla3="usuario";

				$dir= "vistas/img/usuarios/".$_GET['ruta2'];

				self::deleteDirectoryEmp($dir);

				$datos=array("idEmpleado"=>$_GET['id_elim_empleado'],
							 "idPersona"=>$_GET['id_elim_persona'],
							 "idUsuario"=>$_GET['id_elim_usuario']);

				$respuesta=ModeloEmpleado::mdlEliminarEmpleado($datos,$tabla1,$tabla2,$tabla3);

				if($respuesta=="ok"){

					echo '<script>

							swal({
								type:"success",
								title: "El Empleado ha sido eliminado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){
											
								if(result.value){
									window.location= "empleados";
								}

							})
				
						  </script>';

				}else{

					echo '<script>

							swal({
								type:"error",
								title: "¡El Empleado no ha sido eliminado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){
											
								if(result.value){

									window.location= "empleados";

								}

							})
				
						  </script>';

				}

			}

		}

	}

?>