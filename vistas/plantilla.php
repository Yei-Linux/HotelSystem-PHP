<?php

  session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory Sysem</title>

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

  <!-- -------------- -->
  <!-- PLUGINS DE CSS -->
  <!-- -------------- -->

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins.  -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

     <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">
 
  <!-- --------------------- -->
  <!-- PLUGINS DE JAVASCRIPT -->
  <!-- --------------------- -->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  
  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  
  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>

</head>
  <!-- --------------------- -->
  <!-- CUERPO DOCUMENTO -->
  <!-- --------------------- -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">


    
  <?php

    if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion']=="ok"){


      echo '<div class="wrapper">';
    
        include "modulos/cabezote.php";

        include "modulos/menu.php";

        if(isset($_GET["ruta"])){

          if($_GET["ruta"]=="clientes"  ||
             $_GET["ruta"]=="empleados" ||
             $_GET["ruta"]== "inicio"   ||
             $_GET["ruta"]=="salir"     ||
             $_GET["ruta"]=="sede"      ||
             $_GET["ruta"]=="tipousuario" ||
             $_GET["ruta"]=="tipohabitacion" ||
             $_GET["ruta"]=="habitacion" ||
             $_GET["ruta"]=="productos" ||
             $_GET["ruta"]=="servicios" ||
             $_GET["ruta"]=="registroIngreso" ||
             $_GET["ruta"]=="registroSalida" ||
             $_GET["ruta"]=="registroReserva" ||
             $_GET["ruta"]=="tienda" ||
             $_GET["ruta"]=="tiendaServicios" ||
             $_GET["ruta"]=="reportes"){

            include "modulos/".$_GET["ruta"].".php";

          }else{

            

          }

        }else{

            include "modulos/inicio.php";

        }
        
        

        include "modulos/footer.php";

      echo "</div>";

    }else{

      include "modulos/login.php";

    }

  ?>

  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/cliente.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  <script src="vistas/js/sede.js"></script>
  <script src="vistas/js/tipousu.js"></script>
  <script src="vistas/js/tipohabitacion.js"></script>
  <script src="vistas/js/temporada.js"></script>
  <script src="vistas/js/habitacion.js"></script>
  <script src="vistas/js/productos.js"></script>
  <script src="vistas/js/servicios.js"></script>
  <script src="vistas/js/registroIngreso.js"></script>
  <script src="vistas/js/registroSalida.js"></script>
  <script src="vistas/js/registroReserva.js"></script>
  <script src="vistas/js/tienda.js"></script>
  <script src="vistas/js/tiendaServicio.js"></script>
  
</body>
</html>
