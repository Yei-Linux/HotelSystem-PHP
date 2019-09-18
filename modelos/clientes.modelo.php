<?php

	class ModeloCliente{
 
		/*=============================================
						CREAR CLIENTE
		=============================================*/
		
		static public function mdlInsertarCliente($tabla1,$tabla2,$datos){

			$valor="";
			$valor2="";

			/*=============================================
				LLAMO A CONEXION Y PREPARO EL INSERT
			=============================================*/
				
				$cn=Conexion::Conectar()->prepare(

					"INSERT INTO $tabla1(APELLIDO_PATERNO,APELLIDO_MATERNO,NOMBRE
					,DNI,DIRECCION,TELEFONO,CORREO) VALUES(:ap_paterno,:ap_materno,
					:nombre,:dni,:direccion,:telefono,:correo) 
					"

				);

			/*=============================================
				COLOCO LOS PARAMETROS PARA ENVIAR A LA BD
			=============================================*/

				$cn->bindParam(":ap_paterno",$datos["ap_paterno"],PDO::PARAM_STR);
				$cn->bindParam(":ap_materno",$datos["ap_materno"],PDO::PARAM_STR);
				$cn->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
				$cn->bindParam(":dni",$datos["dni"],PDO::PARAM_STR);
				$cn->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
				$cn->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
				$cn->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);
				

			/*=============================================
				SABER SI SE EJECUTO CORRECTAMENTE EL INSERT
								EN LA BD
			=============================================*/

				if($cn->execute()){

					$valor="ok";

				}else{

					$valor="error";

				}

			
			/*=============================================
						CREO UNA SEGUNDA CONEXION 
						PARA INSERTAR A OTRA TABLA
			=============================================*/

			
				$cn2=Conexion::Conectar()->prepare(

						"INSERT INTO cliente(ID_PERSONA) SELECT MAX(ID_PERSONA) FROM persona"

				);

			/*=============================================
				COLOCO LOS PARAMETROS PARA ENVIAR A LA BD
			=============================================*/

				

			/*=============================================
				SABER SI SE EJECUTO CORRECTAMENTE EL INSERT
								EN LA BD
			=============================================*/

				if($cn2->execute()){

					$valor2="ok";

				}else{

					$valor2="error";

				}

			/*=============================================
					SABER SI SE EJECUTO AMBOS INSERT 
							PARA MANDAR EL SWAL
			=============================================*/

				if($valor="ok" && $valor2="ok"){

					return "ok";

				}else{

					return "error";

				}

			/*=============================================
					CIERRO LA PRIMERA CONEXION Y LIMPIO
								MEMORIA
			=============================================*/

				$cn->close();

				$cn=null;

			/*=============================================
					CIERRO LA SEGUNDA CONEXION Y LIMPIO
								MEMORIA
			=============================================*/

				$cn2->close();

				$cn2=null;

		}

		/*=============================================
						MOSTRAR CLIENTE
		=============================================*/

		static public function mdlMostrarClientes($tabla,$item,$valor){

			if($item!=null){

				/*=============================================
					LLAMO A CONEXION Y PREPARO LA CONSULTA
				=============================================*/

					$cn=Conexion::Conectar()->prepare(

						"SELECT p.APELLIDO_PATERNO,p.APELLIDO_MATERNO,p.NOMBRE,
						p.DNI,p.DIRECCION,p.TELEFONO,p.CORREO,c.ID_CLIENTE from 
						persona as p inner join cliente as c on p.ID_PERSONA=c.ID_PERSONA 
						WHERE $item = :valor"

					);

				/*=============================================
					COLOCO LOS PARAMETROS PARA ENVIAR A LA BD
				=============================================*/

					$cn->bindParam(":valor",$valor, PDO::PARAM_STR);

				/*=============================================
						EJECUTO LA CONSULTA PREPARADA
				=============================================*/

					$cn->execute();

				/*=============================================
							RETORNO TODOS LOS REGISTROS 
							 OBTENIDOS DE LA CONSULTA
				=============================================*/



					$datos=$cn->fetch();


				return $datos;


			}else{

				/*=============================================
					LLAMO A CONEXION Y PREPARO LA CONSULTA
				=============================================*/


					$cn=Conexion::Conectar()->prepare(

						"SELECT CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) as NOMBRES,
						p.DNI,p.DIRECCION,p.TELEFONO,p.CORREO,c.ID_CLIENTE,c.ID_PERSONA from persona as p inner join 
						cliente as c on p.ID_PERSONA=c.ID_PERSONA"

					);

				/*=============================================
						EJECUTO LA CONSULTA PREPARADA
				=============================================*/

					$cn->execute();

				/*=============================================
							RETORNO TODOS LOS REGISTROS 
							 OBTENIDOS DE LA CONSULTA
				=============================================*/


				return $cn->fetchAll();

			}

			$cn -> close();

			$cn = null;

			
		}

		/*=============================================
						EDITAR CLIENTE
		=============================================*/

		static public function mdlEditarCliente($tabla1,$tabla2,$datos){


			$cn=Conexion::Conectar()->prepare(

				"UPDATE $tabla1 as p INNER JOIN $tabla2 as c on p.ID_PERSONA=c.ID_PERSONA 
				 SET p.APELLIDO_PATERNO=:ap_paterno,p.APELLIDO_MATERNO=:ap_materno,p.NOMBRE=:nombre,
				 p.DNI=:dni,p.DIRECCION=:direccion,p.TELEFONO=:telefono,p.CORREO=:correo 
				 WHERE ID_CLIENTE=:id"

			);

			$cn->bindParam(":ap_paterno",$datos["ap_paterno"],PDO::PARAM_STR);
			$cn->bindParam(":ap_materno",$datos["ap_materno"],PDO::PARAM_STR);
			$cn->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$cn->bindParam(":dni",$datos["dni"],PDO::PARAM_STR);
			$cn->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
			$cn->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
			$cn->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);

			$cn->bindParam(":id",$datos["id_cliente"],PDO::PARAM_STR);

			if($cn->execute()){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();

			$cn=null;

		}

		/*=============================================
						ELIMINAR CLIENTE
		=============================================*/

		static public function mdlEliminarCliente($tabla1,$tabla2,$valor1,$valor2){

			$resp1="";
			$resp2="";

			$cn=Conexion::Conectar()->prepare(

				"DELETE FROM $tabla1 WHERE ID_CLIENTE=:valor1"

			);

			$cn->bindParam(":valor1",$valor1,PDO::PARAM_STR);

			if($cn->execute()){

				$resp1="ok";

			}else{
				$resp1="error";
			}

			$cn2=Conexion::Conectar()->prepare(

				"DELETE FROM $tabla2 WHERE ID_PERSONA=:valor2"

			);

			$cn2->bindParam(":valor2",$valor2,PDO::PARAM_STR);

			if($cn2->execute()){

				$resp2="ok";

			}else{

				$resp2="error";	

			}

			if($resp1=="ok" && $resp2=="ok"){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();
			$cn=null;

			$cn2->close();
			$cn2=null;

		}

	}

?>