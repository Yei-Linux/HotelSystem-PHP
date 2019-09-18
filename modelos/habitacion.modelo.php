<?php

	class ModeloHabitacion{

		static public function mdlAgregarHabitacion($tabla1,$tabla2,$tabla3,$tabla4,$datos){

			$cn=Conexion::Conectar()->prepare(

				"INSERT INTO habitacion(FOTO,RUTA_FOTO2,NUMERO_HABITACION,PISO,DESCRIPCION_HAB,PLAZAS,
				ID_TIPO_HABITACION,ID_HOTEL,ID_ESTADO) 
				VALUES(:foto,:foto2,:numero_habitacion,:piso,:descripcion,:plazas,:id_tipo_habitacion,
				:id_hotel,:id_estado);"

			);

			$cn->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
			$cn->bindParam(":foto2",$datos["foto2"],PDO::PARAM_STR);
			$cn->bindParam(":numero_habitacion",$datos["numHabitacion"],PDO::PARAM_INT);
			$cn->bindParam(":piso",$datos["Piso"],PDO::PARAM_INT);
			$cn->bindParam(":descripcion",$datos["Descripcion"],PDO::PARAM_STR);
			$cn->bindParam(":plazas",$datos["Cama"],PDO::PARAM_INT);
			$cn->bindParam(":id_tipo_habitacion",$datos["idTipoHabitacion"],PDO::PARAM_INT);
			$cn->bindParam(":id_hotel",$datos["idHotel"],PDO::PARAM_INT);
			$cn->bindParam(":id_estado",$datos["idEstado"],PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();
 
			$cn=null;

		}

		static public function mdlMostrarHabitacion($tabla1,$tabla2,$tabla3,$item,$valor,$valor2){

			if($item==null){

				$cn=Conexion::Conectar()->prepare(

					"SELECT *  FROM tipo_habitacion as t INNER JOIN 
					habitacion as h ON t.ID_TIPO_HABITACION=h.ID_TIPO_HABITACION 
					INNER JOIN estado as e ON h.ID_ESTADO=e.ID_ESTADO AND h.ID_HOTEL=:valor2"

				);

				$cn->bindParam(":valor2",$valor2,PDO::PARAM_INT);

				$cn->execute();

				$datos=$cn->fetchAll();

				return $datos;

			}else{

				$cn=Conexion::Conectar()->prepare(

					"SELECT *
					FROM tipo_habitacion as t INNER JOIN 
					habitacion as h ON t.ID_TIPO_HABITACION=h.ID_TIPO_HABITACION 
					INNER JOIN estado as e ON h.ID_ESTADO=e.ID_ESTADO 
					WHERE $item=:valor"

				);
				/*
					$cn=Conexion::Conectar()->prepare(

					"SELECT ID_HABITACION,TIPO_HABITACION,DESCRIPCION,PRECIO,FOTO,
					NUMERO_HABITACION,PISO,DESCRIPCION_HAB,PLAZAS,
					NOMBRE_ESTADO
					FROM tipo_habitacion as t INNER JOIN 
					habitacion as h ON t.ID_TIPO_HABITACION=h.ID_TIPO_HABITACION 
					INNER JOIN estado as e ON h.ID_ESTADO=e.ID_ESTADO 
					WHERE $item=:valor"

				);
				
				*/

				$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

				$cn->execute();

				$dato=$cn->fetch();

				return $dato;

			}

			$cn->close();

			$cn=null;

		}

		static public function mdlEditarHabitacion($tabla1,$datos){

			$cn=Conexion::Conectar()->prepare(

				"UPDATE habitacion SET FOTO=:foto,RUTA_FOTO2=:foto2,NUMERO_HABITACION=:numero_habitacion, 
				PISO=:piso,DESCRIPCION_HAB=:descripcion,PLAZAS=:plazas,
				ID_TIPO_HABITACION=:id_tipo_habitacion,
				ID_HOTEL=:id_hotel,ID_ESTADO=:id_estado
				WHERE ID_HABITACION=:id_habitacion"

			);

			$cn->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
			$cn->bindParam(":foto2",$datos["foto2"],PDO::PARAM_STR);
			$cn->bindParam(":numero_habitacion",$datos["numeroHabitacion"],PDO::PARAM_INT);
			$cn->bindParam(":piso",$datos["piso"],PDO::PARAM_INT);
			$cn->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
			$cn->bindParam(":plazas",$datos["camas"],PDO::PARAM_INT);
			$cn->bindParam(":id_tipo_habitacion",$datos["tipoHabitacion"],PDO::PARAM_INT);
			$cn->bindParam(":id_hotel",$datos["hotel"],PDO::PARAM_INT);
			$cn->bindParam(":id_estado",$datos["estado"],PDO::PARAM_INT);

			$cn->bindParam(":id_habitacion",$datos["habitacion"],PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();

			$cn=null;


		}

		static public function mdlEliminarHabitacion($item,$valor){

			$cn=Conexion::Conectar()->prepare(

				"DELETE FROM habitacion WHERE $item=:valor"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";


			}else{

				return "error";

			}

			$cn->close();
			$cn=null;

		}

		static public function mdlModeloHabitacion($valor){

			$cn=Conexion::Conectar()->prepare(

				"SELECT (MAX(NUMERO_HABITACION)+1) as NUM_HABITACION FROM habitacion
				WHERE ID_HOTEL=:valor"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->execute();

			$dato=$cn->fetch();

			return $dato;

			$cn->close();

			$cn=null;

		}


	}




















?>