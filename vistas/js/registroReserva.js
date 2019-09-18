$("#reservaDni").change(function(){

	$(".alert").remove();

	var dniCliente=$(this).val();

	var dato=new FormData();

	dato.append('dniCliente',dniCliente);

	$.ajax({ 

		url:"ajax/registroReserva.ajax.php",
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			if(respuesta=="No existe un cliente con ese DNI!"){

				$('#reservaDni').parent().after('<div class="alert alert-warning">Este cliente no esta registrado en la base de datos</div>');
              	$('#reservaDni').val(" ");
                $("#reservaidCliente").val(" ");
              	$("#reservaNombres").val("Nombres y Apellidos del Cliente");

			}else{

				$("#reservaNombres").val(respuesta['nombres']);
				$("#reservaidCliente").val(respuesta['idCliente']);

			}

		},

		error : function (error){

			console.log(error);

		}

	})

})

$(".tablas").on("click",".btnMostrarDetalle",function () {
	
	var idReserva=$(this).attr('idReservaDetalle');

	var dato=new FormData();

	dato.append("idReserva",idReserva);

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

$(".tablas").on("click",".btnReservaregIngreso",function(){

	var idReservaIng=$(this).attr('idReservaDetalleIng');

	var dato=new FormData();

	dato.append("idReservaIng",idReservaIng);

	$.ajax({

		url:"ajax/registroReserva.ajax.php",
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta) {

			$("#ReservanumHabIng").val(respuesta['NUMERO_HABITACION']);
			$("#ReservanumPisoIng").val(respuesta['PISO']+'° Piso');
			$("#ReservatipoHabIng").val(respuesta['TIPO_HABITACION']);
			$("#ReservanumCamasIng").val(respuesta['PLAZAS']+' Cama(s)');
			$("#ReservaprecioIng").val("S/."+respuesta['PRECIO']);
			$("#ReservaMaxIng").val((parseInt(respuesta['PLAZAS'])*2) + " Persona(s)");

			$("#RIidHabitacion").val(respuesta['ID_HABITACION']);
			$("#RIidCliente").val(respuesta['ID_CLIENTE']);
			$("#RIDatosClienteIng").val(respuesta['NOMCLIENTE']);
			$("#RIdniClienteIng").val(respuesta['DNI']);
			$("#RIidReserva").val(respuesta['ID_RESERVA']);

		},

		error : function (error) {

			console.log(error);

		}
		
	})


})

$(".tablas").on("click",".btnEliminarReserva",function(){

	var idelimReserva=$(this).attr('idReservaElim');
	var idHabReserva=$(this).attr('idHabitacion');

	swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar esta Reserva?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Reserva!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=registroReserva&idElim_Reserva="+idelimReserva+"&idHab_Reserva="+idHabReserva;

      }


    })

})