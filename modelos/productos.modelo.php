<?php

    class ModeloProducto{

        static public function mdlAgregarProducto($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO producto(DESCRIPCION,PRECIO,FOTO_PRODUCTO,RUTA_FOTOPRODUCTO2,ID_CATEGORIA)
                 VALUES(:descripcion,:precio,:foto,:foto2,:categoria)"

            );

            $cn->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $cn->bindParam(":precio",$datos['precio'],PDO::PARAM_STR);
            $cn->bindParam(":foto",$datos['foto_producto'],PDO::PARAM_STR);
            $cn->bindParam(":foto2",$datos['ruta_fotoproducto2'],PDO::PARAM_STR);
            $cn->bindParam(":categoria",$datos['id_categoria'],PDO::PARAM_INT);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();
            $cn=null;

        }

        static public function mdlMostrarProducto($tabla1,$item,$valor){

            if($item==null){

                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM producto AS p INNER JOIN categorias AS c 
                    ON P.ID_CATEGORIA=C.ID_CATEGORIA"

                );

                $cn->execute();

                $datos=$cn->fetchAll();

                return $datos;

            }else{

                $cn=Conexion::Conectar()->prepare(

                    "SELECT * FROM producto AS p INNER JOIN categorias AS c 
                    ON P.ID_CATEGORIA=C.ID_CATEGORIA WHERE $item=:valor"

                );

                $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

                $cn->execute();

                $dato=$cn->fetch();

                return $dato;

            }

            $cn->close();

            $cn=null;

        }
 
        static public function mdlEditarProducto($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "UPDATE producto SET DESCRIPCION=:descripcion,PRECIO=:precio,
                FOTO_PRODUCTO=:foto,RUTA_FOTOPRODUCTO2=:foto2,ID_CATEGORIA=:idCategoria
                WHERE ID_PRODUCTO=:id_prod"

            );

            $cn->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $cn->bindParam(":precio",$datos['precio'],PDO::PARAM_STR);
            $cn->bindParam(":foto",$datos['foto_producto'],PDO::PARAM_STR);
            $cn->bindParam(":foto2",$datos['ruta_fotoproducto2'],PDO::PARAM_STR);
            $cn->bindParam(":idCategoria",$datos['id_categoria'],PDO::PARAM_INT);
            $cn->bindParam(":id_prod",$datos['idProd'],PDO::PARAM_INT);

            if($cn->execute()){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();
            $cn=null;

        }

        static public function mdlVerificarProducto($tabla1){

            $cn=Conexion::Conectar()->prepare(

                "SELECT DESCRIPCION FROM producto"

            );

            $cn->execute();

            $datos=$cn->fetchAll();

            return $datos;

            $cn->close();

            $cn=null;

        }
        static public function mdlEliminarProducto($tabla1,$item,$valor){

            $cn=Conexion::Conectar()->prepare(

                "DELETE FROM producto WHERE $item=:valor"

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

        static public function mdlMostrarCategorias($tabla1){

            $cn=Conexion::Conectar()->prepare(

                "SELECT NOMBRE_CATEGORIA FROM categorias"

            );

            $cn->execute();

            $datos=$cn->fetchAll();

            return $datos;

            $cn->close();

            $cn=null;

        }


        static public function mdlEditarCategorias($tabla1,$datos){

            $valor1="";
            $valor2="";
            $valor3="";
            $valor4="";

            $id1=1;
            $id2=2;
            $id3=3;
            $id4=4;

            $cn=Conexion::Conectar()->prepare(

                "UPDATE categorias SET NOMBRE_CATEGORIA=:valor1 WHERE ID_CATEGORIA=:id1"

            );

            $cn->bindParam(":valor1",$datos['cat1'],PDO::PARAM_STR);
            $cn->bindParam(":id1",$id1,PDO::PARAM_INT);

            if($cn->execute()){

                $valor1="ok";

            }else{

                $valor1="error";

            }

            
            $cn2=Conexion::Conectar()->prepare(

                "UPDATE categorias SET NOMBRE_CATEGORIA=:valor2 WHERE ID_CATEGORIA=:id2"

            );

            $cn2->bindParam(":valor2",$datos['cat2'],PDO::PARAM_STR);
            $cn2->bindParam(":id2",$id2,PDO::PARAM_INT);

            if($cn2->execute()){

                $valor2="ok";

            }else{

                $valor2="error";

            }

            $cn3=Conexion::Conectar()->prepare(

                "UPDATE categorias SET NOMBRE_CATEGORIA=:valor3 WHERE ID_CATEGORIA=:id3"

            );

            $cn3->bindParam(":valor3",$datos['cat3'],PDO::PARAM_STR);
            $cn3->bindParam(":id3",$id3,PDO::PARAM_INT);

            if($cn3->execute()){

                $valor3="ok";

            }else{

                $valor3="error";

            }

            $cn4=Conexion::Conectar()->prepare(

                "UPDATE categorias SET NOMBRE_CATEGORIA=:valor4 WHERE ID_CATEGORIA=:id4"

            );

            $cn4->bindParam(":valor4",$datos['cat4'],PDO::PARAM_STR);
            $cn4->bindParam(":id4",$id4,PDO::PARAM_INT);

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

        static public function mdlActualizarProducto($tablaProductos, $item, $valor1,$valor2){

            $cn=Conexion::Conectar()->prepare(

                "UPDATE producto SET $item=:valor1 WHERE ID_PRODUCTO=:valor2"

            );

            $cn->bindParam(":valor1",$valor1,PDO::PARAM_INT);
            $cn->bindParam(":valor2",$valor2,PDO::PARAM_INT);

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