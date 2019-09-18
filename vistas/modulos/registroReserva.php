<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Reservas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Reservas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          
          Agregar nueva Reserva

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>F.Reserva</th>
           <th>F.Llegada</th>
           <th>N° Habitacion</th>
           <th>Cantidad Personas</th>
           <th>Empleado</th>
           <th>Acciones</th>

         </tr> 

        </thead>
 
        <tbody>

          <?php

              $item=null;
              $valor=null;
              $valor2=$_SESSION['idHotel'];
 
              $respuesta=ControladorReserva::ctrMostrarReservas($item,$valor,$valor2);

              foreach ($respuesta as $key => $value) {
                
                echo '<tr>

                        <td>'.($key+1).'</td>
                        <td>'.$value['NOMCLIENTE'].' / '.$value['DNI'].'</td>
                        <td>'.$value['FECHA_RESERVA'].'</td>
                        <td>'.$value['FECHA_LLEGADA'].'</td>
                        <td>'.$value['NUMERO_HABITACION'].'</td>
                        <td>Adultos: '.$value['CANTIDAD_ADULTOS'].' / Niños: '.$value['CANTIDAD_NINOS'].'</td>
                        <td>'.$value['NOMEMPLEADO'].'</td>

                        <td>

                          <div class="btn-group">

                            <button class="btn btn-warning btnMostrarDetalle" 
                            style="background:#a7d129;border: 1px solid #a7d129"
                            idReservaDetalle="'.$value['ID_RESERVA'].'"
                            data-toggle="modal" data-target="#DetalleReserva">
                              <i class="fa fa-pencil"></i>
                            </button>
                              
                            <button class="btn btn-warning btnReservaregIngreso" 
                            style="background:#00bdaa;border: 1px solid #00bdaa"
                            idReservaDetalleIng="'.$value['ID_RESERVA'].'"
                            data-toggle="modal" data-target="#ReservaregIngreso">
                              <i class="fa fa-gamepad"></i>
                            </button>

                            <button class="btn btn-danger btnEliminarReserva"
                            idReservaElim="'.$value['ID_RESERVA'].'"
                            idHabitacion="'.$value['ID_HABITACION'].'">
                              <i class="fa fa-times"></i>
                            </button>

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

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Registrar Reserva</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <?php

              date_default_timezone_set("America/Lima");

              $fecha=date('Y-m-d');

              $hora=date('H:i:s');

              $fechaReserva=$fecha . ' ' . $hora; 
          
          ?>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="reservaNombres" name="reservaNombres" placeholder="Ingresar Nombres del Cliente" disabled required>

                <input type="hidden" id="reservaidCliente" name="reservaidCliente">

              </div>

            </div>
 
            <!-- ENTRADA PARA EL DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="reservaDni" name="reservaDni" placeholder="Ingresar Dni del Cliente" required>

              </div>

            </div>

             <!-- ENTRADA PARA EL NUMERO HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="reservaHabitacion">
                
                  <option value="">Seleccionar Numero de Habitacion</option>

                      <?php

                        $item = null;
                        $valor = null;
                        $valor2=$_SESSION['idHotel'];

                        $clientes = ControladorHabitacion::ctrMostrarHabitacion($item,$valor,$valor2);

                         foreach ($clientes as $key => $value) {

                           echo '<option value="'.$value["ID_HABITACION"].'">'.$value["NUMERO_HABITACION"].'</option>';

                         }

                      ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE ADULTOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="reservaAdultos" placeholder="Ingresar Numero de Adultos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE NIÑOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="reservaNinos" placeholder="Ingresar Numero de Niños" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA EN LA QUE SE RESERVA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" value="<?php echo $fechaReserva; ?>" class="form-control input-lg" placeholder="Fecha en la que se Reserva" disabled required>

                <input type="hidden" value="<?php echo $fechaReserva; ?>" name="reservaFechaReg">

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA EN LA QUE LLEGGARA EL CLIENTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="reservaFechaLleg" placeholder="Fecha en la que llegara el cliente" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO HABITACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea name="reservaObservaciones" rows="5" class="form-control input-lg" placeholder="Ingresar Observaciones" required></textarea>

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
          style="background:#a7d129;border: 1px solid #a7d129">Registrar Reserva</button>

        </div>

      </form>

      <?php

          $AgregarReserva=new ControladorReserva();

          $AgregarReserva -> ctrAgregarReserva();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR INGRESO
======================================-->

<div id="DetalleReserva" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 900px;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalles de Reserva de la Habitacion <span id="ReservaNumHabitacion"></span></h4>

        </div>

        <div style="display: flex;flex-direction: row;flex-wrap: nowrap;"> 

          <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;">

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Empleado : </h4>
              <img src="vistas/img/plantilla/logo.png" 
              width="25px">
              <input id="nomEmp" disabled>
            </div>

            <div>
              <h4>Numero de Piso : </h4>
              <img src="vistas/img/plantilla/lad_sin.png" 
              width="25px">
              <input id="ReservanumPiso" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">

            <div>
              <h4>Numero Camas : </h4>
              <img src="vistas/img/plantilla/hab_logo.png" 
              width="25px">
              <input id="ReservanumCamas" disabled>
            </div>

            <div>
              <h4>Maximo de Personas: </h4>
              <img src="vistas/img/plantilla/cliente1.png" 
              width="20px">
              <input id="ReservaMax" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: center;">

            <div>
              <h4>Falta para que llegue el cliente : </h4>
              <img src="vistas/img/plantilla/precio.png" 
              width="20px">
              <input id="ReservaFechaDias" disabled>
            </div>

          </div>

        </div>


        <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;
                   border-left: 3px solid #d2d6de;">

          <!-- ENTRADA PARA LOS NOMBRES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ReservaNomCliente" placeholder="Nombres y Apellidos del Cliente" disabled required>
  
              </div>

            </div>

            <!-- ENTRADA PARA FECHA DE LLEGADA-->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ReserfechaReserva" placeholder="Ingresar fecha de salida" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE ADULTOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ReservanumAdultos" placeholder="Ingresar numero de Adultos" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE NIÑOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ReservanumNinos" placeholder="Ingresar numero de Niños" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA OBSERVACIONES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                 <textarea id="reservaObservaciones" rows="5" class="form-control input-lg" placeholder="Ingresar Observaciones" disabled required></textarea>

              </div>

            </div>


        </div>



        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer" style="background-color: #f9fd50;">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR INGRESO
======================================-->

<div id="ReservaregIngreso" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 900px;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Registro de Ingreso a una Habitacion</h4>

        </div>

        <div style="display: flex;flex-direction: row;flex-wrap: nowrap;"> 

          <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;">

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Numero de Habitacion : </h4>
              <img src="vistas/img/plantilla/logo.png" 
              width="25px">
              <input id="ReservanumHabIng" disabled>
            </div>

            <div>
              <h4>Numero de Piso : </h4>
              <img src="vistas/img/plantilla/lad_sin.png" 
              width="25px">
              <input id="ReservanumPisoIng" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Tipo de Habitacion : </h4>
              <img src="vistas/img/plantilla/tipo_hab1.png" 
              width="20px">
              <input id="ReservatipoHabIng" disabled>
            </div>

            <div>
              <h4>Numero Camas : </h4>
              <img src="vistas/img/plantilla/hab_logo.png" 
              width="25px">
              <input id="ReservanumCamasIng" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">

            <div>
              <h4>Precio Habitacion x Dia:</h4>
              <img src="vistas/img/plantilla/precio.png" 
              width="20px">
              <input id="ReservaprecioIng" disabled>
            </div>

            <div>
              <h4>Maximo de Personas: </h4>
              <img src="vistas/img/plantilla/cliente1.png" 
              width="20px">
              <input id="ReservaMaxIng" disabled>
            </div>

          </div>

        </div>


        <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;
                   border-left: 3px solid #d2d6de;">

          <!-- ENTRADA PARA LOS NOMBRES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="RIDatosClienteIng" name="DatosClienteIng" placeholder="Nombres y Apellidos del Cliente" disabled required>
  
                <input type="hidden" id="RIidCliente" name="idCliente">

                <input type="hidden" id="RIidHabitacion" name="idHabitacion">

                <input type="hidden" id="RIidReserva" name="idReserva">

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="RIdniClienteIng" name="dniClienteIng" placeholder="Ingresar Dni" required>

              </div>

            </div>

            <!-- ENTRADA PARA FECHA FIN-->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="fechaFin" placeholder="Ingresar fecha de salida" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE ADULTOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="numAdultos" placeholder="Ingresar numero de Adultos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE NIÑOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="numNinos" placeholder="Ingresar numero de Niños" required>

              </div>

            </div>

        </div>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer" style="background-color: #f9fd50;">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" 
          style="background:#a7d129;border: 1px solid #a7d129">Registrar Ingreso</button>

        </div>

      </form>

      <?php

        $RegistrarIngreso = new ControladorIngreso();
        $RegistrarIngreso -> ctrRegistrarIngreso();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarReserva=new ControladorReserva();

  $EliminarReserva -> ctrEliminarReserva();

?>
