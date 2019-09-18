$(".temporadas").on('click','.btnverTemporada',function(){

    var estado_temporada=$(this).attr('temporada');

    var dato=new FormData();
    dato.append('estadoTemporada',estado_temporada);

    $.ajax({

        url:"ajax/tipohabitacion.ajax.php",
        method:'post',
        data:dato,
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',

        success: function(respuesta){

            $("#putPrimavera").val(respuesta[1]);
            $("#putVerano").val(respuesta[2]);
            $("#putOtoño").val(respuesta[3]);
            $("#putInvierno").val(respuesta[4]);
        },

        error: function(error){

            console.log(error);
        }


    })

    console.log(estado_temporada);


})