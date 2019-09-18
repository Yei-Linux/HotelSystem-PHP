$(".tablas").on("click",".btneditarServicio",function(){

    var idEditServ=$(this).attr('id_editar_Serv');

    var dato=new FormData();

    dato.append('idEditServ',idEditServ);

    $.ajax({

        url:"ajax/servicios.ajax.php",
        method:'post',
        data:dato,
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',

        success : function (respuesta) {

            $("#editNombreServ").val(respuesta['SERVICIO']);
            $("#idEditServicio").val(respuesta['ID_SERVICIO']);
            $("#ediDescripcionServ").val(respuesta['DESCRIPCION']);
            $("#editPrecioServ").val(respuesta['PRECIO']);

        },

        error : function (error) {

            console.log(error);

        }



    })

})

$(".tablas").on("click",".btneliminarServicio",function (){

    var idElimServ=$(this).attr('id_elim_Serv');

    swal({

      type:"warning",
      title:"¿Estas Seguro que desea Eliminar un Servicio?",
      text:"Si no es asi entonces de click en Cerrar",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar un Servicio!'


    }).then(function(result){

      if(result.value){

        window.location="index.php?ruta=servicios&idElimServ="+idElimServ;
      }


    })

})