<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Recepcion de Ingreso
    
    </h1>
 
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Recepcion</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div id="header_recepcion" style="display: flex;flex-direction: row;justify-content: space-between;">
  
        <button class="btn btn-primary" style="background-color: #00faac;">
          
          Check In

        </button>

        <div id="lista_pisos" style="display: flex;flex-direction: row-reverse;"> 

          <?php

            $item="ID_HOTEL";
            $valor=$_SESSION['idHotel'];

            $respuesta=ControladorIngreso::ctrMostrarPisos($item,$valor);

            for ($i=0; $i < $respuesta['PISOS'] ; $i++) { 
             
              echo '<li class="item_piso" idHotel="'.$_SESSION['idHotel'].'" numPiso="'.($i+1).'">'.($i+1).'° <img src="vistas/img/plantilla/lad_sin.png" width="40px"></li>';

            }

          ?>
    
        </div>

      </div>

      <div class="box-body" style="height: 300px;">
        
        <div id="contenedor_habitaciones" style="display: flex;flex-wrap: wrap;"> 

  
        </div>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR INGRESO
======================================-->

<div id="Libre" class="modal fade" role="dialog">
  
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
              <input id="numHab" disabled>
            </div>

            <div>
              <h4>Numero de Piso : </h4>
              <img src="vistas/img/plantilla/lad_sin.png" 
              width="25px">
              <input id="numPiso" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Tipo de Habitacion : </h4>
              <img src="vistas/img/plantilla/tipo_hab1.png" 
              width="20px">
              <input id="tipoHab" disabled>
            </div>

            <div>
              <h4>Numero Camas : </h4>
              <img src="vistas/img/plantilla/hab_logo.png" 
              width="25px">
              <input id="numCamas" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">

            <div>
              <h4>Precio Habitacion x Dia:</h4>
              <img src="vistas/img/plantilla/precio.png" 
              width="20px">
              <input id="precio" disabled>
            </div>

            <div>
              <h4>Maximo de Personas: </h4>
              <img src="vistas/img/plantilla/cliente1.png" 
              width="20px">
              <input id="Max" disabled>
            </div>

          </div>

        </div>


        <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;
                   border-left: 3px solid #d2d6de;">

          <!-- ENTRADA PARA LOS NOMBRES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="DatosClienteIng" name="DatosClienteIng" placeholder="Nombres y Apellidos del Cliente" disabled required>
  
                <input type="hidden" id="idCliente" name="idCliente">

                <input type="hidden" id="idHabitacion" name="idHabitacion">

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="dniClienteIng" name="dniClienteIng" placeholder="Ingresar Dni" required>

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

<!--=====================================
MODAL AGREGAR INGRESO
======================================-->

<div id="Ocupada" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 900px;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalles del Ingreso</h4>

        </div>

        <div style="display: flex;flex-direction: row;flex-wrap: nowrap;"> 

          <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;">

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Numero de Habitacion : </h4>
              <img src="vistas/img/plantilla/logo.png" 
              width="25px">
              <input id="ocupadanumHab" disabled>
            </div>

            <div>
              <h4>Numero de Piso : </h4>
              <img src="vistas/img/plantilla/lad_sin.png" 
              width="25px">
              <input id="ocupadanumPiso" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Tipo de Habitacion : </h4>
              <img src="vistas/img/plantilla/tipo_hab1.png" 
              width="20px">
              <input id="ocupadatipoHab" disabled>
            </div>

            <div>
              <h4>Numero Camas : </h4>
              <img src="vistas/img/plantilla/hab_logo.png" 
              width="25px">
              <input id="ocupadanumCamas" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">

            <div>
              <h4>Precio Habitacion x Dia: </h4>
              <img src="vistas/img/plantilla/precio.png" 
              width="20px">
              <input id="ocupadaPrecio" disabled>
            </div>

            <div>
              <h4>Maximo de Personas: </h4>
              <img src="vistas/img/plantilla/cliente1.png" 
              width="20px">
              <input id="ocupadaMax" disabled>
            </div>

          </div>

        </div>


        <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;
                   border-left: 3px solid #d2d6de;">

          <!-- ENTRADA PARA LOS NOMBRES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ocupadaDatosClienteIng" name="DatosClienteIng" placeholder="Nombres y Apellidos del Cliente" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ocupadadniClienteIng" 
                placeholder="Ingresar Dni" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA FECHA FIN-->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ocupadafechaFin" placeholder="Ingresar fecha de salida" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE ADULTOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ocupadanumAdultos" disabled placeholder="Ingresar numero de Adultos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE NIÑOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="ocupadanumNinos" disabled placeholder="Ingresar numero de Niños" required>

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

<div id="Reservada" class="modal fade" role="dialog">
  
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