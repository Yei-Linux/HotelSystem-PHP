<?php

	class ModeloVentasHabitacion{

		static public function mdlSumaTotalVentas(){


			$cn=Conexion::Conectar()->prepare(


				"SELECT SUM(TOTAL) as SUMATOTAL FROM facturacion_pago "


			);


			$cn->execute();

			$dato=$cn->fetch();

			return $dato;

			$cn->close();

			$cn=null;


		}

	}

?>