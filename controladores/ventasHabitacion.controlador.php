<?php

	class ControladorVentasHabitacion{

		static public function ctrSumaTotalVentas(){

			$respuesta=ModeloVentasHabitacion::mdlSumaTotalVentas();

			return  $respuesta;

		}

	}
	
?>