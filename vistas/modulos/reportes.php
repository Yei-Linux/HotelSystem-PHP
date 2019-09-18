<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reportes
      
      <small>Reportes Generales</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      
    <?php

        include "reportes/cajas-superiores.php";

    ?>

    </div>


     <div class="row">
       
        <div class="col-lg-12">

          <?php
            
            include "reportes/grafico-ventas.php";

          ?>

        </div>

        <div class="col-lg-6">

          <?php
              
             include "reportes/compradores.php";

          ?>

        </div>

         <div class="col-lg-6">

          <?php
          
              include "reportes/vendedores.php";

          ?>

        </div>

     </div> 

  </section>
 
</div>
