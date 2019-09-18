<?php

	class ControladorReportes{

		static public function ctrMostrarClientes(){

			$respuesta=ModeloReportes::mdlMostrarClientes();

			return $respuesta;

		} 

		static public function ctrMostrarEmpleados(){

			$respuesta=ModeloReportes::mdlMostrarEmpleados();

			return $respuesta;

		}

		static public function ctrMostrarVentas(){

			$respuesta=ModeloReportes::mdlMostrarVentas();

			return $respuesta;

		}

	}

?>