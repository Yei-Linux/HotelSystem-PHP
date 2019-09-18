<?php

	class ModeloSalida{

		static public function mdlMostrarSalida($tabla1,$item,$valor){

			$cn=Conexion::Conectar()->prepare(

				"SELECT * FROM hotel WHERE $item=:valor"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->execute();

			$dato=$cn->fetch();

			return $dato;

		}


		static public function mdlMostrarHabitacionesSalida($tabla1,$tabla2,$tabla3,$item,$valor,$item2,$valor2,$valor3){


			$cn=Conexion::Conectar()->prepare(

				"SELECT h.ID_HABITACION,h.PISO,h.NUMERO_HABITACION,h.PLAZAS,h.ID_ESTADO,e.NOMBRE_ESTADO,t.TIPO_HABITACION,t.PRECIO FROM habitacion h INNER JOIN tipo_habitacion t ON h.ID_TIPO_HABITACION=t.ID_TIPO_HABITACION INNER JOIN estado e ON h.ID_ESTADO=e.ID_ESTADO WHERE $item=:valor AND $item2=:valor2 AND ID_HOTEL=:valor3"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->bindParam(":valor2",$valor2,PDO::PARAM_STR);

			$cn->bindParam(":valor3",$valor3,PDO::PARAM_INT);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;

		}

		static public function mdlMostrarRegistroHospedajeSalida($valor1,$valor2){

			$cn=Conexion::Conectar()->prepare(

				"SELECT hab.NUMERO_HABITACION, hab.PISO,tipo_hab.TIPO_HABITACION,
				hab.PLAZAS,tipo_hab.PRECIO,det_hosp.FECHA_INICIO,
				CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) as NOMBRES,
				p.DNI,det_hosp.FECHA_FIN,det_hosp.NUMERO_ADULTOS,det_hosp.NUMERO_NINOS,
				(hab.PLAZAS*2) as MAX_PERSONAS,det_hosp.FECHA_SALIDA,det_hosp.HORA_SALIDA,
                det_hosp.CANTIDAD_DIAS,det_hosp.COSTO_ADICIONAL,det_hosp.EMOJI_SALIDA,
				hab.ID_HABITACION,det_hosp.ID_HOSPEDAJE
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

		static public function mdlAnularHabitacion($item1,$valor1,$item2,$valor2,$datos){

			$valorC1="";
			$valorC2="";

			$idEstado=1;

			$cn=Conexion::Conectar()->prepare(

				"UPDATE detalle_hospedaje_hab 
				 SET ESTADO_HOSPEDAJE=:estadoHospedaje,FECHA_SALIDA=:fechaSalida,
				 HORA_SALIDA=:horaSalida,CANTIDAD_DIAS=:cantDias,COSTO_ADICIONAL=:costoAdicional
				 WHERE $item1=:valor1 AND $item2=:valor2"

			);

			$cn->bindParam(":estadoHospedaje",$datos['estado_hospedaje'],PDO::PARAM_STR);
			$cn->bindParam(":fechaSalida",$datos['fechaSalida'],PDO::PARAM_STR);
			$cn->bindParam(":horaSalida",$datos['horaSalida'],PDO::PARAM_STR);
			$cn->bindParam(":cantDias",$datos['diasHospedaje'],PDO::PARAM_INT);
			$cn->bindParam(":costoAdicional",$datos['costoAdicional'],PDO::PARAM_STR);

			$cn->bindParam(":valor1",$valor1,PDO::PARAM_INT);
			$cn->bindParam(":valor2",$valor2,PDO::PARAM_STR);

			if($cn->execute()){

				$valorC1="ok";

			}else{

				$valorC1="error";

			}

			$cn2=Conexion::Conectar()->prepare(

				"UPDATE habitacion SET ID_ESTADO=:idEstado
				WHERE ID_HABITACION=:idHabitacion"

			);

			$cn2->bindParam(":idEstado",$idEstado,PDO::PARAM_INT);
			$cn2->bindParam(":idHabitacion",$valor1,PDO::PARAM_INT);

			if($cn2->execute()){

				$valorC2="ok";

			}else{

				$valorC2="error";

			}

			if($valorC1=="ok" && $valorC2=="ok"){

				return "ok";

			}else{

				return "error";

			}

			$cn->close();
			$cn=null;

			$cn2->close();
			$cn2=null;

		}

		static public function mdlRegistrarSalida($tabla1,$tabla2,$tabla3,$datos){

			$valor1="";
			$valor2="";
			$valor3="";
			$valor4="";

			$idEstado=1;

			$cn=Conexion::Conectar()->prepare(

				"INSERT INTO pago(MONTO,FECHA,ID_FORMA_PAGO) VALUES(:monto,:fecha,:idFormPago)"

			);

			$cn->bindParam(":monto",$datos['monto'],PDO::PARAM_STR);
			$cn->bindParam(":fecha",$datos['fechaPago'],PDO::PARAM_STR);
			$cn->bindParam(":idFormPago",$datos['idFormaPago'],PDO::PARAM_INT);

			if($cn->execute()){

				$valor1="ok";

			}else{

				$valor1="error";

			}

			$cn2=Conexion::Conectar()->prepare(

				"INSERT INTO facturacion_pago(OBSERVACIONES,TIPO_COMPROBANTE,COMPROBANTE_SERIE,
				 COMPROBANTE_NUMERO,TOTAL,ID_HOSPEDAJE,ID_PAGO)  
				 VALUES(:observaciones,:tipo_comprobante,:compSerie,:compNumero,:total,
				 :idHosp,(SELECT (MAX(ID_PAGO)) as ID_PAGO FROM pago))"

			);

			$cn2->bindParam(":observaciones",$datos['observaciones'],PDO::PARAM_STR);
			$cn2->bindParam(":tipo_comprobante",$datos['TipoComprobante'],PDO::PARAM_STR);
			$cn2->bindParam(":compSerie",$datos['comprobanteSerie'],PDO::PARAM_STR);
			$cn2->bindParam(":compNumero",$datos['comprobanteNumero'],PDO::PARAM_STR);
			$cn2->bindParam(":total",$datos['totalFacturacion'],PDO::PARAM_STR);
			$cn2->bindParam(":idHosp",$datos['idHosp'],PDO::PARAM_INT);

			if($cn2->execute()){

				$valor2="ok";

			}else{

				$valor2="error";

			}

			$cn3=Conexion::Conectar()->prepare(

				"UPDATE detalle_hospedaje_hab 
				 SET ESTADO_HOSPEDAJE=:estadoHospedaje,FECHA_SALIDA=:fechaSalida,
				 HORA_SALIDA=:horaSalida,CANTIDAD_DIAS=:cantDias,COSTO_ADICIONAL=:costoAdicional
				 WHERE ID_HABITACION=:valor1 AND ESTADO_HOSPEDAJE=:valor2"

			);

			$cn3->bindParam(":estadoHospedaje",$datos['estadopHosp'],PDO::PARAM_STR);
			$cn3->bindParam(":fechaSalida",$datos['fechaPago'],PDO::PARAM_STR);
			$cn3->bindParam(":horaSalida",$datos['horaSalida'],PDO::PARAM_STR);
			$cn3->bindParam(":cantDias",$datos['cantDias'],PDO::PARAM_INT);
			$cn3->bindParam(":costoAdicional",$datos['costoAdicional'],PDO::PARAM_STR);

			$cn3->bindParam(":valor1",$datos['idHab'],PDO::PARAM_INT);
			$cn3->bindParam(":valor2",$datos['estado'],PDO::PARAM_STR);

			if($cn3->execute()){

				$valor3="ok";

			}else{

				$valor3="error";
			}

			$cn4=Conexion::Conectar()->prepare(

				"UPDATE habitacion SET ID_ESTADO=:idEstado
				WHERE ID_HABITACION=:idHabitacion"

			);

			$cn4->bindParam(":idEstado",$idEstado,PDO::PARAM_INT);
			$cn4->bindParam(":idHabitacion",$datos['idHab'],PDO::PARAM_INT);

			if($cn4->execute()){

				$valor4="ok";

			}else{

				$valor4="error";

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

			$cn4->close();
			$cn4=null;

		}
 
		static public function mdlMostrarPagoTienda($valor){

			$cn=Conexion::Conectar()->prepare(

				"SELECT c.SUBTOTAL FROM hospedaje as h 
				INNER JOIN detalle_hospedaje_hab as det 
				ON h.ID_HOSPEDAJE=det.ID_HOSPEDAJE INNER JOIN consumo as c
				ON det.ID_DETALLE_HOSPEDAJE_HAB=c.ID_DETALLE_HOSPEDAJE_HAB
				 WHERE h.ID_HOSPEDAJE=:valor"

			);

			$cn->bindParam(":valor",$valor,PDO::PARAM_INT);

			$cn->execute();

			$dato=$cn->fetch();

			$cn2=Conexion::Conectar()->prepare(

				"SELECT s.SUBTOTAL FROM hospedaje as h 
				INNER JOIN detalle_hospedaje_hab as det 
				ON h.ID_HOSPEDAJE=det.ID_HOSPEDAJE 
				INNER JOIN detalle_servicio as s
				ON det.ID_DETALLE_HOSPEDAJE_HAB=s.ID_DETALLE_HOSPEDAJE_HAB 
				WHERE h.ID_HOSPEDAJE=:valor2"

			);

			$cn2->bindParam(":valor2",$valor,PDO::PARAM_INT);

			$cn2->execute();

			$dato2=$cn2->fetch();

			$dato3=((double)$dato['SUBTOTAL'])+((double)$dato2['SUBTOTAL']);

			return $dato3;

		}

	}

?>