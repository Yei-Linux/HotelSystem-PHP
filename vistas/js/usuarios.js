/*=============================================
        SUBIENDO LA FOTO DEL USUARIO
=============================================*/

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA 
                      JPG O PNG
  =============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

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

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
        SUBIENDO LA FOTO DEL USUARIO
                  AL EDITAR
=============================================*/

$(".editFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA 
                      JPG O PNG
  =============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".editFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".editFoto").val("");

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

  			$(".previsualizarEdit").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
      MOSTRAR DATOS EN EL SWAL DE EMPLEADO
=============================================*/

$(".tablas").on('click','.btneditarEmpleado',function(){

    var idEmpleado=$(this).attr('id_empleado');

    var idHotel=$(this).attr('idhotel');

    var datos=new FormData();

    datos.append('idEmpleado',idEmpleado);

    datos.append('idHotel',idHotel);

    $.ajax({

      url:'ajax/empleado.ajax.php',
      method:'POST',
      data:datos,
      cache:false,
      contentType:false,
      processData:false,
      dataType:'json',

      success:function(respuesta){

        $("#idEmpleado").val(respuesta['ID_EMPLEADO']);
        $("#editApPatEmp").val(respuesta['APELLIDO_PATERNO']);
        $("#editApMatEmp").val(respuesta['APELLIDO_MATERNO']);
        $("#editNombreEmp").val(respuesta['NOMBRE']);
        $("#editDniEmp").val(respuesta['DNI']);
        $("#editDireccionEmp").val(respuesta['DIRECCION']);
        $("#editTelefonoEmp").val(respuesta['TELEFONO']);
        $("#editCorreoEmp").val(respuesta['CORREO']);
        $("#editUsuario").val(respuesta['USARIO']);
        $("#passwordActual").val(respuesta['PASS']);
        $("#oldUsuario").val(respuesta['USARIO']);

        $("#editPerfil").val(respuesta['NOM_TIPO_USU']);

        if(respuesta['FOTO']!=""){

            $(".previsualizarEdit").attr('src',respuesta['FOTO']);

        }

      },

      error: function(error){
        console.log(error);
      }

    })

})

/*=============================================
      VERIFICAR SI EXISTE EL USUARIO AL
              AGREGAR UNO NUEVO
=============================================*/

$("#nuevoUsuario").change(function(){
  
    $(".alert").remove();

    var usuario=$("#nuevoUsuario").val();

    var datos=new FormData();

    datos.append('usuario',usuario);

    $.ajax({

      url:'ajax/empleado.ajax.php',
      method:'POST',
      data:datos,
      contentType:false,
      cache:false,
      processData:false,
      dataType:'json',

      success: function(respuesta){

          if(respuesta=="El usuario ya Existe!!"){

              $('#nuevoUsuario').parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');
              $('#nuevoUsuario').val(" ");

          }

      },
      error: function (error){

        console.log(error);

      }

    })

})


/*=============================================
      VERIFICAR SI EXISTE EL USUARIO AL
                    EDITAR
=============================================*/

$("#editUsuario").change(function(){

    $(".alert").remove();

    var usuario=$(this).val();

    var datos=new FormData();

    datos.append('usuario',usuario);

    $.ajax({
  
      url:'ajax/empleado.ajax.php',
      method:'POST',
      data:datos,
      contentType:false,
      cache:false,
      processData:false,
      dataType:'json',

      success: function(respuesta){

          if(respuesta=="El usuario ya Existe!!"){

              $('#editUsuario').parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');
              $('#editUsuario').val(" ");

          }

      },
      error: function (error){

        console.log(error);

      }

    })

})

/*=============================================
      ACTIVAR USUARIO DESDE EL DATATABLE
=============================================*/

$(".tablas").on('click','#btnestado',function(){

    var est_user=0;
    var id_est_Empleado=$(this).attr('id_est_Empleado');
    var estadoUsuario=$(this).attr('estado');

    if(estadoUsuario==0){
        est_user=1;
    }else{
        est_user=0;
    }

    var datos=new FormData();

    datos.append('id_est_Empleado',id_est_Empleado);
    datos.append('estado',est_user);

    $.ajax({

      url:'ajax/empleado.ajax.php',
      method:'POST',
      data:datos,
      cache:false,
      contentType:false,
      processData:false,
      dataType:'json',

      success : function (respuesta){

        if(window.matchMedia("(max-width:767px)").matches){
    
           swal({

            title: "El usuario ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"

          }).then(function(result) {
            
              if (result.value) {

              window.location = "empleados";

            }

          });

        }

      },

      error : function (error){

        console.log(error);

      }

    })

    if(estadoUsuario == 1){


          $(this).removeClass('btn-success');
          $(this).addClass('btn-warning');
          $(this).html('Desactivado');
          $(this).attr('estado',0);

    }else{

          $(this).addClass('btn-success');
          $(this).removeClass('btn-warning');
          $(this).html('Activado');
          $(this).attr('estado',1);

    }

})

/*=============================================
              ELIMINAR EMPLEADO
=============================================*/

$(".tablas").on('click','.btneliminarEmpleado',function(){

    var id_elim_empleado=$(this).attr('id_empleado');
    var id_elim_persona=$(this).attr('id_persona');
    var id_elim_usuario=$(this).attr('id_usuario');
    var rutaEmp=$(this).attr('rutaEmp');

    swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar un Empleado?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Empleado!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=empleados&id_elim_empleado="+id_elim_empleado
                        +"&id_elim_persona="+id_elim_persona+"&id_elim_usuario="+id_elim_usuario
                        +"&ruta2="+rutaEmp;
      }


    })

})
