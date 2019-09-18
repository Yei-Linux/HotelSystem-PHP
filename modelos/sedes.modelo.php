<?php

	class ModeloSede{

		static public function mdlAgregarSede($tabla1,$tabla2,$datos){

			$cn=Conexion::Conectar()->prepare(

				"INSERT INTO hotel(NOMBRE,PISOS,ID_PROVINCIA) 
				 VALUES(:nombre,:pisos,:id_lugar)"

			);

			$cn->bindParam(":nombre",$datos["sede"],PDO::PARAM_STR);
			$cn->bindParam(":pisos",$datos["pisos"],PDO::PARAM_INT);
			$cn->bindParam(":id_lugar",$datos["lugar"],PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();

			$cn=null;

		}

		static public function mdlMostrarSedes($tabla1,$tabla2,$item,$valor){

			if($item==null){

				$cn=Conexion::Conectar()->prepare(

					"SELECT h.ID_HOTEL,.h.NOMBRE,h.PISOS,p.NOMBRE AS LUGAR FROM 
					hotel h INNER JOIN provincia p 
					ON h.ID_PROVINCIA=p.ID_PROVINCIA"

				);

				$cn->execute();

				$datos=$cn->fetchAll();

				return $datos;

			}else{


				$cn=Conexion::Conectar()->prepare(

					"SELECT h.ID_HOTEL,h.NOMBRE,h.PISOS,p.NOMBRE AS LUGAR FROM 
					hotel h INNER JOIN provincia p 
					ON h.ID_PROVINCIA=p.ID_PROVINCIA WHERE $item=:valor"

				);

				$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

				$cn->execute();

				$dato=$cn->fetch();

				return $dato;

			}

		}

		static public function mdlEditarSede($tabla1,$datos){

			$cn=Conexion::Conectar()->prepare(

				"UPDATE hotel SET NOMBRE=:nombre,PISOS=:piso,ID_PROVINCIA=:id_provincia 
				WHERE ID_HOTEL=:id_hotel"

			);

			$cn->bindParam(":nombre",$datos['sede'],PDO::PARAM_STR);
			$cn->bindParam(":piso",$datos['pisos'],PDO::PARAM_INT);
			$cn->bindParam(":id_provincia",$datos['lugar'],PDO::PARAM_INT);
			$cn->bindParam(":id_hotel",$datos['idSede'],PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";


			}else{

				return "error";

			}

			$cn->close();
			$cn=null;

		}

		static public function mdlEliminarSede($tabla1,$item,$valor){

			$cn=Conexion::Conectar()->prepare(

				"DELETE FROM hotel WHERE ID_HOTEL=:id_hotel"

			);

			$cn->bindParam(":id_hotel",$valor,PDO::PARAM_INT);

			if($cn->execute()){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();
			$cn=null;

		}

	}






?>