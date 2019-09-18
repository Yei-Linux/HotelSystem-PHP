<?php

	require_once '../controladores/tienda.controlador.php';
	
    require_once '../modelos/tienda.modelo.php';

	require_once '../controladores/productos.controlador.php';
	
    require_once '../modelos/productos.modelo.php';

    require_once '../controladores/servicios.controlador.php';
	
    require_once '../modelos/servicios.modelo.php';

    require_once '../modelos/conexion.modelo.php';

	class AjaxTienda{

		public $id_Producto;

		public $id_Servicio;

		public function MostrarDatosProducto(){

			$item="ID_PRODUCTO";
			$valor=$this->id_Producto;

			$respuesta=ControladorProducto::ctrMostrarProductos($item,$valor);

			echo json_encode($respuesta);

		}

		public function MOstrarDatosServicio(){


			$item="ID_SERVICIO";
			$valor=$this->id_Servicio;

			$respuesta=ControladorServicio::ctrMostrarServicios($item,$valor);

			echo json_encode($respuesta);

		}

	}
	
	if(isset($_POST['idProducto'])){


		$Tienda1=new AjaxTienda();

		$Tienda1 -> id_Producto=$_POST['idProducto'];

		$Tienda1 -> MostrarDatosProducto();

	}	

	if(isset($_POST['idServicio'])){


		$Tienda1=new AjaxTienda();

		$Tienda1 -> id_Servicio=$_POST['idServicio'];

		$Tienda1 -> MOstrarDatosServicio();

	}	


?>