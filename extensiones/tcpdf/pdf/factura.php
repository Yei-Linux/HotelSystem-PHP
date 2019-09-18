<?php

class imprimirFactura{

public $cliente;
public $empleado;
public $fecha;

public $numHab;
public $cantidad;
public $fechaIngreso;
public $totalHab;
public $total;

public $costoAdicional;
public $descuento;
public $pagoTienda;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$valCliente = $this->cliente;
$valEmpleado = $this->empleado;
$valFecha = $this->fecha;

$valNumHab= $this->numHab;
$valcantidad= $this->cantidad;
$valfechaIngreso= $this->fechaIngreso;
$valtotal= $this->total;

$valcostoAdicional=$this->costoAdicional;
$valdescuento=$this->descuento;
$valpagoTienda=$this->pagoTienda;
$valTotalHab=$this->totalHab;

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: 71.759.963-9

					<br>
					Dirección: Calle 44B 92-11

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 300 786 52 49
					
					<br>
					ventas@inventorysystem.com

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>0001</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $valCliente

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $valFecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">
			
				Vendedor: $valEmpleado
			
			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Numero Habitacion</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad Personas</td>
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Fecha Ingreso</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				#$valNumHab
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$valcantidad personas
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$valfechaIngreso
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/.$valTotalHab
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');


// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Costo Adicional:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/.$valcostoAdicional 
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Descuento por Temporada:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/.$valdescuento
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Pago pendiente por Consumo y Servicios:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/.$valpagoTienda 
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/.$valtotal 
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf', 'D');

}

}

$factura = new imprimirFactura();

$factura -> cliente = $_GET["cliente"];
$factura -> empleado = $_GET["empleado"];
$factura -> fecha = $_GET["fecha"];

$factura -> numHab = $_GET["hab"];
$factura -> cantidad = $_GET["cantidad"];
$factura -> fechaIngreso = $_GET["fechaIngreso"];
$factura -> totalHab = $_GET["totalHab"];

$factura -> costoAdicional = $_GET["costoAdicional"];
$factura -> descuento = $_GET["descuento"];
$factura -> pagoTienda = $_GET["pagoTienda"];
$factura -> total = $_GET["total"];

$factura -> traerImpresionFactura();

?> 