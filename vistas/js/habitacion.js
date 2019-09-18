/*=============================================
        SUBIENDO LA FOTO DE LA HABITACION
=============================================*/

$(".nuevaFotoHabitacion").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA 
                      JPG O PNG
  =============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFotoHabitacion").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFotoHabitacion").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarHabitacion").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
        	MOSTRAR DATOS EN EL SWAL		
=============================================*/

$('.tablas').on('click','.btneditarHabitacion',function(){

		var idHabitacion=$(this).attr('id_editar_habitacion');

		var idHotel=$(this).attr('idhotel');

		var datos=new FormData();

		datos.append('idHabitacion',idHabitacion);
		
		$.ajax({

			url:"ajax/habitacion.ajax.php",
			method:'post',
			data:datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:'json',

			success : function (respuesta){

				$("#editarNumeroHabitacion").val(respuesta['NUMERO_HABITACION']);
				$("#editarOldNumeroHabitacion").val(respuesta['NUMERO_HABITACION']);
				$("#editarPiso").val(respuesta['PISO']);
				$("#editarDescripcion").val(respuesta['DESCRIPCION_HAB']);
				$("#editarCamas").val(respuesta['PLAZAS']);
				$("#editarTipoHabitacion").val(respuesta['TIPO_HABITACION']);
				$("#editarEstado").val(respuesta['NOMBRE_ESTADO']);
				$("#editIdHabitacion").val(respuesta['ID_HABITACION']);
				

				if(respuesta['FOTO']!=" "){

					$(".editprevisualizarHabitacion").attr('src',respuesta['FOTO']);
					$("#fotoActualHabitacion").val(respuesta['FOTO']);

				}

			},

			error : function (error){

				console.log(error);

			}


		})
})

/*=============================================
SUBIENDO LA FOTO DE LA HABITACION AL EDITAR
=============================================*/

$("#editarFotoHabitacion").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA 
                      JPG O PNG
  =============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFotoHabitacion").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFotoHabitacion").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".editprevisualizarHabitacion").attr("src", rutaImagen);

  		})

  	}
})


/*=============================================
				ELIMINAR UNA HABITACION
=============================================*/

$(".tablas").on("click",".btneliminarHabitacion",function (){

	var idelimHabitacion=$(this).attr('id_eliminar_habitacion');
	var ruta=$(this).attr('ruta2');

	swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar una Habitacion?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Habitacion!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=habitacion&idElimHabitacion="+idelimHabitacion+
						"&ruta2="+ruta;
      }


    })


})

/*=============================================
    MOSTRANDO EL ULTIMO NUM DE LA HABITACION
=============================================*/

$('.seccion').on('click','#btnagregarHabitacion',function () {

	var estadoAgregarHabitacion="enviandoHabitacion";
	var idHotel=$(this).attr('idhotel');

	console.log(idHotel);

	var dato=new FormData(); 

	dato.append('estadoAgregarHabitacion',estadoAgregarHabitacion);
	dato.append('idHotel',idHotel);
	
	$.ajax({

		url:'ajax/habitacion.ajax.php',
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			if(respuesta['NUM_HABITACION']==null){

				$("#nuevoNumHabitacion2").val('100');
				$("#nuevoNumHabitacion").val('100');

			}else{

				$("#nuevoNumHabitacion2").val(respuesta['NUM_HABITACION']);
				$("#nuevoNumHabitacion").val(respuesta['NUM_HABITACION']);

			}

			

		},

		error : function (error){

			console.log(error);

		}

	})

})

/*=============================================
        VERIFICAR SI YA EXISTE LA HABITACION
=============================================*/

$("#editarNumeroHabitacion").change(function () {

	$(".alert").remove();

	var numHabitacion=$(this).val();

	var dato=new FormData();

	dato.append('numHabitacion',numHabitacion);

	$.ajax({

		url:"ajax/habitacion.ajax.php",
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success: function (respuesta){


			if(respuesta=="Existe la habitacion"){

				$("#editarNumeroHabitacion").parent().after('<div class="alert alert-warning">Esta Habitacion ya existe en la base de datos</div>');
              	$("#editarNumeroHabitacion").val(" ");

			}else{

				console.log("No existe! ");
			}

			
		},


		error : function (error){

			console.log(error);
		}


	})
	
})

/*=============================================
		MOSTRAR FOTO DE LA HABITACION 
=============================================*/

$(".tablas").on('click','.imagenMostrarHab',function () {

	var imagen=$(this).attr('src');

	$(".visualizandoHabitacion").attr("src", imagen);
	
})
