<?php


	class ControladorSede{

		static public function ctrAgregarSede(){

			if(isset($_POST["nuevoNombreSede"])){


				$id_lugar=0;

				$tabla="hotel";
				$tabla2="provincia";

				if($_POST["nuevoLugarSede"]=="Lima"){
					$id_lugar=1;
				}
				if($_POST["nuevoLugarSede"]=="Arequipa"){
					$id_lugar=2;
				}
				if($_POST["nuevoLugarSede"]=="Huancayo"){
					$id_lugar=3;
				}
				if($_POST["nuevoLugarSede"]=="Cusco"){
					$id_lugar=4;
				}

				$datos=array("sede"=>$_POST["nuevoNombreSede"],
							 "lugar"=>$id_lugar,
							 "pisos"=>$_POST["nuevoPisoSede"]);

				$respuesta=ModeloSede::mdlAgregarSede($tabla1,$tabla2,$datos);

				if($respuesta=="ok"){

					echo '<script>

								swal({
									type:"success",
									title: "La Sede ha sido guardado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "sede";
									}

								})
		
							 </script>
						';

				}else{

					echo '<script>

								swal({
									type:"error",
									title: "La Sede ha no sido guardado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
									
									if(result.value){
										window.location= "sede";
									}

								})
		
							 </script>
						';

				}

			}

		}

		static public function ctrMostrarSedes($item,$valor){

			$tabla1="hotel";
			$tabla2="provincia";

			$respuesta=ModeloSede::mdlMostrarSedes($tabla1,$tabla2,$item,$valor);

			return $respuesta;

		}

		
		static public function ctrEditarSede(){

			if(isset($_POST['editidSede'])){


				$tabla1="hotel";
				$id_lugar=0;

				if($_POST["editLugarSede"]=="Lima"){
					$id_lugar=1;
				}
				if($_POST["editLugarSede"]=="Arequipa"){
					$id_lugar=2;
				}
				if($_POST["editLugarSede"]=="Huancayo"){
					$id_lugar=3;
				}
				if($_POST["editLugarSede"]=="Cusco"){
					$id_lugar=4;
				}

				$datos=array("sede"=>$_POST['editNombreSede'],
							 "pisos"=>$_POST['editPisoSede'],
							 "lugar"=>$id_lugar,
							 "idSede"=>$_POST['editidSede']);

				$respuesta=ModeloSede::mdlEditarSede($tabla1,$datos);

				if($respuesta=="ok"){

					echo '<script>

									swal({
										type:"success",
										title: "La Sede ha sido editada correctamente",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"

									}).then(function(result){
										
										if(result.value){
											window.location= "sede";
										}

									})
			
								 </script>
							';

				}else{


					echo '<script>

									swal({
										type:"error",
										title: "La Sede ha no sido editada correctamente",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"

									}).then(function(result){
										
										if(result.value){
											window.location= "sede";
										}

									})
			
								 </script>
							';

				}


			}
			
		}

		static public function ctrEliminarSede(){

			if(isset($_GET['id_elim_sede'])){

				$tabla1="hotel";

				$item="ID_HOTEL";
				$valor=$_GET['id_elim_sede'];

				$respuesta=ModeloSede::mdlEliminarSede($tabla1,$item,$valor);

				if($respuesta=="ok"){

					echo '<script>

								swal({
									type:"success",
									title: "La Sede ha sido eliminada correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
											
									if(result.value){
										window.location= "sede";
									}

								})
				
						</script>';


				}else{

					echo '<script>

								swal({
									type:"error",
									title: "La Sede no ha sido eliminada correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){
											
									if(result.value){
										window.location= "sede";
									}

								})
				
							</script>';

				}

			}

		}

	}





?>