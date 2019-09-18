<div class="content-wrapper">

  <!--=====================================
            HEADER CLIENTES
  ======================================-->

  <section class="content-header">
    
    <h1>
      
      Administrar Clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Clientes</li>
    
    </ol>

  </section>

  <!--=====================================
            BODY CLIENTES
  ======================================-->

  <section class="content">

    <div class="box"><!--CLASE BOX:CUBRE TODO EL CUERPO DE CLIENTES-->

      <!--=====================================
            HEADER-BODY CLIENTES
      ======================================-->

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          <i class="fa fa-user"></i>

          &nbsp

          <span>Agregar Clientes</span>

        </button>

      </div>

      <!--=====================================
            CONTENT-BODY CLIENTES
      ======================================-->

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Foto</th>
           <th>Nombres</th>
           <th>Dni</th>
           <th>Direccion</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
            <!--=====================================
                        MOSTRAR CLIENTES
            ======================================-->

            <?php

              /*=============================================
                             INICALIZAR VARIABLES
              =============================================*/

                  $item=null;

                  $valor=null;

                  $cliente_img="";

              /*=============================================
                          LLAMO AL CONTROLADOR
              =============================================*/

                  $clientes=ControladorCliente::ctrMostrarCliente($item,$valor);

              /*=============================================
                      RECORRO EL ARRAY OBTENIDO DEL CTR
              =============================================*/


                foreach ($clientes as $key => $value) {

                  if($key%2==0){

                    $cliente_img="cliente1";

                  }else{

                    $cliente_img="cliente2";

                  }
                  
                    echo '<tr>
                            
                              <td>'.($key+1).'</td>

                              <td><img src="vistas/img/plantilla/'.$cliente_img.'.png" class="img-thumbnail" width="40px"></td>

                              <td>'.$value['NOMBRES'].'</td>

                              <td>'.$value['DNI'].'</td>

                              <td>'.$value['DIRECCION'].'</td>

                              <td>'.$value['TELEFONO'].'</td>

                              <td>'.$value['CORREO'].'</td>

                              <td>

                                  <div class="btn-group">

                                    <button class="btn btn-warning btnEditarCliente" id_cliente="'.$value['ID_CLIENTE'].'" style="background:#a7d129;border: 1px solid #a7d129"><i class="fa fa-pencil" data-toggle="modal" data-target="#modalEditarUsuario"></i></button>

                                    <button class="btn btn-danger btnEliminarCliente" id_cliente="'.$value['ID_CLIENTE'].'" id_persona="'.$value['ID_PERSONA'].'"><i class="fa fa-times"></i></button>

                                  </div> 

                              </td>

                          </tr>      
                    ';

                }

            ?>
        
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                    CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Cliente</h4>

        </div>

        <!--=====================================
                    CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL AP_PATERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApPat" placeholder="Ingresar Ap. Paterno" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL AP_MATERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApMat" placeholder="Ingresar Ap. Materno" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDni" placeholder="Ingresar Dni" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar Correo" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" style="background:#a7d129;border: 1px solid #a7d129">Guardar Cliente</button>

        </div>

      </form>

      <?php

        $CrearCliente=new ControladorCliente();

        $CrearCliente->ctrAgregarCliente();

      ?>

    </div>

  </div>

</div>

<!--=====================================
          MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                    CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cliente</h4>

        </div>

        <!--=====================================
                    CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL AP_PATERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarApPat" id="editarApPat" placeholder="Ingresar Ap. Paterno" required>
                <input type="hidden" id="idCliente" name="idCliente">

              </div>

            </div>

            <!-- ENTRADA PARA EL AP_MATERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarApMat" id="editarApMat" placeholder="Ingresar Ap. Materno" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarDni" id="editarDni" placeholder="Ingresar Dni" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" placeholder="Ingresar Direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="email" class="form-control input-lg" name="editarCorreo" id="editarCorreo" placeholder="Ingresar Correo" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" style="background:#a7d129;border: 1px solid #a7d129">Editar Cliente</button>

        </div>

      </form>

      <?php

        $EditarCliente=new ControladorCliente();

        $EditarCliente->ctrEditarCliente();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarCliente=new ControladorCliente();

  $EliminarCliente->ctrEliminarCliente();

?>