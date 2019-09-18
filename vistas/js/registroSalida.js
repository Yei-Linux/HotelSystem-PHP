$("#lista_pisos").on("click",".item_piso_Salida",function(){

	$('.item_piso_Salida').css("background-color","#defcfc");
	$('.item_piso_Salida').css("color","gray");
	$('.item_piso_Salida').css("border-bottom","3px solid #d2d6de");

	var numPisoSalida=$(this).attr("numPiso");
	var idHotel=$(this).attr('idHotel');

	$(this).css("background-color","white");
	$(this).css("color","gray");
	$(this).css("border-bottom","3px solid white");

	$("#contenedor_habitaciones").load("ajax/registroSalida.ajax.php",{numeroPisoSalida:numPisoSalida,idHotel:idHotel});

})


$('#contenedor_habitaciones').on('click','.SalidaestadoOcupada',function(){

	var idHabitacion=$(this).attr('id_Habitacion');

	var estado=$(this).attr('estado');

	var datos=new FormData();

	datos.append('idHabitacionEst',idHabitacion);
	datos.append('estadoEst',estado);

	$.ajax({

		url:"ajax/registroSalida.ajax.php",
		method:'post',
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',
 
		success : function (respuesta){

			$("#SalidaocupadanumHab").val(respuesta['NUMERO_HABITACION']);
			$("#SalidaocupadanumPiso").val(respuesta['PISO']);
			$("#SalidaocupadatipoHab").val(respuesta['TIPO_HABITACION']);
			$("#SalidaocupadanumCamas").val(respuesta['PLAZAS']);
			$("#SalidaocupadaPrecio").val(respuesta['PRECIO']);
			$("#SalidaocupadaMax").val(respuesta['MAX_PERSONAS']);

			$("#idHabitacionSalida").val(respuesta['ID_HABITACION']);

			$("#SalidaocupadaDatosClienteIng").val(respuesta['NOMBRES'] + " / " +respuesta['DNI']);
			$("#SalidaocupadafechaInicio").val("Fecha Ingreso : "+respuesta['FECHA_INICIO']);
			$("#SalidaocupadafechaFin").val("Fecha Salida : "+respuesta['FECHA_FIN']);
			$("#SalidaocupadanumAdultos").val(respuesta['NUMERO_ADULTOS']+" Adulto(s)");
			$("#SalidaocupadanumNinos").val(respuesta['NUMERO_NINOS']+" Niño(s)");

			$(".fechaSalida").val(respuesta['FECHA_SALIDA']);
			$(".horaSalida").val(respuesta['HORA_SALIDA']);
			$(".cantDias").val(respuesta['CANTIDAD_DIAS']);
			$(".costoAdicional").val(respuesta['COSTO_ADICIONAL']);

			$("#imagenSalida").attr('src','vistas/img/plantilla/'+respuesta['EMOJI_SALIDA']+'.png');

			$(".btnGenerarComprobante").attr("nombres",respuesta['NOMBRES'] + " / " +respuesta['DNI']);

			$(".btnGenerarComprobante").attr("fechaSalida",respuesta['FECHA_SALIDA']);

			$(".btnGenerarComprobante").attr("numHab",respuesta['NUMERO_HABITACION']);

			$(".btnGenerarComprobante").attr("fechaInicio",respuesta['FECHA_INICIO']);

			$(".btnGenerarComprobante").attr("numAdul",respuesta['NUMERO_ADULTOS']);

			$(".btnGenerarComprobante").attr("numNinos",respuesta['NUMERO_NINOS']);

			$(".btnGenerarComprobante").attr("horaSalida",respuesta['HORA_SALIDA']);

			$(".btnGenerarComprobante").attr("precioHab",respuesta['PRECIO']);

			$(".btnGenerarComprobante").attr("cantAd",respuesta['COSTO_ADICIONAL']);

			$(".btnGenerarComprobante").attr("idHab",respuesta['ID_HABITACION']);

			$(".btnGenerarComprobante").attr("cantDias",respuesta['CANTIDAD_DIAS']);

			$(".btnGenerarComprobante").attr("idHosp",respuesta['ID_HOSPEDAJE']);

		},

		error : function (error) {

			console.log(error);

		}

	})

})

$(".pie").on('click','.btnGenerarComprobante',function(){

	var nombres=$(this).attr('nombres');

	var fechaVenta=$(this).attr('fechaSalida');

	var horaVenta=$(this).attr('horaSalida');

	var numHab=$(this).attr('numHab');

	var fechaInicio=$(this).attr('fechaInicio');

	var numAdul=$(this).attr('numAdul');

	var numNinos=$(this).attr('numNinos');

	var precioHab=$(this).attr('precioHab');

	var cantAd=$(this).attr('cantAd');

	var idHabComp=$(this).attr('idHab');
 
	var cantDias=$(this).attr('cantDias');

	var idHospedaje=$(this).attr('idHosp');

	var descuentoPrecio=parseFloat(parseFloat((parseFloat($("#desHide").val())) / parseFloat(100)))*parseFloat(precioHab);

	var dato=new FormData();

	dato.append('idHospedaje',idHospedaje);

	$(".btnGenerarFactura").attr('nombres',nombres);
	$(".btnGenerarFactura").attr('fechaSalida',fechaVenta);
	$(".btnGenerarFactura").attr('horaSalida',horaVenta);
	$(".btnGenerarFactura").attr('fechaInicio',fechaInicio);
	$(".btnGenerarFactura").attr('numHab',numHab);
	$(".btnGenerarFactura").attr('cantAd',cantAd);
	$(".btnGenerarFactura").attr('cantDias',cantDias);
	$(".btnGenerarFactura").attr('precioHab',precioHab);
	$(".btnGenerarFactura").attr('cantPersonas',(parseInt(numAdul)+parseInt(numNinos)));

	//COLOCANDO VALOR AL PAGO EN TIENDA

	$.ajax({

		url:"ajax/registroSalida.ajax.php",
		method:'post',
		data:dato,
		cache:false,
		processData:false,
		contentType:false,
		dataType:'json',

		success: function (respuesta){

			console.log(idHospedaje);

			console.log(respuesta);

			$('#precioTiendaComp').html(respuesta);
			$('#totalPrecioTiendaComp').html(respuesta);

			$("#compNombres").val(nombres);

			$("#compFechaVenta").val(fechaVenta);


			$("#descripcionHabComp").html("Alquiler Habitacion: N°" + numHab+ " desde " +fechaInicio+ " hasta "+fechaVenta+" "+horaVenta+" /Adultos : "+numAdul+" /Niños : "+numNinos);

			$("#precioHabComp").html(parseFloat(precioHab)*parseInt(cantDias));

			$("#cantHabComp").html(parseInt(numAdul)+parseInt(numNinos));

			$("#totalHabComp").html((parseFloat(precioHab)*parseInt(cantDias))*(parseInt(numAdul)+parseInt(numNinos)));



			$("#precioAdicionalComp").html(parseFloat(cantAd));

			$("#totalPrecioAdComp").html(parseFloat(cantAd));



			$("#descuentoComp").html(parseFloat(descuentoPrecio)*parseInt(cantDias));

			$("#cantDescComp").html(parseInt(numAdul)+parseInt(numNinos));

			$("#totalDescComp").html((parseFloat(descuentoPrecio)*parseInt(cantDias))*(parseInt(numAdul)+parseInt(numNinos)));


			$("#totalCobrarComp").val((parseFloat($("#totalHabComp").html())+parseFloat($("#totalPrecioAdComp").html())+parseFloat($("#precioTiendaComp").html()))-parseFloat($("#totalDescComp").html()));


			//COLOCANDO VALORES A LOS INPUT HIDDEN


			$("#montoComp").val($("#totalHabComp").html());

			$("#idHabComp").val(idHabComp);

			$("#cantDiasComp").val(cantDias);

			$("#horaSalidaComp").val(horaVenta);

			$("#costoAdicionalComp").val(cantAd);

			$("#fechaSalidaComp").val(fechaVenta);

			$("#idHospedajeComp").val(idHospedaje);

			$("#totalCompPagar").val((parseFloat($("#totalHabComp").html())+parseFloat($("#totalPrecioAdComp").html())+parseFloat($("#precioTiendaComp").html()))-parseFloat($("#totalDescComp").html()));

		},

		error : function (error) {
			
			console.log(error);

		}

	})

})



$(".pie_Factura").on("click",".btnGenerarFactura",function(){

	var cliente=$(this).attr('nombres');
	var empleado=$(this).attr('empleado');
	var fecha=$(this).attr('fechaSalida');

	var numHabitacion=$(this).attr('numHab');
	var cantidad=$(this).attr('cantPersonas');
	var fechaIngreso=$(this).attr('fechaInicio');
	var totalHab=$('#totalHabComp').html();

	var costoAdicional=$("#precioAdicionalComp").html();
	var descuento=$("#totalDescComp").html();
	var pagoTienda=$("#totalPrecioTiendaComp").html();
	var total=$('#totalCobrarComp').val();

	window.open('extensiones/tcpdf/pdf/factura.php?cliente='+cliente+'&empleado='+empleado+'&fecha='+fecha
		+'&hab='+numHabitacion+'&cantidad='+cantidad+'&fechaIngreso='+fechaIngreso+'&total='+total
		+'&totalHab='+totalHab+'&costoAdicional='+costoAdicional+'&descuento='+descuento+'&pagoTienda='+pagoTienda
		,'_blank');

})