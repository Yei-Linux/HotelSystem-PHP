<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Productos de la Tienda del Hotel
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar Producto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Foto</th>
           <th>Producto</th>
           <th>Precio</th>
           <th>Categoria</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

          <?php

            $item=null;
            $valor=null;

            $productos=ControladorProducto::ctrMostrarProductos($item,$valor);

            foreach ($productos as $key => $value) {

              echo '<tr>

                        <td>'.($key+1).'</td>

                        <td><img src="'.$value['FOTO_PRODUCTO'].'" class="img-thumbnail" width="40px"></td>

                        <td>'.$value['DESCRIPCION'].'</td>

                        <td>S/.'.$value['PRECIO'].'</td>
                      
                        <td>'.$value['NOMBRE_CATEGORIA'].'</td>

                        <td>

                          <div class="btn-group">
                              
                            <button class="btn btn-warning btnEditarProducto"  
                            style="background:#a7d129;border: 1px solid #a7d129"
                            data-toggle="modal" data-target="#modalEditarProducto"
                            id_editarProducto="'.$value['ID_PRODUCTO'].'">
                              <i class="fa fa-pencil" ></i>
                            </button>

                            <button class="btn btn-danger btnEliminarProducto" 
                            id_eliminarProducto="'.$value['ID_PRODUCTO'].'"
                            rutaProd="'.$value['DESCRIPCION'].'">
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

      <div class="box-header with-border Categorias" style="color:white;display:flex;flex-direction:row;justify-content:space-between;
      background-color:#32dbc6;">

        <p>

            <i class="fa fa-refresh"></i>

            &nbsp

            <span>Categorias de Productos : </span> 

        </p>
  
        <button class="btn btn-primary btnverCategorias" categoria="enviar" data-toggle="modal" data-target="#modalMostrarCategorias">
          
          Ver Categorias de Productos

        </button>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL EDITAR CATEGORIAS
======================================-->

<div id="modalMostrarCategorias" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Categorias de nuestros Productos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CATEGORIA1 -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/cereales.png"></img></span>

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Categoria 1:</span>

                <input type="text" id="putCat1" name="putCat1" class="form-control input-lg habilCat" placeholder="Descuento" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA CATEGORIA2 -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/bebidas.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Categoria 2:</span>

                <input type="text" id="putCat2" name="putCat2" class="form-control input-lg habilCat2" placeholder="Descuento" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA CATEGORIA3 -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/snacks.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Categoria 3:</span>

                <input type="text" id="putCat3" name="putCat3" class="form-control input-lg habilCat3" placeholder="Descuento" disabled required>

              </div>

            </div>

            <!-- ENTRADA PARA CATEGORIA4 -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><img width="30px" height="30px" src="vistas/img/plantilla/galletas.png"></img></span> 

                <span class="input-group-addon" style="font-size:1.6em;width:130px;"> Categoria 4:</span>

                <input type="text" id="putCat4" name="putCat4" class="form-control input-lg habilCat4" placeholder="Descuento" disabled required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer footerHabitacion">

          <button type="button" class="btn btn-default pull-left habilitarCategoria" 
          style="background:#30e3ca;color:white;width:120.56px">Habilitar</button>

          <button type="submit" class="btn btn-primary EditarCategoria" 
          style="background:#a7d129;border: 1px solid #a7d129" disabled>Editar</button>

        </div>

      </form>

      <?php

        $EditarCategorias=new ControladorProducto();

        $EditarCategorias -> ctrEditarCategorias();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL PRODUCTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoProd" name="nuevoProd" placeholder="Ingresar Producto" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPrecioProd" placeholder="Ingresar Precio del Producto" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CATEGORIA -->
  
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevaCategoria">
                  
                  <option value="">Selecionar Categoria</option>

                  <option value="Cereales">Cereales</option>

                  <option value="Gaseosa">Gaseosa</option>

                  <option value="Snacks">Snacks</option>

                  <option value="Galletas">Galletas</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
                <div class="panel">SUBIR FOTO DEL PRODUCTO</div>

                <input type="file" class="nuevaFotoProducto" name="nuevaFotoProducto">

                <p class="help-block">Peso máximo de la foto 200 MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarProducto" width="100px">

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
          style="background:#a7d129;border: 1px solid #a7d129">Guardar Producto</button>

        </div>

      </form>

      <?php

          $AgregarProducto=new ControladorProducto();

          $AgregarProducto -> ctrAgregarProducto() ;

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#6927ff; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL PRODUCTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editProd" name="editProd" placeholder="Ingresar Producto" required>

                <input type="hidden" id="editIdProd" name="editIdProd">

                <input type="hidden" id="editOldProd" name="editOldProd">

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editPrecioProd" name="editPrecioProd" placeholder="Ingresar Precio del Producto" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CATEGORIA -->
  
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editCategoria" name="editCategoria">
                  
                  <option value="">Selecionar Categoria</option>

                  <option value="Cereales">Cereales</option>

                  <option value="Bebidas">Bebidas</option>

                  <option value="Snacks">Snacks</option>

                  <option value="Galletas">Galletas</option>

                </select>

              </div>
 
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
                <div class="panel">SUBIR FOTO DEL PRODUCTO</div>

                <input type="file" class="editFotoProducto" id="editFotoProducto" name="editFotoProducto">

                <p class="help-block">Peso máximo de la foto 200 MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail editprevisualizarProducto" width="100px">

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
          style="background:#a7d129;border: 1px solid #a7d129">Editar Producto</button>

        </div>

      </form>

      <?php

          $EditarProducto=new ControladorProducto();

          $EditarProducto -> ctrEditarProducto();

      ?>

    </div>

  </div>

</div>

<?php

  $EliminarProducto=new ControladorProducto();

  $EliminarProducto -> ctrEliminarProducto();

?>