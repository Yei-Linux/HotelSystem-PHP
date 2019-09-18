<?php
	
	/*=============================================
					CONTROLADORES
	=============================================*/

	require_once "controladores/plantilla.controlador.php";
	require_once "controladores/clientes.controlador.php";
	require_once "controladores/empleados.controlador.php";
	require_once "controladores/sedes.controlador.php";
	require_once "controladores/tipousu.controlador.php";
	require_once "controladores/tipohab.controlador.php";
	require_once "controladores/habitacion.controlador.php";
	require_once "controladores/productos.controlador.php";
	require_once "controladores/servicios.controlador.php";
	require_once "controladores/registroIngreso.controlador.php";
	require_once "controladores/registroSalida.controlador.php";
	require_once "controladores/registroReserva.controlador.php";
	require_once "controladores/tienda.controlador.php";
	require_once "controladores/tiendaServicio.controlador.php";
	require_once "controladores/ventasHabitacion.controlador.php";
	require_once "controladores/reportes.controlador.php";

	/*=============================================
						MODELOS
	=============================================*/

	require_once "modelos/conexion.modelo.php";
	require_once "modelos/clientes.modelo.php";
	require_once "modelos/empleados.modelo.php";
	require_once "modelos/sedes.modelo.php";
	require_once "modelos/tipousu.modelo.php";
	require_once "modelos/tipohab.modelo.php";
	require_once "modelos/habitacion.modelo.php";
	require_once "modelos/productos.modelo.php";
	require_once "modelos/servicios.modelo.php";
	require_once "modelos/registroIngreso.modelo.php";
	require_once "modelos/registroSalida.modelo.php";
	require_once "modelos/registroReserva.modelo.php";
	require_once "modelos/tienda.modelo.php";
	require_once "modelos/tiendaServicio.modelo.php";
	require_once "modelos/ventasHabitacion.modelo.php";
	require_once "modelos/reportes.modelo.php";
	
	$plantilla=new ControladorPlantilla();
	$plantilla->ctrPlantilla();

?>