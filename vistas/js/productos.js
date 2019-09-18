/*=============================================
        SUBIENDO LA FOTO DE LA HABITACION
=============================================*/

$(".nuevaFotoProducto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA 
                      JPG O PNG
  =============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFotoProducto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFotoProducto").val("");

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

  			$(".previsualizarProducto").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
        MOSTRAR DATOS EN EL SWAL
=============================================*/

$(".tablas").on("click",".btnEditarProducto",function(){

    var id_editarProducto=$(this).attr('id_editarProducto');

    var dato=new FormData();

    dato.append('idEditarProducto',id_editarProducto);

    $.ajax({

        url:"ajax/productos.ajax.php",
        method:'post',
        data:dato,
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',

        success : function (respuesta){

            $("#editProd").val(respuesta['DESCRIPCION']);
            $("#editOldProd").val(respuesta['DESCRIPCION']);

            $("#editPrecioProd").val(respuesta['PRECIO']);
            $("#editCategoria").val(respuesta['NOMBRE_CATEGORIA']);
            $("#editIdProd").val(respuesta['ID_PRODUCTO']);

            $(".editprevisualizarProducto").attr('src',respuesta['FOTO_PRODUCTO']);

        },

        error : function (error){

            console.log(error);

        }
    })

})
 
/*=============================================
        SUBIENDO LA FOTO DEL PRODUCTO
                AL EDITAR
=============================================*/

$(".editFotoProducto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA 
                      JPG O PNG
  =============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".editFotoProducto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".editFotoProducto").val("");

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

  			$(".editprevisualizarProducto").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
        VALIDA SI YA EXISTE EL PRODUCTO
=============================================*/

$("#editProd").change(function(){

	$(".alert").remove();

	var nomProducto=$(this).val();

	var dato=new FormData();

	dato.append("nomProducto",nomProducto);

	$.ajax({

		url:'ajax/productos.ajax.php',
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			if(respuesta=="Ya existe el producto!"){

				$("#editProd").parent().after('<div class="alert alert-warning">Este Producto ya existe en la base de datos</div>');
              	$("#editProd").val(" ");

			}

			if(respuesta=="No existe el producto!"){
				console.log(respuesta);
			}

		},

		error : function (error){

			console.log(error);
		}

	})

})

/*=============================================
        VALIDA SI YA EXISTE EL PRODUCTO 
				AL AGREGAR
=============================================*/

$("#nuevoProd").change(function(){

	$(".alert").remove();

	var nomProducto=$(this).val();

	var dato=new FormData();

	dato.append("nomProducto",nomProducto);

	$.ajax({

		url:'ajax/productos.ajax.php',
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function (respuesta){

			if(respuesta=="Ya existe el producto!"){

				$("#nuevoProd").parent().after('<div class="alert alert-warning">Este Producto ya existe en la base de datos</div>');
              	$("#nuevoProd").val(" ");

			}

			if(respuesta=="No existe el producto!"){
				console.log(respuesta);
			}

		},

		error : function (error){

			console.log(error);
		}

	})

})

/*=============================================
       		ELIMINAR UN PRODUCTO
=============================================*/

$(".tablas").on('click','.btnEliminarProducto',function(){

	var idElimProd=$(this).attr('id_eliminarProducto');

	var ruta=$(this).attr('rutaProd');

	swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar un Producto?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Producto!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=productos&idElimProducto="+idElimProd+
						"&ruta2="+ruta;
      }


    })

})


/*=============================================
       		HABILITAR CATEGORIA
=============================================*/

$(".footerHabitacion").on("click",".habilitarCategoria",function(){

    if(($(this).html())=="Habilitar"){

      $(this).html("Deshabilitar");

      $(this).parent().children(".EditarCategoria").removeAttr("disabled");

      var valor1=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat").removeAttr('disabled');
      var valor2=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat2").removeAttr('disabled');
      var valor3=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat3").removeAttr('disabled');
      var valor4=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat4").removeAttr('disabled');


    }else{

      $(this).html("Habilitar");

      $(this).parent().children(".EditarCategoria").prop("disabled",true);

      var valor1=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat").prop('disabled', true);
      var valor2=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat2").prop('disabled', true);
      var valor3=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat3").prop('disabled', true);
      var valor4=$(this).parent().parent().children(".modal-body").children().children().children().children(".habilCat4").prop('disabled', true);

    }

})

/*=============================================
       		MOSTRAR CATEGORIAS EN LA 
			   SECCION PRODUCTOS
=============================================*/

$(".Categorias").on("click",".btnverCategorias",function(){

	var estadoCategoria=$(this).attr("categoria");

	var dato=new FormData();

	dato.append('estadoCategoria',estadoCategoria);
	
	$.ajax({

		url:'ajax/productos.ajax.php',
		method:'post',
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function(respuesta){

			$("#putCat1").val(respuesta[0]);
			$("#putCat2").val(respuesta[1]);
			$("#putCat3").val(respuesta[2]);
			$("#putCat4").val(respuesta[3]);

		},

		error : function (error) {

			console.log(error);

		}

	})

})

