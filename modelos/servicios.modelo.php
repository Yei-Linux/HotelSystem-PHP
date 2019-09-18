<?php

    class ModeloServicio{

        static public function mdlAgregarServicio($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO servicio(SERVICIO,DESCRIPCION,PRECIO) VALUES(:servicio,:descripcion,:precio)"

            );

            $cn->bindParam(":servicio",$datos['servicio'],PDO::PARAM_STR);
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

        static public function mdlMostrarServicio($item,$valor){

            if($item==null){

                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM servicio"

                );

                $cn->execute();

                $datos=$cn->fetchAll();

                return $datos;


            }else{

                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM servicio WHERE $item=:valor"

                );

                $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

                $cn->execute();

                $dato=$cn->fetch();

                return $dato;
            }

            $cn->close();
            $cn=null;

        }

        static public function mdlEditarServicio($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "UPDATE servicio  
                SET SERVICIO=:servicio,DESCRIPCION=:descripcion,PRECIO=:precio
                WHERE ID_SERVICIO=:idServ"

            );

            $cn->bindParam(":servicio",$datos['servicio'],PDO::PARAM_STR);
            $cn->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $cn->bindParam(":precio",$datos['precio'],PDO::PARAM_STR);

            $cn->bindParam(":idServ",$datos['idServ'],PDO::PARAM_INT);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();
            $cn=null;

        }

        static public function mdlEliminarServicio($tabla1,$item,$valor){

            $cn=Conexion::Conectar()->prepare(

                "DELETE FROM servicio WHERE $item=:valor"

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

    }

?>