<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Servicios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Servicios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">
          
          Agregar Servicio

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Icono</th>
           <th>Servicio</th>
           <th>Descripcion</th>
           <th>Precio</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
            <?php

            $item=null;
            $valor=null;

            $Servicio_img="";

            $respuesta=ControladorServicio::ctrMostrarServicios($item,$valor);

            foreach ($respuesta as $key => $value) {

                if($key%2==0){

                    $Servicio_img="servicio2";

                }else{

                    $Servicio_img="servicio1";

                }
                
                echo '<tr>

                      <td>'.($key+1).'</td>

                      <td><img src="vistas/img/plantilla/'.$Servicio_img.'.png" class="img-thumbnail" width="40px"></td>

                      <td>'.$value['SERVICIO'].'</td>

                      <td>'.$value['DESCRIPCION'].'</td>

                      <td>S/.'.$value['PRECIO'].'</td>

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btneditarServicio"  
                          style="background:#a7d129;border: 1px solid #a7d129"
                          data-toggle="modal" data-target="#modalEditarServicio"
                          id_editar_Serv="'.$value['ID_SERVICIO'].'">
                          <i class="fa fa-pencil" ></i>
                          </button>

                          <button class="btn btn-danger btneliminarServicio" 
                          id_elim_Serv="'.$value['ID_SERVICIO'].'">
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

<div id="modalAgregarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL SERVICIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreServ" placeholder="Ingresar Nombre del Serivicio" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea name="nuevaDescripcionServ" rows="5" class="form-control input-lg" placeholder="Ingresar Descripcion del Servicio" required></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPrecioServ" placeholder="Ingresar Precio del Servicio" required>

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
          style="background:#a7d129;border: 1px solid #a7d129">Guardar Servicio</button>

        </div>

      </form>

      <?php

        $AgregarServicio=new ControladorServicio();

        $AgregarServicio -> ctrAgregarServicio();


      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalEditarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL SERVICIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editNombreServ" name="editNombreServ" placeholder="Ingresar Nombre del Serivicio" required>

                <input type="hidden" id="idEditServicio" name="idEditServicio">

              </div>

            </div>

             <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea id="ediDescripcionServ" name="ediDescripcionServ" rows="5" class="form-control input-lg" placeholder="Ingresar Descripcion del Servicio" required></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editPrecioServ" name="editPrecioServ" placeholder="Ingresar Precio del Servicio" required>

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
          style="background:#a7d129;border: 1px solid #a7d129">Editar Servicio</button>

        </div>

      </form>

      <?php

            $EditarServicio=new ControladorServicio;

            $EditarServicio -> ctrEditarServicio();

      ?>

    </div>

  </div>

</div>

<?php

    $EliminarServicio=new ControladorServicio();

    $EliminarServicio -> ctrEliminarServicio();

?>