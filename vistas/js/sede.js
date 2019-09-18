
/*=============================================
				EDITAR SEDE
=============================================*/

$(".tablas").on('click','.btneditarSede',function(){

	var id_sede=$(this).attr('id_sede');

	var datos=new FormData();

	datos.append('idSede',id_sede);

	$.ajax({

		url:'ajax/sede.ajax.php',
		method:'POST',
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',

		success : function(respuesta){

			$('#editNombreSede').val(respuesta['NOMBRE']);
			$("#editLugarSede").val(respuesta['LUGAR']);
			$("#editPisoSede").val(respuesta['PISOS']);
			$("#editidSede").val(respuesta['ID_HOTEL']);

		},

		error : function(error){

			console.log(error);
		}

	})

})


/*=============================================
				ELIMINAR SEDE
=============================================*/

$(".tablas").on("click",".btneliminarSede",function (){

	var idelimSede=$(this).attr('idElimSede');

	swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar una Sede?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Sede!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=sede&id_elim_sede="+idelimSede;
      }


    })


})