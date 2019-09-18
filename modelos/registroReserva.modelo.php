<?php

    class ModeloReserva{

        static public function  mdlAgregarReserva($tabla1,$datos){

            $idEstado=5;
            $valor1="";
            $valor2="";

            $cn=Conexion::Conectar()->prepare(

                "INSERT INTO reserva(FECHA_RESERVA,FECHA_LLEGADA,CANTIDAD_NINOS,CANTIDAD_ADULTOS,
                ESTADO_RESERVA,OBSERVACIONES,ID_CLIENTE,ID_EMPLEADO,ID_HABITACION) 
                VALUES(:fechaReserva,:fechaLlegada,:cantNinos,:cantAdultos,:estadoReserva,
                :observaciones,:id_cliente,:id_empleado,:id_habitacion)"

            );

            $cn->bindParam(":fechaReserva",$datos['FechaReg'],PDO::PARAM_STR);
            $cn->bindParam(":fechaLlegada",$datos['FechaLleg'],PDO::PARAM_STR);
            $cn->bindParam(":cantNinos",$datos['numNinos'],PDO::PARAM_STR);
            $cn->bindParam(":cantAdultos",$datos['numAdultos'],PDO::PARAM_STR);
            $cn->bindParam(":estadoReserva",$datos['estadoReserva'],PDO::PARAM_STR);
            $cn->bindParam(":observaciones",$datos['Observaciones'],PDO::PARAM_STR);
            $cn->bindParam(":id_cliente",$datos['idCliente'],PDO::PARAM_INT);
            $cn->bindParam(":id_empleado",$datos['idEmpleado'],PDO::PARAM_INT);
            $cn->bindParam(":id_habitacion",$datos['habitacion'],PDO::PARAM_INT);

            if($cn->execute()){

                $valor1="ok";

            }else{

                $valor1="error";

            }

            $cn2=Conexion::Conectar()->prepare(

                    "UPDATE habitacion SET ID_ESTADO=:estado WHERE ID_HABITACION=:idHab"

            );

            $cn2->bindParam(":estado",$idEstado,PDO::PARAM_INT);
            $cn2->bindParam(":idHab",$datos['habitacion'],PDO::PARAM_INT);
            
            if($cn2->execute()){

                $valor2="ok";

            }else{

                $valor2="error";

            }

            if($valor1=="ok" && $valor2=="ok"){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();
            $cn=null;

            $cn2->close();
            $cn2=null;

        }
 
        static public function mdlMostrarReservas($tabla1,$tabla2,$tabla3,$tabla4,$tabla5,$item,$valor,$valor2){

            $estadoReserva="Reservado";

            if($item==null){

                $cn=Conexion::Conectar()->prepare(

                    "SELECT r.ID_RESERVA,
                    CONCAT(per.APELLIDO_PATERNO,' ',per.APELLIDO_MATERNO,' ',per.NOMBRE) 
                    as NOMCLIENTE,h.ID_HABITACION,
                    per.DNI,r.FECHA_RESERVA,r.FECHA_LLEGADA,h.NUMERO_HABITACION,r.CANTIDAD_ADULTOS,
                    r.CANTIDAD_NINOS, 
                    CONCAT(pe.APELLIDO_PATERNO,' ',pe.APELLIDO_MATERNO,' ',pe.NOMBRE) as NOMEMPLEADO
                    FROM habitacion as h INNER JOIN reserva as r on h.ID_HABITACION=r.ID_HABITACION
                    INNER JOIN cliente as c ON r.ID_CLIENTE=c.ID_CLIENTE INNER JOIN persona as per
                    ON c.ID_PERSONA=per.ID_PERSONA INNER JOIN empleado as e ON r.ID_EMPLEADO=e.ID_EMPLEADO
                    INNER JOIN persona as pe ON e.ID_PERSONA=pe.ID_PERSONA
                    WHERE ESTADO_RESERVA=:valor AND h.ID_HOTEL=:valor2"

                );

                $cn->bindParam(":valor",$estadoReserva,PDO::PARAM_STR);

                $cn->bindParam(":valor2",$valor2,PDO::PARAM_INT);

                $cn->execute();

                $datos=$cn->fetchAll();

                return $datos;

            }else{

                 $cn=Conexion::Conectar()->prepare(

                    "SELECT r.ID_RESERVA,h.PISO,h.PLAZAS,r.OBSERVACIONES,per.DNI,'' as DIFERENCIA_DIAS,
                    CONCAT(per.APELLIDO_PATERNO,' ',per.APELLIDO_MATERNO,' ',per.NOMBRE) 
                    as NOMCLIENTE,tipo_hab.PRECIO,tipo_hab.TIPO_HABITACION,
                    c.ID_CLIENTE,h.ID_HABITACION,
                    per.DNI,r.FECHA_RESERVA,r.FECHA_LLEGADA,h.NUMERO_HABITACION,r.CANTIDAD_ADULTOS,
                    r.CANTIDAD_NINOS, 
                    CONCAT(pe.APELLIDO_PATERNO,' ',pe.APELLIDO_MATERNO,' ',pe.NOMBRE) as NOMEMPLEADO
                    FROM tipo_habitacion as tipo_hab INNER JOIN  
                    habitacion as h ON tipo_hab.ID_TIPO_HABITACION=h.ID_TIPO_HABITACION
                    INNER JOIN reserva as r on h.ID_HABITACION=r.ID_HABITACION
                    INNER JOIN cliente as c ON r.ID_CLIENTE=c.ID_CLIENTE INNER JOIN persona as per
                    ON c.ID_PERSONA=per.ID_PERSONA INNER JOIN empleado as e ON r.ID_EMPLEADO=e.ID_EMPLEADO
                    INNER JOIN persona as pe ON e.ID_PERSONA=pe.ID_PERSONA
                    WHERE $item=:valor" 

                );

                $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

                $cn->execute();

                $dato=$cn->fetch();

                return $dato;

            }

            $cn->close();
            $cn=null;

        }

        static public function mdlMostrarReservasForIng($tabla1,$tabla2,$tabla3,$tabla4,$tabla5,$item,$valor,$valor2){

            $estadoReserva="Reservado";

            if($item==null){

                $cn=Conexion::Conectar()->prepare(

                    "SELECT r.ID_RESERVA,
                    CONCAT(per.APELLIDO_PATERNO,' ',per.APELLIDO_MATERNO,' ',per.NOMBRE) 
                    as NOMCLIENTE,h.ID_HABITACION,
                    per.DNI,r.FECHA_RESERVA,r.FECHA_LLEGADA,h.NUMERO_HABITACION,r.CANTIDAD_ADULTOS,
                    r.CANTIDAD_NINOS, 
                    CONCAT(pe.APELLIDO_PATERNO,' ',pe.APELLIDO_MATERNO,' ',pe.NOMBRE) as NOMEMPLEADO
                    FROM habitacion as h INNER JOIN reserva as r on h.ID_HABITACION=r.ID_HABITACION
                    INNER JOIN cliente as c ON r.ID_CLIENTE=c.ID_CLIENTE INNER JOIN persona as per
                    ON c.ID_PERSONA=per.ID_PERSONA INNER JOIN empleado as e ON r.ID_EMPLEADO=e.ID_EMPLEADO
                    INNER JOIN persona as pe ON e.ID_PERSONA=pe.ID_PERSONA
                    WHERE ESTADO_RESERVA=:valor AND h.ID_HOTEL=:valor2"

                );

                $cn->bindParam(":valor",$estadoReserva,PDO::PARAM_STR);

                $cn->bindParam(":valor2",$valor2,PDO::PARAM_INT);

                $cn->execute();

                $datos=$cn->fetchAll();

                return $datos;

            }else{

                 $cn=Conexion::Conectar()->prepare(

                    "SELECT r.ID_RESERVA,h.PISO,h.PLAZAS,r.OBSERVACIONES,per.DNI,'' as DIFERENCIA_DIAS,
                    CONCAT(per.APELLIDO_PATERNO,' ',per.APELLIDO_MATERNO,' ',per.NOMBRE) 
                    as NOMCLIENTE,tipo_hab.PRECIO,tipo_hab.TIPO_HABITACION,
                    c.ID_CLIENTE,h.ID_HABITACION,
                    per.DNI,r.FECHA_RESERVA,r.FECHA_LLEGADA,h.NUMERO_HABITACION,r.CANTIDAD_ADULTOS,
                    r.CANTIDAD_NINOS, 
                    CONCAT(pe.APELLIDO_PATERNO,' ',pe.APELLIDO_MATERNO,' ',pe.NOMBRE) as NOMEMPLEADO
                    FROM tipo_habitacion as tipo_hab INNER JOIN  
                    habitacion as h ON tipo_hab.ID_TIPO_HABITACION=h.ID_TIPO_HABITACION
                    INNER JOIN reserva as r on h.ID_HABITACION=r.ID_HABITACION
                    INNER JOIN cliente as c ON r.ID_CLIENTE=c.ID_CLIENTE INNER JOIN persona as per
                    ON c.ID_PERSONA=per.ID_PERSONA INNER JOIN empleado as e ON r.ID_EMPLEADO=e.ID_EMPLEADO
                    INNER JOIN persona as pe ON e.ID_PERSONA=pe.ID_PERSONA
                    WHERE h.ID_HABITACION=:valor AND r.ESTADO_RESERVA='Reservado'" 

                );

                $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

                $cn->execute();

                $dato=$cn->fetch();

                return $dato;

            }

            $cn->close();
            $cn=null;

        }

        static public function mdlEliminarReserva($tabla1,$item,$valor,$valor2){

            $idEstadoReserva=1;
            $Rvalor1="";
            $Rvalor2="";

            $cn=Conexion::Conectar()->prepare(

                "DELETE FROM reserva WHERE $item=:valor"

            );

            $cn->bindParam(":valor",$valor,PDO::PARAM_INT);

            if($cn->execute()){

                $Rvalor1="ok";

            }else{

                $Rvalor1="error";

            }
            
            $cn2=Conexion::Conectar()->prepare(

                "UPDATE habitacion SET ID_ESTADO=:estado WHERE ID_HABITACION=:idHab"

            );

            $cn2->bindParam(":estado",$idEstadoReserva,PDO::PARAM_INT);
            $cn2->bindParam(":idHab",$valor2,PDO::PARAM_INT);
            
            if($cn2->execute()){

                $Rvalor2="ok";

            }else{

                $Rvalor2="error";

            }

            if($Rvalor1=="ok" && $Rvalor2=="ok"){

                return "ok";

            }else{

                return "error";

            }

            $cn->close();
            $cn=null;

            $cn2->close();
            $cn2=null;

        }

    }

?>