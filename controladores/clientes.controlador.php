<?php 

	class ControladorCliente {

		/*=============================================
					CTR CREAR UN NUEVO CLIENTE
		=============================================*/
		
		static public function ctrAgregarCliente(){

			/*=============================================
				VERIFICAR SI HAY CONTENIDO EN EL FORM
			=============================================*/

				if(isset($_POST["nuevoApPat"])){

					/*=============================================
						COMPARAR CADENAS CON EL PREG_MATCH
					=============================================*/

						if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApPat"]) &&
							preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApMat"]) &&
							preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
					   	   	preg_match('/^[0-9]+$/', $_POST["nuevoDni"]) &&
					       	preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
					       	preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]&&
					       	preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/'		, $_POST["nuevoCorreo"]) 

					   )){

							/*=============================================
										INICALIZAR VARIABLES
							=============================================*/

								$tabla1="persona";
								$tabla2="cliente";

								$datos=array("ap_paterno"=>$_POST["nuevoApPat"],
											 "ap_materno"=>$_POST["nuevoApMat"],
											 "nombre"=>$_POST["nuevoNombre"],
											 "dni"=>$_POST["nuevoDni"],
											 "direccion"=>$_POST["nuevaDireccion"],
											 "telefono"=>$_POST["nuevoTelefono"],
											 "correo"=>$_POST["nuevoCorreo"]);


							/*=============================================
								LLAMO AL MODELO Y TRAIGO LA RESPUESTA
							=============================================*/	

								$respuesta=ModeloCliente::mdlInsertarCliente($tabla1,$tabla2,$datos);

							/*=============================================
								VERIFICAR LA RESPUESTA TRAIDA DEL MODELO
							=============================================*/	

								if($respuesta=="ok"){

									echo'<script>

											swal({

											  	type: "success",
											  	title: "El cliente ha sido guardado correctamente",
											  	showConfirmButton: true,
											  	confirmButtonText: "Cerrar"

											}).then(function(result){

												if (result.value) {

													window.location = "clientes";

												}

											})

										</script>';

								}else{

									echo'<script>

											swal({
												  type: "error",
												  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
												  showConfirmButton: true,
												  confirmButtonText: "Cerrar"

											}).then(function(result){

													if (result.value) {

													window.location = "clientes";

													}
											})

									  	</script>';

								}

						}else{

							echo'<script>

									swal({
										type: "error",
										title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"

									}).then(function(result){

										if (result.value) {

											window.location = "clientes";

										}
									})

							</script>';


						}

				}

		}

		/*=============================================
					CTR MOSTRAR CLIENTES
		=============================================*/

		public static function ctrMostrarCliente($item,$valor){

			/*=============================================
						INICALIZAR VARIABLES
			=============================================*/

				$tabla="cliente";

			/*=============================================
				LLAMO AL MODELO Y TRAIGO LA RESPUESTA
			=============================================*/	

				$respuesta=ModeloCliente::mdlMostrarClientes($tabla,$item,$valor);

			/*=============================================
					RETORNO TODOS LOS REGISTROS
			=============================================*/	

			return $respuesta;

		}

		/*=============================================
					CTR EDITAR UN NUEVO CLIENTE
		=============================================*/

		public static function ctrEditarCliente(){

			if(isset($_POST['idCliente'])){

				if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApPat"]) &&
								preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApMat"]) &&
								preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
						   	   	preg_match('/^[0-9]+$/', $_POST["editarDni"]) &&
						       	preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
						       	preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"]&&
						       	preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/'		, $_POST["editarCorreo"]) 

						   )){

					$tabla1="persona";
					$tabla2="cliente";

					$datos=array("id_cliente"=>$_POST['idCliente'],
								"ap_paterno"=>$_POST["editarApPat"],
								"ap_materno"=>$_POST["editarApMat"],
								"nombre"=>$_POST["editarNombre"],
								"dni"=>$_POST["editarDni"],
								"direccion"=>$_POST["editarDireccion"],
								"telefono"=>$_POST["editarTelefono"],
								"correo"=>$_POST["editarCorreo"]);

					$respuesta=ModeloCliente::mdlEditarCliente($tabla1,$tabla2,$datos);

					if($respuesta=="ok"){

						echo'<script>

								swal({

									 type: "success",
									 title: "El cliente ha sido cambiado correctamente",
									 showConfirmButton: true,
									 confirmButtonText: "Cerrar"

								}).then(function(result){

									if (result.value) {

										window.location = "clientes";

									}
								})

							</script>';

					}else{


						echo '

							<script>

								swal({

									type:"error",
									title:"El cliente no se pudo actualizar correctamente",
									showConfirmButton:true,
									confirmButtonText:"Cerrar"

								}).then(function(result){
									if(result.value){
										
										window.location = "clientes";

									}
								})

							</script>

						';

					}

				}else{

					echo '

						<script>

							swal({

								type:"error",
								title:"¡El cliente no puede ir vacío o llevar caracteres especiales!",
								showConfirmButton:true,
								confirmButtonText:"Cerrar"

							}).then(function(result){
								if(result.value){

									window.location = "clientes";

								}
							})

						</script>

					';

				}

			}
		}

		/*=============================================
					CTR EDITAR UN NUEVO CLIENTE
		=============================================*/

		static public function ctrEliminarCliente(){

			if(isset($_GET["idCliente"]) && isset($_GET["idPersona"])){


				$tabla1="cliente";
				$tabla2="persona";

				$valor1=$_GET["idCliente"];
				$valor2=$_GET["idPersona"];

				$respuesta=ModeloCliente::mdlEliminarCliente($tabla1,$tabla2,$valor1,$valor2);

				if($respuesta=="ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El cliente ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "clientes";

										}
									})

						</script>';


				}else{
					
					echo'<script>

							swal({

								  type: "error",
								  title: "El cliente no ha sido borrado correctamente",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"

							}).then(function(result){

								if (result.value) {

									window.location = "clientes";

								}
							})

						</script>';
				}

			}

		}
	}

?>