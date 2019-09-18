<?php

        require_once '../controladores/registroIngreso.controlador.php';
  
        require_once '../modelos/registroIngreso.modelo.php';

        require_once '../modelos/conexion.modelo.php';

        $item="PISO";
        $valor=$_REQUEST['numeroPiso'];

        $respuesta=ControladorIngreso::ctrMostrarHabitaciones($item,$valor);

        foreach ($respuesta as $key => $value) {
                  
                echo '<div class="tarjetas-hab"> 
              
                          <div class="uno '.$value['NOMBRE_ESTADO'].'1" style="display: flex;justify-content: center;align-items: center;">
                              
                              <img src="vistas/img/plantilla/hab_logo.png" width="50px">

                          </div>
                        
                          <div class="dos '.$value['NOMBRE_ESTADO'].'2"> 
                            
                            <p>'.$value['TIPO_HABITACION'].'</p>
                            <p>S/.'.$value['PRECIO'].'</p>
                            <h4>Hab '.$value['NUMERO_HABITACION'].'</h4>

                          </div>

                      </div>';

        }

?>