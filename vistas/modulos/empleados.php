<div class="content-wrapper">

  <!--=====================================
            HEADER EMPLEADO
  ======================================-->

  <section class="content-header">
    
    <h1>
      
      Administrar Empleados
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Empleados</li>
    
    </ol>

  </section>

  <!--=====================================
            BODY EMPLEADO
  ======================================-->

  <section class="content">

    <div class="box"><!--CLASE BOX:CUBRE TODO EL CUERPO DE EMPLEADOS-->

      <!--=====================================
              HEADER-BODY EMPLEADOS
      ======================================-->

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">
          
          <i class="fa fa-user"></i>

          &nbsp

          <span>Agregar Empleados</span>

        </button>

      </div>

      <!--=====================================
              CONTENT-BODY EMPLEADOS
      ======================================-->

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

          <?php

          $item=null;
          $valor=null;
          $valor2=$_SESSION['idHotel'];

          $empleados=ControladorEmpleado::ctrMostrarEmpleado($item,$valor,$valor2);

          foreach ($empleados as $key => $value) {

            echo ' <tr>

                    <td>'.($key+1).'</td>
                    <td>'.$value['NOMBRE'].'</td>
                    <td>'.$value['USARIO'].'</td>
                    <td><img src="'.$value['FOTO'].'" class="img-thumbnail" width="40px"></td>
                    <td>'.$value['NOM_TIPO_USU'].'</td>';

                    if($value['ESTADO']==1){

                      echo '
                    <td><button estado="'.$value['ESTADO'].'" id_est_Empleado="'.$value['ID_EMPLEADO'].'" id="btnestado" class="btn btn-success btn-xs">Activado</button></td>';

                    }else{

                      echo '
                    <td><button estado="'.$value['ESTADO'].'" id_est_Empleado="'.$value['ID_EMPLEADO'].'" id="btnestado" class="btn btn-warning btn-xs">Desactivado</button></td>';

                    }


            echo
                    '
                    <td>'.$value['FECHA'].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btneditarEmpleado" 
                          id_empleado="'.$value['ID_EMPLEADO'].'" 
                          idhotel="'.$_SESSION['idHotel'].'"
                        style="background:#a7d129;border: 1px solid #a7d129" data-toggle="modal" data-target="#modalEditarEmpleado"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btneliminarEmpleado" id_empleado="'.$value['ID_EMPLEADO'].'"
                        id_persona="'.$value['ID_PERSONA'].'" id_usuario="'.$value['ID_USUARIO'].'"
                        rutaEmp="'.$value['USARIO'].'"><i class="fa fa-times"></i></button>
 
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
MODAL AGREGAR EMPLEADO
======================================-->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                    CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empleado</h4>

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

                <input type="text" class="form-control input-lg" name="nuevoApPatEmp" placeholder="Ingresar Ap. Paterno" required>

                <input type="hidden" value="<?php echo $_SESSION['idHotel']; ?>" name="idHotel">

              </div>

            </div>

            <!-- ENTRADA PARA EL AP_MATERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApMatEmp" placeholder="Ingresar Ap. Materno" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreEmp" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDniEmp" placeholder="Ingresar Dni" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccionEmp" placeholder="Ingresar Direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefonoEmp" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoCorreoEmp" placeholder="Ingresar Correo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Hotelero</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
                <div class="panel">SUBIR FOTO</div>

                <input type="file" class="nuevaFoto" name="nuevaFoto">

                <p class="help-block">Peso máximo de la foto 200 MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" style="background:#a7d129;border: 1px solid #a7d129">Guardar Empleado</button>

        </div>

      </form>

      <?php

        $AgregarEmpleados=new ControladorEmpleado();

        $AgregarEmpleados->ctrAgregarEmpleado();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                    CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Empleado</h4>

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

                <input type="text" class="form-control input-lg" id="editApPatEmp" name="editApPatEmp" placeholder="Ingresar Ap. Paterno" required>

                <input type="hidden" id="idEmpleado" name="idEmpleado">

                <input type="hidden" value="<?php echo $_SESSION['idHotel']; ?>" name="idHotel">

              </div>

            </div>

            <!-- ENTRADA PARA EL AP_MATERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editApMatEmp" name="editApMatEmp" placeholder="Ingresar Ap. Materno" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editNombreEmp" name="editNombreEmp" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DNI -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" id="editDniEmp" name="editDniEmp" placeholder="Ingresar Dni" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" id="editDireccionEmp" name="editDireccionEmp" placeholder="Ingresar Direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" id="editTelefonoEmp" name="editTelefonoEmp" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="email" class="form-control input-lg" id="editCorreoEmp" name="editCorreoEmp" placeholder="Ingresar Correo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editUsuario" name="editUsuario" placeholder="Ingresar usuario" required>

                <input type="hidden" id="oldUsuario" name="oldUsuario">

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group"> 
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" id="editPassword" name="editPassword" placeholder="Ingresa la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editPerfil" name="editPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Hotelero</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>
  
            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
                <div class="panel">SUBIR FOTO</div>

                <input type="file" class="editFoto" name="editFoto">

                <p class="help-block">Peso máximo de la foto 200 MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEdit" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" style="background:#a7d129;border: 1px solid #a7d129">Editar Empleado</button>

        </div>

      </form>

      <?php

        $EditarEmpleado=new ControladorEmpleado();

        $EditarEmpleado -> ctrEditarEmpleado();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarEmpleado=new ControladorEmpleado();

  $EliminarEmpleado -> ctrEliminarEmpleado();

?>



