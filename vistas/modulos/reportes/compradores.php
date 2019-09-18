<?php

$clientes=ControladorReportes::ctrMostrarClientes();

?>
 
<!--=====================================
VENDEDORES
======================================-->

<div class="box box-primary">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Clientes</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart2" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [

     <?php

        foreach ($clientes as $key => $value) {
            
            echo "{y: '".$value['NOMBRES']."', a: '".$value['TOTAL']."'},";

        }

     ?>

  ],
  barColors: ['#f6a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Compras y Gastos en el Hotel'],
  preUnits: '$',
  hideHover: 'auto'
});

</script>