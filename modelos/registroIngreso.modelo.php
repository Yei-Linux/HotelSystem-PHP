<?php


	class ModeloIngreso{
 
		static public function mdlMostrarIngreso($tabla1,$item,$valor){

			$cn=Conexion::Conectar()->prepare(

				"SELECT * FROM hotel WHERE $item=:valor"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->execute();

			$dato=$cn->fetch();

			return $dato;

		}

		static public function mdlMostrarHabitaciones($tabla1,$tabla2,$tabla3,$item,$valor,$valor2){
 
			$cn=Conexion::Conectar()->prepare(

				"SELECT h.ID_HABITACION,h.PISO,h.NUMERO_HABITACION,
				h.PLAZAS,h.ID_ESTADO,
				e.NOMBRE_ESTADO,t.TIPO_HABITACION,t.PRECIO FROM 
                habitacion as h 
				INNER JOIN tipo_habitacion t 
				ON h.ID_TIPO_HABITACION=t.ID_TIPO_HABITACION 
				INNER JOIN estado e ON h.ID_ESTADO=e.ID_ESTADO 
				WHERE $item=:valor AND ID_HOTEL=:valor2"
 
			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->bindParam(":valor2",$valor2,PDO::PARAM_INT);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;

		}

		static public function mdlMostrarHabitacion($tabla1,$item,$valor){

			$cn=Conexion::Conectar()->prepare(

				"SELECT h.ID_HABITACION,h.NUMERO_HABITACION,h.PISO,h.DESCRIPCION_HAB,h.PLAZAS,h.ID_TIPO_HABITACION,t.TIPO_HABITACION,t.PRECIO ,(h.PLAZAS*2) AS MAX_PERSONAS
				FROM habitacion h INNER JOIN tipo_habitacion t ON h.ID_TIPO_HABITACION=t.ID_TIPO_HABITACION
				 WHERE $item=:valor"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->execute();

			$dato=$cn->fetch();

			return $dato;

		}

		static public function mdlVerificarCliente($tabla1,$tabla2){

			$cn=Conexion::Conectar()->prepare(


				"SELECT * FROM persona p INNER JOIN cliente c 
				ON p.ID_PERSONA=c.ID_PERSONA"

			);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;

		}

		static public function mdlRegistrarIngreso($tabla1,$tabla2,$datos,$valor){

			$estado="Ocupada";
			$estadoReserva="Realizado";

			$valor1=" ";
			$valor2=" ";
			$valor3=" ";
			$valor4=" ";

			$idEstado=2;

			$cn=Conexion::Conectar()->prepare(

				"INSERT INTO hospedaje(ID_EMPLEADO,ID_CLIENTE) VALUES(:id_emp,:id_cliente)"

			);

			$cn->bindParam(":id_emp",$datos["idEmpleado"],PDO::PARAM_INT);
			$cn->bindParam(":id_cliente",$datos['idCliente'],PDO::PARAM_INT);

			if($cn->execute()){

				$valor1="ok";

			}else{

				$valor1="error";

			}

			$cn2=Conexion::Conectar()->prepare(

				"INSERT INTO detalle_hospedaje_hab(ESTADO_HOSPEDAJE,FECHA_INICIO,FECHA_FIN,NUMERO_ADULTOS,
				NUMERO_NINOS,ID_HABITACION,ID_HOSPEDAJE) 
				VALUES(:estado_hosp,:fecha_inicio,:fecha_fin,:numAdultos,:numNinos,:idHab,
				(SELECT (MAX(ID_HOSPEDAJE)) as NUM_HOSPEDAJE FROM hospedaje))"

			);

			$cn2->bindParam(":estado_hosp",$estado,PDO::PARAM_STR);
			$cn2->bindParam(":fecha_inicio",$datos['fechaInicio'],PDO::PARAM_STR);
			$cn2->bindParam(":fecha_fin",$datos['fechaFin'],PDO::PARAM_STR);
			$cn2->bindParam(":numAdultos",$datos['numAdultos'],PDO::PARAM_STR);
			$cn2->bindParam(":numNinos",$datos['numNinos'],PDO::PARAM_STR);
			$cn2->bindParam(":idHab",$datos['idHabitacion'],PDO::PARAM_INT);

			if($cn2->execute()){

				$valor2="ok";

			}else{

				$valor2="error";

			}

			$cn3=Conexion::Conectar()->prepare(


				"UPDATE habitacion SET ID_ESTADO=:id_estado
				WHERE ID_HABITACION=:id_habitacion"

			);

			$cn3->bindParam(":id_estado",$idEstado,PDO::PARAM_INT);
			$cn3->bindParam(":id_habitacion",$datos['idHabitacion'],PDO::PARAM_INT);

			if($cn3->execute()){

				$valor3="ok";

			}else{

				$valor3="error";

			}

			if($valor!=null){

				$cn4=Conexion::Conectar()->prepare(

					"UPDATE reserva SET ESTADO_RESERVA=:valor1 WHERE ID_RESERVA=:valor2"

				);

				$cn4->bindParam(":valor1",$estadoReserva,PDO::PARAM_STR);
				$cn4->bindParam(":valor2",$valor,PDO::PARAM_INT);

				if($cn4->execute()){

					$valor4="ok";

				}else{

					$valor4="error";

				}

			}else{

				$valor4="ok";

			}

			if($valor1=="ok" && $valor2=="ok" && $valor3=="ok" && $valor4=="ok"){

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

			if($valor!=null){

				$cn4->close();
				$cn4=null;

			}

		}	

		static public function mdlMostrarRegistroHospedaje($valor1,$valor2){

			$cn=Conexion::Conectar()->prepare(

				"SELECT hab.NUMERO_HABITACION, hab.PISO,tipo_hab.TIPO_HABITACION,
				hab.PLAZAS,tipo_hab.PRECIO,det_hosp.FECHA_INICIO,
				CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) as NOMBRES,
				p.DNI,det_hosp.FECHA_FIN,det_hosp.NUMERO_ADULTOS,det_hosp.NUMERO_NINOS,
				(hab.PLAZAS*2) as MAX_PERSONAS
				FROM detalle_hospedaje_hab det_hosp INNER JOIN hospedaje h 
				ON det_hosp.ID_HOSPEDAJE=h.ID_HOSPEDAJE 
				INNER JOIN cliente c 
				ON h.ID_CLIENTE=c.ID_CLIENTE
				INNER JOIN persona p ON c.ID_PERSONA=p.ID_PERSONA
				INNER JOIN habitacion hab ON det_hosp.ID_HABITACION=hab.ID_HABITACION
				INNER JOIN tipo_habitacion tipo_hab 
				ON hab.ID_TIPO_HABITACION=tipo_hab.ID_TIPO_HABITACION
				WHERE det_hosp.ID_HABITACION=:valor1 AND det_hosp.ESTADO_HOSPEDAJE=:valor2"

			);

			$cn->bindParam(":valor1",$valor1,PDO::PARAM_INT);
			$cn->bindParam(":valor2",$valor2,PDO::PARAM_STR);

			$cn->execute();

			$dato=$cn->fetch();

			return $dato;

		}

	}

?>