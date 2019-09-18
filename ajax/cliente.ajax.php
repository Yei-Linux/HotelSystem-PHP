<?php

	require_once '../controladores/clientes.controlador.php';
	
	require_once '../modelos/clientes.modelo.php';

	require_once '../modelos/conexion.modelo.php';


	class AjaxCliente{

		public $id_Cliente;

		/*=============================================
						EDITAR CLIENTE
		=============================================*/

			public function ajaxEditarCliente(){

				$item="ID_CLIENTE";
				$valor=$this->id_Cliente;

				$respuesta=ControladorCliente::ctrMostrarCliente($item,$valor);

				echo json_encode($respuesta);

			}

	}

	/*=============================================
						EDITAR CLIENTE
	=============================================*/

		if(isset($_POST['idCliente'])){

			$cliente = new AjaxCliente();

			$cliente-> id_Cliente=$_POST['idCliente'];

			$cliente-> ajaxEditarCliente();

		}

