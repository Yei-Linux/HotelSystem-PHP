<?php

	require_once '../controladores/sedes.controlador.php';
	
	require_once '../modelos/sedes.modelo.php';

	require_once '../modelos/conexion.modelo.php';


	class AjaxSede{

		public $id_sede;

		public function EditarSede(){

			$item="ID_HOTEL";
			$valor=$this->id_sede;

			$respuesta=ControladorSede::ctrMostrarSedes($item,$valor);

			echo json_encode($respuesta);

		}

	}

	if(isset($_POST['idSede'])){

		$Sede=new AjaxSede();

		$Sede -> id_sede=$_POST['idSede'];

		$Sede -> EditarSede();

	}



?>