<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Sedes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Sedes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSede">
          
          Agregar Sede

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Icono</th>
           <th>Sede</th>
           <th>Lugar de Residencia</th>
           <th>Pisos</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <?php

            $item=null;
            $valor=null;

            $sede_img="";

            $sedes=ControladorSede::ctrMostrarSedes($item,$valor);

            foreach ($sedes as $key => $value) {

              if($key%2==0){

                $sede_img="logo";

              }else{

                $sede_img="logo2";

              }
                
              echo '<tr>

                      <td>'.($key+1).'</td>

                      <td><img src="vistas/img/plantilla/'.$sede_img.'.png" class="img-thumbnail" width="40px"></td>

                      <td>Hotel'.$value['NOMBRE'].'</td>

                      <td>'.$value['LUGAR'].'</td>

                      <td>'.$value['PISOS'].'</td>

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btneditarSede"  
                          style="background:#a7d129;border: 1px solid #a7d129"
                          data-toggle="modal" data-target="#modalEditarSede"
                          id_sede="'.$value['ID_HOTEL'].'">
                          <i class="fa fa-pencil" ></i>
                          </button>

                          <button class="btn btn-danger btneliminarSede" 
                          idElimSede="'.$value['ID_HOTEL'].'">
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

<div id="modalAgregarSede" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Sede</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreSede" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL LUGAR -->
  
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoLugarSede">
                  
                  <option value="">Selecionar Lugar de Residencia</option>

                  <option value="Lima">Lima</option>

                  <option value="Huancayo">Huancayo</option>

                  <option value="Arequipa">Arequipa</option>

                  <option value="Cusco">Cusco</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL PISOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPisoSede">
                  
                  <option value="">Selecionar Numero de Pisos</option>

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
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" 
          style="background:#a7d129;border: 1px solid #a7d129">Guardar Sede</button>

        </div>

      </form>

      <?php

        $AgregarSede=new ControladorSede();

        $AgregarSede -> ctrAgregarSede();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SEDE
======================================-->

<div id="modalEditarSede" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Sede</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editNombreSede" name="editNombreSede" placeholder="Ingresar Nombre" required>

                <input type="hidden" id="editidSede" name="editidSede">

              </div>

            </div>

            <!-- ENTRADA PARA EL LUGAR -->
  
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editLugarSede" name="editLugarSede">
                  
                  <option value="">Selecionar Lugar de Residencia</option>

                  <option value="Lima">Lima</option>

                  <option value="Huancayo">Huancayo</option>

                  <option value="Arequipa">Arequipa</option>

                  <option value="Cusco">Cusco</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL PISOS -->
            
           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editPisoSede" name="editPisoSede">
                  
                  <option value="">Selecionar Numero de Pisos</option>

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
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" 
          style="background:#30e3ca;color:white;width:120.56px">Salir</button>

          <button type="submit" class="btn btn-primary" 
          style="background:#a7d129;border: 1px solid #a7d129">Editar Sede</button>

        </div>

      </form>

      <?php

        $EditarSede=new ControladorSede();

        $EditarSede -> ctrEditarSede();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarSede=new ControladorSede();

  $EliminarSede -> ctrEliminarSede();

?>


