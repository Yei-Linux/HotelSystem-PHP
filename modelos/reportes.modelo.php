<?php

	class ModeloReportes{

		static public function mdlMostrarClientes(){

			$cn=Conexion::Conectar()->prepare(

				"SELECT c.ID_CLIENTE,
				CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) as NOMBRES,
				COUNT(f.ID_PAGO) AS NUMERO_REGISTROS,
				SUM(f.TOTAL) as TOTAL
				FROM facturacion_pago as f INNER JOIN hospedaje as h 
				ON f.ID_HOSPEDAJE=h.ID_HOSPEDAJE 
				INNER JOIN cliente as c ON h.ID_CLIENTE=c.ID_CLIENTE
				INNER JOIN persona as p ON c.ID_PERSONA=p.ID_PERSONA
				GROUP BY(c.ID_CLIENTE) ORDER BY TOTAL DESC LIMIT 5"

			);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;


		}

		static public function mdlMostrarEmpleados(){

			$cn=Conexion::Conectar()->prepare(

				"SELECT e.ID_EMPLEADO,
				CONCAT(p.APELLIDO_PATERNO,' ',p.APELLIDO_MATERNO,' ',p.NOMBRE) as NOMBRES,
				COUNT(f.ID_PAGO) AS NUMERO_REGISTROS
				FROM facturacion_pago as f INNER JOIN hospedaje as h 
				ON f.ID_HOSPEDAJE=h.ID_HOSPEDAJE 
				INNER JOIN empleado as e ON h.ID_EMPLEADO=e.ID_EMPLEADO
				INNER JOIN persona as p ON e.ID_PERSONA=p.ID_PERSONA
				GROUP BY(e.ID_EMPLEADO) ORDER BY NUMERO_REGISTROS DESC LIMIT 5"

			);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;


		}


		static public function mdlMostrarVentas(){

			$cn=Conexion::Conectar()->prepare(

				"SELECT SUBSTRING(det.FECHA_SALIDA,1,7) AS FECHA,
				SUM(fac.TOTAL) as TOTAL 
				FROM facturacion_pago as fac INNER JOIN hospedaje as h 
				ON fac.ID_HOSPEDAJE=h.ID_HOSPEDAJE
				INNER JOIN detalle_hospedaje_hab as det 
				ON h.ID_HOSPEDAJE=det.ID_HOSPEDAJE GROUP BY(FECHA)"

			);

			$cn->execute();

			$datos=$cn->fetchAll();

			return $datos;


		}

	}

?>