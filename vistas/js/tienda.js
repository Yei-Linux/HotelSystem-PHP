$(".tablas").on("click",".btnAgregarProducto",function(){

	var idProducto=$(this).attr("id_agregarProducto");

	var dato=new FormData();

	dato.append("idProducto",idProducto);

	$(this).removeClass("btn-primary btnAgregarProducto");

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

			var descripcion = respuesta["DESCRIPCION"];
          	var stock = respuesta["STOCK"];
          	var precio = respuesta["PRECIO"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary btnAgregarProducto");

			    return;

          	}

			$(".nuevoProducto").append(

			'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>'
                  
              );

			// SUMAR TOTAL DE PRECIOS

			sumarTotalPrecios();

			// AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()


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
			$(".recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary btnAgregarProducto');

		}

	}


})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", ".quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=======================================================================
			  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=======================================================================*/

	/*=============================================
	VERIFICAR SI EXISTE EL ITEM EN EL LOCASTORAGE
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		/*=============================================
			CREA UN ARRAY VACIO
		=============================================*/

		idQuitarProducto = [];
	
	}else{

		/*=============================================
			
		=============================================*/

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	/*=============================================
				AGREGAR EL ID PROODUCTO
				EN EL ARRAY CREADO
	=============================================*/

	idQuitarProducto.push({"idProducto":idProducto});

	/*=============================================
				SOBREESCRIBE,LO QUE HAY
					   EN EL ARRAY,
				   EN EL LOCALSTORAGE 
				   (CONVIERTO DE FORMATO JSON
				   		 A STRING)
	=============================================*/

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));



	$(".recuperarBoton[id_agregarProducto='"+idProducto+"']").removeClass('btn-default');

	$(".recuperarBoton[id_agregarProducto='"+idProducto+"']").addClass('btn-primary btnAgregarProducto');

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios();

	// AGRUPAR PRODUCTOS EN FORMATO JSON

	listarProductos()


})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", ".nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(1);

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios();

	// AGRUPAR PRODUCTOS EN FORMATO JSON

	listarProductos()


})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
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

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}

