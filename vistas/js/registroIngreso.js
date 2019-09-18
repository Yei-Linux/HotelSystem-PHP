$("#lista_pisos").on("click",".item_piso",function(){

	$('.item_piso').css("background-color","#defcfc");
	$('.item_piso').css("color","gray");
	$('.item_piso').css("border-bottom","3px solid #d2d6de");

	var numPiso=$(this).attr("numPiso");
	var idHotel=$(this).attr("idHotel");

	$(this).css("background-color","white");
	$(this).css("color","gray");
	$(this).css("border-bottom","3px solid white");

	$("#contenedor_habitaciones").load("ajax/registroIngreso.ajax.php",{numeroPiso:numPiso,idHotel:idHotel});

})

$('#contenedor_habitaciones').on('click','.estadoLibre',function(){

	var estado=$(this).attr("estado");

	console.log(estado);

	var idHabitacion=$(this).attr('id_Habitacion');

	var dato=new FormData();

	dato.append('idHabitacion',idHabitacion);

	$.ajax({

		url:'ajax/registroIngreso.ajax.php',
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			$("#numHab").val(respuesta['NUMERO_HABITACION']);
			$("#numPiso").val(respuesta['PISO']+'° Piso');
			$("#tipoHab").val(respuesta['TIPO_HABITACION']);
			$("#numCamas").val(respuesta['PLAZAS']+' Cama(s)');
			$("#precio").val("S/."+respuesta['PRECIO']);
			$("#Max").val(respuesta['MAX_PERSONAS']);

			$("#idHabitacion").val(respuesta['ID_HABITACION']);

		},

		error : function (error){

			console.log(error);

		}
	})

})

$('#contenedor_habitaciones').on('click','.estadoOcupada',function(){

	var idHabitacion=$(this).attr('id_Habitacion');

	var estado=$(this).attr('estado');

	var datos=new FormData();

	datos.append('idHabitacionEst',idHabitacion);
	datos.append('estadoEst',estado);

	$.ajax({

		url:"ajax/registroIngreso.ajax.php",
		method:'post',
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			$("#ocupadanumHab").val(respuesta['NUMERO_HABITACION']);
			$("#ocupadanumPiso").val(respuesta['PISO']);
			$("#ocupadatipoHab").val(respuesta['TIPO_HABITACION']);
			$("#ocupadanumCamas").val(respuesta['PLAZAS']);
			$("#ocupadaPrecio").val(respuesta['PRECIO']);
			$("#ocupadaMax").val(respuesta['MAX_PERSONAS']);

			$("#ocupadaDatosClienteIng").val(respuesta['NOMBRES'] + " / " +respuesta['DNI']);
			$("#ocupadadniClienteIng").val("Fecha Ingreso : "+respuesta['FECHA_INICIO']);
			$("#ocupadafechaFin").val("Fecha Salida : "+respuesta['FECHA_FIN']);
			$("#ocupadanumAdultos").val(respuesta['NUMERO_ADULTOS']+" Adulto(s)");
			$("#ocupadanumNinos").val(respuesta['NUMERO_NINOS']+" Niño(s)");

		},

		error : function (error) {

			console.log(error);

		}

	})

})


$("#dniClienteIng").change(function(){

	$(".alert").remove();

	var dniCliente=$(this).val();

	var dato=new FormData();

	dato.append('dniCliente',dniCliente);

	$.ajax({

		url:"ajax/registroIngreso.ajax.php",
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			if(respuesta=="No existe un cliente con ese DNI!"){

				$('#dniClienteIng').parent().after('<div class="alert alert-warning">Este cliente no esta registrado en la base de datos</div>');
              	$('#dniClienteIng').val(" ");
              	$("#DatosClienteIng").val("Nombres y Apellidos del Cliente");

			}else{

				$("#DatosClienteIng").val(respuesta['nombres']);
				$("#idCliente").val(respuesta['idCliente']);

			}

		},

		error : function (error){

			console.log(error);

		}

	})

})

$("#contenedor_habitaciones").on("click",".estadoReservada",function () {
	
	var idHabitacion=$(this).attr('id_habitacion');

	var dato=new FormData();

	dato.append("idHabitacion",idHabitacion);

	$.ajax({

		url:"ajax/registroReserva.ajax.php",
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta) {

			$("#ReservaNumHabitacion").html(respuesta['NUMERO_HABITACION']);
			$("#nomEmp").val(respuesta['NOMEMPLEADO']);
			$("#ReservanumPiso").val(respuesta['PISO'] + "° Piso");
			$("#ReservanumCamas").val(respuesta['PLAZAS'] + " Cama(s)");
			$("#ReservaMax").val((parseInt(respuesta['PLAZAS'])*2) + " Persona(s)");
			$("#ReservaFechaDias").val(respuesta['DIFERENCIA_DIAS'] + " Dia(s)");
			$("#ReservaNomCliente").val(respuesta['NOMCLIENTE'] + " / " + respuesta['DNI']);
			$("#ReserfechaReserva").val("Fecha de Llegada : "+respuesta['FECHA_LLEGADA']);
			$("#ReservanumAdultos").val("Numero de Adultos : "+respuesta['CANTIDAD_ADULTOS']);
			$("#ReservanumNinos").val("Numero de Niños : "+respuesta['CANTIDAD_NINOS']);
			$("#reservaObservaciones").val(respuesta['OBSERVACIONES']);

		},

		error : function (error) {

			console.log(error);

		}
		
	})

})