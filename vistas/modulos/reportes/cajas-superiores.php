<?php

$item = null;
$valor = null;
$valor2=$_SESSION['idHotel'];

$ventas = ControladorVentasHabitacion::ctrSumaTotalVentas();

$clientes = ControladorCliente::ctrMostrarCliente($item,$valor);
$totalClientes = count($clientes);

$empleados = ControladorEmpleado::ctrMostrarEmpleado($item, $valor,$valor2);
$totalEmpleados = count($empleados);

$habitaciones = ControladorHabitacion::ctrMostrarHabitacion($item, $valor,$valor2);
$totalHabitaciones = count($habitaciones);

?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box" style="background: #15cda8;color: white;">
    
    <div class="inner">
      
      <h3>$<?php echo number_format($ventas["SUMATOTAL"],2); ?></h3>

      <p>En Ventas de Habitaciones</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="#" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box" style="background-color: #f9fd50;color:white;">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box" style="background: #85ef47;color: white;">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalEmpleados); ?></h3>

      <p>Empleados</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="productos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box" style="background-color: #ff4057;color: white;">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalHabitaciones); ?></h3>

      <p>Habitaciones</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-cart"></i>
    
    </div>
    
    <a href="productos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>