<?php

	require_once '../controladores/empleados.controlador.php';
	
	require_once '../modelos/empleados.modelo.php';

	require_once '../modelos/conexion.modelo.php';
 

	class AjaxEmpleado{

		public $id_empleado;
		public $usuario;
		public $id_est_empleado;
		public $est_empleado;
		public $id_hotel;

		public function EditarEmpleado(){

			$item="ID_EMPLEADO";
			$valor=$this->id_empleado;
			$valor2=$this->id_hotel;

			$respuesta=ControladorEmpleado::ctrMostrarEmpleado($item,$valor,$valor2);

			echo json_encode($respuesta);

		}

		public function VerificarExistenciaUser(){

			$item="USARIO";
			$valor=$this->usuario;
			$flag=false;

			$usuarios=ControladorEmpleado::ctrVerificarUsuario();

			foreach ($usuarios as $key => $value) {
				
				if($valor==$value['USARIO']){

					$flag=true;

				}
			}

			if($flag){

				$respuesta="El usuario ya Existe!!";

			}else{

				$respuesta="Usuario disponible";

			}

			echo json_encode($respuesta);

		}

		public function ActivarUsuario(){

			$item="ID_EMPLEADO";
			$valor=$this->id_est_empleado;
			$valor2=$this->est_empleado;

			$respuesta=ControladorEmpleado::ctrActivarUsuario($item,$valor,$valor2);

			echo json_encode($respuesta);

		}

	}

	if(isset($_POST['idEmpleado'])){

		$empleado = new AjaxEmpleado();

		$empleado -> id_empleado=$_POST["idEmpleado"];
		$empleado -> id_hotel=$_POST["idHotel"];

		$empleado -> EditarEmpleado();

	}

	if(isset($_POST['usuario'])){

		$empleado=new AjaxEmpleado();

		$empleado -> usuario =$_POST['usuario'];

		$empleado -> VerificarExistenciaUser();

	}

	if(isset($_POST['id_est_Empleado'])){

		$empleado=new AjaxEmpleado();

		$empleado -> id_est_empleado=$_POST['id_est_Empleado'];
		$empleado -> est_empleado=$_POST['estado'];

		$empleado -> ActivarUsuario();

	}

?>