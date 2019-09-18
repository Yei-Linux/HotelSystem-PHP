<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Tipo Habitacion
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Tipo Habitacion</li>
    
    </ol>

  </section>
 
  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoHab">
          
          Agregar Tipo de Habitacion

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Icono</th>
           <th>Tipo de Habitacion</th>
           <th>Descripcion</th>
           <th>Precio</th>
           <th>Descuento</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
            <?php

                $item=null;
                $valor=null;

                $tipo_habitacion="";

                $temporada=null;

                date_default_timezone_set("America/Lima");

                $fecha=date('m');

                if($fecha=="03" || $fecha=="04" ||$fecha=="05"){

                    $temporada="Otoño";

                }else{

                    if($fecha=="06" || $fecha=="07" ||$fecha=="08"){

                        $temporada="Invierno";

                    }else{

                        if($fecha=="09" || $fecha=="10" ||$fecha=="11"){

                            $temporada="Primavera";

                        }else{

                            if($fecha=="12" || $fecha=="01" ||$fecha=="02"){

                                $temporada="Verano";

                            }

                        }  

                    }

                }

                $descuento=ControladorTipoHab::ctrMostrarDescuento($temporada);

                $tipo_habitaciones=ControladorTipoHab::ctrMostrarTipoHab($item,$valor);

                foreach ($tipo_habitaciones as $key => $value) {

                    if($key%2==0){

                      $tipo_habitacion="tipo_hab1";

                    }else{

                      $tipo_habitacion="tipo_hab2";

                    }
                
                    echo ' 
                        <tr>
 
                            <td>'.($key+1).'</td>

                            <td><img src="vistas/img/plantilla/'.$tipo_habitacion.'.png" class="img-thumbnail" width="40px"></td>

                            <td>'.$value['TIPO_HABITACION'].'</td>
                            
                            <td>'.$value['DESCRIPCION'].'</td>

                            <td> S/.'.$value['PRECIO'].'</td>

                            <td>'.$descuento['DESCUENTO'].' % </td>

                            <td>

                                <div class="btn-group">
                            
                                    <button class="btn btn-warning btneditarTipoHab"  
                                    style="background:#a7d129;border: 1px solid #a7d129"
                                    data-toggle="modal" data-target="#modalEditarTipoHab"
                                    id_tipo_habitacion="'.$value['ID_TIPO_HABITACION'].'">
                                        <i class="fa fa-pencil" ></i>
                                    </button>

                                    <button class="btn btn-danger btneliminarTipoHab"
                                    id_elim_tipo_habitacion="'.$value['ID_TIPO_HABITACION'].'">
                                        <i class="fa fa-times"></i>
                                    </button>

                                </div>  

                             </td>

                        </tr>
                    ';
                }

            ?>
                          
        </tbody>

       </table>

      </div>

      <div class="box-header with-border temporadas" style="color:white;display:flex;flex-direction:row;justify-content:space-between;
      background-color:#32dbc6;">

        <p>

            <i class="fa fa-plane"></i>

            &nbsp

            <span>Descuento por Temporada : </span> 

          </p>
  
        <button class="btn btn-primary btnverTemporada" temporada="enviar" data-toggle="modal" data-target="#modalMostrarDescuento">
          
          Ver Descuento por Temporada

        </button>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL EDITAR TEMPORADAS
======================================-->

<div id="modalMostrarDescuento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Descuento por Temporada</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL TIPO_ DE HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/invierno.png"></img></span>

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Invierno</span>

                <input type="text" id="putInvierno" name="putInvierno" class="form-control input-lg habil" placeholder="Descuento" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/otoño.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Otoño</span>

                <input type="text" id="putOtoño" name="putOtono" class="form-control input-lg habil2" placeholder="Descuento" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/verano.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Verano</span>

                <input type="text" id="putVerano" name="putVerano" class="form-control input-lg habil3" placeholder="Descuento" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/primavera.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Primavera</span>

                <input type="text" id="putPrimavera" name="putPrimavera" class="form-control input-lg habil4" placeholder="Descuento" disabled required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer footer">

          <button type="button" class="btn btn-default pull-left habilitar" 
          style="background:#30e3ca;color:white;width:120.56px">Habilitar</button>

          <button type="submit" class="btn btn-primary Editar" 
          style="background:#a7d129;border: 1px solid #a7d129" disabled>Editar</button>

        </div>

      </form>

      <?php

        $EditarTemporada=new ControladorTipoHab();

        $EditarTemporada -> ctrEditarTemporada();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarTipoHab" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tipo de Habitacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL TIPO_ DE HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTipoHabitacion" placeholder="Ingresar Tipo de Habitacion" required>

              </div>

            </div>
 
            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea name="nuevaDescripcion" rows="5" class="form-control input-lg" placeholder="Ingresar Descripcion" required></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPrecio" placeholder="Ingresar Precio del tipo de Habitacion" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" 
          style="background:#a7d129;border: 1px solid #a7d129">Guardar Tipo de Habitacion</button>

        </div>

      </form>

      <?php

            $AgregarTipoHab=new ControladorTipoHab();

            $AgregarTipoHab -> ctrAgregarTipoHab();


      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SEDE
======================================-->

<div id="modalEditarTipoHab" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tipo de Habitacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL TIPO_ DE HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editTipoHabitacion" name="editTipoHabitacion" placeholder="Ingresar Tipo de Habitacion" required>

                <input type="hidden" id="editidTipoHab" name="editidTipoHab">

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea id="editDescripcion" name="editDescripcion" rows="5" class="form-control input-lg" placeholder="Ingresar Descripcion" required></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editPrecio" name="editPrecio" placeholder="Ingresar Precio del tipo de Habitacion" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" 
          style="background:#a7d129;border: 1px solid #a7d129">Editar Tipo de Habitacion</button>

        </div>

      </form>

      <?php

          $EditarTipoHabitacion=new ControladorTipoHab();

          $EditarTipoHabitacion -> ctrEditarTipoHabitacion();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarTipoHabitacion=new ControladorTipoHab();

  $EliminarTipoHabitacion -> ctrEliminarTipoHabitacion();


?>



