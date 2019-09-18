<?php


	class ModeloEmpleado{

		static public function mdlAgregarEmpleado($tabla1,$tabla2,$tabla3,$datos){

			$valor1="";
			$valor2="";
			$valor3="";
			$id_hotel=$datos['idHotel'];
			$id_estado=1;

			$cn=Conexion::Conectar()->prepare(
 
				"INSERT INTO persona(APELLIDO_PATERNO,APELLIDO_MATERNO,NOMBRE
					,DNI,DIRECCION,TELEFONO,CORREO) VALUES(:ap_paterno,:ap_materno,
					:nombre,:dni,:direccion,:telefono,:correo) "

			);

			$cn->bindParam(":ap_paterno",$datos["ap_Paterno"],PDO::PARAM_STR);
			$cn->bindParam(":ap_materno",$datos["ap_Materno"],PDO::PARAM_STR);
			$cn->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$cn->bindParam(":dni",$datos["dni"],PDO::PARAM_STR);
			$cn->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
			$cn->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
			$cn->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);

			if($cn->execute()){

				$valor1="ok";

			}else{

				$valor1="error";

			}
			
 
			$cn2=Conexion::Conectar()->prepare(

				"INSERT INTO $tabla2(USARIO,PASS,ID_TIPO_USU) VALUES(:usuario,:pass,:id_tipo_usu)"

			);

			$cn2->bindParam(":usuario",$datos['usuario'],PDO::PARAM_STR);
			$cn2->bindParam(":pass",$datos['password'],PDO::PARAM_STR);
			$cn2->bindParam(":id_tipo_usu",$datos['perfil'],PDO::PARAM_INT);

			if($cn2->execute()){

				$valor2="ok";

			}else{

				$valor2="error";

			}

			$cn3=Conexion::Conectar()->prepare(

				"INSERT INTO $tabla3(ID_PERSONA,ID_HOTEL,ID_USUARIO,FOTO,FOTO2,ESTADO) 
				VALUES((SELECT MAX(ID_PERSONA) FROM persona),:id_hotel,
				(SELECT MAX(ID_USUARIO) FROM usuario),:foto,:foto2,:estado)" 

			);

			$cn3->bindParam(":id_hotel",$id_hotel,PDO::PARAM_INT);
			$cn3->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
			$cn3->bindParam(":foto2",$datos["foto2"],PDO::PARAM_STR);
			$cn3->bindParam(":estado",$id_estado,PDO::PARAM_INT);

			if($cn3->execute()){

				$valor3="ok";

			}else{

				$valor3="error";

			}

			if($valor1=="ok" && $valor2=="ok" && $valor3=="ok"){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();
			$cn=null;
			
			$cn2->close();
			$cn2=null;

			$cn3->close();
			$cn3=null;


		} 

		static public function mdlMostrarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$item,$valor,$valor2){

			if($item==null){

				$datos="";

				if($valor2==null){

					$cn=Conexion::Conectar()->prepare(

					"SELECT u.ID_USUARIO,p.ID_PERSONA,e.ID_EMPLEADO,
					CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) 
					as NOMBRE,e.ID_HOTEL,h.NOMBRE as NOMBRE_HOTEL,p.CORREO,u.USARIO,u.PASS,e.FOTO,t.NOM_TIPO_USU,e.ESTADO,
					e.FECHA FROM persona 
					p INNER JOIN empleado e ON p.ID_PERSONA=e.ID_PERSONA INNER JOIN usuario u 
					ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario t 
					ON u.ID_TIPO_USU=t.ID_TIPO_USU INNER JOIN hotel h ON h.ID_HOTEL=e.ID_HOTEL"
					
					);

					$cn->execute();

					$datos=$cn->fetchAll();

				}else{

					$cn=Conexion::Conectar()->prepare(

						"SELECT u.ID_USUARIO,p.ID_PERSONA,e.ID_EMPLEADO,
						CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) 
						as NOMBRE,e.ID_HOTEL,h.NOMBRE as NOMBRE_HOTEL,p.CORREO,u.USARIO,u.PASS,e.FOTO,t.NOM_TIPO_USU,e.ESTADO,
						e.FECHA FROM persona 
						p INNER JOIN empleado e ON p.ID_PERSONA=e.ID_PERSONA INNER JOIN usuario u 
						ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario t 
						ON u.ID_TIPO_USU=t.ID_TIPO_USU INNER JOIN hotel h ON h.ID_HOTEL=e.ID_HOTEL
						WHERE e.ID_HOTEL=:valor2"
					
					);

					$cn->bindParam(":valor2",$valor2,PDO::PARAM_INT);

					$cn->execute();

					$datos=$cn->fetchAll();

				}

				return $datos;

			}else{

				$cn=Conexion::Conectar()->prepare(

					"SELECT e.ID_EMPLEADO,
					p.APELLIDO_PATERNO,p.APELLIDO_MATERNO,p.NOMBRE,p.DNI,p.DIRECCION,
					p.TELEFONO,p.CORREO,u.PASS,
					u.USARIO,e.FOTO,e.FOTO2,t.NOM_TIPO_USU,e.ESTADO,e.FECHA FROM persona 
					p INNER JOIN empleado e ON p.ID_PERSONA=e.ID_PERSONA INNER JOIN usuario u 
					ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario t 
					ON u.ID_TIPO_USU=t.ID_TIPO_USU WHERE $item=:valor"

				);

				$cn->bindParam(":valor",$valor,PDO::PARAM_STR);

				$cn->execute();

				$dato=$cn->fetch();

				return $dato;

			}

		}

		static public function mdlEditarEmpleado($tabla1,$tabla2,$tabla3,$tabla4,$datos,$item){
			
			if($item==null){

				$cn=Conexion::Conectar()->prepare(

				"UPDATE persona as p INNER JOIN empleado as e ON p.ID_PERSONA=e.ID_PERSONA 
				INNER JOIN usuario as u ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario 
				as tp ON u.ID_TIPO_USU=tp.ID_TIPO_USU SET p.APELLIDO_PATERNO=:ap_paterno,
				p.APELLIDO_MATERNO=:ap_materno,p.NOMBRE=:nombre,p.DNI=:dni,
				p.DIRECCION=:direccion,p.TELEFONO=:telefono,
				p.CORREO=:correo,u.PASS=:pass,u.USARIO=:user,
				e.FOTO=:foto,e.FOTO2=:foto2,u.ID_TIPO_USU=:id_tipo_usu WHERE e.ID_EMPLEADO=:valor"

				);

				$cn->bindParam(":ap_paterno",$datos['ap_Paterno'],PDO::PARAM_STR);
				$cn->bindParam(":ap_materno",$datos['ap_Materno'],PDO::PARAM_STR);
				$cn->bindParam(":nombre",$datos['nombre'],PDO::PARAM_STR);
				$cn->bindParam(":dni",$datos['dni'],PDO::PARAM_STR);
				$cn->bindParam(":direccion",$datos['direccion'],PDO::PARAM_STR);
				$cn->bindParam(":telefono",$datos['telefono'],PDO::PARAM_STR);
				$cn->bindParam(":correo",$datos['correo'],PDO::PARAM_STR);
				$cn->bindParam(":pass",$datos['password'],PDO::PARAM_STR);
				$cn->bindParam(":user",$datos['usuario'],PDO::PARAM_STR);
				$cn->bindParam(":foto",$datos['foto'],PDO::PARAM_STR);
				$cn->bindParam(":foto2",$datos['foto2'],PDO::PARAM_STR);
				$cn->bindParam(":id_tipo_usu",$datos['perfil'],PDO::PARAM_INT);

				$cn->bindParam(":valor",$datos['id_empleado'],PDO::PARAM_INT);

				if($cn->execute()){

					return "ok";

				}else{

					return "error";

				}

				$cn->close();

				$cn=null;

			}else{

				$cn=Conexion::Conectar()->prepare(

					"UPDATE persona as p INNER JOIN empleado as e ON p.ID_PERSONA=e.ID_PERSONA 
					INNER JOIN usuario as u ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario 
					as tp ON u.ID_TIPO_USU=tp.ID_TIPO_USU SET $item =:fecha 
					WHERE e.ID_EMPLEADO=:id_empleado"

				);

				$cn->bindParam(":fecha",$datos['fecha'],PDO::PARAM_STR);
				$cn->bindParam(":id_empleado",$datos['id_empleado'],PDO::PARAM_STR);

				if($cn->execute()){

					return "ok";

				}else{

					return "error";

				}

				$cn->close();
				$cn=null;

			}

		}
 
		static public function mdlVerificarUsuario($tabla1,$tabla2,$tabla3,$tabla4){

			$cn=Conexion::Conectar()->prepare(

				"SELECT u.USARIO FROM persona 
				p INNER JOIN empleado e ON p.ID_PERSONA=e.ID_PERSONA 
				INNER JOIN usuario u 
				ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario t 
				ON u.ID_TIPO_USU=t.ID_TIPO_USU"

			);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;

			$cn->close();
			$cn=null;

		}

		static public function mdlActivarUsuario($tabla1,$tabla2,$tabla3,$tabla4,$item,$valor,$valor2){

			$cn=Conexion::Conectar()->prepare(

				"UPDATE persona as p INNER JOIN empleado as e ON p.ID_PERSONA=e.ID_PERSONA 
				INNER JOIN usuario as u ON e.ID_USUARIO=u.ID_USUARIO INNER JOIN tipo_usuario 
				as tp ON u.ID_TIPO_USU=tp.ID_TIPO_USU SET e.ESTADO=:estado WHERE 
				e.ID_EMPLEADO=:id_empleado"

			);

			$cn->bindParam(":estado",$valor2,PDO::PARAM_INT);

			$cn->bindParam(":id_empleado",$valor,PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";

			}else{

				return "error";
			}

			$cn->close();
			$cn=null;


		}

		static public function mdlEliminarEmpleado($datos,$tabla1,$tabla2,$tabla3){

			$valor1=" ";
			$valor2=" ";
			$valor3=" ";

			$cn=Conexion::Conectar()->prepare(

				"DELETE FROM empleado WHERE ID_EMPLEADO=:id_empleado"

			);

			$cn->bindParam(":id_empleado",$datos['idEmpleado'],PDO::PARAM_STR);

			if($cn->execute()){

				$valor1="ok";

			}else{

				$valor1="error";

			}

			$cn2=Conexion::Conectar()->prepare(

				"DELETE FROM persona WHERE ID_PERSONA=:id_persona"

			);

			$cn2->bindParam(":id_persona",$datos['idPersona'],PDO::PARAM_STR);

			if($cn2->execute()){

				$valor2="ok";

			}else{

				$valor2="error";

			}

			$cn3=Conexion::Conectar()->prepare(

				"DELETE FROM usuario WHERE id_usuario=:id_usuario" 

			);

			$cn3->bindParam(":id_usuario",$datos['idUsuario'],PDO::PARAM_STR);

			if($cn3->execute()){

				$valor3="ok";

			}else{

				$valor3="error";

			}

			if($valor1=="ok" && $valor2=="ok" && $valor3=="ok"){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();
			$cn=null;

			$cn2->close();
			$cn2=null;

			$cn2->close();
			$cn2=null;


		}


	}





?>