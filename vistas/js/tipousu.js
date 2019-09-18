

$(".tablas").on("click",".btneditarTipoUsu",function () {
    
    var id_tipoUsu=$(this).attr("id_tipousu");
    var datos=new FormData();

    datos.append('idTipoUsu',id_tipoUsu);

    $.ajax({

        url:'ajax/tipousu.ajax.php',
        method:'post',
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',

        success : function(respuesta){
            
            $("#editTipoUsu").val(respuesta['NOM_TIPO_USU']);
            $("#editDescrip").val(respuesta['DESCRIPCION']);
            $("#editid_tipo_usu").val(respuesta['ID_TIPO_USU']);

        },

        error : function (error) {
            
            console.log(error);

        } 


    });
    
})

$(".tablas").on("click",".btneliminarTipoUsu",function () {

    var id_elim_tipousu=$(this).attr("id_elim_tipousu");

    swal({
                                    
            type:"warning",
            title:"¿Estas Seguro que desea Eliminar un Tipo de Usuario?",
            text:"Si no es asi entonces de click en Cerrar",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar Tipo de Usuario!'



    }).then(function(result){

            if(result){
                                        
                window.location="index.php?ruta=tipousuario&idElimTipoUsu="+id_elim_tipousu;

            }    
                                    
    })



})