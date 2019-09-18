$(".tabla").on("click",".btnAgregarServicio",function(){

	var idServicio=$(this).attr("id_agregarServicio");

	var dato=new FormData();

	dato.append("idServicio",idServicio);

	$(this).removeClass("btn-primary btnAgregarServicio");

	$(this).addClass("btn-default");

	$.ajax({ 
 
		url:"ajax/tienda.ajax.php",
		method:"post",
		data:dato,
		cache:false,
		processData:false,
		contentType:false,
		dataType:'json',


		success : function (respuesta){

			var descripcion = respuesta["SERVICIO"];
          	var precio = respuesta["PRECIO"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

			$(".nuevoServicio").append(

			'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio="'+idServicio+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionServicio" idServicio="'+idServicio+'" name="nuevaDescripcionServicio" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadServicio" name="nuevaCantidadServicio" min="1" value="1" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioServicio" precioReal="'+precio+'" name="nuevoPrecioServicio" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>'
                  
              );

			// SUMAR TOTAL DE PRECIOS

			sumarTotalPrecioServicios();

			// AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarServicios()


		},


		error : function (error) {


			console.log(error);

		}

	})

})

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA(COMO CAMBIAR DE PAGINA)
=============================================*/

$(".tabla").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		/*=============================================================================
			OBTENGO LO QUE HAY EN EL LOCALSTORAGE Y LO CONVIERTO A FORMATO JSON
		=============================================================================*/

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		/*=============================================================================
			RECORRO LO QUE HAY EN LA LISTA DE ID DE PRODUCTOS Y LO COLOCO EN LOS ATTR 
								DE LOS BOTONES QUE CORRESPONDEN
		=============================================================================*/

		for(var i = 0; i < listaIdProductos.length; i++){

			$(".recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$(".recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary btnAgregarServicio');

		}

	}


})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioVenta").on("click", ".quitarServicio", function(){

	console.log("hola");

	$(this).parent().parent().parent().parent().remove();

	var idServicio= $(this).attr("idServicio");

	/*=======================================================================
			  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=======================================================================*/

	/*=============================================
	VERIFICAR SI EXISTE EL ITEM EN EL LOCASTORAGE
	=============================================*/

	if(localStorage.getItem("quitarServicio") == null){

		/*=============================================
			CREA UN ARRAY VACIO
		=============================================*/

		idQuitarServicio = [];
	
	}else{

		/*=============================================
			
		=============================================*/

		idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

	}

	/*=============================================
				AGREGAR EL ID PROODUCTO
				EN EL ARRAY CREADO
	=============================================*/

	idQuitarServicio.push({"idServicio":idServicio});

	/*=============================================
				SOBREESCRIBE,LO QUE HAY
					   EN EL ARRAY,
				   EN EL LOCALSTORAGE 
				   (CONVIERTO DE FORMATO JSON
				   		 A STRING)
	=============================================*/

	localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));



	$(".recuperarBoton[id_agregarServicio='"+idServicio+"']").removeClass('btn-default');

	$(".recuperarBoton[id_agregarServicio='"+idServicio+"']").addClass('btn-primary btnAgregarServicio');

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecioServicios();

	// AGRUPAR PRODUCTOS EN FORMATO JSON

	listarServicios()


})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", ".nuevaCantidadServicio", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioServicio");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecioServicios();

	// AGRUPAR PRODUCTOS EN FORMATO JSON

	listarServicios()


})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecioServicios(){

	var precioItem = $(".nuevoPrecioServicio");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}
	
	if(precioItem.length!=0){

		var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
		$("#nuevoTotalVenta").val(sumaTotalPrecio);
		$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);

	}else{

		$("#nuevoTotalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}

}

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarServicios(){

	var listaServicios = [];

	var descripcion = $(".nuevaDescripcionServicio");

	var cantidad = $(".nuevaCantidadServicio");

	var precio = $(".nuevoPrecioServicio");

	for(var i = 0; i < descripcion.length; i++){

		listaServicios.push({ "id" : $(descripcion[i]).attr("idServicio"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}

	$("#listaServicios").val(JSON.stringify(listaServicios)); 

}

