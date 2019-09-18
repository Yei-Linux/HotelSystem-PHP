<?php

    class ControladorTipoHab{

        static public function ctrAgregarTipoHab(){

            if(isset($_POST['nuevaDescripcion'])){

                $tabla1="tipo_habitacion";

                $datos=array("descripcion"=>$_POST['nuevaDescripcion'],
                            "precio"=>$_POST['nuevoPrecio'],
                            "tipo_habitacion"=>$_POST['nuevoTipoHabitacion']);

                $respuesta=ModeloTipoHabitacion::mdlAgregarTipoHab($tabla1,$datos);

                if($respuesta=="ok"){

                        echo '<script>

                                    swal({
                                        type:"success",
                                        title: "El tipo de habitacion ha sido guardado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';

                }else{

                        echo '<script>

                                    swal({
                                        type:"error",
                                        title: "El tipo de habitacion no ha sido guardado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';


                }

            }

        }

        static public function ctrMostrarTipoHab($item,$valor){

            $tabla1="tipo_habitacion";

            $respuesta=ModeloTipoHabitacion::mdlMostrarTipoHab($tabla1,$item,$valor);

            return $respuesta;


        }

        static public function ctrMostrarDescuento($valor){

            $tabla1="temporada";

            $respuesta=ModeloTipoHabitacion::mdlMostrarDescuento($tabla1,$valor);

            return $respuesta;

        }

        static public function ctrEditarTipoHabitacion(){

            if(isset($_POST['editTipoHabitacion'])){

                $tabla1="tipo_habitacion";

                $datos=array("id_tipo_habitacion"=>$_POST['editidTipoHab'],
                            "tipo_habitacion"=>$_POST['editTipoHabitacion'],
                            "descripcion"=>$_POST['editDescripcion'],
                            "precio"=>$_POST['editPrecio']);

                $respuesta=ModeloTipoHabitacion::mdlEditarTipoHabitacion($tabla1,$datos);

                if($respuesta=="ok"){

                    echo '<script>

                                    swal({
                                        type:"success",
                                        title: "El tipo de habitacion ha sido editado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';

                }else{

                    echo '<script>

                                    swal({
                                        type:"error",
                                        title: "El tipo de habitacion no ha sido editado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';


                }

            }

        }

        static public function ctrEliminarTipoHabitacion(){

            if(isset($_GET['id_elim_tipohab'])){

                $tabla1="tipo_habitacion";

                $item="ID_TIPO_HABITACION";
                $valor=$_GET['id_elim_tipohab'];

                $respuesta=ModeloTipoHabitacion::mdlEliminarTipoHabitacion($tabla1,$item,$valor);

                if($respuesta=="ok"){

                    echo '<script>

                                    swal({
                                        type:"success",
                                        title: "El tipo de habitacion ha sido eliminado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';

                }else{

                    echo '<script>

                                    swal({
                                        type:"error",
                                        title: "El tipo de habitacion no ha sido eliminado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';

                }

            }
        }

        static public function ctrMostrarTemporada($item){

            $respuesta=ModeloTipoHabitacion::mdlMostrarTemporada($item);

            return $respuesta;
        }

        static public function ctrEditarTemporada(){

            if(isset($_POST['putInvierno'])){

                $tabla1="temporada";

                $datos=array("invierno"=>$_POST['putInvierno'],
                             "otono"=>$_POST['putOtono'],
                             "verano"=>$_POST['putVerano'],
                             "primavera"=>$_POST['putPrimavera']);

                $respuesta=ModeloTipoHabitacion::mdlEditarTemporada($tabla1,$datos);

                if($respuesta=="ok"){

                    echo '<script>

                                    swal({
                                        type:"success",
                                        title: "La temporada ha sido editada correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';

                }else{

                    echo '<script>

                                    swal({
                                        type:"success",
                                        title: "La temporada no ha sido editada correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        
                                        if(result.value){
                                            window.location= "tipohabitacion";
                                        }

                                    })
            
                                </script>
                            ';

                }

            }

        }

    }







?>