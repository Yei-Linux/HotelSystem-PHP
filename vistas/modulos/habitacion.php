<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Habitaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Habitaciones</li>
    
    </ol>

  </section>

  <section class="content seccion">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnagregarHabitacion" idhotel="<?php echo $_SESSION['idHotel']; ?>" data-toggle="modal" data-target="#modalAgregarHabitacion">
          
          Agregar Habitacion

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Foto</th>
           <th>Piso</th>
           <th>Habitacion</th>
           <th>Tipo de Habitacion</th>
           <th>Numero de Camas</th>
           <th>Precio</th>
           <th>Descripcion</th>
           <th>Estado</th>
           <th>Acciones</th>


         </tr> 

        </thead>

        <tbody>

          <?php

            $item=null;
            $valor=null;
            $valor2=$_SESSION['idHotel'];

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

            $Habitaciones=ControladorHabitacion::ctrMostrarHabitacion($item,$valor,$valor2);

            foreach ($Habitaciones as $key => $value) {
              
              echo '<tr>

                      <td>'.($key+1).'</td>

                      <td><img src="'.$value['FOTO'].'" style="cursor:pointer;" 
                      class="img-thumbnail imagenMostrarHab" width="40px" 
                      data-toggle="modal" data-target="#modalVerHabitacion"></td>

                      <td>'.$value['PISO'].'</td>

                      <td>'.$value['NUMERO_HABITACION'].'</td>

                      <td>'.$value['TIPO_HABITACION'].'</td>

                      <td>'.$value['PLAZAS'].' camas</td>

                      <td> S/.'.$value['PRECIO']*($descuento['DESCUENTO']/100).'</td>

                      <td>'.$value['DESCRIPCION'].'</td>

                      <td>'.$value['NOMBRE_ESTADO'].'</td>

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btneditarHabitacion" style="background:#a7d129;border: 1px solid #a7d129"
                          data-toggle="modal" data-target="#modalEditarHabitacion"
                          id_editar_habitacion="'.$value['ID_HABITACION'].'"
                          idhotel="'.$value['ID_HOTEL'].'">

                            <i class="fa fa-pencil"></i>

                          </button>

                          <button class="btn btn-danger btneliminarHabitacion" 
                          id_eliminar_habitacion="'.$value['ID_HABITACION'].'"
                          ruta2="'.$value['NUMERO_HABITACION'].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>

                    </tr>';
            }

          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarHabitacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Habitacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NUMERO DE HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoNumHabitacion2" name="nuevoNumHabitacion2" placeholder="Numero de Habitacion" disabled required>

                <input type="hidden" id="nuevoNumHabitacion" name="nuevoNumHabitacion">

                <input type="hidden" value="<?php echo $_SESSION['idHotel']; ?>" name="idHotel">

              </div>
 
            </div>

            <!-- ENTRADA PARA EL PISO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPiso">
                  
                  <option value="">Selecionar Numero de Piso</option>
  
                  <?php

                    $item="ID_HOTEL";
                    $valor=$_SESSION['idHotel'];

                    $respuesta=ControladorIngreso::ctrMostrarPisos($item,$valor);

                    for ($i=0; $i < $respuesta['PISOS'] ; $i++) { 
                     
                      echo '<option value="'.($i+1).'">'.($i+1).'</option>';

                    }

                  ?>
                  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA LAS CAMAS-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCama" placeholder="Ingresar Numero de Camas" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DE HABITACION -->

            <div class="form-group">
              
              <div class="input-group"> 
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoTipoHabitacion">
                  
                  <option value="">Selecionar Tipo de Habitacion</option>

                  <option value="Habitación Individual">Habitación Individual</option>

                  <option value="Habitación Doble">Habitación Doble</option>

                  <option value="Habitación Familiar">Habitación Familiar</option>

                  <option value="Suite Individual">Suite Individual</option>

                  <option value="Suite Doble">Suite Doble</option>

                  <option value="Suite Familiar">Suite Familiar</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR ESTADO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoEstado">
                  
                  <option value="">Selecionar Estado</option>

                  <option value="Libre">Libre</option>

                  <option value="Ocupada">Ocupada</option>

                  <option value="Limpieza">Limpieza</option>

                  <option value="Mantenimiento">Mantenimiento</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
                <div class="panel">SUBIR FOTO</div>

                <input type="file" class="nuevaFotoHabitacion" name="nuevaFotoHabitacion">

                <p class="help-block">Peso máximo de la foto 200 MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarHabitacion" width="100px">

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" 
          style="background:#30e3ca;color:white;width:120.56px" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" style="background:#a7d129;border: 1px solid #a7d129">Guardar Habitacion</button>

        </div>

      </form>

       <?php

        $AgregarHabitacion=new ControladorHabitacion();

        $AgregarHabitacion->ctrAgregarHabitacion();

      ?>

    </div>

  </div>

</div>

<!--=====================================
      MODAL EDITAR HABITACION
======================================-->

<div id="modalEditarHabitacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Habitacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NUMERO DE HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNumeroHabitacion" name="editarNumeroHabitacion" placeholder="Numero de Habitacion" required>

                <input type="hidden" id="editIdHabitacion" name="editIdHabitacion">

                <input type="hidden" value="<?php echo $_SESSION['idHotel']; ?>" name="idHotel">

                <input type="hidden" id="editarOldNumeroHabitacion" name="editarOldNumeroHabitacion">

              </div>

            </div>

            <!-- ENTRADA PARA EL PISO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editarPiso" name="editarPiso">
                  
                  <option value="">Selecionar Numero de Piso</option>

                  <?php

                    $item="ID_HOTEL";
                    $valor=$_SESSION['idHotel'];

                    $respuesta=ControladorIngreso::ctrMostrarPisos($item,$valor);

                    for ($i=0; $i < $respuesta['PISOS'] ; $i++) { 
                     
                      echo '<option value="'.($i+1).'">'.($i+1).'</option>';

                    }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" placeholder="Ingresar Descripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA LAS CAMAS-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCamas" name="editarCamas" placeholder="Ingresar Numero de Camas" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DE HABITACION -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editarTipoHabitacion" name="editarTipoHabitacion">
                  
                  <option value="">Selecionar Tipo de Habitacion</option>

                  <option value="Habitación Individual">Habitación Individual</option>

                  <option value="Habitación Doble">Habitación Doble</option>

                  <option value="Habitación Familiar">Habitación Familiar</option>

                  <option value="Suite Individual">Suite Individual</option>

                  <option value="Suite Doble">Suite Doble</option>

                  <option value="Suite Familiar">Suite Familiar</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR ESTADO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editarEstado" name="editarEstado">
                  
                  <option value="">Selecionar Estado</option>

                  <option value="Libre">Libre</option>

                  <option value="Ocupada">Ocupada</option>

                  <option value="Limpieza">Limpieza</option>

                  <option value="Mantenimiento">Mantenimiento</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
                <div class="panel">SUBIR FOTO</div>

                <input type="file" id="editarFotoHabitacion" name="editarFotoHabitacion">

                <p class="help-block">Peso máximo de la foto 200 MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail editprevisualizarHabitacion" width="100px">

                <input type="hidden" id="fotoActualHabitacion" name="fotoActualHabitacion">

            </div>
  
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" 
          style="background:#30e3ca;color:white;width:120.56px" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" style="background:#a7d129;border: 1px solid #a7d129">Editar Habitacion</button>

        </div>

      </form>

      <?php

          $EditarHabitacion=new ControladorHabitacion();

          $EditarHabitacion -> ctrEditarHabitacion();

      ?>

    </div>

  </div>

</div>

<!--=====================================
        MODAL VER HABITACION
======================================-->

<div id="modalVerHabitacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Visualizar Habitacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group" style="display:flex;flex-direction:row;justify-content:center;">

                <img src="vistas/img/usuarios/default/anonymous.png" class="visualizandoHabitacion" width="90%" height="400px">

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" 
          style="background:#30e3ca;color:white;width:120.56px" data-dismiss="modal">Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php

  $EliminarHabitacion=new ControladorHabitacion();
  
  $EliminarHabitacion -> ctrEliminarHabitacion();


?>




