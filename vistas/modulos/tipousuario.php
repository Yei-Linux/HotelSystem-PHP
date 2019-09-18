<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Tipo de Usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Tipo de Usuarios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoUsu">
          
          Agregar Tipo de Usuario

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Icono</th>
           <th>Tipo de Usuario</th>
           <th>Descripcion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

            <?php

                $item=null;
                $valor=null;

                $tipo_usuario="";

                $TipoUsu=ControladorTipoUsu::ctrMostarTipoUsu($item,$valor);

                foreach ($TipoUsu as $key => $value) {

                  if($key%2==0){

                    $tipo_usuario="tipo_usuario1";

                  }else{

                    $tipo_usuario="tipo_usuario2";

                  }
                  
                  echo ' <tr>

                            <td>'.($key+1).'</td>

                            <td><img src="vistas/img/plantilla/'.$tipo_usuario.'.png" class="img-thumbnail" width="40px"></td>

                            <td>'.$value['NOM_TIPO_USU'].'</td>

                            <td>'.$value['DESCRIPCION'].'</td>

                            <td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btneditarTipoUsu"  
                                style="background:#a7d129;border: 1px solid #a7d129"
                                data-toggle="modal" data-target="#modalEditarTipoUsu"
                                id_tipousu="'.$value['ID_TIPO_USU'].'">

                                  <i class="fa fa-pencil" ></i>

                                </button>

                                <button class="btn btn-danger btneliminarTipoUsu" 
                                id_elim_tipousu="'.$value['ID_TIPO_USU'].'">

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
MODAL AGREGAR TIPO DE USUARIO
======================================-->

<div id="modalAgregarTipoUsu" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tipo de Usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA EL TIPO DE USUARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTipoUsu" placeholder="Ingresar Tipo de Usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDescrip" placeholder="Ingresar Descripcion" required>

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
          style="background:#a7d129;border: 1px solid #a7d129">Guardar Tipo de Usuario</button>

        </div>

      </form>

      <?php

          $AgregarTipoUsu=new ControladorTipoUsu();

          $AgregarTipoUsu -> ctrAgregarTipoUsu();

      ?>

    </div>

  </div>

</div>
<!--=====================================
MODAL EDITAR TIPO DE USUARIO
======================================-->

<div id="modalEditarTipoUsu" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tipo de Usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA EL TIPO DE USUARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editTipoUsu" name="editTipoUsu" placeholder="Ingresar Tipo de Usuario" required>

                <input type="hidden" id="editid_tipo_usu" name="editid_tipo_usu">

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editDescrip" name="editDescrip" placeholder="Ingresar Descripcion" required>

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
          style="background:#a7d129;border: 1px solid #a7d129">Editar Tipo de Usuario</button>

        </div>

      </form>

      <?php

          $EditarTipoUSu=new ControladorTipoUsu();

          $EditarTipoUSu -> ctrEditarTipoUsu();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarTipoUsu=new ControladorTipoUsu();

  $EliminarTipoUsu -> ctrEliminarTipoUsu();

?>