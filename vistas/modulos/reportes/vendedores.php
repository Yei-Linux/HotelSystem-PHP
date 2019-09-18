<?php

$empleados=ControladorReportes::ctrMostrarEmpleados();

?>

 
<!--=====================================
VENDEDORES
======================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Empleados</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

     <?php

        foreach ($empleados as $key => $value) {
            
            echo "{y: '".$value['NOMBRES']."', a: '".$value['NUMERO_REGISTROS']."'},";

        }

     ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['# de Ventas en registro de Habitacion'],
  preUnits: '',
  hideHover: 'auto'
});


</script>