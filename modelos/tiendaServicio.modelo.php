 <?php

    class ModeloTiendaServicio{

        static public function mdlAgregarVentaServicio($tabla1,$datos){

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO detalle_servicio(SUBTOTAL,ID_DETALLE_HOSPEDAJE_HAB,SERVICIOS,ID_EMPLEADO) 
                 VALUES(:total,(SELECT ID_DETALLE_HOSPEDAJE_HAB FROM detalle_hospedaje_hab as det 
                 INNER JOIN hospedaje as h ON
                 det.ID_HOSPEDAJE=h.ID_HOSPEDAJE 
                 WHERE 
                 det.ESTADO_HOSPEDAJE='Ocupada' AND h.ID_CLIENTE=:id_cliente),:servicios,:id_emp)"

            );

            $cn->bindParam(":total",$datos['nuevoTotalVenta'],PDO::PARAM_STR);
            $cn->bindParam(":id_cliente",$datos['idCliente'],PDO::PARAM_INT);
            $cn->bindParam(":servicios",$datos['listaServicios'],PDO::PARAM_STR);
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