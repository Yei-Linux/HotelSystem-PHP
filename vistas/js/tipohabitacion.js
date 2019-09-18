
$(".tablas").on('click','.btneditarTipoHab',function(){

    var id_tipo_habitacion=$(this).attr('id_tipo_habitacion');

    var datos=new FormData();

    datos.append('idTipoHabitacion',id_tipo_habitacion);

    $.ajax({

        url:"ajax/tipohabitacion.ajax.php",
        method:'post',
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',

        success : function(respuesta){

            $("#editidTipoHab").val(respuesta['ID_TIPO_HABITACION']);
            $("#editTipoHabitacion").val(respuesta['TIPO_HABITACION']);
            $("#editDescripcion").val(respuesta['DESCRIPCION']);
            $("#editPrecio").val(respuesta['PRECIO']);

        },

        error: function(error){
            console.log(error);
        }

    })

})

$(".tablas").on('click',".btneliminarTipoHab",function(){

    var id_elim_tipo_habitacion=$(this).attr('id_elim_tipo_habitacion');

    swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar un Tipo de Habitacion?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar un Tipo de Habitacion!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=tipohabitacion&id_elim_tipohab="+id_elim_tipo_habitacion;
      }


    })

})

$(".footer").on("click",".habilitar",function(){

    if(($(this).html())=="Habilitar"){

      $(this).html("Deshabilitar");

      $(this).parent().children(".Editar").removeAttr("disabled");

      var valor1=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil").removeAttr('disabled');
      var valor2=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil2").removeAttr('disabled');
      var valor3=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil3").removeAttr('disabled');
      var valor4=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil4").removeAttr('disabled');


    }else{

      $(this).html("Habilitar");

      $(this).parent().children(".Editar").prop("disabled",true);

      var valor1=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil").prop('disabled', true);
      var valor2=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil2").prop('disabled', true);
      var valor3=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil3").prop('disabled', true);
      var valor4=$(this).parent().parent().children(".modal-body").children().children().children().children(".habil4").prop('disabled', true);

    }

})