<?php


    class ControladorTipoUsu{

        static public function ctrAgregarTipoUsu(){

            if(isset($_POST["nuevoTipoUsu"])){

                $tabla1="tipo_usuario";

                $datos=array("tipo_usu"=>$_POST["nuevoTipoUsu"],
                            "descripcion"=>$_POST["nuevoDescrip"]);

                $respuesta=ModeloTipoUsu::mdlAgregarTipoUsu($tabla1,$datos);

                if($respuesta=="ok"){

                    echo '<script>
                    
                            swal({
                                
                                type:"success",
                               	title: "El Tipo de Usuario ha sido guardado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"



                            }).then(function(result){

                                if(result){
                                    
                                    window.location="tipousuario";

                                }    
                                
                            })
                    
                    
                         </script>';

                }else{

                     echo '<script>
                    
                            swal({
                                
                                type:"error",
                               	title: "El Tipo de Usuario no ha sido guardado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"



                            }).then(function(result){

                                if(result){
                                    
                                    window.location="tipousuario";

                                }    
                                
                            })
                    
                    
                         </script>';

                }

            }

        }

        static public function ctrMostarTipoUsu($item,$valor){

            $tabla1="tipo_usuario";

            $respuesta=ModeloTipoUsu::mdlMostrarTipoUsu($item,$valor);

            return $respuesta;

        }

        static public function ctrEditarTipoUsu(){

            if(isset($_POST['editTipoUsu'])){

                $tabla1="tipo_usuario";

                $datos=array("tipo_usu"=>$_POST['editTipoUsu'],
                            "descripcion"=>$_POST['editDescrip'],
                            "id_tipo_usu"=>$_POST['editid_tipo_usu']);

                $respuesta=ModeloTipoUsu::mdlEditarTipoUsu($tabla1,$datos);

                if($respuesta=="ok"){

                    echo '<script>
                        
                                swal({
                                    
                                    type:"success",
                                    title: "El Tipo de Usuario ha sido editado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"



                                }).then(function(result){

                                    if(result){
                                        
                                        window.location="tipousuario";

                                    }    
                                    
                                })
                        
                        
                            </script>';

                }else{

                    echo '<script>
                        
                                swal({
                                    
                                    type:"error",
                                    title: "El Tipo de Usuario no ha sido editado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"



                                }).then(function(result){

                                    if(result){
                                        
                                        window.location="tipousuario";

                                    }    
                                    
                                })
                        
                        
                            </script>';

                }


            }

        }

        static public function ctrEliminarTipoUsu(){

            if(isset($_GET['idElimTipoUsu'])){

            

            $item="ID_TIPO_USU";
            $valor=$_GET['idElimTipoUsu'];

            $respuesta=ModeloTipoUsu::mdlEliminarTipoUsu($item,$valor);

            if($respuesta=="ok"){

                echo '<script>
                        
                                swal({
                                    
                                    type:"success",
                                    title: "El Tipo de Usuario ha sido eliminado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"



                                }).then(function(result){

                                    if(result){
                                        
                                        window.location="tipousuario";

                                    }    
                                    
                                })
                        
                        
                            </script>';

            }else{

                 echo '<script>
                        
                                swal({
                                    
                                    type:"error",
                                    title: "El Tipo de Usuario no ha sido eliminado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"



                                }).then(function(result){

                                    if(result){
                                        
                                        window.location="tipousuario";

                                    }    
                                    
                                })
                        
                        
                            </script>';

            }

            }

        }


    }









?>