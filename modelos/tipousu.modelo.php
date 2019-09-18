<?php

    class ModeloTipoUsu{

        static public function mdlAgregarTipoUsu($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO tipo_usuario(NOM_TIPO_USU,DESCRIPCION) VALUES(:tipo_usu,:descripcion)"

            );

            $cn->bindParam(":tipo_usu",$datos["tipo_usu"],PDO::PARAM_STR);
            $cn->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();

            $cn=null;


        }

        static public function mdlMostrarTipoUsu($item,$valor){

            if($item==null){

                $cn=Conexion::Conectar()->prepare(


                    "SELECT * FROM tipo_usuario"


                );

                $cn->execute();

                $datos=$cn->fetchAll();

                return $datos;

            }else{


                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM tipo_usuario WHERE $item=:valor"

                );

                $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

                $cn->execute();

                $dato=$cn->fetch();

                return $dato;

            }

        }

        static public function mdlEditarTipoUsu($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "UPDATE tipo_usuario SET NOM_TIPO_USU=:tipo_usu,DESCRIPCION=:descripcion 
                WHERE ID_TIPO_USU=:id_tipo_usu"

            );

            $cn->bindParam(":tipo_usu",$datos['tipo_usu'],PDO::PARAM_STR);
            $cn->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $cn->bindParam(":id_tipo_usu",$datos['id_tipo_usu'],PDO::PARAM_INT);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();

            $cn=null;

        }

        static public function mdlEliminarTipoUsu($item,$valor){

            $cn=Conexion::Conectar()->prepare(

                "DELETE FROM tipo_usuario WHERE $item= :valor"

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