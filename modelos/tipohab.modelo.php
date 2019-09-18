<?php

    class ModeloTipoHabitacion{

        static public function mdlAgregarTipoHab($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO tipo_habitacion(TIPO_HABITACION,DESCRIPCION,PRECIO) 
                VALUES(:tipo_habitacion,:descripcion,:precio)"

            );
            
            $cn->bindParam(":tipo_habitacion",$datos['tipo_habitacion'],PDO::PARAM_STR);
            $cn->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $cn->bindParam(":precio",$datos['precio'],PDO::PARAM_STR);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();

            $cn=null;

        }

        static public function mdlMostrarTipoHab($tabla1,$item,$valor){

            if($item==null){

                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM tipo_habitacion"

                );

                $cn->execute();

                $datos=$cn->fetchAll();

                return $datos;

            }else{

                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM tipo_habitacion WHERE $item=:valor"

                );

                $cn->bindParam(":valor",$valor,PDO::PARAM_STR);

                $cn->execute();

                $dato=$cn->fetch();

                return $dato;

            }

        }

        static public function mdlMostrarDescuento($item,$valor){

            $cn=Conexion::Conectar()->prepare(

                "SELECT * FROM temporada WHERE TEMPORADA=:valor"

            );

            $cn->bindParam(":valor",$valor,PDO::PARAM_STR);

            $cn->execute();

            $dato=$cn->fetch();

            return $dato;

        }

        static public function mdlEditarTipoHabitacion($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "UPDATE tipo_habitacion 
                SET TIPO_HABITACION=:tipo_habitacion,DESCRIPCION=:descripcion,PRECIO=:precio 
                WHERE ID_TIPO_HABITACION=:id_tipo_habitacion"

            );

            $cn->bindParam(":tipo_habitacion",$datos['tipo_habitacion'],PDO::PARAM_STR);
            $cn->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $cn->bindParam(":precio",$datos['precio'],PDO::PARAM_STR);
            $cn->bindParam(":id_tipo_habitacion",$datos['id_tipo_habitacion'],PDO::PARAM_INT);       


            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();

            $cn=null;

        }

        static public function mdlEliminarTipoHabitacion($tabla1,$item,$valor){

            $cn=Conexion::Conectar()->prepare(

                "DELETE FROM tipo_habitacion WHERE $item=:valor"

            );

            $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();

            $cn=null;

        }

        static public function mdlMostrarTemporada($item){

            $cn=Conexion::Conectar()->prepare(

                "SELECT $item FROM temporada"

            );

            $cn->execute();

            $datos=$cn->fetchAll();

            return $datos;

        }

        static public function mdlEditarTemporada($tabla1,$datos){

            $valor1="";
            $valor2="";
            $valor3="";
            $valor4="";

            $id1=1;
            $id2=2;
            $id3=3;
            $id4=4;

            $cn=Conexion::Conectar()->prepare(

                "UPDATE temporada SET DESCUENTO=:primavera WHERE ID_TEMPORADA=:id_temporada"

            );

            $cn->bindParam(":primavera",$datos['primavera'],PDO::PARAM_STR);
            $cn->bindParam(":id_temporada",$id1,PDO::PARAM_INT);

            if($cn->execute()){

                $valor1="ok";

            }else{

                $valor1="error";

            }

            $cn2=Conexion::Conectar()->prepare(

                "UPDATE temporada SET DESCUENTO=:verano WHERE ID_TEMPORADA=:id_temporada2"

            );

            $cn2->bindParam(":verano",$datos['verano'],PDO::PARAM_STR);
            $cn2->bindParam(":id_temporada2",$id2,PDO::PARAM_INT);

            if($cn2->execute()){

                $valor2="ok";

            }else{

                $valor2="error";

            }

            $cn3=Conexion::Conectar()->prepare(

                "UPDATE temporada SET DESCUENTO=:otono WHERE ID_TEMPORADA=:id_temporada3"

            );

            $cn3->bindParam(":otono",$datos['otono'],PDO::PARAM_STR);
            $cn3->bindParam(":id_temporada3",$id3,PDO::PARAM_INT);

            if($cn3->execute()){

                $valor3="ok";

            }else{

                $valor3="error";

            }

            $cn4=Conexion::Conectar()->prepare(

                "UPDATE temporada SET DESCUENTO=:invierno WHERE ID_TEMPORADA=:id_temporada4"

            );

            $cn4->bindParam(":invierno",$datos['invierno'],PDO::PARAM_STR);
            $cn4->bindParam(":id_temporada4",$id4,PDO::PARAM_INT);

            if($cn4->execute()){

                $valor4="ok";

            }else{

                $valor4="error";

            }

            if($valor1=="ok" && $valor2=="ok" && $valor3=="ok" && $valor4=="ok"){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();
            $cn=null;

            $cn2->close();
            $cn2=null;

            $cn3->close();
            $cn3=null;

            $cn4->close();
            $cn4=null;


        }

    }










?>