<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Recepcion de Salidas o Anular Registros
    
    </h1>
 
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Salidas </li>
    
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

            $respuesta=ControladorSalida::ctrMostrarPisosSalida($item,$valor);

            for ($i=0; $i < $respuesta['PISOS'] ; $i++) { 
             
              echo '<li class="item_piso_Salida" idHotel="'.$_SESSION['idHotel'].'" numPiso="'.($i+1).'">'.($i+1).'° <img src="vistas/img/plantilla/lad_sin.png" width="40px"></li>';

            }

          ?>
    
        </div>

      </div>

      <div class="box-body" style="height: 300px;">
        
        <div id="contenedor_habitaciones" style="display: flex;flex-wrap: wrap;"> 

  
        </div>

      </div>

      <div class="box-header with-border temporadas" style="color:white;display:flex;flex-direction:row;justify-content:space-between;
      background-color:#32dbc6;">

        <p>

            <i class="fa fa-plane"></i>

            &nbsp

            <span>Leyenda de Emojis : </span> 

          </p>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalMostrarEmojiSalida">
          
          Ver Emojis por Salida

        </button>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL EDITAR TEMPORADAS
======================================-->

<div id="modalMostrarEmojiSalida" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Emoji de Acuerdo a la Fecha de Salida</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/feliz.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Feliz</span>

                <input type="text" id="putOtoño" name="putOtono" class="form-control input-lg" placeholder="Cliente se retira a la fecha" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/triste.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Triste</span>

                <input type="text" id="putVerano" name="putVerano" class="form-control input-lg" placeholder="Cliente se retira antes de la fecha" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/molesto.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Molesto</span>

                <input type="text" id="putPrimavera" name="putPrimavera" class="form-control input-lg" placeholder="Cliente se retira despues de la fecha" disabled required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR SALIDA
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
              <input id="SalidaocupadanumHab" disabled>
            </div>

            <div>
              <h4>Numero de Piso : </h4>
              <img src="vistas/img/plantilla/lad_sin.png" 
              width="25px">
              <input id="SalidaocupadanumPiso" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Tipo de Habitacion : </h4>
              <img src="vistas/img/plantilla/tipo_hab1.png" 
              width="20px">
              <input id="SalidaocupadatipoHab" disabled>
            </div>

            <div>
              <h4>Numero Camas : </h4>
              <img src="vistas/img/plantilla/hab_logo.png" 
              width="25px">
              <input id="SalidaocupadanumCamas" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">

            <div>
              <h4>Precio Habitacion x Dia: </h4>
              <img src="vistas/img/plantilla/precio.png" 
              width="20px">
              <input id="SalidaocupadaPrecio" disabled>
            </div>

            <div>
              <h4>Maximo de Personas: </h4>
              <img src="vistas/img/plantilla/cliente1.png" 
              width="20px">
              <input id="SalidaocupadaMax" disabled>
            </div>

          </div>

        </div>


        <div style="padding:15px;background-color: white;color: black;flex-basis: 50%;
                   border-left: 3px solid #d2d6de;">

          <!-- ENTRADA PARA LOS NOMBRES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="SalidaocupadaDatosClienteIng" name="DatosClienteIng" placeholder="Nombres y Apellidos del Cliente" disabled required>

                <input type="hidden" id="idHabitacionSalida" name="idHabitacionSalida">

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="SalidaocupadafechaInicio" 
                placeholder="Ingresar Dni" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA FECHA FIN-->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="SalidaocupadafechaFin" placeholder="Ingresar fecha de salida" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE ADULTOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="SalidaocupadanumAdultos" disabled placeholder="Ingresar numero de Adultos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DE NIÑOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="SalidaocupadanumNinos" disabled placeholder="Ingresar numero de Niños" required>

              </div>

            </div>


        </div>



        </div>

        <div style="display: flex;flex-direction: row;flex-wrap: nowrap;justify-content:space-around;
                    border-top: 3px solid #d2d6de;padding-top:15px;"> 

            <!-- FECHA SALIDA -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon" style="font-size:1.2em;"><i class="fa fa-th"></i> &nbsp Fecha Salida : </span> 

                <input type="text" class="form-control input-lg fechaSalida"  disabled>

                <input type="hidden" class="fechaSalida" name="fechaSalida">

              </div>

            </div>

            <!-- HORA SALIDA -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon" style="font-size:1.2em;"><i class="fa fa-th"></i> &nbsp Hora Salida : </span> 

                <input type="text" class="form-control input-lg horaSalida" placeholder="Hora Salida" disabled required>

                <input type="hidden" class="horaSalida" name="horaSalida">

              </div>

            </div>

        </div>

        <div style="display: flex;flex-direction: row;flex-wrap: nowrap;justify-content:space-around;"> 
            
            <!-- DIAS DE HOSPEDAJE -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon" style="font-size:1.2em;"><i class="fa fa-th"></i> &nbsp # de Dias Hosp : </span> 

                <input type="text" class="form-control input-lg cantDias" placeholder="Cantidad de Dias" disabled required>

                <input type="hidden" class="cantDias" name="cantDias">

              </div>

            </div>

            <!-- CANTIDAD ADICIONAL A PAGAR -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon" style="font-size:1.2em;"><i class="fa fa-th"></i> &nbsp Cant. Adicional : </span> 

                <input type="text" class="form-control input-lg costoAdicional" placeholder="Costo Adicional" disabled required>

                <input type="hidden" class="costoAdicional" name="costoAdicional">

              </div>

            </div>

        </div>


        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer pie" style="background-color: #f9fd50;">

        <button type="submit" class="btn btn-primary pull-left" 
         style="background:#30e3ca;color:white;">Anular Habitacion Ocupada</button>

         <img id="imagenSalida" alt="" width="40px">

        <button type="button" 
        nombres="" fechaSalida="" numHab="" fechaInicio="" numAdul="" numNinos="" horaSalida="" precioHab="" cantAd="" idHab="" cantDias="" idHosp=""
        class="btn btn-primary btnGenerarComprobante" data-toggle="modal" data-target="#Comprobante" 
          style="background:#a7d129;border: 1px solid #a7d129">Procesar Comprobante</button>

        </div>

      </form>

      <?php

          $AnularHospedaje= new ControladorSalida();

          $AnularHospedaje -> ctrAnularHabitacion();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="Comprobante" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 900px;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generando Comprobante</h4>

        </div>

        <div style="padding:15px;background-color: white;color: black;">

         
          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: start;"> 
            <!-- ENTRADA PARA EL NOMBRE -->
            

              
              <div class="input-group" style="width:100%;">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="compNombres" placeholder="Ingresar Nombre" disabled required>

              </div>


          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">
            
            <div>
              <h4>Tipo de Comprobante : </h4>
              <img src="vistas/img/plantilla/boleta.png" 
              width="20px">
              <select id="tipoComp" name="tipoComp">
                   
                  <option value="">Selecionar Tipo de Comprobante</option>

                  <option value="Boleta">Boleta</option>

                  <option value="Factura">Factura</option>

                </select>
            </div>

            <div>
              <h4>Comprobante Serie : </h4>
              <img src="vistas/img/plantilla/boleta2.png" 
              width="25px">
              <input type="text" id="serieComp" name="serieComp" required>
            </div>

             <div>
              <h4>Comprobante Numero : </h4>
              <img src="vistas/img/plantilla/boleta3.png" 
              width="25px">
              <input type="text" id="numeroComp" name="numeroComp" required>
            </div>

             <div>
              <h4>Fecha Venta : </h4>
              <img src="vistas/img/plantilla/fecha.png" 
              width="25px">
              <input id="compFechaVenta" name="compFechaVenta" disabled>
            </div>

          </div>

          <div class="infoRegIng" style="padding: 15px;display: flex;flex-direction: row;justify-content: space-between;">

            <div>
              <h4>Tipo de Pago : </h4>
              <img src="vistas/img/plantilla/billete.png" 
              width="20px">
              <select id="tipoPagoComp" name="tipoPagoComp" style="width:217px;">
                  
                  <option value="">Selecionar Tipo de Pago</option>

                  <option value="Efectivo">Efectivo</option>

                  <option value="Deposito Bancario">Deposito Bancario</option>

                  <option value="Tarjeta Credito">Tarjeta Credito</option>

                  <option value="Tarjeta Debito">Tarjeta Debito</option>

                </select>
            </div>

            <div>
              <h4>Observacion (Opcional) : </h4>
              <img src="vistas/img/plantilla/observaciones.png" 
              width="20px">
              <input type="text" id="observacionesComp" name="observacionesComp" style="width:550px;"placeholder="Escriba sus observaciones...">

              <input type="hidden" id="montoComp" name="montoComp">

              <input type="hidden" id="idHabComp" name="idHabComp">
              <input type="hidden" id="idHospedajeComp" name="idHospedajeComp">
              <input type="hidden" id="cantDiasComp" name="cantDiasComp">
              <input type="hidden" id="horaSalidaComp" name="horaSalidaComp">
              <input type="hidden" id="fechaSalidaComp" name="fechaSalidaComp">
              <input type="hidden" id="totalCompPagar" name="totalCompPagar">
              <input type="hidden" id="costoAdicionalComp" name="costoAdicionalComp">

            </div>

          </div>

        </div>


        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive">
         
        <thead>
         
         <tr style="background:#00bdaa;color:white;">
           
           <th style="width:10px">#</th>
           <th>Descripcion</th>
           <th>Precio</th>
           <th>Cantidad</th>
           <th>Total</th>

         </tr> 

        </thead>

        <tbody>
            

            <?php

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

            ?>
                
            <tr>

                      <td>1</td>

                      <td id="descripcionHabComp"></td>

                      <td id="precioHabComp"></td>

                      <td id="cantHabComp"></td>

                      <td id="totalHabComp"></td>

            </tr>

            <tr>

                      <td>2</td>

                      <td>Costo Adicional</td>

                      <td id="precioAdicionalComp"></td>

                      <td>1</td>

                      <td id="totalPrecioAdComp"></td>

            </tr>


            <tr>

                      <td>3</td>

                      <td>Descuento por Temporada de <?php echo $temporada ?></td>

                      <input type="hidden" id="desHide" value="<?php echo $descuento['DESCUENTO'] ?>">

                      <td id="descuentoComp"></td>

                      <td id="cantDescComp"></td>

                      <td id="totalDescComp"></td>

            </tr>

            <tr>

                      <td>4</td>

                      <td>Pago Pendiente por Consumo en Tienda y Servicios</td>

                      <td id="precioTiendaComp">0</td>

                      <td>1</td>

                      <td id="totalPrecioTiendaComp">0</td>

            </tr>

        </tbody>

       </table>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer pie_Factura" style="background-color: #f9fd50;">

        <button type="button" class="btn btn-default pull-left" 
          data-dismiss="modal" numeroFac
          nombres="" fechaSalida="" numHab="" fechaInicio="" horaSalida="" precioHab="" cantAd="" cantDias="" empleado="<?php echo $_SESSION['nombres'] ?>"
          cantPersonas=""
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

         <h4 style="display:inline-block;color:gray;">Total a Cobrar : S/. </h4>
         <input disabled height="50px" id="totalCobrarComp" name="totalCobrarComp" 
          style="text-align:center;">

        <button type="submit" class="btn btn-primary btnGenerarFactura" 
          nombres="" fechaSalida="" numHab="" fechaInicio="" horaSalida="" precioHab="" cantAd="" cantDias="" empleado="<?php echo $_SESSION['nombres'] ?>"
          cantPersonas=""
          style="background:#a7d129;border: 1px solid #a7d129">Cobrar y Registrar Salida</button>

        </div>

      </form>

      <?php

        $RegistrarSalida=new ControladorSalida();

        $RegistrarSalida -> ctrRegistrarSalida();

      ?>

    </div>

  </div>

</div>
