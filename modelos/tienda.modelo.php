<?php

    class ModeloTienda{

        static public function mdlAgregarVenta($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO consumo(SUBTOTAL,ID_DETALLE_HOSPEDAJE_HAB,PRODUCTOS,ID_EMPLEADO) 
                 VALUES(:total,(SELECT ID_DETALLE_HOSPEDAJE_HAB FROM detalle_hospedaje_hab as det 
                 INNER JOIN hospedaje as h ON
                 det.ID_HOSPEDAJE=h.ID_HOSPEDAJE 
                 WHERE 
                 det.ESTADO_HOSPEDAJE='Ocupada' AND h.ID_CLIENTE=:id_cliente),:productos,:id_emp)"

            );

            $cn->bindParam(":total",$datos['nuevoTotalVenta'],PDO::PARAM_STR);
            $cn->bindParam(":id_cliente",$datos['idCliente'],PDO::PARAM_INT);
            $cn->bindParam(":productos",$datos['listaProductos'],PDO::PARAM_STR);
            $cn->bindParam(":id_emp",$datos['idEmp'],PDO::PARAM_INT);

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