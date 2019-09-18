<?php

$ventas=ControladorReportes::ctrMostrarVentas();

?>

<!--=====================================
GRÁFICO DE VENTAS
======================================-->


<div class="box box-solid bg-teal-gradient">
	
	<div class="box-header">
		
 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Gráfico de Ventas</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">

		<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

  </div>

</div>

<script>
	
 var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

        <?php


            foreach ($ventas as $key => $value) {

                if($key!=(sizeof($ventas)-1)){

                    echo "{ y: '".$value['FECHA']."', item1: ".$value['TOTAL']." },";

                }else{

                    echo "{ y: '".$value['FECHA']."', item1: ".$value['TOTAL']." }";

                }

            }


        ?>
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Ventas en ese mes '],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits          : 'S/.',
    gridTextSize     : 10
  });

</script>