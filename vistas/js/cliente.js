
/*=============================================
				EDITAR CLIENTE
=============================================*/

	$('.tablas').on('click','.btnEditarCliente',function(){


		var idCliente=$(this).attr('id_cliente');

		var datos=new FormData();

		datos.append('idCliente', idCliente);


		$.ajax({

			url:'ajax/cliente.ajax.php',
			method:'POST',
			data:datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:'json',

			success:function(respuesta){

				$("#idCliente").val(respuesta["ID_CLIENTE"]);
				$('#editarApPat').val(respuesta['APELLIDO_PATERNO']);
				$('#editarApMat').val(respuesta['APELLIDO_MATERNO']);
				$('#editarNombre').val(respuesta['NOMBRE']);
				$('#editarDni').val(respuesta['DNI']);
				$('#editarDireccion').val(respuesta['DIRECCION']);
				$('#editarTelefono').val(respuesta['TELEFONO']);
				$('#editarCorreo').val(respuesta['CORREO']);

			}

		})

	})

/*=============================================
				ELIMINAR CLIENTE
=============================================*/

$(".tablas").on('click','.btnEliminarCliente',function(){

	var idCliente=$(this).attr('id_cliente');
	var idPersona=$(this).attr('id_persona');

	swal({

		type:"warning",
		title:"¿Estas Seguro que desea Eliminar un Cliente?",
		text:"Si no es asi entonces de click en Cerrar",
		showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'


	}).then(function(result){

		if(result.value){

			window.location="index.php?ruta=clientes&idCliente="+idCliente+"&idPersona="+idPersona;
		}


	})


})